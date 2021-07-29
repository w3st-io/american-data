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

<!-- [SPACER] -->
<section class="w3l-about-breadcrumb position-relative text-center">
	<div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4"></div>
</section>

<div class="container my-5 ">

	<!-- [ERROR] -->
	<?php if ($error): ?>

		<div class="alert alert-danger mb-3 shadow">
			<h4 class="text-danger"><?php echo $error; ?></h4>
		</div>

	<?php endif; ?>

	<!-- [MAIN] -->
	<div class="card card-body shadow">
		<h3 class="text-center text-dark">
			Which payment method would you like to use?
		</h3>
		<hr>

		<button class="btn btn-primary w-100">Default Card</button>
	</div>
</div>

<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>


<!-- [SCRIPT] ------------------------------------------------------->
</body>
</html>