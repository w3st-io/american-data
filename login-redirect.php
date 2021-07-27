<?php
	// [INCLUDE] //
	include('./connection.php');



	// [INIT] //
	$email = '';
	$password = '';
	$fetched_id = '';
	$fetched_email = '';
	$fetched_phone = '';
	$fetched_stripe_customer_token = '';
	$error = '';



	// Check if email is empty
	if (empty(trim($_POST['email']))) { $error = "Please enter email"; }
	else { $email = trim($_POST["email"]); }

	// Check if password is empty
	if(empty(trim($_POST['password']))) { $error = "Please enter your password"; }
	else { $password = trim($_POST["password"]); }
	

	if (empty($error)) {
		// [SANITIZE] //
		$email = filter_var($email, FILTER_SANITIZE_STRING);
		$password = filter_var($password, FILTER_SANITIZE_STRING);


		// [DATABASE][USER] Check if email exist in server //
		$stmt = $conn->prepare("
			SELECT id, email, phone, stripe_customer_token
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
			$fetched_id,
			$fetched_email,
			$fetched_phone,
			$fetched_stripe_customer_token,
		);
	
	
	
		// [FETCH] value //
		$stmt->fetch();
	
	
	
		// [VALIDATE] //
		if ($fetched_email != '') {
			// Password is correct, so start a new session
			session_start();


			// Store data in session variables
			$_SESSION['loggedin'] = true;
			$_SESSION['id'] = $fetched_id;
			$_SESSION['email'] = $fetched_email;
			$_SESSION['fetched_stripe_customer_token'] = $fetched_stripe_customer_token;

			header('Location: ./dashboard.php');
		}
		else {
			// [REDIRECT] back to login page //
			$error = 'invalid login';
	
			header('Location: ./login.php?error='.$error.'&email='.$email);
		}
	}	
	else {
		// [REDIRECT] back to login page //
		echo $error;

		header('Location: ./login.php?error='.$error);
	}

	
	// [CLOSE] Query //
	$stmt->close();
?>