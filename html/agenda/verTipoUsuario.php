<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Editar cargo</title>
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
								<section>
									<h3 id="content"><img src="images/editar.png" style="width: 60px;" />&ensp;Cargo: <i><?php echo $TipoUsuario->getNombre();?></i></h3>
									
								
								</section>

								<div class="12u 12u$(xsmall)" >
					
						<div class="row">
						<input type="hidden" value="<?php echo $TipoUsuario->getIdTipoUsuario();?>" id="idTipoUsuario"/>
						
							<div class="3u 12u$(xsmall)">
								<label>Cargo:</label>
							</div>
							<div class="4u 12u$(xsmall)">
								<input type="text" id="txtNombre" value="<?php echo $TipoUsuario->getNombre();?>"/>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Abreviatura:</label>
							</div>
							<div class="2u 12u$(xsmall)">
								<input type="text" id="txtAbreviatura" value="<?php echo $TipoUsuario->getAbrev();?>"/>
							</div>
						</div>
						<br />
						
						
						
						
						
						
						<div class="8u 12u$(xsmall)" >
								<a  id="btnGuardar" class="button special">Guardar</a>
								<a href="listadoTipoUsuarios.php" class="button">Volver al listado</a>
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