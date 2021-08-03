<?php 
// [REQUIRE] Personal //
require('vendor/autoload.php');


// [USE] //
use Firebase\JWT\JWT;


// [JWT][TOKENIZE] payLaod //
$payload = array(
    "card_number" => 4242424242424242,
    "card_exp_month" => '12',
    "card_exp_year" => '2067',
    "card_cvv" => 123
);


// [JWT][ENCODE] //
$jwt = JWT::encode($payload, SECRET_JWT_KEY);
print_r($jwt);


// [JWT][DECODE] //
$decoded = JWT::decode($jwt, SECRET_JWT_KEY, array('HS256'));
print_r($decoded);