<?php 
// [INCLUDE] //
include('./config/index.php');


// [INTI] //
$conn = '';


// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}