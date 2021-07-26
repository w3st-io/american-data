<?php
// [REQUIRE] Personal //
require_once('./api/billsby/index.php');

// [INCLUDE] //
include('./connection.php');


$BillsBy = new BillsBy();

// [INIT] //
$payment_method_token = $_POST['payment_method_token'];
$full_name = $_POST['full_name'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone = $_POST['phone'];
$card_name = $_POST['card_name'];
$last_four_digits = $_POST['last_four_digits'];
$card_exp_month = $_POST['card_exp_month'];
$card_exp_year = $_POST['card_exp_year'];
$card_type = $_POST['card_type'];
$sign = $_POST['sign'];


// [SANTIZE] //
$payment_method_token = filter_var($payment_method_token, FILTER_SANITIZE_STRING);
$full_name = filter_var($full_name, FILTER_SANITIZE_STRING);
$first_name = filter_var($first_name, FILTER_SANITIZE_STRING);
$last_name = filter_var($last_name, FILTER_SANITIZE_STRING);
$email = filter_var($email, FILTER_SANITIZE_STRING);
$phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
$phone = preg_replace( '/\d[ *]\d/', '', $phone);
$card_name = filter_var($card_name, FILTER_SANITIZE_STRING);
$last_four_digits = filter_var($last_four_digits, FILTER_SANITIZE_NUMBER_INT);
$card_exp_month = filter_var($card_exp_month, FILTER_SANITIZE_NUMBER_INT);
$card_exp_year = filter_var($card_exp_year, FILTER_SANITIZE_NUMBER_INT);
$card_type = filter_var($card_type, FILTER_SANITIZE_STRING);
$sign = filter_var($sign, FILTER_SANITIZE_STRING);


// [PASSWORD] //
$password = substr($phone, -4);


// [ECHO] //
echo '<h2>payment_method_token: '.$payment_method_token.'</h2>';
echo '<h2>full_name: '.$full_name.'</h2>';
echo '<h2>first_name: '.$first_name.'</h2>';
echo '<h2>last_name: '.$last_name.'</h2>';
echo '<h2>email: '.$email.'</h2>';
echo '<h2>phone: '.$phone.'</h2>';
echo '<h2>card_name: '.$card_name.'</h2>';
echo '<h2>last_four_digits: '.$last_four_digits.'</h2>';
echo '<h2>card_exp_month: '.$card_exp_month.'</h2>';
echo '<h2>card_exp_year: '.$card_exp_year.'</h2>';
echo '<h2>card_type: '.$card_type.'</h2>';
echo '<h2>password: '.$password.'</h2>';
//echo '<h2>signature: '.$sign.'</h2>';


// [BILLSBY] //
// make request to api to charge and set subscription
$BillsBy->createCustomerAndSubscription('s');


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