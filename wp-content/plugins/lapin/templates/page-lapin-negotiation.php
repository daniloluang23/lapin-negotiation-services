<?php
/**
 * Negotiation — Split Studio: alternating text/image diptychs, one per
 * existing content section. Copy retained verbatim from the live site.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin = array(
	'title'      => 'Negotiation Services | Training, Advice & Representation | Lapin Negotiation Services',
	'desc'       => 'Negotiation training, advice, support and representation from Harvard-trained specialists. Proven programs for Fortune 100 companies and 25+ years representing clients. Free consultation.',
	'path'       => 'negotiation/',
	'nav'        => 'negotiation',
	'body_class' => 'page-negotiation',
	'hero'       => array(
		'eyebrow' => 'Services',
		'title'   => 'Negotiation Services',
		'cta'     => 'Free Consultation',
	),
	'schema'     => array(
		array(
			'@type'    => 'Service',
			'name'     => 'Negotiation Services',
			'provider' => array( '@id' => home_url( '/' ) . '#organization' ),
			'serviceType' => 'Negotiation training, advice, support and representation',
			'areaServed'  => 'Southern California',
		),
	),
);

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';
?>
<style>
	.svc-list { list-style: none; margin: 0 0 var(--space-md); padding: 0; }
	.svc-list li { position: relative; padding-left: 1.5rem; margin-bottom: var(--space-sm); color: var(--color-ink-2); }
	.svc-list li::before { content: ""; position: absolute; left: 0; top: 0.55em; width: 0.5rem; height: 0.5rem; background: var(--color-accent); }
	.sec + .sec { border-top: 1px solid var(--color-rule); }
</style>

<main id="main">
	<section class="sec" id="negotiation-why-a-specialist">
		<div class="wrap">
			<div class="split">
				<div>
					<div class="sec-head">
						<h2>Why a negotiation specialist?</h2>
					</div>
					<div class="prose">
						<p class="lead">Are you tired of negotiations turning into stressful, adversarial haggling, leading to frustrating compromises and suboptimal outcomes?</p>
						<p>If so, our negotiation services may be the right solution for you. Our team of experienced specialists can help you develop the skills, strategies, and techniques needed to become a more effective and confident negotiator.</p>
						<p>Through our training, consulting, or representation services, our negotiation specialists will guide you through a collaborative process to find mutually beneficial solutions that meet everyone’s needs. Our approach is based on understanding the underlying interests, priorities, and values of all parties involved.</p>
						<p>By following this approach, you can achieve more efficient and profitable outcomes, secure solid contracts, and make better deals. Plus, the negotiation process itself will help you build strong, trusting relationships with your counterparts.</p>
						<p>Don’t let negotiations become a source of stress and frustration — let our specialists help you achieve your goals.</p>
					</div>
				</div>
				<figure class="split__media" aria-hidden="true">
					<?php echo Lapin::icon( 'handshake' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</figure>
			</div>
		</div>
	</section>

	<section class="sec" id="negotiation-advice">
		<div class="wrap">
			<div class="split split--flip">
				<figure class="split__media" aria-hidden="true">
					<?php echo Lapin::icon( 'messages-square' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</figure>
				<div>
					<div class="sec-head">
						<h2>Negotiation advice &amp; support</h2>
					</div>
					<div class="prose">
						<p class="lead">Are you struggling to negotiate a salary increase, close a business deal, or resolve a conflict?</p>
						<p>You don’t have to navigate these tricky negotiations alone and risk being taken advantage of.</p>
						<p>Our team of experienced professionals is here to help and support you every step of the way, from preparation through to post-negotiation and implementation. With their deep understanding of the negotiation process, our consultants can provide expert guidance, coaching, and behind-the-scenes advice to help you achieve the best possible outcomes efficiently.</p>
						<p>Don’t miss out on this opportunity to achieve your negotiation objectives. Contact us today to schedule a free consultation and learn more about our negotiation consulting services. Let us help you get the results you deserve.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="sec" id="negotiation-representing">
		<div class="wrap">
			<div class="split">
				<div>
					<div class="sec-head">
						<h2>Negotiation representation</h2>
					</div>
					<div class="prose">
						<p class="lead">Are you faced with a negotiation that is critical to your business or personal goals? Or a particularly complex negotiation? Or one which may be beyond your experience level?</p>
						<p>You don’t have to go it alone. Our team of expert agents has over 25 years of experience representing clients in negotiations, and we’ve helped secure better deals and increased profits for numerous clients.</p>
						<p>For example, in a recent real estate deal, we were able to negotiate a 20 percent discount for our client by leveraging our expertise and reputation as skilled negotiators. In other cases, we’ve helped clients navigate complex contract negotiations and achieve sustainable, profitable results.</p>
						<p>But hiring an agent isn’t just about getting the best deal possible. An experienced agent can also bring objectivity to the negotiation process and act as a representative for your interests. Without the expertise and objectivity of an agent, you may be at a disadvantage and miss out on opportunities to secure a better deal.</p>
					</div>
				</div>
				<figure class="split__media" aria-hidden="true">
					<?php echo Lapin::icon( 'user-round-check' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</figure>
			</div>
		</div>
	</section>

	<section class="sec" id="negotiation-training">
		<div class="wrap">
			<div class="split split--flip">
				<figure class="split__media" aria-hidden="true">
					<?php echo Lapin::icon( 'briefcase-business' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</figure>
				<div>
					<div class="sec-head">
						<h2>Negotiation training</h2>
					</div>
					<div class="prose">
						<p class="lead">Are you looking to improve your negotiation and communication skills, achieve better outcomes, project confidence, and build stronger relationships?</p>
						<p>Our negotiation training services can help you do all that and more. Our specialists have a proven track record of delivering highly effective, transformative programs to Fortune 100 companies, resulting in measurable and considerable results that further our clients’ business objectives and generate swift returns on training investment.</p>
						<p>Our training programs are tailored to meet your specific goals and needs, and can be delivered one-on-one, in teams, or to larger groups. They are designed to be practical and hands-on, and will provide you with the opportunity to practice and hone your skills through role-playing and other interactive exercises. Some of the benefits of our negotiation training services include:</p>
						<ul class="svc-list">
							<li><strong>Customized training:</strong> We’ll work with you to understand your specific needs and design a program that meets those needs. This may include in-person training sessions, online coursework, or a combination of both.</li>
							<li><strong>Practical experience:</strong> Our training programs are designed to be practical and hands-on, giving you the opportunity to apply your new skills in realistic scenarios.</li>
							<li><strong>Measurable results:</strong> Our programs have a proven track record of delivering measurable and considerable results that further our clients’ business objectives and generate swift returns on training investment.</li>
						</ul>
						<p>Don’t let your negotiation and communication skills hold you back — let us help you take your career to the next level. Contact us today to schedule a free consultation and learn more about how we can help you.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-cta-band.php'; ?>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
