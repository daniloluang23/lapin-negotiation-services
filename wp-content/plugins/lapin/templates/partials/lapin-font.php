<?php
/**
 * Self-hosted fonts (preload + @font-face).
 *
 * Default set (design.md v2, staging DNA): DM Sans variable (display) +
 * Poppins 400/600 static (body/strong). DM Sans + Poppins 400 are preloaded
 * (above-the-fold text); Poppins 600 loads via swap without preload.
 *
 * ?fonts=editorial keeps the previous Fraunces + IBM Plex Sans system for
 * side-by-side design review; only the selected set's files are declared,
 * so the switch costs nothing in production.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin_fonts = isset( $_GET['fonts'] ) ? sanitize_key( wp_unslash( $_GET['fonts'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

if ( 'editorial' === $lapin_fonts ) :
?>
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
	/* Doubled :root outranks the token block's defaults, which are emitted later. */
	:root:root {
		--font-display: 'Fraunces', Georgia, 'Times New Roman', serif;
		--font-body: 'IBM Plex Sans', system-ui, -apple-system, 'Segoe UI', sans-serif;
	}
	h1, h2, h3, h4 { font-weight: 650; letter-spacing: -0.02em; }
</style>
<?php else : ?>
<link rel="preload" as="font" type="font/woff2" crossorigin
      href="<?php echo esc_url( Lapin::asset( 'fonts/dmsans/dmsans-latin-var.woff2' ) ); ?>">
<link rel="preload" as="font" type="font/woff2" crossorigin
      href="<?php echo esc_url( Lapin::asset( 'fonts/poppins/poppins-latin-400.woff2' ) ); ?>">
<style>
	@font-face {
		font-family: 'DM Sans';
		font-style: normal;
		font-weight: 100 1000;
		font-display: swap;
		src: url('<?php echo esc_url( Lapin::asset( 'fonts/dmsans/dmsans-latin-var.woff2' ) ); ?>') format('woff2');
	}
	@font-face {
		font-family: 'Poppins';
		font-style: normal;
		font-weight: 400;
		font-display: swap;
		src: url('<?php echo esc_url( Lapin::asset( 'fonts/poppins/poppins-latin-400.woff2' ) ); ?>') format('woff2');
	}
	@font-face {
		font-family: 'Poppins';
		font-style: normal;
		font-weight: 600;
		font-display: swap;
		src: url('<?php echo esc_url( Lapin::asset( 'fonts/poppins/poppins-latin-600.woff2' ) ); ?>') format('woff2');
	}
</style>
<?php endif; ?>
