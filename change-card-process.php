<?php
	// [INCLUDE] //
	include('./common/session.php');
	include('connection.php');


	// [REQUIRE] //
	require_once('./api/stripe/index.php');


	// [INIT] //
	$card_number = '';
	$card_exp_month = '';
	$card_exp_year = '';
	$card_cvv = '';


	// [STRIPE] //
	$StripeWrapper = new StripeWrapper();


	// [REDIRECT] //
	if ($_SESSION['loggedin'] != true) { header('Location: ./login.php'); }


	// [POST-VALUES] //
	if (isset($_POST['card_number'])) {
		$card_number = strip_tags($_POST['card_number']);
	}
	else { $error = 'No card_number passed'; }

	if (isset($_POST['card_exp_month'])) {
		$card_exp_month = strip_tags($_POST['card_exp_month']);
	}
	else { $error = 'No card_exp_month passed'; }

	if (isset($_POST['card_exp_year'])) {
		$card_exp_year = strip_tags($_POST['card_exp_year']);
	}
	else { $error = 'No card_exp_year passed'; }

	if (isset($_POST['card_cvv'])) {
		$card_cvv = strip_tags($_POST['card_cvv']);
	}
	else { $error = 'No card_cvv passed'; }


	// [SANITIZE] //
	$card_number = filter_var($card_number, FILTER_SANITIZE_NUMBER_INT);
	$card_number = preg_replace( '/\d[ *]\d/', '', $card_number);
	$card_exp_month = filter_var($card_exp_month, FILTER_SANITIZE_NUMBER_INT);
	$card_exp_year = filter_var($card_exp_year, FILTER_SANITIZE_NUMBER_INT);
	$card_cvv = filter_var($card_cvv, FILTER_SANITIZE_NUMBER_INT);


	echo 'sdfsdf'.$card_exp_year;
	// [STRIPE] update payment method //
	$updatedPmObj = $StripeWrapper->updateDefaultPaymentMethod(
		$_SESSION['stripe_cus_id'],
		$card_number,
		$card_exp_month,
		$card_exp_year,
		$card_cvv
	);


	header('Location: ./dashboard.php');
?>