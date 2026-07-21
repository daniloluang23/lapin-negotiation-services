<?php
/**
 * Design tokens + base layer + shared chrome (masthead, nav, footer, buttons,
 * sections, cards, forms, motion).
 *
 * The single source of truth for the site-wide look, per design.md v2 at the
 * project root (studied-DNA redesign, 2026-07-14). Emits one inline <style>
 * block (all-CSS-inline perf rule). Page-specific section CSS stays inline on
 * its own template.
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
/* Hallmark · macrostructure: Marquee Hero split (home) / Split Studio (services) / Long Document (content)
 * theme: studied-DNA (source: url https://stg-lapinnegotiationservices-staging.kinsta.cloud/ — client's own staging site + client mockups 2026-07-19)
 * paper oklch(98.2% 0.005 80) · onyx #49494B · accent rose-gold #BD8C7D ≤5% · soft-gold #D1BFA7 · silver #8E8E90
 * display: DM Sans 700 (roman) · body: Poppins 400/600 · axes: light / geometric-sans / warm-rose (~35°)
 * nav: N1b three-section on onyx masthead (staging DNA; rotation suspended; no blog) · footer: Ft3-index 4-col + newsletter (staging DNA)
 * signature: recolored bridge raster on every masthead (home: claude-design handoff hero — masked right 66%; subpages: full-bleed, dimmed 0.55, top-fade) · design-system: design.md v2.3 · studied: yes
 * contrast: pass (40-41) · slop: pass (42-45) · honest: pass (46) · chrome: pass (47) · tokens: pass (48)
 * responsive: pass (34, 49-57) · icons: pass (30)
 * Hallmark · pre-emit critique: P4 H5 E4 S5 R4 V4
 */

/* ── Tokens ─────────────────────────────────────────────────────────── */
:root {
	--color-paper:         oklch(98.2% 0.005 80);
	--color-paper-2:       #F3ECE1;
	--color-onyx:          #49494B;
	--color-onyx-2:        oklch(30% 0.006 300);
	--color-onyx-deep:     oklch(24% 0.008 300);
	--color-onyx-deeper:   oklch(19% 0.008 300);
	--color-onyx-warm:     oklch(28% 0.02 330);
	--color-glow:          oklch(34% 0.035 55 / 0.5);
	--color-rule-onyx-soft: oklch(42% 0.012 300 / 0.5);
	--color-ink:           oklch(28% 0.01 300);
	--color-ink-2:         oklch(42% 0.01 300);
	--color-ink-inverse:   oklch(96.5% 0.008 80);
	--color-ink-inverse-2: #D1BFA7;
	--color-muted:         #8E8E90;
	--color-rule:          oklch(88% 0.015 80);
	--color-rule-onyx:     oklch(42% 0.012 300);
	--color-accent:        #BD8C7D;
	--color-accent-strong: oklch(44% 0.075 35);
	--color-accent-deep:   oklch(38% 0.075 35);
	--color-gold:          #D1BFA7;
	--color-gold-hover:    oklch(84% 0.055 85);
	--color-star:          oklch(72% 0.145 75);
	--color-badge:         oklch(45% 0.09 165);
	--color-on-accent:     #ffffff;
	--color-focus:         oklch(55% 0.1 40);
	--color-error:         oklch(45% 0.17 25);
	--color-error-rule:    oklch(52% 0.19 25);
	--color-overlay:       oklch(28% 0.01 300 / 0.18);
	/* Home-hero palette (claude-design handoff 2026-07-20). */
	--color-hero-deep:     #161418;
	--color-hero-mid:      #241D21;
	--color-hero-warm:     #2F262B;
	--color-hero-title:    #F4F0E9;
	--color-hero-text:     #E8E4DD;
	--color-hero-muted:    #A9A49B;
	--color-hero-onyx:     #17171A;
	--color-accent-hover:  #A97968;
	--color-strip:         #141416;
	--shadow-whisper:      0 1px 2px oklch(20% 0.01 300 / 0.06);
	--shadow-card:         0 10px 28px -14px oklch(20% 0.02 300 / 0.35);

	--font-display: 'DM Sans', system-ui, -apple-system, 'Segoe UI', sans-serif;
	--font-body: 'Poppins', system-ui, -apple-system, 'Segoe UI', sans-serif;

	--space-3xs: 0.125rem; --space-2xs: 0.25rem; --space-xs: 0.5rem;
	--space-sm: 0.75rem;   --space-md: 1rem;     --space-lg: 1.5rem;
	--space-xl: 2.5rem;    --space-2xl: 4rem;    --space-3xl: 6rem;
	--space-4xl: 9rem;

	--text-sm: 0.8rem;     --text-base: 1rem;    --text-body: 1.0313rem;
	--text-md: 1.25rem;    --text-lg: 1.5625rem; --text-xl: 1.9531rem;
	--text-2xl: 2.4414rem; --text-3xl: 3.0518rem;
	--text-display: clamp(2.5rem, 4vw + 1rem, 4.25rem);
	--text-display-s: clamp(2rem, 3vw + 1rem, 3.25rem);

	--tracking-display: -0.015em;
	--tracking-label: 0.14em;

	--ease-out: cubic-bezier(0.16, 1, 0.3, 1);
	--ease-in: cubic-bezier(0.7, 0, 0.84, 0);
	--ease-in-out: cubic-bezier(0.65, 0, 0.35, 1);
	--dur-micro: 120ms; --dur-short: 220ms; --dur-long: 480ms;

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
	line-height: 1.7;
	-webkit-font-smoothing: antialiased;
	text-rendering: optimizeLegibility;
}
img, video { max-width: 100%; height: auto; display: block; }
h1, h2, h3, h4 {
	font-family: var(--font-display);
	font-weight: 700;
	font-style: normal;
	font-optical-sizing: auto;
	letter-spacing: var(--tracking-display);
	line-height: 1.14;
	color: var(--color-ink);
	margin: 0 0 var(--space-md);
	overflow-wrap: anywhere;
	min-width: 0;
}
p { margin: 0 0 var(--space-md); }
strong, b { font-weight: 600; }
a { color: inherit; }
:focus-visible { outline: 2px solid var(--color-focus); outline-offset: 3px; border-radius: 3px; }
.band :focus-visible, .masthead :focus-visible, .foot :focus-visible { outline-color: var(--color-gold); }
::selection { background: var(--color-accent); color: var(--color-on-accent); }
section { scroll-margin-top: 5.5rem; }

