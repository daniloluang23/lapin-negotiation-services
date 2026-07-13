<?php
/**
 * Design tokens + base layer + shared chrome (nav, footer, buttons, sections).
 *
 * The single source of truth for the site-wide look, per design.md at the
 * project root. Emits one inline <style> block (all-CSS-inline perf rule).
 * Page-specific section CSS stays inline on its own template.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( defined( 'LAPIN_TOKENS_EMITTED' ) ) {
	return;
}
define( 'LAPIN_TOKENS_EMITTED', true );
?>
<style>
/* Hallmark · genre: editorial · macrostructure: Marquee Hero (home) / Split Studio (services) / Long Document (content)
 * theme: custom · vibe: "institutional gravitas, navy and gold, treaty-signing" · paper: oklch(97.5% 0.008 85) · accent: #ffb703
 * display: Fraunces 650 · body: IBM Plex Sans · axes: light / roman-serif / chromatic-amber (~80°)
 * nav: N1b (links=5, dropdowns=1, always-solid) · footer: Ft1 (mast=logo-image, tagline=roman, links=inline)
 * design-system: design.md · designed-as-app · studied: no
 * contrast: pass (40–41) · slop: pass (42–45) · honest: pass (46) · chrome: pass (47)
 * tokens: pass (48) · responsive: pass (49) · icons: pass (30) · mobile: pass (34, 49, 50–57)
 * Hallmark · pre-emit critique: P4 H5 E4 S5 R4 V4
 */

/* ── Tokens ─────────────────────────────────────────────────────────── */
:root {
	--color-paper:       oklch(97.5% 0.008 85);
	--color-paper-2:     oklch(94.8% 0.012 85);
	--color-navy:        #023047;
	--color-navy-2:      oklch(36% 0.055 230);
	--color-ink:         oklch(25% 0.045 230);
	--color-ink-2:       oklch(40% 0.03 230);
	--color-ink-inverse: oklch(96% 0.012 85);
	--color-ink-inverse-2: oklch(84% 0.02 85);
	--color-muted:       oklch(48% 0.02 230);
	--color-rule:        oklch(86% 0.015 85);
	--color-rule-navy:   oklch(42% 0.045 230);
	--color-accent:      #ffb703;
	--color-accent-hover: oklch(79% 0.16 80);
	--color-accent-ink:  #023047;
	--color-focus:       oklch(58% 0.14 78);
	--color-error:       oklch(45% 0.17 25);
	--color-error-rule:  oklch(52% 0.19 25);
	--color-overlay:     oklch(25% 0.05 230 / 0.15);
	--grad-scrim:        linear-gradient(75deg, oklch(24% 0.06 230 / 0.94) 0%, oklch(24% 0.06 230 / 0.55) 55%, oklch(24% 0.06 230 / 0.25) 100%);
	--shadow-whisper:    0 1px 2px oklch(20% 0.01 230 / 0.05);

	--font-display: 'Fraunces', Georgia, 'Times New Roman', serif;
	--font-body: 'IBM Plex Sans', system-ui, -apple-system, 'Segoe UI', sans-serif;

	--space-3xs: 0.125rem; --space-2xs: 0.25rem; --space-xs: 0.5rem;
	--space-sm: 0.75rem;   --space-md: 1rem;     --space-lg: 1.5rem;
	--space-xl: 2.5rem;    --space-2xl: 4rem;    --space-3xl: 6rem;
	--space-4xl: 9rem;

	--text-sm: 0.8rem;     --text-base: 1rem;    --text-body: 1.0625rem;
	--text-md: 1.25rem;    --text-lg: 1.5625rem; --text-xl: 1.9531rem;
	--text-2xl: 2.4414rem; --text-3xl: 3.0518rem;
	--text-display: clamp(2.5rem, 4.5vw + 1rem, 4.75rem);
	--text-display-s: clamp(2rem, 3vw + 1rem, 3.25rem);

	--tracking-display: -0.02em;
	--tracking-label: 0.08em;

	--ease-out: cubic-bezier(0.16, 1, 0.3, 1);
	--ease-in: cubic-bezier(0.7, 0, 0.84, 0);
	--ease-in-out: cubic-bezier(0.65, 0, 0.35, 1);
	--dur-micro: 120ms; --dur-short: 220ms; --dur-long: 420ms;

	--radius-btn: 2px; --radius-card: 4px; --radius-input: 3px;

	--z-base: 1; --z-raised: 10; --z-dropdown: 100;
	--z-sticky: 200; --z-modal: 400; --z-toast: 500; --z-tooltip: 600;
}

