<?php
	// [INCLUDE] //
	include('./common/session.php');
	include('./connection.php');


	// [REQUIRE] //
	require_once('./api/stripe/index.php');


	// [REDIRECT] //
	if ($_SESSION['loggedin'] != true) { header('Location: ./login.php'); }


	// [STRIPE] //
	$StripeWrapper = new StripeWrapper();


	// [INIT] //
	$email = $_SESSION['email'];
	$authenticated = false;
	$paid = false;
	$vin = '';
	$error = '';

	// Processing form data when form is submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// [GET-VALUES] //
		if (empty($_POST['vin'])) { $error = 'no vin passed'; }
		else {
			$vin = trim($_POST['vin']);
	
			// [SANITIZE] //
			$vin = filter_var($vin, FILTER_SANITIZE_STRING);

			// [STRIPE] //
			$chargeObj = $StripeWrapper->createOneDollarCharge(
				$_SESSION['stripe_cus_id'],
				$vin
			);

			$stripe_pi_id = $chargeObj['id'];

			if ($chargeObj['status'] = 'succeeded') {
				$paid = true;

				// [DB][PAYMENTS] Create //
				$stmt = $conn->prepare(
					"INSERT INTO payments (
						email,
						stripe_pi_id
					)
					VALUES (?,?)"
				);
				$stmt->bind_param(
					'ss',
					$email,
					$stripe_pi_id
				);
				$stmt->execute();
				$stmt->close();
			}
			else { $error = 'Payment failed'; }
		}
	}
	else {
		// [GET-VALUES] //
		if (empty($_GET['vin'])) { $error = 'no vin passed'; }
		else {
			$vin = trim($_GET['vin']);
	
			// [SANITIZE] //
			$vin = filter_var($vin, FILTER_SANITIZE_STRING);
		}
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

	<!-- [ERROR] -->
	<?php if ($error): ?>

		<div class="alert alert-danger mb-3 shadow">
			<h4 class="text-danger"><?php echo $error; ?></h4>
		</div>

	<?php else: ?>

		<?php if ($paid): ?>

			<!-- [SUCCESS] -->
			<h3 class="text-center text-dark">
				Thank You! You can now generate a report for the provided vin
			</h3>
			<hr>
			<a
				href="./generate-report.php?stripe_pi_id=<?php echo $stripe_pi_id; ?>"
				class="text-center"
			>
				<button class="btn btn-primary w-100">
					Go to Generate Report Page
				</button>
			</a>

		<?php else: ?>

			<div class="card card-body mb-3 shadow">
				<form
					action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
					method="POST"
				>
					<input type="hidden" name="vin" value="<?php echo $vin ?>">
					<button class="btn btn-primary w-100">Use Default Card</button>
				</form>
			</div>

		<?php endif; ?>
		
	<?php endif; ?>

</div>

<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>

</body>
</html>