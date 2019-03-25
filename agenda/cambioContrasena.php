<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Agenda virtual &curren;<?php echo ' '.$objSession->getUserName();?></title>
		
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		
		<?php require_once 'importar_scripts.php'; ?>
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
									<h2 id="content">Cambiar mi contrase&ntilde;a</h2>
								</section>
								
								<div class="row">
									<div class="6u 12u$(small)">
										<div class="row">
            								<div class="6u 12u$(xsmall)">
            									<label>Contrase&ntilde;a anterior:</label>
            								</div>
            								<div class="6u 12u$(xsmall)">
            									<input type="password" id="txtPassword" />
            								</div>
										</div>
										<br />
										<div class="row">
            								<div class="6u 12u$(xsmall)">
            									<label>Contrase&ntilde;a nueva:</label>
            								</div>
            								<div class="6u 12u$(xsmall)">
            									<input type="password" id="txtPasswordNuevo" />
            								</div>
										</div>
										<br />
										<div class="row">
            								<div class="6u 12u$(xsmall)">
            									<label>Confirmar contrase&ntilde;a nueva:</label>
            								</div>
            								<div class="6u 12u$(xsmall)">
            									<input type="password" id="txtPasswordNuevo2" />
            								</div>
										</div>
										
										<br /><br />
										
										
							<div class="row">
								<div class="12u"></div>
								<a id="btnActualizar" class="button special">Actualizar</a>
							</div>
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

	</body>
</html>