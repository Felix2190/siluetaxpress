<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Notas de seguimiento</title>
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
									<h3 id="content"><img src="images/seg.png" style="width: 95px;" />&ensp;Seguimiento</h3>
								</section>
				<div class="row">
					<div class="12u 12u$(xsmall)">
						<h4> <a> Registrar avance </a></h4>
					</div>
					<div class="12u 12u$(small)">
    					<div class="box">
    						<div class="12u 12u$(xsmall)">
							 <strong> Medidas </strong>
							</div>
							
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Peso (Kg):</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtPeso" class="numeric" maxlength="5" />
								</div>
								<div class="2u 12u$(xsmall)">
									<label>Estatura:</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtEstatura" class="numeric" maxlength="5" />
								</div>
								<div class="2u 12u$(xsmall)">
									<label>IMC:</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtIMC" class="numeric" disabled="disabled" />
								</div>
								
							</div>
							<br />
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Talla:</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txt" class="numeric" maxlength="5" />
								</div>
								<div class="2u 12u$(xsmall)">
									<label>Pecho:</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txt" class="numeric" maxlength="5" />
								</div>
								<div class="2u 12u$(xsmall)">
									<label>Cintura:</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txt" class="numeric" maxlength="5" />
								</div>
								
							</div>
							
							<br />
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Abdomen:</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txt" class="numeric" maxlength="5" />
								</div>
								<div class="2u 12u$(xsmall)">
									<label>Cadera:</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txt" class="numeric" maxlength="5" />
								</div>
								
							</div>
						
							<br />
						
						<div class="12u 12u$(xsmall)">
							 <strong> Notas </strong>
							</div>
							
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>S&iacute;ntomas</label>
								</div>
								<div class="8u 12u$(xsmall)">
								<textarea rows="1" cols="" id="txtSintomas"></textarea>
								</div>
							</div>
							
							
								<br />
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Dieta</label>
								</div>
								<br />
								<div class="8u 12u$(xsmall)">
								<textarea rows="3" cols="" id="txtDieta"></textarea>
								</div>
							</div>
							
							
								<br />
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Tratamiento</label>
								</div>
								<br />
								<div class="8u 12u$(xsmall)">
								<textarea rows="3" cols="" id="txtTratamiento"></textarea>
								</div>
							</div>
							
						</div>
						
						
    				</div>
				</div>
				<hr />					
				<div class="row">
					<div class="12u 12u$(xsmall)">
									<h4>Historial</h4>
					</div>
						
						
    					<div class="12u 12u$(small)">
    						<div class="box">
    						</div>
    					</div>
    					<div class="12u 12u$(small)">
    						<div class="box">
    						</div>
    					</div>
    					<div class="12u 12u$(small)">
    						<div class="box">
    						</div>
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

	</body>
</html>