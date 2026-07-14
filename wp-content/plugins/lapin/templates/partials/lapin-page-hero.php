<?php
/**
 * Hero block inside the masthead (required by lapin-header.php — do not
 * require directly from page templates).
 *
 * Driven by $lapin['hero']:
 *   array( 'type' => 'home' )                  — H1 brand tagline + subheading + CTAs
 *   array( 'title' => '…', 'lede' => '…' )     — compact page hero (H1 + lede)
 *   array( 'title' => '…', 'lede' => '…',
 *          'eyebrow' => '…' )                  — optional small label above the H1
 * Unset — no hero block (masthead is nav-only).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin_hero_cfg = $lapin['hero'] ?? null;
if ( null === $lapin_hero_cfg ) {
	return;
}

if ( 'home' === ( $lapin_hero_cfg['type'] ?? '' ) ) : ?>
<div class="hero hero--home">
	<div class="wrap">
		<h1>
			<span class="hero__eyebrow reveal" style="--i:0"><?php echo esc_html( Lapin::TAGLINE ); ?></span>
			<span class="hero__display reveal" style="--i:1">Experienced.<br>Strategic.<br><span class="hero__display-accent">Results&#8209;Focused.</span></span>
		</h1>
		<p class="hero__sub reveal" style="--i:2"><?php echo esc_html( Lapin::SUBLINE ); ?></p>
		<div class="hero__actions reveal" style="--i:3">
			<a class="btn btn--rose" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Schedule a Consultation</a>
			<a class="btn btn--light" href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>">Call Now — <?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a>
		</div>
	</div>
</div>
<?php else : ?>
<div class="hero hero--page">
	<div class="wrap">
		<?php if ( ! empty( $lapin_hero_cfg['eyebrow'] ) ) : ?>
		<span class="hero__eyebrow reveal" style="--i:0"><?php echo esc_html( $lapin_hero_cfg['eyebrow'] ); ?></span>
		<?php endif; ?>
		<h1 class="reveal" style="--i:1"><?php echo esc_html( $lapin_hero_cfg['title'] ); ?></h1>
		<?php if ( ! empty( $lapin_hero_cfg['lede'] ) ) : ?>
		<p class="hero__sub reveal" style="--i:2"><?php echo esc_html( $lapin_hero_cfg['lede'] ); ?></p>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>
