<?php
// Setup an image
$w = 300;
$h = 150;
$im = imagecreatetruecolor($w, $h);

$p = 0;

if (isset($_GET['p'])) {
	$p = $_GET['p'];
}

$m = 148 * $p / 100;
$m = 148 - $m;
$m = $m / 2;

// Set a background
imagefilledrectangle($im, 0, 0, $w, $h, imagecolorallocate($im, 246, 246, 246));

// Apply the overlay alpha blending flag
imagelayereffect($im, IMG_EFFECT_ALPHABLEND);

// Draw two grey ellipses
imagefilledellipse($im, $w / 2 + $m, $h / 2, 148, 148, imagecolorallocatealpha($im, 0, 255, 255, 50));
imagefilledellipse($im, $w / 2 - $m, $h / 2, 148, 148, imagecolorallocatealpha($im, 255, 255, 0, 50));

if(true) {
	
for( $x = 0; $x < $w; $x++ ){ 
	for( $y = 0; $y < $h; $y++ ) {
		$colorxy = imagecolorat($im, $x, $y);
		$red = ( $colorxy >> 0 ) & 0xFF;
		$green = ( $colorxy >> 8 ) & 0xFF;
		$blue = ( $colorxy >> 16 ) & 0xFF;
		if($green > 246 && $red < 246 && $blue < 246){
			imagesetpixel($im, $x, $y, imagecolorallocate($im, 0, 255, 0));
		} else if($red < 246) {
			imagesetpixel($im, $x, $y, imagecolorallocate($im, 0, 255, 255));
		} else if($blue < 246) {
			imagesetpixel($im, $x, $y, imagecolorallocate($im, 255, 255, 0));
		}
	}
}

}
imagefilter($im, IMG_FILTER_SMOOTH, 80);

// Output
header('Content-type: image/png');

imagepng($im);
imagedestroy($im);