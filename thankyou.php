<?php include('header.php'); ?>
<?php include('connection.php'); ?>


<style type="text/css" media="screen">
	.badge.badge-error.bg-primary {
		background-color: red !important;
		font-size: 16px;
		padding: 10px 20px;
		color: #fff !important;
		display: block;
		text-align: center;
	}

	.badge.badge-error.bg-primary p {
		color: #fff;
	}

	a.link {
		border-bottom: 1px solid black;
	}
</style>


<!-- about breadcrumb --> 
<section class="w3l-about-breadcrumb position-relative text-center">
	<div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4">
		<div class="container py-lg-5 py-3">
		</div>
	</div>
</section>


<!-- /content-6-->
<section class="w3l-content-6 report-section">
	<div class="container">
		<div class="content-info-in row">
			<div class="col-lg-6">
				<img src="assets/images/ab1.jpg" alt="" class="img-fluid">
			</div>

			<div class="col-lg-6 mt-lg-0 mt-5 about-right-faq align-self  pl-lg-4">
				<div class="title-content text-left mb-2">
					<h1 class="title text-center text-danger">Thank You for Your Order..</h1>
					<p class="text-center">Please wait while we redirect you to the downloads page</p>
				</div>
			</div>
		</div>
	</div>
</section>


<?php include('./components/Contact.php'); ?>

<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>
</body>
</html>