.skip-link {
	position: absolute; left: -999px; top: 0; z-index: var(--z-tooltip);
	background: var(--color-onyx); color: var(--color-ink-inverse);
	padding: var(--space-sm) var(--space-lg); text-decoration: none;
}
.skip-link:focus { left: 0; }
.vh { position: absolute; width: 1px; height: 1px; margin: -1px; padding: 0; overflow: hidden; clip-path: inset(50%); white-space: nowrap; border: 0; }

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
/* Primary on dark bands: brand soft gold, onyx text (5:1). */
.btn--gold { background: var(--color-gold); color: var(--color-onyx); }
.btn--gold:hover { background: var(--color-gold-hover); }
/* Primary on paper: deep rose gold, white text (≥4.5:1). */
.btn--rose { background: var(--color-accent-strong); color: var(--color-on-accent); }
.btn--rose:hover { background: var(--color-accent-deep); }
.btn--outline { border-color: var(--color-ink); color: var(--color-ink); background: transparent; }
.btn--outline:hover { background: var(--color-ink); color: var(--color-paper); }
.btn--light { border-color: var(--color-ink-inverse); color: var(--color-ink-inverse); background: transparent; }
.btn--light:hover { background: var(--color-ink-inverse); color: var(--color-onyx); }
/* Outlined chip in the brand metallics (nav CTA, per concept). */
.btn--gold-line { border-color: var(--color-gold); color: var(--color-gold); background: transparent; }
.btn--gold-line:hover { background: var(--color-gold); color: var(--color-onyx); }

/* ── Masthead: topbar + nav + bridge hero on one onyx canvas ────────── */
.masthead {
	/* clip, not hidden: a focus jump must never scroll the masthead canvas */
	position: relative; overflow: clip;
	/* Concept direction: near-black canvas warming toward the bridge glow. */
	background:
		radial-gradient(90rem 42rem at 62% 88%, var(--color-glow), transparent 65%),
		linear-gradient(168deg, var(--color-onyx-deeper) 0%, var(--color-onyx-deep) 55%, var(--color-onyx-warm) 100%);
	color: var(--color-ink-inverse);
	border-bottom: 3px solid var(--color-accent);
}
/* Subpage full-bleed bridge layer (same asset as the home hero), dimmed so
   topbar/nav/hero text keep contrast; top fade keeps the topbar on clean onyx. */
