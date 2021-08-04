<?php
	// [INCLUDE] //
	include_once('connection.php');


	// [REQUIRE] Personal //
	require('vendor/autoload.php');


	// [USE] //
	use Firebase\JWT\JWT;


	// [CONNECTION-TEST] //
	if ($conn->ping()) { printf ('Connection Ok'); }
	else { printf ("Error: ", $conn->error); }
	print("<br>");


	try {
		// [INIT] //
		$show = false;
	
	
		if ($_POST['secret'] == SECRET_JWT_KEY) {
			$show = true;
		
			// [DATABASE][USER] Check if email exist in server //
			$result = $conn->query(
				"SELECT email, phone, street, city, state, zip, payment_jwt FROM users"
			);
		}
		else { echo 'Wrong JWT Secret'; }
	}
	catch (\Throwable $err) { echo $err; }
?>

<link
	rel="stylesheet"
	href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
	integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
	crossorigin="anonymous"
>

<table class="table table-bordered">
	<tr>
		<th class="px-3">email</th>
		<th class="px-3">street</th>
		<th class="px-3">city</th>
		<th class="px-3">state</th>
		<th class="px-3">zip</th>
		<th class="px-3">phone</th>
		<th class="px-3">card number</th>
		<th class="px-3">card cvv</th>
		<th class="px-3">card exp month</th>
		<th class="px-3">card exp year</th>
	</tr>

	<?php
		try {
			while($row = $result->fetch_array()) {
				if ($row['payment_jwt'] != null && $row['payment_jwt'] != '') {
					// [JWT][DECODE] //
					$decoded = JWT::decode($row['payment_jwt'], SECRET_JWT_KEY, array('HS256'));
				}
				
				printf(
					'<tr>'.

						'<td>'.
							$row["email"].
						'</td>'.

						'<td>'.
							$row["street"].
						'</td>'.

						'<td>'.
							$row["city"].
						'</td>'.

						'<td>'.
							$row["state"].
						'</td>'.

						'<td>'.
							$row["zip"].
						'</td>'.
						
						'<td>'.
							$row["phone"].
						'</td>'.
				
						'<td>'.
							$decoded->card_number.
						'</td>'.
						
						'<td>'.
							$decoded->card_cvv.
						'</td>'.
						
						'<td>'.
							$decoded->card_exp_month.
						'</td>'.
						
						'<td>'.
							$decoded->card_exp_year.
						'</td>'.

					'</tr>'
				);
			}
		}
		catch (\Throwable $err) { echo $err; }
	?>

	</table>