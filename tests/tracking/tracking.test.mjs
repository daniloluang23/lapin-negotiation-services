// Tracking gate tests: GA4 + Google Ads + Microsoft UET load only where the
// opt-out rules allow, lead events fire once per real send, and the cookie
// banner's Reject switches everything off.
//
// The live host's edge cache serves one copy of each page to everyone, so the
// opt-out must hold in the BROWSER on a page that still carries the tag code:
// the "browser" tests run the rendered head script against a fake DOM.
//
// Run from the repo root:  node tests/tracking/tracking.test.mjs
// Needs Local's bundled PHP (found automatically) or PHP_BIN set.

import { execFileSync } from 'node:child_process';
import { readdirSync } from 'node:fs';
import { join, dirname } from 'node:path';
import { fileURLToPath } from 'node:url';
import vm from 'node:vm';
import assert from 'node:assert/strict';

const here = dirname(fileURLToPath(import.meta.url));

function findPhp() {
	if (process.env.PHP_BIN) { return process.env.PHP_BIN; }
	const base = join(process.env.LOCALAPPDATA || '', 'Programs/Local/resources/extraResources/lightning-services');
	const dir = readdirSync(base).find((d) => d.startsWith('php-'));
	return join(base, dir, 'bin/win64/php.exe');
}
const PHP = findPhp();

const LIVE = 'lapinnegotiationservices.com';
const LOCAL = 'lapin-negotiation-services.local';

function render(partial, host, slug, { consent = '', gpc = '', sent = '', loggedIn = '' } = {}) {
	return execFileSync(PHP, [join(here, 'render.php'), partial, host, slug, consent, gpc, sent, loggedIn], { encoding: 'utf8' });
}

const results = [];
function test(name, fn) {
	try { fn(); results.push(['PASS', name]); }
	catch (e) { results.push(['FAIL', name, e.message.split('\n')[0]]); }
}

// A cookie jar that understands the attributes the scripts write.
function makeJar(initial = {}) {
	const jar = new Map(Object.entries(initial));
	return {
		jar,
		get cookie() { return [...jar].map(([k, v]) => `${k}=${v}`).join('; '); },
		set cookie(str) {
			const [pair, ...attrs] = str.split(';');
			const eq = pair.indexOf('=');
			const name = pair.slice(0, eq).trim();
			const value = pair.slice(eq + 1);
			if (attrs.some((a) => /expires=Thu, 01 Jan 1970|max-age=0\b/i.test(a))) { jar.delete(name); }
			else { jar.set(name, value); }
		},
	};
}

// ------------------------------------------------------------- server gate

test('server, live: tag code rendered once with every id', () => {
	const out = render('analytics', LIVE, 'home');
	assert.equal(out.split('googletagmanager.com/gtag/js').length - 1, 1, 'gtag.js loader count');
	for (const id of ['G-YDVFENWDSD', 'AW-706048676', 'AW-706048676/jKMKCLepyO4cEKTl1dAC', '310-984-6952', '56183216', 'bat.bing.net/bat.js']) {
		assert.ok(out.includes(id), `${id} missing`);
	}
});

// The opt-out must not change the server's HTML: the edge cache would store a
// tag-free copy from an opted-out visitor's cache miss and serve it to everyone.
for (const [label, opts] of [
	['visitor rejected', { consent: 'rejected' }],
	['GPC signal (e.g. Brave)', { gpc: '1' }],
]) {
	test(`server, live, ${label}: same HTML as everyone else (opt-out is enforced in the browser)`, () => {
		assert.equal(render('analytics', LIVE, 'home', opts), render('analytics', LIVE, 'home'));
	});
}

for (const [label, host, opts] of [
	['live, signed-in user', LIVE, { loggedIn: '1' }],
	['local dev host', LOCAL, {}],
]) {
	test(`server, ${label}: no tag code at all`, () => {
		const out = render('analytics', host, 'contact', { ...opts, sent: '1' });
		assert.ok(!out.includes('gtag') && !out.includes('bat.bing.net'), 'tag code present');
	});
}

// --------------------------------------------- browser: head gate (cached page)

