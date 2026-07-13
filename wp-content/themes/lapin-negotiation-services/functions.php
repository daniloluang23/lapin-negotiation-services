<?php
/**
 * Lapin Negotiation Services child theme.
 *
 * @package lapin-negotiation-services
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue the child theme stylesheet.
 *
 * Block themes do not load style.css automatically, so it is enqueued here.
 */
function lapin_negotiation_services_enqueue_styles() {
	wp_enqueue_style(
		'lapin-negotiation-services-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'lapin_negotiation_services_enqueue_styles' );
