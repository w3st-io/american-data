<?php
	// [INCLUDE] //
	include('./connection.php');
	include('./common/session.php');
?>

<!doctype html>
<html lang="zxx">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo TITLE; ?></title>

	<!-- FAVICON -->
	<link
		rel="icon"
		type="image/svg+xml"
		href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22256%22 height=%22256%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%2220%22 fill=%22%23ff0000%22></rect><path fill=%22%23fff%22 d=%22M65.89 28.53L65.89 28.53Q67.42 28.53 68.36 29.34Q69.31 30.16 69.31 31.68L69.31 31.68Q69.31 32.67 68.59 35.15Q67.87 37.63 66.69 41Q65.53 44.38 64.04 48.42Q62.56 52.47 60.89 56.48Q59.23 60.48 57.56 64.17Q55.90 67.86 54.45 70.56L54.45 70.56Q54.01 70.92 52.88 71.19Q51.76 71.47 50.50 71.47L50.50 71.47Q47.17 71.47 46.18 69.58L46.18 69.58Q45.37 68.05 44.11 65.34Q42.85 62.64 41.41 59.22Q39.97 55.80 38.44 51.94Q36.91 48.06 35.47 44.24Q34.03 40.41 32.77 36.86Q31.51 33.30 30.70 30.52L30.70 30.52Q31.33 29.62 32.41 29.07Q33.49 28.53 34.57 28.53L34.57 28.53Q36.19 28.53 37.04 29.34Q37.90 30.16 38.62 32.05L38.62 32.05L44.20 48.16Q44.73 49.69 45.55 51.89Q46.36 54.09 47.21 56.39Q48.07 58.68 48.92 60.84Q49.78 63.00 50.32 64.53L50.32 64.53L50.68 64.53Q54.28 55.45 57.38 46.63Q60.49 37.80 62.83 29.25L62.83 29.25Q64.00 28.53 65.89 28.53Z%22></path></svg>"
	/>

	<!-- Template CSS -->
	<link href="//fonts.googleapis.com/css?family=Poppins:300,400,400i,500,600,700&display=swap" rel="stylesheet">
	<link href="//fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">

	<!-- Template CSS -->
	<link rel="stylesheet" href="assets/css/style-starter.css">
	<link rel="stylesheet" href="assets/fontawesome/css/all.css">

	<!-- [BCPAINT] -->
	<link type="text/css" rel="stylesheet" href="resources/css/bcPaint.css" />
	<link type="text/css" rel="stylesheet" href="resources/css/bcPaint.mobile.css" />

	<!-- [BILLSBY] -->
	<script src="https://tokenlib.billsby.com/tokenizer.min.js"></script>
	<script src="https://checkoutlib.billsby.com/checkout.min.js" data-billsby-company="usadata"></script>


	<!-- [POPPER] -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

	<!-- [MICROSOFT] tag -->
	<script>
		(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"56383622"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");
	</script>

	<!-- [MICROSOFT] clarity -->
	<script type="text/javascript">
		(function(c,l,a,r,i,t,y){
			c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
			t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
			y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
		})(window, document, "clarity", "script", "7uh5fqpdij");
	</script>
</head>

<body>
<!--header-->
<header id="site-header" class="fixed-top">
	<div class="container-fluid">
		<nav class="navbar navbar-expand-lg navbar-light">
			<h1>
				<a class="navbar-brand" href="/">
					<span>VIN</span> <?php echo TITLE; ?>
				</a>
			</h1>

			<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNav"
				aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="fa icon-expand fa-bars"></span>
				<span class="fa icon-close fa-times"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarNav">

				<ul class="navbar-nav text-dark search-right mt-lg-0 mt-2">
					
					<li class="nav-item">
						<a
							href="#contact"
							class="btn btn-primary d-none d-lg-block mr-2"
						>Contact Us</a>
					</li>

					<?php if (isset($_SESSION) && $loggedin): ?>

						<li class="nav-item">
							<a
								href="./dashboard.php"
								class="btn btn-primary d-none d-lg-block ml-auto"
							>Dashboard</a>
						</li>

					<?php else: ?>

						<li class="nav-item">
							<a
								href="./login.php"
								class="btn btn-primary"
							>Login</a>
						</li>

					<?php endif; ?>

				</ul>
			</div>
		</nav>
	</div>
</header>