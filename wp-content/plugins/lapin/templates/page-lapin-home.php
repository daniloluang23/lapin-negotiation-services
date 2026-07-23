<?php
/**
 * Home — split tagline hero on the shared bridge masthead (copy left, art
 * right), credentials band, practice areas, founder diptych, reviews grid,
 * media wall (static grid), four qualification cards,
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
	// Bridge art preload is emitted for every page by lapin-head.php.
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
		// Plays from 0:00 — the host re-edited the video in place (2026-07-21), so the old 6:26 skip is obsolete.
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
		'text'  => 'A lot of us forget about the cost of conflict, and the cost of not being able to manage conflict effectively. Raphael tells about the inner workings of conflict resolution, dispute resolution, and mediation and arbitration.',
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
	.creds__stars { display: flex; gap: 0.2rem; }
	.creds__stars svg { width: 1.05rem; height: 1.05rem; color: var(--color-accent); }
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
	/* Role line under the founder heading — eyebrow voice, below the name. */
	.founder__role {
		display: block; font-size: var(--text-sm); font-weight: 600;
		letter-spacing: var(--tracking-label); text-transform: uppercase;
		color: var(--color-accent-strong);
	}
	.founder__portrait img { border-radius: var(--radius-card); }
	.founder__link { font-weight: 600; text-decoration: underline; text-decoration-color: var(--color-accent); text-decoration-thickness: 2px; text-underline-offset: 3px; }
	.founder__link:hover { color: var(--color-accent-strong); }
	.founder__actions { display: flex; flex-wrap: wrap; align-items: center; gap: var(--space-md); margin-top: var(--space-lg); }
	@media (max-width: 63.9375rem) {
		.founder { grid-template-columns: minmax(0, 1fr); gap: var(--space-lg); }
		.founder__portrait img { width: min(60%, 18rem); }
	}
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
	/* Qualified — 2×2 layout; icon marks replace the photos. */
	.quals__head { text-align: center; }
	.quals__head::after { margin-inline: auto; }
	.quals__grid {
		display: grid; grid-template-columns: repeat(2, minmax(0, 1fr));
		gap: var(--space-2xl) var(--space-3xl); text-align: center;
	}
	@media (max-width: 40rem) { .quals__grid { grid-template-columns: minmax(0, 1fr); } }
	/* Icon marks (client choice 2026-07-21: thin-stroke line icons, not
	   numerals) — paper disc, hairline ring, inner rose-gold ring. */
	.qual__mark {
		position: relative; display: grid; place-items: center;
		width: 160px; height: 160px; margin: 0 auto var(--space-xl);
		background: var(--color-paper-2); border: 1px solid var(--color-rule); border-radius: 50%;
	}
	.qual__mark::after {
		content: ""; position: absolute; inset: 10px;
		border: 1px solid var(--color-accent); border-radius: 50%; opacity: 0.55;
	}
	.qual__mark svg {
		width: 3.75rem; height: 3.75rem;
		color: var(--color-accent); stroke-width: 1.5;
	}
	.qual h3 { font-size: var(--text-body); text-transform: uppercase; letter-spacing: 0.05em; line-height: 1.4; margin-bottom: var(--space-sm); }
	.qual p { color: var(--color-ink-2); font-size: 0.9375rem; max-width: 52ch; margin: 0 auto; }
	/* Reviews modal — first-party <dialog> stand-in for the old Trustindex popup. */
	.reviews-modal {
		width: min(40rem, calc(100vw - 2 * var(--space-md)));
		max-height: 85dvh; margin: auto; padding: 0; border: 0;
		border-radius: var(--radius-card); background: var(--color-paper-2);
		box-shadow: 0 24px 60px rgb(0 0 0 / 0.35); overflow: auto; overscroll-behavior: contain;
	}
	.reviews-modal::backdrop { background: rgb(0 0 0 / 0.55); }
	body:has(.reviews-modal[open]) { overflow: hidden; }
	.reviews-modal__bar {
		position: sticky; top: 0; z-index: 1;
		display: flex; align-items: center; justify-content: space-between;
		padding: var(--space-sm) var(--space-lg);
		background: var(--color-paper); border-bottom: 1px solid var(--color-rule);
	}
	.reviews-modal__bar h2 { font-size: var(--text-md); margin: 0; }
	.reviews-modal__close {
		display: grid; place-items: center; width: 2.25rem; height: 2.25rem;
		background: none; border: 1px solid var(--color-rule); border-radius: 50%;
		color: var(--color-ink); cursor: pointer;
		transition: border-color var(--dur-micro) var(--ease-out), color var(--dur-micro) var(--ease-out);
	}
	.reviews-modal__close:hover { border-color: var(--color-accent); color: var(--color-accent-strong); }
	.reviews-modal__body { padding: var(--space-lg); display: grid; gap: var(--space-md); }
	.reviews-modal__summary {
		display: grid; justify-items: center; gap: var(--space-2xs); text-align: center;
		background: var(--color-paper); border: 1px solid var(--color-rule);
		border-radius: var(--radius-card); padding: var(--space-md) var(--space-lg);
	}
	.reviews-modal__summary > strong { font-family: var(--font-display); font-size: var(--text-md); }
	.reviews-modal__score {
		display: inline-flex; align-items: center; gap: var(--space-xs);
		font-family: var(--font-display); font-weight: 700; font-size: var(--text-md); color: var(--color-ink);
	}
	.reviews-modal__stars { display: inline-flex; gap: 0.15rem; color: var(--color-star); }
	.reviews-modal__stars svg { width: 1.1rem; height: 1.1rem; }
	.reviews-modal__count { font-size: var(--text-sm); color: var(--color-ink-2); }
	.reviews-modal__actions { display: flex; flex-wrap: wrap; justify-content: center; gap: var(--space-sm); margin-top: var(--space-xs); }
	.reviews-modal__list { display: grid; gap: var(--space-md); }
	.reviews-modal__foot { display: flex; justify-content: center; padding-bottom: var(--space-xs); }
	/* Modal cards always show the full review; the grid's clamp JS runs while
	   the dialog is closed (zero heights), so opt out of it here. */
	.reviews-modal .review-card p.is-clamped { display: block; overflow: visible; -webkit-line-clamp: unset; }
	.reviews-modal .review-card__more { display: none; }
