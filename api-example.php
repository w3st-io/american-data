<?php
$data['firstName'] = 'first name';


$payload = json_encode($data);


// [CURL][INIT] //
$curl = curl_init('https://public.billsby.com/api/v1/rest/core/usadata/customers');


curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLINFO_HEADER_OUT, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);


// Set HTTP Header for POST request 
curl_setopt($curl, CURLOPT_HTTPHEADER,
	array(
		'ApiKey: usadata_0fa180de62a542bc84c85edbe69ad701',
		'Content-Type: application/json',
		'Content-Length: ' . strlen($payload)
	)
);


// Submit the POST request
$response = curl_exec($curl);


// [CURL] Store the Error //
$err = curl_error($curl);


// Close cURL session handle
curl_close($curl);


if ($err) {
	echo '<h1>Err</h1>';
	echo $err;
}
else {
	echo '<h1>Res</h1>';
	echo $response;
}