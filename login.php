<?php
	// Include config file
	require_once "connection.php";


	// [INIT] //
	$email = '';
	$password = '';
	$username_err = '';
	$password_err = '';
	$error = '';


	// [POST-VALUE] //
	if (isset($_GET['email'])) { $email = strip_tags($_GET['email']); }
	if (isset($_GET['error'])) { $error = strip_tags($_GET['error']); }

	

	// [USER-LOGGED] redirect to welcome page //
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
		header("location: dashboard.php");
		exit;
	}
?>

<!-- [HTML] ------------------------------------------------------->
<?php include('header.php'); ?>


<!-- about breadcrumb -->
<section class="w3l-about-breadcrumb position-relative text-center">
	<div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4"></div>
</section>

<div class="container my-5">
	<div class="card card-body mx-auto shadow" style="max-width: 500px;">
		<h2>Login</h2>
		<p>Please fill in your credentials to login.</p>
	
		<form
			action="./login-redirect.php"
			method="POST"
		>
			<div class="form-group">
				<!-- Email -->
				<label>Email</label>
				<input
					type="text"
					name="email"
					class="form-control"
					value="<?php echo $email; ?>"
				>
			</div>
	
			<div class="form-group">
					<!-- Password -->
					<label>Password</label>
					<input
						type="password"
						name="password"
						class="form-control"
					>
			</div>
	
			<div class="form-group">
				<!-- Submit -->
				<input type="submit" class="btn btn-primary" value="Login">
			</div>
		</form>
	</div>

	<?php 
		if (!empty($error)) {
			echo
				'<div class="alert alert-danger mx-auto my-3" style="max-width: 500px;">'
					.$error.
				'</div>'
			;
		}        
	?>
</div>

<!-- [FOOTER] -->
<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>
</body>
</html>