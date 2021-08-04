<?php
	// [INCLUDE] //
	include('connection.php');


	// [REQUIRE] Personal //
	require('vendor/autoload.php');


	// [USE] //
	use Firebase\JWT\JWT;


	if ($conn->ping()) { printf ('Connection Ok'); }
	else { printf ("Error: ", $conn->error); }
	print("<hr>");

	
	try {
		// [INIT] //
		$show = false;
	
	
		if ($_POST['secret'] == SECRET_JWT_KEY) {
			$show = true;
		
			// [DATABASE][USER] Check if email exist in server //
			$stmt = $conn->query("SELECT email, phone, street, city, state, zip, payment_jwt FROM users");
			$rows = $stmt->fetch_all(MYSQLI_ASSOC);
		}
		else { echo 'Wrong JWT Secret'; }
	}
	catch (\Throwable $err) { throw $th; }
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
			foreach ($rows as $row) {
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
						'</td>'
				);
						
				if ($row['payment_jwt'] != null && $row['payment_jwt'] != '') {		
					printf(
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
						'</td>'
					);
				}
				else {
					printf(
						'<td>'.
						'</td>'.
						
						'<td>'.
						'</td>'.
						
						'<td>'.
						'</td>'.
						
						'<td>'.
						'</td>'
					);
				}

				printf(
					'</tr>'
				);
			}
		}
		catch (\Throwable $err) {
			echo $err;
		}
	?>
</table>

<?php
	$stmt->close();
?>