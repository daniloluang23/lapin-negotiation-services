<?php
/**
 * About Us (/overview/) — Long Document: continuous editorial prose with
 * inline section heads. All live-site anchors preserved (#the-firm,
 * #the-founder, #unlitigation, #media-appearances, #why-us,
 * #mission-vision, #clients). Copy retained verbatim.
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
	'hero'       => array(
		'title' => 'About Us',
		'lede'  => 'A leader in the field of negotiation and dispute resolution — building bridges, resolving differences.',
	),
);

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';

// Each entry anchors to its own card in the home media wall (id="media-<slug>").
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

?>
<style>
	.doc { max-width: none; }
	.doc .prose { max-width: none; }
	.doc .sec-head { margin-bottom: var(--space-lg); }
	.doc section { padding-block: var(--space-2xl) 0; }
	.doc section:first-child { padding-top: var(--space-3xl); }
	.doc-list { list-style: none; margin: 0 0 var(--space-md); padding: 0; }
	.doc-list li { position: relative; padding-left: 1.5rem; margin-bottom: var(--space-sm); color: var(--color-ink-2); }
	.doc-list li::before { content: ""; position: absolute; left: 0; top: 0.55em; width: 0.5rem; height: 0.5rem; background: var(--color-accent); }
	.founder-figure { float: right; width: min(45%, 23rem); margin: 0 0 var(--space-md) var(--space-xl); }
	.founder-figure img { width: 100%; height: auto; border-radius: var(--radius-card); }
	.founder-figure figcaption { font-size: var(--text-sm); color: var(--color-muted); margin-top: var(--space-xs); }
	@media (max-width: 40rem) { .founder-figure { float: none; width: min(70%, 18rem); margin: 0 0 var(--space-md); } }
	.media-list { list-style: none; margin: 0; padding: 0; max-width: none; }
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
	.clients { display: flex; flex-wrap: wrap; gap: var(--space-xl) var(--space-2xl); align-items: center; }
	.hq { display: grid; grid-template-columns: minmax(0, 7fr) minmax(0, 5fr); gap: var(--space-2xl); align-items: center; }
	@media (max-width: 59.9375rem) { .hq { grid-template-columns: minmax(0, 1fr); } }
</style>

<main id="main">
	<div class="wrap">
		<div class="doc">
			<section id="the-firm">
				<div class="sec-head">
					<h2>Introducing our firm</h2>
				</div>
				<div class="prose">
					<p>At Lapin Negotiation Services, we pride ourselves on being recognized as a leader in the field of negotiation and dispute resolution. We offer a variety of specialized services to help our clients including:</p>
					<ul class="doc-list">
						<li><strong>Negotiation consulting and support:</strong> We provide expert guidance and support to help you navigate complex negotiations and achieve the best possible outcome.</li>
						<li><strong>Negotiation training, facilitation, and coaching:</strong> Our experienced trainers and coaches can help you develop the skills and confidence you need to succeed in any negotiation situation.</li>
						<li><strong>Mediation and dispute resolution services:</strong> We offer a range of services to help resolve conflicts and disputes, including mediation and other forms of alternative dispute resolution.</li>
					</ul>
					<p>At Lapin Negotiation Services, we work with a wide range of clients, including individuals, families, businesses, professional groups, corporations, and government entities. Whether you are facing a challenging negotiation or a difficult dispute, we have the skills and experience to help you find a resolution. Contact us today to learn more about how we can help you.</p>
				</div>
			</section>

			<section id="the-founder">
				<div class="sec-head">
					<h2>The founder</h2>
				</div>
				<figure class="founder-figure">
					<img src="<?php echo esc_url( Lapin::asset( 'images/raphael-lapin.webp' ) ); ?>" alt="Raphael E. Lapin" width="399" height="559" loading="lazy">
					<figcaption>Raphael E. Lapin, Principal</figcaption>
				</figure>
				<div class="prose">
					<p>Raphael Lapin is a renowned Harvard-trained expert in the fields of negotiation, mediation, and dispute resolution. With over 25 years of experience, he has made significant contributions to the field by shifting away from traditional adversarial approaches and promoting a more authentic process of dialogue, understanding, and collaborative problem-solving. His approach has resulted in optimal agreements, strong working relationships, and mutually satisfying resolutions.</p>
					<p>In addition to his practice, Raphael has also made significant contributions to the education of future leaders in the field. He has served as an adjunct professor of law at Whittier School of Law, teaching negotiation and mediation to third-year law students, as well as a visiting professor of law at Southwestern School of Law, where he taught international conflict resolution.</p>
					<p>His expertise and knowledge have also been shared with the wider public through his published articles in several notable publications such as USA Today, Jerusalem Post, Ahram, Foreign Policy News, The International Crisis Group’s Ethiopia Insights and The Diplomatist. Raphael Lapin is a true leader and a valuable asset to the negotiation and dispute resolution community.</p>
				</div>
			</section>

			<section id="media-appearances">
				<div class="sec-head">
					<h2>Media appearances</h2>
				</div>
				<ul class="media-list">
					<?php foreach ( $lapin_media_list as $lapin_item ) : ?>
					<li><a href="<?php echo esc_url( $lapin_item[1] ); ?>"><?php echo esc_html( $lapin_item[0] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</section>

			<section id="why-us">
				<div class="sec-head">
					<h2>Why us?</h2>
				</div>
				<div class="prose">
					<h3>Negotiation</h3>
					<p>At Lapin Negotiation Services, we understand that negotiations can often be mistaken for a confrontational process of haggling and compromise. However, this approach can lead to suboptimal results and strained relationships. That’s why our team of negotiation process specialists is dedicated to helping you navigate a more authentic and collaborative approach to finding mutually beneficial solutions to conflicting needs.</p>
					<p>Our method is based on a deeper understanding of the true underlying interests, priorities, and values of all parties involved. By utilizing our services, you can expect to achieve efficient and profitable outcomes, solid agreements, and better deals overall.</p>
					<p>In addition to achieving successful outcomes, our negotiation process also helps to build strong, trusting relationships. Let us help you take your negotiations to the next level and achieve mutually beneficial results.</p>
					<h3>Dispute resolution</h3>
					<p>Disputes often involve more than just legal issues. They can also have emotional, psychological, historical, and cultural components that can’t be ignored.</p>
					<p>Our dispute resolution specialists are experts in addressing these underlying issues to achieve true resolution. They are skilled at facilitating productive dialogue, understanding different perspectives, and finding mutually acceptable solutions. By working with our team, you can be confident that all aspects of the dispute will be resolved, resulting in durable, compliant, and satisfying agreements and potentially restored relationships.</p>
					<p>We don’t just settle cases — we resolve disputes.</p>
				</div>
			</section>
		</div>
	</div>

	<section class="sec band" id="mission-vision">
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

	<section class="sec" id="clients">
		<div class="wrap">
			<div class="sec-head">
				<h2>Some of our clients</h2>
			</div>
			<div class="clients">
				<?php foreach ( $lapin_clients as $lapin_client ) : ?>
				<img src="<?php echo esc_url( Lapin::asset( 'images/' . $lapin_client[0] ) ); ?>" alt="<?php echo esc_attr( $lapin_client[1] ); ?>" width="150" height="70" loading="lazy">
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="sec sec--tight">
		<div class="wrap">
			<div class="hq">
				<div>
					<div class="sec-head">
						<h2>Our headquarters</h2>
					</div>
					<p class="prose"><?php echo esc_html( Lapin::address_line() ); ?> — <a href="<?php echo esc_url( Lapin::MAPS_URL ); ?>" rel="noopener" target="_blank">view on Google Maps</a>.</p>
				</div>
				<figure>
					<img src="<?php echo esc_url( Lapin::asset( 'images/headquarters.webp' ) ); ?>" alt="The Tower building at 10940 Wilshire Blvd, Los Angeles — Lapin Negotiation Services headquarters" width="518" height="642" loading="lazy" style="width: min(100%, 20rem); border-radius: var(--radius-card);">
				</figure>
			</div>
		</div>
	</section>

	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-cta-band.php'; ?>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
