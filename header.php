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
	<title>VIN History reports America</title>

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

	

	<!-- Google Tag Manager -->
	<script>
		(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-MBVLFVX');
	</script>
	<!-- End Google Tag Manager -->

	<!-- Microsoft tag -->
	<script>
		(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"56383622"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");
	</script>

	<!-- Template CSS -->
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
	<iframe
		src="https://www.googletagmanager.com/ns.html?id=GTM-MBVLFVX"
		height="0"
		width="0"
		style="display:none;visibility:hidden"
	></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<!--header-->
<header id="site-header" class="fixed-top">
	<div class="container-fluid">
		<nav class="navbar navbar-expand-lg navbar-light">
			<h1>
				<a class="navbar-brand" href="/">
					<span>VIN</span> History reports America
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