<?php
	// [INIT] //
	$authenticated = false;
	$error = '';
	$vin = '';
	$email = '';
	$password = '';

	
	// [POST-VALUES] //
	if (empty($_POST['vin'])) { $error = 'Please enter email'; }
	else {
		$vin = trim($_POST['vin']);

		// [SANITIZE] //
		$vin = filter_var($vin, FILTER_SANITIZE_STRING);
	}

	if (empty($_POST['email'])) { $error = 'Please enter email'; }
	else {
		$email = trim($_POST['email']);

		// [SANITIZE] //
		$email = filter_var($email, FILTER_SANITIZE_STRING);
	}

	if(empty($_POST['password'])) { $error = 'Please enter your password'; }
	else {
		$password = trim($_POST['password']);

		// [SANITIZE] //
		$password = filter_var($password, FILTER_SANITIZE_STRING);
	}
?>

<!-- [HTML] ------------------------------------------------------->
<!-- [HEADER] -->
<?php include('header.php'); ?>

<!-- about breadcrumb -->
<section class="w3l-about-breadcrumb position-relative text-center">
	<div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4"></div>
</section>

<div class="container">
	<div class="card card-body my-5 shadow">
	</div>
</div>

<!-- [FOOTER] -->
<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>

</body>
</html>