/* ── Base ───────────────────────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; }
html, body { overflow-x: clip; }
html { scroll-behavior: smooth; }
@media (prefers-reduced-motion: reduce) { html { scroll-behavior: auto; } }
body {
	margin: 0;
	background: var(--color-paper);
	color: var(--color-ink);
	font-family: var(--font-body);
	font-size: var(--text-body);
	line-height: 1.6;
	-webkit-font-smoothing: antialiased;
	text-rendering: optimizeLegibility;
}
img, video { max-width: 100%; height: auto; display: block; }
h1, h2, h3, h4 {
	font-family: var(--font-display);
	font-weight: 650;
	font-style: normal;
	font-optical-sizing: auto;
	letter-spacing: var(--tracking-display);
	line-height: 1.12;
	color: var(--color-ink);
	margin: 0 0 var(--space-md);
	overflow-wrap: anywhere;
	min-width: 0;
}
p { margin: 0 0 var(--space-md); }
a { color: inherit; }
:focus-visible { outline: 2px solid var(--color-focus); outline-offset: 3px; border-radius: 3px; }
::selection { background: var(--color-accent); color: var(--color-accent-ink); }
section { scroll-margin-top: 5.5rem; }

.skip-link {
	position: absolute; left: -999px; top: 0; z-index: var(--z-tooltip);
	background: var(--color-navy); color: var(--color-ink-inverse);
	padding: var(--space-sm) var(--space-lg); text-decoration: none;
}
.skip-link:focus { left: 0; }

.wrap { max-width: 72rem; margin-inline: auto; padding-inline: clamp(1rem, 4vw, 2rem); }
.wrap--narrow { max-width: 52rem; }

/* ── Buttons ────────────────────────────────────────────────────────── */
.btn {
	display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;
	min-height: 2.75rem;
	font-family: var(--font-body); font-weight: 600; font-size: 0.9375rem;
	letter-spacing: 0.01em; white-space: nowrap; text-decoration: none;
	padding: 0.75rem 1.5rem; border-radius: var(--radius-btn);
	border: 1px solid transparent; line-height: 1; cursor: pointer;
	transition: background-color var(--dur-short) var(--ease-out),
	            border-color var(--dur-short) var(--ease-out),
	            color var(--dur-short) var(--ease-out),
	            transform 100ms var(--ease-out);
}
.btn:hover { transform: translateY(-1.5px); }
.btn:active { transform: translateY(1px); }
.btn[disabled], .btn[aria-disabled="true"] { opacity: 0.55; pointer-events: none; cursor: not-allowed; }
button[disabled] { opacity: 0.55; cursor: not-allowed; }
.btn--gold { background: var(--color-accent); color: var(--color-accent-ink); }
.btn--gold:hover { background: var(--color-accent-hover); }
.btn--outline { border-color: var(--color-ink); color: var(--color-ink); background: transparent; }
.btn--outline:hover { background: var(--color-ink); color: var(--color-paper); }
.btn--light { border-color: var(--color-ink-inverse); color: var(--color-ink-inverse); background: transparent; }
.btn--light:hover { background: var(--color-ink-inverse); color: var(--color-navy); }

/* ── Top bar + header (N1b, always-solid) ───────────────────────────── */
.topbar { background: var(--color-navy); color: var(--color-ink-inverse-2); font-size: var(--text-sm); }
.topbar .wrap { display: flex; align-items: center; justify-content: flex-end; gap: var(--space-lg); padding-block: var(--space-2xs); }
.topbar a { color: var(--color-ink-inverse); text-decoration: none; white-space: nowrap; }
.topbar a:hover { text-decoration: underline; text-underline-offset: 3px; text-decoration-color: var(--color-accent); }

