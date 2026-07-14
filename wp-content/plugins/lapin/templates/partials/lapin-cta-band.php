<?php
/**
 * Closing CTA band — appears on every page above the footer, retaining the
 * live site's "Already in negotiation?" copy with the client-directed CTA
 * labels. Set $lapin_cta_hide_contact = true on the contact page (linking to
 * the page you're on is noise).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin_cta_hide_contact = $lapin_cta_hide_contact ?? false;
?>
<section class="cta-band band">
	<div class="wrap">
		<h2 class="rv">Already in negotiation? We can still help!</h2>
		<p class="rv" style="--i:1">For a free, no-obligation consultation with a specialist:</p>
		<div class="cta-band__actions rv" style="--i:2">
			<a class="btn btn--gold" href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>">Call Now — <?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a>
			<?php if ( ! $lapin_cta_hide_contact ) : ?>
			<a class="btn btn--light" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Request an Assessment</a>
			<?php endif; ?>
		</div>
	</div>
</section>
