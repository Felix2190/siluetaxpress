<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title> </title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		
		<script src="../js/lib/jquery.numeric.js"></script> 
		
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<?php include_once 'header.php';?>

							<!-- Section -->
								<section>
									<h2 id="content"></h2>
								</section>
								
								<div class="row">
								<div class="3u 12u$(xsmall)">
									<label>Tel&eacute;fono (casa):</label>
								</div>
								<div class="3u 12u$(xsmall)">
									<input type="text" id="txtTelCasa" class="demo1" maxlength="10" />
								</div>
								<div class="3u 12u$(xsmall)">
									<label>Tel&eacute;fono (m&oacute;vil):</label>
								</div>
								<div class="3u 12u$(xsmall)">
									<input type="text" id="txtTelMovil" class="numeric" maxlength="10" />
								</div>
							</div>
							
						</div>
					</div>

				<!-- Sidebar -->
					<?php include_once 'sidebar.php';?>
			</div>

		<!-- Scripts -->
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
		<script>

	$('#txtTelCasa').numeric({negative : false});


</script>

	</body>
</html>