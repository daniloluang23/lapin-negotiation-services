<?php
/**
 * TEMPORARY deploy / OPcache diagnostic — safe to delete.
 *
 * Reads the *actually deployed* contact handler on this server and reports
 * whether the From-name fix is present in it, plus the file's timestamp and
 * (if available) what OPcache has cached for it. No secrets, read-only.
 *
 * Token: LAPIN-PROBE-7F3A9C
 */

header( 'Content-Type: text/plain; charset=utf-8' );

echo "LAPIN-PROBE-7F3A9C\n";
echo 'php=' . PHP_VERSION . "\n";

$file = __DIR__ . '/includes/class-lapin-contact.php';
echo 'contact_file_exists=' . ( file_exists( $file ) ? '1' : '0' ) . "\n";

if ( file_exists( $file ) ) {
	echo 'mtime=' . gmdate( 'Y-m-d H:i:s', (int) filemtime( $file ) ) . " UTC\n";
	echo 'size=' . filesize( $file ) . "\n";
	$src = (string) file_get_contents( $file );
	echo 'has_phpmailer_init=' . ( false !== strpos( $src, 'phpmailer_init' ) ? '1' : '0' ) . "\n";
	echo 'has_from_filter=' . ( false !== strpos( $src, 'wp_mail_from_name' ) ? '1' : '0' ) . "\n";
}

if ( function_exists( 'opcache_get_status' ) ) {
	$status = @opcache_get_status();
	if ( is_array( $status ) && ! empty( $status['scripts'] ) ) {
		$found = false;
		foreach ( $status['scripts'] as $path => $info ) {
			if ( false !== strpos( (string) $path, 'class-lapin-contact.php' ) ) {
				$found = true;
				echo 'opcache_cached=1' . "\n";
				echo 'opcache_ts=' . gmdate( 'Y-m-d H:i:s', (int) ( $info['timestamp'] ?? 0 ) ) . " UTC\n";
			}
		}
		if ( ! $found ) {
			echo "opcache_cached=0\n";
		}
		echo 'opcache_validate_timestamps=' . ( ini_get( 'opcache.validate_timestamps' ) ? '1' : '0' ) . "\n";
		echo 'opcache_revalidate_freq=' . ini_get( 'opcache.revalidate_freq' ) . "\n";
	} else {
		echo "opcache_status=restricted_or_off\n";
	}
} else {
	echo "opcache_func=missing\n";
}

echo 'server_path=' . __DIR__ . "\n";
echo 'home=' . ( function_exists( 'home_url' ) ? 'wp_loaded' : 'standalone' ) . "\n";
