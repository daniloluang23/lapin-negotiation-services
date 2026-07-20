<?php
/**
 * Home — split tagline hero on the shared bridge masthead (copy left, art
 * right), credentials band, practice areas, founder diptych, reviews grid,
 * client-logo marquee, media wall (static grid), four qualification cards,
 * CTA band. Section order mirrors the approved staging design; body copy
 * verbatim except client-directed changes (see design.md content law).
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
	'preload'    => array(
		array(
			'as'            => 'image',
			'href'          => Lapin::asset( 'images/bridge-theme-1600.webp' ),
			'imagesrcset'   => Lapin::asset( 'images/bridge-theme-960.webp' ) . ' 960w, ' . Lapin::asset( 'images/bridge-theme-1600.webp' ) . ' 1600w, ' . Lapin::asset( 'images/bridge-theme-2560.webp' ) . ' 2560w',
			'imagesizes'    => '(max-width: 63.9375rem) 100vw, 66vw',
			'type'          => 'image/webp',
			'fetchpriority' => 'high',
		),
	),
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
		'label' => 'Play episode · SoundCloud',
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
		'label' => 'Play episode · SoundCloud',
		'title' => 'Insights on Dispute Resolution',
		'text'  => 'A lot of us forget about is the cost of conflict, and the cost of not being able to manage conflict effectively. Raphael tells about the inner workings of conflict resolution, dispute resolution, and mediation and arbitration.',
	),
	array(
		'slug'  => 'recipe-success',
		'type'  => 'soundcloud',
		'url'   => 'https://api.soundcloud.com/tracks/1415053330',
		'label' => 'Play episode · SoundCloud',
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

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';
?>
<style>
	/* Stats strip per the claude-design handoff: near-black bg, 1px rose top rule. */
	.creds {
		background: var(--color-strip);
		border-top: 1px solid color-mix(in srgb, var(--color-accent) 35%, transparent);
	}
	.creds .wrap {
		display: grid; grid-template-columns: repeat(3, minmax(0, 1fr));
		gap: var(--space-lg); padding-block: var(--space-lg);
	}
	.creds__item { display: flex; gap: var(--space-md); align-items: flex-start; border-left: 1px solid color-mix(in srgb, var(--color-muted) 20%, transparent); padding-left: var(--space-lg); }
	.creds__item:first-child { border-left: 0; padding-left: 0; }
	.creds__item > svg { width: 1.75rem; height: 1.75rem; flex-shrink: 0; color: var(--color-accent); margin-top: 0.15rem; }
	.creds__item--stack { flex-direction: column; gap: var(--space-xs); }
	.creds__stars { display: flex; gap: 0.2rem; color: var(--color-star); }
	.creds__stars svg { width: 1.05rem; height: 1.05rem; }
	.creds__item strong { display: block; font-size: var(--text-sm); font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase; color: var(--color-hero-text); }
	.creds__item span { font-size: var(--text-sm); color: var(--color-hero-muted); }
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
	/* Qualified — 2×2 numbered layout; numeral marks replace the photos. */
	.quals__head { text-align: center; }
	.quals__head::after { margin-inline: auto; }
	.quals__grid {
		display: grid; grid-template-columns: repeat(2, minmax(0, 1fr));
		gap: var(--space-2xl) var(--space-3xl); text-align: center;
	}
	@media (max-width: 40rem) { .quals__grid { grid-template-columns: minmax(0, 1fr); } }
	/* Numeral marks (client choice 2026-07-19: no photos) — paper disc,
	   hairline ring, inner rose-gold ring; the numeral IS the number. */
	.qual__mark {
		position: relative; display: grid; place-items: center;
		width: 190px; height: 190px; margin: 0 auto var(--space-xl);
		background: var(--color-paper); border: 1px solid var(--color-rule); border-radius: 50%;
	}
	.qual__mark::after {
		content: ""; position: absolute; inset: 10px;
		border: 1px solid var(--color-accent); border-radius: 50%; opacity: 0.55;
	}
	.qual__mark span {
		font-family: var(--font-display); font-weight: 700; font-size: var(--text-3xl);
		letter-spacing: var(--tracking-display); color: var(--color-accent-strong);
	}
	.qual h3 { font-size: var(--text-body); text-transform: uppercase; letter-spacing: 0.05em; line-height: 1.4; margin-bottom: var(--space-sm); }
	.qual p { color: var(--color-ink-2); font-size: 0.9375rem; max-width: 52ch; margin: 0 auto; }
