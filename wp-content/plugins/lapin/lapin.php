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
