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

	<?php if ($error): ?>

		<div class="alert alert-danger mb-3 shadow">
			<h4 class="text-danger"><?php echo $error; ?></h4>
		</div>
	
	<?php else: ?>
		
		<section class="w3l-content-6 checkout">
			<div class="content-info-in row">

				<!-- Col lg 3 -->
				<div class="col-lg-3">
					<img
						src="assets/images/checkoutrefundleft.png"
						style="margin-bottom: 20px;"
						class="img-fluid"
					>
					<img src="assets/images/ab1.jpg" class="img-fluid">
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
									value=""
									required
								>
							</div>

							<!-- card_name -->
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

	<?php endif; ?>

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
		let emailElement = document.getElementById('email')
		let phoneElement = document.getElementById('phone')
		let cardNameElement = document.getElementById('card_name')
		let cardNumberElement = document.getElementById('card_number')
		let cardExpMonthElement = document.getElementById('card_exp_month')
		let cardExpYearElement = document.getElementById('card_exp_year')
		let cardCvvElement = document.getElementById('card_cvv')

		return true
	}
</script>
</body>
</html>