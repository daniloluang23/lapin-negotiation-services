<?php
/**
 * Disclaimer (/disclaimer/) — Long Document. Clarifies that the site is
 * informational, is not legal advice, and that contacting us does not create an
 * attorney-client or other professional relationship — a sensible liability
 * shield for a negotiation/mediation practice. Business facts from the Lapin
 * class. Review by counsel recommended before launch.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin = array(
	'title'      => 'Disclaimer | Lapin Negotiation Services',
	'desc'       => 'Important notice about the informational nature of this website and the services offered by Lapin Negotiation Services.',
	'path'       => 'disclaimer/',
	'nav'        => '',
	'body_class' => 'page-legal',
	'hero'       => array(
		'eyebrow' => 'Legal',
		'title'   => 'Disclaimer',
		'lede'    => 'Please read this notice about the information on this site.',
	),
);

require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-head.php';
require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-header.php';
?>
<style>
	.legal section { padding-block: var(--space-2xl) 0; scroll-margin-top: 6rem; }
	.legal section:first-child { padding-top: var(--space-3xl); }
	.legal .legal-meta { color: var(--color-muted); font-size: var(--text-sm); margin-bottom: 0; }
	.legal h2 { font-size: var(--text-xl); margin-bottom: var(--space-sm); }
	.legal p, .legal li { color: var(--color-ink-2); }
	.legal ul { padding-left: 1.25rem; margin: 0 0 var(--space-md); }
	.legal li { margin-bottom: var(--space-xs); }
	.legal a { text-decoration: underline; text-underline-offset: 2px; text-decoration-color: var(--color-accent); }
</style>

<main id="main">
	<div class="wrap wrap--narrow">
		<div class="legal prose">
			<section>
				<p class="legal-meta">Last updated: July 22, 2026</p>
				<p>The information on <?php echo esc_html( wp_parse_url( home_url(), PHP_URL_HOST ) ); ?> is provided by <?php echo esc_html( Lapin::NAME ); ?> for general informational and educational purposes only. By using this site, you acknowledge and agree to the terms of this Disclaimer.</p>
			</section>

			<section id="not-legal-advice">
				<h2>Not legal advice</h2>
				<p>Nothing on this website constitutes legal advice or a legal opinion, and it should not be relied upon as such. <?php echo esc_html( Lapin::NAME ); ?> provides negotiation, dispute resolution, and mediation services; it does not practice law or provide legal representation. For advice about your specific situation, consult a licensed attorney in your jurisdiction.</p>
			</section>

			<section id="no-relationship">
				<h2>No professional relationship</h2>
				<p>Viewing this site, contacting us, or sending us information does not create an attorney-client, mediator-client, or other professional relationship. A professional relationship is formed only through a signed written engagement agreement. Please do not send confidential or time-sensitive information through this website or by email until such an engagement is in place.</p>
			</section>

			<section id="no-guarantee">
				<h2>No guarantee of outcome</h2>
				<p>Negotiation and dispute resolution outcomes depend on facts and circumstances unique to each matter. Any references to prior engagements, experience, or results do not guarantee or predict a similar outcome in your matter.</p>
			</section>

			<section id="accuracy">
				<h2>Accuracy and completeness</h2>
				<p>We strive to keep the information on this site accurate and current, but we make no representations or warranties, express or implied, about its completeness, accuracy, reliability, or availability. Any reliance you place on this information is strictly at your own risk.</p>
			</section>

			<section id="external-links">
				<h2>External links</h2>
				<p>This site may contain links to third-party websites and media that are not controlled by us. We are not responsible for the content, accuracy, or practices of those sites, and a link does not imply endorsement.</p>
			</section>

			<section id="contact">
				<h2>Questions</h2>
				<p>If you have any questions about this Disclaimer, contact us at <a href="mailto:<?php echo esc_attr( Lapin::EMAIL ); ?>"><?php echo esc_html( Lapin::EMAIL ); ?></a> or <a href="tel:<?php echo esc_attr( Lapin::PHONE_LOCAL_TEL ); ?>"><?php echo esc_html( Lapin::PHONE_LOCAL ); ?></a>.</p>
			</section>
		</div>
	</div>

	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-cta-band.php'; ?>
</main>

<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-footer.php'; ?>
