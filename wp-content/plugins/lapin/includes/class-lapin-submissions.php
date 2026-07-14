<?php
/**
 * Form submission storage — two plain MySQL tables in the WordPress
 * database (credentials come from wp-config via $wpdb, so the same code
 * runs unchanged on live), no plugins:
 *
 *   {prefix}lapin_contact_submissions — every contact-form message
 *   {prefix}lapin_newsletter_signups  — newsletter emails (unique)
 *
 * Tables are created on plugin activation (dbDelta — non-destructive,
 * safe to re-run). A read-only viewer lives under Tools → Form
 * submissions so the rows are visible without opening MySQL.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Lapin_Submissions {

	const OPT_CONTACT_TO = 'lapin_contact_recipients';

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'register_admin_page' ) );
	}

	/**
	 * Effective recipients for the contact-form notification. Editable in
	 * Submissions → Recipients (so tests can go to a personal inbox first);
	 * defaults to the business constants. The newsletter form stores
	 * signups only — it never sends notification emails.
	 */
	public static function contact_recipients(): array {
		$saved = get_option( self::OPT_CONTACT_TO );
		return is_array( $saved ) && ! empty( $saved ) ? $saved : array( Lapin::EMAIL, Lapin::EMAIL_ALT );
	}

	/** Comma-separated input → array of valid emails. */
	private static function parse_emails( string $raw ): array {
		$emails = array();
		foreach ( explode( ',', $raw ) as $candidate ) {
			$email = sanitize_email( trim( $candidate ) );
			if ( is_email( $email ) ) {
				$emails[] = $email;
			}
		}
		return array_values( array_unique( $emails ) );
	}

	private static function contact_table(): string {
		global $wpdb;
		return $wpdb->prefix . 'lapin_contact_submissions';
	}

	private static function newsletter_table(): string {
		global $wpdb;
		return $wpdb->prefix . 'lapin_newsletter_signups';
	}

	/** Create/upgrade both tables. Safe to call repeatedly. */
	public static function activate(): void {
		global $wpdb;
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		$charset = $wpdb->get_charset_collate();

		dbDelta( 'CREATE TABLE ' . self::contact_table() . " (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			created_at datetime NOT NULL,
			name varchar(190) NOT NULL,
			email varchar(190) NOT NULL,
			phone varchar(64) NOT NULL DEFAULT '',
			message text NOT NULL,
			ip varchar(45) NOT NULL DEFAULT '',
			PRIMARY KEY  (id),
			KEY created_at (created_at)
		) $charset;" );

		dbDelta( 'CREATE TABLE ' . self::newsletter_table() . " (
			id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			created_at datetime NOT NULL,
			email varchar(190) NOT NULL,
			ip varchar(45) NOT NULL DEFAULT '',
			PRIMARY KEY  (id),
			UNIQUE KEY email (email)
		) $charset;" );
	}

	/** Store a contact-form message. Returns true when the row was saved. */
	public static function log_contact( string $name, string $email, string $phone, string $message, string $ip ): bool {
		global $wpdb;
		return (bool) $wpdb->insert(
			self::contact_table(),
			array(
				'created_at' => current_time( 'mysql', true ),
				'name'       => $name,
				'email'      => $email,
				'phone'      => $phone,
				'message'    => $message,
				'ip'         => $ip,
			),
			array( '%s', '%s', '%s', '%s', '%s', '%s' )
		);
	}

	/**
	 * Store a newsletter signup. Duplicate emails are treated as success
	 * (already subscribed) without creating a second row.
	 */
	public static function log_newsletter( string $email, string $ip ): bool {
		global $wpdb;
		$saved = $wpdb->query( $wpdb->prepare(
			'INSERT IGNORE INTO ' . self::newsletter_table() . ' (created_at, email, ip) VALUES (%s, %s, %s)',
			current_time( 'mysql', true ),
			$email,
			$ip
		) );
		return false !== $saved;
	}

	/** Delete one contact submission by id. */
	public static function delete_contact( int $id ): bool {
		global $wpdb;
		return (bool) $wpdb->delete( self::contact_table(), array( 'id' => $id ), array( '%d' ) );
	}

	/** Delete one newsletter signup by id. */
	public static function delete_newsletter( int $id ): bool {
		global $wpdb;
		return (bool) $wpdb->delete( self::newsletter_table(), array( 'id' => $id ), array( '%d' ) );
	}

	/**
	 * Handle a row-delete POST on an admin page. $context is 'contact' or
	 * 'newsletter'; returns a notice string ('' when no delete happened).
	 */
	private static function handle_delete( string $context ): string {
		if ( ! isset( $_POST['lapin_delete_id'], $_POST['lapin_delete_nonce'] ) || ! current_user_can( 'manage_options' ) ) {
			return '';
		}
		$id = (int) $_POST['lapin_delete_id'];
		if ( ! wp_verify_nonce( sanitize_key( $_POST['lapin_delete_nonce'] ), "lapin_delete_{$context}_{$id}" ) ) {
			return '';
		}
		$deleted = 'contact' === $context ? self::delete_contact( $id ) : self::delete_newsletter( $id );
		return $deleted ? 'Submission deleted.' : '';
	}

	/** Per-row delete button (small form with its own nonce + confirm). */
	private static function delete_button( string $context, int $id ): void {
		?>
		<form method="post" onsubmit="return confirm('Delete this submission permanently?');" style="margin:0">
			<?php wp_nonce_field( "lapin_delete_{$context}_{$id}", 'lapin_delete_nonce', false ); ?>
			<input type="hidden" name="lapin_delete_id" value="<?php echo esc_attr( (string) $id ); ?>">
			<button type="submit" class="button-link button-link-delete">Delete</button>
		</form>
		<?php
	}

	/* ── Admin UI: Submissions menu → Contact Us / Newsletter pages ────── */

	public function register_admin_page(): void {
		add_menu_page(
			'Contact Us Submissions',
			'Submissions',
			'manage_options',
			'lapin-contact-submissions',
			array( $this, 'render_contact_page' ),
			'dashicons-email-alt2',
			26
		);
		add_submenu_page(
			'lapin-contact-submissions',
			'Contact Us Submissions',
			'Contact Us',
			'manage_options',
			'lapin-contact-submissions',
			array( $this, 'render_contact_page' )
		);
		add_submenu_page(
			'lapin-contact-submissions',
			'Newsletter Submissions',
			'Newsletter',
			'manage_options',
			'lapin-newsletter-submissions',
			array( $this, 'render_newsletter_page' )
		);
		add_submenu_page(
			'lapin-contact-submissions',
			'Form Settings',
			'Settings',
			'manage_options',
			'lapin-submission-recipients',
			array( $this, 'render_recipients_page' )
		);
	}

	public function render_recipients_page(): void {
		$notice = '';
		if ( isset( $_POST['lapin_recipients_nonce'] ) && check_admin_referer( 'lapin_recipients', 'lapin_recipients_nonce' ) && current_user_can( 'manage_options' ) ) {
			$contact_to = self::parse_emails( (string) wp_unslash( $_POST['contact_to'] ?? '' ) );
			// Empty input clears the override → falls back to the defaults.
			if ( empty( $contact_to ) ) {
				delete_option( self::OPT_CONTACT_TO );
			} else {
				update_option( self::OPT_CONTACT_TO, $contact_to, false );
			}
			update_option( Lapin_Turnstile::OPT_SITE_KEY, sanitize_text_field( (string) wp_unslash( $_POST['ts_site_key'] ?? '' ) ), false );
			update_option( Lapin_Turnstile::OPT_SECRET, sanitize_text_field( (string) wp_unslash( $_POST['ts_secret'] ?? '' ) ), false );
			$notice = 'Settings saved.';
		}
		$contact_value = implode( ', ', self::contact_recipients() );
		?>
		<div class="wrap">
			<h1>Form Settings</h1>
			<?php if ( $notice ) : ?>
			<div class="notice notice-success is-dismissible"><p><?php echo esc_html( $notice ); ?></p></div>
			<?php endif; ?>

			<h2>Notification recipients</h2>
			<p>Where contact-form notifications are emailed — put your own address here to test, then switch to the real recipients. Comma-separate multiple addresses. Leave empty and save to restore the defaults (<?php echo esc_html( Lapin::EMAIL . ', ' . Lapin::EMAIL_ALT ); ?>).</p>
			<p>Newsletter signups are stored in the database only and never send email. All submissions are stored regardless of email delivery.</p>
			<form method="post">
				<?php wp_nonce_field( 'lapin_recipients', 'lapin_recipients_nonce' ); ?>
				<table class="form-table" role="presentation">
					<tr>
						<th scope="row"><label for="contact_to">Contact form notifications</label></th>
						<td><input type="text" class="regular-text" id="contact_to" name="contact_to" value="<?php echo esc_attr( $contact_value ); ?>" placeholder="you@example.com, other@example.com"></td>
					</tr>
				</table>

				<h2>Spam protection — Cloudflare Turnstile</h2>
				<p>Paste the site key and secret key from your Cloudflare Turnstile dashboard. Leave both empty to disable the challenge (the honeypot and rate limit stay active either way). For a dry run, Cloudflare's always-pass test keys are: site <code>1x00000000000000000000AA</code> · secret <code>1x0000000000000000000000000000000AA</code>.</p>
				<table class="form-table" role="presentation">
					<tr>
						<th scope="row"><label for="ts_site_key">Turnstile site key</label></th>
						<td><input type="text" class="regular-text" id="ts_site_key" name="ts_site_key" value="<?php echo esc_attr( Lapin_Turnstile::site_key() ); ?>" autocomplete="off"></td>
					</tr>
					<tr>
						<th scope="row"><label for="ts_secret">Turnstile secret key</label></th>
						<td><input type="text" class="regular-text" id="ts_secret" name="ts_secret" value="<?php echo esc_attr( Lapin_Turnstile::secret() ); ?>" autocomplete="off"></td>
					</tr>
				</table>
				<?php submit_button( 'Save settings' ); ?>
			</form>
		</div>
		<?php
	}

	public function render_contact_page(): void {
		global $wpdb;
		$notice = self::handle_delete( 'contact' );
		$rows   = $wpdb->get_results( 'SELECT * FROM ' . self::contact_table() . ' ORDER BY id DESC LIMIT 500' );
		$total  = (int) $wpdb->get_var( 'SELECT COUNT(*) FROM ' . self::contact_table() );
		?>
		<div class="wrap">
			<h1>Contact Us Submissions</h1>
			<?php if ( $notice ) : ?>
			<div class="notice notice-success is-dismissible"><p><?php echo esc_html( $notice ); ?></p></div>
			<?php endif; ?>
			<p><?php echo esc_html( (string) $total ); ?> total<?php echo $total > 500 ? ' — latest 500 shown' : ''; ?>. Each submission was also emailed to <?php echo esc_html( Lapin::EMAIL ); ?> and <?php echo esc_html( Lapin::EMAIL_ALT ); ?>.</p>
			<table class="widefat striped">
				<thead><tr><th style="width:11em">Date (UTC)</th><th style="width:12em">Name</th><th style="width:16em">Email</th><th style="width:10em">Phone</th><th>Message</th><th style="width:6em">Actions</th></tr></thead>
				<tbody>
				<?php if ( empty( $rows ) ) : ?>
					<tr><td colspan="6">No submissions yet.</td></tr>
				<?php else : foreach ( $rows as $row ) : ?>
					<tr>
						<td><?php echo esc_html( $row->created_at ); ?></td>
						<td><?php echo esc_html( $row->name ); ?></td>
						<td><a href="mailto:<?php echo esc_attr( $row->email ); ?>"><?php echo esc_html( $row->email ); ?></a></td>
						<td><?php echo esc_html( $row->phone ); ?></td>
						<td style="white-space:pre-wrap"><?php echo esc_html( $row->message ); ?></td>
						<td><?php self::delete_button( 'contact', (int) $row->id ); ?></td>
					</tr>
				<?php endforeach; endif; ?>
				</tbody>
			</table>
		</div>
		<?php
	}

	public function render_newsletter_page(): void {
		global $wpdb;
		$notice = self::handle_delete( 'newsletter' );
		$rows   = $wpdb->get_results( 'SELECT * FROM ' . self::newsletter_table() . ' ORDER BY id DESC LIMIT 500' );
		$total  = (int) $wpdb->get_var( 'SELECT COUNT(*) FROM ' . self::newsletter_table() );
		?>
		<div class="wrap">
			<h1>Newsletter Submissions</h1>
			<?php if ( $notice ) : ?>
			<div class="notice notice-success is-dismissible"><p><?php echo esc_html( $notice ); ?></p></div>
			<?php endif; ?>
			<p><?php echo esc_html( (string) $total ); ?> subscriber<?php echo 1 === $total ? '' : 's'; ?><?php echo $total > 500 ? ' — latest 500 shown' : ''; ?>. Duplicate signups are ignored automatically.</p>
			<table class="widefat striped" style="max-width:52em">
				<thead><tr><th style="width:14em">Date (UTC)</th><th>Email</th><th style="width:6em">Actions</th></tr></thead>
				<tbody>
				<?php if ( empty( $rows ) ) : ?>
					<tr><td colspan="3">No signups yet.</td></tr>
				<?php else : foreach ( $rows as $row ) : ?>
					<tr>
						<td><?php echo esc_html( $row->created_at ); ?></td>
						<td><a href="mailto:<?php echo esc_attr( $row->email ); ?>"><?php echo esc_html( $row->email ); ?></a></td>
						<td><?php self::delete_button( 'newsletter', (int) $row->id ); ?></td>
					</tr>
				<?php endforeach; endif; ?>
				</tbody>
			</table>
		</div>
		<?php
	}
}