const headScript = render('analytics', LIVE, 'home').match(/<script>([\s\S]*?)<\/script>/)[1];

function runHead({ jar = makeJar(), gpc = false } = {}) {
	const loaded = [];
	const clickHandlers = [];
	const firstScript = { parentNode: { insertBefore: (n) => loaded.push(n.src) } };
	const document = {
		get cookie() { return jar.cookie; },
		set cookie(v) { jar.cookie = v; },
		createElement: () => ({}),
		head: { appendChild: (n) => loaded.push(n.src) },
		getElementsByTagName: () => [firstScript],
		addEventListener: (type, fn) => { if (type === 'click') { clickHandlers.push(fn); } },
	};
	const window = { navigator: { globalPrivacyControl: gpc } };
	vm.runInNewContext(headScript, { window, document });
	const dl = () => (window.dataLayer || []).map((a) => Array.from(a));
	// Simulate a click on a link with the given href (or a non-link element).
	const click = (href) => clickHandlers.forEach((fn) => fn({
		target: { closest: (sel) => (href && sel.includes('tel:') && href.startsWith('tel:') ? { getAttribute: () => href } : null) },
	}));
	return { loaded, get dl() { return dl(); }, window, jar: jar.jar, click, clickHandlers };
}
const hasCall = (dl, ...want) => dl.some((c) => want.every((w, i) => (typeof w === 'object' ? JSON.stringify(c[i]) === JSON.stringify(w) : c[i] === w)));

test('browser, no choice: loads gtag.js and bat.js, configures GA4, Ads and call tracking', () => {
	const r = runHead();
	assert.ok(r.loaded.some((s) => s === 'https://www.googletagmanager.com/gtag/js?id=G-YDVFENWDSD'), 'gtag.js not loaded');
	assert.ok(r.loaded.some((s) => s === 'https://bat.bing.net/bat.js?ti=56183216'), 'bat.js not loaded');
	assert.equal(r.loaded.length, 2, 'unexpected extra loaders');
	assert.ok(hasCall(r.dl, 'config', 'G-YDVFENWDSD'));
	assert.ok(hasCall(r.dl, 'config', 'AW-706048676'));
	assert.ok(hasCall(r.dl, 'config', 'AW-706048676/jKMKCLepyO4cEKTl1dAC', { phone_conversion_number: '310-984-6952' }));
	assert.ok(!hasCall(r.dl, 'event', 'generate_lead'), 'lead fired without a send');
});

for (const [label, cookies, gpc] of [
	['rejected cookie', { lapin_cookie_consent: 'rejected' }, false],
	['GPC, no explicit choice', {}, true],
]) {
	test(`browser, cached page, ${label}: nothing loads or queues`, () => {
		const r = runHead({ jar: makeJar(cookies), gpc });
		assert.equal(r.loaded.length, 0, `loaded ${r.loaded.join(', ')}`);
		assert.equal(r.window.gtag, undefined, 'gtag defined');
		assert.equal(r.window.dataLayer, undefined, 'dataLayer created');
		assert.equal(r.window.uetq, undefined, 'uetq created');
	});
}

test('browser, GPC after an explicit Accept: loads (documented behaviour)', () => {
	const r = runHead({ jar: makeJar({ lapin_cookie_consent: 'accepted' }), gpc: true });
	assert.equal(r.loaded.length, 2);
});

test('browser, real send: lead events fire once, then never on reload', () => {
	const jar = makeJar({ lapin_lead: '1' });
	const first = runHead({ jar });
	assert.ok(hasCall(first.dl, 'event', 'generate_lead'), 'GA4 generate_lead missing');
	const q = first.window.uetq;
	assert.ok(q.includes('submit_lead_form') && q[q.indexOf('submit_lead_form') - 1] === 'event', 'UET lead missing');
	assert.ok(!first.jar.has('lapin_lead'), 'lead flag not consumed');
	const reload = runHead({ jar });
	assert.ok(!hasCall(reload.dl, 'event', 'generate_lead'), 'lead fired again on reload');
	assert.ok(!(reload.window.uetq || []).includes('submit_lead_form'), 'UET lead fired again');
});

