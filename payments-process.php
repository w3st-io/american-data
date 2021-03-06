<?php
	// [REQUIRE] Personal //
	require_once('./api/billsby/index.php');
	require_once('./api/stripe/index.php');
	require('vendor/autoload.php');


	// [INCLUDE] //
	include('./common/session.php');
	include('./connection.php');

	
	// [USE] //
	use Firebase\JWT\JWT;
	
	
	try {
		// [STRIPE] //
		$StripeWrapper = new StripeWrapper();
	

		// [INIT] //
		$paid = false;
		$vin = '';
		$email = '';
		$street = '';
		$city = '';
		$state = '';
		$zip = '';
		$phone = '';
		$card_name = '';
		$card_number = '';
		$card_exp_month = '';
		$card_exp_year = '';
		$card_cvv = '';
		$sign = '';
		$error = '';


		// [BLANK] sign //
		if ($_POST['sign'] == 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZUAAACfCAYAAAAxt0TpAAAAAXNSR0IArs4c6QAABcZJREFUeF7t1TENAAAMw7CVP+mRyOkB6GFNys4RIECAAIFIYNGOGQIECBAgcKLiCQgQIEAgExCVjNIQAQIECIiKHyBAgACBTEBUMkpDBAgQICAqfoAAAQIEMgFRySgNESBAgICo+AECBAgQyAREJaM0RIAAAQKi4gcIECBAIBMQlYzSEAECBAiIih8gQIAAgUxAVDJKQwQIECAgKn6AAAECBDIBUckoDREgQICAqPgBAgQIEMgERCWjNESAAAECouIHCBAgQCATEJWM0hABAgQIiIofIECAAIFMQFQySkMECBAgICp+gAABAgQyAVHJKA0RIECAgKj4AQIECBDIBEQlozREgAABAqLiBwgQIEAgExCVjNIQAQIECIiKHyBAgACBTEBUMkpDBAgQICAqfoAAAQIEMgFRySgNESBAgICo+AECBAgQyAREJaM0RIAAAQKi4gcIECBAIBMQlYzSEAECBAiIih8gQIAAgUxAVDJKQwQIECAgKn6AAAECBDIBUckoDREgQICAqPgBAgQIEMgERCWjNESAAAECouIHCBAgQCATEJWM0hABAgQIiIofIECAAIFMQFQySkMECBAgICp+gAABAgQyAVHJKA0RIECAgKj4AQIECBDIBEQlozREgAABAqLiBwgQIEAgExCVjNIQAQIECIiKHyBAgACBTEBUMkpDBAgQICAqfoAAAQIEMgFRySgNESBAgICo+AECBAgQyAREJaM0RIAAAQKi4gcIECBAIBMQlYzSEAECBAiIih8gQIAAgUxAVDJKQwQIECAgKn6AAAECBDIBUckoDREgQICAqPgBAgQIEMgERCWjNESAAAECouIHCBAgQCATEJWM0hABAgQIiIofIECAAIFMQFQySkMECBAgICp+gAABAgQyAVHJKA0RIECAgKj4AQIECBDIBEQlozREgAABAqLiBwgQIEAgExCVjNIQAQIECIiKHyBAgACBTEBUMkpDBAgQICAqfoAAAQIEMgFRySgNESBAgICo+AECBAgQyAREJaM0RIAAAQKi4gcIECBAIBMQlYzSEAECBAiIih8gQIAAgUxAVDJKQwQIECAgKn6AAAECBDIBUckoDREgQICAqPgBAgQIEMgERCWjNESAAAECouIHCBAgQCATEJWM0hABAgQIiIofIECAAIFMQFQySkMECBAgICp+gAABAgQyAVHJKA0RIECAgKj4AQIECBDIBEQlozREgAABAqLiBwgQIEAgExCVjNIQAQIECIiKHyBAgACBTEBUMkpDBAgQICAqfoAAAQIEMgFRySgNESBAgICo+AECBAgQyAREJaM0RIAAAQKi4gcIECBAIBMQlYzSEAECBAiIih8gQIAAgUxAVDJKQwQIECAgKn6AAAECBDIBUckoDREgQICAqPgBAgQIEMgERCWjNESAAAECouIHCBAgQCATEJWM0hABAgQIiIofIECAAIFMQFQySkMECBAgICp+gAABAgQyAVHJKA0RIECAgKj4AQIECBDIBEQlozREgAABAqLiBwgQIEAgExCVjNIQAQIECIiKHyBAgACBTEBUMkpDBAgQICAqfoAAAQIEMgFRySgNESBAgICo+AECBAgQyAREJaM0RIAAAQKi4gcIECBAIBMQlYzSEAECBAiIih8gQIAAgUxAVDJKQwQIECAgKn6AAAECBDIBUckoDREgQICAqPgBAgQIEMgERCWjNESAAAECouIHCBAgQCATEJWM0hABAgQIiIofIECAAIFMQFQySkMECBAgICp+gAABAgQyAVHJKA0RIECAgKj4AQIECBDIBEQlozREgAABAqLiBwgQIEAgExCVjNIQAQIECIiKHyBAgACBTEBUMkpDBAgQICAqfoAAAQIEMgFRySgNESBAgICo+AECBAgQyAREJaM0RIAAAQKi4gcIECBAIBMQlYzSEAECBAiIih8gQIAAgUxAVDJKQwQIECAgKn6AAAECBDKBB6DdAKDU/XQtAAAAAElFTkSuQmCC') {
			$error = 'Blank signature';
		}
		
		// [POST-VALUES] //
		if (isset($_POST['vin'])) { $vin = strip_tags($_POST['vin']); }
		else { $error = 'No vin passed'; }

		if (isset($_POST['email'])) { $email = strip_tags($_POST['email']); }
		else { $error = 'No email passed'; }

		if (isset($_POST['street'])) { $street = strip_tags($_POST['street']); }
		else { $error = 'No street passed'; }

		if (isset($_POST['city'])) { $city = strip_tags($_POST['city']); }
		else { $error = 'No city passed'; }

		if (isset($_POST['state'])) { $state = strip_tags($_POST['state']); }
		else { $error = 'No state passed'; }

		if (isset($_POST['zip'])) { $zip = strip_tags($_POST['zip']); }
		else { $error = 'No zip passed'; }

		if (isset($_POST['phone'])) { $phone = strip_tags($_POST['phone']); }
		else { $error = 'No phone passed'; }

		if (isset($_POST['card_name'])) {
			$card_name = strip_tags($_POST['card_name']);
		}
		else { $error = 'No card_name passed'; }

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

		if (isset($_POST['sign'])) { $sign = strip_tags($_POST['sign']); }
		else { $error = 'No sign passed'; }


		// [SANITIZE] //
		$vin = filter_var($vin, FILTER_SANITIZE_STRING);
		$email = filter_var($email, FILTER_SANITIZE_STRING);
		$street = filter_var($street, FILTER_SANITIZE_STRING);
		$city = filter_var($city, FILTER_SANITIZE_STRING);
		$state = filter_var($state, FILTER_SANITIZE_STRING);
		$zip = filter_var($zip, FILTER_SANITIZE_STRING);
		$phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
		$phone = preg_replace( '/\d[ *]\d/', '', $phone);
		$card_name = filter_var($card_name, FILTER_SANITIZE_STRING);
		$card_number = filter_var($card_number, FILTER_SANITIZE_NUMBER_INT);
		$card_number = preg_replace( '/\d[ *]\d/', '', $card_number);
		$card_exp_month = filter_var($card_exp_month, FILTER_SANITIZE_NUMBER_INT);
		$card_exp_year = filter_var($card_exp_year, FILTER_SANITIZE_NUMBER_INT);
		$card_cvv = filter_var($card_cvv, FILTER_SANITIZE_NUMBER_INT);
		$sign = filter_var($sign, FILTER_SANITIZE_STRING);


		if ($error == '') {
			// [PASSWORD] //
			$password = substr($phone, -4);
			
			
			// [DATABASE][USER] Check if email exist in server //
			$stmt = $conn->prepare("SELECT email, phone FROM users WHERE email=?");
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$stmt->bind_result(
				$fetched_email,
				$fetched_phone
			);
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
		
				// [JWT][ENCODE] //
				$payment_jwt = JWT::encode($payload, SECRET_JWT_KEY);
	
				$decoded = JWT::decode($payment_jwt, SECRET_JWT_KEY, array('HS256'));
				
	
				// [STRIPE] Create Customer with default Payment Method //
				$customerObj = $StripeWrapper->createCustomer(
					$email,
					$phone,
					$tokenObj['id'],
					$street,
					$city,
					$state,
					$zip
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
						payment_jwt,
						street,
						city,
						state,
						zip
					)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
				);
				$stmt->bind_param(
					'ssssssssss',
					$email,
					$phone,
					$password,
					$sign,
					$stripe_cus_id,
					$payment_jwt,
					$street,
					$city,
					$state,
					$zip,
				);
				$stmt->execute();
				$stmt->close();
		
				
				// [STRIPE] Create Charge //
				$chargeObj = $StripeWrapper->createOneDollarCharge(
					$customerObj['id'],
					$vin
				);
	
				$stripe_pi_id = $chargeObj['id'];

				// [PAYMENT][SUCCESS] //
				if ($chargeObj['status'] == 'succeeded') {
					$paid = true;

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
		else { header("Location: ./payments.php?vin=$vin&error=$error"); }
	}
	catch (\Throwable $err) {
		header(
			"Location: ./payments.php?vin=$vin&error=something%20went%20wrong%20please%20try%20again"
		);
	}
	
	// [CLOSE] DB conn //
	$conn->close();
?>


<!-- [HTML] ------------------------------------------------------->
<?php include('header.php'); ?>


<!-- [SPACER] -->
<section class="w3l-about-breadcrumb position-relative text-center">
	<div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4"></div>
</section>


<div class="container my-5 ">

	<!-- [ERROR] -->
	<?php if($error): ?>

		<div class="alert alert-danger mb-3 shadow">
			<h4 class="text-danger"><?php echo $error; ?></h4>
		</div>

	<?php else: ?>

		<!-- [MAIN] -->
		<div class="card card-body shadow">
		
			<!-- [PHP] USER FOUND -->
			<?php if ($fetched_email): ?>
			
				<h3>You already have an account</h3>
				<h6 class="text-secondary">Please enter your password to continue.</h6>
				<hr>
	
				<form action="./payments-login.php" method="post">
					<label class="font-weight-bold">Username:</label>
					<h6 class="mb-3"><?php echo $email; ?></h6>
	
					<input
						type="hidden"
						id="vin"
						name="vin"
						value="<?php echo $vin; ?>"
					>

					<input
						type="hidden"
						id="email"
						name="email"
						value="<?php echo $email; ?>"
					>

					<input
						type="password"
						id="password"
						name="password"
						class="form-control mb-4"
						value=""
					>

					<button class="btn btn-primary w-100">Login</button>
				</form>
			
			<?php else: ?>
				
				<?php if ($paid == true): ?>
	
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
					
				<?php else: ?>
	
					<h1>Not paid for. Something went wrong.</h1>
	
				<?php endif; ?>
	
			<?php endif; ?>
	
		</div>

	<?php endif; ?>

</div>

<!-- [FOOTER] -->
<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>

</body>
</html>

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


<!-- [SCRIPT] ------------------------------------------------------->
