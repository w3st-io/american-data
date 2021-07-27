<?php
	$_SESSION['loggedin'] = false;
	$_SESSION['id'] = null;
	$_SESSION['email'] = null;

	session_destroy();

	header('Location: ./');
?>