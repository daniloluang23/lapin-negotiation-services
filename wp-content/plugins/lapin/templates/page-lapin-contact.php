<?php
/**
 * Contact — split utility: message form left, contact facts right.
 * Form posts to admin-post.php (Lapin_Contact); honeypot + nonce + rate
 * limit, error/success notes rendered from query args.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin = array(
	'title'      => 'Contact Us | Free Consultation | Lapin Negotiation Services',
	'desc'       => 'Reach Lapin Negotiation Services for a free, no-obligation consultation. Call 310-984-6952 (toll-free 888-964-8884), email info@LapinNegotiationServices.com, or send a message.',
	'path'       => 'contact/',
	'nav'        => 'contact',
	'body_class' => 'page-contact',
	'hero'       => array(
		'title' => 'Contact Us',
		'lede'  => 'For a free, no-obligation consultation — call, email, or send us a message.',
	),
	'schema'     => array(
		array(
			'@type' => 'ContactPage',
			'@id'   => home_url( '/contact/' ) . '#contactpage',
			'url'   => home_url( '/contact/' ),
			'about' => array( '@id' => home_url( '/' ) . '#organization' ),
		),
	),
);

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';

$lapin_sent  = isset( $_GET['sent'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
$lapin_error = isset( $_GET['contact_error'] ) ? sanitize_key( wp_unslash( $_GET['contact_error'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
$lapin_old   = $lapin_error ? Lapin_Contact::old_input() : array();

$lapin_error_text = array(
	'invalid' => 'Your name, a valid email address, and a message are required. Please check the highlighted fields and send again.',
	'expired' => 'That form session expired. Please send your message again.',
	'rate'    => 'A message was just sent from this connection. Please wait a minute, then try again.',
	'captcha' => 'The security check did not complete. Please try sending your message again.',
	'failed'  => 'The message could not be sent. Please email us directly at ' . Lapin::EMAIL . ' or call ' . Lapin::PHONE_LOCAL . '.',
);
?>
<style>
	.contact-grid { display: grid; grid-template-columns: minmax(0, 7fr) minmax(0, 5fr); gap: var(--space-3xl); align-items: start; }
	@media (max-width: 59.9375rem) { .contact-grid { grid-template-columns: minmax(0, 1fr); gap: var(--space-xl); } }
	.contact-facts { border-left: 3px solid var(--color-accent); padding-left: var(--space-lg); }
	.contact-facts h2 { font-size: var(--text-md); margin-bottom: var(--space-lg); }
	.contact-facts dl { margin: 0; }
	.contact-facts dt {
		font-size: var(--text-sm); font-weight: 600; letter-spacing: var(--tracking-label);
		text-transform: uppercase; color: var(--color-muted); margin-bottom: var(--space-2xs);
	}
	.contact-facts dd { margin: 0 0 var(--space-lg); color: var(--color-ink-2); }
	.contact-facts a { color: var(--color-ink); text-decoration: underline; text-decoration-color: var(--color-accent); text-decoration-thickness: 2px; text-underline-offset: 3px; }
	/* Whole-page bridge watermark (client 2026-07-22, replaces the old-site
	   handshake photo): the already-preloaded masthead artwork, fixed behind
	   the page at whisper opacity. z-index -1 paints it above the body paper
	   but under all content; the onyx CTA band and footer cover it. */
	.contact-watermark {
		position: fixed; inset: 0; z-index: -1;
		width: 100%; height: 100%; object-fit: cover; object-position: 60% 45%;
		opacity: 0.14; /* client 2026-07-22: 0.07 read as nearly invisible */
		pointer-events: none;
	}
</style>

