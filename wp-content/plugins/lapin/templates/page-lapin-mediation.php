<?php
/**
 * Mediation (/mediation/) — client copy replacement 2026-09-05 (Raphael's
 * "Mediation Services Page" doc + the matching page-design brief, used
 * verbatim per the content law).
 *
 * Third sibling of the service family's Stepped Studio: masthead hero →
 * a Split Studio opener ("What Mediation Is") → a cream band of six How We
 * Help cards in the brief's two-column layout → the three-way distinction
 * against Negotiation and Dispute Resolution → a three-column "Who This Is
 * For" grid → the Outcome bar → the client's Advisory Services callout →
 * the onyx CTA band. The locked system (design.md) supplies every token.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin = array(
	'title'      => 'Mediation Services | Complex & Contentious Disputes | Lapin Negotiation Services',
	'desc'       => 'A confidential, facilitated mediation process for complex and contentious disputes — reduce conflict, clarify interests, and build durable agreements. Free consultation.',
	'path'       => 'mediation/',
	'nav'        => 'mediation',
	'body_class' => 'page-mediation',
	'hero'       => array(
		'eyebrow' => 'Mediation Services',
		'title'   => 'Mediation for Complex & Contentious Disputes',
		'lede'    => 'A structured, impartial process that helps parties reduce conflict, restore clarity, and craft solutions aligned with their underlying interests.',
		'cta'     => 'Free Consultation',
	),
	'schema'     => array(
		array(
			'@type'       => 'Service',
			'name'        => 'Mediation Services',
			'provider'    => array( '@id' => home_url( '/' ) . '#organization' ),
			'serviceType' => 'Mediation, neutral facilitation, and advisory support during third-party mediation',
			'areaServed'  => 'Southern California',
		),
	),
);

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';

// "How We Help" — the client's six capabilities, in the brief's two-column grid.
// Parallel capabilities, not an ordinal sequence, so no stage word (cf. /dispute-resolution/).
$lapin_help = array(
	array(
		'icon'  => 'scale',
		'title' => 'Neutral Facilitation',
		'body'  => 'We provide a calm, impartial presence that helps parties communicate constructively, even when trust is low or emotions run high. The mediator guides the process, ensures fairness, and maintains clarity throughout.',
	),
	array(
		'icon'  => 'layers',
		'title' => 'Structured Dialogue',
		'body'  => 'Ambiguity accelerates conflict. We introduce a clear, predictable framework for how discussions unfold, how issues are addressed, and how decisions are made — reducing volatility and creating conditions for progress.',
	),
	array(
		'icon'  => 'target',
		'title' => 'Clarifying Interests',
		'body'  => 'We help parties move beyond hardened positions to uncover the underlying interests, priorities, and concerns driving the dispute. This shift often reveals areas of alignment that were previously obscured.',
	),
	array(
		'icon'  => 'lightbulb',
		'title' => 'Managing Impasse',
		'body'  => 'When discussions stall, we help reframe issues, explore alternative pathways, and identify practical options that restore momentum and open new avenues for resolution.',
	),
	array(
		'icon'  => 'messages-square',
		'title' => 'Joint Sessions & Private Caucus',
		'body'  => 'Depending on the situation, we facilitate direct dialogue or work through private, confidential conversations. Each step is designed to reduce misinterpretation, rebuild clarity, and support constructive engagement.',
	),
	array(
		'icon'  => 'handshake',
		'title' => 'Agreement Building',
		'body'  => 'Once stability and understanding are restored, we guide parties toward agreements that are workable, realistic, and sustainable — agreements that reduce future conflict and support long-term functioning.',
	),
);

// The three-way distinction. 'link' cross-references the sibling service pages;
// 'this' marks the mediation panel, which carries the cream fill + rose top edge.
$lapin_distinct = array(
	array(
		'term' => 'Negotiation',
		'link' => 'negotiation/',
		'body' => 'focuses on advancing interests and securing outcomes.',
		'this' => false,
	),
	array(
		'term' => 'Dispute Resolution',
		'link' => 'dispute-resolution/',
		'body' => 'stabilizes escalation and rebuilds communication channels.',
		'this' => false,
	),
	array(
		'term' => 'Mediation',
		'link' => '',
		'body' => 'provides a <strong>neutral, facilitated process</strong> where parties work collaboratively toward resolution. Mediation is appropriate when parties are ready &mdash; or can be made ready &mdash; to engage in structured dialogue with the support of an impartial professional.',
		'this' => true,
	),
);

// "Who This Is For" — the client's nine situations. Two house-style
// normalisations against the sibling pages: "cofounder" → "Co-founder",
// "Trust & estate" → "Trust & Estate".
$lapin_for = array(
	'Workplace conflict',
	'Partnership or co-founder disputes',
	'Leadership breakdowns',
	'Team or departmental friction',
	'Family business disputes',
	'Trust & Estate matters',
	'Interpersonal disputes',
	'Situations where direct communication is difficult',
	'Conflicts requiring a neutral, confidential process',
);

?>
<style>
	/* Hallmark · macrostructure: Split Studio → stepped studio (service family, design.md v2.12)
	 * theme: locked Lapin system · genre: editorial-corporate · nav/footer: shared
	 * pre-emit critique: P5 H5 E5 S5 R5 V4
	 */

	/* Hero: the client's H1 runs long — hold it to three lines on desktop.
	   Size comes from --text-hero-page (v2.9), shared by every subpage. */
	.page-mediation .hero--page h1 { max-width: 21ch; }

	/* ── 1 · What mediation is (retained Split Studio voice) ───────────
	   Both paragraphs share the opening paragraph's size (client 2026-09-05). */
	.med-what .prose p { font-size: var(--text-md); line-height: 1.55; }
	.med-what .prose p:last-child { margin-bottom: 0; }

	/* ── 2 · How we help — six cards, two columns per the client brief ── */
	.med-help {
		list-style: none; margin: 0; padding: 0;
		display: grid; grid-template-columns: repeat(2, minmax(0, 1fr));
		gap: var(--space-xl);
	}
	@media (max-width: 63.9375rem) {
		.med-help { grid-template-columns: minmax(0, 1fr); gap: var(--space-lg); }
	}
	/* .card supplies the paper fill, hairline and hover lift; the rose top edge
	   is the only accent per card, keeping rose gold well inside the 5% budget. */
	.med-card {
		display: flex; flex-direction: column;
		padding: var(--space-xl);
		border-top: 3px solid var(--color-accent);
	}
	/* Same head rhythm as the negotiation stage cards (icon + hairline lead-out),
	   without their stage word — these six are parallel capabilities, not stages. */
	.med-card__top { display: flex; align-items: center; gap: var(--space-md); margin-bottom: var(--space-md); }
	.med-card__top svg {
		width: 1.625rem; height: 1.625rem; flex-shrink: 0;
		color: var(--color-accent); stroke-width: 1.4; opacity: 0.75;
	}
	.med-card__rule { flex: 1; height: 1px; background: var(--color-rule); }
	.med-card h3 {
		font-size: var(--text-md); line-height: 1.25; margin-bottom: var(--space-sm);
		overflow-wrap: anywhere; min-width: 0;
	}
	.med-card p { font-size: 0.9375rem; margin-bottom: 0; }

	/* ── 3 · Distinctions — three panels, mediation carried in cream ─── */
	.med-distinct {
		list-style: none; margin: 0; padding: 0;
		display: grid; grid-template-columns: repeat(3, minmax(0, 1fr));
		gap: var(--space-lg);
		/* The mediation panel carries three times the copy of the other two —
		   let each box take its own height rather than stretching two of them
		   into mostly-empty rectangles. */
		align-items: start;
	}
	@media (max-width: 63.9375rem) { .med-distinct { grid-template-columns: minmax(0, 1fr); } }
	.med-dist {
		border: 1px solid var(--color-rule);
		border-top: 3px solid var(--color-rule);
		border-radius: var(--radius-card);
		padding: var(--space-lg); min-width: 0;
	}
	.med-dist--this { background: var(--color-paper-2); border-top-color: var(--color-accent); }
	.med-dist p { margin-bottom: 0; color: var(--color-ink-2); line-height: 1.6; }
	.med-dist__term {
		display: block; margin-bottom: var(--space-2xs);
		font-family: var(--font-display); font-weight: 700;
		font-size: var(--text-md); line-height: 1.3;
		letter-spacing: var(--tracking-display); color: var(--color-ink);
		overflow-wrap: anywhere;
	}
	.med-dist--this .med-dist__term { color: var(--color-accent-strong); }
	/* The two sibling services link out; the rose underline sits on the term only. */
	a.med-dist__term { text-decoration: underline; text-decoration-color: var(--color-accent); text-underline-offset: 4px; }
	a.med-dist__term:hover { color: var(--color-accent-strong); }

	/* ── 4 · Who this is for — three-column bullet grid ──────────────── */
	.med-for {
		list-style: none; margin: 0; padding: 0;
		display: grid; grid-template-columns: repeat(3, minmax(0, 1fr));
		gap: var(--space-sm) var(--space-xl);
	}
	@media (max-width: 63.9375rem) { .med-for { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
	@media (max-width: 40rem) { .med-for { grid-template-columns: minmax(0, 1fr); } }
	/* Shared bullet voice — the site's small rose square mark. */
	.med-for li {
		position: relative; padding-left: 1.4rem; min-width: 0;
		color: var(--color-ink-2); font-size: var(--text-base); line-height: 1.6;
	}
	.med-for li::before {
		content: ""; position: absolute; left: 0; top: 0.62em;
		width: 0.375rem; height: 0.375rem; background: var(--color-accent);
	}

	/* ── 5 · Advisory services — one wide callout, icon at the shoulder ─ */
	.med-advisory {
		background: var(--color-paper-2);
		border: 1px solid var(--color-rule);
		border-top: 3px solid var(--color-accent);
		border-radius: var(--radius-card);
		padding: var(--space-xl);
		display: grid; grid-template-columns: auto minmax(0, 1fr);
		gap: var(--space-xl); align-items: start;
	}
	.med-advisory svg {
		width: 2.75rem; height: 2.75rem; flex-shrink: 0;
		color: var(--color-accent); stroke-width: 1.3; opacity: 0.7;
	}
	.med-advisory p {
		margin-bottom: 0; font-size: var(--text-md); line-height: 1.6;
		color: var(--color-ink-2);
	}
	@media (max-width: 47.9375rem) {
		.med-advisory { grid-template-columns: minmax(0, 1fr); gap: var(--space-md); padding: var(--space-lg); }
		.med-advisory svg { width: 2.25rem; height: 2.25rem; }
	}
</style>

<main id="main">

	<section class="sec med-what" id="mediation-what" aria-labelledby="med-what-title">
		<div class="wrap">
			<div class="split">
				<div>
					<div class="sec-head rv">
						<h2 id="med-what-title">What Mediation Is &mdash; And Why It Matters</h2>
					</div>
					<div class="prose">
						<p class="rv" style="--i:1">When communication breaks down and positions harden, mediation offers a <strong>neutral, structured environment</strong> where parties can move from impasse toward workable, durable agreements. It is a confidential, facilitated process designed to reduce conflict, clarify issues, and create forward movement without the adversarial dynamics of litigation or positional bargaining.</p>
						<p class="rv" style="--i:2">Our mediation services are built for individuals and organizations seeking a <strong>high-trust, professional process</strong> that balances structure with human nuance &mdash; and leads to agreements that hold up in practice, not just on paper.</p>
					</div>
				</div>
				<figure class="split__media" aria-hidden="true">
					<?php echo Lapin::icon( 'users-round' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</figure>
			</div>
		</div>
	</section>

	<section class="sec band--cream" id="mediation-how" aria-labelledby="med-how-title">
		<div class="wrap">
			<div class="sec-head rv">
				<h2 id="med-how-title">How We Help</h2>
			</div>
			<ul class="med-help" role="list">
				<?php foreach ( $lapin_help as $lapin_i => $lapin_item ) : ?>
				<li class="med-card card rv" style="--i:<?php echo esc_attr( $lapin_i % 2 ); ?>">
					<div class="med-card__top">
						<?php echo Lapin::icon( $lapin_item['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
						<span class="med-card__rule" aria-hidden="true"></span>
					</div>
					<h3><?php echo esc_html( $lapin_item['title'] ); ?></h3>
					<p><?php echo esc_html( $lapin_item['body'] ); ?></p>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<section class="sec" id="mediation-distinct" aria-labelledby="med-distinct-title">
		<div class="wrap">
			<div class="sec-head rv">
				<h2 id="med-distinct-title">What Makes This Distinct from Negotiation &amp; Dispute Resolution</h2>
			</div>
			<ul class="med-distinct" role="list">
				<?php foreach ( $lapin_distinct as $lapin_i => $lapin_item ) : ?>
				<li class="med-dist<?php echo $lapin_item['this'] ? ' med-dist--this' : ''; ?> rv" style="--i:<?php echo esc_attr( $lapin_i ); ?>">
					<?php if ( $lapin_item['link'] ) : ?>
					<a class="med-dist__term" href="<?php echo esc_url( home_url( '/' . $lapin_item['link'] ) ); ?>"><?php echo esc_html( $lapin_item['term'] ); ?></a>
					<?php else : ?>
					<span class="med-dist__term"><?php echo esc_html( $lapin_item['term'] ); ?></span>
					<?php endif; ?>
					<p><?php echo wp_kses_post( $lapin_item['body'] ); ?></p>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<section class="sec sec--tight" id="mediation-who" aria-labelledby="med-who-title">
		<div class="wrap">
			<div class="sec-head rv">
				<h2 id="med-who-title">Who This Is For</h2>
			</div>
			<ul class="med-for rv" style="--i:1" role="list">
				<?php foreach ( $lapin_for as $lapin_item ) : ?>
				<li><?php echo esc_html( $lapin_item ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<section class="sec sec--tight band--cream" id="mediation-outcome" aria-labelledby="med-outcome-title">
		<div class="wrap">
			<div class="sec-head rv">
				<h2 id="med-outcome-title">Outcome</h2>
			</div>
			<p class="lead rv" style="--i:1">A structured, neutral process that reduces conflict, restores clarity, and produces agreements that strengthen working relationships, lower future risk, and create a stable foundation for moving forward.</p>
		</div>
	</section>

	<section class="sec sec--tight" id="mediation-advisory" aria-labelledby="med-advisory-title">
		<div class="wrap">
			<div class="sec-head rv">
				<h2 id="med-advisory-title">Additional Advisory Services: Support During Third-Party Mediation</h2>
			</div>
			<div class="med-advisory rv" style="--i:1">
				<?php echo Lapin::icon( 'book-open' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				<p>For clients engaged in mediation conducted by an independent mediator, we offer an <strong>advisory service</strong> focused on preparation, strategy, and decision-making. This support is provided entirely <strong>outside</strong> the mediation process, ensuring the mediator&rsquo;s neutrality remains intact while you receive tailored guidance to navigate the process effectively.</p>
			</div>
		</div>
	</section>

	<?php // Page-specific CTA band in the shared onyx voice — the client's doc supplies no closing copy for this page (cf. /dispute-resolution/, design.md v2.10). ?>
	<section class="cta-band band" aria-labelledby="med-cta-title">
		<div class="wrap">
			<h2 id="med-cta-title" class="rv">Ready to bring a neutral process to the table?</h2>
			<p class="rv" style="--i:1">For a free, no-obligation consultation with a specialist:</p>
			<div class="cta-band__actions rv" style="--i:2">
				<a class="btn btn--gold" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Schedule a Consultation</a>
				<a class="btn btn--light" href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>">Call Now &mdash; <?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a>
			</div>
		</div>
	</section>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
