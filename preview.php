<?php
	// [INCLUDE] //
	include('./common/session.php');
	include('./connection.php');



	// [INIT] Const //
	$vindecoder_api_key = VINDECODER_API_KEY;


	// [INIT] //
	$vin = strip_tags($_GET['vin']);
	$make = '';
	$engine = '';
	$model = '';


	// [API][VIN] //
	$curl = curl_init();


	curl_setopt_array($curl, [
		CURLOPT_URL => "https://vindecoder.p.rapidapi.com/decode_vin?vin=$vin",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => [
			"x-rapidapi-host: vindecoder.p.rapidapi.com",
			"x-rapidapi-key: $vindecoder_api_key"
		],
	]);

	$res = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) { echo "cURL Error #:" . $err; }
	else {
		// [DECODE-JSON] //
		$json = json_decode($res, true);

		if ($json['success'] == true) {
			$make = $json['specification']['make'];
			$engine = $json['specification']['engine'];
			$model = $json['specification']['model'];
		}
	}
?>


<!--- [HTML] ------------------------------------------------------->
<?php include('header.php'); ?>

<!-- [SPACER] --> 
<section class="w3l-about-breadcrumb position-relative text-center">
	<div class="breadcrumb-bg breadcrumb-bg-about py-sm-5 py-4">
		<div class="container py-lg-5 py-3">
			<h2 class="title">We've downloaded your report</h2>
		</div>
	</div>
</section>
	
<!-- /content-6-->
<section class="w3l-content-6 report-section">
	<div class="container">
		<div class="content-info-in row">
			<!-- col 3 -->
			<div class="col-lg-3">
				<img src="assets/images/checkoutrefundleft.png" alt="" style="margin-bottom: 20px;" class="img-fluid">
				<img src="assets/images/ab1.jpg" alt="" class="img-fluid">
			</div>

			<!-- col 6 -->
			<div class="col-lg-6 mt-lg-0 mt-5 about-right-faq align-self  pl-lg-4">
				<!-- Details -->
				<div class="title-content text-left mb-2">
					<h6 class="sub-title">We've downloaded your report for : </h6>
					<!-- VIN -->
					<h3 class="hny-title">Your Vin Number: <?php echo $vin ?></h3>
					<!-- [INPUT] Hidden -->
					<input type="hidden" id="vin" value="<?php echo $vin ?>">
				</div>


				<div class="summery">
					<table class="table">
						<tr>
							<td>Make</td>
							<td><?php echo $make; ?></td>
						</tr>
						<tr>
							<td>Model</td>
							<td><?php echo $model; ?></td>
						</tr>
						<tr>
							<td>Engine</td>
							<td><?php echo $engine; ?></td>
						</tr>
					</table>
				</div>

				<div class="card">
					<div class="card-header">Your Full Report Includes...</div>

					<div class="card-body">
						<table class="table">
							<tbody>
								<tr>
									<td>
										<i class="fas fa-check-circle" style="color:#1F85DE"></i>&nbsp;Detailed specifications
									</td>
									<td>
										<i class="fas fa-check-circle" style="color:#1F85DE"></i>&nbsp;Ownership records
									</td>
								</tr>
								<tr>
									<td>
										<i class="fas fa-check-circle" style="color:#1F85DE"></i>&nbsp;Theft records
									</td>
									<td>
										<i class="fas fa-check-circle" style="color:#1F85DE"></i>&nbsp;Odometer records
									</td>
								</tr>
								<tr>
									<td>
										<i class="fas fa-check-circle" style="color:#1F85DE"></i>&nbsp;Salvage records
									</td>
									<td>
										<i class="fas fa-check-circle" style="color:#1F85DE"></i>&nbsp;Accident records
									</td>
								</tr>
								<tr>
									<td>
										<i class="fas fa-check-circle" style="color:#1F85DE"></i>&nbsp;Detailed specifications
									</td>
									<td>
										<i class="fas fa-check-circle" style="color:#1F85DE"></i>&nbsp;Ownership records
									</td>
								</tr>
								<tr>
									<td>
										<i class="fas fa-check-circle" style="color:#1F85DE"></i>&nbsp;Vandalism records
									</td>
									<td>
										<i class="fas fa-check-circle" style="color:#1F85DE"></i>&nbsp;Damage Records
									</td>
								</tr>
								<tr>
									<td>
										<i class="fas fa-check-circle" style="color:#1F85DE"></i>&nbsp;Rideshare Records
									</td>
									<td>
										<i class="fas fa-check-circle" style="color:#1F85DE"></i>&nbsp;100+ other records
									</td>
								</tr>
							</tbody>
						</table>	
	
						<!-- [SUBMIT] -->
						<a class="btn btn-primary w-100" href="preview-2.php?vin=<?php echo $_GET['vin'] ?>">
							Get my report full report
						</a>
					</div>
				</div>
			</div>

			<!-- col 3 -->
			<div class="col-lg-3">
				<img src="assets/images/placecheckoutonright.png" alt="" class="img-fluid">
			</div>	
		</div>
	</div>
</section>
 

<?php include('./components/Contact.php'); ?>

<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>

</body>
</html>