<?php
	// [INCLUDE] //
	include('./connection.php');



	// [INIT] //
	$email = '';
	$password = '';
	$fetched_id = '';
	$fetched_email = '';
	$fetched_phone = '';
	$fetched_stripe_cus_id = '';
	$error = '';



	// Check if email is empty
	if (empty($_POST['email'])) { $error = "Please enter email"; }
	else {
		$email = trim($_POST["email"]);

		// [SANITIZE] //
		$email = filter_var($email, FILTER_SANITIZE_STRING);
	}

	// Check if password is empty
	if(empty($_POST['password'])) { $error = "Please enter your password"; }
	else {
		$password = trim($_POST["password"]);

		// [SANITIZE] //
		$password = filter_var($password, FILTER_SANITIZE_STRING);
	}
	

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