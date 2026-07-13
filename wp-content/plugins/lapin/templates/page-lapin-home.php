<?php
/**
 * Home — Marquee Hero over the treaty-signing painting, credentials band,
 * founder diptych, media wall (static grid — replaces the live carousel),
 * qualifications, CTA band. All copy retained verbatim from the live site;
 * the "WAY to WOW Showson" typo is fixed per client note.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin = array(
	'title'      => 'Lapin Negotiation Services | Negotiation, Mediation & Dispute Resolution, Los Angeles',
	'desc'       => 'Harvard-trained negotiation, mediation and dispute resolution specialists in Los Angeles. Over 25 years of experience, 1,000+ disputes resolved. Free consultation: 310-984-6952.',
	'path'       => '',
	'nav'        => 'home',
	'body_class' => 'page-home',
	'preload'    => array(
		array(
			'as'            => 'image',
			'type'          => 'image/webp',
			'href'          => Lapin::asset( 'images/hero-painting-800.webp' ),
			'imagesrcset'   => Lapin::asset( 'images/hero-painting-800.webp' ) . ' 800w, ' . Lapin::asset( 'images/hero-painting.webp' ) . ' 1280w',
			'imagesizes'    => '100vw',
			'fetchpriority' => 'high',
		),
	),
);

$lapin_media = array(
	array(
		'type'  => 'youtube',
		'id'    => '5xKDBULQIbU',
		'title' => 'Raphael Lapin with Aljazeera advising on a complex international dispute',
		'text'  => 'This video includes excerpts from a discussion between Aljazeera and Raphael Lapin, regarding the international dispute in Africa involving the Grand Ethiopian Renaissance Dam.',
	),
	array(
		'type'  => 'youtube',
		'id'    => 'oXvv7aXgpRc',
		'title' => 'Raphael Lapin with The WAY to WOW Show on Mediation in Probate & Trust Disputes',
		'text'  => 'Raphael Lapin explains how mediation resolves probate and trust disputes more efficiently while protecting estates and family relationships. He covers when mediation works best, how counsel should prepare, and why it is often the smarter strategic choice.',
	),
	array(
		'type'  => 'youtube',
		'id'    => 'D6VG_odqIoo',
		'title' => '“Working With Difficult People” — Interview on The Way to Wow Show',
		'text'  => 'Watch this great interview with Raphael Lapin on The Way to Wow Show! In the interview hosted by Kevin Bemel, Raphael discusses his book, “Working with Difficult People.”',
	),
	array(
		'type'  => 'youtube',
		'id'    => 'uTcachSgxEs',
		'title' => 'Raphael Lapin Discusses Dealing with Difficult Family Members',
		'text'  => 'Raphael Lapin returns to The Way to Wow Show to continue his discussion on how to deal with difficult people. In this interview, Raphael focuses his attention specifically on difficult family members.',
	),
	array(
		'type'  => 'soundcloud',
		'url'   => 'https://soundcloud.com/lapin-negotiation-service/the-components-of-a-successful-mediation',
		'title' => 'The Components of a Successful Mediation',
		'text'  => 'What are the necessary ingredients that make for a successful mediation? Is there a difference between a great mediation and an average mediation? How is mediation different from arbitration and litigation?',
	),
	array(
		'type'  => 'apple',
		'embed' => 'https://embed.podcasts.apple.com/us/podcast/bullies/id1625780382?i=1000721586678',
		'label' => 'Play episode · Apple Podcasts',
		'title' => 'Bullies',
		'text'  => 'Raphael shares how he resolved a school bullying dispute through a restorative, empathy-driven approach, bringing everyone together to express remorse and find healing instead of punishment.',
	),
	array(
		'type'  => 'soundcloud',
		'url'   => 'https://soundcloud.com/lapin-negotiation-service/dispute-resolution',
		'title' => 'Insights on Dispute Resolution',
		'text'  => 'A lot of us forget about is the cost of conflict, and the cost of not being able to manage conflict effectively. Raphael tells about the inner workings of conflict resolution, dispute resolution, and mediation and arbitration.',
	),
	array(
		'type'  => 'soundcloud',
		'url'   => 'https://api.soundcloud.com/tracks/1415053330',
		'title' => 'Mediation: Raphael Lapin’s Recipe for Success',
		'text'  => 'There IS a difference between an average and a great mediation. So what is Raphael Lapin’s secret? What strategies does he employ to anticipate the interests of the other party? How does he help parties follow through on their commitments?',
	),
);

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';
?>
<style>
	.hero {
		position: relative; display: flex; align-items: flex-end;
		min-height: min(68vh, 44rem); overflow: hidden; background: var(--color-navy);
	}
	.hero__bg { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; object-position: center 30%; }
	.hero__scrim {
		position: absolute; inset: 0;
		background: var(--grad-scrim);
	}
	.hero .wrap { position: relative; z-index: var(--z-raised); padding-block: var(--space-xl) var(--space-2xl); width: 100%; }
	.hero__kicker {
		display: block; font-family: var(--font-body); font-size: var(--text-sm); font-weight: 600;
		letter-spacing: var(--tracking-label); text-transform: uppercase;
		color: var(--color-accent); margin-bottom: var(--space-md);
	}
	.hero__display {
		display: block; font-size: var(--text-display); line-height: 1.06;
		color: var(--color-ink-inverse); max-width: 14ch;
	}
	.hero h1 { margin: 0; }
	.creds { border-top: 3px solid var(--color-accent); }
	.creds .wrap {
		display: grid; grid-template-columns: repeat(3, minmax(0, 1fr));
		gap: var(--space-lg); padding-block: var(--space-lg);
	}
	.creds__item { border-left: 1px solid var(--color-rule-navy); padding-left: var(--space-lg); }
	.creds__item:first-child { border-left: 0; padding-left: 0; }
	.creds__item strong { display: block; font-family: var(--font-display); font-weight: 650; font-size: var(--text-md); color: var(--color-ink-inverse); }
	.creds__item span { font-size: var(--text-sm); color: var(--color-ink-inverse-2); }
	a.creds__item { display: block; text-decoration: none; }
	a.creds__item span { transition: color var(--dur-micro) var(--ease-out); }
	a.creds__item:hover span { color: var(--color-accent); text-decoration: underline; text-underline-offset: 3px; }
	@media (max-width: 59.9375rem) {
		.hero { min-height: 60svh; }
		.creds .wrap { grid-template-columns: minmax(0, 1fr); gap: var(--space-md); }
		.creds__item { border-left: 0; padding-left: 0; }
	}
	.founder { display: grid; grid-template-columns: minmax(0, 4fr) minmax(0, 8fr); gap: var(--space-2xl); align-items: start; }
	.founder__portrait img { border-radius: var(--radius-card); }
	.founder__link { font-weight: 600; text-decoration: underline; text-decoration-color: var(--color-accent); text-decoration-thickness: 2px; text-underline-offset: 3px; }
	.founder__link:hover { color: var(--color-ink-2); }
	@media (max-width: 59.9375rem) {
		.founder { grid-template-columns: minmax(0, 1fr); gap: var(--space-lg); }
		.founder__portrait img { width: min(60%, 18rem); }
	}
	.quals { background: var(--color-paper-2); }
	.quals__grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: var(--space-xl) var(--space-2xl); }
	.qual { border-top: 1px solid var(--color-rule); padding-top: var(--space-lg); }
	.qual h3 { display: flex; align-items: center; gap: var(--space-sm); font-size: var(--text-md); }
	.qual h3 svg { width: 2.5rem; height: 2.5rem; flex-shrink: 0; color: var(--color-navy); }
	.qual p { color: var(--color-ink-2); margin-bottom: 0; }
	@media (max-width: 59.9375rem) { .quals__grid { grid-template-columns: minmax(0, 1fr); } }
</style>

<main id="main">
	<section class="hero">
		<img class="hero__bg" alt="Nineteenth-century oil painting of statesmen negotiating and signing a treaty around a desk"
		     src="<?php echo esc_url( Lapin::asset( 'images/hero-painting.webp' ) ); ?>"
		     srcset="<?php echo esc_attr( Lapin::asset( 'images/hero-painting-800.webp' ) . ' 800w, ' . Lapin::asset( 'images/hero-painting.webp' ) . ' 1280w' ); ?>"
		     sizes="100vw" width="1280" height="702" fetchpriority="high">
		<div class="hero__scrim" aria-hidden="true"></div>
		<div class="wrap">
			<h1>
				<span class="hero__kicker reveal" style="--i:0">Negotiation · Mediation · Unlitigation™</span>
				<span class="hero__display reveal" style="--i:1">Building Bridges by Resolving Differences.</span>
			</h1>
		</div>
	</section>

	<section class="creds band" aria-label="Credentials">
		<div class="wrap">
			<div class="creds__item"><strong>Harvard trained</strong><span>Negotiation, mediation and dispute resolution</span></div>
			<a class="creds__item creds__item--link" href="<?php echo esc_url( Lapin::GOOGLE_REVIEWS ); ?>" target="_blank" rel="noopener">
				<strong>Top rated in Southern California</strong>
				<span>Read our Google Reviews&nbsp;↗</span>
			</a>
			<div class="creds__item"><strong>Over 25 years of experience</strong><span>1,000+ disputes successfully resolved</span></div>
		</div>
	</section>

	<section class="sec" id="raphael">
		<div class="wrap">
			<div class="founder">
				<figure class="founder__portrait">
					<img src="<?php echo esc_url( Lapin::asset( 'images/raphael-lapin.webp' ) ); ?>" alt="Raphael E. Lapin" width="399" height="559" loading="lazy">
				</figure>
				<div>
					<div class="sec-head">
						<h2>Raphael E. Lapin</h2>
					</div>
					<div class="prose">
						<p class="lead">Looking for a skilled and experienced negotiator to help you navigate a complex negotiation or resolve an acrimonious dispute?</p>
						<p>Raphael Lapin is a Harvard-trained expert in the field of negotiation, dispute resolution and mediation. With extensive experience working with Fortune 500 corporations and governments around the world, Raphael has the knowledge and expertise to help you achieve the best possible outcome in any negotiation or mediation situation.</p>
						<p>As the principal of Lapin Negotiation Services and an adjunct professor of law at Whittier School of Law in Southern California, Raphael has a wealth of knowledge and experience to draw upon. He has taught negotiation and mediation at some of the most prestigious universities, and has lectured on international conflict resolution at Southwestern School of Law in Los Angeles.</p>
						<p>Whether you’re an individual, family, organization, business or corporation, Raphael can help you navigate negotiations, resolve differences and restore relationships with his expertise in negotiation, dispute resolution and mediation. Trust in his expertise, and let Raphael Lapin help you achieve a successful outcome in any negotiation, dispute or mediation.</p>
						<p><a class="founder__link" href="<?php echo esc_url( home_url( '/overview/' ) ); ?>">More about the firm →</a></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="sec sec--tight" id="media">
		<div class="wrap">
			<div class="sec-head">
				<h2>Media Appearances</h2>
			</div>
			<div class="media-grid">
				<?php foreach ( $lapin_media as $lapin_item ) : ?>
				<article class="media-card">
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
						: 'https://w.soundcloud.com/player/?url=' . rawurlencode( $lapin_item['url'] ) . '&color=%23ffb703&auto_play=true&visual=false';
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

	<section class="sec quals" id="qualified">
		<div class="wrap">
			<div class="sec-head">
				<h2>What makes us uniquely qualified</h2>
			</div>
			<div class="quals__grid">
				<article class="qual">
					<h3><?php echo Lapin::icon( 'award' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>Highly qualified &amp; experienced specialists</h3>
					<p>Our negotiation and dispute resolution practice is unrivaled in its level of expertise. Our team of seasoned specialists have acquired decades of experience in the field and continue to demonstrate a proven track record of delivering positive outcomes for clients in even the most difficult negotiations. With over 1,000 disputes successfully resolved, we have a proven ability to save clients significant costs and resources by successfully resolving conflicts without the need for ongoing litigation.</p>
				</article>
				<article class="qual">
					<h3><?php echo Lapin::icon( 'layers' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>Broad range of subject matter expertise</h3>
					<p>Our negotiation and dispute resolution practice is unmatched in its breadth and depth, as we specialize in a wide range of areas including but not limited to personal, family, small business and partnership matters, intellectual property disputes, construction disputes, business disputes, healthcare disputes, employment and labor disputes, and medical malpractice claims.</p>
				</article>
				<article class="qual">
					<h3><?php echo Lapin::icon( 'lightbulb' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>Creative, innovative &amp; valuable solutions</h3>
					<p>At our company, we pride ourselves in our ability to help parties identify creative, innovative and valuable resolutions to reach a mutually agreeable conclusion to negotiations and to put an end to conflicts and disputes. We strive to exceed expectations by uncovering creative options that can minimize risk and maximize returns, all while fostering strong, long-lasting relationships.</p>
				</article>
				<article class="qual">
					<h3><?php echo Lapin::icon( 'book-open' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>Continued research, learning &amp; development</h3>
					<p>Our team is composed of experts in negotiation and dispute resolution who not only practice, but also teach and conduct research at the graduate level. We are committed to ongoing learning and development, which enables us to bring our clients the most current and cutting-edge approaches, fresh insights and innovative thinking to successfully resolve their problems.</p>
				</article>
			</div>
		</div>
	</section>

	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-cta-band.php'; ?>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
