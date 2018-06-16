<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Citas</title>
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
									<h2 id="content">Listado Citas </h2>
									
									<input type="hidden" id="hdnRol" value="<?php echo $objSession->getidRol();?>"/>
									<input type="hidden" id="hdnPaciente" value="<?php echo $paciente;?>"/>
									<input type="hidden" id="hdnSucursal" value="<?php echo $sucursal;?>"/>
									<input type="hidden" id="hdnUsuario" value="<?php echo $usuario;?>"/>
									<input type="hidden" id="hdnCabina" value="<?php echo $cabina;?>"/>
									<input type="hidden" id="hdnAlta" value="<?php echo $altaCita;?>"/>
									<?php if (isset($_SESSION['altaCita'])):
									echo "<p><strong>Paciente:</strong> $Nombre $Apellidos</p>";
									endif;
									
									if ($objSession->getidRol()!=1):
									echo "<p><strong>Sucursal:</strong> ".$objSession->getSucursal()."</p>";
									endif;
									
									if (!isset($_SESSION['altaCita'])){
									?>
									<div class="row uniform" id="divInicio">
									
								<?php if ($objSession->getidRol()==1){?>
									<div class="1u 12u$(xsmall)">
									<label>Sucursal:</label>
								</div>
								<div class="4u 12u$(xsmall)">
									<div class="select-wrapper">
									<select name="demo-category" id="slcSucursal">
									</select>
									</div>
									</div>
									<?php } ?>
								
								<div class="2u 12u$(xsmall)">
									<label>Consultorio:</label>
								</div>
								<div class="3u 12u$(xsmall)">
								<div class="select-wrapper">
									<select name="demo-category" id="slcConsultorio">
									<option value=""></option>
									</select>
								</div>
								</div>
									</div>
									<?php }?>
									
								</section>
								
									<div class="table-wrapper" id="divTabla">
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