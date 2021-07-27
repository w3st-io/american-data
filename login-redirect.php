<?php
	// [INCLUDE] //
	include('./connection.php')



	// [INIT] //
	$email = '';
	$password = '';
	$fetched_email = '';
	$fetched_phone = '';
	$fetched_stripe_customer_token = '';



	// [POST-VALUES] //
	$email = $_POST['email']; 
	$password = $_POST['password'];
	

	
	// [SANITIZE] //



	#if (parameters passed) {}



	// [DATABASE][USER] Check if email exist in server //
	$stmt = $conn->prepare("
		SELECT email, phone, stripe_customer_token
		FROM users
		WHERE email=?
		AND password=?
	");



	// [BIND] parameters for markers //
	$stmt->bind_param("ss", $email, $password);



	// [EXECUTE] query //
	$stmt->execute();



	// [BIND] result variables //
	$stmt->bind_result(
		$fetched_email,
		$fetched_phone,
		$fetched_stripe_customer_token,
	);



	// [FETCH] value //
	$stmt->fetch();



	// [CLOSE] Query //
	$stmt->close();
?>