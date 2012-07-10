<?php
class transformOriginal {
	var $_img;
	var $_nbPiece;
	
	function __construct( $pImg, $pNbPiece ) {
		$this->_img 	= $pImg;
		$this->_nbPiece = $pNbPiece;
    }
    
    function perform() {
    	if( is_file( $this->_img ) ) {
			if( is_numeric( $this->_nbPiece ) && $this->_nbPiece > 0 ) {
				// Initialize var
				$img 					= imagecreatefrompng ( $this->_img );
				list($width, $height) 	= getimagesize( $this->_img ); 
				$split 					= sqrt( $width * $height / $this->_nbPiece );
				$colorsRatio 			= 0;
				$tab 					= null;
	
				for( $Xa = 0; $Xa < $width; $Xa += $split )
				{
					for( $Ya = 0; $Ya < $height; $Ya += $split )
					{
						for( $y = 0; $y < $split; $y++ )
						{
							for( $x = 0; $x < $split; $x++ )
							{
								$xOk = $x + $Xa;
								$yOk = $y + $Ya;

								$rgb = imagecolorat( $img, $xOk, $yOk );
								$colors = imagecolorsforindex( $img, $rgb );
								
								$colorsRatio += $colors['red'] + $colors['green'] + $colors['blue'];
							}
						}

						$tab[$Ya][$Xa] = $colorsRatio;
						$colorsRatio = 0;
					}
				}
				
				ksort($tab);
				
				$return = "<?php \$tab = array(";
	
				foreach($tab as $y => $values) {
					$return .= 'array(';
					
					foreach($values as $x => $val) {
						$return .= $val.',';
					}
					$return = rtrim($return, ",");
					$return .= '),';
				}
				
				$return = rtrim($return, ",");
				$return .= "); ?>";
				
				$fp = fopen('data.php', 'w');
				fwrite($fp, $return);
				fclose($fp);
				
				return $split . '|Original image was parse fine - Go to Step 2.';
			}
			else
				return 'Piece number is not numeric';
		}
		else
			return 'Image can not be opened !';
    }
    
    function __destruct() {

    }
}
?>