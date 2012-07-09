<?php
	$origin = imagecreatefrompng ( 'BnW/basG_origin.png' );
	$new = imagecreatefrompng ( 'BnW/basG_new.png' );
	
	$rOrigin = 0;
	$vOrigin = 0;
	$bOrigin = 0;
	$rNew = 0;
	$vNew = 0;
	$bNew = 0;
	
	for($x = 0; $x < 27; $x++) {
		for($y = 0; $y < 27; $y++) {
			$rgbOrigin = imagecolorat($origin, $x, $y);
			$colorsOrigin = imagecolorsforindex($origin, $rgbOrigin);
			
			$rOrigin += $colorsOrigin['red'];
			$vOrigin += $colorsOrigin['green'];
			$bOrigin += $colorsOrigin['blue'];
		}	
	}
	
	for($x = 0; $x < 27; $x++) {
		for($y = 0; $y < 27; $y++) {
			$rgbNew = imagecolorat($new, $x, $y);
			$colorsNew = imagecolorsforindex($new, $rgbNew);

			$rNew += $colorsNew['red'];
			$vNew += $colorsNew['green'];
			$bNew += $colorsNew['blue'];
		}	
	}
	
	echo $rOrigin.'-'.$vOrigin.'-'.$bOrigin.'........'.$rNew.'-'.$vNew.'-'.$bNew;
?>