<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>A&ntilde;adir usuario</title>
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
						<div class="inner" id="divArriba">

							<!-- Header -->
								<?php include_once 'header.php';?>

							<!-- Section -->
								<section >
									<h2 id="content"><img src="images/agregar.png" style="width: 60px;" />&ensp;Nuevo usuario</h2>
									
								
								</section>

								<div class="12u 12u$(xsmall)" id="divArriba">
						
						
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Nombre:</label>
							</div>
							<div class="5u 12u$(xsmall)">
								<input type="text" id="txtNombre" />
							</div>
						</div>
						
						<br />
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Apellidos:</label>
							</div>
							<div class="5u 12u$(xsmall)">
								<input type="text" id="txtApellidos" />
							</div>
						</div>
						<br />
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Sucursal:</label>
							</div>
							<div class="4u 12u$(xsmall)">
								<div class="select-wrapper">
									<select name="demo-category" id="slcSucursal">
									</select>
								</div>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Cargo:</label>
							</div>
							<div class="4u 12u$(xsmall)">
								<div class="select-wrapper">
									<select name="demo-category" id="slcCargo">
									<option value="">Seleccione una opci&oacute;n</option>
									</select>
								</div>
							</div>
						</div>
						
						<br />
						
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Correo:</label>
							</div>
							<div class="4u 12u$(xsmall)">
								<input type="text" id="txtCorreo" />
							</div>
						</div>
						<br />
						
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Tel&eacute;fono:</label>
							</div>
							<div class="3u 12u$(xsmall)">
								<input type="text" id="txtTelefono" class="numeric" maxlength="10"/>
							</div>
						</div>
						
						<br />
						
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>UserName:</label>
							</div>
							<div class="4u 12u$(xsmall)">
								<input type="text" id="txtUserName" />
							</div>
						</div>
						
						<br />
						
						
						
						<div class="8u 12u$(xsmall)" >
								<a  id="btnAgregar" class="button special">Agregar</a>
								<br />
									</div>
						</div>
						<br /><br />
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