.masthead__art {
	position: absolute; inset: 0; width: 100%; height: 100%;
	object-fit: cover; object-position: 60% 45%;
	opacity: 0.55; pointer-events: none;
	-webkit-mask-image: linear-gradient(to bottom, transparent 0%, #000 40%);
	mask-image: linear-gradient(to bottom, transparent 0%, #000 40%);
}
.masthead > .topbar, .masthead > .nav-panel, .masthead > .hero {
	position: relative; z-index: var(--z-raised);
}
/* The header row must out-stack the hero (a later sibling), or the Services
   dropdown loses pointer hover where it overlaps the hero block. */
.masthead > .site-head { position: relative; z-index: var(--z-dropdown); }

.topbar { font-size: var(--text-sm); border-bottom: 1px solid var(--color-rule-onyx-soft); }
.topbar .wrap { display: flex; align-items: center; justify-content: flex-end; gap: var(--space-lg); padding-block: var(--space-2xs); }
.topbar a { color: var(--color-ink-inverse-2); text-decoration: none; white-space: nowrap; }
.topbar a:hover { color: var(--color-ink-inverse); text-decoration: underline; text-underline-offset: 3px; text-decoration-color: var(--color-accent); }

.site-head .wrap { display: flex; align-items: center; gap: var(--space-xl); padding-block: var(--space-md); }
/* Client direction: the logo is the brand — bigger, prominent. */
.site-head__logo { flex-shrink: 0; display: block; }
.site-head__logo img { width: 260px; height: 92px; object-fit: contain; }
.nav { margin-left: auto; display: flex; align-items: center; gap: var(--space-lg); }
.nav__links { display: flex; align-items: center; gap: var(--space-lg); list-style: none; margin: 0; padding: 0; }
.nav__links > li { position: relative; }
.nav__links a {
	display: inline-block; padding: var(--space-xs) 0;
	font-size: 0.9375rem; font-weight: 500; color: var(--color-ink-inverse);
	text-decoration: none; white-space: nowrap;
	transition: color var(--dur-micro) var(--ease-out);
}
.nav__links a:hover, .nav__links a[aria-current="page"] {
	color: var(--color-gold);
	text-decoration: underline; text-decoration-color: var(--color-accent);
	text-decoration-thickness: 2px; text-underline-offset: 6px;
}
.nav__caret { display: inline-block; margin-left: 0.3em; font-size: 0.7em; transform: translateY(-1px); }
.nav__sub {
	position: absolute; top: 100%; left: 50%; transform: translateX(-50%) translateY(4px);
	min-width: 15rem; margin: 0; padding: var(--space-xs) 0; list-style: none;
	background: var(--color-onyx-2); border: 1px solid var(--color-rule-onyx);
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
.nav__sub a:hover { text-decoration: none; background: var(--color-onyx); color: var(--color-gold); }
.nav__burger {
	display: none; background: none; border: 1px solid var(--color-rule-onyx);
	border-radius: var(--radius-btn); padding: 0.5rem 0.75rem; cursor: pointer; color: var(--color-ink-inverse);
	transition: border-color var(--dur-micro) var(--ease-out);
}
.nav__burger:hover { border-color: var(--color-gold); }
.nav__burger:active { transform: translateY(1px); }
.nav__burger svg { display: block; }

/* Mobile nav */
@media (max-width: 63.9375rem) {
	.topbar .wrap { justify-content: center; gap: var(--space-md); }
	.topbar .topbar__email { display: none; }
	.nav__links { display: none; }
	.nav__burger { display: block; }
	.nav { gap: var(--space-sm); }
	.site-head__logo img { width: 200px; height: 71px; }
	.nav-panel[hidden] { display: none; }
	.nav-panel { border-top: 1px solid var(--color-rule-onyx); background: var(--color-onyx-2); }
	.nav-panel ul { list-style: none; margin: 0; padding: var(--space-sm) 0; }
	.nav-panel a {
		display: block; padding: var(--space-sm) clamp(1rem, 4vw, 2rem);
		color: var(--color-ink-inverse); text-decoration: none; font-weight: 500;
	}
	.nav-panel a:hover { background: var(--color-onyx); color: var(--color-gold); }
	.nav-panel .nav-panel__sub a { padding-left: calc(clamp(1rem, 4vw, 2rem) + 1.25rem); font-weight: 400; color: var(--color-ink-inverse-2); }
	.nav-panel__group { border-top: 1px solid var(--color-rule-onyx); margin-top: var(--space-xs); padding-top: var(--space-xs); }
	.nav-panel__label { display: block; padding: var(--space-xs) clamp(1rem, 4vw, 2rem) 0; font-size: var(--text-sm); font-weight: 600; letter-spacing: var(--tracking-label); text-transform: uppercase; color: var(--color-ink-inverse-2); }
}
@media (min-width: 64rem) { .nav-panel { display: none !important; } }
/* Compact header on small phones: the CTA moves into the menu panel. */
.nav-panel__cta { padding: var(--space-sm) clamp(1rem, 4vw, 2rem) var(--space-xs); }
@media (min-width: 30.0625rem) { .nav-panel__cta { display: none; } }
@media (max-width: 30rem) {
	.site-head .wrap { gap: var(--space-sm); }
	.site-head__logo img { width: 176px; height: 62px; }
	.site-head > .wrap > .nav > .btn { display: none; }
}

/* ── Hero (inside the masthead, over the bridge art) ────────────────── */
/* Soft scrim so the bridge line work never reads as a strikethrough
   behind the hero text (it fades the art in the text zone only). */
.hero::before {
	content: ""; position: absolute; inset: 0; z-index: -1; pointer-events: none;
	background: radial-gradient(70rem 26rem at 22% 45%, oklch(19% 0.008 300 / 0.7), transparent 62%);
}
.hero .wrap { padding-block: var(--space-2xl) var(--space-3xl); }
/* Home hero, compressed from the handoff's 96/120px so the hero + stats strip
   fit a 1080p first viewport (client request 2026-07-20). */
.hero--home .wrap { padding-block: var(--space-2xl) var(--space-2xl); }
.hero__eyebrow {
	display: block; font-size: var(--text-sm); font-weight: 600;
	letter-spacing: var(--tracking-label); text-transform: uppercase;
	color: var(--color-accent); margin-bottom: var(--space-md);
}
.hero h1 { color: var(--color-ink-inverse); margin: 0; }
/* Home: claude-design handoff (2026-07-20) — big two-line display H1 in a
   640px left column over the right-side recolored bridge layer. */
.hero--home h1 {
	font-size: var(--text-display); font-weight: 800; line-height: 1.02;
	letter-spacing: -0.013em; color: var(--color-hero-title);
}
.hero__line { display: block; }
/* Client request 2026-07-21: second tagline line in gold, first stays light. */
.hero__line--gold { color: var(--color-gold); }
.hero--home .hero__copy { max-width: 40rem; }
.hero__divider {
	display: block; width: 0.875rem; height: 0.875rem;
	margin: var(--space-lg) 0 var(--space-lg) var(--space-2xs); background: var(--color-accent);
	/* clip-path, not transform: the .reveal keyframe ends at transform:none. */
	clip-path: polygon(50% 0, 100% 50%, 50% 100%, 0 50%);
}
.hero__lead {
	font-family: var(--font-display); font-weight: 700; font-size: var(--text-lg);
	line-height: 1.3; color: var(--color-hero-text); margin: 0 0 var(--space-sm);
}
.hero__sub {
	font-size: var(--text-md); line-height: 1.6; color: var(--color-ink-inverse-2);
	max-width: 52ch; margin: var(--space-lg) 0 0;
}
.hero--home .hero__sub {
	font-size: var(--text-md); line-height: 1.55; color: var(--color-hero-muted);
	max-width: 29rem; margin-top: 0;
}
.hero__actions { display: flex; flex-wrap: wrap; align-items: center; gap: var(--space-md); margin-top: var(--space-xl); }
.hero--home .btn {
	padding: 1.0625rem 1.875rem; font-size: var(--text-base); font-weight: 700;
	border-radius: var(--radius-card);
}
.hero--home .btn--rose { background: var(--color-accent); color: var(--color-hero-onyx); }
.hero--home .btn--rose:hover { background: var(--color-accent-hover); }
.hero--home .btn--light { border-color: #6F6F72; color: var(--color-hero-text); }
/* Home only (claude-design handoff): the masthead swaps to a right-warming
   gradient canvas; the recolored bridge artwork covers the hero's right 66%,
   its left edge masked to fade clear of the headline, with a left scrim above
   it. Subpages render the same artwork full-bleed via .masthead__art
   (the header partial skips that img on home). */
.page-home .masthead {
	background: linear-gradient(to right, var(--color-hero-deep) 0%, var(--color-hero-mid) 55%, var(--color-hero-warm) 100%);
	border-bottom: 0;
}
.hero__bridge {
	position: absolute; top: 0; right: 0; width: 66%; height: 100%;
	object-fit: cover; object-position: 60% 45%; pointer-events: none;
	/* Handoff's left fade, intersected with a top fade so the layer's upper
	   edge never reads as a seam under the nav. -webkit- fallback: left only. */
	-webkit-mask-image: linear-gradient(to right, transparent 0%, rgb(0 0 0 / 0.4) 22%, #000 55%);
	mask-image: linear-gradient(to right, transparent 0%, rgb(0 0 0 / 0.4) 22%, #000 55%), linear-gradient(to bottom, transparent 0%, #000 22%);
	mask-composite: intersect;
}
/* The home scrim sits ABOVE the bridge layer (subpages keep z:-1 radial). */
.hero--home::before {
	z-index: 1;
	background: linear-gradient(to right, var(--color-hero-deep) 20%, rgb(22 20 24 / 0.55) 48%, transparent 72%);
}
.hero--home .wrap { position: relative; z-index: 2; }
@media (max-width: 63.9375rem) {
	.hero--home .hero__copy { max-width: none; }
	/* Client note 2026-07-21: the bridge should pop on mobile too. The copy
	   occupies the upper 2/3, so ramp the art in vertically — faint behind
	   the headline, near-full behind the CTA row — instead of muting it all. */
	.hero__bridge {
		width: 100%; opacity: 0.85;
		-webkit-mask-image: linear-gradient(to bottom, transparent 0%, rgb(0 0 0 / 0.4) 35%, #000 72%);
		mask-image: linear-gradient(to bottom, transparent 0%, rgb(0 0 0 / 0.4) 35%, #000 72%);
		mask-composite: add;
	}
	.hero--home::before { background: linear-gradient(to bottom, rgb(22 20 24 / 0.8) 0%, rgb(22 20 24 / 0.5) 45%, rgb(22 20 24 / 0.12) 100%); }
}
.hero--page .wrap { padding-block: var(--space-2xl) var(--space-2xl); }
.hero--page h1 { font-size: var(--text-3xl); max-width: 24ch; }
.hero--page .hero__sub { font-size: var(--text-base); margin-top: var(--space-sm); }
@media (max-width: 63.9375rem) {
	.hero .wrap { padding-block: var(--space-xl) var(--space-2xl); }
}

/* ── Sections ───────────────────────────────────────────────────────── */
.sec { padding-block: var(--space-3xl); }
.sec--tight { padding-block: var(--space-2xl); }
.band { background: var(--color-onyx); color: var(--color-ink-inverse-2); }
.band h1, .band h2, .band h3 { color: var(--color-ink-inverse); }
.band p { color: var(--color-ink-inverse-2); }
.band--cream { background: var(--color-paper-2); color: var(--color-ink); }
.band--cream h2, .band--cream h3 { color: var(--color-ink); }
.band--cream p { color: var(--color-ink-2); }

.sec-head { margin-bottom: var(--space-xl); }
/* Eyebrow stacked above its heading, same column (staging voice). */
.sec-head__eyebrow {
	display: block; font-size: var(--text-sm); font-weight: 600;
	letter-spacing: var(--tracking-label); text-transform: uppercase;
	color: var(--color-accent-strong); margin-bottom: var(--space-xs);
}
.band .sec-head__eyebrow { color: var(--color-gold); }
.sec-head h2 { font-size: var(--text-2xl); margin-bottom: var(--space-sm); }
.sec-head::after {
	content: ""; display: block; width: 3.5rem; height: 3px;
	background: var(--color-accent); margin-top: var(--space-sm);
}
.lead { font-size: var(--text-md); line-height: 1.55; color: var(--color-ink-2); max-width: none; }
.band .lead { color: var(--color-ink-inverse-2); }
.prose { max-width: none; }
.prose p { color: var(--color-ink-2); }
.hairline { border: 0; border-top: 1px solid var(--color-rule); margin: 0; }

/* ── Split rows (service pages) ─────────────────────────────────────── */
.split, .split--flip { display: grid; grid-template-columns: minmax(0, 65fr) minmax(0, 35fr); gap: var(--space-2xl); align-items: center; }
.split--flip > :first-child { order: 2; }
.split__media img { width: min(100%, 22rem); margin-inline: auto; }
.split__media svg { width: min(70%, 13rem); height: auto; aspect-ratio: 1; display: block; margin-inline: auto; color: var(--color-accent); }
@media (max-width: 63.9375rem) {
	.split, .split--flip { grid-template-columns: minmax(0, 1fr); gap: var(--space-lg); }
	.split--flip > :first-child { order: 0; }
	.split__media img { width: min(60%, 16rem); margin-inline: 0; }
	.split__media svg { width: min(40%, 10rem); margin-inline: 0; }
}

/* ── Media wall (facades — no carousel) ─────────────────────────────── */
.media-grid {
	display: grid; grid-template-columns: repeat(2, minmax(0, 1fr));
	column-gap: var(--space-2xl); row-gap: var(--space-2xl);
}
@media (max-width: 63.9375rem) { .media-grid { grid-template-columns: minmax(0, 1fr); row-gap: var(--space-xl); } }
.media-card { border-top: 1px solid var(--color-rule); padding-top: var(--space-lg); scroll-margin-top: var(--space-xl); }
.media-card h3 { font-size: var(--text-md); line-height: 1.3; }
.media-card p { color: var(--color-ink-2); font-size: 0.9375rem; margin-bottom: 0; }
.media-card__body { margin-top: var(--space-md); }
.facade {
	position: relative; display: block; width: 100%; aspect-ratio: 16 / 9;
	padding: 0; border: 0; cursor: pointer; overflow: hidden;
	background: var(--color-onyx); border-radius: var(--radius-card);
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
	background: var(--color-gold); color: var(--color-onyx);
	display: grid; place-items: center; z-index: var(--z-raised);
	transition: transform var(--dur-short) var(--ease-out);
}
.facade:hover .facade__play { transform: translate(-50%, -50%) scale(1.06); }
.facade:active .facade__play { transform: translate(-50%, -50%) scale(0.97); }
.facade iframe, .media-embed iframe { width: 100%; height: 100%; border: 0; display: block; }
.media-embed { aspect-ratio: 16 / 9; }
.media-embed--audio { aspect-ratio: auto; height: 166px; }
.audio-native { width: 100%; margin-top: var(--space-xs); }
/* Audio facades: same-ratio bridge-motif panel as the video thumbs, still
   click-to-load (ties the podcasts to the masthead art — client request). */
.facade--audio {
	background:
		radial-gradient(26rem 14rem at 50% 88%, var(--color-glow), transparent 70%),
		linear-gradient(168deg, var(--color-onyx-deeper) 0%, var(--color-onyx-deep) 55%, var(--color-onyx-warm) 100%);
}
.facade--audio .facade__art {
	position: absolute; inset: auto 0 0 0; width: 100%; height: 82%;
	opacity: 0.55; transition: opacity var(--dur-short) var(--ease-out);
}
.facade--audio:hover .facade__art { opacity: 0.7; }
.facade__label {
	position: absolute; left: 0; right: 0; bottom: var(--space-md); z-index: var(--z-raised);
	font: 600 var(--text-sm) var(--font-body); letter-spacing: 0.06em; text-transform: uppercase;
	color: var(--color-ink-inverse-2); text-align: center; padding-inline: var(--space-md);
}

/* ── Testimonials (Google reviews) ──────────────────────────────────── */
.reviews-head { text-align: center; }
.reviews-head::after { margin-inline: auto; }
/* Static grid of review cards — 3×2 desktop, 2-up tablet, 1-up phones
   (real reviews run 90–700+ chars; two phone columns would be unreadable). */
.reviews-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-lg); align-items: stretch; }
@media (max-width: 63.9375rem) { .reviews-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
@media (max-width: 40rem) { .reviews-grid { grid-template-columns: minmax(0, 1fr); } }
.review-card {
	background: var(--color-paper); border: 1px solid var(--color-rule);
	border-radius: var(--radius-card); box-shadow: var(--shadow-whisper);
	padding: var(--space-lg); display: flex; flex-direction: column; gap: var(--space-sm);
}
.review-card__head { display: flex; align-items: center; gap: var(--space-sm); }
.review-card__avatar {
	display: grid; place-items: center; width: 2.75rem; height: 2.75rem; flex-shrink: 0;
	border-radius: 50%; background: var(--color-paper-2); color: var(--color-accent-strong);
	font-weight: 600; font-size: var(--text-md); text-transform: uppercase;
}
.review-card__head strong { display: block; font-size: 0.9375rem; line-height: 1.3; }
.review-card__head span:not(.review-card__avatar) { display: block; font-size: var(--text-sm); color: var(--color-ink-2); }
.review-card__stars { display: flex; gap: 0.2rem; color: var(--color-star); }
.review-card__stars svg { width: 1.05rem; height: 1.05rem; }
.review-card p { color: var(--color-ink-2); font-size: 0.9375rem; margin: 0; }
/* JS adds the clamp, so no-JS visitors always see the full review. */
.review-card p.is-clamped {
	display: -webkit-box; -webkit-line-clamp: 6; -webkit-box-orient: vertical; overflow: hidden;
}
.review-card__more {
	align-self: flex-start; background: none; border: 0; padding: 0; cursor: pointer;
	font: 600 var(--text-sm) var(--font-body); color: var(--color-accent-strong);
	text-decoration: underline; text-decoration-color: var(--color-accent);
	text-decoration-thickness: 2px; text-underline-offset: 3px;
}
.review-card__more:hover { color: var(--color-accent-deep); }
.review-card__via { margin-top: auto; padding-top: var(--space-2xs); font-size: var(--text-sm); color: var(--color-muted); font-weight: 600; }
/* Summary band under the grid: stars + client-supplied count + Google link. */
.reviews-band { display: flex; flex-direction: column; align-items: center; gap: var(--space-sm); text-align: center; margin-top: var(--space-xl); }
.reviews-band__stars { display: flex; gap: 0.2rem; color: var(--color-star); }
.reviews-band__stars svg { width: 1.35rem; height: 1.35rem; }
.reviews-band strong { font-family: var(--font-display); font-weight: 700; font-size: var(--text-md); letter-spacing: var(--tracking-display); color: var(--color-ink); }
.reviews-link { font-weight: 600; text-decoration: underline; text-decoration-color: var(--color-accent); text-decoration-thickness: 2px; text-underline-offset: 3px; }
.reviews-link:hover { color: var(--color-accent-strong); }
.ti-badge {
	display: inline-flex; align-items: center; gap: 0.4rem;
	background: var(--color-badge); color: var(--color-on-accent);
	font-size: var(--text-sm); font-weight: 600; padding: 0.35rem 0.75rem;
	border-radius: var(--radius-btn); text-decoration: none;
}
.ti-badge:hover { text-decoration: underline; text-underline-offset: 3px; }

/* ── Client logo marquee — contained in the content column, soft edge
      fade (client direction: never full-bleed) ──────────────────────── */
.marquee {
	overflow: hidden; position: relative;
	-webkit-mask-image: linear-gradient(90deg, transparent, black 7%, black 93%, transparent);
	mask-image: linear-gradient(90deg, transparent, black 7%, black 93%, transparent);
}
.marquee__track {
	display: flex; align-items: center; gap: var(--space-2xl);
	width: max-content;
	animation: lapin-marquee 36s linear infinite;
}
.marquee:hover .marquee__track, .marquee:focus-within .marquee__track { animation-play-state: paused; }
@keyframes lapin-marquee { to { transform: translateX(-50%); } }
@media (prefers-reduced-motion: reduce) {
	.marquee__track { animation: none; width: auto; flex-wrap: wrap; gap: var(--space-xl) var(--space-2xl); justify-content: center; }
	.marquee__track > [aria-hidden="true"] { display: none; }
}

/* ── CTA band ───────────────────────────────────────────────────────── */
.cta-band { background: var(--color-onyx); }
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
.field input:hover, .field textarea:hover { border-color: var(--color-accent); }
.field input:focus-visible, .field textarea:focus-visible { outline: 2px solid var(--color-focus); outline-offset: 1px; border-color: var(--color-focus); }
.field input[disabled], .field textarea[disabled] { opacity: 0.55; cursor: not-allowed; }
.field--error input, .field--error textarea { border-color: var(--color-error-rule); }
.field__error { display: flex; gap: var(--space-xs); align-items: baseline; color: var(--color-error); font-size: var(--text-sm); margin-top: var(--space-2xs); }
.form-note { padding: var(--space-md) var(--space-lg); border: 1px solid var(--color-rule); background: var(--color-paper-2); margin-bottom: var(--space-lg); }
/* Turnstile slots: reserve the widget's height so hydration causes no CLS. */
.ts-slot { min-height: 65px; margin-bottom: var(--space-lg); }
.ts-slot[data-size="compact"] { min-height: 120px; margin: var(--space-sm) 0 0; }
.form-note--error { border-color: var(--color-error-rule); color: var(--color-error); }
.hp-field { position: absolute; left: -999px; width: 1px; height: 1px; overflow: hidden; }

/* ── Footer (Ft-index: mast + 4 columns + newsletter) ───────────────── */
.foot { background: var(--color-onyx); color: var(--color-ink-inverse-2); font-size: 0.9375rem; }
.foot .wrap { padding-block: var(--space-2xl) var(--space-xl); }
.foot__mast { display: flex; flex-wrap: wrap; align-items: center; gap: var(--space-xl); padding-bottom: var(--space-xl); border-bottom: 1px solid var(--color-rule-onyx); }
.foot__mast img { width: 240px; height: 85px; object-fit: contain; }
.foot__tagline { font-family: var(--font-display); font-weight: 700; font-size: var(--text-md); color: var(--color-ink-inverse); margin: 0; }
.foot__cols {
	display: grid; grid-template-columns: repeat(3, minmax(0, 1fr));
	gap: var(--space-xl) var(--space-2xl); padding-block: var(--space-xl);
}
@media (max-width: 63.9375rem) { .foot__cols { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
@media (max-width: 40rem) { .foot__cols { grid-template-columns: minmax(0, 1fr); } }
.foot__nav ul { list-style: none; margin: 0; padding: 0; display: grid; gap: var(--space-xs); }
.foot a { color: var(--color-ink-inverse); text-decoration: none; }
.foot a:hover { text-decoration: underline; text-decoration-color: var(--color-accent); text-underline-offset: 3px; }
.foot__label { display: block; font-size: var(--text-sm); font-weight: 600; letter-spacing: var(--tracking-label); text-transform: uppercase; color: var(--color-ink-inverse-2); margin-bottom: var(--space-sm); }
.foot__contact p { margin-bottom: var(--space-xs); }
.foot__social { display: flex; gap: var(--space-md); }
.foot__social a { display: grid; place-items: center; width: 2.5rem; height: 2.5rem; border: 1px solid var(--color-rule-onyx); border-radius: 50%; transition: border-color var(--dur-short) var(--ease-out), color var(--dur-short) var(--ease-out); color: var(--color-ink-inverse); }
.foot__social a:hover { border-color: var(--color-gold); color: var(--color-gold); text-decoration: none; }
.foot__legal { border-top: 1px solid var(--color-rule-onyx); padding-top: var(--space-md); font-size: var(--text-sm); color: var(--color-ink-inverse-2); display: flex; flex-wrap: wrap; gap: var(--space-md); justify-content: space-between; }

/* ── Floating call button (client request 2026-07-21) ──────────────── */
/* Gold disc + dark phone glyph, bottom-right, collapsed-nav widths only. */
.call-fab {
	display: none; position: fixed;
	right: var(--space-md); bottom: calc(var(--space-md) + env(safe-area-inset-bottom, 0px));
	width: 3.5rem; height: 3.5rem; border-radius: 50%;
	background: var(--color-gold); color: var(--color-onyx);
	box-shadow: 0 4px 14px rgb(0 0 0 / 0.28);
	z-index: var(--z-sticky);
	transition: background var(--dur-micro) var(--ease-out);
}
.call-fab:hover { background: var(--color-gold-hover); }
.call-fab svg { width: 1.5rem; height: 1.5rem; }
@media (max-width: 63.9375rem) { .call-fab { display: grid; place-items: center; } }
@media print { .call-fab { display: none; } }

/* ── Motion ─────────────────────────────────────────────────────────── */
/* Load-time hero entrance (masthead lines, staggered). */
@keyframes lapin-reveal { to { opacity: 1; transform: none; } }
.reveal { opacity: 0; transform: translateY(10px); animation: lapin-reveal var(--dur-long) var(--ease-out) forwards; animation-delay: calc(var(--i, 0) * 110ms); }
/* Scroll reveal (staging fade-up DNA): the observer in the footer adds
   .rv--set to arm elements and .rv--in to show them. No JS → visible. */
.rv--set { opacity: 0; transform: translateY(20px); transition: opacity var(--dur-long) var(--ease-out), transform var(--dur-long) var(--ease-out); transition-delay: calc(var(--i, 0) * 90ms); }
.rv--in { opacity: 1; transform: none; }
@media print { .rv--set { opacity: 1; transform: none; } }
@media (prefers-reduced-motion: reduce) {
	*, *::before, *::after {
		animation-duration: 150ms !important;
		animation-iteration-count: 1 !important;
		transition-duration: 150ms !important;
	}
	.reveal { animation: lapin-reveal 150ms linear forwards; transform: none; }
	.rv--set { transform: none; transition-delay: 0s; }
	.btn:hover, .btn:active { transform: none; }
	.marquee__track { animation: none !important; }
}
</style>
