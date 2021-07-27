<?php
	// [INCLUDE] //
	include('./connection.php');


	// [INIT] //
	$email = '';
	$error = '';
	

	// [GENERATE] //
	$random_hex = bin2hex(random_bytes(18));



	// [GET-VALUES] //
	if (empty($_GET['email'])) { $error = "Please enter email"; }
	else {
		$email = trim($_GET["email"]);

		// [SANITIZE] //
		$email = filter_var($email, FILTER_SANITIZE_STRING);
	}


	// Check if email is empty
	if (empty($error)) {
		// [DATABASE] prepare and bind //
		$stmt = $conn->prepare(
			"INSERT INTO password_v_codes (
				email,
				v_code
			)
			VALUES (?,?)"
		);
	
	
	
		// [BIND] //
		$stmt->bind_param(
			'ss',
			$email,
			$random_hex,
		);
	
	
	
		// [EXECUTE] //
		$stmt->execute();
	
	
	
		// [CLOSE] Query //
		$stmt->close();


		// [MAIL] Send the password reset //
		$send_to = 'aleem.ahmed1997@gmail.com';
		$subject = 'Reset password';
		$message = <<<BODY
		Click to recover password
		
		http://www.americanvinhistory.com/password-reset.php?v_code=$random_hex&email=$email
		
		If you do not have an account, you can safely delete this message.
		
		Thanks,
		americanvinhistory.com
		BODY;
		$header = 'From: Americandata <mail@americanvinhistory.com>' . "\r\n" .'Content-Type: text/plain';
		
		
		mail($send_to, $subject, $message, $header);
	}