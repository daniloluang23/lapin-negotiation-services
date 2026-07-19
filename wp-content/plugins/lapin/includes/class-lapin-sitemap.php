<?php
/**
 * Serves /sitemap.xml for the routed Lapin pages.
 *
 * The sitemap is generated on request (no static file to go stale, nothing
 * outside wp-content to deploy) and intercepted in `parse_request`, so it
 * needs no rewrite rule and no flush. URLs mirror the canonical style used
 * by lapin-head.php: home_url( '/' ) . 'slug/'. Core's /wp-sitemap.xml is
 * disabled — it would advertise users and unrouted sample pages, and two
 * competing sitemaps is worse than one exact one.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Lapin_Sitemap {

	public function __construct() {
		add_filter( 'wp_sitemaps_enabled', '__return_false' );
		add_action( 'parse_request', array( $this, 'maybe_render' ) );
		add_filter( 'robots_txt', array( $this, 'add_to_robots' ) );
	}

	/** Serve the sitemap and stop WordPress when /sitemap.xml is requested. */
	public function maybe_render( WP $wp ): void {
		$path = $wp->request;
		if ( '' === $path ) {
			// Plain permalinks leave $wp->request empty — fall back to the raw path.
			$path = trim( (string) wp_parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
		}
		if ( 'sitemap.xml' !== $path ) {
			return;
		}

		status_header( 200 );
		header( 'Content-Type: application/xml; charset=UTF-8' );
		header( 'X-Robots-Tag: noindex' ); // The sitemap itself shouldn't appear in results.

		echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
		echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
		foreach ( $this->entries() as $entry ) {
			echo "\t<url>\n";
			echo "\t\t<loc>" . esc_url( $entry['loc'] ) . "</loc>\n";
			if ( '' !== $entry['lastmod'] ) {
				echo "\t\t<lastmod>" . esc_xml( $entry['lastmod'] ) . "</lastmod>\n";
			}
			echo "\t</url>\n";
		}
		echo '</urlset>' . "\n";
		exit;
	}

	/**
	 * loc/lastmod pairs for the home page and every routed slug.
	 * Pages missing from the database would 404, so they are skipped.
	 */
	private function entries(): array {
		$home    = home_url( '/' );
		$entries = array(
			array( 'loc' => $home, 'lastmod' => $this->lastmod( 'home' ) ),
		);
		foreach ( array_keys( Lapin_Pages::ROUTES ) as $slug ) {
			if ( null === get_page_by_path( $slug, OBJECT, 'page' ) ) {
				continue;
			}
			$entries[] = array(
				'loc'     => $home . $slug . '/',
				'lastmod' => $this->lastmod( $slug ),
			);
		}
		return $entries;
	}

	/** W3C datetime of the page's last edit, or '' when unknown. */
	private function lastmod( string $slug ): string {
		$page = get_page_by_path( $slug, OBJECT, 'page' );
		if ( null === $page || '0000-00-00 00:00:00' === $page->post_modified_gmt ) {
			return '';
		}
		return gmdate( 'Y-m-d\TH:i:sP', strtotime( $page->post_modified_gmt . ' +0000' ) );
	}

	/** Advertise the sitemap in the virtual robots.txt. */
	public function add_to_robots( string $output ): string {
		return $output . "\nSitemap: " . home_url( '/sitemap.xml' ) . "\n";
	}
}
