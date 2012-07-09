<html>
	<head>
		<style>
			body{
				background-color: #FFF;
				color: #000;
			}
			.p{
				float:left;
				height: 28px;
				width: 28px;
				background-color: #000;
				border: 1px solid #F00;
				
			}
			
			.clear {
				clear:both;
			}
			
			span{
				margin-left: 40px;
				color: #000;
			}
		</style>
	</head>
	<body>
<?php
	require_once 'data.php';
	foreach($tab as $y => $values) {
		foreach($values as $x => $value) {
			//echo 'Y : '.$y.' - X : '.$x.' - VAL : '.$value.'<br />';
			
			
			list($width, $height) = getimagesize('hautD.png');
	$img = imagecreatefrompng ('hautD.png');
	
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
	
	//echo $r.' - '.$v.' - '.$b.'<br />';
	//echo $r+$v+$b;
	$val = $r+$v+$b;

	$html = '';
	foreach($tab as $y => $values)
	{
		$html .= '<div class="clear"><span>Y : '.(($y/28)+1).'</span>';
		foreach($values as $x => $value)
		{
			$percent = $val/$value;
			if($percent > 1)
				$percent = $percent-1;
			if($percent < 0)
				$percent = $percent+1;
				
			if($percent > 1)
				$percent = '0';
			
			$style = '';
			if($percent > 0.98) {
				$style .= 'opacity:1;background-color:#F00;';
			}
			elseif($percent > 0.96) {
				$style .= 'opacity:0.8;background-color:#F00;';
			}
			elseif($percent > 0.94) {
				$style .= 'opacity:0.6;background-color:#F00;';
			}
			elseif($percent > 0.92) {
				$style .= 'opacity:0.4;background-color:#F00;';
			}
			elseif($percent > 0.9) {
				$style .= 'opacity:0.2;background-color:#F00;';
			}
			elseif($percent > 0.8) {
				$style .= 'opacity:0.6;';
			}
			elseif($percent > 0.7) {
				$style .= 'opacity:0.4;';
			}
			elseif($percent > 0.6) {
				$style .= 'opacity:0.2;';
			}
			elseif($percent > 0.5) {
				$style .= 'opacity:0;';
			}
				
			$html .= '<div percent="'.$percent.'" value="'.$value.'" val="'.$val.'" class="p" style="'.$style.'">'.(($x/28)+1).'</div>';
		}
		$html .= '</div>';
	}
	
	echo $html;
	
		}	
	}
	
	
?>
	</body>
</html>