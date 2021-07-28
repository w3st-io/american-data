<?php
	// [INCLUDE] //
	include('./connection.php');


	// [INIT] //
	$email = '';
	$v_code = '';
	$password = '';
	$fetched_email = '';
	$fetched_v_code = '';


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
			// [DATABASE][USER] Check if pvc exist in server //
			$stmt = $conn->prepare("
				SELECT email, v_code
				FROM password_v_codes
				WHERE email=?
				AND v_code=?
			");



			// [BIND] parameters for markers //
			$stmt->bind_param("ss", $email, $v_code);



			// [EXECUTE] query //
			$stmt->execute();



			// [BIND] result variables //
			$stmt->bind_result(
				$fetched_email,
				$fetched_v_code
			);



			// [FETCH] value //
			$stmt->fetch();


			// [CLOSE] //
			$stmt->close();


			// [VALIDATE] //
			if ($fetched_email != '') {
				// [DATABASE] prepare and bind //
				$stmt = $conn->prepare('
					UPDATE users
					SET password = ?
					WHERE email = ?
				');
	
				// [BIND] //
				$stmt->bind_param(
					'ss',
					$password,
					$email
				);
			
				// [EXECUTE] //
				$stmt->execute();
			
				// [CLOSE] //
				$stmt->close();
	
	

				// [DATABASE][DELETE] v_code //
				$stmt = $conn->prepare('DELETE FROM password_v_codes WHERE email=?');
	
				// [BIND] //
				$stmt->bind_param(
					's',
					$email
				);
			
				// [EXECUTE] //
				$stmt->execute();
			
				// [CLOSE] //
				$stmt->close();


				header('Location: ./login.php');
			}
			else { $error = 'wrong v_code'; }

		}
	}
?>


<!-- [HTML] ------------------------------------------------------->
<?php include('header.php'); ?>


<!-- about breadcrumb -->
<section class="w3l-about-breadcrumb position-relative text-center">
	<div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4"></div>
</section>


<div class="container">
	<div class="card card-body mx-auto my-5 shadow" style="max-width: 500px;">
		<h3 class="text-center text-dark">Password Recovery</h3>

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
			<input type="password" name="password" id="password" class="form-control w-100 mb-4">

			<!-- [SUBMTI] -->
			<button type="submit" class="btn btn-primary w-100">Submit</button>
		</form>

	</div>
</div>


<!-- Footer -->
<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>