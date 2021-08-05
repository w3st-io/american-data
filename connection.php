<?php 
// [INCLUDE] //
include_once('config/index.php');


// [INTI] //
$conn = '';


// Create connection
$conn = new mysqli(DB_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);


// Check connection
if ($conn->connect_error) { die('Connection failed: ' . $conn->connect_error); }