<?php
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<!--
	Minimaxing by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Cont&aacute;ctanos</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	<!-- End WOWSlider.com HEAD section -->
	<?php require_once 'importar_scripts.php'; ?>
	<script src="js/lib/jquery.numeric.js"></script>
			
	</head>
	<body>
		<div id="page-wrapper">
		<?php 
		include_once 'navhome.php';
		?>

		<div id="main">
			<div class="container">
				<div class="row main-row">
					<div class="12u" id="divFormulario">

						<section>
							<h2>Contacto</h2>
							<p></p>
						</section>
					</div>
					
					<div class="12u">		
						<section>
				
					<div class="row">
						<div class="1u 12u(mobile)">
						<section></section>
						</div>
						
						<div class="8u 12u(mobile)">
						<div class="row" >
							<div class="2u 12u$(xsmall)">
								<label>Nombre:</label>
							</div> 
							<div class="5u 12u$(xsmall)">
								<input type="text" id="txtNombre"/>
							</div>
						</div>
						<div class="row" >
							<div class="2u 12u$(xsmall)">
								<label>Apellidos:</label>
							</div> 
							<div class="5u 12u$(xsmall)">
								<input type="text" id="txtApellidos"/>
							</div>
						</div>
						<div class="row" >
							<div class="2u 12u$(xsmall)">
								<label>Telefono:</label>
							</div> 
							<div class="3u 12u$(xsmall)">
								<input type="text" id="txtTelefono" maxlength="10" class="numeric"/>
							</div>
						</div>
						<div class="row" >
							<div class="2u 12u$(xsmall)">
								<label>Correo:</label>
							</div> 
							<div class="4u 12u$(xsmall)">
								<input type="text" id="txtCorreo"/>
							</div>
						</div>
						
						<div class="row" >
							<div class="2u 12u$(xsmall)">
								<label>Comentarios:</label>
							</div> 
							<div class="8u 12u$(xsmall)">
								<textarea rows="4" id="txtComentarios"></textarea>
							</div>
						</div>
						
						<div class="row">
						<div class="12u"></div>
						<a id="btnEnviar" class="button">Enviar</a>
						</div>
						
						
						</div>
					</div>
					
					</section>
					
					</div>

				</div>

			</div>

		</div>
	
		</div>
		
		<?php include_once 'footer.php';?>

		<!-- Scripts -->
			<script type="text/javascript" src="js/system/headerLogo.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/skel-viewport.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>