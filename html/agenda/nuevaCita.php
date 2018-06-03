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
							<div class="row uniform" id="divInicio">
								<div class="1u 12u$(xsmall)">
									<label>Paciente:</label>
								</div>
								
								<div class="6u 12u$(xsmall)">
									  <select id="slcPaciente" style="width: 500px;">
									 	</select>
								</div>
							</div>
							<div class="row uniform" id="divInicio">
								<div class="1u 12u$(xsmall)">
									<label>Sucursal:</label>
								</div>
								<div class="3u 12u$(xsmall)">
								<?php if ($objSession->getidRol()==1){?>
									<div class="select-wrapper">
									<select name="demo-category" id="slcSucursal">
									</select>
									</div>
									<?php } else {?>
									<p> <?php echo $objSession->getSucursal();?></p>
									<input type="hidden" id="slcSucursal" value="<?php echo $objSession->getIdSucursal();?>"/>
									<?php } ?>
								</div>
								
								
								<div class="1u 12u$(xsmall)">
									<label>Consulta:</label>
								</div>
								<div class="3u 12u$(xsmall)">
								<div class="select-wrapper">
									<select name="demo-category" id="slcConsulta">
									</select>
								</div>
								</div>
								
								<div class="1u 12u$(xsmall)">
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
								<div class="3u 12u$(xsmall)">
									<div class="select-wrapper">
										<select name="demo-category" id="slcDuracion">
										<?php echo $operadores;?>
									</select>
									</div>
								</div>
								
								<div class="1u 12u$(xsmall)">
									<label>Hora:</label>
								</div>
								
								<div class="1u 12u$(xsmall)">
									<div class="select-wrapper">
										<select name="demo-category" id="slcHr">
										<option value=""></option>
									</select>
									</div>
								</div>
								<div class="1u 12u$(xsmall)">
									<div class="select-wrapper">
										<select name="demo-category" id="slcMin">
										<option value=""></option>
										</select>
									</div>
								</div>

								<div class="2u 12u$(small)">
									<input id="checkRepetir" disabled name="checkRepetir" type="checkbox" > <label for="checkRepetir">Repetir cita</label>
									
								</div>
								
						</div>
						<br />
								<div class="row" >
								
								</div>
								<div class="row" id="divRepiteCita" style="display: none;">
									<div class="2u 12u$(xsmall)">
										<label>Se repite:</label>
									</div>
									<div class="2u 12u$(xsmall)">
										<div class="select-wrapper">
										<select name="demo-category" id="slcPeriodo">
											<option value="0">Semanal</option>
											<option value="21">Mensual</option>
										</select>
										</div>
									</div>
									<div class="2u 12u$(xsmall)">
										<label>Repitir cada:</label>
									</div>
									<div class="1u 12u$(xsmall)">
										<div class="select-wrapper">
										<select name="demo-category" id="slcVeces">
											<?php for ($i=1;$i<=10;$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
										</select>
										</div>
									</div>
									<div class="2u 12u$(xsmall)" id="txtRepite">
										Semana
									</div>

								</div>
								<br />
								<div class="row" id="divRepiteCitaDias" style="display: none;">
									<div class="2u 12u$(xsmall)">
										<label>Repitir el:</label>
									</div>
							<div class="row" >
								<div class="2u 12u$(small)">
									<input class="checkDias" value="lunes" id="chklunes" name="chklunes"  type="checkbox"> <label for="chklunes">Lunes</label>
								</div>
									
								
								<div class="2u 12u$(small)">
									<input class="checkDias" value="martes" id="chkmartes" name="chkmartes" type="checkbox"> <label for="chkmartes">Martes</label>
								</div>
								
								<div class="2u 12u$(small)">
									<input class="checkDias" value="miercoles" id="chkmiercoles" name="chkmiercoles" type="checkbox"> <label for="chkmiercoles">Mi&eacute;rcoles</label>
								</div>
								
								<div class="2u 12u$(small)">
									<input class="checkDias" value="jueves" id="chkjueves" name="chkjueves" type="checkbox"> <label for="chkjueves">Jueves</label>
								</div>
								
								<div class="2u 12u$(small)">
									<input class="checkDias" value="viernes" id="chkviernes" name="chkviernes" type="checkbox"> <label for="chkviernes">Viernes</label>
								</div>
								
								<div class="2u 12u$(small)">
									<input class="checkDias" value="sabado" id="chksabado" name="chksabado" type="checkbox"> <label for="chksabado">S&aacute;bado</label>
								</div>
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
								<div class="8u 12u$(xsmall)">
									<input id="txtServicio" style="width: 100%;"/>
								</div>
							</div>
							<div class="row">
								<div class="1u 12u$(xsmall)">
									<label>Comentarios:</label>
								</div>
								
								<div class="8u 12u$(xsmall)">
								<textarea rows="6" cols="" id="txtComentarios"></textarea>
							</div>
							
							</div>
							<br />
							<br />
								
								<div class="row" id="divFechasNoDisponibles" style="display: none;">
								
								<div class="3u 12u$(small)">&emsp;</div>
								<div class="6u 12u$(small)">
									<div id="divFechasNoDisponibles2"></div>
								<ul class="actions" style="float: right;"><li><a id="btnAceptar" class="button special">Aceptar</a></li><li><a id="btnCancelar" class="button">Cancelar</a></li></ul>
								
								</div>
								</div>
								
							</div>
							<br />
							
							<div class="row">
								<div class="12u"></div>
								<a id="btnGuardar" class="button special" >Guardar</a>
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