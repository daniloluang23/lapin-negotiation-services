<?php
/**
 * Blog index (/blog/) — card grid of published posts, newest first.
 * Post URLs are root-level slugs (same URLs as the approved staging site).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin_posts = get_posts( array(
	'post_type'   => 'post',
	'post_status' => 'publish',
	'numberposts' => -1,
	'orderby'     => 'date',
	'order'       => 'DESC',
) );

$lapin_blog_nodes = array();
foreach ( $lapin_posts as $lapin_post ) {
	$lapin_blog_nodes[] = array(
		'@type'         => 'BlogPosting',
		'headline'      => $lapin_post->post_title,
		'url'           => home_url( '/' . $lapin_post->post_name . '/' ),
		'datePublished' => gmdate( 'Y-m-d\TH:i:sP', strtotime( $lapin_post->post_date_gmt . ' +0000' ) ),
		'author'        => array( '@type' => 'Person', 'name' => 'Raphael Lapin' ),
	);
}

$lapin = array(
	'title'      => 'Insights | Negotiation, Mediation & Dispute Resolution | Lapin Negotiation Services',
	'desc'       => 'Insights and commentary on negotiation, mediation and dispute resolution by Harvard-trained negotiator Raphael Lapin — practical guidance for businesses, families and organizations.',
	'path'       => 'blog/',
	'nav'        => 'blog',
	'body_class' => 'page-blog',
	'hero'       => array(
		'title' => 'Insights',
		'lede'  => 'Commentary on negotiation, mediation and dispute resolution by Raphael Lapin.',
	),
	'schema'     => array(
		array(
			'@type'    => 'Blog',
			'@id'      => home_url( '/blog/' ) . '#blog',
			'url'      => home_url( '/blog/' ),
			'name'     => Lapin::NAME . ' Insights',
			'blogPost' => $lapin_blog_nodes,
		),
	),
);

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';
?>

<main id="main">
	<section class="sec">
		<div class="wrap">
			<?php if ( empty( $lapin_posts ) ) : ?>
			<p class="lead">New articles are on their way — check back soon.</p>
			<?php else : ?>
			<div class="post-grid">
				<?php foreach ( $lapin_posts as $lapin_i => $lapin_post ) : ?>
				<?php $lapin_img = Lapin_Posts::image( $lapin_post->post_name, true ); ?>
				<article class="card post-card<?php echo $lapin_img ? '' : ' post-card--text'; ?> rv" style="--i:<?php echo esc_attr( $lapin_i % 3 ); ?>">
					<?php if ( $lapin_img ) : ?>
					<div class="post-card__img">
						<img src="<?php echo esc_url( $lapin_img[0] ); ?>" alt="" width="<?php echo esc_attr( $lapin_img[1] ); ?>" height="<?php echo esc_attr( $lapin_img[2] ); ?>" loading="lazy">
					</div>
					<?php endif; ?>
					<div class="post-card__body">
						<span class="post-card__date"><?php echo esc_html( get_the_date( 'F j, Y', $lapin_post ) ); ?></span>
						<h3><a href="<?php echo esc_url( get_permalink( $lapin_post ) ); ?>"><?php echo esc_html( $lapin_post->post_title ); ?></a></h3>
						<p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $lapin_post->post_content ), 24, '…' ) ); ?></p>
						<span class="post-card__more" aria-hidden="true">Read the article →</span>
					</div>
				</article>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</div>
	</section>

	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-cta-band.php'; ?>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
