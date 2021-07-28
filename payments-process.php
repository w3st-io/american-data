<?php
	try {
		// [REQUIRE] Personal //
		require_once('./api/billsby/index.php');
		require_once('./api/stripe/index.php');
		require_once('vendor/autoload.php');


		// [INCLUDE] //
		include('./connection.php');
		
		
		// [USE] //
		use Firebase\JWT\JWT;


		// [STRIPE] //
		$StripeWrapper = new StripeWrapper();
	

		// [INIT] Const //
		$key="a54b94bc3b94d6a330a859f37b9231e571a0f7966d2c44557e219ad7440c80ef4d2";
	

		// [INIT] //
		$error = '';
		$vin = '';
		$email = '';
		$phone = '';
		$card_name = '';
		$card_number = '';
		$card_exp_month = '';
		$card_exp_year = '';
		$card_cvv = '';
		$sign = '';
		$tokenObj = '';


		// [POST-VALUES] //
		if (isset($_POST['vin'])) { $vin = strip_tags($_POST['vin']); }
		else { $error = 'No vin passed'; }

		if ($error == '') {
			// [USER-LOGGED] //
			if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
				
			}
			else {
				// [POST-VALUES] // 
				if (isset($_POST['email'])) { $email = strip_tags($_POST['email']); }
				if (isset($_POST['phone'])) { $phone = strip_tags($_POST['phone']); }
				if (isset($_POST['card_name'])) { $card_name = strip_tags($_POST['card_name']); }
				if (isset($_POST['card_number'])) { $card_number = strip_tags($_POST['card_number']); }
				if (isset($_POST['card_exp_month'])) { $card_exp_month = strip_tags($_POST['card_exp_month']); }
				if (isset($_POST['card_exp_year'])) { $card_exp_year = strip_tags($_POST['card_exp_year']); }
				if (isset($_POST['card_cvv'])) { $card_cvv = strip_tags($_POST['card_cvv']); }
				if (isset($_POST['sign'])) { $sign = strip_tags($_POST['sign']); }
				
				// [SANTIZE] //
				$vin = filter_var($vin, FILTER_SANITIZE_STRING);
				$email = filter_var($email, FILTER_SANITIZE_STRING);
				$phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
				$phone = preg_replace( '/\d[ *]\d/', '', $phone);
				$card_name = filter_var($card_name, FILTER_SANITIZE_STRING);
				$card_number = filter_var($card_number, FILTER_SANITIZE_NUMBER_INT);
				$card_number = preg_replace( '/\d[ *]\d/', '', $card_number);
				$card_exp_month = filter_var($card_exp_month, FILTER_SANITIZE_NUMBER_INT);
				$card_exp_year = filter_var($card_exp_year, FILTER_SANITIZE_NUMBER_INT);
				$card_cvv = filter_var($card_cvv, FILTER_SANITIZE_NUMBER_INT);
				$sign = filter_var($sign, FILTER_SANITIZE_STRING);
	
				
				// [PASSWORD] //
				$password = substr($phone, -4);
				
				
				// [DATABASE][USER] Check if email exist in server //
				$stmt = $conn->prepare("SELECT email, phone FROM users WHERE email=?");
				$stmt->bind_param("s", $email);
				$stmt->execute();
				$stmt->bind_result($fetched_email, $fetched_phone);
				$stmt->fetch();
				$stmt->close();
		
			
				// [USER] Not Found //
				if ($fetched_email == null) {
					// [STRIPE] Create Payment Method //
					$tokenObj = $StripeWrapper->createPaymentMethod(
						$card_number,
						$card_exp_month,
						$card_exp_year,
						$card_cvv,
					);
			
					
					// [JWT][TOKENIZE] payLaod //
					$payload = array(
						"card_number" => $card_number,
						"card_exp_month" => $card_exp_month,
						"card_exp_year" => $card_exp_year,
						"card_cvv" => $card_cvv
					);
			
					// [ENCODE] //
					$payment_jwt = JWT::encode($payload, $key);
		
					$decoded = JWT::decode($payment_jwt, $key, array('HS256'));
					
		
					// [STRIPE] Create Customer with default Payment Method //
					$customerObj = $StripeWrapper->createCustomer(
						$email,
						$phone,
						$tokenObj['id']
					);
			
					$stripe_cus_id = $customerObj['id'];
			
		
					// [USER] Create //
					$stmt = $conn->prepare(
						"INSERT INTO users (
							email,
							phone,
							password,
							sign,
							stripe_cus_id,
							payment_jwt
						)
						VALUES (?,?,?,?,?,?)"
					);
					$stmt->bind_param(
						'ssssss',
						$email,
						$phone,
						$password,
						$sign,
						$stripe_cus_id,
						$payment_jwt
					);
					$stmt->execute();
					$stmt->close();
			
					
					// [STRIPE] Create Charge //
					$chargeObj = $StripeWrapper->createOneDollarCharge(
						$customerObj['id']
					);
		
					$stripe_pi_id = $chargeObj['id'];
		
					// [DB][PAYMENTS] Create //
					$stmt = $conn->prepare(
						"INSERT INTO payments (
							email,
							stripe_pi_id
						)
						VALUES (?,?)"
					);
					$stmt->bind_param(
						'ss',
						$email,
						$stripe_pi_id
					);
					$stmt->execute();
					$stmt->close();
			
		
					// [SUBSCRIPTION] //
					if (0 == 1) {
						// [STRIPE] Create Free trial until Subscription //
						$subObj = $StripeWrapper->createSubscription($customerObj['id']);
				
						
						$stripe_sub_id = $subObj['id'];
						$current_period_end = $subObj['current_period_end'];
						$current_period_reports_count = 0;
						
			
						// [CREATE] sub //
						$stmt = $conn->prepare(
							"INSERT INTO subs (
								email,
								stripe_sub_id,
								current_period_end,
								current_period_reports_count
							)
							VALUES (?,?,?,?)"
						);
						$stmt->bind_param(
							'ssss',
							$email,
							$stripe_sub_id,
							$current_period_end,
							$current_period_reports_count,
						);
						$stmt->execute();
						$stmt->close();
					}
				}
			}
		}
	}
	catch (\Throwable $err) {
		header("Location: ./payments.php?vin=$vin&error=$err");
	}
	
	// [CLOSE] DB conn //
	$conn->close();
