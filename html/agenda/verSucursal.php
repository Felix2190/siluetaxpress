<?php 
require_once 'masterInclude.inc.php';
$Sucursal = new ModeloSucursal();
$Sucursal->setIdSucursal($idSucursal);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Editar sucursal</title>
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
									<h3 id="content"><img src="images/.png" style="width: 60px;" />&ensp;Sucursal: <i><?php echo $Sucursal->getSucursal();?></i></h3>
									
								
								</section>

								<div class="12u 12u$(xsmall)" >
						<div class="row">
						<input type="hidden" value="<?php echo $Sucursal->getIdSucursal();?>" id="idSucursal"/>
							<div class="3u 12u$(xsmall)">
								<label>Estado:</label>
							</div>
							<div class="3u 12u$(xsmall)">
								<div class="select-wrapper">
									<select name="demo-category" id="slcEstado">
									</select>
								</div>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Municipio:</label>
							</div>
							<div class="3u 12u$(xsmall)">
								<div class="select-wrapper">
									<select name="demo-category" id="slcMunicipio">
									<option value="">Seleccione una opci&oacute;n</option>
									</select>
								</div>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Nombre:</label>
							</div>
							<div class="4u 12u$(xsmall)">
								<input type="text" id="txtNombre" value="<?php echo $Sucursal->getSucursal();?>"/>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Direcci&oacute;n:</label>
							</div>
							<div class="4u 12u$(xsmall)">
								<textarea rows="2" cols="" id="txtDireccion"><?php echo $Sucursal->getDireccion();?></textarea>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Horario (lunes a viernes):</label>
							</div>
							<div class="row 8u 12u$(xsmall)">
								<div class="2u 12u$(xsmall)">
									<div class="select-wrapper">
										<select name="demo-category" id="slcHrEntreI">
										<?php echo $combo;?>
									</select>
									</div>
								</div>
								<div class="1u 12u$(xsmall)" style="justify-content: center; text-align: center;">a</div>
								<div class="2u 12u$(xsmall)">
									<div class="select-wrapper">
										<select name="demo-category" id="slcHrEntreF"><?php echo $combo;?>
									</select>
									</div>
								</div>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Horario (s&aacute;bado):</label>
							</div>
							<div class="row 8u 12u$(xsmall)">
								<div class="2u 12u$(xsmall)">
									<div class="select-wrapper">
										<select name="demo-category" id="slcHrSabI"><?php echo $combo;?>
									</select>
									</div>
								</div>
								<div class="1u 12u$(xsmall)" style="justify-content: center; text-align: center;">a</div>
								<div class="2u 12u$(xsmall)">
									<div class="select-wrapper">
										<select name="demo-category" id="slcHrSabF"><?php echo $combo;?>
									</select>
									</div>
								</div>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>N&uacute;mero de consultorios:</label>
							</div>
							<div class="1u 12u$(xsmall)">
							<input type="text" id="txtConsultorios" class="numeric" />
							</div>
						</div>
						<br />
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>N&uacute;mero de cabinas:</label>
							</div>
							<div class="1u 12u$(xsmall)">
							<input type="text" id="txtCabinas" class="numeric" />
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