<main id="main">
	<img class="contact-watermark" src="<?php echo esc_url( Lapin::asset( 'images/bridge-theme-1600.webp' ) ); ?>" alt="" aria-hidden="true" width="2560" height="1707" decoding="async">
	<section class="sec" id="contact-form">
		<div class="wrap">
			<div class="contact-grid">
				<div>
					<div class="sec-head">
						<h2>Send us a message</h2>
					</div>

					<?php if ( $lapin_sent ) : ?>
					<p class="form-note" role="status">Your message was sent. We typically respond within one business day — for anything urgent, call <a href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>"><?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a>.</p>
					<?php elseif ( $lapin_error ) : ?>
					<p class="form-note form-note--error" role="alert"><?php echo esc_html( $lapin_error_text[ $lapin_error ] ?? $lapin_error_text['failed'] ); ?></p>
					<?php endif; ?>

					<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" data-contact>
						<input type="hidden" name="action" value="<?php echo esc_attr( Lapin_Contact::ACTION ); ?>">
						<?php wp_nonce_field( Lapin_Contact::ACTION, 'lapin_contact_nonce', false ); ?>
						<p class="hp-field" aria-hidden="true">
							<label for="company">Leave this field empty</label>
							<input type="text" id="company" name="company" tabindex="-1" autocomplete="off">
						</p>
						<div class="field<?php echo ( 'invalid' === $lapin_error && empty( $lapin_old['name'] ) ) ? ' field--error' : ''; ?>">
							<label for="contact-name">Your name</label>
							<input type="text" id="contact-name" name="name" required autocomplete="name" value="<?php echo esc_attr( $lapin_old['name'] ?? '' ); ?>">
						</div>
						<div class="field<?php echo ( 'invalid' === $lapin_error && ! is_email( $lapin_old['email'] ?? '' ) ) ? ' field--error' : ''; ?>">
							<label for="contact-email">Email address</label>
							<input type="email" id="contact-email" name="email" required autocomplete="email" value="<?php echo esc_attr( $lapin_old['email'] ?? '' ); ?>">
							<?php if ( 'invalid' === $lapin_error && ! is_email( $lapin_old['email'] ?? '' ) ) : ?>
							<span class="field__error">Enter a valid email address so we can reply to you.</span>
							<?php endif; ?>
						</div>
						<div class="field">
							<label for="contact-phone">Phone <span style="font-weight:400;color:var(--color-muted)">(optional)</span></label>
							<input type="tel" id="contact-phone" name="phone" autocomplete="tel" value="<?php echo esc_attr( $lapin_old['phone'] ?? '' ); ?>">
						</div>
						<div class="field<?php echo ( 'invalid' === $lapin_error && empty( $lapin_old['message'] ) ) ? ' field--error' : ''; ?>">
							<label for="contact-message">How can we help?</label>
							<textarea id="contact-message" name="message" rows="6" required><?php echo esc_textarea( $lapin_old['message'] ?? '' ); ?></textarea>
						</div>
						<?php echo Lapin_Turnstile::slot( 'light' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
						<button class="btn btn--rose" type="submit">Send message</button>
					</form>
				</div>

				<aside class="contact-facts">
					<h2>Reach us directly</h2>
					<dl>
						<dt>Call</dt>
						<dd><a href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>"><?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a></dd>
						<dt>Toll-free</dt>
						<dd><a href="tel:<?php echo esc_attr( Lapin::PHONE_FREE_TEL ); ?>"><?php echo esc_html( Lapin::PHONE_FREE ); ?></a></dd>
						<dt>Email</dt>
						<dd><a href="mailto:<?php echo esc_attr( Lapin::EMAIL ); ?>"><?php echo esc_html( Lapin::EMAIL ); ?></a></dd>
						<dt>Office</dt>
						<dd><a href="<?php echo esc_url( Lapin::MAPS_URL ); ?>" rel="noopener" target="_blank"><?php echo esc_html( Lapin::address_line() ); ?></a></dd>
					</dl>
				</aside>
			</div>
		</div>
	</section>

	<?php
	$lapin_cta_hide_contact = true;
	require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-cta-band.php';
	?>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