</style>

<main id="main">
	<section class="creds band" aria-label="Credentials">
		<div class="wrap">
			<div class="creds__item rv">
				<?php echo Lapin::icon( 'award' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<div><strong>Harvard trained</strong><span>Negotiation, Mediation and Dispute Resolution</span></div>
			</div>
			<?php // href is the no-JS fallback; the footer script intercepts and opens #reviews-modal instead. ?>
			<a class="creds__item creds__item--stack rv" style="--i:1" href="<?php echo esc_url( Lapin::GOOGLE_REVIEWS ); ?>" target="_blank" rel="noopener" data-modal="reviews-modal">
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
						<h2>Meet Raphael Lapin</h2>
						<span class="founder__role">Negotiator. Mediator. Problem Solver.</span>
					</div>
					<div class="prose rv" style="--i:1">
						<p class="lead">Whether you’re facing a business dispute, family conflict, trust litigation, or a high stakes negotiation, Raphael Lapin helps parties reach practical, lasting agreements while preserving relationships wherever possible.</p>
						<p>A Harvard trained negotiation and dispute resolution expert, Raphael has advised Fortune 500 companies, government agencies, and organizations around the world. His work blends deep expertise with a calm, structured approach that moves parties from impasse to resolution.</p>
						<p>As principal of Lapin Negotiation Services and former adjunct professor of law at Whittier School of Law, Raphael has taught negotiation and mediation at leading universities and lectured on international conflict resolution at Southwestern School of Law in Los Angeles.</p>
						<p>Individuals, families, businesses, and organizations turn to Raphael for guidance through complex negotiations, disputes, and relationship sensitive conflicts. His focus is simple: clear process, constructive dialogue, and durable agreements.</p>
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
				<h2 id="testimonials-title">Client Experiences</h2>
			</div>
			<div class="reviews-grid rv">
				<?php
				foreach ( array_slice( Lapin_Reviews::get(), 0, 6 ) as $lapin_review ) {
					require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-review-card.php';
				}
				?>
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

	<section class="sec" id="qualified">
		<div class="wrap">
			<div class="sec-head quals__head rv">
				<h2>What Makes Us Uniquely Qualified</h2>
			</div>
			<div class="quals__grid">
				<article class="qual rv">
					<div class="qual__mark" aria-hidden="true"><?php echo Lapin::icon( 'award' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
					<h3>Expertise You Can Trust in High Stakes Negotiation</h3>
					<p>With decades of specialist experience and more than 1,000 disputes resolved, we deliver consistently exceptional outcomes. Clients rely on us to navigate their most complex matters and to secure durable resolutions that avoid the cost and disruption of litigation.</p>
				</article>
				<article class="qual rv" style="--i:1">
					<div class="qual__mark" aria-hidden="true"><?php echo Lapin::icon( 'network' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
					<h3>Breadth of Expertise Across Complex Matters</h3>
					<p>Our practice brings deep, cross disciplinary experience to a wide range of disputes&mdash;from personal, family, and small business matters to partnership, intellectual property, construction, healthcare, employment, and malpractice claims. This breadth allows us to navigate diverse challenges with clarity, precision, and sound judgment.</p>
				</article>
				<article class="qual rv">
					<div class="qual__mark" aria-hidden="true"><?php echo Lapin::icon( 'lightbulb' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
					<h3>Creative Solutions That Move Negotiations Forward</h3>
					<p>We help parties uncover thoughtful, innovative options that lead to mutually beneficial resolutions. Our approach emphasizes clarity, creativity, and long term value&mdash;minimizing risk, strengthening relationships, and guiding clients toward outcomes that stand the test of time.</p>
				</article>
				<article class="qual rv" style="--i:1">
					<div class="qual__mark" aria-hidden="true"><?php echo Lapin::icon( 'book-open' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
					<h3>Continual Advancement in Negotiation and Dispute Resolution Excellence</h3>
					<p>We blend active practice with ongoing learning, development and research, ensuring our methods remain at the forefront of the field. This continual investment in learning allows us to offer clients sharper analysis, more advanced strategies, and fresh, well grounded insights that meaningfully strengthen their position in any negotiation.</p>
				</article>
			</div>
		</div>
	</section>

	<section class="sec sec--tight band--cream" id="media">
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
					        data-embed="https://www.youtube-nocookie.com/embed/<?php echo esc_attr( $lapin_item['id'] ); ?>?autoplay=1<?php echo empty( $lapin_item['start'] ) ? '' : '&amp;start=' . (int) $lapin_item['start']; ?>"
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

	<?php
	// Latest blog posts (SEO/engagement — client direction 2026-07-22, blog revived).
	$lapin_latest = get_posts( array(
		'post_type'   => 'post',
		'post_status' => 'publish',
		'numberposts' => 3,
		'orderby'     => 'date',
		'order'       => 'DESC',
	) );
	if ( $lapin_latest ) :
	?>
	<section class="sec" id="blog">
		<div class="wrap">
			<div class="sec-head">
				<span class="sec-head__eyebrow">From the Blog</span>
				<h2>Insights on Dispute Resolution</h2>
			</div>
			<div class="post-grid">
				<?php foreach ( $lapin_latest as $lapin_i => $lapin_post ) : ?>
				<?php $lapin_img = Lapin_Posts::image( $lapin_post->post_name, true ); ?>
				<article class="card post-card<?php echo $lapin_img ? '' : ' post-card--text'; ?> rv" style="--i:<?php echo esc_attr( $lapin_i ); ?>">
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
			<p class="rv" style="margin-top: var(--space-xl);"><a class="btn btn--outline" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">View all articles</a></p>
		</div>
	</section>
	<?php endif; ?>

	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-cta-band.php'; ?>

	<?php
	// First-party Google-reviews modal (client request 2026-07-21): replicates
	// the old site's Trustindex popup with zero third-party JS — the data
	// auto-syncs on the live server via Lapin_Reviews. Opened by the creds
	// "Top rated" item; the footer script drives [data-modal]/[data-modal-close].
	?>
	<dialog class="reviews-modal" id="reviews-modal" aria-labelledby="reviews-modal-title">
		<div class="reviews-modal__bar">
			<h2 id="reviews-modal-title">Google Reviews</h2>
			<button class="reviews-modal__close" type="button" data-modal-close aria-label="Close">
				<svg width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true"><path d="M1 1l12 12M13 1L1 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
			</button>
		</div>
		<div class="reviews-modal__body">
			<div class="reviews-modal__summary">
				<strong><?php echo esc_html( Lapin::NAME ); ?></strong>
				<span class="reviews-modal__score">
					5.0
					<span class="reviews-modal__stars" aria-hidden="true">
						<?php for ( $lapin_s = 0; $lapin_s < 5; $lapin_s++ ) : ?>
						<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.9 6.3 6.9.8-5.1 4.7 1.4 6.8L12 17.2l-6.1 3.4 1.4-6.8L2.2 9.1l6.9-.8z"/></svg>
						<?php endfor; ?>
					</span>
				</span>
				<span class="reviews-modal__count">40+ Five-Star Google Reviews</span>
				<div class="reviews-modal__actions">
					<a class="btn btn--rose" href="<?php echo esc_url( Lapin::GOOGLE_REVIEWS ); ?>" target="_blank" rel="noopener">See all reviews</a>
					<a class="btn btn--outline" href="<?php echo esc_url( Lapin::GOOGLE_WRITE_REVIEW ); ?>" target="_blank" rel="noopener">Review us on Google</a>
				</div>
			</div>
			<div class="reviews-modal__list">
				<?php
				foreach ( Lapin_Reviews::get() as $lapin_review ) {
					require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-review-card.php';
				}
				?>
			</div>
			<div class="reviews-modal__foot">
				<a class="btn btn--rose" href="<?php echo esc_url( Lapin::GOOGLE_REVIEWS ); ?>" target="_blank" rel="noopener">View all</a>
			</div>
		</div>
	</dialog>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
