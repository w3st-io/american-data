<?php
// Include config file
require_once "connection.php";


// [INIT] //
$username = '';
$password = '';
$username_err = '';
$password_err = '';
$login_err = '';


// Initialize the session
session_start();
 

// [USER-LOGGED] redirect to welcome page //
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	header("location: welcome.php");
	exit;
}

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
	// Check if username is empty
	if (empty(trim($_POST["username"]))) {
		$username_err = "Please enter username.";
	}
	else { $username = trim($_POST["username"]); }
    

	// Check if password is empty
	if(empty(trim($_POST["password"]))){
		$password_err = "Please enter your password.";
	}
	else { $password = trim($_POST["password"]); }
	

	// [VALIDATE] credentials //
	if(empty($username_err) && empty($password_err)) {
		// Prepare a select statement
		$sql = "SELECT id, username, password FROM users WHERE username = ?";
		
		if ($stmt = $conn->prepare($sql)) {
			// Bind variables to the prepared statement as parameters
			$stmt->bind_param('s', $param_username);
			
			// Set parameters
			$param_username = $username;
			
			// Attempt to execute the prepared statement
			if ($stmt->execute()) {
				// Store result
				$stmt->store_result();
				
				// Check if username exists, if yes then verify password
				if ($stmt->num_rows == 1) {                    
					// Bind result variables
					$stmt->bind_result($id, $username, $hashed_password);

					if ($stmt->fetch()) {
						if (password_verify($password, $hashed_password)) {
							// Password is correct, so start a new session
							session_start();
							
							// Store data in session variables
							$_SESSION["loggedin"] = true;
							$_SESSION["id"] = $id;
							$_SESSION["username"] = $username;                            
							
							// Redirect user to welcome page
							header("location: welcome.php");
						}
						else {
							// Password is not valid, display a generic error message
							$login_err = "Invalid username or password.";
						}
					}
				}
				else {
					// Username doesn't exist, display a generic error message
					$login_err = "Invalid username or password.";
				}
			}
			else { echo "Oops! Something went wrong. Please try again later."; }
			
			
			// Close statement
			$stmt->close();
		}
	}
    
	// Close connection
	$conn->close();
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
	
		<?php 
			if (!empty($login_err)) {
				echo '<div class="alert alert-danger">' . $login_err . '</div>';
			}        
		?>
	
		<form
			action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
			method="post"
		>
			<div class="form-group">
				<!-- Username -->
				<label>Username</label>
				<input
					type="text"
					name="username"
					class="
						form-control
						<?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>
					"
					value="<?php echo $username; ?>"
				>
				<span class="invalid-feedback"><?php echo $username_err; ?></span>
			</div>
	
			<div class="form-group">
					<!-- Password -->
					<label>Password</label>
					<input
						type="password"
						name="password"
						class="
							form-control
							<?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>
						"
					>
					<span class="invalid-feedback"><?php echo $password_err; ?></span>
			</div>
	
			<div class="form-group">
				<!-- Submit -->
				<input type="submit" class="btn btn-primary" value="Login">
			</div>
		</form>
	</div>
</div>

<!-- [FOOTER] -->
<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>
</body>
</html>