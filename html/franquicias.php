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
		<title>Franquicias</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/alertify.min.css" />
		<link rel="stylesheet" href="assets/css/themes/default.min.css" />
		<script src="js/lib/alertifyjs/alertify.min.js"></script>
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	<!-- End WOWSlider.com HEAD section -->
	 
	
	<?php require_once 'importar_scripts.php'; ?>
	</head>
	<body>
		<div id="page-wrapper">
		<?php 
		include_once 'navhome.php';
		?>

		<div id="main">
			<div class="container">
				<div class="row main-row">
					<div class="12u">
					
					<div class="row">
					<div class="3u 12u(mobile)">
						<section>
						<img src="images/local.jpg" alt=""  style="width: 90%; margin-left:10%">
						</section>
					</div>
					
					
					<div class="9u 12u(mobile)">
						<section>
							<h3>Silueta Express le ofrece una excelente oportunidad para realizar un negocio rentable y de larga duraci&oacute;n.</h3>
							<p><br /></p>
							<p>El rubro de la belleza es uno de los de mayor crecimiento en los &uacute;ltimos diez a&ntilde;os en todo el mundo.</p> 
							<p>Silueta Express se encuentra con su concepto de negocio en el pulso del tiempo y te brinda un negocio seguro para que tu mismo puedas ser parte de nuestro &eacute;xito.</p>
							
							
						</section>
						
						<section>
						<p></p>
						<a class="button2" id="btnFranquicia" >Adquiere tu franquicia aqu&iacute;</a>
						</section>
					</div>
					
					</div>
						
				</div>
				
				<div class="12u">		
						<section>
				
					<div class="row" style="display: none;"  id="formulario">
								
						<div class="1u 12u(mobile)">
						<section></section>
						</div>
						
						<div class="8u 12u(mobile)">
						<div class="row" id="divFormulario">
							<div class="3u 12u$(xsmall)">
								<label>Nombre completo:</label>
							</div> 
							<div class="9u 12u$(xsmall)">
								<input type="text" id="txtNombre"/>
							</div>
						</div>
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Estado:</label>
							</div> 
							<div class="3u 12u$(xsmall)">
							<div class="select-wrapper">
								<select id="slcEstado">
									<?php echo $slcEstados;?>
								</select>
							</div>
							</div>
							<div class="2u 12u$(xsmall)">
								<label>Municipio:</label>
							</div> 
							<div class="4u 12u$(xsmall)">
							<div class="select-wrapper">
								<select id="slcMunicipio">
									<?php echo $slcMunicipios;?>
								</select>
							</div>
							</div>
						</div>
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Ciudad:</label>
							</div> 
							<div class="9u 12u$(xsmall)">
								<input type="text" id="txtCiudad"/>
							</div>
						</div>
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Direcci&oacute;n:</label>
							</div> 
							<div class="9u 12u$(xsmall)">
								<input type="text" id="txtDireccion"/>
							</div>
						</div>
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Tel&eacute;fono:</label>
							</div> 
							<div class="3u 12u$(xsmall)">
								<input type="text" id="txtTel"/>
							</div>
							<div class="3u 12u$(xsmall)">
								<label>Correo electr&oacute;nico:</label>
							</div> 
							<div class="3u 12u$(xsmall)">
								<input type="text" id="txtEmail"/>
							</div>
						</div>
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Comentarios:</label>
							</div> 
							<div class="9u 12u$(xsmall)">
								<textarea rows="6" cols="" id="txtComentarios"></textarea>
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
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/skel-viewport.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>