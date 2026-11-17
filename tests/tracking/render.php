<?php
/**
 * Renders one lapin partial outside WordPress, with just enough of WP stubbed
 * to exercise the tracking gate. Used by tracking.test.mjs; never deployed
 * (the deploy uploads wp-content/ only).
 *
 * Usage: php render.php <partial> <host> <page-slug> [consent] [gpc] [sent] [logged-in]
 *   partial   analytics | banner
 *   host      e.g. lapinnegotiationservices.com or lapin-negotiation-services.local
 *   page-slug the routed page being rendered (e.g. home, contact)
 *   consent   '' | accepted | rejected (the lapin_cookie_consent cookie)
 *   gpc       1 to send Sec-GPC: 1
 *   sent      1 to add ?sent=1 (contact form success redirect)
 *   logged-in 1 to simulate a signed-in user
 */

define( 'ABSPATH', __DIR__ . '/' );
define( 'LAPIN_PLUGIN_DIR', dirname( __DIR__, 2 ) . '/wp-content/plugins/lapin/' );

$args = array_slice( $argv, 1 ) + array_fill( 0, 7, '' );
list( $partial, $host, $slug, $consent, $gpc, $sent, $logged_in ) = $args;

$GLOBALS['lapin_test'] = array(
	'host'      => $host,
	'slug'      => $slug,
	'logged_in' => '1' === $logged_in,
);
if ( '' !== $consent ) {
	$_COOKIE['lapin_cookie_consent'] = $consent;
}
if ( '1' === $gpc ) {
	$_SERVER['HTTP_SEC_GPC'] = '1';
}
if ( '1' === $sent ) {
	$_GET['sent'] = '1';
}

function home_url( $path = '' ) { return 'https://' . $GLOBALS['lapin_test']['host'] . $path; }
function wp_parse_url( $url, $component = -1 ) { return parse_url( $url, $component ); }
function is_user_logged_in() { return $GLOBALS['lapin_test']['logged_in']; }
function is_admin() { return false; }
function is_page( $slug = '' ) { return $slug === $GLOBALS['lapin_test']['slug']; }
function esc_attr( $s ) { return htmlspecialchars( (string) $s, ENT_QUOTES ); }
function esc_html( $s ) { return htmlspecialchars( (string) $s, ENT_QUOTES ); }
function esc_url( $s ) { return htmlspecialchars( (string) $s, ENT_QUOTES ); }
function esc_js( $s ) { return addslashes( (string) $s ); }
function wp_json_encode( $v ) { return json_encode( $v, JSON_UNESCAPED_SLASHES ); }

require LAPIN_PLUGIN_DIR . 'includes/class-lapin.php';

$files = array(
	'analytics' => 'templates/partials/lapin-analytics.php',
	'banner'    => 'templates/partials/lapin-cookie-banner.php',
);
require LAPIN_PLUGIN_DIR . $files[ $partial ];
