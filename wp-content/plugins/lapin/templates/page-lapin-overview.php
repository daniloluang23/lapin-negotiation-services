<?php
/**
 * About Us (/overview/) — client redesign 2026-07-24 (claude-design handoff
 * `design_handoff_about_us`). The text-heavy page is re-fronted with a
 * headshot-led hero + value pillars + an "Our Practice" pull-quote (mockup copy,
 * client-approved as-is), then the retained verbatim "Media appearances" and
 * "Our mission / Our vision" sections below. Page-title hero removed per client;
 * shared masthead + footer retained.
 *
 * The mockup's Playfair/Montserrat/Sacramento + warm-brown palette is rebuilt in
 * the site's locked design system (DM Sans + Poppins, brand tokens) so About
 * reads as the same site, not a bolt-on. Headshot is the client-supplied photo,
 * EXIF-rotated upright into assets/images/about-headshot-*.webp (LCP; preloaded).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin = array(
	'title'      => 'About Us | Harvard-Trained Negotiation & Mediation Specialists | Lapin Negotiation Services',
	'desc'       => 'Meet Lapin Negotiation Services and founder Raphael E. Lapin — Harvard-trained negotiator, mediator, law professor and author, trusted by Microsoft, AT&T, Yahoo, BT and the US Air Force.',
	'path'       => 'overview/',
	'nav'        => 'overview',
	'body_class' => 'page-overview',
	// Headshot is the LCP image on this page (masthead is nav-only). Preload it.
	'og_image'   => Lapin::asset( 'images/about-headshot-1200.webp' ),
	'preload'    => array(
		array(
			'as'            => 'image',
			'href'          => Lapin::asset( 'images/about-headshot-1200.webp' ),
			'type'          => 'image/webp',
			'imagesrcset'   => Lapin::asset( 'images/about-headshot-800.webp' ) . ' 800w, ' . Lapin::asset( 'images/about-headshot-1200.webp' ) . ' 1200w',
			'imagesizes'    => '(max-width: 57.5rem) 100vw, 50vw',
			'fetchpriority' => 'high',
		),
	),
	// No $lapin['hero'] — the masthead renders nav-only (page-title block removed
	// per client 2026-07-24); the headshot hero below replaces it.
);

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';

// Retained verbatim media list — each entry anchors to its card in the home
// media wall (id="media-<slug>").
$lapin_media_list = array(
	array( 'Raphael Lapin with Aljazeera advising on a complex international dispute', home_url( '/#media-aljazeera' ) ),
	array( 'Raphael Lapin with The WAY to WOW Show on Mediation in Probate & Trust Disputes', home_url( '/#media-probate-trust' ) ),
	array( '“Working With Difficult People” — Interview on The Way to Wow Show', home_url( '/#media-difficult-people' ) ),
	array( 'Raphael Lapin Discusses Dealing with Difficult Family Members', home_url( '/#media-difficult-family' ) ),
	array( 'The Components of a Successful Mediation', home_url( '/#media-successful-mediation' ) ),
	array( 'Bullies', home_url( '/#media-bullies' ) ),
	array( 'Insights on Dispute Resolution', home_url( '/#media-dispute-resolution' ) ),
	array( 'Mediation: Raphael Lapin’s Recipe for Success', home_url( '/#media-recipe-success' ) ),
);

// Value pillars (mockup copy, client-approved 2026-07-24). Icon = Lucide slug.
$lapin_pillars = array(
	array( 'users', 'Our Approach', 'We believe every dispute has a solution. Our role is to facilitate productive conversations and guide parties toward practical, lasting outcomes.' ),
	array( 'handshake', 'Our Commitment', 'We are committed to integrity, confidentiality, and impartiality in every matter we handle.' ),
	array( 'target', 'Our Focus', 'We focus on outcomes that matter—helping clients achieve resolution while maintaining control over the process.' ),
	array( 'shield', 'Our Promise', 'We bring experience, creativity, and dedication to every case, always working in your best interests.' ),
);

// Reused inline arrow (Lucide arrow-right) for text/button links.
$lapin_arrow = '<svg class="about-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>';
?>
<style>
	/* ── About redesign (claude-design handoff, rebuilt in the design system) ── */
	/* --about-card-lift keeps the pillar card's upward overlap and the hero
	   name-plate's clearance in sync (plate sits just above the card). */
	.page-overview { background: var(--color-paper-2); --about-card-lift: 70px; }

	.about-eyebrow { display: flex; align-items: center; gap: 0.875rem; margin-bottom: var(--space-lg); }
	.about-eyebrow__rule { width: 38px; height: 1.5px; background: var(--color-accent); flex-shrink: 0; }
	.about-eyebrow__label {
		font-size: var(--text-sm); font-weight: 600; letter-spacing: 0.3em;
		text-transform: uppercase; color: var(--color-accent);
	}
	.about-arrow { flex-shrink: 0; }

	/* Hero: copy left, full-bleed headshot right (flex-wrap, no hard breakpoint). */
	.about-hero { position: relative; overflow: hidden; }
	.about-hero__inner { display: flex; flex-wrap: wrap; align-items: stretch; }
	.about-hero__text {
		flex: 1 1 480px; min-width: 320px;
		display: flex; flex-direction: column; justify-content: center;
		padding: clamp(3rem, 6vw, 5.75rem) clamp(1.5rem, 4vw, 3.5rem)
		         clamp(3rem, 6vw, 5.75rem) clamp(1.5rem, 7vw, 7.5rem);
	}
	.about-hero h1 {
		font-size: clamp(2.375rem, 4.6vw, 3.875rem); line-height: 1.06;
		letter-spacing: -0.01em; margin: 0 0 var(--space-lg);
	}
	.about-hero__line { display: block; }
	.about-hero__line--accent { color: var(--color-accent); }
	.about-hero__lede { max-width: 29rem; color: var(--color-ink-2); margin: 0 0 var(--space-md); line-height: 1.8; }
	.about-hero__lede:last-of-type { margin-bottom: var(--space-xl); }
	.about-hero__actions { display: flex; flex-wrap: wrap; align-items: center; gap: var(--space-md); }
	.about-meet {
		display: inline-flex; align-items: center; gap: 0.5rem;
		font-weight: 600; font-size: 0.9375rem; letter-spacing: 0.02em;
		color: var(--color-ink); text-decoration: none;
		transition: color var(--dur-micro) var(--ease-out);
	}
	.about-meet:hover { color: var(--color-accent-strong); }
	.about-meet:hover .about-arrow { transform: translateX(3px); }
	.about-meet .about-arrow { transition: transform var(--dur-short) var(--ease-out); }

	.about-hero__media {
		flex: 1 1 440px; min-width: 300px; position: relative;
		min-height: clamp(380px, 52vw, 640px); background: var(--color-onyx);
	}
	.about-hero__media img {
		position: absolute; inset: 0; width: 100%; height: 100%;
		object-fit: cover; object-position: 50% 28%; /* Y tunable: keeps the seated subject's face framed */
	}
	/* Left-edge cream wash blends the photo into the page (handoff). */
	.about-hero__media::before {
		content: ""; position: absolute; inset: 0; pointer-events: none; z-index: 1;
		background: linear-gradient(90deg, color-mix(in srgb, var(--color-paper-2) 55%, transparent) 0%, transparent 22%);
	}
	.about-hero__plate {
		/* Lifted to clear the pillar card that overlaps the hero's lower edge. */
		position: absolute; left: 0; bottom: calc(var(--about-card-lift) + 0.25rem); z-index: 2;
		background: color-mix(in srgb, var(--color-onyx) 88%, transparent);
		color: var(--color-ink-inverse); padding: 1.125rem 1.625rem;
	}
	.about-hero__plate strong { display: block; font-family: var(--font-display); font-weight: 700; font-size: 1.1875rem; letter-spacing: 0.01em; }
	.about-hero__plate span { display: block; font-size: 0.65rem; letter-spacing: 0.22em; text-transform: uppercase; color: var(--color-gold); margin-top: 0.3rem; }

	/* Pillars: floating card pulled up over the hero's lower edge. */
	.about-pillars { padding: 0 clamp(1.25rem, 4vw, 2.75rem) clamp(3.5rem, 6vw, 5.5rem); }
	.about-pillars__card {
		max-width: 1180px; margin: calc(-1 * var(--about-card-lift)) auto 0; position: relative; z-index: 5;
		background: var(--color-paper); box-shadow: 0 24px 60px -34px rgba(48, 32, 16, 0.4);
		display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
	}
	.about-pillar {
		display: flex; flex-direction: column; align-items: center; text-align: center;
		padding: clamp(1.875rem, 3vw, 2.875rem) clamp(1.375rem, 2.4vw, 2.125rem);
		border-right: 1px solid var(--color-rule); border-bottom: 1px solid var(--color-rule);
	}
	.about-pillar__icon { width: 38px; height: 38px; color: var(--color-accent); stroke-width: 1.4; margin-bottom: var(--space-md); }
	.about-pillar h3 { font-size: 1.375rem; margin: 0 0 var(--space-sm); }
	.about-pillar p { font-size: 0.85rem; line-height: 1.75; color: var(--color-ink-2); margin: 0; max-width: 230px; }

	/* Our Practice: narrative + quote card. */
	.about-practice { padding: clamp(1.25rem, 2vw, 2.5rem) clamp(1.5rem, 4vw, 2.75rem) clamp(4.375rem, 7vw, 6.875rem); }
	.about-practice__inner {
		max-width: 1180px; margin: 0 auto; display: grid;
		grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
		gap: clamp(2.5rem, 5vw, 5rem); align-items: center;
	}
	.about-practice h2 { font-size: clamp(2rem, 3.6vw, 3rem); line-height: 1.1; margin: 0 0 var(--space-lg); }
	.about-practice__body { color: var(--color-ink-2); line-height: 1.8; margin: 0 0 var(--space-md); max-width: 33rem; }
	.about-practice__body:last-of-type { margin-bottom: var(--space-xl); }

	.about-quote {
		background: var(--color-paper);
		border: 1px solid color-mix(in srgb, var(--color-gold) 55%, transparent);
		padding: clamp(2.25rem, 3.5vw, 3.375rem);
	}
	.about-quote__mark { font-family: var(--font-display); font-weight: 700; font-size: 5rem; line-height: 0.6; color: var(--color-accent); height: 2.5rem; }
	.about-quote__text {
		font-family: var(--font-display); font-weight: 500;
		font-size: clamp(1.25rem, 2vw, 1.625rem); line-height: 1.5;
		color: var(--color-ink); margin: 0 0 var(--space-xl);
	}
	.about-quote__sig-name { font-family: var(--font-display); font-weight: 700; font-size: 1.5rem; color: var(--color-accent-strong); line-height: 1; }
	.about-quote__rule { width: 44px; height: 1.5px; background: var(--color-accent); margin: var(--space-sm) 0; }
	.about-quote__sig-role { font-size: 0.8rem; letter-spacing: 0.04em; color: var(--color-ink-2); }

	/* Retained content — media appearances + mission/vision (verbatim). */
	.media-list { list-style: none; margin: 0; padding: 0; }
	.media-list li { border-top: 1px solid var(--color-rule); }
	.media-list li:last-child { border-bottom: 1px solid var(--color-rule); }
	.media-list a {
		display: flex; justify-content: space-between; gap: var(--space-lg); align-items: baseline;
		padding: var(--space-sm) 0; text-decoration: none; color: var(--color-ink-2);
	}
	.media-list a:hover { color: var(--color-ink); }
	.media-list a::after { content: "→"; color: var(--color-accent); flex-shrink: 0; }
	.mission { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: var(--space-2xl); }
	.mission > div { border-top: 2px solid var(--color-accent); padding-top: var(--space-md); }
	@media (max-width: 40rem) { .mission { grid-template-columns: minmax(0, 1fr); gap: var(--space-lg); } }
