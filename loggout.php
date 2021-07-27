<?php
	if (!isset($_SESSION)) { session_start(); }

	echo 'Logging Out..';

	session_destroy();

	header('Location: ./');
?>