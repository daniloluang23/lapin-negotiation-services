<?php
/**
 * One Google review card. Expects $lapin_review = [ name, date, stars, text ]
 * (shape of Lapin_Reviews::get() items). Shared by the home testimonials
 * grid and the reviews modal; the clamp/Read-more JS in lapin-footer.php
 * targets .review-card regardless of where it renders.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article class="review-card">
	<div class="review-card__head">
		<span class="review-card__avatar" aria-hidden="true"><?php echo esc_html( mb_substr( $lapin_review['name'], 0, 1 ) ); ?></span>
		<div>
			<strong><?php echo esc_html( $lapin_review['name'] ); ?></strong>
			<span><?php echo esc_html( $lapin_review['date'] ); ?></span>
		</div>
	</div>
	<div class="review-card__stars" role="img" aria-label="Rated <?php echo esc_attr( $lapin_review['stars'] ); ?> out of 5 stars">
		<?php for ( $lapin_s = 0; $lapin_s < (int) $lapin_review['stars']; $lapin_s++ ) : ?>
		<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.9 6.3 6.9.8-5.1 4.7 1.4 6.8L12 17.2l-6.1 3.4 1.4-6.8L2.2 9.1l6.9-.8z"/></svg>
		<?php endfor; ?>
	</div>
	<p><?php echo esc_html( $lapin_review['text'] ); ?></p>
	<button class="review-card__more" type="button" aria-expanded="false" hidden>Read more</button>
	<span class="review-card__via">Google review</span>
</article>
