<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Detalles de cita <?php echo $idCita;?> </title>
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
									<h3 id="content">Cita: <strong><?php echo $idCita;?></strong></h3>
								</section>
								
								
							<div class="row">
					<div class="12u 12u$(small)">
						<div class="box">
							<div class="row">
							
							<!-- 
								<div class="1u 12u$(small)">
									Nombre:
								</div>
								<div class="5u 12u$(xsmall)">
									<p style="border-bottom: 2px solid;"><?php echo "$paciente->nombre $paciente->apellidos";?></p>
								</div>
								<div class="1u 12u$(small)">
									Edad:
								</div>
								<div class="1u 12u$(xsmall)">
									<p style="border-bottom: 2px solid;"><?php echo "$paciente->edad";?></p>
								</div>
								<div class="2u 12u$(small)">
									Fecha de nac.:
								</div>
								<div class="2u 12u$(xsmall)">
								<?php $fecha=explode("-",$paciente->fechaNacimiento);?>
									<p style="border-bottom: 2px solid;"><?php echo "$fecha[2] de ".obtenMes(''.intval($fecha[1]))." del $fecha[0]";?></p>
								</div>
								-->
							</div>	
						</div>
					</div>
						</div>
						
				<div class="row">
					<div class="12u 12u$(small)">
					<ul>
						<li></li>
					</ul>
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