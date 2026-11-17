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
	const SUBLINE_LEAD = 'Trusted Mediation & Negotiation Services for Individuals, Families, Businesses and Organizations.';
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

	// Analytics / Search Console.
	const GA4_ID           = 'G-YDVFENWDSD';           // GA4 Measurement ID (same property as the pre-redesign site).
	const GSC_VERIFICATION = '';                        // Optional google-site-verification token; the meta tag is only emitted when non-empty. The live domain is already verified in Search Console, so this normally stays blank.
	const PROD_HOSTS       = array( 'lapinnegotiationservices.com', 'www.lapinnegotiationservices.com' );

	// Paid media conversion tracking (Logical Position, snippets sent 04.09.26).
	// Same consent gate as GA4: see tracking_allowed() and lapin-analytics.php.
	const GOOGLE_ADS_ID         = 'AW-706048676';         // Google Ads tag, configured on the shared gtag.js.
	const GOOGLE_ADS_CALL_LABEL = 'jKMKCLepyO4cEKTl1dAC'; // Website call conversion (Google forwarding number swaps PHONE_LOCAL).
	const MS_UET_ID             = '56183216';             // Microsoft Advertising UET tag.
	const CONSENT_COOKIE   = 'lapin_cookie_consent';    // First-party opt-out cookie: '' (unset) | 'accepted' | 'rejected'.
	const LEAD_COOKIE      = 'lapin_lead';              // One-time flag set on a real contact form send; consumed by lapin-analytics.php.

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

	/**
	 * Central gate for front-end analytics and ad tags (GA4, Google Ads,
	 * Microsoft UET). Opt-out model, tuned for California CCPA/CPRA. Returns
	 * false — none of them are emitted — when any of:
	 *
	 *  - Non-production host (the Local .local dev site, staging, previews). GA
	 *    must only fire on the live domain so dev traffic never pollutes the data.
	 *  - The visitor is logged in (client request: never track signed-in users).
	 *
	 * The visitor's opt-out (Reject cookie, or Global Privacy Control without an
	 * explicit Accept) is deliberately NOT checked here. The live edge cache
	 * serves one copy of each page to everyone, so a server-side opt-out check
	 * does nothing for cached pages, and worse: an opted-out visitor (Brave sends
	 * Sec-GPC by default) hitting a cache miss would get a tag-free page cached
	 * for every visitor. The opt-out is enforced in the browser instead, by the
	 * head gate in lapin-analytics.php and by the cookie banner.
	 */
	public static function tracking_allowed(): bool {
		$host = wp_parse_url( home_url(), PHP_URL_HOST );
		if ( ! in_array( $host, self::PROD_HOSTS, true ) ) {
			return false;
		}
		return ! is_user_logged_in();
	}

	/**
	 * True when the cookie banner / privacy-choices control should render.
	 * Front-end, non-logged-in visitors only (signed-in users are never tracked,
	 * so they are never prompted). Host-agnostic so the banner is testable on the
	 * .local dev site — the prod-only rule lives in tracking_allowed() instead.
	 */
	public static function consent_ui_enabled(): bool {
		return ! is_admin() && ! is_user_logged_in();
	}

	public static function activate(): void {
		Lapin_Pages::activate();
		Lapin_Posts::seed();
		Lapin_Submissions::activate();
		flush_rewrite_rules();
	}

	public static function deactivate(): void {
		flush_rewrite_rules();
	}
}
