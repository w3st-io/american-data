<?php 
// [INCLUDE] //
include_once('config/index.php');


// [INTI] //
$conn = '';


// Create connection
$conn = new mysqli(DB_HOST, DB_USER_, DB_PASSWORD_, DB_NAME_);


// Check connection
if ($conn->connect_error) { die('Connection failed: ' . $conn->connect_error); }