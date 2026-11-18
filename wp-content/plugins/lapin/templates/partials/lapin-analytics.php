<?php
/**
 * Head analytics, ad tags + Search Console verification.
 *
 * Required from lapin-head.php, inside <head>. Two independent outputs:
 *
 *  1. Search Console verification meta tag — emitted only when
 *     Lapin::GSC_VERIFICATION is set. The live domain is already verified in
 *     Search Console (same domain as the pre-redesign site), so this normally
 *     stays blank; the constant is a one-line escape hatch if the property ever
 *     needs HTML-tag re-verification.
 *
 *  2. Tracking — GA4, Google Ads and Microsoft UET. Two gates:
 *
 *     Server: emitted only when Lapin::tracking_allowed() is true (live domain,
 *     not logged in). It does not look at the opt-out: the live host's edge
 *     page cache serves one copy of each page to everyone, whatever their
 *     cookie or GPC header (verified 17.11.26: x-kinsta-cache HIT for all), and
 *     an opt-out check on a cache miss would cache a tag-free page for everyone.
 *
 *     Browser: so the opt-out is enforced here, before anything loads. The inline
 *     script reads the lapin_cookie_consent cookie and navigator.globalPrivacyControl
 *     and, if the visitor has opted out, defines no gtag, queues nothing and
 *     injects neither loader. The cookie banner (lapin-cookie-banner.php)
 *     neutralises tags already running on the page view where Reject is clicked.
 *
 *     Google Ads rides on the GA4 gtag.js loader (Google: one Google tag per
 *     page) — a second gtag.js would double-load and can double-count. The call
 *     snippet makes Google swap Lapin::PHONE_LOCAL for a forwarding number for
 *     ad visitors, so its phone_conversion_number must match the displayed
 *     format exactly. Every script is async: nothing here blocks rendering.
 *
 *     Lead events (GA4 generate_lead, Microsoft submit_lead_form) fire once per
 *     real contact form send: Lapin_Contact sets a short-lived lapin_lead cookie
 *     on the success redirect and this script consumes it, so reloads, back
 *     button and shared /contact/?sent=1 links never count again.
 *
 *     Legacy events: the agency's (Logical Position) GA4 key events were built
 *     on events the pre-redesign site sent, so two are sent again here — "submit"
 *     (contact / form) with each lead, and "click" (telephone) on phone-link taps.
 *     Without them those key events, and the Google Ads conversions imported
 *     from them, never fire (found 17.11.26: no data in 28 days).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( '' !== Lapin::GSC_VERIFICATION ) :
	?>
	<meta name="google-site-verification" content="<?php echo esc_attr( Lapin::GSC_VERIFICATION ); ?>">
	<?php
endif;

if ( ! Lapin::tracking_allowed() ) {
	return;
}

$lapin_tracking = array(
	'consentCookie' => Lapin::CONSENT_COOKIE,
	'leadCookie'    => Lapin::LEAD_COOKIE,
	'ga4'           => Lapin::GA4_ID,
	'ads'           => Lapin::GOOGLE_ADS_ID,
	'adsCall'       => Lapin::GOOGLE_ADS_ID . '/' . Lapin::GOOGLE_ADS_CALL_LABEL,
	'phone'         => Lapin::PHONE_LOCAL,
	'uet'           => Lapin::MS_UET_ID,
);
?>
<link rel="preconnect" href="https://www.googletagmanager.com" crossorigin>
<script>
(function (w, d, cfg) {
	function readCookie(name) {
		var m = d.cookie.match(new RegExp('(?:^|;\\s*)' + name + '=([^;]*)'));
		return m ? decodeURIComponent(m[1]) : '';
	}

	// One-time lead flag from a real contact form send: consume it whatever happens.
	var isLead = readCookie(cfg.leadCookie) === '1';
	if (isLead) { d.cookie = cfg.leadCookie + '=;path=/;max-age=0;SameSite=Lax'; }

	// Opt-out gate. "rejected", or a GPC signal with no explicit Accept, means
	// nothing loads. Mirrors the cookie banner's GPC rule.
	var consent = readCookie(cfg.consentCookie);
	if (consent === 'rejected' || (w.navigator.globalPrivacyControl === true && consent !== 'accepted')) {
		return;
	}

	// Google: GA4 + Google Ads on one gtag.js.
	w.dataLayer = w.dataLayer || [];
	w.gtag = function () { w.dataLayer.push(arguments); };
	w.gtag('js', new Date());
	w.gtag('config', cfg.ga4);
	w.gtag('config', cfg.ads);
	w.gtag('config', cfg.adsCall, { 'phone_conversion_number': cfg.phone });
	if (isLead) {
		w.gtag('event', 'generate_lead', { 'form_id': 'contact' });
		// Legacy event from the pre-redesign site: Logical Position's GA4 key
		// event ga4__lp_contact_form_submission__new_ matches on it.
		w.gtag('event', 'submit', { 'event_category': 'contact', 'event_label': 'form' });
		// Logical Position's GA4 key event (snippet sent 17.11.26). Their version
		// fired on any click of the "Send message" button, which also counted
		// blocked, invalid and failed attempts; this fires on a genuine send only.
		w.gtag('event', 'ContactFormSubmission', { 'send_to': cfg.ga4 });
	}
	var g = d.createElement('script');
	g.async = true;
	g.src = 'https://www.googletagmanager.com/gtag/js?id=' + encodeURIComponent(cfg.ga4);
	d.head.appendChild(g);

	// Microsoft UET: the agency's snippet, unchanged apart from the tag id.
	(function(w,d,t,u,o){w[u]=w[u]||[],o.ts=(new Date).getTime();var n=d.createElement(t); n.src="https://bat.bing.net/bat.js?ti="+o.ti+("uetq"!=u?"&q="+u:""),n.async=1, n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&"loaded"!==s&&"complete"!==s||( o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad"),n.onload=n.onreadystatechange=null)}; var i=d.getElementsByTagName(t)[0];i.parentNode.insertBefore(n,i); })(w,d,"script","uetq",{ti:cfg.uet, enableAutoSpaTracking: true});
	if (isLead) { w.uetq.push('event', 'submit_lead_form', {}); }

	// Phone taps. Legacy event from the pre-redesign site: Logical Position's GA4
	// key event ga4__lp_talk_direct matches on click + event_category telephone.
	// The label is the dialled number, so 310 and 888 taps can be told apart.
	d.addEventListener('click', function (e) {
		var a = e.target && e.target.closest ? e.target.closest('a[href^="tel:"]') : null;
		if (!a || typeof w.gtag !== 'function') { return; }
		if (readCookie(cfg.consentCookie) === 'rejected') { return; } // Rejected after this page loaded.
		w.gtag('event', 'click', {
			'event_category': 'telephone',
			'event_label': a.getAttribute('href').replace(/^tel:/, '')
		});
	}, true);
})(window, document, <?php echo wp_json_encode( $lapin_tracking ); ?>);
</script>
