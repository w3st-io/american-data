<?php 
	include('header.php');
	include('connection.php');

	// [INIT] //
	$user_details;
	$f_name = '';
	$l_name = '';
	$city = '';
	$country = '';
	$postCode = '';
	$state = '';
	$addressLine1 = '';
	$addressLine2 = '';
	$paymentCardToken = '';
	$fullName = '';
	$expiryMonth = '';
	$expiryYear = '';
	$cardType = '';
	$last4Digits = '';
	$Useremail = '';
	$email = '';
	$vin = '';


	// [POST] //
	if (isset($_GET['emasil'])) { $email = strip_tags($_GET['email']); }
	if (isset($_GET['vin'])) { $vin = strip_tags($_GET['vin']); }


	// [READ] user // 
	/*
	$query = $conn->prepare("SELECT * FROM `users` WHERE `email` = ?");
	$query->bindValue(1, $email);
	$query->execute();

	# If rows are found for query
	if($query->rowCount() > 0) {
		$status = 1;
		$user_details = $query->fetch();

		$f_name = $user_details['f_name'];
		$l_name = $user_details['l_name'];
		$city = $user_details['city'];
		$country = $user_details['country'];
		$postCode = $user_details['postCode'];
		$state = $user_details['state'];
		$addressLine1 = $user_details['addressLine1'];
		$addressLine2 = $user_details['addressLine2'];
		$paymentCardToken = $user_details['paymentCardToken'];
		$fullName = $user_details['fullName'];
		$expiryMonth = $user_details['expiryMonth'];
		$expiryYear = $user_details['expiryYear'];
		$cardType = $user_details['cardType'];
		$last4Digits = $user_details['last4Digits'];
		$Useremail = $user_details['Useremail'];
	}
	else { $status = 0; }
	*/
?>

<style type="text/css" media="screen">
	button#bcPaint-export,
	button#bcPaint-reset {
		display: none;
		visibility: hidden;
	}
</style>

<!-- about breadcrumb -->
<section class="w3l-about-breadcrumb position-relative text-center">
	<div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4"></div>
</section>


