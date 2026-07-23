<?php
/**
 * Footer — Ft-index on onyx: light logo + tagline mast, three columns
 * (contact facts / explore / services), social, copyright.
 * Ends the document (wp_footer + closing tags) and carries the site's only
 * JavaScript: mobile menu toggle, click-to-load media facades, form submit
 * state, and the scroll-reveal observer (staging fade-up DNA, hand-rolled).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<footer class="foot">
	<?php // Corner-sweep watermark: rises into the content just above the footer, on every page except home. ?>
	<?php if ( 'home' !== ( $lapin['nav'] ?? '' ) ) : ?>
	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-watermark.php'; ?>
	<?php endif; ?>
	<div class="wrap">
		<div class="foot__mast">
			<img src="<?php echo esc_url( Lapin::asset( 'images/logo-footer.webp' ) ); ?>" alt="<?php echo esc_attr( Lapin::NAME ); ?>" width="240" height="85" loading="lazy">
			<p class="foot__tagline"><?php echo esc_html( Lapin::TAGLINE ); ?></p>
		</div>
		<div class="foot__cols">
			<div class="foot__contact">
				<span class="foot__label">Reach us</span>
				<p><a href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>"><?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a></p>
				<p>Toll-free <a href="tel:<?php echo esc_attr( Lapin::PHONE_FREE_TEL ); ?>"><?php echo esc_html( Lapin::PHONE_FREE ); ?></a></p>
				<p><a href="mailto:<?php echo esc_attr( Lapin::EMAIL ); ?>"><?php echo esc_html( Lapin::EMAIL ); ?></a></p>
				<p><a href="<?php echo esc_url( Lapin::MAPS_URL ); ?>" rel="noopener" target="_blank"><?php echo esc_html( Lapin::address_line() ); ?></a></p>
			</div>
			<nav class="foot__nav" aria-label="Footer — explore">
				<span class="foot__label">Explore</span>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
					<li><a href="<?php echo esc_url( home_url( '/overview/' ) ); ?>">About Us</a></li>
					<li><a href="<?php echo esc_url( home_url( '/practice-areas/' ) ); ?>">Practice Areas</a></li>
					<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Insights</a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
				</ul>
			</nav>
			<nav class="foot__nav" aria-label="Footer — services">
				<span class="foot__label">Services</span>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/negotiation/' ) ); ?>">Negotiation</a></li>
					<li><a href="<?php echo esc_url( home_url( '/dispute-resolution/' ) ); ?>">Dispute Resolution</a></li>
					<li><a href="<?php echo esc_url( home_url( '/mediation/' ) ); ?>">Mediation</a></li>
					<li><a href="<?php echo esc_url( home_url( '/negotiation-services-los-angeles/' ) ); ?>">Negotiation Services · Los Angeles</a></li>
					<li><a href="<?php echo esc_url( home_url( '/divorce-mediation-los-angeles/' ) ); ?>">Divorce Mediation · Los Angeles</a></li>
					<li><a href="<?php echo esc_url( home_url( '/adr-services-santa-monica/' ) ); ?>">ADR · Santa Monica</a></li>
					<li><a href="<?php echo esc_url( home_url( '/mediation-negotiation-orange-county/' ) ); ?>">Mediation &amp; Negotiation · Orange County</a></li>
				</ul>
			</nav>
		</div>
		<div class="foot__cols" style="padding-block: 0 var(--space-xl);">
			<div class="foot__social" aria-label="Social profiles">
				<a href="<?php echo esc_url( Lapin::LINKEDIN ); ?>" rel="noopener" target="_blank" aria-label="LinkedIn">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM.5 8h4V24h-4V8zm7.5 0h3.8v2.2h.05c.53-1 1.83-2.2 3.77-2.2 4.03 0 4.78 2.65 4.78 6.1V24h-4v-8.5c0-2.03-.04-4.64-2.83-4.64-2.83 0-3.27 2.2-3.27 4.5V24H8V8z"/></svg>
				</a>
				<a href="<?php echo esc_url( Lapin::FACEBOOK ); ?>" rel="noopener" target="_blank" aria-label="Facebook">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12.07C24 5.4 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.09 10.13 24v-8.44H7.08v-3.49h3.05V9.41c0-3.02 1.79-4.7 4.53-4.7 1.31 0 2.68.24 2.68.24v2.97h-1.51c-1.49 0-1.96.93-1.96 1.89v2.26h3.33l-.53 3.49h-2.8V24C19.61 23.09 24 18.1 24 12.07z"/></svg>
				</a>
				<a href="<?php echo esc_url( Lapin::YOUTUBE ); ?>" rel="noopener" target="_blank" aria-label="YouTube">
					<svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.5 6.19a3.02 3.02 0 0 0-2.12-2.14C19.5 3.55 12 3.55 12 3.55s-7.5 0-9.38.5A3.02 3.02 0 0 0 .5 6.19C0 8.07 0 12 0 12s0 3.93.5 5.81a3.02 3.02 0 0 0 2.12 2.14c1.88.5 9.38.5 9.38.5s7.5 0 9.38-.5a3.02 3.02 0 0 0 2.12-2.14C24 15.93 24 12 24 12s0-3.93-.5-5.81zM9.55 15.57V8.43L15.82 12l-6.27 3.57z"/></svg>
				</a>
			</div>
		</div>
		<div class="foot__legal">
			<span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( Lapin::NAME ); ?>. All rights reserved.</span>
			<nav class="foot__legal-links" aria-label="Legal">
				<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>
				<a href="<?php echo esc_url( home_url( '/disclaimer/' ) ); ?>">Disclaimer</a>
				<?php if ( Lapin::consent_ui_enabled() ) : ?>
				<a href="<?php echo esc_url( home_url( '/privacy-policy/#your-privacy-choices' ) ); ?>" data-lapin-privacy-choices>Your Privacy Choices</a>
				<?php endif; ?>
			</nav>
		</div>
	</div>
</footer>
<?php // Floating tap-to-call button, mobile/tablet only (client request 2026-07-21). ?>
<a class="call-fab" href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>" aria-label="Call <?php echo esc_attr( Lapin::NAME ); ?> — <?php echo esc_attr( Lapin::PHONE_LOCAL ); ?>">
	<?php echo Lapin::icon( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
</a>
<script>
(function () {
	/* Mobile menu toggle */
	var burger = document.querySelector('.nav__burger');
	var panel = document.getElementById('nav-panel');
	if (burger && panel) {
		burger.addEventListener('click', function () {
			var open = burger.getAttribute('aria-expanded') === 'true';
			burger.setAttribute('aria-expanded', String(!open));
			burger.setAttribute('aria-label', open ? 'Open menu' : 'Close menu');
			panel.hidden = open;
		});
	}

	/* Scroll reveal — arms .rv elements only when the observer exists, so
	   content stays visible without JS. Fade-up, staggered via --i. */
	if ('IntersectionObserver' in window) {
		var seen = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('rv--in');
					seen.unobserve(entry.target);
				}
			});
		}, { rootMargin: '0px 0px -8% 0px' });
		document.querySelectorAll('.rv').forEach(function (el) {
			if (el.getBoundingClientRect().top > window.innerHeight * 0.9) {
				el.classList.add('rv--set');
				seen.observe(el);
			}
		});
	}

	/* Review cards: clamp long reviews, reveal Read more only when needed */
	document.querySelectorAll('.review-card p').forEach(function (p) {
		p.classList.add('is-clamped');
		var btn = p.parentElement.querySelector('.review-card__more');
		if (btn && p.scrollHeight > p.clientHeight + 2) { btn.hidden = false; }
	});
	document.addEventListener('click', function (e) {
		var btn = e.target.closest('.review-card__more');
		if (!btn) { return; }
		var p = btn.parentElement.querySelector('p');
		var expanded = !p.classList.toggle('is-clamped');
		btn.textContent = expanded ? 'Read less' : 'Read more';
		btn.setAttribute('aria-expanded', String(expanded));
	});

	/* Native <dialog> modals: [data-modal] openers keep a real href as the
	   no-JS fallback; close via [data-modal-close] or a backdrop click. */
	document.addEventListener('click', function (e) {
		var opener = e.target.closest('[data-modal]');
		if (opener) {
			var dlg = document.getElementById(opener.getAttribute('data-modal'));
			if (dlg && dlg.showModal) {
				e.preventDefault();
				dlg.showModal();
			}
			return;
		}
		var closer = e.target.closest('[data-modal-close]');
		if (closer) {
			closer.closest('dialog').close();
			return;
		}
		if (e.target instanceof HTMLDialogElement && e.target.open) {
			e.target.close();
		}
	});

	/* Click-to-load media facades (YouTube + SoundCloud + Apple Podcasts) */
	document.addEventListener('click', function (e) {
		var el = e.target.closest('[data-embed]');
		if (!el) { return; }
		var frame = document.createElement('iframe');
		frame.src = el.getAttribute('data-embed');
		frame.title = el.getAttribute('data-embed-title') || 'Embedded media player';
		frame.allow = 'autoplay *; encrypted-media *; fullscreen *; clipboard-write; picture-in-picture';
		frame.setAttribute('allowfullscreen', '');
		var holder = document.createElement('div');
		holder.className = 'media-embed' + (el.hasAttribute('data-embed-audio') ? ' media-embed--audio' : '');
		if (el.dataset.embedH) { holder.style.height = el.dataset.embedH + 'px'; }
		holder.appendChild(frame);
		el.replaceWith(holder);
	});

	/* Turnstile: inject Cloudflare's script only on first form interaction,
	   then render every widget slot explicitly. Lighthouse never loads it. */
	var tsSlots = document.querySelectorAll('[data-turnstile-slot]');
	if (tsSlots.length) {
		var tsLoaded = false;
		window.lapinTsReady = function () {
			tsSlots.forEach(function (slot) {
				window.turnstile.render(slot, {
					sitekey: slot.getAttribute('data-sitekey'),
					theme: slot.getAttribute('data-theme') || 'light',
					size: slot.getAttribute('data-size') || 'normal'
				});
			});
		};
		var tsLoad = function () {
			if (tsLoaded) { return; }
			tsLoaded = true;
			var s = document.createElement('script');
			s.src = 'https://challenges.cloudflare.com/turnstile/v0/api.js?onload=lapinTsReady&render=explicit';
			s.async = true;
			document.head.appendChild(s);
		};
		tsSlots.forEach(function (slot) {
			var form = slot.closest('form');
			if (!form) { return; }
			form.addEventListener('focusin', tsLoad, { once: true });
			form.addEventListener('pointerenter', tsLoad, { once: true });
			form.addEventListener('touchstart', tsLoad, { once: true, passive: true });
		});
	}

	/* Forms: disable the submit button while sending */
	document.querySelectorAll('form[data-contact]').forEach(function (form) {
		form.addEventListener('submit', function () {
			var btn = form.querySelector('button[type="submit"]');
			if (btn) { btn.disabled = true; btn.textContent = 'Sending…'; }
		});
	});
}());
</script>
<?php wp_footer(); ?>
</body>
</html>
