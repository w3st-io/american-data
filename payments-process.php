<?php
// [REQUIRE] Personal //
include('./connection.php');


// [INIT] //
$payment_method_token = $_POST['payment_method_token'];
$email = $_POST['email'];
$card_name = $_POST['card_name'];
$card_exp_month = $_POST['card_exp_month'];
$card_exp_year = $_POST['card_exp_year'];
$sign = $_POST['sign'];


// [SANTIZE] //
$email = filter_var($email, FILTER_SANITIZE_STRING);
$card_name = filter_var($card_name, FILTER_SANITIZE_STRING);
$payment_method_token = filter_var($payment_method_token, FILTER_SANITIZE_STRING);
$sign = filter_var($sign, FILTER_SANITIZE_STRING);


// [ECHO] //
echo '<h2>Email: '.$email.'</h2>';
echo '<h2>Card Name: '.$card_name.'</h2>';
echo '<h2>Payment Method Token: '.$payment_method_token.'</h2>';
echo '<p>signature: ' . $sign . '</p>';


// [BILLSBY] //
// make request to api to charge and set subscription


// [DATABASER] prepare and bind //
$stmt = $conn->prepare(
	"INSERT INTO users (
		email,
		billsby_token,
		sign
		payment_jwt,
	)
	VALUES (?,?,?,?)"
);


// [BIND] //
$stmt->bind_param('ssss', $email, $payment_method_token, $sign, $jwt);


// [EXECUTE] //
$stmt->execute();


// [STATUS] //
if ($stmt->error) { printf('Database Error:', $stmt->error); }
else { printf('New records created successfully'); }


// [CLOSE] Query //
$stmt->close();


// [CLOSE] DB conn //
$conn->close();