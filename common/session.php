<?php
$loggedin = false;

if (isset($_SESSION)) {
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		$loggedin = true;
	}
}
else {
	// [INIT] session //
	session_start();
}