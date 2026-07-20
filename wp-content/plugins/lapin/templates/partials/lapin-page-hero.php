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
	<?php // Recolored bridge layer (claude-design handoff 2026-07-20): covers the right 66%, left edge masked in CSS so it fades clear of the headline. Home LCP image. ?>
	<img class="hero__bridge"
	     src="<?php echo esc_url( Lapin::asset( 'images/bridge-theme-1600.webp' ) ); ?>"
	     srcset="<?php echo esc_attr( Lapin::asset( 'images/bridge-theme-960.webp' ) . ' 960w, ' . Lapin::asset( 'images/bridge-theme-1600.webp' ) . ' 1600w, ' . Lapin::asset( 'images/bridge-theme-2560.webp' ) . ' 2560w' ); ?>"
	     sizes="(max-width: 63.9375rem) 100vw, 66vw"
	     alt="" width="2560" height="1707" fetchpriority="high" decoding="async">
	<div class="wrap">
		<div class="hero__copy">
			<?php // H1 wording mirrors Lapin::TAGLINE — keep them in sync. ?>
			<h1 class="reveal" style="--i:0"><span class="hero__line">Building Bridges.</span> <span class="hero__line">Resolving Differences.</span></h1>
			<span class="hero__divider reveal" style="--i:1" aria-hidden="true"></span>
			<p class="hero__lead reveal" style="--i:1"><?php echo esc_html( Lapin::SUBLINE_LEAD ); ?></p>
			<p class="hero__sub reveal" style="--i:2"><?php echo esc_html( Lapin::SUBLINE_BODY ); ?></p>
			<div class="hero__actions reveal" style="--i:3">
				<a class="btn btn--rose" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Schedule a Consultation</a>
				<a class="btn btn--light" href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>">Call Now — <?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a>
			</div>
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
