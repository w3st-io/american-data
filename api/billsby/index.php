<?php
/* User Object Definition */
class BillsBy {
	private $_mysqli;

	public function __construct($mysqli=NULL) {
		if (is_object($mysqli)) { $this->_mysqli = $mysqli; }
		else {
			$this->_mysqli = new MySQLi(
				'localhost',
				'root',
				'',
				'vin_vehicles'
			);

			// [ERROR] //
			if ($this->_mysqli->connect_error) {
				echo
					'Conn. Error: #' .
					$this->_mysqli->connect_errno .
					': ' .
					$this->_mysqli->connect_error
				;
				
				exit(0);
			}
		}
	}
	
	public function createCustomerAndSubscription($firstName) {
		// [INIT] //
		//$payloadData['firstName'] = $firstName;
		//$payloadData['lastName'] = $lastName;
		//$payloadData['email'] = $email;
		//$payloadData['cycleId'] = $cycleId;
		//$payloadData['Units'] = $Units;
		
		$payloadData['address']['addressLine1'] = '123 main st.';
		$payloadData['address']['state'] = 'ny';
		$payloadData['address']['city'] = 'new york';
		$payloadData['address']['country'] = 'USA';
		$payloadData['address']['postCode'] = '012345';

		$payloadData['cardDetails']['fullName'] = '';
		$payloadData['cardDetails']['paymentCardToken'] = '';
		$payloadData['cardDetails']['expiryMonth'] = '';
		$payloadData['cardDetails']['expiryYear'] = '';
		$payloadData['cardDetails']['cardType'] = '';
		$payloadData['cardDetails']['last4Digits'] = '';

		echo $payloadData['address']['state'];
		echo $payloadData['address']['city'];

		// [PAYLOAD] //
		$payload = json_encode($payloadData);


		// [CURL][INIT] //
		$curl = curl_init(
			'https://public.billsby.com/api/v1/rest/core/usadata/subscriptions'
		);
	}
}