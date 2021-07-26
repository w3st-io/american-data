<?php 
// [REQUIRE] Personal //
require('vendor/autoload.php');


// [USE] //
use Firebase\JWT\JWT;


// [SECRET-KEY] //
$key = "C8CC568F258216230569C0F8C0BFA7060D2C6BF5F84DB7D4A3D1290638E6330B";


// [JWT][TOKENIZE] payLaod //
$payload = array(
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "iat" => 1356999524,
    "nbf" => 1357000000
);


// [JWT][ENCODE] //
$jwt = JWT::encode($payload, $key);
print_r($jwt);


// [JWT][DECODE] //
$decoded = JWT::decode($jwt, $key, array('HS256'));
print_r($decoded);