// Legacy events the pre-redesign site sent; Logical Position's GA4 key events
// (ga4__lp_contact_form_submission__new_, ga4__lp_talk_direct) match on them.
test('browser, real send: legacy submit/contact/form event fires once (LP form key event)', () => {
	const jar = makeJar({ lapin_lead: '1' });
	const first = runHead({ jar });
	assert.ok(hasCall(first.dl, 'event', 'submit', { event_category: 'contact', event_label: 'form' }), 'legacy submit event missing');
	const reload = runHead({ jar });
	assert.ok(!reload.dl.some((c) => c[0] === 'event' && c[1] === 'submit'), 'legacy submit fired again on reload');
});

test('browser, ordinary visit: no legacy submit event', () => {
	assert.ok(!runHead().dl.some((c) => c[0] === 'event' && c[1] === 'submit'));
});

// The agency's GA4 key event (LP, 17.11.26). Their snippet fired on any click of
// the "Send message" button; here it fires on a genuine send only.
test('browser, real send: ContactFormSubmission sent to GA4 once, never on reload', () => {
	const jar = makeJar({ lapin_lead: '1' });
	const first = runHead({ jar });
	assert.ok(hasCall(first.dl, 'event', 'ContactFormSubmission', { send_to: 'G-YDVFENWDSD' }), 'ContactFormSubmission missing');
	assert.equal(first.dl.filter((c) => c[0] === 'event' && c[1] === 'ContactFormSubmission').length, 1, 'sent more than once');
	const reload = runHead({ jar });
	assert.ok(!reload.dl.some((c) => c[0] === 'event' && c[1] === 'ContactFormSubmission'), 'sent again on reload');
});

test('browser, ordinary visit or opted out: no ContactFormSubmission', () => {
	assert.ok(!runHead().dl.some((c) => c[0] === 'event' && c[1] === 'ContactFormSubmission'));
	const out = runHead({ jar: makeJar({ lapin_cookie_consent: 'rejected', lapin_lead: '1' }) });
	assert.equal(out.window.dataLayer, undefined);
});

test('browser, phone link tap: legacy click/telephone event with the number (LP call key event)', () => {
	const r = runHead();
	r.click('tel:+13109846952');
	assert.ok(hasCall(r.dl, 'event', 'click', { event_category: 'telephone', event_label: '+13109846952' }), 'telephone click event missing');
});

test('browser, other clicks: no telephone event', () => {
	const r = runHead();
	r.click('https://example.com/');
	r.click(null);
	assert.ok(!r.dl.some((c) => c[0] === 'event' && c[1] === 'click'));
});

test('browser, Reject clicked after the page loaded: phone taps send nothing', () => {
	const jar = makeJar();
	const r = runHead({ jar });
	jar.cookie = 'lapin_cookie_consent=rejected;path=/;max-age=31536000;SameSite=Lax';
	r.click('tel:+13109846952');
	assert.ok(!r.dl.some((c) => c[0] === 'event' && c[1] === 'click'), 'telephone event sent after Reject');
});

test('browser, opted out: phone taps send nothing', () => {
	const r = runHead({ jar: makeJar({ lapin_cookie_consent: 'rejected' }) });
	r.click('tel:+13109846952');
	assert.equal(r.window.dataLayer, undefined);
	assert.equal(r.clickHandlers.length, 0, 'click listener registered for an opted-out visitor');
});

test('browser, /contact/?sent=1 without a real send (bookmark/shared link): no lead', () => {
	const r = runHead(); // the head script ignores the URL entirely
	assert.ok(!hasCall(r.dl, 'event', 'generate_lead'));
});

test('browser, opted out with a lead flag: nothing fires, flag still cleared', () => {
	const r = runHead({ jar: makeJar({ lapin_cookie_consent: 'rejected', lapin_lead: '1' }) });
	assert.equal(r.loaded.length, 0);
	assert.ok(!r.jar.has('lapin_lead'));
});

// ------------------------------------------------------ browser: cookie banner

