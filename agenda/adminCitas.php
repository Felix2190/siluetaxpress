<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title> Verificar asistencia </title>
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
									<h2 id="content"> Verificar asistencia</h2>
								</section>
								
						<div class="row">
							<div class="12u 12u$(small)">
								<div class="row uniform">
								<div class="1u 12u$(xsmall)">
									<label>Fecha:</label>
								</div>
								<div class="3u 12u$(xsmall)">
									<input type="text" id="txtFecha" placeholder="AAAA-MM-DD" readonly="readonly" value="<?php echo date("Y-m-d");?>"
																class="datepicker"/>
								</div>
								</div>
							</div>
						</div>
				<br>
				<div class="row">
					<div class="12u 12u$(small)">
						<div class="11u 12u$(small)"><div class="box" id="divCitas">
							<div class="row">
							<div class="3u 12u$(xsmall)"><h3>Citas realizadas</h3></div>
							</div>
        					<div class="row">
							<div class="12u 12u$(xsmall)"><span>Selecciona s&oacute;lo las citas en las que SI asisti&oacute; el paciente</span></div>
							</div>
							<br />
        					<div class="row" id="divListadoCitas">
        						
                            </div>
                            <br />
                            <div class="row">
        						<div class='6u 12u$(xsmall)'>
        							<a id='btnEncuesta' class='button' > Marcar asistencia y enviar encuesta &emsp; <img src='images/whats.webp' style='width: 20px' /> </a>
        						</div>
        					</div>
                            </div>
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