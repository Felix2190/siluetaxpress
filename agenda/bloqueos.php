<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Bloqueos</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<style type="text/css">
		  .custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -1px;
    padding: 0;
  }
  .custom-combobox-input {
    margin: 0;
    padding: 5px 10px;
  }
 
		</style>
		
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
									<h2 id="content">Pacientes suspendidos</h2>
								</section>

				<div class="row">
					<div class="12u 12u$(small)">
						<div class="box">
						<div class="row uniform" id="divInicio">
								<div class="1u 12u$(xsmall)">
									<label>Paciente:</label>
								</div>
								
								<div class="4u 12u$(xsmall)">
									  <select id="slcPaciente" style="width: 300px;">
									 	</select>
								</div>
								
								<div class="1u 12u$(xsmall)">
									<label>Motivo:</label>
								</div>
								
								<div class="4u 12u$(xsmall)">
									<textarea rows="3" cols="" id="txtMotivo"></textarea>
								</div>
								
								<div class="2u 12u$(xsmall)" style="text-align: right;">
									<a id="btnBloquear" class="button small">Bloquear</a>
								</div>
							</div>
							
						</div>
					</div>
					
				</div>
				
				
				<div class="row">
					<div class="12u 12u$(small)" id="divTabla">
						
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
<div class="alertify  ajs-movable ajs-closable ajs-pinnable ajs-slide" id="msjConfirm" style="display: none;">
		<div class="ajs-dimmer"></div>
		<div class="ajs-modal" tabindex="0">
			<div class="ajs-dialog" tabindex="0" style="">
				<div class="ajs-commands">
					<button class="ajs-close"  id="btnCerrar"></button>
				</div>
				<div class="ajs-header">Desbloquear paciente</div>
				<div class="ajs-body">
					<div class="ajs-content">&iquest;Est&aacute;s seguro que deseas desbloquearlo?</div>
				</div>
				<div class="ajs-footer">
					<div class="ajs-auxiliary ajs-buttons"></div>
					<div class="ajs-primary ajs-buttons">
						<button class="ajs-button " id="btnSi">Si</button>
						<button class="ajs-button " id="btnNo">No</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	</body>
</html>