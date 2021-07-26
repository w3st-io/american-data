<?php
// [REQUIRE] Personal //
include('./connection.php');


// [INIT] //
$payment_method_token = $_POST['payment_method_token'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$card_name = $_POST['card_name'];
$card_exp_month = $_POST['card_exp_month'];
$card_exp_year = $_POST['card_exp_year'];
$sign = $_POST['sign'];


// [SANTIZE] //
$email = filter_var($email, FILTER_SANITIZE_STRING);
$phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
$card_name = filter_var($card_name, FILTER_SANITIZE_STRING);
$payment_method_token = filter_var($payment_method_token, FILTER_SANITIZE_STRING);
$sign = filter_var($sign, FILTER_SANITIZE_STRING);
$phone = preg_replace( '/\d[ *]\d/', '', $phone);


// [PASSWORD] //
$password = substr($phone, -4);


// [ECHO] //
echo '<h2>Email: '.$email.'</h2>';
echo '<h2>Phone: '.$phone.'</h2>';
echo '<h2>Password: '.$password.'</h2>';
echo '<h2>Card Name: '.$card_name.'</h2>';
echo '<h2>Payment Method Token: '.$payment_method_token.'</h2>';
//echo '<h2>signature: '.$sign.'</h2>';


// [BILLSBY] //
// make request to api to charge and set subscription


// [DATABASE] prepare and bind //
$stmt = $conn->prepare(
	"INSERT INTO users (
		email,
		phone,
		password,
		billsby_token,
		sign
	)
	VALUES (?,?,?,?,?)"
);


// [BIND] //
$stmt->bind_param('sssss', $email, $phone, $password, $payment_method_token, $sign);


// [EXECUTE] //
$stmt->execute();


// [STATUS] //
if ($stmt->error) { printf('Database Error:', $stmt->error); }
else { printf('New records created successfully'); }


// [CLOSE] Query //
$stmt->close();


// [CLOSE] DB conn //
$conn->close();