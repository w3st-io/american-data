<?php
	// [INCLUDE] //
	include('./common/session.php');
	include('connection.php');
	

	// [INIT] //
	$vin = '';
	$error = '';
	
	
	// [POST] //
	if (isset($_GET['vin'])) { $vin = strip_tags($_GET['vin']); }
	if (isset($_GET['error'])) { $error = strip_tags($_GET['error']); }
	?>


<!-- [HTML] ------------------------------------------------------->
<?php include('header.php'); ?>


<!-- [SCRIPT] ------------------------------------------------------->
