-- Lapin form-submission tables — manual creation script.
--
-- The plugin creates these automatically on activation
-- (Lapin_Submissions::activate() via dbDelta), so running this file is
-- OPTIONAL — it exists for creating the tables by hand (e.g. phpMyAdmin
-- on the live database before/without reactivating the plugin).
--
-- NOTE: table names assume the default `wp_` prefix. If the live site
-- uses a different $table_prefix in wp-config.php, rename accordingly
-- (e.g. xyz_lapin_contact_submissions).
--
-- Safe to re-run: IF NOT EXISTS leaves existing tables untouched.

-- Every contact-form message (stored before the notification email is
-- attempted, so submissions are never lost to a mail failure).
CREATE TABLE IF NOT EXISTS wp_lapin_contact_submissions (
	id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	created_at DATETIME NOT NULL,
	name VARCHAR(190) NOT NULL,
	email VARCHAR(190) NOT NULL,
	phone VARCHAR(64) NOT NULL DEFAULT '',
	message TEXT NOT NULL,
	ip VARCHAR(45) NOT NULL DEFAULT '',
	PRIMARY KEY (id),
	KEY created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Newsletter signups (storage only — no notification emails). The UNIQUE
-- key on email makes duplicate signups a no-op.
CREATE TABLE IF NOT EXISTS wp_lapin_newsletter_signups (
	id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	created_at DATETIME NOT NULL,
	email VARCHAR(190) NOT NULL,
	ip VARCHAR(45) NOT NULL DEFAULT '',
	PRIMARY KEY (id),
	UNIQUE KEY email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
