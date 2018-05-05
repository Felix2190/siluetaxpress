<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title> Cita nueva </title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->		
		
		  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
		<script >
		  $( function() {
			    $( ".datepicker" ).datepicker({
			      changeMonth: true,
			      changeYear: true
			    });
			  } );
		  		</script>	
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
									<h2 id="content">Agregar cita </h2>
								</section>

				<div class="row">
					<div class="12u 12u$(small)">
						<div class="box">
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<h3>Datos personales</h3>
								</div>
							</div>
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Paciente:</label>
								</div>
								<div class="5u 12u$(xsmall)">
									<input type="text" id="txtNombre" />
								</div>
								
								<div class="2u 12u$(xsmall)">
									<label>Fecha:</label>
								</div>
								<div class="3u 12u$(xsmall)">
									<input type="text" id="txtFecha" placeholder="AAAA-MM-DD" readonly="readonly"
																class="datepicker" />
								</div>
							
							
							</div>
							<br />
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<label>Apellidos:</label>
								</div>
								<div class="9u 12u$(xsmall)">
									<input type="text" id="txtApellidos" />
								</div>
							</div>
							<br />
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<label>Tel&eacute;fono (casa):</label>
								</div>
								<div class="3u 12u$(xsmall)">
									<input type="text" id="txtTelCasa" class="numeric" maxlength="10" />
								</div>
								<div class="3u 12u$(xsmall)">
									<label>Tel&eacute;fono (m&oacute;vil):</label>
								</div>
								<div class="3u 12u$(xsmall)">
									<input type="text" id="txtTelMovil" class="numeric" maxlength="10" />
								</div>
							</div>
							<br />
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<label>Correo electr&oacute;nico:</label>
								</div>
								<div class="6u 12u$(xsmall)">
									<input type="text" id="txtCorreo" />
								</div>
							</div>
							<br />
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<h3>Hoja cl&iacute;nica</h3>
								</div>
							</div>
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<label>Edad:</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtEdad" class="numeric" maxlength="2" />
								</div>
							</div>
							<br />
							<div class="row">
								<div class="12u"></div>
								<a id="btnGuardar" class="button special">Guardar</a>
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
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>