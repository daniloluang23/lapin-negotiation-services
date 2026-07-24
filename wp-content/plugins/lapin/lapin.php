<?php
/**
 * Plugin Name: Lapin
 * Description: Self-contained page templates, design system, and SEO layer for LapinNegotiationServices.com. No page builder — every page is a hand-built PHP template served from this plugin.
 * Version:     1.0.0
 * Author:      Lapin Negotiation Services
 * License:     GPL-2.0-or-later
 * Text Domain: lapin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'LAPIN_VERSION', '2.0.0' );
define( 'LAPIN_PLUGIN_FILE', __FILE__ );
define( 'LAPIN_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'LAPIN_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once LAPIN_PLUGIN_DIR . 'includes/class-lapin.php';
require_once LAPIN_PLUGIN_DIR . 'includes/class-lapin-pages.php';
require_once LAPIN_PLUGIN_DIR . 'includes/class-lapin-posts.php';
require_once LAPIN_PLUGIN_DIR . 'includes/class-lapin-reviews.php';
require_once LAPIN_PLUGIN_DIR . 'includes/class-lapin-submissions.php';
require_once LAPIN_PLUGIN_DIR . 'includes/class-lapin-turnstile.php';
require_once LAPIN_PLUGIN_DIR . 'includes/class-lapin-contact.php';
require_once LAPIN_PLUGIN_DIR . 'includes/class-lapin-sitemap.php';

register_activation_hook( __FILE__, array( 'Lapin', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Lapin', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'Lapin', 'instance' ) );

// Brand every outgoing email with the company name instead of the WordPress
// core default ("WordPress"). The from-ADDRESS is intentionally left as core's
// on-domain default (wordpress@<site-host>) so Kinsta's SPF/DKIM alignment
// holds — only the display name changes. Applies site-wide: contact form,
// password resets, admin notices, everything.
add_filter( 'wp_mail_from_name', static function () {
	return Lapin::NAME;
} );

// Single injection point for the cookie consent banner. Every Lapin template
// calls wp_footer(), so hooking here renders the banner site-wide without
// per-template edits — front-end, non-logged-in visitors on Lapin pages only
// (signed-in users are never tracked, so never prompted).
add_action( 'wp_footer', static function () {
	if ( ! Lapin::consent_ui_enabled() ) {
		return;
	}
	if ( ! Lapin::instance()->pages->is_lapin_page() ) {
		return;
	}
	require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-cookie-banner.php';
} );
