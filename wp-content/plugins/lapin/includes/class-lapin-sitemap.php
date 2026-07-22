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
		add_filter( 'robots_txt', array( $this, 'add_to_robots' ), 10, 2 );
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
	 * loc/lastmod pairs for the home page, every routed slug, and every
	 * published blog post (root-level slugs, same URL style as the pages).
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
		foreach ( get_posts( array( 'post_type' => 'post', 'post_status' => 'publish', 'numberposts' => -1 ) ) as $post ) {
			$entries[] = array(
				'loc'     => $home . $post->post_name . '/',
				'lastmod' => '0000-00-00 00:00:00' === $post->post_modified_gmt
					? ''
					: gmdate( 'Y-m-d\TH:i:sP', strtotime( $post->post_modified_gmt . ' +0000' ) ),
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

	/**
	 * Build the virtual robots.txt: keep WordPress's default rules, explicitly
	 * welcome the major search engines and AI assistants, and advertise the
	 * sitemap. Honors the "Discourage search engines" setting — when the site
	 * is marked non-public, WordPress's blocking default is left untouched.
	 *
	 * @param string $output WordPress's default robots.txt body.
	 * @param mixed  $public The blog_public option ('1' when indexable).
	 */
	public function add_to_robots( string $output, $public = '1' ): string {
		if ( ! $public ) {
			return $output;
		}

		// Named crawlers each get the whole site except wp-admin — identical to
		// the default `*` rules, so there is no ambiguity that search engines
		// and AI assistants are welcome to crawl, index, and cite this site.
		$agents = array(
			// Search engines.
			'Googlebot', 'Googlebot-Image', 'Bingbot', 'Applebot', 'DuckDuckBot',
			// AI assistants / AI search.
			'Google-Extended', 'GPTBot', 'OAI-SearchBot', 'ChatGPT-User',
			'ClaudeBot', 'Claude-Web', 'Claude-User', 'anthropic-ai',
			'PerplexityBot', 'Perplexity-User', 'Amazonbot', 'Applebot-Extended',
			'Meta-ExternalAgent', 'cohere-ai', 'CCBot',
		);

		$welcome = "\n# Search engines and AI assistants are welcome to crawl, index, and cite this site.\n";
		foreach ( $agents as $agent ) {
			$welcome .= "\nUser-agent: {$agent}\nAllow: /\nDisallow: /wp-admin/\n";
		}

		return $output . $welcome . "\nSitemap: " . home_url( '/sitemap.xml' ) . "\n";
	}
}
