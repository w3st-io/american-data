<?php 
// [REQUIRE] Personal //
require('vendor/autoload.php');


// [USE] //
use Firebase\JWT\JWT;


// [SECRET-KEY] //
$key = "a54b94bc3b94d6a330a859f37b9231e571a0f7966d2c44557e219ad7440c80ef4d2";


// [JWT][TOKENIZE] payLaod //
$payload = array(
    "card_number" => 4242424242424242,
    "card_exp_month" => '12',
    "card_exp_year" => '2067',
    "card_cvv" => 123
);


// [JWT][ENCODE] //
$jwt = JWT::encode($payload, $key);
print_r($jwt);


// [JWT][DECODE] //
$decoded = JWT::decode($jwt, $key, array('HS256'));
print_r($decoded);