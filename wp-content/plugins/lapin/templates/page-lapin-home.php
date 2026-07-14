<?php
/**
 * Home — brand-tagline hero on the shared bridge masthead, credentials band,
 * founder diptych, client-logo marquee, media wall (static grid), four
 * qualification cards, latest blog posts, CTA band. Section order mirrors the
 * approved staging design; all body copy retained verbatim.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin = array(
	'title'      => 'Lapin Negotiation Services | Negotiation, Mediation & Dispute Resolution, Los Angeles',
	'desc'       => 'Professional mediation and negotiation services delivering practical, durable solutions for businesses, families, and organizations. Harvard-trained, 25+ years, 1,000+ disputes resolved. Free consultation: 310-984-6952.',
	'path'       => '',
	'nav'        => 'home',
	'body_class' => 'page-home',
	'hero'       => array( 'type' => 'home' ),
);

$lapin_media = array(
	array(
		'slug'  => 'aljazeera',
		'type'  => 'youtube',
		'id'    => '5xKDBULQIbU',
		'title' => 'Raphael Lapin with Aljazeera advising on a complex international dispute',
		'text'  => 'This video includes excerpts from a discussion between Aljazeera and Raphael Lapin, regarding the international dispute in Africa involving the Grand Ethiopian Renaissance Dam.',
	),
	array(
		'slug'  => 'probate-trust',
		'type'  => 'youtube',
		'id'    => 'oXvv7aXgpRc',
		'title' => 'Raphael Lapin with The WAY to WOW Show on Mediation in Probate & Trust Disputes',
		'text'  => 'Raphael Lapin explains how mediation resolves probate and trust disputes more efficiently while protecting estates and family relationships. He covers when mediation works best, how counsel should prepare, and why it is often the smarter strategic choice.',
	),
	array(
		'slug'  => 'difficult-people',
		'type'  => 'youtube',
		'id'    => 'D6VG_odqIoo',
		'title' => '“Working With Difficult People” — Interview on The Way to Wow Show',
		'text'  => 'Watch this great interview with Raphael Lapin on The Way to Wow Show! In the interview hosted by Kevin Bemel, Raphael discusses his book, “Working with Difficult People.”',
	),
	array(
		'slug'  => 'difficult-family',
		'type'  => 'youtube',
		'id'    => 'uTcachSgxEs',
		'title' => 'Raphael Lapin Discusses Dealing with Difficult Family Members',
		'text'  => 'Raphael Lapin returns to The Way to Wow Show to continue his discussion on how to deal with difficult people. In this interview, Raphael focuses his attention specifically on difficult family members.',
	),
	array(
		'slug'  => 'successful-mediation',
		'type'  => 'soundcloud',
		'url'   => 'https://soundcloud.com/lapin-negotiation-service/the-components-of-a-successful-mediation',
		'title' => 'The Components of a Successful Mediation',
		'text'  => 'What are the necessary ingredients that make for a successful mediation? Is there a difference between a great mediation and an average mediation? How is mediation different from arbitration and litigation?',
	),
	array(
		'slug'  => 'bullies',
		'type'  => 'apple',
		'embed' => 'https://embed.podcasts.apple.com/us/podcast/bullies/id1625780382?i=1000721586678',
		'label' => 'Play episode · Apple Podcasts',
		'title' => 'Bullies',
		'text'  => 'Raphael shares how he resolved a school bullying dispute through a restorative, empathy-driven approach, bringing everyone together to express remorse and find healing instead of punishment.',
	),
	array(
		'slug'  => 'dispute-resolution',
		'type'  => 'soundcloud',
		'url'   => 'https://soundcloud.com/lapin-negotiation-service/dispute-resolution',
		'title' => 'Insights on Dispute Resolution',
		'text'  => 'A lot of us forget about is the cost of conflict, and the cost of not being able to manage conflict effectively. Raphael tells about the inner workings of conflict resolution, dispute resolution, and mediation and arbitration.',
	),
	array(
		'slug'  => 'recipe-success',
		'type'  => 'soundcloud',
		'url'   => 'https://api.soundcloud.com/tracks/1415053330',
		'title' => 'Mediation: Raphael Lapin’s Recipe for Success',
		'text'  => 'There IS a difference between an average and a great mediation. So what is Raphael Lapin’s secret? What strategies does he employ to anticipate the interests of the other party? How does he help parties follow through on their commitments?',
	),
);

// The staging site's own rose-tint monochrome logo art, uniform 150x70.
$lapin_clients = array(
	array( 'client-microsoft-tint.webp', 'Microsoft' ),
	array( 'client-att-tint.webp', 'AT&T' ),
	array( 'client-yahoo-tint.webp', 'Yahoo' ),
	array( 'client-bt-tint.webp', 'BT' ),
	array( 'client-booz-tint.webp', 'Booz Allen Hamilton' ),
	array( 'client-air_force-tint.webp', 'United States Air Force' ),
	array( 'client-qatar-tint.webp', 'State of Qatar' ),
	array( 'client-uae-tint.webp', 'United Arab Emirates' ),
);

$lapin_latest = get_posts( array(
	'post_type'   => 'post',
	'post_status' => 'publish',
	'numberposts' => 3,
	'orderby'     => 'date',
	'order'       => 'DESC',
) );

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';
?>
<style>
	.creds { background: var(--color-onyx-deep); }
	.creds .wrap {
		display: grid; grid-template-columns: repeat(3, minmax(0, 1fr));
		gap: var(--space-lg); padding-block: var(--space-lg);
	}
	.creds__item { display: flex; gap: var(--space-md); align-items: flex-start; border-left: 1px solid var(--color-rule-onyx); padding-left: var(--space-lg); }
	.creds__item:first-child { border-left: 0; padding-left: 0; }
	.creds__item > svg { width: 1.75rem; height: 1.75rem; flex-shrink: 0; color: var(--color-accent); margin-top: 0.15rem; }
	.creds__item strong { display: block; font-size: var(--text-sm); font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: var(--color-ink-inverse); }
	.creds__item span { font-size: var(--text-sm); color: var(--color-ink-inverse-2); }
	a.creds__item { text-decoration: none; }
	a.creds__item span { transition: color var(--dur-micro) var(--ease-out); }
	a.creds__item:hover span { color: var(--color-gold); text-decoration: underline; text-underline-offset: 3px; }
	@media (max-width: 63.9375rem) {
		.creds .wrap { grid-template-columns: minmax(0, 1fr); gap: var(--space-md); }
		.creds__item { border-left: 0; padding-left: 0; }
	}
	.founder { display: grid; grid-template-columns: minmax(0, 4fr) minmax(0, 8fr); gap: var(--space-2xl); align-items: start; }
	.founder__portrait img { border-radius: var(--radius-card); }
	.founder__link { font-weight: 600; text-decoration: underline; text-decoration-color: var(--color-accent); text-decoration-thickness: 2px; text-underline-offset: 3px; }
	.founder__link:hover { color: var(--color-accent-strong); }
	.founder__actions { display: flex; flex-wrap: wrap; align-items: center; gap: var(--space-md); margin-top: var(--space-lg); }
	@media (max-width: 63.9375rem) {
		.founder { grid-template-columns: minmax(0, 1fr); gap: var(--space-lg); }
		.founder__portrait img { width: min(60%, 18rem); }
	}
	.clients-band .sec-head { margin-bottom: var(--space-lg); }
	.pa-head { text-align: center; }
	.pa-head .sec-head__eyebrow { color: var(--color-accent-strong); }
	.pa-head::after { margin-inline: auto; }
	.pa-grid {
		display: grid; grid-template-columns: repeat(6, minmax(0, 1fr));
		gap: var(--space-lg); text-align: center;
	}
	@media (max-width: 63.9375rem) { .pa-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); } }
	@media (max-width: 40rem) { .pa-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
	.pa-item { text-decoration: none; display: flex; flex-direction: column; align-items: center; gap: var(--space-sm); padding: var(--space-md) var(--space-xs); }
	.pa-item svg { width: 2.25rem; height: 2.25rem; color: var(--color-accent-strong); transition: transform var(--dur-short) var(--ease-out); }
	.pa-item:hover svg { transform: translateY(-3px); }
	.pa-item strong { font-size: 0.9375rem; font-weight: 600; line-height: 1.35; color: var(--color-ink); }
	.pa-item:hover strong { text-decoration: underline; text-decoration-color: var(--color-accent); text-decoration-thickness: 2px; text-underline-offset: 4px; }
	.pa-all { text-align: center; margin: var(--space-xl) 0 0; }
	/* Qualified — staging's 2×2 numbered-photo layout (client preference). */
	.quals__head { text-align: center; }
	.quals__head::after { margin-inline: auto; }
	.quals__grid {
		display: grid; grid-template-columns: repeat(2, minmax(0, 1fr));
		gap: var(--space-2xl) var(--space-3xl); text-align: center;
	}
	@media (max-width: 40rem) { .quals__grid { grid-template-columns: minmax(0, 1fr); } }
	.qual__img { position: relative; display: inline-block; margin: 0 0 var(--space-xl); }
	.qual__img img { width: 190px; height: 190px; border-radius: var(--radius-card); }
	.qual__num {
		position: absolute; left: 50%; bottom: -1.5rem; transform: translateX(-50%);
		display: grid; place-items: center; width: 3.5rem; height: 3.5rem;
		border-radius: 50%; background: var(--color-accent-strong); color: var(--color-on-accent);
		font-weight: 600; font-size: 0.9375rem; letter-spacing: 0.04em;
		border: 3px solid var(--color-paper-2);
	}
	.qual h3 { font-size: var(--text-body); text-transform: uppercase; letter-spacing: 0.05em; line-height: 1.4; margin-bottom: var(--space-sm); }
	.qual p { color: var(--color-ink-2); font-size: 0.9375rem; max-width: 52ch; margin: 0 auto; }
	.post-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: var(--space-xl); }
	@media (max-width: 63.9375rem) { .post-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
	@media (max-width: 40rem) { .post-grid { grid-template-columns: minmax(0, 1fr); } }
	.blog-teaser__all { margin-top: var(--space-xl); }
</style>

<main id="main">
	<section class="creds band" aria-label="Credentials">
		<div class="wrap">
			<div class="creds__item rv">
				<?php echo Lapin::icon( 'award' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<div><strong>Harvard trained</strong><span>Negotiation, mediation and dispute resolution</span></div>
			</div>
			<a class="creds__item rv" style="--i:1" href="<?php echo esc_url( Lapin::GOOGLE_REVIEWS ); ?>" target="_blank" rel="noopener">
				<?php echo Lapin::icon( 'messages-square' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<div><strong>Top rated in Southern California</strong><span>Read our Google Reviews&nbsp;↗</span></div>
			</a>
			<div class="creds__item rv" style="--i:2">
				<?php echo Lapin::icon( 'briefcase-business' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<div><strong>Over 25 years of experience</strong><span>1,000+ disputes successfully resolved</span></div>
			</div>
		</div>
	</section>

	<section class="sec sec--tight" id="practice-areas" aria-labelledby="pa-title">
		<div class="wrap">
			<div class="sec-head pa-head rv">
				<span class="sec-head__eyebrow">Practice Areas</span>
				<h2 id="pa-title">Targeted Practice Areas</h2>
			</div>
			<div class="pa-grid">
				<?php
				$lapin_pa = array(
					array( 'briefcase-business', 'Commercial Disputes' ),
					array( 'handshake', 'Contract Negotiations and Disputes' ),
					array( 'users', 'Family & Family Business Disputes' ),
					array( 'layers', 'Real Estate' ),
					array( 'messages-square', 'Workplace Issues' ),
					array( 'book-open', 'Contested Probate Disputes' ),
				);
				foreach ( $lapin_pa as $lapin_i => $lapin_area ) :
				?>
				<a class="pa-item rv" style="--i:<?php echo esc_attr( $lapin_i ); ?>" href="<?php echo esc_url( home_url( '/practice-areas/' ) ); ?>">
					<?php echo Lapin::icon( $lapin_area[0] ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					<strong><?php echo esc_html( $lapin_area[1] ); ?></strong>
				</a>
				<?php endforeach; ?>
			</div>
			<p class="pa-all rv"><a class="btn btn--outline" href="<?php echo esc_url( home_url( '/practice-areas/' ) ); ?>">View all 15 practice areas</a></p>
		</div>
	</section>

	<section class="sec" id="raphael">
		<div class="wrap">
			<div class="founder">
				<figure class="founder__portrait rv">
					<img src="<?php echo esc_url( Lapin::asset( 'images/raphael-lapin.webp' ) ); ?>" alt="Raphael E. Lapin" width="399" height="559" loading="lazy">
				</figure>
				<div>
					<div class="sec-head rv">
						<span class="sec-head__eyebrow">Our Introduction</span>
						<h2>Raphael E. Lapin</h2>
					</div>
					<div class="prose rv" style="--i:1">
						<p class="lead">Looking for a skilled and experienced negotiator to help you navigate a complex negotiation or resolve an acrimonious dispute?</p>
						<p>Raphael Lapin is a Harvard-trained expert in the field of negotiation, dispute resolution and mediation. With extensive experience working with Fortune 500 corporations and governments around the world, Raphael has the knowledge and expertise to help you achieve the best possible outcome in any negotiation or mediation situation.</p>
						<p>As the principal of Lapin Negotiation Services and an adjunct professor of law at Whittier School of Law in Southern California, Raphael has a wealth of knowledge and experience to draw upon. He has taught negotiation and mediation at some of the most prestigious universities, and has lectured on international conflict resolution at Southwestern School of Law in Los Angeles.</p>
						<p>Whether you’re an individual, family, organization, business or corporation, Raphael can help you navigate negotiations, resolve differences and restore relationships with his expertise in negotiation, dispute resolution and mediation. Trust in his expertise, and let Raphael Lapin help you achieve a successful outcome in any negotiation, dispute or mediation.</p>
						<p><a class="founder__link" href="<?php echo esc_url( home_url( '/overview/' ) ); ?>">More about the firm →</a></p>
						<div class="founder__actions">
							<a class="btn btn--rose" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Schedule a Consultation</a>
							<a class="btn btn--outline" href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>">Call Now — <?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="sec band--cream" id="testimonials" aria-labelledby="testimonials-title">
		<div class="wrap">
			<div class="sec-head reviews-head rv">
				<span class="sec-head__eyebrow">Our Testimonials</span>
				<h2 id="testimonials-title">What they say?</h2>
			</div>
			<div class="reviews-track rv" id="reviews-track" tabindex="0" aria-label="Google reviews — scroll for more">
				<?php foreach ( Lapin_Reviews::get() as $lapin_review ) : ?>
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
				<?php endforeach; ?>
			</div>
			<div class="reviews-foot rv">
				<div class="reviews-nav">
					<button type="button" data-slide="prev" aria-controls="reviews-track" aria-label="Previous reviews">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M10 3L5 8l5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</button>
					<button type="button" data-slide="next" aria-controls="reviews-track" aria-label="Next reviews">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M6 3l5 5-5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
					</button>
				</div>
				<a class="reviews-link" href="<?php echo esc_url( Lapin::GOOGLE_REVIEWS ); ?>" rel="noopener" target="_blank">Read all our reviews on Google&nbsp;↗</a>
				<a class="ti-badge" href="https://www.trustindex.io/" rel="noopener" target="_blank">
					Verified by Trustindex
					<svg width="13" height="13" viewBox="0 0 16 16" fill="none" aria-hidden="true"><circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.4"/><path d="M8 7v4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><circle cx="8" cy="4.6" r="0.9" fill="currentColor"/></svg>
				</a>
			</div>
		</div>
	</section>

	<section class="sec sec--tight band--cream clients-band" aria-label="Clients">
		<div class="wrap">
			<div class="sec-head rv">
				<span class="sec-head__eyebrow">Our Clients</span>
				<h2>Some of our clients</h2>
			</div>
			<div class="marquee" aria-label="Client logos">
				<div class="marquee__track">
					<?php foreach ( $lapin_clients as $lapin_client ) : ?>
					<img src="<?php echo esc_url( Lapin::asset( 'images/' . $lapin_client[0] ) ); ?>" alt="<?php echo esc_attr( $lapin_client[1] ); ?>" width="150" height="70" loading="lazy">
					<?php endforeach; ?>
					<?php foreach ( $lapin_clients as $lapin_client ) : // duplicate track for the seamless loop ?>
					<img src="<?php echo esc_url( Lapin::asset( 'images/' . $lapin_client[0] ) ); ?>" alt="" aria-hidden="true" width="150" height="70" loading="lazy">
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<section class="sec sec--tight" id="media">
		<div class="wrap">
			<div class="sec-head rv">
				<span class="sec-head__eyebrow">In the Media</span>
				<h2>Media Appearances</h2>
			</div>
			<div class="media-grid">
				<?php foreach ( $lapin_media as $lapin_i => $lapin_item ) : ?>
				<article class="media-card rv" id="media-<?php echo esc_attr( $lapin_item['slug'] ); ?>" style="--i:<?php echo esc_attr( $lapin_i % 2 ); ?>">
					<?php if ( 'youtube' === $lapin_item['type'] ) : ?>
					<button class="facade" type="button"
					        data-embed="https://www.youtube-nocookie.com/embed/<?php echo esc_attr( $lapin_item['id'] ); ?>?autoplay=1"
					        data-embed-title="<?php echo esc_attr( $lapin_item['title'] ); ?>"
					        aria-label="Play video: <?php echo esc_attr( $lapin_item['title'] ); ?>">
						<img src="<?php echo esc_url( Lapin::asset( 'images/yt-' . $lapin_item['id'] . '.webp' ) ); ?>" alt="" width="480" height="270" loading="lazy">
						<span class="facade__play" aria-hidden="true">
							<svg width="18" height="20" viewBox="0 0 18 20" fill="currentColor" aria-hidden="true"><path d="M0 0l18 10L0 20z"/></svg>
						</span>
					</button>
					<?php else : ?>
					<?php
					$lapin_embed = 'apple' === $lapin_item['type']
						? $lapin_item['embed']
						: 'https://w.soundcloud.com/player/?url=' . rawurlencode( $lapin_item['url'] ) . '&color=%23bd8c7d&auto_play=true&visual=false';
					?>
					<button class="sc-load" type="button"
					        data-embed="<?php echo esc_url( $lapin_embed ); ?>"
					        data-embed-title="<?php echo esc_attr( $lapin_item['title'] ); ?>" data-embed-audio
					        <?php if ( 'apple' === $lapin_item['type'] ) : ?>data-embed-h="175"<?php endif; ?>>
						<svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M4 8v4h2V8H4zm4-3v10h2V5H8zm4-2v14h2V3h-2zm4 4v6h2V7h-2zM0 10v2h2v-2H0z"/></svg>
						<?php echo esc_html( $lapin_item['label'] ?? 'Load audio player' ); ?>
					</button>
					<?php endif; ?>
					<div class="media-card__body">
						<h3><?php echo esc_html( $lapin_item['title'] ); ?></h3>
						<p><?php echo esc_html( $lapin_item['text'] ); ?></p>
					</div>
				</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="sec band--cream" id="qualified">
		<div class="wrap">
			<div class="sec-head quals__head rv">
				<span class="sec-head__eyebrow">Why Choose Us</span>
				<h2>What makes us uniquely qualified</h2>
			</div>
			<div class="quals__grid">
				<article class="qual rv">
					<figure class="qual__img">
						<img src="<?php echo esc_url( Lapin::asset( 'images/qual-2.webp' ) ); ?>" alt="" width="190" height="190" loading="lazy">
						<span class="qual__num" aria-hidden="true">01</span>
					</figure>
					<h3>Highly qualified &amp; experienced specialists</h3>
					<p>Our negotiation and dispute resolution practice is unrivaled in its level of expertise. Our team of seasoned specialists have acquired decades of experience in the field and continue to demonstrate a proven track record of delivering positive outcomes for clients in even the most difficult negotiations. With over 1,000 disputes successfully resolved, we have a proven ability to save clients significant costs and resources by successfully resolving conflicts without the need for ongoing litigation.</p>
				</article>
				<article class="qual rv" style="--i:1">
					<figure class="qual__img">
						<img src="<?php echo esc_url( Lapin::asset( 'images/qual-1.webp' ) ); ?>" alt="" width="190" height="190" loading="lazy">
						<span class="qual__num" aria-hidden="true">02</span>
					</figure>
					<h3>Broad range of subject matter expertise</h3>
					<p>Our negotiation and dispute resolution practice is unmatched in its breadth and depth, as we specialize in a wide range of areas including but not limited to personal, family, small business and partnership matters, intellectual property disputes, construction disputes, business disputes, healthcare disputes, employment and labor disputes, and medical malpractice claims.</p>
				</article>
				<article class="qual rv">
					<figure class="qual__img">
						<img src="<?php echo esc_url( Lapin::asset( 'images/qual-3.webp' ) ); ?>" alt="" width="190" height="190" loading="lazy">
						<span class="qual__num" aria-hidden="true">03</span>
					</figure>
					<h3>Creative, innovative &amp; valuable solutions</h3>
					<p>At our company, we pride ourselves in our ability to help parties identify creative, innovative and valuable resolutions to reach a mutually agreeable conclusion to negotiations and to put an end to conflicts and disputes. We strive to exceed expectations by uncovering creative options that can minimize risk and maximize returns, all while fostering strong, long-lasting relationships.</p>
				</article>
				<article class="qual rv" style="--i:1">
					<figure class="qual__img">
						<img src="<?php echo esc_url( Lapin::asset( 'images/qual-4.webp' ) ); ?>" alt="" width="190" height="190" loading="lazy">
						<span class="qual__num" aria-hidden="true">04</span>
					</figure>
					<h3>Continued research, learning &amp; development</h3>
					<p>Our team is composed of experts in negotiation and dispute resolution who not only practice, but also teach and conduct research at the graduate level. We are committed to ongoing learning and development, which enables us to bring our clients the most current and cutting-edge approaches, fresh insights and innovative thinking to successfully resolve their problems.</p>
				</article>
			</div>
		</div>
	</section>

	<?php if ( ! empty( $lapin_latest ) ) : ?>
	<section class="sec" id="blog">
		<div class="wrap">
			<div class="sec-head rv">
				<span class="sec-head__eyebrow">From the Blog</span>
				<h2>Latest blog posts</h2>
			</div>
			<div class="post-grid">
				<?php foreach ( $lapin_latest as $lapin_i => $lapin_post ) : ?>
				<?php $lapin_img = Lapin_Posts::image( $lapin_post->post_name, true ); ?>
				<article class="card post-card rv" style="--i:<?php echo esc_attr( $lapin_i ); ?>">
					<?php if ( $lapin_img ) : ?>
					<div class="post-card__img">
						<img src="<?php echo esc_url( $lapin_img[0] ); ?>" alt="" width="<?php echo esc_attr( $lapin_img[1] ); ?>" height="<?php echo esc_attr( $lapin_img[2] ); ?>" loading="lazy">
					</div>
					<?php endif; ?>
					<div class="post-card__body">
						<span class="post-card__date"><?php echo esc_html( get_the_date( 'F j, Y', $lapin_post ) ); ?></span>
						<h3><a href="<?php echo esc_url( get_permalink( $lapin_post ) ); ?>"><?php echo esc_html( $lapin_post->post_title ); ?></a></h3>
						<p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $lapin_post->post_content ), 20, '…' ) ); ?></p>
						<span class="post-card__more" aria-hidden="true">Read the article →</span>
					</div>
				</article>
				<?php endforeach; ?>
			</div>
			<p class="blog-teaser__all rv"><a class="btn btn--outline" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">View all articles</a></p>
		</div>
	</section>
	<?php endif; ?>

	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-cta-band.php'; ?>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
