<?php
/**
 * Google reviews — server-side cached, rendered as first-party HTML.
 *
 * Dynamic without shipping third-party JS: when the Trustindex plugin is
 * active (it syncs the business's Google reviews into WordPress and renders
 * them server-side), we run its shortcode in a buffer ON THE SERVER, parse
 * the review data out of that markup, and cache the structured result in a
 * transient. The page then renders our own lightweight cards from cache —
 * new reviews flow in automatically as the plugin syncs, visitors never
 * load cdn.trustindex.io, and the section costs zero Lighthouse points.
 *
 * Fallback chain: transient cache → live parse of the Trustindex shortcode
 * → bundled snapshot (lapin-reviews-data.php, script-migrated 2026-07-14).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Lapin_Reviews {

	const CACHE_KEY = 'lapin_reviews_v1';
	const CACHE_TTL = 12 * HOUR_IN_SECONDS;

	/**
	 * Reviews as array of [ name, date, stars, text ], newest first.
	 */
	public static function get(): array {
		$cached = get_transient( self::CACHE_KEY );
		if ( is_array( $cached ) && ! empty( $cached ) ) {
			return $cached;
		}

		$fresh = self::from_trustindex();
		if ( null !== $fresh ) {
			set_transient( self::CACHE_KEY, $fresh, self::CACHE_TTL );
			return $fresh;
		}

		// Bundled snapshot — also cached briefly so a broken plugin state
		// doesn't re-run the parse attempt on every request.
		$bundled = require LAPIN_PLUGIN_DIR . 'includes/lapin-reviews-data.php';
		set_transient( self::CACHE_KEY, $bundled, HOUR_IN_SECONDS );
		return $bundled;
	}

	/**
	 * Harvest structured review data from the Trustindex plugin's
	 * server-rendered shortcode output. Returns null when the plugin is
	 * absent or the markup yields fewer than three parseable reviews.
	 */
	private static function from_trustindex(): ?array {
		if ( ! shortcode_exists( 'trustindex' ) ) {
			return null;
		}

		$shortcode = apply_filters( 'lapin_reviews_shortcode', '[trustindex]' );
		$html      = (string) do_shortcode( $shortcode );

		// The shortcode may enqueue the widget loader — the page renders our
		// own cards, so drop any trustindex script handles it registered.
		foreach ( array( 'trustindex-loader-js', 'trustindex-loader', 'trustindex-js' ) as $handle ) {
			wp_dequeue_script( $handle );
			wp_deregister_script( $handle );
		}

		if ( '' === trim( $html ) || false === stripos( $html, 'ti-review-header' ) ) {
			return null;
		}

		$doc = new DOMDocument();
		libxml_use_internal_errors( true );
		$doc->loadHTML( '<?xml encoding="utf-8" ?><div>' . $html . '</div>' );
		libxml_clear_errors();
		$xp = new DOMXPath( $doc );

		$reviews = array();
		$seen    = array();
		foreach ( $xp->query( '//*[contains(concat(" ", normalize-space(@class), " "), " ti-review-header ")]' ) as $header ) {
			$item  = $header->parentNode;
			$name  = trim( $xp->evaluate( 'string(.//*[contains(@class,"ti-name")])', $item ) );
			$date  = trim( $xp->evaluate( 'string(.//*[contains(@class,"ti-date")])', $item ) );
			$stars = $xp->query( './/*[contains(@class,"ti-stars")]//*[contains(@class,"ti-star")]', $item )->length;
			$text  = '';
			foreach ( $xp->query( './/*[contains(@class,"ti-review-content") or contains(@class,"ti-review-text")]', $item ) as $node ) {
				$text = trim( preg_replace( '/\s+/', ' ', $node->textContent ) );
				break;
			}
			$text = preg_replace( '/\s*Read more\s*$/i', '', (string) $text );

			$key = $name . '|' . $date;
			if ( '' === $name || '' === $text || isset( $seen[ $key ] ) ) {
				continue;
			}
			$seen[ $key ] = true;
			$reviews[]    = array(
				'name'  => $name,
				'date'  => $date,
				'stars' => max( 1, min( 5, $stars ) ),
				'text'  => $text,
			);
		}

		return count( $reviews ) >= 3 ? $reviews : null;
	}
}
