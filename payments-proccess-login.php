<?php
	// [INCLUDE] //
	include('./common/session.php');
	include('./connection.php');


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

	// [LOGIN] //
	if (empty($error)) {
		// [DATABASE][USER] Check if email exist in server //
		$stmt = $conn->prepare("
			SELECT id, email, phone, stripe_cus_id
			FROM users
			WHERE email=?
			AND password=?
		");
		$stmt->bind_param("ss", $email, $password);
		$stmt->execute();
		$stmt->bind_result(
			$fetched_id,
			$fetched_email,
			$fetched_phone,
			$fetched_stripe_cus_id,
		);
		$stmt->fetch();
	
		// [VALIDATE] //
		if ($fetched_email != '') {
			// Password is correct, so start a new session
			session_start();

			// Store data in session variables
			$_SESSION['loggedin'] = true;
			$_SESSION['id'] = $fetched_id;
			$_SESSION['email'] = $fetched_email;
			$_SESSION['stripe_cus_id'] = $fetched_stripe_cus_id;

			$authenticated = true;
		}
		else { $authenticated = false; }
	}
?>

<!-- [HTML] ------------------------------------------------------->
<!-- [HEADER] -->
<?php include('header.php'); ?>

<!-- [SPACER] -->
<section class="w3l-about-breadcrumb position-relative text-center">
	<div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4"></div>
</section>

<div class="container my-5">

	<!-- [PHP] Authentication -->
	<?php if ($authenticated): ?>

		<!-- [ERROR] -->
		<div class="alert alert-danger mb-3 shadow">
			<h4 class="text-danger"><?php echo $error; ?></h4>
			<hr>

			<form id="myForm" action="./payments-proccess.php" method="post">
				<!-- [INPUT][HIDDEN] vin -->
				<input
					type="hidden"
					id="vin"
					name="vin"
					value="<?php echo $vin; ?>"
				>
			
				<button
					type="submit"
					class="btn btn-primary w-100"
				>Try Again</button>
				
			</form>

			<script type="text/javascript">
				document.getElementById('myForm').submit();
			</script>
		</div>

	<?php else: ?>

		<form id="myForm" action="./payments-proccess.php" method="post">
			<!-- [INPUT][HIDDEN] vin -->
			<input
				type="hidden"
				id="vin"
				name="vin"
				value="<?php echo $vin; ?>"
			>
		</form>

		<script type="text/javascript">
			document.getElementById('myForm').submit();
		</script>

	<?php endif; ?>

</div>

<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>

</body>
</html>