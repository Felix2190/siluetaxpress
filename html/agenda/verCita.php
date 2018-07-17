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
								
								<input type="hidden" id="hdnRol" value="<?php echo $objSession->getidRol();?>"/>
								<input type="hidden" id="hdnCita" value="<?php echo $idCita;?>"/>
														
			<div class='row' id='divInformacion'>
			</div>
				<div class="row" style="display: none;" id="divGuardar">
					<div class='12u'>
						<a id="btnGuardar" class="button special" >Guardar cambios</a>
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
	<div class="alertify  ajs-movable ajs-closable ajs-pinnable ajs-slide" id="msjConfirm" style="display: none;">
		<div class="ajs-dimmer"></div>
		<div class="ajs-modal" tabindex="0">
			<div class="ajs-dialog" tabindex="0" style="">
				<div class="ajs-commands">
					<button class="ajs-close"  id="btnCerrar"></button>
				</div>
				<div class="ajs-header">Cancelar cita</div>
				<div class="ajs-body">
					<div class="ajs-content">&iquest;Qui&eacute;n cancela la cita?</div>
				</div>
				<div class="ajs-footer">
					<div class="ajs-auxiliary ajs-buttons"></div>
					<div class="ajs-primary ajs-buttons">
						<button class="ajs-button " id="btnEncargado">Encargado</button>
						<button class="ajs-button " id="btnPaciente">Paciente</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	</body>
</html>