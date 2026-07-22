<?php
/**
 * Blog single — one-column article under the shared masthead. Posts live at
 * root-level slugs (URLs identical to the approved staging site). Content is
 * the migrated staging copy (or wp-admin-authored for future posts).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin_post = get_queried_object();
$lapin_slug = $lapin_post->post_name;
$lapin_img  = Lapin_Posts::image( $lapin_slug );
$lapin_desc = Lapin_Posts::description( $lapin_slug );
if ( '' === $lapin_desc ) {
	$lapin_desc = wp_trim_words( wp_strip_all_tags( $lapin_post->post_content ), 24, '…' );
}
$lapin_published = gmdate( 'Y-m-d\TH:i:sP', strtotime( $lapin_post->post_date_gmt . ' +0000' ) );
$lapin_modified  = gmdate( 'Y-m-d\TH:i:sP', strtotime( $lapin_post->post_modified_gmt . ' +0000' ) );

$lapin = array(
	'title'      => $lapin_post->post_title . ' | ' . Lapin::NAME,
	'desc'       => $lapin_desc,
	'path'       => $lapin_slug . '/',
	'nav'        => 'blog',
	'body_class' => 'page-post',
	'og_type'    => 'article',
	'article'    => array( 'published' => $lapin_published, 'modified' => $lapin_modified ),
	'breadcrumb' => array(
		array( 'Blog', home_url( '/blog/' ) ),
		array( $lapin_post->post_title, home_url( '/' . $lapin_slug . '/' ) ),
	),
	'hero'       => array(
		'eyebrow' => get_the_date( 'F j, Y', $lapin_post ) . ' · Raphael Lapin',
		'title'   => $lapin_post->post_title,
	),
	'schema'     => array(
		array(
			'@type'            => 'Article',
			'@id'              => home_url( '/' . $lapin_slug . '/' ) . '#article',
			'headline'         => $lapin_post->post_title,
			'datePublished'    => $lapin_published,
			'dateModified'     => $lapin_modified,
			'author'           => array( '@type' => 'Person', 'name' => 'Raphael Lapin' ),
			'publisher'        => array( '@id' => home_url( '/' ) . '#organization' ),
			'mainEntityOfPage' => home_url( '/' . $lapin_slug . '/' ),
		),
	),
);
if ( $lapin_img ) {
	$lapin['og_image']            = $lapin_img[0];
	$lapin['schema'][0]['image']  = $lapin_img[0];
}

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';
?>
<style>
	.article { max-width: 46rem; }
	.article__img { margin: 0 0 var(--space-xl); }
	.article__img img { border-radius: var(--radius-card); }
	.article .prose a:not(.btn) { text-decoration: underline; text-decoration-color: var(--color-accent); text-decoration-thickness: 2px; text-underline-offset: 3px; }
	.article .prose a:not(.btn):hover { color: var(--color-accent-strong); }
	.article .prose h2, .article .prose h3 { margin-top: var(--space-xl); }
	.article__back { display: inline-block; margin-top: var(--space-xl); font-weight: 600; text-decoration: none; border-bottom: 2px solid var(--color-accent); padding-bottom: 2px; }
	.article__back:hover { color: var(--color-accent-strong); }
</style>

<main id="main">
	<article class="sec">
		<div class="wrap">
			<div class="article">
				<?php if ( $lapin_img ) : ?>
				<figure class="article__img">
					<img src="<?php echo esc_url( $lapin_img[0] ); ?>" alt="" width="<?php echo esc_attr( $lapin_img[1] ); ?>" height="<?php echo esc_attr( $lapin_img[2] ); ?>">
				</figure>
				<?php endif; ?>
				<div class="prose">
					<?php echo wp_kses_post( $lapin_post->post_content ); ?>
				</div>
				<a class="article__back" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">← All articles</a>
			</div>
		</div>
	</article>

	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-cta-band.php'; ?>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
