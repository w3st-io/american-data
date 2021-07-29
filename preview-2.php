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


<!-- Checkout -->
<section class="w3l-content-6 checkout">
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