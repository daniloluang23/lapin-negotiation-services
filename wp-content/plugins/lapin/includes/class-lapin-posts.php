<?php
/**
 * Blog posts — data access + activation seeding.
 *
 * Post copy lives in lapin-posts-data.php (script-migrated verbatim from the
 * client's staging site; URLs unchanged). On activation the posts are created
 * in wp_posts by slug (non-destructive: existing posts are left untouched),
 * so the client can keep editing or adding posts in wp-admin afterwards.
 * Featured images are plugin assets by convention:
 * assets/images/blog/{slug}.webp (hero) and {slug}-640.webp (teaser).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Lapin_Posts {

	private static ?array $data = null;

	/** Migrated post data keyed by slug. */
	public static function data(): array {
		if ( null === self::$data ) {
			self::$data = require LAPIN_PLUGIN_DIR . 'includes/lapin-posts-data.php';
		}
		return self::$data;
	}

	/**
	 * Featured image for a post slug: array( url, width, height ) or null.
	 * Falls back to measuring unknown (wp-admin-authored) posts' images is
	 * not attempted — posts without a matching asset simply render text-only.
	 */
	public static function image( string $slug, bool $thumb = false ): ?array {
		$file = 'images/blog/' . $slug . ( $thumb ? '-640' : '' ) . '.webp';
		if ( ! file_exists( LAPIN_PLUGIN_DIR . 'assets/' . $file ) ) {
			return null;
		}
		$meta = self::data()[ $slug ] ?? null;
		if ( null === $meta ) {
			return null;
		}
		return $thumb
			? array( Lapin::asset( $file ), $meta['thumb_w'], $meta['thumb_h'] )
			: array( Lapin::asset( $file ), $meta['img_w'], $meta['img_h'] );
	}

	/** Meta description for a post (migrated, first-paragraph derived). */
	public static function description( string $slug ): string {
		return self::data()[ $slug ]['desc'] ?? '';
	}

	/** Create missing posts by slug. Existing posts are never modified. */
	public static function seed(): void {
		foreach ( self::data() as $slug => $post ) {
			if ( get_page_by_path( $slug, OBJECT, 'post' ) ) {
				continue;
			}
			wp_insert_post( array(
				'post_type'     => 'post',
				'post_status'   => 'publish',
				'post_name'     => $slug,
				'post_title'    => $post['title'],
				'post_content'  => $post['content'],
				'post_date_gmt' => $post['date'],
				'post_date'     => get_date_from_gmt( $post['date'] ),
			) );
		}
	}
}
