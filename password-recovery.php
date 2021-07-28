<?php
	// [INCLUDE] //
	include('./connection.php');


	// [INIT] //
	$email = '';
	$error = '';
	$status = false;


	// [GENERATE] //
	$random_hex = bin2hex(random_bytes(18));


	// Processing form data when form is submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// [GET-VALUES] //
		if (empty($_POST['email'])) { $error = "Please enter email"; }
		else {
			$email = trim($_POST["email"]);

			// [SANITIZE] //
			$email = filter_var($email, FILTER_SANITIZE_STRING);
		}


		// Check if email is empty
		if (empty($error)) {
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


			// [SET-FLAG] //
			$status = true;
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

		<?php if (!$status): ?>

			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
				<label for="email">Enter your email</label>
				<input type="email" name="email" id="email" class="form-control mb-4">

				<!-- [SUBMIT] -->
				<button type="submit" class="btn btn-primary w-100">Submit</button>
			</form>

		<?php else : ?>

			<h5 class="text-success my-5">Password Recover Email sent! Please check!</h5>

			<a href="<?php echo './password-reset.php?v_code='.$random_hex.'&email='.$email;?>">link</a>
			
		<?php endif; ?>
	</div>
</div>


<!-- Footer -->
<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>