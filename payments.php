<?php
	// [INCLUDE] //
	include('./common/session.php');
	include('connection.php');
	

	// [INIT] //
	$vin = '';
	$error = '';
	
	
	// [POST] //
	if (isset($_GET['vin'])) { $vin = strip_tags($_GET['vin']); }
	if (isset($_GET['error'])) { $error = strip_tags($_GET['error']); }
?>


<!-- [HTML] ------------------------------------------------------->
<?php include('header.php'); ?>


<!-- [PHP][REDIRECT] USER LOGGED -->
<?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>

	<form id="myForm" action="./payments-loggedin.php" method="post">
		<!-- [INPUT][HIDDEN] vin -->
		<input
			type="hidden"
			id="vin"
			name="vin"
			value="<?php echo $vin; ?>"
		>
	</form>

	<script type="text/javascript">
		document.getElementById('myForm').submit();
	</script>

<?php endif; ?>


<style type="text/css" media="screen">
	button#bcPaint-export,
	button#bcPaint-reset {
		display: none;
		visibility: hidden;
	}
</style>


<!-- [SPACER] -->
<section class="w3l-about-breadcrumb position-relative text-center">
	<div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4"></div>
</section>


<div class="container">
	<section class="w3l-content-6 checkout">
		<div class="content-info-in row">

			<!-- Col lg 3 -->
			<div class="col-lg-3">
				<img
					src="assets/images/checkoutrefundleft.png"
					style="margin-bottom: 20px;"
					class="img-fluid d-none d-lg-block"
				>
				<img src="assets/images/ab1.jpg" class="d-none d-lg-block img-fluid">
			</div>


			<!-- Col lg 6 -->
			<div class="col-lg-6 mt-lg-0 mt-5 about-right-faq align-self  pl-lg-4">
				<h6 class="mb-3 sub-title text-primary">
					$1 Vehicle Pre-Purchase Essentials Report for VIN:
					<br><b><?php echo $vin ?></b>
				</h6>

				<div class="title-content text-left mb-2">
					<h2>
						<span style="color: skyblue;">Payment Information</span>
						<span class="blue"></span>
					</h2>
				</div>
				<hr>
	
				<!-- [FORM] -->
				<form
					onsubmit="submitPaymentForm();"
					action="./payments-process.php"
					method="POST"
				>					
					<div class="row">
						<!-- vin -->
						<div class="col-12">
							<input
								type="hidden"
								id="vin"
								name="vin"
								value="<?php echo $vin; ?>"
							>
						</div>

						<!-- Email -->
						<div class="col-12">
							<label for="email">Email</label>
							<input
								type="email"
								id="email"
								name="email"
								placeholder="example@example.com"
								value=""
								class="form-control"
								required
							>
						</div>

						<!-- street -->
						<div class="col-12">
							<label for="street">Street</label>
							<input
								type="input"
								id="street"
								name="street"
								value=""
								placeholder="123 main st."
								class="form-control"
								required
							>
						</div>

						<!-- city -->
						<div class="col-12 col-md-5">
							<label for="city">City</label>
							<input
								type="input"
								id="city"
								name="city"
								placeholder="new york"
								value=""
								class="form-control"
								required
							>
						</div>

						<!-- state -->
						<div class="col-12 col-md-4">
							<label for="state">State</label>
							<select name="state" id="state" class="form-control form-select">
								<option selected disabled hidden>Select State</option>
								<option value="AL">Alabama</option>
								<option value="AK">Alaska</option>
								<option value="AZ">Arizona</option>
								<option value="AR">Arkansas</option>
								<option value="CA">California</option>
								<option value="CO">Colorado</option>
								<option value="CT">Connecticut</option>
								<option value="DE">Delaware</option>
								<option value="DC">District Of Columbia</option>
								<option value="FL">Florida</option>
								<option value="GA">Georgia</option>
								<option value="HI">Hawaii</option>
								<option value="ID">Idaho</option>
								<option value="IL">Illinois</option>
								<option value="IN">Indiana</option>
								<option value="IA">Iowa</option>
								<option value="KS">Kansas</option>
								<option value="KY">Kentucky</option>
								<option value="LA">Louisiana</option>
								<option value="ME">Maine</option>
								<option value="MD">Maryland</option>
								<option value="MA">Massachusetts</option>
								<option value="MI">Michigan</option>
								<option value="MN">Minnesota</option>
								<option value="MS">Mississippi</option>
								<option value="MO">Missouri</option>
								<option value="MT">Montana</option>
								<option value="NE">Nebraska</option>
								<option value="NV">Nevada</option>
								<option value="NH">New Hampshire</option>
								<option value="NJ">New Jersey</option>
								<option value="NM">New Mexico</option>
								<option value="NY">New York</option>
								<option value="NC">North Carolina</option>
								<option value="ND">North Dakota</option>
								<option value="OH">Ohio</option>
								<option value="OK">Oklahoma</option>
								<option value="OR">Oregon</option>
								<option value="PA">Pennsylvania</option>
								<option value="RI">Rhode Island</option>
								<option value="SC">South Carolina</option>
								<option value="SD">South Dakota</option>
								<option value="TN">Tennessee</option>
								<option value="TX">Texas</option>
								<option value="UT">Utah</option>
								<option value="VT">Vermont</option>
								<option value="VA">Virginia</option>
								<option value="WA">Washington</option>
								<option value="WV">West Virginia</option>
								<option value="WI">Wisconsin</option>
								<option value="WY">Wyoming</option>
							</select>
						</div>

						<!-- zip -->
						<div class="col-12 col-md-3">
							<label for="zip">Zip</label>
							<input
								type="input"
								id="zip"
								name="zip"
								value=""
								class="form-control"
								required
							>
						</div>

						<!-- phone -->
						<div class="col-12">
							<label for="phone">Phone Number</label>
							<input
								type="input"
								id="phone"
								name="phone"
								class="form-control"
								placeholder="123 456 7890"
								value=""
								required
							>
						</div>

						<hr class="border-secondary" />

						<!-- card_name -->
						<div class="col-12">
							<label for="card_name">Name on Card</label>
							<input
								type="text"
								name="card_name"
								id="card_name"
								placeholder="John Doe"
								class="form-control"
								required
							>
						</div>

						<!-- card_number -->
						<div class="col-12">
							<label for="card_number">Credit Card Number</label>
							<input
								type="text"
								id="card_number"
								name="card_number"
								class="form-control"
								required
							>
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
							<input
								type="text"
								id="card_cvv"
								name="card_cvv"
								class="form-control"
								required
							>
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
						
						<?php if($error != ''): ?>
							
							<div class="col-12">
								<h4 class="text-danger mb-3">
									<?php echo $error; ?>
								</h4>
							</div>

						<?php endif; ?>

						<div class="col-12">
							<!-- [SUBMIT] -->
							<button
								id=""
								type="submit"
								class="btn btn-primary w-100 mb-3"
							>Pay Now</button>
							<p style="margin-top:10px">
								By typing your name and clicking "pay now", that will constitute your electronic signature. This is your written authorization to charge your account, and agreement to be bound by our terms of use, and privacy policy.
							</p>
						</div>

					</div>
				</form>
			</div>

			
			<!-- Col lg 3 -->
			<div class="col-lg-3">
				<img src="assets/images/placecheckoutonright.png" class="img-fluid">
			</div>
		</div>
	</section>

</div>

<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>


<!-- [SCRIPT] ------------------------------------------------------->
<!-- [REQUIRE] -->
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"
	type="text/javascript"
	charset="utf-8"
	async
	defer
></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"
></script>

<!-- [REQUIRE] Personal -->
<script type="text/javascript" src="resources/js/bcPaint.js"></script>


<!-- [INIT] -->
<script>
	// [FORMAT] This sets the template for the input fields //
	$('#zip').mask('99999')
	$('#phone').mask('999 999 9999')
	$('#card_number').mask('9999 9999 9999 9999')
	$('#card_cvv').mask('999')
	$('#card_exp_month').mask('99')
	$('#card_exp_year').mask('9999')
	
	// [SIGNATURE] Set color //
	$('#bcPaint').bcPaint({ defaultColor : '000000' })
</script>

<!-- [SUBMIT] -->
<script>
	async function submitPaymentForm() {
		// Set Value for Signature
		let sign = document.getElementById('bcPaintCanvas').toDataURL('image/png')
		document.getElementById('sign').value = sign

		return true
	}
</script>
</body>
</html>