</style>

<main id="main">
	<section class="creds band" aria-label="Credentials">
		<div class="wrap">
			<div class="creds__item rv">
				<?php echo Lapin::icon( 'award' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<div><strong>Harvard trained</strong><span>Negotiation, mediation and dispute resolution</span></div>
			</div>
			<a class="creds__item creds__item--stack rv" style="--i:1" href="<?php echo esc_url( Lapin::GOOGLE_REVIEWS ); ?>" target="_blank" rel="noopener">
				<span class="creds__stars" aria-hidden="true">
					<?php for ( $lapin_s = 0; $lapin_s < 5; $lapin_s++ ) : ?>
					<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.9 6.3 6.9.8-5.1 4.7 1.4 6.8L12 17.2l-6.1 3.4 1.4-6.8L2.2 9.1l6.9-.8z"/></svg>
					<?php endfor; ?>
				</span>
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
				<h2 id="pa-title">Practice Areas</h2>
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
						<p class="lead">Whether you’re involved in a business dispute, family conflict, trust litigation or high stakes negotiation, we help parties reach durable agreements while preserving relationships wherever possible.</p>
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
				<h2 id="testimonials-title">What Clients Are Saying</h2>
			</div>
			<div class="reviews-grid rv">
				<?php foreach ( array_slice( Lapin_Reviews::get(), 0, 6 ) as $lapin_review ) : ?>
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
			<div class="reviews-band rv">
				<span class="reviews-band__stars" aria-hidden="true">
					<?php for ( $lapin_s = 0; $lapin_s < 5; $lapin_s++ ) : ?>
					<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.9 6.3 6.9.8-5.1 4.7 1.4 6.8L12 17.2l-6.1 3.4 1.4-6.8L2.2 9.1l6.9-.8z"/></svg>
					<?php endfor; ?>
				</span>
				<strong>40+ Five-Star Google Reviews</strong>
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
			<?php // Simplified bridge motif (tied arch + hangers + V piers, matching the hero artwork) for the audio facades. ?>
			<svg width="0" height="0" style="position:absolute" aria-hidden="true" focusable="false">
				<symbol id="lapin-bridge-mini" viewBox="0 0 480 270" preserveAspectRatio="xMidYMax slice">
					<!-- sweeping light arcs behind the span -->
					<path d="M -10 150 C 100 90, 220 40, 340 -10" fill="none" stroke="#D1BFA7" stroke-width="1" opacity=".3"/>
					<path d="M 150 -10 C 280 60, 380 110, 490 130" fill="none" stroke="#AA7F3D" stroke-width="1" opacity=".3"/>
					<!-- tied arch over the deck -->
					<path d="M 60 200 Q 240 0 420 200" fill="none" stroke="#E8D9B8" stroke-width="2.4"/>
					<path d="M 66 206 Q 240 10 414 206" fill="none" stroke="#AA7F3D" stroke-width="1" opacity=".5"/>
					<!-- hangers -->
					<g fill="none" stroke="#D1BFA7" stroke-width="1">
						<path d="M 114 149 V 200" opacity=".55"/>
						<path d="M 150 125 V 200" opacity=".65"/>
						<path d="M 186 109 V 200" opacity=".75"/>
						<path d="M 222 101 V 200" opacity=".85"/>
						<path d="M 258 101 V 200" opacity=".85"/>
						<path d="M 294 109 V 200" opacity=".75"/>
						<path d="M 330 125 V 200" opacity=".65"/>
						<path d="M 366 149 V 200" opacity=".55"/>
					</g>
					<!-- deck -->
					<path d="M 0 200 L 480 200" fill="none" stroke="#E8D9B8" stroke-width="2"/>
					<path d="M 0 208 L 480 208" fill="none" stroke="#AA7F3D" stroke-width="1" opacity=".45"/>
					<!-- V piers, gold rim light on the inner faces -->
					<polygon points="96,208 148,208 196,276 58,276" fill="#000000" opacity=".4"/>
					<polygon points="332,208 384,208 422,276 284,276" fill="#000000" opacity=".4"/>
					<path d="M 148 208 L 196 276" fill="none" stroke="#E8D9B8" stroke-width="1.6" opacity=".85"/>
					<path d="M 332 208 L 284 276" fill="none" stroke="#E8D9B8" stroke-width="1.6" opacity=".85"/>
					<path d="M 96 208 L 58 276" fill="none" stroke="#AA7F3D" stroke-width="1" opacity=".5"/>
					<path d="M 384 208 L 422 276" fill="none" stroke="#AA7F3D" stroke-width="1" opacity=".5"/>
					<!-- underside arch between the piers -->
					<path d="M 148 210 Q 240 292 332 210" fill="none" stroke="#D1BFA7" stroke-width="1.2" opacity=".5"/>
				</symbol>
			</svg>
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
					<button class="facade facade--audio" type="button"
					        data-embed="<?php echo esc_url( $lapin_embed ); ?>"
					        data-embed-title="<?php echo esc_attr( $lapin_item['title'] ); ?>" data-embed-audio
					        <?php if ( 'apple' === $lapin_item['type'] ) : ?>data-embed-h="175"<?php endif; ?>>
						<svg class="facade__art" aria-hidden="true" focusable="false"><use href="#lapin-bridge-mini"/></svg>
						<span class="facade__play" aria-hidden="true">
							<svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M4 8v4h2V8H4zm4-3v10h2V5H8zm4-2v14h2V3h-2zm4 4v6h2V7h-2zM0 10v2h2v-2H0z"/></svg>
						</span>
						<span class="facade__label"><?php echo esc_html( $lapin_item['label'] ?? 'Load audio player' ); ?></span>
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
					<div class="qual__mark" aria-hidden="true"><span>01</span></div>
					<h3>Highly qualified &amp; experienced specialists</h3>
					<p>Our negotiation and dispute resolution practice is unrivaled in its level of expertise. Our team of seasoned specialists have acquired decades of experience in the field and continue to demonstrate a proven track record of delivering positive outcomes for clients in even the most difficult negotiations. With over 1,000 disputes successfully resolved, we have a proven ability to save clients significant costs and resources by successfully resolving conflicts without the need for ongoing litigation.</p>
				</article>
				<article class="qual rv" style="--i:1">
					<div class="qual__mark" aria-hidden="true"><span>02</span></div>
					<h3>Broad range of subject matter expertise</h3>
					<p>Our negotiation and dispute resolution practice is unmatched in its breadth and depth, as we specialize in a wide range of areas including but not limited to personal, family, small business and partnership matters, intellectual property disputes, construction disputes, business disputes, healthcare disputes, employment and labor disputes, and medical malpractice claims.</p>
				</article>
				<article class="qual rv">
					<div class="qual__mark" aria-hidden="true"><span>03</span></div>
					<h3>Creative, innovative &amp; valuable solutions</h3>
					<p>At our company, we pride ourselves in our ability to help parties identify creative, innovative and valuable resolutions to reach a mutually agreeable conclusion to negotiations and to put an end to conflicts and disputes. We strive to exceed expectations by uncovering creative options that can minimize risk and maximize returns, all while fostering strong, long-lasting relationships.</p>
				</article>
				<article class="qual rv" style="--i:1">
					<div class="qual__mark" aria-hidden="true"><span>04</span></div>
					<h3>Continued research, learning &amp; development</h3>
					<p>Our team is composed of experts in negotiation and dispute resolution who not only practice, but also teach and conduct research at the graduate level. We are committed to ongoing learning and development, which enables us to bring our clients the most current and cutting-edge approaches, fresh insights and innovative thinking to successfully resolve their problems.</p>
				</article>
			</div>
		</div>
	</section>

	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-cta-band.php'; ?>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
