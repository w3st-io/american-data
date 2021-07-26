<?php
// [REQUIRE] Personal //
include('./connection.php');
require('./vendor/autoload.php');


// [USE] //
use Firebase\JWT\JWT;


// [INIT] Const //
$secret_key = 'a94aff7b17ec0e7284c2aaf348af7a957f42a0e4b11ffe56f6d16bb4186fd782';


// [INIT] //
$email = $_POST['email'];
$card_name = $_POST['card_name'];
$card_number = $_POST['card_number'];
$card_exp_month = $_POST['card_exp_month'];
$card_exp_year = $_POST['card_exp_year'];
$card_cvv = $_POST['card_cvv'];
$sign = $_POST['sign'];


// [SANTIZE] //
ECHO filter_var($email, FILTER_SANITIZE_STRING);
ECHO filter_var($card_name, FILTER_SANITIZE_STRING);
ECHO filter_var($card_number, FILTER_SANITIZE_STRING);


// [REQUEST][BILLSBY] //



// [JWT][TOKENIZE] Card Data //
$payload = array(	
    "card_name" => $card_name,
    "card_number" => $card_number,
    "card_exp_month" => $card_exp_month,
	"card_exp_year" => $card_exp_year,
    "card_cvv" => $card_cvv
);


// [JWT][ENCODE] //
$jwt = JWT::encode($payload, $secret_key);


// [JWT][DECODE] //
$decoded = JWT::decode($jwt, $secret_key, array('HS256'));


// [DATABASER] prepare and bind //
$stmt = $conn->prepare(
	"INSERT INTO users (
		email,
		payment_jwt,
		sign
	)
	VALUES (?,?,?)"
);


// [BIND] //
$stmt->bind_param('sss', $email, $jwt, $sign);


// [EXECUTE] //
$stmt->execute();


echo 'New records created successfully';


// [CLOSE] Query //
$stmt->close();


// [CLOSE] DB conn //
$conn->close();