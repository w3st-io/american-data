<?php 
	require('vendor/autoload.php');

	include('header.php');
	include('connection.php');

	use Firebase\JWT\JWT;

	$key = "C8CC568F258216230569C0F8C0BFA7060D2C6BF5F84DB7D4A3D1290638E6330B";

	//textbox name "txt_email"
	// [INIT] //
	$code = strip_tags($_POST['vin']);
	$added_on = date('l jS \of F Y h:i:s A');


	if (isset($_POST['user_id'])) {
		//   $query = $conn->prepare( "SELECT * FROM `users`  `email` = ?" );
		//   $query->bindValue( 1, $email );
		//   $query->execute();
			
		//   $user_details = $query->fetch();
		//   $user_id = $user_details->customerUniqueId;

		//   $datapay = {
		//     'customerUniqueId' =>  $user_id,
		//     'currencyCode' => 'USD'
		//     'amount' => '0.1',
		//     'description' => 'payment of generating VIN:'. $code
		//   }

		//   $payloadpay = json_encode($datapay);

		//   // Prepare new cURL resource
		//   $ch = curl_init('https://public.billsby.com/api/v1/rest/core/companyDomain/customers/customerUniqueId/invoices');
		//   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//   curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		//   curl_setopt($ch, CURLOPT_POST, true);
		//   curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadpay);
			
		//   // Set HTTP Header for POST request 
		//   curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		//       'Content-Type: application/json',
		//       'ApiKey: usadata_0fa180de62a542bc84c85edbe69ad701',
		//       'Content-Length: ' . strlen($payloadpay))
		//   );
			
		//   // Submit the POST request
		//   $resultpay = curl_exec($ch);



		//   if ($resultpay == true) {        
		//       $sql = "INSERT INTO reports (user_id, vin_no, added_on) VALUES (?,?,?)";
		//       $stmt= $conn->prepare($sql);
		//       $stmt->execute([$user_id, $code , $added_on]);  
		//    } else {
		//       $error_messages .=  "<p>". "Error on payment details" . "</p>";
		//    }
		
	}
	else {
		$data = array();
		$data['firstName'] = $_POST['f_name'];
		$data['lastName'] = $_POST['l_name'];
		$data['city'] = $_POST['city'];
		$data['country'] = $_POST['country'];
		$data['postCode'] = $_POST['postCode'];
		$data['state'] = $_POST['state'];
		$data['addressLine1'] = $_POST['addressLine1'];
		$data['addressLine2'] = $_POST['addressLine2'];

		$email = $data['email'] = $_POST['email'];
		$paymentCardToken = $cardDetails['paymentCardToken'] = $_POST['paymentCardToken'];
		$fullName = $cardDetails['fullName'] = $_POST['fullName'];
		$expiryMonth = $cardDetails['expiryMonth'] = $_POST['expiryMonth'];
		$expiryYear = $cardDetails['expiryYear'] = $_POST['expiryYear'];
		$cardType = $cardDetails['cardType'] = $_POST['cardType'];
		$last4Digits = $cardDetails['last4Digits'] = $_POST['last4Digits'];


		$sign = $data['sign'] = $_POST['sign'];

		//print_r($data);

		$payload = json_encode($data);

		$data['cardDetails'] = $cardDetails;


		$jwt = JWT::encode($payload, $key);
		$billyby_token = JWT::encode($paymentCardToken, $key);

		// Prepare new cURL resource
		$ch = curl_init('https://public.billsby.com/api/v1/rest/core/usadata/customers');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		
		// Set HTTP Header for POST request 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'ApiKey: usadata_0fa180de62a542bc84c85edbe69ad701',
			'Content-Length: ' . strlen($payload))
		);
		
		// Submit the POST request
		$result = curl_exec($ch);
		
		// Close cURL session handle
		curl_close($ch);

		$res = json_decode($result);

		$user_id = $res->customerUniqueId;

		$error_messages = "";

		// $errors = $res->errors;


		// if ($errors) {

		//   foreach ($errors as $key => $error) {
		//     $error_messages .=  "<p>". $error->description . "</p>";
		//   }
		// } else {

		$sql = "INSERT INTO users (email, payment_token, customerUniqueId, jwtToken, billyby_token, fullname, added_on, sign) VALUES (?,?,?,?,?,?,?,?)";
		$stmt= $conn->prepare($sql);
		$stmt->execute([
			$email,
			$paymentCardToken,
			$user_id,
			$jwt,
			$billyby_token,
			$fullName,
			$added_on,
			$sign
		]);  

		//   $datapay = {
		//   'customerUniqueId' =>  $user_id,
		//   'currencyCode' => 'USD'
		//   'amount' => '0.1',
		//   'description' => 'payment of generating VIN:'. $code
		// }

		// $payloadpay = json_encode($datapay);
	
		// Prepare new cURL resource
		// $ch = curl_init('https://public.billsby.com/api/v1/rest/core/companyDomain/customers/customerUniqueId/invoices');
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		// curl_setopt($ch, CURLOPT_POST, true);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $payloadpay);
		
		// // Set HTTP Header for POST request 
		// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		//     'Content-Type: application/json',
		//     'ApiKey: usadata_0fa180de62a542bc84c85edbe69ad701',
		//     'Content-Length: ' . strlen($payloadpay))
		// );
		
		// // Submit the POST request
		// $resultpay = curl_exec($ch);

		// if ($resultpay == true) {        
		//     $sql = "INSERT INTO reports (user_id, vin_no, added_on) VALUES (?,?,?)";
		//     $stmt= $conn->prepare($sql);
		//     $stmt->execute([$user_id, $code , $added_on]);  
		//  } else {
		//     $error_messages .=  "<p>". "Error on payment details" . "</p>";
		//  }


	// }

	}

	// $userid = strip_tags($_REQUEST['cid']);  //textbox name "txt_email"
	// $code    = strip_tags($_REQUEST['code']);   //textbox name "txt_email"
	// $sid = strip_tags($_REQUEST['sid']);  //textbox name "txt_password"

	// $sql = "INSERT INTO reports (user_id, vin_no, sid, added_on) VALUES (?,?,?,?)";
	// $stmt= $conn->prepare($sql);
	// $stmt->execute([$userid, $code, $sid, $added_on]);
