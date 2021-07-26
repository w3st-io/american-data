<?php
$secretKey = 'secret';

//echo $_POST['email'];


$data['firstName'] = 'first name';


$payload = json_encode($data);


// [CURL] Initialize the curl request //
$cu = curl_init();


// [CURL][INIT] //
$ch = curl_init('https://public.billsby.com/api/v1/rest/core/usadata/customers');


curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);


// Set HTTP Header for POST request 
curl_setopt($ch, CURLOPT_HTTPHEADER,
	array(
		'ApiKey: usadata_0fa180de62a542bc84c85edbe69ad701',
		'Content-Type: application/json',
		'Content-Length: ' . strlen($payload)
	)
);


// Submit the POST request
$response = curl_exec($ch);


// [CURL] Store the Error //
$err = curl_error($cu);


// Close cURL session handle
curl_close($ch);


if ($err) {
	echo '<h1>Err</h1>';
	echo $err;
}
else {
	echo '<h1>Res</h1>';
	echo $response;
}