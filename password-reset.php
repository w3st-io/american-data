<?php
	// [INCLUDE] //
	include('./connection.php');


	// [INIT] //
	$email = '';
	$v_code = '';
	$password = '';


	// Processing form data when form is submitted
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// [POST-VALUES] //
		if (empty($_POST['email'])) { $error = 'No email'; }
		else {
			$email = trim($_POST['email']);
		
			// [SANITIZE] //
			$email = filter_var($email, FILTER_SANITIZE_STRING);
		}
		
		
		// [POST-VALUES] //
		if (empty($_POST['v_code'])) { $error = 'No v_code'; }
		else {
			$v_code = trim($_POST['v_code']);
		
			// [SANITIZE] //
			$v_code = filter_var($v_code, FILTER_SANITIZE_STRING);
		}
		

		// [POST-VALUES] //
		if (empty($_POST['password'])) { $error = 'Please enter password'; }
		else {
			$password = trim($_POST['password']);
		
			// [SANITIZE] //
			$password = filter_var($password, FILTER_SANITIZE_STRING);
		}

		
		// Check if email is empty
		if (empty($error)) {
			// [VERIFY] //



			echo 'sdfsdf'. $email . $v_code . $password;

			// [DATABASE] prepare and bind //
			$stmt = $conn->prepare('
				UPDATE users
				SET password = ?
				WHERE email = ?;
			');



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


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
	<input
		type="hidden"
		name="email"
		id="email"
		value="<?php echo $_GET['email']; ?>"
	>

	<input
		type="hidden"
		name="v_code"
		id="v_code"
		value="<?php echo $_GET['v_code']; ?>"
	>

	<!-- Password -->
	<label for="password">Enter new password</label>
	<input type="password" name="password" id="password">

	<!-- [SUBMTI] -->
	<button type="submit" class="btn btn-primary">Submit</button>
</form>