?>


<style type="text/css" media="screen">
	.badge.badge-error.bg-primary {
		background-color: red !important;
		font-size: 16px;
		padding: 10px 20px;
		color: #fff !important;
		display: block;
		text-align: center;
	}

	.badge.badge-error.bg-primary p {
		color: #fff;
	}

	a.link {
		border-bottom: 1px solid black;
	}
</style>


<!-- about breadcrumb --> 
<section class="w3l-about-breadcrumb position-relative text-center">
	<div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4">
		<div class="container py-lg-5 py-3">
		<h2 class="title">We've succesfully generated your report of</h2>
		</div>
	</div>
</section>


<section class="w3l-content-6 report-section">
	<div class="container">
		<div class="content-info-in row">
			<div class="col-lg-6">
				<img src="assets/images/ab1.jpg" alt="" class="img-fluid">
			</div>

			<div class="col-lg-6 mt-lg-0 mt-5 about-right-faq align-self  pl-lg-4">
				<div class="title-content text-left mb-2">
				<h6 class="sub-title">We've downloaded your Full report for : </h6>
				<h3 class="hny-title"><?php echo $code; ?></h3>
				<input type="hidden" id="vinno" name="" value="<?php echo $code; ?>">
			</div>


			<!-- PHP -->
			<?php if ($error_messages != '') {    
				echo "<div class='badge badge-error bg-primary'>".$error_messages. "</div>";
			?>

			<p style="margin-top: 20px;">
				Please <a class="link" href="payments.php?email=<?php echo $email; ?>&vin=<?php echo $code; ?>" title="">Try Again!</a>
			</p>

			<!-- PHP -->
			<?php } else { ?>

			<style type="text/css">
				.login-box {
					padding: 20px;
				}

				.login-box h3 {
					margin-bottom: 20px;
				}

				.login-box .btn {
					margin-top: 20px;
				}
			</style>

			<div class="summery">
				<table class="table">
					<tr>
						<td>Is Salvage?</td>
						<td> <span id="is_salvage"></span></td>
					</tr>
					<tr>
						<td>Vehicle title</td>
						<td> <span id="vehicle_title"></span></td>
					</tr>
					<tr>
						<td>Loss type</td>
						<td> <span id="loss_type"></span></td>
					</tr>
					<tr>
						<td>Mileage</td>
						<td> <span id="mileage"></span></td>
					</tr>
					<tr>
						<td>Primary damage</td>
						<td> <span id="primary_damage"></span></td>
					</tr>
					<tr>
						<td>Secondary damage</td>
						<td> <span id="secondary_damage"></span></td>
					</tr>
				</table>
			</div>

			<div class="card" style="width:600px;margin-bottom:90px">
				<form action="download-report.php" method="post">
					<div class="login-box">
						<input type="hidden" name="vin" value="<?php echo $_GET['code'] ?>">
						<input type="hidden" name="is_salvage" id="f_is_salvage">

						<input type="hidden" name="vehicle_title" id="f_vehicle_title">
						<input type="hidden" name="loss_type" id="f_loss_type">
						<input type="hidden" name="mileage" id="f_mileage">
						<input type="hidden" name="primary_damage" id="f_primary_damage">
						<input type="hidden" name="secondary_damage" id="f_secondary_damage">

						<h3>Login to View All Reports</h3>
 
						<div class="textbox">
							<i class="fa fa-user" aria-hidden="true"></i>
							<input
								type="text"
								class="form-control"
								placeholder="Enter Your Email"
								name="email"
								value="" required>
						</div>

						<input
							type="hidden"
							class="form-control"
							placeholder="Password"
							name="password"
							value="<?php $_GET['cid']?>"
						>
 
						<a
							class="btn btn-primary"
							href="login.php?code=<?php echo $_GET['code']; ?>&cid=<?php echo $_GET['cid']; ?>"
						>Login</a>

						<button
							type="submit"
							class="btn btn-secondary"
						>Download the report now</button>
					</div>
				</form>
			</div>

			<!-- PHP -->
			<?php
				}
			?>
		
		</div>
	</div>
