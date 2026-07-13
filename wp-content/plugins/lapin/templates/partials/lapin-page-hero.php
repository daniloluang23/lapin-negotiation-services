<?php
/**
 * Sub-page hero — navy band, H1 left-biased, consultation line beneath.
 * Expects $lapin_hero = array( 'title' => string, 'lede' => string ).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="page-hero">
	<div class="wrap">
		<h1><?php echo esc_html( $lapin_hero['title'] ); ?></h1>
		<p><?php echo esc_html( $lapin_hero['lede'] ); ?></p>
	</div>
</section>