?>


<!-- [HTML] ------------------------------------------------------->
<!-- [HEADER] -->
<?php include('header.php'); ?>


<!-- about breadcrumb -->
<section class="w3l-about-breadcrumb position-relative text-center">
	<div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4"></div>
</section>

<div class="container my-5 ">

	<?php if($error): ?>
		<!-- [ERROR] -->
		<div class="alert alert-danger mb-3 shadow">
			<h4 class="text-danger"><?php echo $error; ?></h4>
		</div>
		<?php endif; ?>
		
		<div class="card card-body shadow">
			
			<!-- [PHP] USER LOGGED -->
			<?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
			
				<div class="">
					
				</div>

			<!-- [PHP] USER NOT LOGGED -->
			<?php else: ?>
				
				<!-- [PHP] USER FOUND -->
				<?php if($fetched_email): ?>
				
					<h3>You already have an account</h3>
					<h6 class="text-secondary">Please enter your password to continue.</h6>
					<hr>

					<label class="font-weight-bold">Username:</label>
					<h6 class="mb-3"><?php echo $email; ?></h6>

					<form
						action="./payments-proccess-login.php?vin=<?php echo $vin; ?>"
						method="POST"
					>
						<label for="password" class="font-weight-bold">Password:</label>

						<!-- [HIDDEN] vin -->
						<input
							type="hidden"
							id="vin"
							name="vin"
							value="<?php echo $vin; ?>"
						>

						<!-- [HIDDEN] email -->
						<input
							type="hidden"
							id="email"
							name="email"
							value="<?php echo $email; ?>"
						>

						<!-- [INPUT] Password -->
						<input
							id="password"
							name="password"
							type="password"
							class="form-control my-2"
							style="max-width: 500px;"
							placeholder="Password (Default is last 4 digits of your phone)"
						>

						<!-- [SUBMIT] -->
						<div class="btn btn-primary mb-3">Login</div>
					</form>

				
				<?php else: ?>
					
					<!-- [SUCCESS] -->
					<h3 class="text-center text-dark">
						Thank You! You can now generate a report for the provided vin
					</h3>
					<hr>
					<a
						href="./generate-report.php?stripe_pi_id=<?php echo $stripe_pi_id; ?>"
						class="text-center"
					>
						<button class="btn btn-primary w-100" style="max-width: 500px;">
							Go to Generate Report Page
						</button>
					</a>
				
				<?php endif; ?>

			<?php endif; ?>
		
		<?php
			/*
			// [ADMIN][DEBUG] //
			echo '<div class="p-2 border border-warning">';
			echo '<h6 class="text-warning">email: '.$email.'</h6>';
			echo '<h6 class="text-warning">phone: '.$phone.'</h6>';
			echo '<h6 class="text-warning">card_name: '.$card_name.'</h6>';
			echo '<h6 class="text-warning">card_number: '.$card_number.'</h6>';
			echo '<h6 class="text-warning">card_exp_month: '.$card_exp_month.'</h6>';
			echo '<h6 class="text-warning">card_exp_year: '.$card_exp_year.'</h6>';
			echo '<h6 class="text-warning">card_cvv: '.$card_cvv.'</h6>';
			echo '<h6 class="text-warning">password: '.$password.'</h6>';
			//echo '<h6 class="text-warning">signature: '.$sign.'</h6>';
			echo '<h6 class="text-warning">tokenObj: '.$tokenObj.'</h6>';
			echo '</div>';
			*/
		?>

	</div>
</div>

<!-- [FOOTER] -->
<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>

</body>
</html>