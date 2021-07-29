<?php
	// [INCLUDE] //
	include('./common/session.php');


	// [REQUIRE] //
	require_once('./api/stripe/index.php');


	// [REDIRECT] //
	if ($_SESSION['loggedin'] != true) { header('Location: ./login.php'); }


	// [STRIPE] //
	$StripeWrapper = new StripeWrapper();


	// [STRIPE] Retrieve Payment method //
	$pmDetailsObj = $StripeWrapper->retrieveDefaultPaymentMethod(
		$_SESSION['stripe_cus_id']
	);

	print_r($pmDetailsObj['last4']);
?>

<!-- [HTML] -->
<?php include('header.php'); ?>
 

<!-- [SPACER] -->
<section class="w3l-about-breadcrumb position-relative text-center">
	<div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4"></div>
</section>


<div class="container">
	<div class="card card-body my-5 shadow">
		<h2 class="text-center text-danger"><?php echo $_SESSION['email']; ?></h2>
		<hr>

		<h3 class="text-dark mb-3">Your payment Method:</h3>
		<h4 class="text-secondary mb-3">
			<?php echo $pmDetailsObj['card']['brand'] ?>
			ending in
			<?php echo $pmDetailsObj['card']['last4'] ?>
		</h4>

		<button class="btn btn-outline-secondary">Change Card</button>
		<hr>

		<h5>
			If you wish to cancel your subscription contact
			<a href="mailto:support@americanvinhistory.com" class="text-danger">
				support@americanvinhistory.com
			</a>
		</h5>
		<hr>

		<a href="./loggout.php">
			<button class="btn btn-primary w-100">Loggout</button>
		</a>
	</div>
</div>


<?php include('footer.php'); ?>


<?php include('./common/bottom_script.php'); ?>
</body>
</html>