</section>

<?php include('./components/Contact.php'); ?>

<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>

<script type="text/javascript">
	$vinno = $('#vinno').val();

	const settings = {
		"async": true,
		"crossDomain": true,
		"url": "https://vindecoder.p.rapidapi.com/salvage_check?vin="+$vinno,
		"method": "GET",
		"headers": {
			"x-rapidapi-key": "c404ea350amsh3a1bf345dd7386fp1bcde5jsnad8d954aa8d4",
			"x-rapidapi-host": "vindecoder.p.rapidapi.com"
		}
	};

	$.ajax(settings).done(function (response) {
		if (response.errors) {
			$('#result').html('<p>'+ response.message +'</p>');
		}
		else {  
			if (response.is_salvage == true) {
				$('#is_salvage').html('<span class="badge success">' + response.is_salvage + '</span>');
			}

			$('#f_is_salvage').val(response.is_salvage);

			$('#f_vehicle_title').val(response.info.vehicle_title);
			$('#f_loss_type').val(response.info.loss_type);
			$('#f_mileage').val(response.info.mileage);
			$('#f_primary_damage').val(response.info.primary_damage);
			$('#f_secondary_damage').val(response.info.secondary_damage);

			$('#vehicle_title').html(response.info.vehicle_title);
			$('#loss_type').html(response.info.loss_type);
			$('#mileage').html(response.info.mileage);
			$('#primary_damage').html(response.info.primary_damage);
			$('#secondary_damage').html(response.info.secondary_damage);

			console.log(response)
			console.log(response.info)
		}
	})
</script>
</body>
</html>