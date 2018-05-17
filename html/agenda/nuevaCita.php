<?php
require_once 'masterInclude.inc.php';
?>
<!doctype html>
<html >
<head>
		<title> Cita nueva </title>
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
									<h2 id="content">Agregar cita </h2>
								</section>

				<div class="row">
					<div class="12u 12u$(small)">
						<div class="box">
						<input type="hidden" id="hdnRol" value="<?php echo $objSession->getidRol();?>"/>
						<?php ?>
							<div class="row uniform">
								<div class="1u 12u$(xsmall)">
									<label>Paciente:</label>
								</div>
								<div class="3u 12u$(xsmall)">
									  <select id="slcPaciente">
									 	</select>
								</div>
								
								<div class="1u 12u$(xsmall)">
									<label>Consulta:</label>
								</div>
								<div class="3u 12u$(xsmall)">
									<select name="demo-category" id="slcConsulta">
									</select>
								</div>
								
								<div class="1u 12u$(xsmall)">
									<label>Sucursal:</label>
								</div>
								<div class="3u 12u$(xsmall)">
								<?php if ($objSession->getidRol()==1){?>
									<select name="demo-category" id="slcSucursal">
									</select>
									<?php } else {?>
									<p> <?php echo $objSession->getSucursal();?></p>
									<?php } ?>
								</div>
							
							</div>
							<br />
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<h3>Fecha, hora y duraci&oacute;n</h3>
								</div>
							</div>
							
							<br />
							
							<div class="row">
							
								<div class="1u 12u$(xsmall)">
									<label>D&iacute;a:</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtFecha" placeholder="AAAA-MM-DD" readonly="readonly"
																class="datepicker" />
								</div>
								
								<div class="1u 12u$(xsmall)">
									<label>Duraci&oacute;n:</label>
								</div>
								<div class="2u 12u$(xsmall)">
										<select name="demo-category" id="">
									</select>
								</div>
								
								<div class="1u 12u$(xsmall)">
									<label>Hora:</label>
								</div>
								<div class="1u 12u$(xsmall)">
										<select name="demo-category" id="">
									</select>
								</div>
								<div class="1u 12u$(xsmall)">
										<select name="demo-category" id="">
									</select>
								</div>
								
								<div class="2u 12u$(small)">
									<input id="demo-copy" name="demo-copy" type="checkbox"> <label
										for="demo-copy">Repetir cita</label>
								</div>
								
						</div>
								<br />
								<div class="row" >
								
								</div>
								<br />
								<div class="row" id="divRepiteCita">
									<div class="2u 12u$(xsmall)">
										<label>Se repite:</label>
									</div>
									<div class="2u 12u$(xsmall)">
										<select name="demo-category" id="">
											<option value="S">Semanal</option>
											<option value="M">Mensual</option>
										</select>
									</div>
									<div class="2u 12u$(xsmall)">
										<label>Repitir cada:</label>
									</div>
									<div class="1u 12u$(xsmall)">
										<select name="demo-category" id="">
											<option value="1">1</option>
										</select>
									</div>
									<div class="2u 12u$(xsmall)">
										Semana
									</div>

								</div>
								<br />
								<div class="row" id="divRepiteCita">
									<div class="2u 12u$(xsmall)">
										<label>Repitir el:</label>
									</div>
									
								<div class="1u 12u$(small)">
									<input id="" name="demo-copy" type="checkbox"> <label
										for="demo-copy"></label>
								</div>
																
								
								<div class="1u 12u$(small)">
									<input id="" name="demo-copy" type="checkbox"> <label
										for="demo-copy">Martes</label>
								</div>
								
								</div>
								
								<br />
								
								
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<h3>Detalles</h3>
								</div>
							</div>
							
							<br />
							
							<div class="row">
							
								<div class="1u 12u$(xsmall)">
									<label>Servicio:</label>
								</div>
								<div class="11u 12u$(xsmall)">
									<input id="tags" />
								</div>
								
							</div>
								
								
								
							</div>
							<br />
							
							<div class="row">
								<div class="12u"></div>
								<a id="btnGuardar" class="button special">Guardar</a>
							</div>
							

					</div>
				</div>

			</div>
					</div>

				<!-- Sidebar -->
					<?php include_once 'sidebar.php';?>
			</div>
 
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	
</body>
</html>