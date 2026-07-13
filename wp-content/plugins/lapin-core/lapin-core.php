<?php
/**
 * Plugin Name:       Lapin Core
 * Plugin URI:        https://github.com/daniloluang23/lapin-negotiation-services
 * Description:       Site-specific functionality for Lapin Negotiation Services (custom post types, shortcodes, integrations). Keeps functionality independent from the theme.
 * Version:           1.0.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            Danilo Luang
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       lapin-core
 *
 * @package lapin-core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'LAPIN_CORE_VERSION', '1.0.0' );
define( 'LAPIN_CORE_PATH', plugin_dir_path( __FILE__ ) );
define( 'LAPIN_CORE_URL', plugin_dir_url( __FILE__ ) );

/**
 * Load plugin modules from the includes directory.
 */
function lapin_core_init() {
	foreach ( glob( LAPIN_CORE_PATH . 'includes/*.php' ) as $module ) {
		require_once $module;
	}
}
add_action( 'plugins_loaded', 'lapin_core_init' );
