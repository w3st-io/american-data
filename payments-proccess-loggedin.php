<?php
	// [INCLUDE] //
	include('./common/session.php');
	include('./connection.php');


	// [INIT] //
	$authenticated = false;
	$vin = '';
	$error = '';

	
	// [POST-VALUES] //
	if (empty($_GET['vin'])) { $error = 'Please enter email'; }
	else {
		$vin = trim($_GET['vin']);

		// [SANITIZE] //
		$vin = filter_var($vin, FILTER_SANITIZE_STRING);
	}

	// [LOGIN] //
	if ($error == '') {
	
	}
?>

<!-- [HTML] ------------------------------------------------------->
<!-- [HEADER] -->
<?php include('header.php'); ?>


<!-- [SPACER] -->
<section class="w3l-about-breadcrumb position-relative text-center">
	<div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4"></div>
</section>

<!-- [ERROR] -->
<?php if($error): ?>

	<div class="alert alert-danger mb-3 shadow">
		<h4 class="text-danger"><?php echo $error; ?></h4>
	</div>

<?php endif; ?>

<div class="container my-5">
	<div class="alert alert-danger mb-3 shadow">
		<h4 class="text-danger"><?php echo $error; ?></h4>
		<hr>

		<form
			action="./payments-proccess-login.php?vin=<?php echo $vin; ?>"
			method="POST"
		>
			<label for="password" class="font-weight-bold">Password:</label>

			<!-- [INPUT][HIDDEN] vin -->
			<input
				type="hidden"
				id="vin"
				name="vin"
				value="<?php echo $vin; ?>"
			>

			
			<!-- [SUBMIT] -->
			<div class="btn btn-primary mb-3">Login</div>
		</form>
	</div>
</div>

<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>

</body>
</html>