<?php
class transformScan {
	var $_img;
	var $_split;
	
	function __construct( $pImg, $pSplit ) {
		$this->_img 	= $pImg;
		$this->_split 	= $pSplit;
    }
    
    function perform() {
    	if( is_file( $this->_img ) ) {
    		if( is_numeric( $this->_split ) && $this->_split > 0 ) {
    			if( is_file( 'data.php' ) ) {
    				require_once 'data.php';
	    			// Initialize var
					$img 						= imagecreatefrompng ( $this->_img );
					list( $width, $height ) 	= getimagesize( $this->_img );
					$colorsRatio 				= 0;
					
					for( $y = 0; $y < $height; $y++ )
					{
						for( $x = 0; $x < $width; $x++ )
						{
							$rgb 	= imagecolorat( $img, $x, $y );
							$colors = imagecolorsforindex( $img, $rgb );
				
							if( $colors['alpha'] == 0 )
								$colorsRatio += $colors['red'] + $colors['green'] + $colors['blue'];
						}
					}
					
					$html = '';
					foreach( $tab as $y => $values )
					{
						foreach( $values as $x => $value )
						{
							$percent = $colorsRatio/$value;
							if( $percent > 1 )
								$percent = $percent - 1;
							if( $percent < 0 )
								$percent = $percent + 1;
								
							if( $percent > 1 )
								$percent = '0';
							
							$style = '';
							if( $percent > 0.98 )
								$style .= 'opacity:1;background-color:#F00;';
							elseif( $percent > 0.96 )
								$style .= 'opacity:0.8;background-color:#F00;';
							elseif( $percent > 0.94 )
								$style .= 'opacity:0.6;background-color:#F00;';
							elseif( $percent > 0.92 )
								$style .= 'opacity:0.4;background-color:#F00;';
							elseif( $percent > 0.9 )
								$style .= 'opacity:0.2;background-color:#F00;';
							elseif( $percent > 0.8 )
								$style .= 'opacity:0.6;';
							elseif( $percent > 0.7 )
								$style .= 'opacity:0.4;';
							elseif( $percent > 0.6 )
								$style .= 'opacity:0.2;';
							elseif( $percent > 0.5 )
								$style .= 'opacity:0;';
								
							$html .= '<div percent="' . $percent . '" value="' . $value . '" val="' . $colorsRatio . '" class="p" style="' . $style . '"></div>';
						}
						$html .= '</div>';
					}
					return $html;
    			}
    			else
    				return 'Run Step 1 before step 2 !';
    		}
    		else
    			return 'Split is not numeric !';
    	}
    	else
			return 'Image can not be opened !';
    }
    
    function __destruct() {

    }
}
?>