<?php
// [INIT] //
$email = '';
$v_code = '';


// [GET-VALUES] //
if (empty($_GET['email'])) { $error = "Please enter email"; }
else {
	$email = trim($_GET["email"]);

	// [SANITIZE] //
	$email = filter_var($email, FILTER_SANITIZE_STRING);
}


// [GET-VALUES] //
if (empty($_GET['email'])) { $error = "Please enter email"; }
else {
	$email = trim($_GET["email"]);

	// [SANITIZE] //
	$v_code = filter_var($v_code, FILTER_SANITIZE_STRING);
}


// Check if email is empty
if (empty($error)) {

}