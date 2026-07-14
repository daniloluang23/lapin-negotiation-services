<?php
/**
 * Rebuild the Lapin logo in the brand palette from the official 1980x700
 * light-variant art (exact geometry, new colors). Kept in tasks/tools so
 * future color tweaks are a one-line edit + re-run.
 *
 * Run with Local's bundled PHP (GD must be loaded explicitly):
 *   php.exe -d extension_dir=<php>\ext -d extension=gd logo-gen.php
 *
 * Source groups (light PNG): near-white pixels = dark mark pieces + LAPIN +
 * sub-lettering; slate #6699AA-ish = light mark pieces + rule. Zones split
 * the groups: mark (x<680) / wordmark (y<500) / subtext (y>=500).
 *
 * Current client-approved colorways (2026-07-14, final):
 *   logo-on-dark (header) — soft gold pieces + LAPIN + subtext, deep russet pieces
 *   logo-footer (footer) — soft gold pieces + LAPIN + subtext, rose gold pieces
 *   logo-on-light (OG/schema/light surfaces only) — approved option-1:
 *     onyx pieces + LAPIN, rose gold pieces, silver rule + subtext
 */

$src_file = __DIR__ . '/logo-source-light.png';
$out_dir  = 'C:/Users/User/Local Sites/lapin-negotiation-services/app/public/wp-content/plugins/lapin/assets/images';

const MARK_TEXT_X = 680; // left of this = mark, right = wordmark/rule/subtext

// palette
$onyx      = array( 0x49, 0x49, 0x4B );
$rose      = array( 0xBD, 0x8C, 0x7D );
$soft      = array( 0xD1, 0xBF, 0xA7 );
$silver    = array( 0x8E, 0x8E, 0x90 );
$cream     = array( 0xF3, 0xEC, 0xE1 );
$russet    = array( 0x76, 0x42, 0x36 ); // client-picked deep russet (replaces the grey)

$variants = array(
	'logo-on-light' => array(
		// OG/schema/light surfaces — approved option-1 colorway.
		// group => [ mark-color, wordmark-color, subtext-color ]
		'white' => array( $onyx, $onyx, $silver ),   // dark pieces + LAPIN → onyx; subtext silver
		'slate' => array( $rose, $silver, $silver ), // light pieces; rule silver
	),
	'logo-on-dark' => array(
		// Header — soft gold + deep russet per client.
		'white' => array( $soft, $soft, $soft ),   // dark pieces + LAPIN + subtext → soft gold
		'slate' => array( $russet, $soft, $soft ), // light pieces → deep russet; rule → soft gold
	),
	'logo-footer' => array(
		// Footer — soft gold + rose gold per client.
		'white' => array( $soft, $soft, $soft ), // dark pieces + LAPIN + subtext → soft gold
		'slate' => array( $rose, $soft, $soft ), // light pieces → rose gold; rule → soft gold
	),
);

$src = imagecreatefrompng( $src_file );
imagepalettetotruecolor( $src );
$w = imagesx( $src );
$h = imagesy( $src );

foreach ( $variants as $name => $map ) {
	$dst = imagecreatetruecolor( $w, $h );
	imagesavealpha( $dst, true );
	imagealphablending( $dst, false );
	$transparent = imagecolorallocatealpha( $dst, 0, 0, 0, 127 );
	imagefill( $dst, 0, 0, $transparent );

	for ( $y = 0; $y < $h; $y++ ) {
		for ( $x = 0; $x < $w; $x++ ) {
			$c = imagecolorat( $src, $x, $y );
			$a = ( $c >> 24 ) & 0x7F;
			if ( $a >= 127 ) { continue; }
			$r = ( $c >> 16 ) & 0xFF;
			$group = $r > 200 ? 'white' : 'slate';
			$zone  = $x < MARK_TEXT_X ? 0 : ( $y < 500 ? 1 : 2 ); // mark | wordmark | subtext
			$rgb   = $map[ $group ][ $zone ];
			imagesetpixel( $dst, $x, $y, imagecolorallocatealpha( $dst, $rgb[0], $rgb[1], $rgb[2], $a ) );
		}
	}

	// Full-size PNG master (for og/schema use) + 520px display webp (2x of ~260px)
	imagepng( $dst, "$out_dir/$name.png", 9 );

	$dw = 520; $dh = (int) round( $h * $dw / $w );
	$small = imagecreatetruecolor( $dw, $dh );
	imagesavealpha( $small, true );
	imagealphablending( $small, false );
	imagefill( $small, 0, 0, imagecolorallocatealpha( $small, 0, 0, 0, 127 ) );
	imagecopyresampled( $small, $dst, 0, 0, 0, 0, $dw, $dh, $w, $h );
	imagewebp( $small, "$out_dir/$name.webp", 90 );

	echo "$name: {$w}x{$h} png + {$dw}x{$dh} webp written\n";
	imagedestroy( $dst );
	imagedestroy( $small );
}