.site-head { background: var(--color-paper); border-bottom: 1px solid var(--color-rule); }
.site-head .wrap { display: flex; align-items: center; gap: var(--space-xl); padding-block: var(--space-sm); }
.site-head__logo { flex-shrink: 0; display: block; }
.site-head__logo img { width: 170px; height: 60px; object-fit: contain; }
.nav { margin-left: auto; display: flex; align-items: center; gap: var(--space-lg); }
.nav__links { display: flex; align-items: center; gap: var(--space-lg); list-style: none; margin: 0; padding: 0; }
.nav__links > li { position: relative; }
.nav__links a {
	display: inline-block; padding: var(--space-xs) 0;
	font-size: 0.9375rem; font-weight: 500; color: var(--color-ink-2);
	text-decoration: none; white-space: nowrap;
	transition: color var(--dur-micro) var(--ease-out);
}
.nav__links a:hover, .nav__links a[aria-current="page"] {
	color: var(--color-ink);
	text-decoration: underline; text-decoration-color: var(--color-accent);
	text-decoration-thickness: 2px; text-underline-offset: 4px;
}
.nav__caret { display: inline-block; margin-left: 0.3em; font-size: 0.7em; transform: translateY(-1px); }
.nav__sub {
	position: absolute; top: 100%; left: 50%; transform: translateX(-50%) translateY(4px);
	min-width: 15rem; margin: 0; padding: var(--space-xs) 0; list-style: none;
	background: var(--color-paper); border: 1px solid var(--color-rule);
	box-shadow: var(--shadow-whisper);
	opacity: 0; visibility: hidden; z-index: var(--z-dropdown);
	transition: opacity 180ms var(--ease-out), transform 180ms var(--ease-out), visibility 0s linear 180ms;
}
.nav__links li:hover > .nav__sub,
.nav__links li:focus-within > .nav__sub {
	opacity: 1; visibility: visible; transform: translateX(-50%) translateY(0);
	transition: opacity 180ms var(--ease-out), transform 180ms var(--ease-out);
}
.nav__sub a { display: block; padding: var(--space-xs) var(--space-lg); }
.nav__sub a:hover { text-decoration: none; background: var(--color-paper-2); color: var(--color-ink); }
.nav__burger {
	display: none; background: none; border: 1px solid var(--color-rule);
	border-radius: var(--radius-btn); padding: 0.5rem 0.75rem; cursor: pointer; color: var(--color-ink);
	transition: border-color var(--dur-micro) var(--ease-out);
}
.nav__burger:hover { border-color: var(--color-ink-2); }
.nav__burger:active { transform: translateY(1px); }
.nav__burger svg { display: block; }

/* Mobile nav */
@media (max-width: 59.9375rem) {
	.topbar { display: none; }
	.nav__links { display: none; }
	.nav__burger { display: block; }
	.nav { gap: var(--space-sm); }
	.site-head__logo img { width: 142px; height: 50px; }
	.nav-panel[hidden] { display: none; }
	.nav-panel { border-bottom: 1px solid var(--color-rule); background: var(--color-paper); }
	.nav-panel ul { list-style: none; margin: 0; padding: var(--space-sm) 0; }
	.nav-panel a {
		display: block; padding: var(--space-sm) clamp(1rem, 4vw, 2rem);
		color: var(--color-ink); text-decoration: none; font-weight: 500;
	}
	.nav-panel a:hover { background: var(--color-paper-2); }
	.nav-panel .nav-panel__sub a { padding-left: calc(clamp(1rem, 4vw, 2rem) + 1.25rem); font-weight: 400; color: var(--color-ink-2); }
	.nav-panel__group { border-top: 1px solid var(--color-rule); margin-top: var(--space-xs); padding-top: var(--space-xs); }
	.nav-panel__label { display: block; padding: var(--space-xs) clamp(1rem, 4vw, 2rem) 0; font-size: var(--text-sm); letter-spacing: var(--tracking-label); text-transform: uppercase; color: var(--color-muted); }
}
@media (min-width: 60rem) { .nav-panel { display: none !important; } }
/* Compact header on the smallest phones (320–400px) */
@media (max-width: 25rem) {
	.site-head .wrap { gap: var(--space-sm); }
	.site-head__logo img { width: 118px; height: 42px; }
	.site-head .btn { padding: 0.7rem 0.9rem; font-size: 0.875rem; }
}

/* ── Sections ───────────────────────────────────────────────────────── */
.sec { padding-block: var(--space-3xl); }
.sec--tight { padding-block: var(--space-2xl); }
.band { background: var(--color-navy); color: var(--color-ink-inverse-2); }
.band h1, .band h2, .band h3 { color: var(--color-ink-inverse); }
.band p { color: var(--color-ink-inverse-2); }

.sec-head { margin-bottom: var(--space-xl); }
.sec-head h2 { font-size: var(--text-2xl); margin-bottom: var(--space-sm); }
.sec-head::after {
	content: ""; display: block; width: 3.5rem; height: 3px;
	background: var(--color-accent); margin-top: var(--space-sm);
}
.lead { font-size: var(--text-md); line-height: 1.55; color: var(--color-ink-2); max-width: 42ch; }
.band .lead { color: var(--color-ink-inverse-2); }
.prose { max-width: 65ch; }
.prose p { color: var(--color-ink-2); }
.hairline { border: 0; border-top: 1px solid var(--color-rule); margin: 0; }

