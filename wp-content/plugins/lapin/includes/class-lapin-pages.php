<?php
/**
 * Serves the Lapin page templates and keeps their <head> lean.
 *
 * Flow (copied from the Legalia architecture):
 *   1. `template_include` — when the request matches one of the routed slugs
 *      (or the static front page), short-circuit WordPress and load the
 *      template from this plugin. Works on block themes, which hide the
 *      classic Template dropdown.
 *   2. `wp_enqueue_scripts` @99 — dequeue the active theme's stylesheets on
 *      Lapin templates only. Templates are 100% self-styled with inline CSS,
 *      so theme CSS is pure render-blocking dead weight here.
 *   3. `wp` — strip duplicate/unused head output (emoji, oEmbed, REST link,
 *      canonical, robots, global styles). Each template emits its own
 *      title/meta/canonical/schema.
 *   4. Activation — create the seven pages if missing and point the site's
 *      front page at Home, so a fresh install renders without manual setup.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Lapin_Pages {

	/**
	 * slug => [ template file, page title ].
	 * The front page is handled separately via is_front_page().
	 */
	const ROUTES = array(
		'overview'           => array( 'page-lapin-overview.php', 'About Us' ),
		'practice-areas'     => array( 'page-lapin-practice-areas.php', 'Practice Areas' ),
		'negotiation'        => array( 'page-lapin-negotiation.php', 'Negotiation' ),
		'dispute-resolution' => array( 'page-lapin-dispute-resolution.php', 'Dispute Resolution' ),
		'mediation'          => array( 'page-lapin-mediation.php', 'Mediation' ),
		'contact'            => array( 'page-lapin-contact.php', 'Contact' ),
	);

	const HOME_TEMPLATE = 'page-lapin-home.php';
	const HOME_TITLE    = 'Home';

	public function __construct() {
		add_filter( 'template_include', array( $this, 'load_template' ) );
		// Priority 99: runs after the theme enqueues at 10, so dequeue sticks.
		add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_theme_styles' ), 99 );
		add_action( 'wp', array( $this, 'clean_head' ) );
	}

	public function load_template( string $template ): string {
		$file = $this->current_template();
		if ( null === $file ) {
			return $template;
		}
		$plugin_template = LAPIN_PLUGIN_DIR . 'templates/' . $file;
		if ( ! file_exists( $plugin_template ) ) {
			return $template;
		}
		// locate_block_template() has already queued the template-canvas
		// title + viewport for wp_head by the time this filter runs — our
		// templates emit their own, so drop the duplicates here (the 'wp'
		// hook in clean_head() fires too early to catch these two).
		remove_action( 'wp_head', '_block_template_viewport_meta_tag', 0 );
		remove_action( 'wp_head', '_block_template_render_title_tag', 1 );
		return $plugin_template;
	}

	public function dequeue_theme_styles(): void {
		if ( ! $this->is_lapin_page() ) {
			return;
		}
		wp_dequeue_style( 'twentytwentyfive-style' );
		wp_dequeue_style( 'lapin-negotiation-services-style' );
		wp_dequeue_style( 'wp-block-template-skip-link' );
	}

	public function clean_head(): void {
		if ( ! $this->is_lapin_page() ) {
			return;
		}
		// Templates emit their own title, canonical, robots, and viewport.
		remove_action( 'wp_head', '_wp_render_title_tag', 1 );
		remove_action( 'wp_head', '_block_template_render_title_tag', 1 );
		remove_action( 'wp_head', '_block_template_viewport_meta_tag', 0 );
		remove_action( 'wp_head', 'rel_canonical' );
		remove_action( 'wp_head', 'wp_responsive_meta_tags', 0 );
		add_filter( 'wp_robots', '__return_empty_array' );

		// Unused WordPress head/foot output: bytes with no reader.
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'rest_output_link_wp_head' );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		// The active theme's @font-face rules (Manrope/Fira Code) — unused here.
		remove_action( 'wp_head', 'wp_print_font_faces', 50 );
		remove_action( 'wp_footer', 'the_block_template_skip_link' );
		// Block-theme global styles + layout CSS are large and unused here.
		remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
		remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
	}

	public function is_lapin_page(): bool {
		return null !== $this->current_template();
	}

	/** Template file for the current request, or null when not a Lapin page. */
	private function current_template(): ?string {
		if ( is_front_page() && ! is_home() ) {
			return self::HOME_TEMPLATE;
		}
		if ( is_page() ) {
			$slug = get_post_field( 'post_name', get_queried_object_id() );
			if ( isset( self::ROUTES[ $slug ] ) ) {
				return self::ROUTES[ $slug ][0];
			}
		}
		return null;
	}

	/**
	 * Create the routed pages on activation and point the front page at Home.
	 * Existing pages (matched by slug) are left untouched.
	 */
	public static function activate(): void {
		$pages = array_merge(
			array( 'home' => array( self::HOME_TEMPLATE, self::HOME_TITLE ) ),
			self::ROUTES
		);

		foreach ( $pages as $slug => $route ) {
			$existing = get_page_by_path( $slug, OBJECT, 'page' );
			$page_id  = $existing ? $existing->ID : 0;

			if ( ! $page_id ) {
				$page_id = wp_insert_post( array(
					'post_type'   => 'page',
					'post_status' => 'publish',
					'post_name'   => $slug,
					'post_title'  => $route[1],
				) );
			}

			if ( 'home' === $slug && $page_id && ! is_wp_error( $page_id ) ) {
				update_option( 'show_on_front', 'page' );
				update_option( 'page_on_front', (int) $page_id );
			}
		}
	}
}
