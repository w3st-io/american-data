<?php
	// [INCLUDE] //
	include('./common/session.php');
?>

<!-- [HTML] -->
<?php include('header.php'); ?>
 

<!-- [SPACER] -->
<section class="w3l-about-breadcrumb position-relative text-center">
	<div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4"></div>
</section>


<div class="container">
	<div class="card card-body my-5 shadow">
		<h2><?php echo $_SESSION['email']; ?></h2>
		<hr>
		<a href="./loggout.php">
			<button class="btn btn-primary w-100">Loggout</button>
		</a>
	</div>
</div>


<?php include('footer.php'); ?>


<?php include('./common/bottom_script.php'); ?>
</body>
</html>