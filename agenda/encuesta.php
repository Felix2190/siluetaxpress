<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title> </title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		
		<?php require_once 'importar_scripts2.php'; ?>
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
									<h2 id="content">Calidad de nuestro servicio</h2>
								</section>
								
								<div class="12u 12u$(xsmall)" >
            						<div class="row">
            							<h3>Ay&uacute;danos a mejorar contestando esta peque&ntilde;a encuesta AN&Oacute;NIMA acercca tu experiencia de hoy en SILUETA EXPRESS . </h3>
            						</div>
            					</div>
								<div class="12u 12u$(xsmall)" >
            						<div class="row">
            							<div class="2u 12u$(xsmall)" >
            								<label>ID de encuesta:</label>
            							</div>
            							<div class="1u 12u$(xsmall)">
            								<input type="text" id="txtEncuesta" class="numeric" />
            							</div>
            							<div class="2u 12u$(xsmall)">
            								<a  id="btnBuscar" class="button special">Buscar</a>
            							</div>
            						</div>
            					</div>
            					
            					<br>
            		<div id="divEncuesta" style="display: none;">
            					<div class="12u 12u$(xsmall)" >
            						<div class="row">
            							<label>&iquest;Qui&eacute;n te atendi&oacute; en Silueta Express ?  </label>
            						</div>
            						
            						<div class="row">
            							<div class="1u 12u$(xsmall)" >&emsp;</div>
            							<div class="10u 12u$(xsmall)" id="divPersonal">
											
            							</div>
            						</div>
            					</div>
            					
            					<div class="12u 12u$(xsmall)" >
            						<div class="row">
            							<label>&iquest;C&oacute;mo calificar&iacute;as la atenci&oacute;n y servicio ?</label>
            						</div>
            						
            						<div class="row">
            							<div class="1u 12u$(xsmall)" >&emsp;</div>
            							<div class="10u 12u$(xsmall)" >
											<input id="demo-priority-Excelente" name="evalua" value="Excelente" type="radio" >
											<label for="demo-priority-Excelente" style="float: left; padding-right: 40px;">Excelente</label>
											<input id="demo-priority-Bueno" name="evalua" value="Bueno" type="radio">
											<label for="demo-priority-Bueno" style="float: left; padding-right: 40px;">Bueno</label>
											<input id="demo-priority-Regular" name="evalua" value="Regular" type="radio" >
											<label for="demo-priority-Regular" style="float: left; padding-right: 40px;">Regular</label>
											<input id="demo-priority-Malo" name="evalua" value="Malo" type="radio">
											<label for="demo-priority-Malo" style="float: left; padding-right: 40px;">Malo</label>
            							</div>
            						</div>
            					</div>
            					
            					<div class="12u 12u$(xsmall)" >
            						<div class="row">
            							<label>&iquest;En qu&eacute; consideras que podr&iacute;amos mejorar ? </label>
            						</div>
            						
            						<div class="row">
            							<div class="1u 12u$(xsmall)" >&emsp;</div>
            							<div class="10u 12u$(xsmall)" >
            								<textarea rows="6" cols="8" id="txtOpinion"></textarea>
										</div>
            						</div>
            					</div>
            					<br>
            					<div class="8u 12u$(xsmall)" >
            						<div class="row">
            							<a  id="btnEnviar" class="button special">Enviar evaluaci&oacute;n</a>
            						</div>
            					</div>
            					
            				</div>

						</div>
					</div>

			</div>

		<!-- Scripts -->
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script src="js/lib/jquery.numeric.js"></script>
			
	</body>
</html>