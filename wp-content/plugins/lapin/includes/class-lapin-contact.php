<?php
/**
 * Contact form handler — plain admin-post.php POST, no form plugin.
 *
 * Spam defence is a honeypot field ("company") plus a nonce plus a per-IP
 * rate limit. On success, redirects back to /contact/?sent=1; on failure,
 * redirects with an error code and stashes the submitted values in a
 * short-lived transient so the visitor doesn't retype the message.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Lapin_Contact {

	const ACTION            = 'lapin_contact';
	const NEWSLETTER_ACTION = 'lapin_newsletter';

	public function __construct() {
		add_action( 'admin_post_' . self::ACTION, array( $this, 'handle' ) );
		add_action( 'admin_post_nopriv_' . self::ACTION, array( $this, 'handle' ) );
		add_action( 'admin_post_' . self::NEWSLETTER_ACTION, array( $this, 'handle_newsletter' ) );
		add_action( 'admin_post_nopriv_' . self::NEWSLETTER_ACTION, array( $this, 'handle_newsletter' ) );
	}

	/**
	 * Footer newsletter signup — same defence stack as the contact form
	 * (nonce + honeypot + per-IP rate limit), then an email to the office
	 * inbox. Redirects back to the submitting page with ?nl=1#newsletter.
	 */
	public function handle_newsletter(): void {
		$back = wp_get_referer() ? remove_query_arg( array( 'nl' ), wp_get_referer() ) : home_url( '/' );

		if ( ! isset( $_POST['lapin_newsletter_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['lapin_newsletter_nonce'] ), self::NEWSLETTER_ACTION ) ) {
			wp_safe_redirect( $back . '#newsletter' );
			exit;
		}
		if ( '' !== trim( (string) ( $_POST['company'] ?? '' ) ) ) {
			// Honeypot hit: pretend success; give bots nothing to learn from.
			wp_safe_redirect( add_query_arg( 'nl', '1', $back ) . '#newsletter' );
			exit;
		}
		if ( ! Lapin_Turnstile::verify() ) {
			wp_safe_redirect( add_query_arg( 'nl_error', '1', $back ) . '#newsletter' );
			exit;
		}
		$ip  = sanitize_text_field( (string) ( $_SERVER['REMOTE_ADDR'] ?? '' ) );
		$key = 'lapin_newsletter_' . md5( $ip );
		$email = sanitize_email( wp_unslash( (string) ( $_POST['email'] ?? '' ) ) );
		if ( ! get_transient( $key ) && is_email( $email ) ) {
			// Storage only — newsletter signups never send email.
			Lapin_Submissions::log_newsletter( $email, $ip );
			set_transient( $key, 1, MINUTE_IN_SECONDS );
		}
		wp_safe_redirect( add_query_arg( 'nl', '1', $back ) . '#newsletter' );
		exit;
	}

	public function handle(): void {
		$back = home_url( '/contact/' );

		if ( ! isset( $_POST['lapin_contact_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['lapin_contact_nonce'] ), self::ACTION ) ) {
			$this->redirect( $back, 'expired' );
		}

		// Honeypot: real visitors never see or fill this field.
		if ( '' !== trim( (string) ( $_POST['company'] ?? '' ) ) ) {
			$this->redirect( $back, '', true ); // Pretend success; give bots nothing to learn from.
		}

		// Rate limit: one message per IP per minute.
		$ip  = sanitize_text_field( (string) ( $_SERVER['REMOTE_ADDR'] ?? '' ) );
		$key = 'lapin_contact_' . md5( $ip );
		if ( get_transient( $key ) ) {
			$this->redirect( $back, 'rate' );
		}

		$name    = sanitize_text_field( wp_unslash( (string) ( $_POST['name'] ?? '' ) ) );
		$email   = sanitize_email( wp_unslash( (string) ( $_POST['email'] ?? '' ) ) );
		$phone   = sanitize_text_field( wp_unslash( (string) ( $_POST['phone'] ?? '' ) ) );
		$message = sanitize_textarea_field( wp_unslash( (string) ( $_POST['message'] ?? '' ) ) );

		if ( '' === $name || '' === $message || ! is_email( $email ) ) {
			set_transient( 'lapin_contact_old_' . md5( $ip ), compact( 'name', 'email', 'phone', 'message' ), 5 * MINUTE_IN_SECONDS );
			$this->redirect( $back, 'invalid' );
		}

		// Spam gate: server-verified Turnstile (when keys are configured).
		if ( ! Lapin_Turnstile::verify() ) {
			set_transient( 'lapin_contact_old_' . md5( $ip ), compact( 'name', 'email', 'phone', 'message' ), 5 * MINUTE_IN_SECONDS );
			$this->redirect( $back, 'captcha' );
		}

		// Save first — the submission is never lost, even if mail fails.
		$saved = Lapin_Submissions::log_contact( $name, $email, $phone, $message, $ip );

		$to      = apply_filters( 'lapin_contact_recipient', Lapin_Submissions::contact_recipients() );
		$subject = sprintf( 'Website inquiry from %s', $name );
		$body    = "A submission was submitted on the contact us form.\n\nName: {$name}\nEmail: {$email}\nPhone: {$phone}\n\n{$message}\n\n—\nSent from the contact form on " . home_url( '/' );
		$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

		$sent = wp_mail( $to, $subject, $body, $headers );
		set_transient( $key, 1, MINUTE_IN_SECONDS );

		// Success when the message reached the database or the inbox;
		// 'failed' only when both routes were lost.
		$ok = $saved || $sent;
		$this->redirect( $back, $ok ? '' : 'failed', $ok );
	}

	/** Old input for re-populating the form after a validation error. */
	public static function old_input(): array {
		$ip  = sanitize_text_field( (string) ( $_SERVER['REMOTE_ADDR'] ?? '' ) );
		$old = get_transient( 'lapin_contact_old_' . md5( $ip ) );
		return is_array( $old ) ? $old : array();
	}

	private function redirect( string $back, string $error, bool $ok = false ): void {
		$url = $ok || '' === $error
			? add_query_arg( 'sent', '1', $back )
			: add_query_arg( 'contact_error', rawurlencode( $error ), $back );
		wp_safe_redirect( $url . '#contact-form' );
		exit;
	}
}