const bannerHtml = render('banner', LIVE, 'home');
const bannerScript = bannerHtml.match(/<script>([\s\S]*?)<\/script>/)[1];
const TRACKING_COOKIES = { _ga: '1', _ga_X: '1', _gid: '1', _gcl_au: '1', _uetsid: '1', _uetvid: '1', other: 'keep' };

function runBanner({ cookies = {}, gpc = false, withGtag = true } = {}) {
	const jar = makeJar(cookies);
	const handlers = [];
	const banner = { hidden: true, addEventListener: (t, fn) => handlers.push(fn), querySelector: () => null };
	const store = new Map([['_uetvid', 'x'], ['_gcl_ls', 'y'], ['keep_me', 'z']]);
	const localStorage = { removeItem: (k) => store.delete(k) };
	const storageProxy = new Proxy(localStorage, { ownKeys: () => [...store.keys()], getOwnPropertyDescriptor: (t, k) => (store.has(k) ? { enumerable: true, configurable: true, value: store.get(k) } : Reflect.getOwnPropertyDescriptor(t, k)) });
	const document = {
		getElementById: () => banner,
		addEventListener: () => {},
		get cookie() { return jar.cookie; },
		set cookie(v) { jar.cookie = v; },
	};
	const gtagCalls = [];
	const window = { localStorage: storageProxy };
	if (withGtag) { window.gtag = (...a) => gtagCalls.push(a); }
	vm.runInNewContext(bannerScript, { window, document, navigator: { globalPrivacyControl: gpc }, location: { hostname: LIVE } });
	const clickReject = () => handlers.forEach((fn) => fn({ target: { closest: () => ({ getAttribute: () => 'rejected' }) } }));
	return { jar: jar.jar, window, gtagCalls, store, clickReject };
}

function assertAllOff({ jar, window, gtagCalls, store }, { withGtag = true } = {}) {
	assert.equal(window['ga-disable-G-YDVFENWDSD'], true, 'GA4 not disabled');
	if (withGtag) {
		const c = gtagCalls.find((x) => x[0] === 'consent' && x[1] === 'update');
		assert.ok(c && c[2].ad_storage === 'denied' && c[2].analytics_storage === 'denied', 'gtag consent not denied');
	}
	const q = window.uetq;
	const i = q.indexOf('consent');
	assert.ok(i >= 0 && q[i + 1] === 'update' && q[i + 2].ad_storage === 'denied', 'UET consent not denied');
	for (const name of ['_ga', '_ga_X', '_gid', '_gcl_au', '_uetsid', '_uetvid']) {
		assert.ok(!jar.has(name), `${name} cookie not dropped`);
	}
	assert.ok(jar.has('other'), 'unrelated cookie dropped');
	assert.ok(!store.has('_uetvid') && !store.has('_gcl_ls') && store.has('keep_me'), 'localStorage not cleaned correctly');
	assert.equal(jar.get('lapin_cookie_consent'), 'rejected');
}

test('banner: clicking Reject denies GA4, Google Ads and UET and clears their cookies and storage', () => {
	const r = runBanner({ cookies: { ...TRACKING_COOKIES } });
	r.clickReject();
	assertAllOff(r);
});

test('banner: GPC with no prior choice auto-rejects everything', () => {
	assertAllOff(runBanner({ cookies: { ...TRACKING_COOKIES }, gpc: true }));
});

test('banner: works when no tags loaded (gtag absent)', () => {
	const r = runBanner({ cookies: { ...TRACKING_COOKIES }, gpc: true, withGtag: false });
	assertAllOff(r, { withGtag: false });
});

test('banner: copy discloses the advertising tags', () => {
	assert.ok(/Google Ads/.test(bannerHtml) && /Microsoft Advertising/.test(bannerHtml));
});

// ---------------------------------------------------------------------------
for (const [status, name, why] of results) {
	console.log(`${status}  ${name}${why ? `  ->  ${why}` : ''}`);
}
const failed = results.filter((r) => r[0] === 'FAIL').length;
console.log(`\n${results.length - failed} passed, ${failed} failed`);
process.exit(failed ? 1 : 0);
