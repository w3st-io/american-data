<?php
	// [INCLUDE] //
	include('connection.php');


	// [INIT] //
	$authenticated = false;
	$vin = '';
	$email = '';
	$password = '';
	$error = '';


	// [POST-VALUES] //
	if (isset($_POST['vin'])) { $vin = strip_tags($_POST['vin']); }
	else { $error = 'No vin passed'; }

	if (isset($_POST['email'])) { $email = strip_tags($_POST['email']); }
	else { $error = 'No email passed'; }

	if (isset($_POST['password'])) { $password = strip_tags($_POST['password']); }


	// [SANITIZE] //
	$vin = filter_var($vin, FILTER_SANITIZE_STRING);
	$email = filter_var($email, FILTER_SANITIZE_STRING);
	$password = filter_var($password, FILTER_SANITIZE_STRING);


	if ($error == '') {
		// [DATABASE][USER] //
		$stmt = $conn->prepare("SELECT id, email, stripe_cus_id FROM users WHERE email=? AND password=?");
		$stmt->bind_param("ss", $email, $password);
		$stmt->execute();
		$stmt->bind_result(
			$fetched_id,
			$fetched_email,
			$fetched_stripe_cus_id
		);
		$stmt->fetch();
		$stmt->close();

	
		// [USER] Not Found //
		if ($fetched_email == null) { $error = 'Invalid login'; }
		else {
			// Password is correct, so start a new session
			session_start();

			// Store data in session variables
			$_SESSION['loggedin'] = true;
			$_SESSION['id'] = $fetched_id;
			$_SESSION['email'] = $fetched_email;
			$_SESSION['stripe_cus_id'] = $fetched_stripe_cus_id;
		}
	}
?>


<!-- [HTML] ------------------------------------------------------->
<?php include('header.php'); ?>


<!-- [SPACER] -->
<section class="w3l-about-breadcrumb position-relative text-center">
	<div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4"></div>
</section>


<div class="container my-5 ">
	<div class="card card-body shadow">

		<?php if ($authenticated): ?>

			<!-- [HIDDEMN] INVALID LOGIN -->
			<form id="failed-form" action="./payments-proccess.php" method="GET">
				<input type="hidden" name="vin" value="<?php echo $vin ?>">
				<input type="hidden" name="error" value="<?php echo $error ?>">
			</form>

			<script type="text/javascript">
				document.getElementById('failed-form').submit();
			</script>

		<?php else: ?>

			<!-- [HIDDEMN] INVALID LOGIN -->
			<form id="failed-form" action="./payments-proccess-login.php" method="GET">
				<input type="hidden" name="vin" value="<?php echo $vin ?>">
			</form>

			<script type="text/javascript">
				document.getElementById('failed-form').submit();
			</script>

		<?php endif; ?>
	</div>
</div>

<!-- [FOOTER] -->
<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>

</body>
</html>