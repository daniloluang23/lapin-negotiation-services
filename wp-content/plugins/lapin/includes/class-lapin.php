<?php
/**
 * Main plugin bootstrap + single source of truth for business facts.
 *
 * Every template and schema block reads contact facts from here so a phone
 * number change is a one-line edit.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Lapin {

	const NAME        = 'Lapin Negotiation Services';
	const TAGLINE     = 'Building Bridges. Resolving Differences.';
	// Client final revision 2026-07-22: single hero subline, body line retired.
	const SUBLINE_LEAD = 'Trusted Mediation and Negotiation Services for Individuals, Businesses, Families, and Organizations';
	const PHONE_LOCAL = '310-984-6952';
	const PHONE_FREE  = '888-964-8884';
	const PHONE_LOCAL_TEL = '+13109846952';
	const PHONE_FREE_TEL  = '+18889648884';
	const EMAIL       = 'info@LapinNegotiationServices.com';
	const EMAIL_ALT   = 'raphael@lapinnegotiationservices.com';
	const ADDR_NAME   = 'The Tower';
	const ADDR_STREET = '10940 Wilshire Blvd, Suite 1600';
	const ADDR_CITY   = 'Los Angeles';
	const ADDR_STATE  = 'CA';
	const ADDR_ZIP    = '90024';
	const MAPS_URL    = 'https://www.google.com/maps/search/?api=1&query=10940+Wilshire+Blvd+Suite+1600+Los+Angeles+CA+90024';
	const GOOGLE_REVIEWS = 'https://search.google.com/local/reviews?placeid=ChIJCcA3BH67woARJ5tpawFYfUI';
	const GOOGLE_WRITE_REVIEW = 'https://search.google.com/local/writereview?placeid=ChIJCcA3BH67woARJ5tpawFYfUI';
	const LINKEDIN    = 'https://www.linkedin.com/company/lapin-negotiation-services/';
	const FACEBOOK    = 'https://www.facebook.com/raphael.lapin';
	const YOUTUBE     = 'https://www.youtube.com/channel/UCjk2jKQWC2SMIim4eR45wLw';

	private static ?Lapin $instance = null;

	public Lapin_Pages $pages;
	public Lapin_Contact $contact;
	public Lapin_Sitemap $sitemap;
	public Lapin_Submissions $submissions;

	public static function instance(): Lapin {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		$this->pages       = new Lapin_Pages();
		$this->contact     = new Lapin_Contact();
		$this->sitemap     = new Lapin_Sitemap();
		$this->submissions = new Lapin_Submissions();
	}

	/** Absolute URL for a plugin asset. */
	public static function asset( string $rel ): string {
		return LAPIN_PLUGIN_URL . 'assets/' . ltrim( $rel, '/' );
	}

	/**
	 * Inline SVG icon from assets/icons (Lucide, ISC license).
	 *
	 * Inlined so icons cost zero requests, scale crisply at any size, and
	 * take their colour from CSS currentColor. Decorative: aria-hidden.
	 */
	public static function icon( string $name, string $class = 'icon' ): string {
		$file = LAPIN_PLUGIN_DIR . 'assets/icons/' . $name . '.svg';
		if ( ! file_exists( $file ) ) {
			return '';
		}
		$svg = (string) file_get_contents( $file );
		$svg = preg_replace( '/<!--.*?-->/s', '', $svg );          // license comment lives in the .svg file
		$svg = preg_replace( '/\sclass="[^"]*"/', '', $svg, 1 );   // drop lucide-static's own class attr
		return str_replace(
			'<svg',
			'<svg class="' . esc_attr( $class ) . '" aria-hidden="true" focusable="false"',
			trim( $svg )
		);
	}

	/** One-line street address for display. */
	public static function address_line(): string {
		return self::ADDR_NAME . ', ' . self::ADDR_STREET . ', ' . self::ADDR_CITY . ', ' . self::ADDR_STATE . ' ' . self::ADDR_ZIP;
	}

	public static function activate(): void {
		Lapin_Pages::activate();
		Lapin_Submissions::activate();
		flush_rewrite_rules();
	}

	public static function deactivate(): void {
		flush_rewrite_rules();
	}
}