</style>

<main id="main">

	<section class="about-hero" aria-labelledby="about-hero-title">
		<div class="about-hero__inner">
			<div class="about-hero__text">
				<span class="about-eyebrow reveal" style="--i:0">
					<span class="about-eyebrow__rule" aria-hidden="true"></span>
					<span class="about-eyebrow__label">About Our Practice</span>
				</span>
				<h1 id="about-hero-title" class="reveal" style="--i:1">
					<span class="about-hero__line">Building Bridges.</span>
					<span class="about-hero__line about-hero__line--accent">Resolving Differences.</span>
				</h1>
				<p class="about-hero__lede reveal" style="--i:2">At Lapin Negotiation Services, our mission is simple: to help people and organizations move from conflict to resolution—efficiently, respectfully, and effectively.</p>
				<p class="about-hero__lede reveal" style="--i:2">We provide skilled mediation and negotiation services that save time, reduce costs, and protect relationships.</p>
				<div class="about-hero__actions reveal" style="--i:3">
					<a class="btn btn--rose" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Schedule a Consultation</a>
					<a class="about-meet" href="<?php echo esc_url( home_url( '/#raphael' ) ); ?>">Meet Raphael Lapin <?php echo $lapin_arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static inline SVG ?></a>
				</div>
			</div>
			<div class="about-hero__media">
				<img src="<?php echo esc_url( Lapin::asset( 'images/about-headshot-1200.webp' ) ); ?>"
				     srcset="<?php echo esc_attr( Lapin::asset( 'images/about-headshot-800.webp' ) . ' 800w, ' . Lapin::asset( 'images/about-headshot-1200.webp' ) . ' 1200w' ); ?>"
				     sizes="(max-width: 57.5rem) 100vw, 50vw"
				     alt="Raphael Lapin, Mediator &amp; Negotiation Consultant"
				     width="1200" height="1800" fetchpriority="high" decoding="async">
				<div class="about-hero__plate">
					<strong>Raphael Lapin</strong>
					<span>Mediator &amp; Negotiation Consultant</span>
				</div>
			</div>
		</div>
	</section>

	<section class="about-pillars" aria-label="What we bring to every matter">
		<div class="about-pillars__card">
			<?php foreach ( $lapin_pillars as $lapin_p ) : ?>
			<div class="about-pillar">
				<?php echo Lapin::icon( $lapin_p[0], 'about-pillar__icon' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted inline SVG ?>
				<h3><?php echo esc_html( $lapin_p[1] ); ?></h3>
				<p><?php echo esc_html( $lapin_p[2] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="about-practice" aria-labelledby="about-practice-title">
		<div class="about-practice__inner">
			<div>
				<span class="about-eyebrow">
					<span class="about-eyebrow__rule" aria-hidden="true"></span>
					<span class="about-eyebrow__label">Our Practice</span>
				</span>
				<h2 id="about-practice-title">Experienced. Focused.<br>Results-Oriented.</h2>
				<p class="about-practice__body">With decades of experience in law and dispute resolution, we understand the complexities of conflict and the importance of finding solutions that are fair, efficient, and enduring.</p>
				<p class="about-practice__body">Our practice is built on skillful negotiation, strategic thinking, and a deep commitment to helping clients move forward with confidence.</p>
				<a class="btn btn--rose" href="<?php echo esc_url( home_url( '/practice-areas/' ) ); ?>">View Our Practice Areas <?php echo $lapin_arrow; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static inline SVG ?></a>
			</div>
			<figure class="about-quote">
				<div class="about-quote__mark" aria-hidden="true">&ldquo;</div>
				<blockquote class="about-quote__text">The art of negotiation is not about winning or losing—it&rsquo;s about finding common ground and building a better path forward.</blockquote>
				<figcaption>
					<div class="about-quote__sig-name">Raphael Lapin</div>
					<div class="about-quote__rule" aria-hidden="true"></div>
					<div class="about-quote__sig-role">Mediator &amp; Negotiation Consultant</div>
				</figcaption>
			</figure>
		</div>
	</section>

	<section class="sec" id="media-appearances" aria-labelledby="media-title">
		<div class="wrap">
			<div class="sec-head">
				<span class="sec-head__eyebrow">In the Media</span>
				<h2 id="media-title">Media appearances</h2>
			</div>
			<ul class="media-list">
				<?php foreach ( $lapin_media_list as $lapin_item ) : ?>
				<li><a href="<?php echo esc_url( $lapin_item[1] ); ?>"><?php echo esc_html( $lapin_item[0] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<section class="sec band" id="mission-vision" aria-label="Our mission and vision">
		<div class="wrap">
			<div class="mission">
				<div>
					<h2>Our mission</h2>
					<p>To provide negotiation and dispute resolution services by facilitating an authentic process of dialogue, understanding, collaborative problem-solving, value creation and trust to achieve optimal agreements, strong working relationships, and mutually satisfying resolutions.</p>
				</div>
				<div>
					<h2>Our vision</h2>
					<p>To influence the negotiation and dispute resolution landscape and transform it from adversarial posturing and positioning to an authentic and collaborative process of seeking joint solutions to conflicting needs.</p>
				</div>
			</div>
		</div>
	</section>

	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-cta-band.php'; ?>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
