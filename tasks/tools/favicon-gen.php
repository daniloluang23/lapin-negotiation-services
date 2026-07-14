<?php
/**
 * Regenerate favicons from the recolored brand mark.
 *
 * Crops the mark (x < 680) out of the generated logo-on-light.png (onyx +
 * rose option-1 colorway — reads best on light browser tabs), squares the
 * canvas, and writes the three favicon sizes the head partial references.
 *
 * Run with Local's bundled PHP (GD loaded explicitly):
 *   php.exe -d extension_dir=<php>\ext -d extension=gd favicon-gen.php
 */

$images  = 'C:/Users/User/Local Sites/lapin-negotiation-services/app/public/wp-content/plugins/lapin/assets/images';
$favdir  = 'C:/Users/User/Local Sites/lapin-negotiation-services/app/public/wp-content/plugins/lapin/assets/favicon';

$src = imagecreatefrompng( "$images/logo-on-light.png" );
imagepalettetotruecolor( $src );
$w = imagesx( $src ); $h = imagesy( $src );

// Bounding box of opaque pixels in the mark zone (x < 680).
$minx = $w; $miny = $h; $maxx = 0; $maxy = 0;
for ( $y = 0; $y < $h; $y += 2 ) {
	for ( $x = 0; $x < 680; $x += 2 ) {
		$a = ( imagecolorat( $src, $x, $y ) >> 24 ) & 0x7F;
		if ( $a < 100 ) {
			if ( $x < $minx ) { $minx = $x; }
			if ( $x > $maxx ) { $maxx = $x; }
			if ( $y < $miny ) { $miny = $y; }
			if ( $y > $maxy ) { $maxy = $y; }
		}
	}
}
$bw = $maxx - $minx + 1;
$bh = $maxy - $miny + 1;
echo "mark bbox: x $minx-$maxx, y $miny-$maxy ({$bw}x{$bh})\n";

// Square transparent canvas with 4% padding, mark centered.
$side = (int) round( max( $bw, $bh ) * 1.08 );
$sq   = imagecreatetruecolor( $side, $side );
imagesavealpha( $sq, true );
imagealphablending( $sq, false );
imagefill( $sq, 0, 0, imagecolorallocatealpha( $sq, 0, 0, 0, 127 ) );
imagecopy( $sq, $src, (int) ( ( $side - $bw ) / 2 ), (int) ( ( $side - $bh ) / 2 ), $minx, $miny, $bw, $bh );

foreach ( array( 32, 192, 270 ) as $size ) {
	$ico = imagecreatetruecolor( $size, $size );
	imagesavealpha( $ico, true );
	imagealphablending( $ico, false );
	imagefill( $ico, 0, 0, imagecolorallocatealpha( $ico, 0, 0, 0, 127 ) );
	imagecopyresampled( $ico, $sq, 0, 0, 0, 0, $size, $size, $side, $side );
	imagepng( $ico, "$favdir/favicon-$size.png", 9 );
	echo "favicon-$size.png written (" . filesize( "$favdir/favicon-$size.png" ) . "B)\n";
	imagedestroy( $ico );
}