/* ── Split diptych rows (service pages) ─────────────────────────────── */
.split { display: grid; grid-template-columns: minmax(0, 7fr) minmax(0, 5fr); gap: var(--space-2xl); align-items: center; }
.split--flip { grid-template-columns: minmax(0, 5fr) minmax(0, 7fr); }
.split--flip > :first-child { order: 2; }
.split__media img { width: min(100%, 24rem); margin-inline: auto; }
.split__media svg { width: min(60%, 13rem); height: auto; aspect-ratio: 1; display: block; margin-inline: auto; color: var(--color-navy); }
@media (max-width: 59.9375rem) {
	.split, .split--flip { grid-template-columns: minmax(0, 1fr); gap: var(--space-lg); }
	.split--flip > :first-child { order: 0; }
	.split__media img { width: min(60%, 16rem); margin-inline: 0; }
	.split__media svg { width: min(40%, 10rem); margin-inline: 0; }
}

/* ── Media wall (facades — no carousel, generous spacing) ───────────── */
.media-grid {
	display: grid; grid-template-columns: repeat(2, minmax(0, 1fr));
	column-gap: var(--space-2xl); row-gap: var(--space-2xl);
}
@media (max-width: 59.9375rem) { .media-grid { grid-template-columns: minmax(0, 1fr); row-gap: var(--space-xl); } }
.media-card { border-top: 1px solid var(--color-rule); padding-top: var(--space-lg); }
.media-card h3 { font-size: var(--text-md); line-height: 1.25; }
.media-card p { color: var(--color-ink-2); font-size: 0.9375rem; margin-bottom: 0; }
.media-card__body { margin-top: var(--space-md); }
.facade {
	position: relative; display: block; width: 100%; aspect-ratio: 16 / 9;
	padding: 0; border: 0; cursor: pointer; overflow: hidden;
	background: var(--color-navy); border-radius: var(--radius-card);
}
.facade img { width: 100%; height: 100%; object-fit: cover; opacity: 0.92; }
.facade::after {
	content: ""; position: absolute; inset: 0;
	background: var(--color-overlay);
	transition: opacity var(--dur-short) var(--ease-out);
}
.facade:hover::after { opacity: 0; }
.facade__play {
	position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
	width: 4rem; height: 4rem; border-radius: 50%;
	background: var(--color-accent); color: var(--color-accent-ink);
	display: grid; place-items: center; z-index: var(--z-raised);
	transition: transform var(--dur-short) var(--ease-out);
}
.facade:hover .facade__play { transform: translate(-50%, -50%) scale(1.06); }
.facade:active .facade__play { transform: translate(-50%, -50%) scale(0.97); }
.facade iframe, .media-embed iframe { width: 100%; height: 100%; border: 0; display: block; }
.media-embed { aspect-ratio: 16 / 9; }
.media-embed--audio { aspect-ratio: auto; height: 166px; }
.audio-native { width: 100%; margin-top: var(--space-xs); }
.sc-load {
	display: flex; align-items: center; justify-content: center; gap: 0.5rem;
	width: 100%; height: 9rem; border: 1px solid var(--color-rule);
	border-radius: var(--radius-card); background: var(--color-paper-2);
	font: 600 0.9375rem var(--font-body); color: var(--color-ink); cursor: pointer;
	transition: border-color var(--dur-short) var(--ease-out), background-color var(--dur-short) var(--ease-out);
}
.sc-load:hover { border-color: var(--color-ink-2); background: var(--color-paper); }
.sc-load:active { transform: translateY(1px); }

/* ── Sub-page hero band ─────────────────────────────────────────────── */
.page-hero { background: var(--color-navy); border-bottom: 3px solid var(--color-accent); }
.page-hero .wrap { padding-block: var(--space-2xl) var(--space-xl); }
.page-hero h1 { font-size: var(--text-3xl); color: var(--color-ink-inverse); max-width: 20ch; margin-bottom: var(--space-xs); }
.page-hero p { color: var(--color-ink-inverse-2); margin: 0; max-width: 55ch; }

/* ── CTA band ───────────────────────────────────────────────────────── */
.cta-band { background: var(--color-navy); }
.cta-band .wrap { padding-block: var(--space-2xl); }
.cta-band h2 { font-size: var(--text-display-s); max-width: 22ch; margin-bottom: var(--space-sm); }
.cta-band p { margin-bottom: var(--space-lg); }
.cta-band__actions { display: flex; align-items: center; flex-wrap: wrap; gap: var(--space-md); }

