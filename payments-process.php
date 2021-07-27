<?php
// [REQUIRE] Personal //
require_once('./api/billsby/index.php');
require_once('./api/stripe/index.php');



// [INCLUDE] //
include('./connection.php');



// [STRIPE] //
$StripeWrapper = new StripeWrapper();



// [INIT] //
$email = $_POST['email'];

$phone = $_POST['phone'];

$card_name = $_POST['card_name'];

$card_number = $_POST['card_number'];

$card_exp_month = $_POST['card_exp_month'];

$card_exp_year = $_POST['card_exp_year'];

$card_cvv = $_POST['card_cvv'];

$sign = $_POST['sign'];



// [SANTIZE] //
$email = filter_var($email, FILTER_SANITIZE_STRING);

$phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
$phone = preg_replace( '/\d[ *]\d/', '', $phone);

$card_name = filter_var($card_name, FILTER_SANITIZE_STRING);

$card_number = filter_var($card_number, FILTER_SANITIZE_NUMBER_INT);
$card_number = preg_replace( '/\d[ *]\d/', '', $card_number);

$card_exp_month = filter_var($card_exp_month, FILTER_SANITIZE_NUMBER_INT);

$card_exp_year = filter_var($card_exp_year, FILTER_SANITIZE_NUMBER_INT);

$card_cvv = filter_var($card_cvv, FILTER_SANITIZE_NUMBER_INT);

$sign = filter_var($sign, FILTER_SANITIZE_STRING);



// [PASSWORD] //
$password = substr($phone, -4);



// [STRIPE] //
$tokenObj = $StripeWrapper->createPaymentMethod(
	$card_number,
	$card_exp_month,
	$card_exp_year,
	$card_cvv,
);


// [STRIPE] Create Customer //
$customerObj = $StripeWrapper->createCustomer($email, $phone, $tokenObj['id']);


// [STRIPE] Charge Customer
$customerObj = $StripeWrapper->createOneDollarCharge($customerObj['id']);


/*
// [DATABASE] prepare and bind //
$stmt = $conn->prepare(
	"INSERT INTO users (
		email,
		phone,
		password,
		sign,
		stripe_customer_token,
		payment_jwt,
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
*/



// [ECHO] //
echo '<h2>email: '.$email.'</h2>';
echo '<h2>phone: '.$phone.'</h2>';
echo '<h2>card_name: '.$card_name.'</h2>';
echo '<h2>card_number: '.$card_number.'</h2>';
echo '<h2>card_exp_month: '.$card_exp_month.'</h2>';
echo '<h2>card_exp_year: '.$card_exp_year.'</h2>';
echo '<h2>card_cvv: '.$card_cvv.'</h2>';
echo '<h2>password: '.$password.'</h2>';
//echo '<h2>signature: '.$sign.'</h2>';
echo '<h2>tokenObj: '.$tokenObj.'</h2>';