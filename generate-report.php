<?php
	// [REQUIRE] //
	require_once('./api/stripe/index.php');


	// [INCLUDE] //
	include('./common/session.php');
	include('connection.php');


	// [STRIPE] //
	$StripeWrapper = new StripeWrapper();


	// [INIT] //
	$error = '';
	$paymentIntentObj = '';
	$vin = '';
	$added_on = date('l jS \of F Y h:i:s A');


	// [SANITZE] //
	$stripe_pi_id = strip_tags($_GET['stripe_pi_id']);
	$stripe_pi_id = filter_var($stripe_pi_id, FILTER_SANITIZE_STRING);


	// [STRIPE] Retrieve Payment Intent
	$paymentIntentObj = $StripeWrapper->retrievePaymentIntent($stripe_pi_id);


	// Get vin from stripe payment intent
	$vin = $paymentIntentObj['metadata']['vin'];


	print_r($paymentIntentObj['metadata']['vin']);
?>

<!--- [HTML] ------------------------------------------------------->
<?php include('header.php'); ?>

<!-- [INPUT] Hidden -->
<input type="hidden" id="vin" value="<?php echo $vin ?>">

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

			<!-- col lg 6 -->
			<div class="d-none d-lg-block col-lg-6">
				<img src="assets/images/ab1.jpg" alt="" class="img-fluid">
			</div>

			<div class="col-lg-6 mt-lg-0 mt-5 about-right-faq align-self  pl-lg-4">
				<div class="title-content text-left mb-2">
				<h6 class="sub-title">We've downloaded your Full report for: </h6>
				<h3 class="hny-title"><?php echo $vin; ?></h3>
				<input type="hidden" id="vinno" name="" value="<?php echo $vin; ?>">
			</div>


			<!-- [PHP] Error -->
			<?php if ($error != ''): ?>    

				<div class='badge badge-error bg-primary'><?php echo $error; ?></div>

				<p style="margin-top: 20px;">
					Please
					<a
						class="link"
						href="payments.php?email=<?php echo $email; ?>&vin=<?php echo $vin; ?>"
						title=""
					>Try Again!</a>
				</p>

			<!-- [PHP] -->
			<?php else: ?>

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
							<input type="hidden" name="vin" value="<?php echo $_GET['vin'] ?>">
							<input type="hidden" name="is_salvage" id="f_is_salvage">

							<input type="hidden" name="vehicle_title" id="f_vehicle_title">
							<input type="hidden" name="loss_type" id="f_loss_type">
							<input type="hidden" name="mileage" id="f_mileage">
							<input type="hidden" name="primary_damage" id="f_primary_damage">
							<input type="hidden" name="secondary_damage" id="f_secondary_damage">

							<button
								type="submit"
								class="btn btn-secondary btn-lg w-100 "
							>Download the report now</button>
						</div>
					</form>
				</div>

			<!-- PHP -->
			<?php endif; ?>
		
		</div>
	</div>
</section>

<?php include('./components/Contact.php'); ?>

<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>


<!-- [REQUIRE] -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

<!-- [SCRIPT][INIT] -->
<script type="text/javascript">
	// Get value from form
	$vin = $('#vin').val()

	// [AXIOS] //
	axios.request({
		method: 'GET',
		url: 'https://vindecoder.p.rapidapi.com/salvage_check',
		params: { vin: $vin },
		headers: {
			'x-rapidapi-key': 'c404ea350amsh3a1bf345dd7386fp1bcde5jsnad8d954aa8d4',
			'x-rapidapi-host': 'vindecoder.p.rapidapi.com'
		}
	})
		.then(function (res) { console.log('res:', res.data) })
		.catch(function (err) { console.error('error:', err) })
</script>


<!-- [SCRIPT][INIT] -->
<script type="text/javascript">
	// Get value from form
	$vin = $('#vin').val()

	console.log('SDFASDF', $vin);

	// [AXIOS] //
	axios.request({
		method: 'GET',
		url: 'https://vindecoder.p.rapidapi.com/salvage_check',
		params: { vin: $vin },
		headers: {
			'x-rapidapi-key': 'c404ea350amsh3a1bf345dd7386fp1bcde5jsnad8d954aa8d4',
			'x-rapidapi-host': 'vindecoder.p.rapidapi.com'
		}
	})
		.then(function (res) {
			console.log('res:', res)

			if (res.is_salvage == true) {
				$('#is_salvage').html('<span class="badge success">' + res.data.is_salvage + '</span>');
			}

			$('#f_is_salvage').val(res.data.is_salvage);

			$('#f_vehicle_title').val(res.data.info.vehicle_title);
			$('#f_loss_type').val(res.data.info.loss_type);
			$('#f_mileage').val(res.data.info.mileage);
			$('#f_primary_damage').val(res.data.info.primary_damage);
			$('#f_secondary_damage').val(res.data.info.secondary_damage);

			$('#vehicle_title').html(res.data.info.vehicle_title);
			$('#loss_type').html(res.data.info.loss_type);
			$('#mileage').html(res.data.info.mileage);
			$('#primary_damage').html(res.data.info.primary_damage);
			$('#secondary_damage').html(res.data.info.secondary_damage);
			
		})
		.catch(function (err) { console.error('error:', err) })
</script>
</body>
</html>