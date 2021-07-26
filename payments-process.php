<?php
// [REQUIRE] Personal //
include('./connection.php');


// [INIT] //
$payment_method_token = $_POST['payment_method_token'];
$card_number_val = $_POST['card_number_val'];
$email = $_POST['email'];
$card_name = $_POST['card_name'];
$card_exp_month = $_POST['card_exp_month'];
$card_exp_year = $_POST['card_exp_year'];
$sign = $_POST['sign'];

echo $card_number_val;

// [SANTIZE] //
echo '<h2>Email: '.filter_var($email, FILTER_SANITIZE_STRING).'</h2>';
echo '<h2>Card Name: '.filter_var($card_name, FILTER_SANITIZE_STRING).'</h2>';
echo '<h2>Payment Token: '.filter_var($payment_method_token, FILTER_SANITIZE_STRING).'</h2>';
echo '<p>signature: ' . $sign . '</p>';


// [REQUEST][BILLSBY] //


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