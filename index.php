<?php
$msg 	= '';
$split 	= '';
$html 	= '';

if( isset( $_POST['img']) && $_POST['img'] != '' && isset( $_POST['nb'] ) && $_POST['nb'] != '' && is_numeric( $_POST['nb'] ) ) {
	require_once( 'lib/transformOriginal.php' );
	$perform 	= new transformOriginal( $_POST['img'], $_POST['nb']);
	$msg 		= explode( '|', $perform->perform() );

	if( count( $msg ) == 2 ) {
		$split 	= $msg[0];
		$msg 	= $msg[1];
	}
	else
		$msg 	= $msg[0];
}
elseif( isset( $_POST['imgScanned'] ) && $_POST['imgScanned'] != '' && $_POST['split'] != '' && is_numeric( $_POST['split'] )  ) {
	require_once( 'lib/transformScan.php' );
	$perform 	= new transformScan( $_POST['imgScanned'], $_POST['split'] );
	$html 		= $perform->perform();
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Puzzle resolver</title>
		
		<style>
			body{background-color: #FFF;color: #000;font-size: 14px;}
			.p{float:left;height: 28px;width: 28px;background-color: #000;border: 1px solid #F00;}
			.clear {clear:both;}
			span{margin-left: 40px;color: #000;}
			.err{color: #F00; font-weight: bold; font-size: 16px;}
		</style>
	</head>
	<body>
		<?php
			if( $msg != '' )
				echo '<p class="err">' . $msg . '</p>';
		?>
		<form action="" method="post">
			<h1>Step 1 - Split original picture</h1>
			<p><label>Image file</label><input type="text" name="img"></input></p>
			<p><label>Number of pieces</label><input type="text" name="nb"></input></p>
			<p><input type="submit" value="Submit"></input></p>
		</form>
		
		<form action="" method="post">
			<h1>Step 2 - Search scan picture</h1>
			<p><label>Scanned file</label><input type="text" name="imgScanned"></input></p>
			<p><label>Split</label><input type="text" name="split" value="<?php echo $split; ?>"></input></p>
			<p><input type="submit" value="Submit"></input></p>
		</form>
		<?php
			echo $html;
		?>
	</body>
</html>