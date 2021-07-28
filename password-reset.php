<?php
	// [INIT] //
	$email = '';
	$v_code = '';
	$password = '';


	// Processing form data when form is submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// [GET-VALUES] //
		if (empty($_GET['email'])) { $error = "Please enter email"; }
		else {
			$email = trim($_GET["email"]);
		
			// [SANITIZE] //
			$email = filter_var($email, FILTER_SANITIZE_STRING);
		}
		
		
		// [GET-VALUES] //
		if (empty($_GET['email'])) { $error = "Please enter email"; }
		else {
			$email = trim($_GET["email"]);
		
			// [SANITIZE] //
			$v_code = filter_var($v_code, FILTER_SANITIZE_STRING);
		}
		

		// [GET-VALUES] //
		if (empty($_POST['password'])) { $error = "Please enter password"; }
		else {
			$password = trim($_POST["password"]);
		
			// [SANITIZE] //
			$password = filter_var($password, FILTER_SANITIZE_STRING);
		}

		
		// Check if email is empty
		if (empty($error)) {
			// [DATABASE] prepare and bind //
			$stmt = $conn->prepare("
				UPDATE users
				SET password = ?
				WHERE email = ?;
			");



			// [BIND] //
			$stmt->bind_param(
				'ss',
				$password,
				$email,
			);
		
		
		
			// [EXECUTE] //
			$stmt->execute();
		
		
		
			// [CLOSE] Query //
			$stmt->close();


			echo 'password changed';
		}
	}
?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	<input type="password" name="password" id="password">
</form>