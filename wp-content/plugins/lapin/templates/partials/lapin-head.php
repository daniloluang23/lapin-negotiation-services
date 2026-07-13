<?php
/**
 * Shared document head: doctype through <body>.
 *
 * Each template defines a $lapin array before requiring this partial:
 *   title       string  — <title> + og:title
 *   desc        string  — meta description + og:description
 *   path        string  — canonical path relative to home ('' | 'overview/' …)
 *   nav         string  — key of the current nav item (home|overview|practice-areas|negotiation|dispute-resolution|mediation|contact)
 *   body_class  string
 *   og_image    string  — absolute URL (defaults to the hero painting JPEG)
 *   preload     array   — extra <link rel=preload> attr maps
 *   schema      array   — extra JSON-LD nodes merged into the @graph
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lapin_home     = home_url( '/' );
$lapin_url      = $lapin_home . ( $lapin['path'] ?? '' );
$lapin_og_image = $lapin['og_image'] ?? Lapin::asset( 'images/hero-painting.jpg' );

// Title is emitted here; Lapin_Pages removed WP's own title/canonical/robots.
add_filter( 'pre_get_document_title', static fn() => $lapin['title'] );

$lapin_graph = array(
	array(
		'@type'      => 'ProfessionalService',
		'@id'        => $lapin_home . '#organization',
		'name'       => Lapin::NAME,
		'slogan'     => Lapin::TAGLINE,
		'url'        => $lapin_home,
		'logo'       => Lapin::asset( 'images/logo-dark.png' ),
		'image'      => Lapin::asset( 'images/hero-painting.jpg' ),
		'telephone'  => Lapin::PHONE_LOCAL_TEL,
		'email'      => Lapin::EMAIL,
		'areaServed' => 'Southern California',
		'address'    => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => Lapin::ADDR_NAME . ', ' . Lapin::ADDR_STREET,
			'addressLocality' => Lapin::ADDR_CITY,
			'addressRegion'   => Lapin::ADDR_STATE,
			'postalCode'      => Lapin::ADDR_ZIP,
			'addressCountry'  => 'US',
		),
		'founder'    => array(
			'@type'       => 'Person',
			'name'        => 'Raphael E. Lapin',
			'jobTitle'    => 'Principal',
			'description' => 'Harvard-trained expert in negotiation, dispute resolution and mediation.',
		),
		'sameAs'     => array( Lapin::LINKEDIN, Lapin::FACEBOOK, Lapin::YOUTUBE ),
	),
	array(
		'@type'       => 'WebPage',
		'@id'         => $lapin_url . '#webpage',
		'url'         => $lapin_url,
		'name'        => $lapin['title'],
		'description' => $lapin['desc'],
		'isPartOf'    => array( '@id' => $lapin_home . '#organization' ),
	),
);
if ( '' !== ( $lapin['path'] ?? '' ) ) {
	$lapin_graph[] = array(
		'@type'           => 'BreadcrumbList',
		'itemListElement' => array(
			array( '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $lapin_home ),
			array( '@type' => 'ListItem', 'position' => 2, 'name' => $lapin['title'], 'item' => $lapin_url ),
		),
	);
}
foreach ( ( $lapin['schema'] ?? array() ) as $lapin_node ) {
	$lapin_graph[] = $lapin_node;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<title><?php echo esc_html( $lapin['title'] ); ?></title>
	<meta name="description" content="<?php echo esc_attr( $lapin['desc'] ); ?>">
	<meta name="robots" content="index, follow, max-image-preview:large">
	<meta name="theme-color" content="#023047">
	<link rel="canonical" href="<?php echo esc_url( $lapin_url ); ?>">
	<link rel="icon" href="<?php echo esc_url( Lapin::asset( 'favicon/favicon-32.png' ) ); ?>" sizes="32x32">
	<link rel="icon" href="<?php echo esc_url( Lapin::asset( 'favicon/favicon-192.png' ) ); ?>" sizes="192x192">
	<link rel="apple-touch-icon" href="<?php echo esc_url( Lapin::asset( 'favicon/favicon-192.png' ) ); ?>">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="<?php echo esc_attr( Lapin::NAME ); ?>">
	<meta property="og:title" content="<?php echo esc_attr( $lapin['title'] ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $lapin['desc'] ); ?>">
	<meta property="og:url" content="<?php echo esc_url( $lapin_url ); ?>">
	<meta property="og:image" content="<?php echo esc_url( $lapin_og_image ); ?>">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php echo esc_attr( $lapin['title'] ); ?>">
	<meta name="twitter:description" content="<?php echo esc_attr( $lapin['desc'] ); ?>">
	<meta name="twitter:image" content="<?php echo esc_url( $lapin_og_image ); ?>">
	<script type="application/ld+json"><?php echo wp_json_encode( array( '@context' => 'https://schema.org', '@graph' => $lapin_graph ), JSON_UNESCAPED_SLASHES ); ?></script>
	<?php foreach ( ( $lapin['preload'] ?? array() ) as $lapin_preload ) : ?>
	<link rel="preload"<?php foreach ( $lapin_preload as $lapin_attr => $lapin_val ) { printf( ' %s="%s"', esc_attr( $lapin_attr ), esc_attr( $lapin_val ) ); } ?>>
	<?php endforeach; ?>
	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-font.php'; ?>
	<?php require LAPIN_PLUGIN_DIR . 'templates/partials/lapin-tokens.php'; ?>
	<?php wp_head(); ?>
</head>
<body class="<?php echo esc_attr( $lapin['body_class'] ?? '' ); ?>">
