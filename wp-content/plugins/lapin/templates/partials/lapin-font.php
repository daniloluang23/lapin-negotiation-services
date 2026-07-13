<?php
/**
 * Self-hosted variable fonts (preload + @font-face).
 *
 * Three font sets, switchable per-request for design review:
 *   default            — Fraunces (display) + IBM Plex Sans (body)
 *   ?fonts=legalia     — Manrope everywhere (the Legalia plugin's font,
 *                        same WOFF2 file)
 *   ?fonts=classic     — Montserrat (display) + Roboto (body); the live
 *                        site's look (Montserrat stands in for the
 *                        unlicensed "Mont DEMO" the old site used)
 *
 * Only the selected set's files are preloaded/declared, so the preview
 * switch costs nothing in production. Include inside <head> before the
 * tokens partial.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin_fonts = isset( $_GET['fonts'] ) ? sanitize_key( wp_unslash( $_GET['fonts'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

if ( 'legalia' === $lapin_fonts ) :
?>
<link rel="preload" as="font" type="font/woff2" crossorigin
      href="<?php echo esc_url( Lapin::asset( 'fonts/manrope/manrope-latin-var.woff2' ) ); ?>">
<style>
	@font-face {
		font-family: 'Manrope';
		font-style: normal;
		font-weight: 200 800;
		font-display: swap;
		src: url('<?php echo esc_url( Lapin::asset( 'fonts/manrope/manrope-latin-var.woff2' ) ); ?>') format('woff2');
	}
	/* Doubled :root outranks the token block's defaults, which are emitted later. */
	:root:root {
		--font-display: 'Manrope', system-ui, -apple-system, 'Segoe UI', sans-serif;
		--font-body: 'Manrope', system-ui, -apple-system, 'Segoe UI', sans-serif;
	}
	h1, h2, h3, h4 { font-weight: 750; letter-spacing: -0.025em; }
</style>
<?php elseif ( 'classic' === $lapin_fonts ) : ?>
<link rel="preload" as="font" type="font/woff2" crossorigin
      href="<?php echo esc_url( Lapin::asset( 'fonts/montserrat/montserrat-latin-var.woff2' ) ); ?>">
<link rel="preload" as="font" type="font/woff2" crossorigin
      href="<?php echo esc_url( Lapin::asset( 'fonts/roboto/roboto-latin-var.woff2' ) ); ?>">
<style>
	@font-face {
		font-family: 'Montserrat';
		font-style: normal;
		font-weight: 100 900;
		font-display: swap;
		src: url('<?php echo esc_url( Lapin::asset( 'fonts/montserrat/montserrat-latin-var.woff2' ) ); ?>') format('woff2');
	}
	@font-face {
		font-family: 'Roboto';
		font-style: normal;
		font-weight: 100 900;
		font-display: swap;
		src: url('<?php echo esc_url( Lapin::asset( 'fonts/roboto/roboto-latin-var.woff2' ) ); ?>') format('woff2');
	}
	:root:root {
		--font-display: 'Montserrat', system-ui, -apple-system, 'Segoe UI', sans-serif;
		--font-body: 'Roboto', system-ui, -apple-system, 'Segoe UI', sans-serif;
	}
	h1, h2, h3, h4 { font-weight: 700; letter-spacing: -0.01em; }
</style>
<?php else : ?>
<link rel="preload" as="font" type="font/woff2" crossorigin
      href="<?php echo esc_url( Lapin::asset( 'fonts/fraunces/fraunces-latin-var.woff2' ) ); ?>">
<link rel="preload" as="font" type="font/woff2" crossorigin
      href="<?php echo esc_url( Lapin::asset( 'fonts/plex/plex-sans-latin-var.woff2' ) ); ?>">
<style>
	@font-face {
		font-family: 'Fraunces';
		font-style: normal;
		font-weight: 100 900;
		font-display: swap;
		src: url('<?php echo esc_url( Lapin::asset( 'fonts/fraunces/fraunces-latin-var.woff2' ) ); ?>') format('woff2');
	}
	@font-face {
		font-family: 'IBM Plex Sans';
		font-style: normal;
		font-weight: 100 700;
		font-display: swap;
		src: url('<?php echo esc_url( Lapin::asset( 'fonts/plex/plex-sans-latin-var.woff2' ) ); ?>') format('woff2');
	}
</style>
<?php endif; ?>
