<?php
// [INCLUDE] //
	include('./common/session.php');
	include('connection.php');

	
	$vin = '';


	if (isset($_POST['vin'])) { $vin = strip_tags($_POST['vin']); }


	// [SANITIZE] //
	$vin = filter_var($vin, FILTER_SANITIZE_STRING);
?>

<!-- [HTML] ------------------------------------------------------->
<?php include('header.php'); ?>


<!-- [SPACER] -->
<section class="w3l-about-breadcrumb position-relative text-center">
	<div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4"></div>
</section>


<div class="container my-5 ">
	<div class="card card-body shadow">
		<h3 class="text-danger text-center">Invalid Login</h3>
		<hr>

		<a href="./payments.php?vin=<?php echo $vin; ?>">
			<button class="btn btn-primary w-100">Try Again</button>
		</a>

	</div>
</div>

<!-- [FOOTER] -->
<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>

</body>
</html>