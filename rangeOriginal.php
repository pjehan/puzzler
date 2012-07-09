<?php
	$img = imagecreatefrompng ( 'Puzzle2.png' );
	
	$r = 0;
	$v = 0;
	$b = 0;
	
	$plus = 28;
	
	$i = 1;
	$tab = null;
	
	for($Xa = 0; $Xa < 1400; $Xa+=$plus) // Hauteur (40 fois)
	{
		for($Ya = 0; $Ya < 1120; $Ya+=$plus) // Largeur (50 fois)
		{
			for($y = 0; $y < 28; $y++)
			{
				for($x = 0; $x < 28; $x++)
				{
					$xOk = $x + $Xa;
					$yOk = $y + $Ya;
					//echo 'X : '.$xOk.' - Y : '.$yOk.'<br />';
					$rgb = imagecolorat($img, $xOk, $yOk);
					$colors = imagecolorsforindex($img, $rgb);
					
					$r += $colors['red'];
					$v += $colors['green'];
					$b += $colors['blue'];
				}
			}
			
			//echo $r.' - '.$v.' - '.$b.'<br />';
			//echo 'RESULTAT pour X : '.$Xa.' - Y : '.$Ya.' --> '.($r+$v+$b).'<br />';
			$tab[$Ya][$Xa] = $r+$v+$b;
			$r = 0;
			$v = 0;
			$b = 0;
			$i++;
		}
	}
	
	ksort($tab);
	
	$return = "<?php $tab = array(";
	
	foreach($tab as $y => $values) {
		$return .= 'array(';
		
		foreach($values as $x => $val) {
			$return .= $val.',';
		}
		$return .= '),';
	}
	
	$return .= "); ?>";
	
	$fp = fopen('data.php', 'w');
	fwrite($fp, $return);
	fclose($fp);
?>