/* ── Forms ──────────────────────────────────────────────────────────── */
.field { margin-bottom: var(--space-lg); }
.field label { display: block; font-weight: 600; font-size: 0.9375rem; margin-bottom: var(--space-2xs); }
.field input, .field textarea {
	width: 100%; min-height: 2.75rem; padding: 0.75rem 1rem;
	font: 400 var(--text-base) var(--font-body); color: var(--color-ink);
	background: var(--color-paper); border: 1px solid var(--color-rule);
	border-radius: var(--radius-input);
	transition: border-color var(--dur-micro) var(--ease-out);
}
.field input:hover, .field textarea:hover { border-color: var(--color-ink-2); }
.field input:focus-visible, .field textarea:focus-visible { outline: 2px solid var(--color-focus); outline-offset: 1px; border-color: var(--color-focus); }
.field input[disabled], .field textarea[disabled] { opacity: 0.55; cursor: not-allowed; }
.field--error input, .field--error textarea { border-color: var(--color-error-rule); }
.field__error { display: flex; gap: var(--space-xs); align-items: baseline; color: var(--color-error); font-size: var(--text-sm); margin-top: var(--space-2xs); }
.form-note { padding: var(--space-md) var(--space-lg); border: 1px solid var(--color-rule); background: var(--color-paper-2); margin-bottom: var(--space-lg); }
.form-note--error { border-color: var(--color-error-rule); color: var(--color-error); }
.hp-field { position: absolute; left: -999px; width: 1px; height: 1px; overflow: hidden; }

/* ── Footer (Ft1 mast-headed, navy) ─────────────────────────────────── */
.foot { background: var(--color-navy); color: var(--color-ink-inverse-2); font-size: 0.9375rem; }
.foot .wrap { padding-block: var(--space-2xl) var(--space-xl); }
.foot__mast { display: flex; flex-wrap: wrap; align-items: center; gap: var(--space-xl); padding-bottom: var(--space-xl); border-bottom: 1px solid var(--color-rule-navy); }
.foot__mast img { width: 220px; height: 78px; object-fit: contain; }
.foot__tagline { font-family: var(--font-display); font-size: var(--text-md); color: var(--color-ink-inverse); margin: 0; }
.foot__cols { display: flex; flex-wrap: wrap; gap: var(--space-2xl); padding-block: var(--space-xl); }
.foot__nav ul { list-style: none; margin: 0; padding: 0; display: grid; gap: var(--space-xs); }
.foot a { color: var(--color-ink-inverse); text-decoration: none; }
.foot a:hover { text-decoration: underline; text-decoration-color: var(--color-accent); text-underline-offset: 3px; }
.foot__label { display: block; font-size: var(--text-sm); letter-spacing: var(--tracking-label); text-transform: uppercase; color: var(--color-ink-inverse-2); margin-bottom: var(--space-sm); }
.foot__contact p { margin-bottom: var(--space-xs); }
.foot__social { display: flex; gap: var(--space-md); }
.foot__social a { display: grid; place-items: center; width: 2.5rem; height: 2.5rem; border: 1px solid var(--color-rule-navy); border-radius: 50%; transition: border-color var(--dur-short) var(--ease-out), color var(--dur-short) var(--ease-out); color: var(--color-ink-inverse); }
.foot__social a:hover { border-color: var(--color-accent); color: var(--color-accent); text-decoration: none; }
.foot__legal { border-top: 1px solid var(--color-rule-navy); padding-top: var(--space-md); font-size: var(--text-sm); color: var(--color-ink-inverse-2); display: flex; flex-wrap: wrap; gap: var(--space-md); justify-content: space-between; }

/* ── Motion ─────────────────────────────────────────────────────────── */
@keyframes lapin-reveal { to { opacity: 1; transform: none; } }
.reveal { opacity: 0; transform: translateY(8px); animation: lapin-reveal var(--dur-long) var(--ease-out) forwards; animation-delay: calc(var(--i, 0) * 90ms); }
@media (prefers-reduced-motion: reduce) {
	*, *::before, *::after {
		animation-duration: 150ms !important;
		animation-iteration-count: 1 !important;
		transition-duration: 150ms !important;
	}
	.reveal { animation: lapin-reveal 150ms linear forwards; transform: none; }
	.btn:hover, .btn:active { transform: none; }
}
</style>
