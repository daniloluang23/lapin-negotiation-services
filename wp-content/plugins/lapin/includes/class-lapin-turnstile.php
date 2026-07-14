<?php
/**
 * Cloudflare Turnstile for the contact + newsletter forms.
 *
 * Spam defence layer 3 (after the honeypot and the per-IP rate limit):
 * a managed Turnstile challenge, verified SERVER-SIDE against Cloudflare
 * before anything is stored or emailed.
 *
 * Performance: the Turnstile script is never render-blocking — the footer
 * JS injects it only on the visitor's first interaction with a form
 * (focus/pointer), then renders the widgets explicitly. Lighthouse never
 * loads it; real visitors get it warm before they can finish typing.
 *
 * Keys live in Submissions → Settings. With no keys saved, Turnstile is
 * OFF and the forms fall back to honeypot + rate limit only. Cloudflare's
 * always-pass test keys can be used for a dry run:
 *   site 1x00000000000000000000AA · secret 1x0000000000000000000000000000000AA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Lapin_Turnstile {

	const OPT_SITE_KEY = 'lapin_turnstile_site_key';
	const OPT_SECRET   = 'lapin_turnstile_secret';
	const VERIFY_URL   = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

	public static function site_key(): string {
		return (string) get_option( self::OPT_SITE_KEY, '' );
	}

	public static function secret(): string {
		return (string) get_option( self::OPT_SECRET, '' );
	}

	/** Enabled only when both keys are configured. */
	public static function enabled(): bool {
		return '' !== self::site_key() && '' !== self::secret();
	}

	/**
	 * Widget slot markup (hydrated lazily by the footer JS). $theme is
	 * 'light' (contact page) or 'dark' (footer newsletter).
	 */
	public static function slot( string $theme = 'light', string $size = 'normal' ): string {
		if ( ! self::enabled() ) {
			return '';
		}
		return sprintf(
			'<div class="ts-slot" data-turnstile-slot data-sitekey="%s" data-theme="%s" data-size="%s"></div>',
			esc_attr( self::site_key() ),
			esc_attr( $theme ),
			esc_attr( $size )
		);
	}

	/**
	 * Server-side verification of the submitted token. Returns true when
	 * Turnstile is disabled (feature off) or Cloudflare confirms the token.
	 */
	public static function verify(): bool {
		if ( ! self::enabled() ) {
			return true;
		}
		$token = sanitize_text_field( wp_unslash( (string) ( $_POST['cf-turnstile-response'] ?? '' ) ) );
		if ( '' === $token ) {
			return false;
		}
		$response = wp_remote_post( self::VERIFY_URL, array(
			'timeout' => 8,
			'body'    => array(
				'secret'   => self::secret(),
				'response' => $token,
				'remoteip' => sanitize_text_field( (string) ( $_SERVER['REMOTE_ADDR'] ?? '' ) ),
			),
		) );
		if ( is_wp_error( $response ) ) {
			// Cloudflare unreachable: fail open so real visitors aren't
			// blocked by an outage — honeypot + rate limit still apply.
			return true;
		}
		$body = json_decode( (string) wp_remote_retrieve_body( $response ), true );
		return is_array( $body ) && ! empty( $body['success'] );
	}
}