<!-- //about breadcrumb -->
<!-- /content-6-->
<section class="w3l-content-6 checkout">
	<div class="container">
		<div class="content-info-in row">
			<!-- [IMG] Col lg 3 -->
			<div class="col-lg-3">
				<img
					src="assets/images/checkoutrefundleft.png"
					style="margin-bottom: 20px;"
					class="img-fluid"
				>
				<img src="assets/images/ab1.jpg" class="img-fluid">
			</div>


			<!-- Col 6 -->
			<div class="col-lg-6 mt-lg-0 mt-5 about-right-faq align-self  pl-lg-4">
				<!-- PHP -- NO USER FOUND -->
				<?php if (empty($user_details)): ?>

				<h6 class="mb-3 sub-title text-primary">
					$1 Vehicle Pre-Purchase Essentials Report for VIN:
					<br><b><?php echo $vin ?></b>
				</h6>

				<div class="title-content text-left mb-2">
					<h2>
						<span style="color: skyblue;">Payment Information</span>
						<span class="blue"> </span>
					</h2>
				</div>
				<hr>
	
				<!-- [FORM] billsby -->
				<form
					id="payment-form"
					action="./payments-process.php"
					onsubmit="submitPaymentForm(); return false;"
					method="POST"
				>
					<!-- [HIDDEN] Billsby token -->
					<input
						type="hidden"
						name="payment_method_token"
						id="payment_method_token"
					>

					<div class="row">
						<!-- Email -->
						<div class="col-12">
							<label for="email">Email</label>
							<input
								type="email"
								id="email"
								class="form-control"
								name="email"
								value="<?php echo $email; ?>"
								required
							>
						</div>

						<!-- Name -->
						<div class="col-12">
							<label for="card_name">Name on Card</label>
							<input
								type="text"
								name="card_name"
								id="card_name"
								class="form-control"
								required
							>
						</div>

						<!-- Credit Card -->
						<div class="col-12">
							<label for="card_number">Credit Card Number</label>
							<div
								id="billsby-number"
								class="w-100 form-control"
								style="height:35px; border: 2px solid"
							></div>
						</div>

						<div class="col-12 col-md-4">
							<!-- card_exp_month -->
							<label for="card_exp_month">Expiration Month</label>
							<input
								name="card_exp_month"
								id="card_exp_month"
								class="form-control"
								required
							/>
						</div>

						<div class="col-12 col-md-4">
							<!-- card_exp_year -->
							<label for="card_exp_year">Expiration Year</label>
							<input
								name="card_exp_year"
								id="card_exp_year"
								class="form-control"
								required
							/>
						</div>

						<!-- CVV -->
						<div class="col-12 col-md-4">
							<label for="card_cvv">CVV</label>
							<div
								id="billsby-cvv"
								class="form-control w-100"
								style="height:35px; border: 2px solid "
							></div>
						</div>

						<!-- sign -->
						<div class="col-12">
							<div class="signature-wrap my-3 w-100">
								<small>Please draw your signature with your mouse in the white box below</small>

								<!-- BCPAINT INSERT -->
								<div id="bcPaint"></div>
							</div>
							
							<input
								type="hidden"
								name="sign"
								id="sign"
								value=""
							/>
						</div>
						
						<div id="errorDiv" class="col-12 text-danger"></div>
						

						<div class="col-12">
							<!-- [SUBMIT] -->
							<button id="" type="submit" class="btn btn-primary w-100 mb-3">Pay Now</button>
							<p style="margin-top:10px">
								By typing your name and clicking "pay now", that will constitute your electronic signature. This is your written authorization to charge your account, and agreement to be bound by our terms of use, and privacy policy.
							</p>
						</div>
					</div>
				</form>

				<!-- PHP -- USER FOUND -->
				<?php else: ?>

				<div class="title-content text-left mb-2">
					<h2>
						<span style="color: skyblue;">Login</span><span class="blue"></span>
					</h2>
					<h6 class="sub-title">
						$1 Vehicle Pre-Purchase Essentials Report of <?php echo $_GET['vin'] ?>
					</h6>
				</div>

				<form action="completed.php" method="post" accept-charset="utf-8">
					<div class="loginform">
						<h4 style="margin-bottom: 20px;">You Already Have an account with us</h4>
						<input
							style="margin-bottom: 15px;"
							type="email"
							class="form-control"
							name="email"
							placeholder="email address"
							value="<?php echo $email; ?>"
						>
						<input
							style="margin-bottom: 15px;"
							type="text"
							class="form-control"
							name="user_id"
							placeholder="enter your billsby id"
						>
						<input
							type="hidden"
							name="vin"
							value="<?php echo $vin; ?>"
						>
						<input id="submit-button" class="btn btn-style btn-primary mt-4"  type="submit" value="Login & Complete">
					</div>
				</form>

				<!-- PHP -->
				<?php endif; ?>
			</div>

			
			<!-- Col 3 -->
			<div class="col-lg-3">
				<img src="assets/images/placecheckoutonright.png" class="img-fluid">
			</div>
		</div>
	</div>
</section>


<!-- Footer -->
<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>

<?php include('./common/PaymentsScripts.php'); ?>



<!-- [SCRIPT][INIT] -->
<script>
	// [FORMAT] This sets the template for the input fields //
	$('#card_exp_month').mask('99')
	$('#card_exp_year').mask('9999')
	
	// [SIGNATURE] Set color //
	$('#bcPaint').bcPaint({ defaultColor : '000000' })
</script>


<!-- [SCRIPT] -->
<script>
	billsbyTokens.init("billsby-number", "billsby-cvv");

	async function submitPaymentForm() {
		// [INIT] //
		var requiredFields = {};

		// Get required, non-sensitive, values from host page
		requiredFields['full_name'] = document.getElementById("card_name").value
		requiredFields['month'] = document.getElementById("card_exp_month").value
		requiredFields['year'] = document.getElementById("card_exp_year").value


		billsbyTokens.tokenizeCreditCard(requiredFields)


		// Set Value for Signature
		let sign = document.getElementById('bcPaintCanvas').toDataURL('image/png')
		let signElement = document.getElementById('sign')
		signElement.value = sign
	}


	// [BILLSBY] Ready //
	billsbyTokens.on('ready', function () {
		var submitButton = document.getElementById('submit-button')
		submitButton.disabled = false
	})


	// [BILLSBY] Recieve tokenized Payment Method //
	billsbyTokens.on('paymentMethod', function (token, pmData) {
		// Set the token in the hidden form field
		var tokenField = document.getElementById("payment_method_token")
		tokenField.setAttribute("value", token)

		// Submit the form
		var masterForm = document.getElementById('payment-form')
		masterForm.submit()
	})


	// [BILLSBY] Handle Error //
	billsbyTokens.on('errors', function (errors) {
		for (var i = 0; i < errors.length; i++) {
			let error = errors[i]

			let errorDivElement = document.getElementById('errorDiv')
			errorDivElement.innerHTML = error.message

			console.log('BillsBy Error', error)
		}
	})
</script>
</body>
</html>