<?php
/**
 * Head analytics + Search Console verification.
 *
 * Required from lapin-head.php, inside <head>. Two independent outputs:
 *
 *  1. Search Console verification meta tag — emitted only when
 *     Lapin::GSC_VERIFICATION is set. The live domain is already verified in
 *     Search Console (same domain as the pre-redesign site), so this normally
 *     stays blank; the constant is a one-line escape hatch if the property ever
 *     needs HTML-tag re-verification.
 *
 *  2. Google Analytics 4 (gtag.js) — emitted only when Lapin::tracking_allowed()
 *     returns true, i.e. live domain + not logged in + not opted out (cookie or
 *     Global Privacy Control). No GTM: plain gtag per client direction. The
 *     cookie banner (lapin-cookie-banner.php) neutralises GA client-side on
 *     "Reject" for the current page view; this gate keeps it off on every load
 *     after the choice is stored.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( '' !== Lapin::GSC_VERIFICATION ) :
	?>
	<meta name="google-site-verification" content="<?php echo esc_attr( Lapin::GSC_VERIFICATION ); ?>">
	<?php
endif;

if ( ! Lapin::tracking_allowed() ) {
	return;
}

$lapin_ga_id = Lapin::GA4_ID;
?>
<link rel="preconnect" href="https://www.googletagmanager.com" crossorigin>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo rawurlencode( $lapin_ga_id ); ?>"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', '<?php echo esc_js( $lapin_ga_id ); ?>');
</script>
