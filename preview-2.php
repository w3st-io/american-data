<?php
	// [INCLUDE] //
	include('./common/session.php');
?>


<!-- [HTML] ------------------------------------------------------->
<?php include('header.php'); ?>

<!-- [INPUT] Hidden -->
<input type="hidden" id="vin" value="<?php echo $_GET['vin'] ?>">


<!-- [SPACER] -->
<section class="w3l-about-breadcrumb position-relative text-center">
	<div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4"></div>
</section>


<!-- Loading -->
<div id="loading-section" class="container my-5">
	<div class="card card-body shadow">
		<h1 class="mb-3 text-center font-weight-light text-danger">
			We Are Generating Your Report..
		</h1>

		<h4 id="loading" class="text-center text-warning font-weight-light">
			Loading...
		</h4>
		<br>

		<div class="bar">
			<div class="progress"></div>
		</div>
		<div class="text-center font-weight-light small percentage"></div>
	</div>
</div>


<!-- Checkout -->
<section id="checkout-section" class="w3l-content-6 checkout d-none">
	<div class="container">
		<div class="content-info-in loading row">
			<!-- [IMG] col lg 3 -->
			<div class="col-lg-3">
				<div class="image-banner">
					<img
						src="assets/images/checkoutrefundleft.png"
						alt=""
						class="img-fluid"
						style="margin-bottom: 20px;"
					>
					<img src="assets/images/ab1.jpg" alt="" class="img-fluid">
				</div>
			</div>


			<!-- [MAIN] Col 6 -->
			<div class="col-lg-6 mt-lg-0 mt-5 pl-lg-4 about-right-faq align-self">
				<!-- [COMPONENTS] -->
				<?php include('./components/preview-2/BuyWithConfidence.php'); ?>

				<!-- [DISPLAY] Your Vin Number Here -->
				<h5 class="mb-3 text-secondary">
					Your Vin Number: <?php echo $_GET['vin']; ?>
				</h3>


				<?php if ($loggedin): ?>
				
					<!-- [SUBMIT] -->
					<a href="./payments-loggedin.php?vin=<?php echo $_GET['vin']; ?>">
						<button
							type="submit"
							class="btn btn-primary w-100 mb-3"
						>Proceed to Checkout</button>
					</a>

				<?php else: ?>
				
					<!-- [SUBMIT] -->
					<a href="./payments.php?vin=<?php echo $_GET['vin']; ?>">
						<button
							type="submit"
							class="btn btn-primary w-100 mb-3"
						>Proceed to Checkout</button>
					</a>

				<?php endif; ?>

			</div>

			
			<!-- [IMG] Col 3 -->
			<div class="col-lg-3">
				<img src="assets/images/placecheckoutonright.png" class="img-fluid">
			</div>
		</div>
	</div>
</section>

<!-- [FOOTER] -->
<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>


<!-- [SCRIPT] ------------------------------------------------------->
</body>
</html>

<!-- [LOADING-BAR] -->
<style>
	.bar {
		background: silver;
		border-radius: 30px;
		margin: 0 0 10px;
		width: 100%;
		height: 2px;
		overflow: hidden;
		position: relative;
	}

	.progress {
		background: #568259;
		position: absolute;
		top: 0;
		left: 0;
		height: 100%;
		transition: 0.1s;
	}

	.percentage:after { content: "%"; }
</style>


<!-- [LOADING-BAR] -->
<script>
	function check_percentage() {
		let percentage = document.querySelector('.percentage')
		let percentageValue =  +percentage.textContent
		let title = document.querySelector('#loading')
		
		setTimeout(function () {
			if (percentageValue < 100) { update_percentage() }
			else {
				percentage.textContent = 100;  
				title.textContent = 'Done!'
				title.classList.add('text-success')

				document.getElementById('loading-section').classList.add('d-none')
				document.getElementById('checkout-section').classList.add('d-block')
			}
		}, 100)
	}

	function update_percentage() {   
		let percentage = document.querySelector('.percentage')
		let percentageValue =  +percentage.textContent
		let progress = document.querySelector('.progress')
		
		percentage.textContent = percentageValue + Math.ceil(Math.random() * .5)
		progress.setAttribute(
			'style',
			`width: ${percentageValue + Math.ceil(Math.random() * .5)}%`
		)
		
		check_percentage()
	}

	check_percentage()
</script>