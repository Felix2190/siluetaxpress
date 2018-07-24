<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Agenda virtual &curren;<?php echo ' '.$objSession->getUserName();?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="../assets/css/letrasneron.css"/>
		<link rel="stylesheet" href="../assets/css/circulos.css"/>
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

				<br />
 
                                
				
				<br />
				
				<div class="row">
				<div class="4u 12u$(small)">
				<br /><br />
					<div class="12u">
    					<div class="box">
   							<p class="neron2"><a>Perfil</a></p>
    					</div>
					</div>
					<div class="12u">
    					<div class="box">
   							<p class="neron5"><a>Ver citas</a></p>
    					</div>
					</div>
					<div class="12u">
    					<div class="box">
   							<p class="neron2"><a>Agregar paciente</a></p>
    					</div>
					</div>
						
				</div>
				
				<div class="4u 12u$(small)">
				<br /><br />
					<div class="12u">
    					<div class="box">
    							<p class="neron5"><a>Agendar cita</a></p>
    					</div>
					</div>
					
					<div class="12u">
    					<div class="box">
   							<p class="neron2"><a>Horarios disponibles</a></p>
    					</div>
					</div>
					<div class="12u">
    					<div class="box">
   							<p class="neron5"><a>Listado pacientes</a></p>
    					</div>
					</div>
					
				</div>
				<input type="hidden" id="hdnRol" value="<?php echo $objSession->getidRol();?>"/>
									<input type="hidden" id="hdnSucursal" value="<?php echo $objSession->getIdSucursal();?>"/>
									<input type="hidden" id="hdnUsuario" value="<?php echo $objSession->getidUsuario();?>"/>
								
				
				<div class="4u 12u$(small)">
					<div class="box">
						<div class="row">
							<div class="12u 12u$(xsmall)">
							<h4>Citas (resumen)</h4>
							</div>
							
							<div class="3u 12u$(xsmall)">
									<label>D&iacute;a:</label>
								</div>
								<div class="9u 12u$(xsmall)">
									<input type="text" id="txtFecha" placeholder="AAAA-MM-DD" readonly="readonly" value="<?php echo date("Y-m-d");?>"
																class="datepicker" />
								</div>
						<div class="12u 12u$(xsmall)">
						<br />
						</div>
						
						<?php if ($objSession->getidRol()==1){?>
									<div class="3u 12u$(xsmall)">
									<label>Sucursal:</label>
								</div>
								<div class="9u 12u$(xsmall)">
									<div class="select-wrapper">
									<select name="demo-category" id="slcSucursal">
									</select>
									</div>
									</div>
									<?php } ?>
								
								
						</div>
						
						<div class="12u 12u$(xsmall)">
						<hr />
						</div>
						
						<div class="row" id="divGraficas">
						
						</div>
						
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