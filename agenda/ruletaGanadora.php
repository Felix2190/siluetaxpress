﻿<?php
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Ruleta | Silueta Express</title>
<meta charset="utf-8" />
<meta name="viewport"
	content="width=device-width, initial-scale=1, user-scalable=no" />
<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
<link rel="stylesheet" href="assets/css/main.css" />
<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		
		<?php require_once 'importar_scripts2.php'; ?>
		<script type="text/css">

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
					<h2 id="content">Ruleta ganadora</h2>
				</section>


				<div class="12u 12u$(xsmall)" id="divInicial">
					<div class="row">
						<div class="3u 12u$(xsmall)">
							<label>Ingresa tu n&uacute;mero celular:</label>
						</div>
						<div class="2u 12u$(xsmall)">
							<input type="text" id="txtNumero" class="numeric" maxlength="10"/>
						</div>
						<div class="2u 12u$(xsmall)">
							<a id="btnBuscar" class="button">Empezar a jugar</a>
						</div>
					</div>
				</div>
				
				<div class="12u 12u$(small) divRuleta" style="display: none">
					<div class="box">
						<div class="row uniform" id="divInfo">
							<div class="6u 12u$(xsmall)">
								<label style="float: left">Nombre:&emsp;</label> <span id="spNombre"></span>
							</div>
							<div class="3u 12u$(xsmall)">
								<label  style="float: left">Oportunidades:&emsp;</label> <span id="spOportunidades"></span>
							</div>
							<div class="3u 12u$(xsmall)"> 
								<label style="float: left">C&oacute;digos obtenidos &emsp;</label> <span id="spCodigo"></span>
							</div>
							<div class="3u 12u$(xsmall)"> 
								<label style="float: left">Mis c&oacute;digos: </label>
							</div>
							
						</div>
						
						<div class="row uniform" id="divCodigos">
						</div>
					</div>
				</div>

				<div class="12u 12u$(xsmall) divRuleta" style="display: none">
						<div class="row">
							<div class="6u 12u$(xsmall) table-wrapper">
								<div id="tsparticles"></div>
								<table>
									<thead>
										<tr>
											<td>Opción</td>
											<td>Promoción</td>
										</tr>
									</thead>

									<tbody id="tbRuleta">
									</tbody>
								</table>
							</div>
							<div class="6u 12u$(xsmall)">
								<div class="row premio" style="display: none">
									<div class="12u 12u$(xsmall)">
										<center> <h1 style="color: #25a81a;">Felicidades!</h1></center>
									</div>
								</div>
								<div class="row premio" style="display: none">
									<div class="12u 12u$(xsmall)">
										<center> <h2>Usted ha ganado:</h2></center>
									</div>
								</div>
								<div class="row premio" style="display: none">
									<div class="12u 12u$(xsmall)">
										<center> <h1 id="hPremio" style="color: #e37d24;">promoción</h1></center>
									</div>
								</div>
								
								<a id="btnGirar" class="button special">Girar</a>
								<canvas id="canvas" width="500" height="500"></canvas>
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
	<script type="text/javascript" src="tsparticles.min.js"></script>
	<script src="js/lib/jquery.numeric.js"></script>

</body>
</html>