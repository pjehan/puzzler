<?php
	list($width, $height) = getimagesize('basD.png');
	$img = imagecreatefrompng ('basD.png');
	
	$r = 0;
	$v = 0;
	$b = 0;
	
	for($y = 0; $y < $height; $y++)
	{
		for($x = 0; $x < $width; $x++)
		{
			$rgb = imagecolorat($img, $x, $y);
			$colors = imagecolorsforindex($img, $rgb);

			//echo ' - '.$colors['red'].':'.$colors['green'].':'.$colors['blue'].'<br />';
			
			if($colors['alpha'] == 0)
			{
				$r += $colors['red'];
				$v += $colors['green'];
				$b += $colors['blue'];	
			}
		}
	}
	
	echo $r.' - '.$v.' - '.$b.'<br />';
	echo $r+$v+$b;
?>