<?php
	// [INCLUDE] //
	include('./common/session.php');
	include('connection.php');
	
	if ($_SESSION['loggedin'] != true) { header('Location: ./login.php'); }
?>


<!-- [HTML] ------------------------------------------------------->
<?php include('header.php'); ?>

<!-- [SPACER] -->
<section class="w3l-about-breadcrumb position-relative text-center">
	<div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4"></div>
</section>


<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card card-body my-5 shadow">
				<div class="title-content text-left mb-2">
					<h2 class="text-center text-danger">Change Card</h2>
				</div>
				<hr>
	
				<!-- [FORM] -->
				<form
					onsubmit="submitPaymentForm();"
					action="./change-card-process.php"
					method="POST"
				>
					<div class="row">
						<!-- card_number -->
						<div class="col-12 mb-3">
							<label for="card_number">Credit Card Number</label>
							<input
								type="text"
								id="card_number"
								name="card_number"
								class="form-control"
								required
							>
						</div>
	
						<!-- card_exp_month -->
						<div class="col-12 col-md-4 mb-3">
							<label for="card_exp_month">Expiration Month</label>
							<input
								name="card_exp_month"
								id="card_exp_month"
								class="form-control"
								required
							/>
						</div>
	
						<!-- card_exp_year -->
						<div class="col-12 col-md-4 mb-3">
							<label for="card_exp_year">Expiration Year</label>
							<input
								name="card_exp_year"
								id="card_exp_year"
								class="form-control"
								required
							/>
						</div>
	
						<!-- CVV -->
						<div class="col-12 col-md-4 mb-4">
							<label for="card_cvv">CVV</label>
							<input
								type="text"
								id="card_cvv"
								name="card_cvv"
								class="form-control"
								required
							>
						</div>
						
						<div class="col-12">
							<!-- [SUBMIT] -->
							<button
								id=""
								type="submit"
								class="btn btn-primary w-100 mb-3"
							>Change Card</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
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