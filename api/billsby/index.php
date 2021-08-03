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
	
	public function createCustomerAndSubscription() {}
	
}