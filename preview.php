<?php
	// [INCLUDE] //
	include('./common/session.php');
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
					<h3 class="hny-title">Your Vin Number: <?php echo $_GET['vin'] ?></h3>
					<!-- [INPUT] Hidden -->
					<input type="hidden" id="vin" value="<?php echo $_GET['vin'] ?>">
				</div>


				<div class="summery">
					<table class="table">
						<tr>
							<td>Vehicle Model & Model</td>
							<td><span id="make"></span> : <span id="model"></span></td>
						</tr>
						<tr>
							<td>Engine</td>
							<td> <span id="engine"></span></td>
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

<!-- FOOTER -->
<?php include('footer.php'); ?>

<?php include('./common/bottom_script.php'); ?>

<!-- [IMPORT] -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

<script type="text/javascript">
	// Get value from form
	$vin = $('#vin').val()

	const options = {
		method: 'GET',
		url: 'https://vindecoder.p.rapidapi.com/decode_vin',
		params: { vin: $vin },
		headers: {
			'x-rapidapi-key': 'c404ea350amsh3a1bf345dd7386fp1bcde5jsnad8d954aa8d4',
			'x-rapidapi-host': 'vindecoder.p.rapidapi.com'
		}
	}
	axios.request(options)
		.then(function (res) {
			const makeElement = document.getElementById('make')
			const engineElement = document.getElementById('engine')
			const modelElement = document.getElementById('model')
			
			makeElement.innerHTML = res.data.specification.make
			modelElement.innerHTML = res.data.specification.model
			engineElement.innerHTML = res.data.specification.engine
		})
		.catch(function (err) { console.error('error:', err) })

</script>
</body>
</html>