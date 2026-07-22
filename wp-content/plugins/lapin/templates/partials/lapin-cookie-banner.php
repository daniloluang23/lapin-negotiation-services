<?php
/**
 * Cookie consent banner — opt-out model, tuned for California (CCPA/CPRA).
 *
 * Injected once on wp_footer (see lapin.php) for front-end, non-logged-in
 * visitors on Lapin pages. Self-contained: scoped markup + inline CSS on the
 * canonical design tokens (var(--token, #hexfallback) so it also renders on any
 * surface that skips the token block) + inline JS.
 *
 * Model (California is an opt-OUT regime, so GA4 runs by default):
 *  - First visit, no GPC → banner shown; GA4 already loading (server gate).
 *  - Accept → lapin_cookie_consent=accepted; GA4 keeps running.
 *  - Reject → lapin_cookie_consent=rejected; GA4 neutralised this page view
 *             (ga-disable flag + drops _ga* cookies) and suppressed server-side
 *             on every later load. This is the "Do Not Sell/Share" opt-out.
 *  - Global Privacy Control (navigator.globalPrivacyControl) with no explicit
 *    prior choice → auto-rejected; CA law requires GPC to be honored. Mirrors
 *    the server-side Sec-GPC check in Lapin::tracking_allowed().
 *  - Any element with [data-lapin-privacy-choices] (the footer "Your Privacy
 *    Choices" link) re-opens the banner so the opt-out is always reachable.
 *
 * Cookie: first-party, path=/, ~12-month expiry, SameSite=Lax.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin_cookie_privacy_url = home_url( '/privacy-policy/' );
?>
<div class="lapin-cookie" id="lapin-cookie-banner" role="dialog" aria-live="polite" aria-label="Cookie consent" hidden>
	<div class="lapin-cookie__inner">
		<p class="lapin-cookie__text">
			We use cookies, including Google Analytics, to understand how this site is used and improve it.
			You can accept or reject analytics cookies at any time. For California residents, rejecting also
			opts you out of any &ldquo;sale&rdquo; or &ldquo;sharing&rdquo; of personal information, and we honor
			Global Privacy Control signals.
			<a class="lapin-cookie__link" href="<?php echo esc_url( $lapin_cookie_privacy_url ); ?>">Privacy Policy</a>.
		</p>
		<div class="lapin-cookie__actions">
			<button type="button" class="lapin-cookie__btn lapin-cookie__btn--ghost" data-lapin-consent="rejected">Reject</button>
			<button type="button" class="lapin-cookie__btn lapin-cookie__btn--primary" data-lapin-consent="accepted">Accept</button>
		</div>
	</div>
	<style>
		.lapin-cookie {
			position: fixed;
			left: 0;
			right: 0;
			bottom: 0;
			z-index: var(--z-toast, 500);
			background: var(--color-strip, #141416);
			border-top: 3px solid var(--color-accent, #BD8C7D);
			box-shadow: var(--shadow-card, 0 10px 28px -14px rgba(20, 20, 22, 0.5));
			font-family: var(--font-body, 'Poppins', system-ui, -apple-system, 'Segoe UI', sans-serif);
			animation: lapin-cookie-in var(--dur-short, 220ms) var(--ease-out, cubic-bezier(0.16, 1, 0.3, 1));
		}
		.lapin-cookie[hidden] { display: none; }
		.lapin-cookie__inner {
			max-width: 72rem;
			margin-inline: auto;
			padding: 1rem clamp(1rem, 4vw, 2rem);
			display: flex;
			flex-wrap: wrap;
			align-items: center;
			justify-content: space-between;
			gap: 1rem;
		}
		.lapin-cookie__text {
			margin: 0;
			flex: 1 1 24rem;
			min-width: 0;
			font-size: 0.8125rem;
			line-height: 1.6;
			color: var(--color-ink-inverse-2, #D1BFA7);
		}
		.lapin-cookie__link {
			color: var(--color-gold, #D1BFA7);
			text-decoration: underline;
			text-underline-offset: 3px;
			text-decoration-color: var(--color-accent, #BD8C7D);
		}
		.lapin-cookie__link:hover { color: var(--color-ink-inverse, #F3ECE1); }
		.lapin-cookie__actions {
			display: flex;
			gap: 0.625rem;
			flex: 0 0 auto;
		}
		/* Self-contained buttons (var + hex fallback), sharp per --radius-btn. */
		.lapin-cookie__btn {
			cursor: pointer;
			font-family: inherit;
			font-weight: 600;
			font-size: 0.875rem;
			line-height: 1;
			min-height: 2.5rem;
			padding: 0.6rem 1.25rem;
			border-radius: var(--radius-btn, 2px);
			border: 1px solid transparent;
			transition: background-color var(--dur-short, 220ms), border-color var(--dur-short, 220ms), color var(--dur-short, 220ms);
		}
		.lapin-cookie__btn--primary {
			background: var(--color-gold, #D1BFA7);
			border-color: var(--color-gold, #D1BFA7);
			color: var(--color-onyx, #49494B);
		}
		.lapin-cookie__btn--primary:hover,
		.lapin-cookie__btn--primary:focus-visible {
			background: var(--color-gold-hover, #E0D2BC);
			border-color: var(--color-gold-hover, #E0D2BC);
		}
		.lapin-cookie__btn--ghost {
			background: transparent;
			color: var(--color-ink-inverse, #F3ECE1);
			border-color: var(--color-rule-onyx, #6b6b70);
		}
		.lapin-cookie__btn--ghost:hover,
		.lapin-cookie__btn--ghost:focus-visible {
			border-color: var(--color-gold, #D1BFA7);
			color: var(--color-gold, #D1BFA7);
		}
		.lapin-cookie__btn:focus-visible { outline: 2px solid var(--color-gold, #D1BFA7); outline-offset: 2px; }
		@keyframes lapin-cookie-in {
			from { transform: translateY(100%); opacity: 0; }
			to   { transform: translateY(0); opacity: 1; }
		}
		@media (prefers-reduced-motion: reduce) {
			.lapin-cookie { animation: none; }
		}
		@media (max-width: 30rem) {
			.lapin-cookie__inner { flex-direction: column; align-items: stretch; }
			/* In a column, the text's flex-basis is read as HEIGHT — reset it. */
			.lapin-cookie__text { flex: 0 0 auto; }
			.lapin-cookie__actions { justify-content: stretch; }
			.lapin-cookie__btn { flex: 1 1 0; }
		}
	</style>
	<script>
		(function () {
			var GA4_ID = <?php echo wp_json_encode( Lapin::GA4_ID ); ?>;
			var COOKIE = <?php echo wp_json_encode( Lapin::CONSENT_COOKIE ); ?>;
			var banner = document.getElementById('lapin-cookie-banner');
			if (!banner) { return; }

			function getConsent() {
				var m = document.cookie.match(new RegExp('(?:^|;\\s*)' + COOKIE + '=([^;]*)'));
				return m ? decodeURIComponent(m[1]) : '';
			}
			function writeConsent(value) {
				var maxAge = 60 * 60 * 24 * 365; // ~12 months
				document.cookie = COOKIE + '=' + value + ';path=/;max-age=' + maxAge + ';SameSite=Lax';
			}
			function dropAnalyticsCookies() {
				// GA sets _ga / _ga_<id> / _gid on the registrable domain. Expire
				// them across the current host and its parent to be thorough.
				var host = location.hostname;
				var domains = ['', host, '.' + host];
				var parent = host.replace(/^[^.]+\./, '');
				if (parent !== host) { domains.push(parent, '.' + parent); }
				document.cookie.split(';').forEach(function (pair) {
					var name = pair.split('=')[0].trim();
					if (!/^_ga/.test(name) && name !== '_gid') { return; }
					domains.forEach(function (d) {
						document.cookie = name + '=;path=/;expires=Thu, 01 Jan 1970 00:00:00 GMT' + (d ? ';domain=' + d : '');
					});
				});
			}
			function disableGA() {
				window['ga-disable-' + GA4_ID] = true;
				dropAnalyticsCookies();
			}

			var consent = getConsent();

			// Global Privacy Control (California): honored as an opt-out when the
			// visitor has made no explicit choice yet.
			if (!consent && navigator.globalPrivacyControl === true) {
				writeConsent('rejected');
				disableGA();
				consent = 'rejected';
			}

			if (consent === 'rejected') { disableGA(); }
			if (!consent) { banner.hidden = false; } // first visit → prompt

			banner.addEventListener('click', function (e) {
				var btn = e.target.closest('[data-lapin-consent]');
				if (!btn) { return; }
				var choice = btn.getAttribute('data-lapin-consent');
				writeConsent(choice);
				if (choice === 'rejected') { disableGA(); }
				banner.hidden = true;
			});

			// Persistent, always-reachable opt-out ("Your Privacy Choices").
			document.addEventListener('click', function (e) {
				var trigger = e.target.closest('[data-lapin-privacy-choices]');
				if (!trigger) { return; }
				e.preventDefault();
				banner.hidden = false;
				var first = banner.querySelector('.lapin-cookie__btn');
				if (first) { first.focus(); }
			});
		})();
	</script>
</div>
