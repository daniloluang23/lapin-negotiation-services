<?php
/**
 * Footer — Ft1 mast-headed on navy: light logo + tagline mast, inline link
 * row, contact facts, social, copyright. Ends the document (wp_footer +
 * closing tags) and carries the site's only JavaScript: the mobile menu
 * toggle, click-to-load media facades, and the contact-form submit state.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<footer class="foot">
	<div class="wrap">
		<div class="foot__mast">
			<img src="<?php echo esc_url( Lapin::asset( 'images/logo-light.webp' ) ); ?>" alt="<?php echo esc_attr( Lapin::NAME ); ?>" width="220" height="78" loading="lazy">
			<p class="foot__tagline"><?php echo esc_html( Lapin::TAGLINE ); ?></p>
		</div>
		<div class="foot__cols">
			<nav class="foot__nav" aria-label="Footer">
				<span class="foot__label">Visit</span>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
					<li><a href="<?php echo esc_url( home_url( '/overview/' ) ); ?>">About Us</a></li>
					<li><a href="<?php echo esc_url( home_url( '/practice-areas/' ) ); ?>">Practice Areas</a></li>
					<li><a href="<?php echo esc_url( home_url( '/negotiation/' ) ); ?>">Negotiation</a></li>
					<li><a href="<?php echo esc_url( home_url( '/dispute-resolution/' ) ); ?>">Dispute Resolution</a></li>
					<li><a href="<?php echo esc_url( home_url( '/mediation/' ) ); ?>">Mediation</a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
				</ul>
			</nav>
			<div class="foot__contact">
				<span class="foot__label">Reach us</span>
				<p><a href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>"><?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a> · Toll-free <a href="tel:<?php echo esc_attr( Lapin::PHONE_FREE_TEL ); ?>"><?php echo esc_html( Lapin::PHONE_FREE ); ?></a></p>
				<p><a href="mailto:<?php echo esc_attr( Lapin::EMAIL ); ?>"><?php echo esc_html( Lapin::EMAIL ); ?></a></p>
				<p><a href="<?php echo esc_url( Lapin::MAPS_URL ); ?>" rel="noopener" target="_blank"><?php echo esc_html( Lapin::address_line() ); ?></a></p>
			</div>
			<div>
				<span class="foot__label">Follow</span>
				<div class="foot__social">
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
		</div>
		<div class="foot__legal">
			<span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( Lapin::NAME ); ?>. All rights reserved.</span>
			<span>Negotiation · Mediation · Unlitigation™</span>
		</div>
	</div>
</footer>
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

	/* Click-to-load media facades (YouTube + SoundCloud) */
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

	/* Contact form: disable the submit button while sending */
	var form = document.querySelector('form[data-contact]');
	if (form) {
		form.addEventListener('submit', function () {
			var btn = form.querySelector('button[type="submit"]');
			if (btn) { btn.disabled = true; btn.textContent = 'Sending…'; }
		});
	}
}());
</script>
<?php wp_footer(); ?>
</body>
</html>
