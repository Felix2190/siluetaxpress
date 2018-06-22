<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Nuevo paciente </title>
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
									<h2 id="content">Agregar nuevo paciente </h2>
								</section>

				<div class="row">
					<div class="9u 12u$(small)">
						<div class="box">
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<h3>Datos personales</h3>
								</div>
							</div>
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<label>Nombre:</label>
								</div>
								<div class="9u 12u$(xsmall)">
									<input type="text" id="txtNombre" />
								</div>
							</div>
							<br />
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<label>Apellidos:</label>
								</div>
								<div class="9u 12u$(xsmall)">
									<input type="text" id="txtApellidos" />
								</div>
							</div>
							<br />
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<label>Ocupaci&oacute;n:</label>
								</div>
								<div class="9u 12u$(xsmall)">
									<input type="text" id="txtOcupacion" />
								</div>
							</div>
							<br />
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<label>Tel&eacute;fono (casa):</label>
								</div>
								<div class="3u 12u$(xsmall)">
									<input type="text" id="txtTelCasa" class="numeric" maxlength="10" />
								</div>
								<div class="3u 12u$(xsmall)">
									<label>Tel&eacute;fono (m&oacute;vil):</label>
								</div>
								<div class="3u 12u$(xsmall)">
									<input type="text" id="txtTelMovil" class="numeric" maxlength="10" />
								</div>
							</div>
							<br />
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<label>Sexo:</label>
								</div>
								<div class="3u 12u$(xsmall)"> <form>
																<input id="demo-priority-Masculino" name="demo-priority"  type="radio">
																<label for="demo-priority-Masculino">Masculino</label>
																<input id="demo-priority-Femenino" name="demo-priority"  type="radio">
																<label for="demo-priority-Femenino">Femenino</label> </form>
								</div>
								<div class="3u 12u$(xsmall)">
									<label>Edad:</label>
								</div>
								<div class="3u 12u$(xsmall)">
									<input type="text" id="txtEdad" class="numeric" maxlength="2" />
								</div>
							</div>
							<br />
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<label>Correo electr&oacute;nico:</label>
								</div>
								<div class="3u 12u$(xsmall)">
									<input type="text" id="txtCorreo" />
								</div>
								
								<div class="3u 12u$(xsmall)">
									<label>Fecha de nacimiento:</label>
								</div>
								<div class="3u 12u$(xsmall)">
									<input type="text" id="txtFecha" placeholder="AAAA-MM-DD" readonly="readonly"
																class="datepicker" />
								</div>
								
							</div>
							<br />
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<h3>Hoja cl&iacute;nica</h3>
								</div>
							</div>
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<label>Cirug&iacute;as:</label>
								</div>
								<div class="3u 12u$(xsmall)"> <form >
																<input id="demo-priority-si" name="cirugias"  value="Si" type="radio">
																<label style="float: left;" for="demo-priority-si">Si</label>
																<input id="demo-priority-no" name="cirugias" value="No" type="radio">
																<label style="float: left;" for="demo-priority-no">No</label> </form>
								</div>
								<div class="1u 12u$(xsmall) divCirugia" style="display: none;">
									<label>&ntilde;Cu&aacute;l?</label>
								</div>
								<div class="5u 12u$(xsmall) divCirugia" style="display: none;">
									<input type="text" id="txtCirugias"  />
								</div>
								
							</div>
							
							<br />
							
							<div class="row">
							<div class="3u 12u$(xsmall)">
									<label>Enfermedades:</label>
								</div>
								
								<div class="9u 12u$(xsmall)">
								<textarea rows="1" cols="" id="txtEnfermedades"></textarea>
							</div>
							
							</div>
							<br />
							
							<div class="row" >
								<div class="4u 12u$(xsmall)" >
									<label style="float: right;">Padece de estre&ntilde;imiento:</label>
								</div>
								<div class="2u 12u$(xsmall)" > <form>
																<input id="demo-priority-siE" name="estrenimiento" value="Si" type="radio">
																<label style="float: left;" for="demo-priority-siE">Si</label>
																<input id="demo-priority-noE" name="estrenimiento" value="No" type="radio">
																<label style="float: left;" for="demo-priority-noE">No</label> </form>
								</div>
								<div class="3u 12u$(xsmall) divEstren" style="display: none;">
									<label>&ntilde;Qu&eacute; tan frecuente?</label>
								</div>
								<div class="3u 12u$(xsmall)  divEstren" style="display: none;"><form >
																<input id="demo-priority-1E" name="estrenimientoF" value="1" type="radio">
																<label style="float: left;" for="demo-priority-1E">Diario</label>
																<input id="demo-priority-2E" name="estrenimiento" value="2" type="radio">
																<label style="float: left;" for="demo-priority-2E">Casi diario</label>
																<input id="demo-priority-3E" name="estrenimiento" value="3" type="radio">
																<label style="float: left;" for="demo-priority-3E">Eventualmente</label> </form>
								</div>
							</div>
							
							<br />
							
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<label>Periodo menstrual:</label>
								</div>
								<div class="12u$(xsmall)">
											<form>					<input id="demo-priority-regular" name="menstrual" value="Regular" type="radio">
																<label style="float: left;" for="demo-priority-regular">Regular</label>
																<input id="demo-priority-irregular" name="menstrual" value="Irregular" type="radio"> 
																<label style="float: left;" for="demo-priority-irregular">Irregular</label>
																<input id="demo-priority-menopausa" name="menstrual" value="Menopausa" type="radio"> 
																<label style="float: left;" for="demo-priority-menopausa">Menopausa</label>
																<input id="demo-priority-yano" name="menstrual" value="No" type="radio"> 
																<label style="float: left;" for="demo-priority-yano">Ya no menstr&uacute;a</label> 
														</form>
								</div>
							</div>
							
							<br />
							
							<div class="row">
								<div class="4u 12u$(xsmall)">
									<label>Alergia a alg&uacute;n alimento:</label>
								</div>
								<div class="2u 12u$(xsmall)"> <form >
																<input id="demo-priority-siA" name="alergia" value="Si" type="radio">
																<label style="float: left;" for="demo-priority-siA">Si</label>
																<input id="demo-priority-noA" name="alergia" value="No" type="radio">
																<label style="float: left;" for="demo-priority-noA">No</label> </form>
								</div>
								<div class="2u 12u$(xsmall)  divAlergia" style="display: none;">
									<label>&ntilde;Qu&aacute;l?</label>
								</div>
								<div class="4u 12u$(xsmall)  divAlergia" style="display: none;">
									<input type="text" id="txtAlergias" class="" />
								</div>
							</div>
							
							<br />
							
							<div class="row">
								<div class="4u 12u$(xsmall)">
									<label>&ntilde;Cu&aacute;ntas horas duerme?</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txt" class="numeric" maxlength="2" />
								</div>
								
								<div class="4u 12u$(xsmall)">
									<label>&ntilde;Cu&aacute;ntas comidas realiza al d&iacute;a?</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txt" class="numeric" maxlength="2" />
								</div>
							</div>
							
							<br />
							
							<div class="row" >
								<div class="4u 12u$(xsmall)" >
									<label style="float: right;">Toma caf&eacute;?</label>
								</div>
								<div class="2u 12u$(xsmall)" > <form>
																<input id="demo-priority-siCafe" name="cafe" value="Si" type="radio">
																<label style="float: left;" for="demo-priority-siCafe">Si</label>
																<input id="demo-priority-noCafe" name="cafe" value="No" type="radio">
																<label style="float: left;" for="demo-priority-noCafe">No</label> </form>
								</div>
								<div class="3u 12u$(xsmall)  divCafe" style="display: none;">
									<label>&ntilde;Qu&eacute; tan frecuente?</label>
								</div>
								<div class="3u 12u$(xsmall) divCafe" style="display: none;"><form >
																<input id="demo-priority-1Cafe" name="cafeF" value="1" type="radio">
																<label style="float: left;" for="demo-priority-1Cafe">Diario</label>
																<input id="demo-priority-2Cafe" name="cafeF" value="2" type="radio">
																<label style="float: left;" for="demo-priority-2Cafe">Casi diario</label>
																<input id="demo-priority-3Cafe" name="cafeF" value="3" type="radio">
																<label style="float: left;" for="demo-priority-3Cafe">Eventualmente</label> </form>
								</div>
							</div>
							
							<br />
							
							<div class="row" >
								<div class="4u 12u$(xsmall)" >
									<label style="float: right;">&ntilde;Fuma?</label>
								</div>
								<div class="2u 12u$(xsmall)" > <form>
																<input id="demo-priority-siFuma" name="fuma" value="Si" type="radio">
																<label style="float: left;" for="demo-priority-siFuma">Si</label>
																<input id="demo-priority-noFuma" name="fuma" value="No" type="radio">
																<label style="float: left;" for="demo-priority-noFuma">No</label> </form>
								</div>
								<div class="3u 12u$(xsmall) divFuma" style="display: none;">
									<label>&ntilde;Qu&eacute; tan frecuente?</label>
								</div>
								<div class="3u 12u$(xsmall) divFuma" style="display: none;"> <form >
																<input id="demo-priority-1Fuma" name="fumaF" value="1" type="radio">
																<label style="float: left;" for="demo-priority-1Fuma">Diario</label>
																<input id="demo-priority-2Fuma" name="fumaF" value="2" type="radio">
																<label style="float: left;" for="demo-priority-2Fuma">Casi diario</label>
																<input id="demo-priority-3Fuma" name="fumaF" value="3" type="radio">
																<label style="float: left;" for="demo-priority-3Fuma">Eventualmente</label> </form>
								</div>
							</div>
							
							<br />
							
							<div class="row" >
								<div class="4u 12u$(xsmall)" >
									<label style="float: right;">Ingiere bebidas alcoh&oacute;licas?</label>
								</div>
								<div class="2u 12u$(xsmall)" > <form>
																<input id="demo-priority-siBebe" name="bebidas" value="Si" type="radio">
																<label style="float: left;" for="demo-priority-siBebe">Si</label>
																<input id="demo-priority-noBebe" name="bebidas" value="No" type="radio">
																<label style="float: left;" for="demo-priority-noBebe">No</label> </form>
								</div>
								<div class="3u 12u$(xsmall)  divBebidas" style="display: none;">
									<label>&ntilde;Qu&eacute; tan frecuente?</label>
								</div>
								<div class="3u 12u$(xsmall) divBebidas" style="display: none;"> <form >
																<input id="demo-priority-1Bebe" name="bebidasF" value="1" type="radio">
																<label style="float: left;" for="demo-priority-1Bebe">Diario</label>
																<input id="demo-priority-2Bebe" name="bebidasF" value="2" type="radio">
																<label style="float: left;" for="demo-priority-2Bebe">Casi diario</label>
																<input id="demo-priority-3Bebe" name="bebidasF" value="3" type="radio">
																<label style="float: left;" for="demo-priority-3Bebe">Eventualmente</label> </form>
								</div>
							</div>
							
							<div class="row">
							<div class="4u 12u$(xsmall)">
									<label>Alimentos desagradables:</label>
								</div>
								
								<div class="5u 12u$(xsmall)">
								<textarea rows="1" cols="" id="txtDesagradable"></textarea>
								</div>
								
							</div>
							
							<br />
							
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<label>Ansiedad:</label>
								</div>
								<div class="3u 12u$(xsmall)"> <form >
																<input id="demo-priority-siAnsiedad" name="ansiedad" value="Si" type="radio">
																<label style="float: left;" for="demo-priority-siAnsiedad">Si</label>
																<input id="demo-priority-noAnsiedad" name="ansiedad" value="No" type="radio">
																<label style="float: left;" for="demo-priority-noAnsiedad">No</label> </form>
								</div>
							</div>
							
							<br />
							
							<div class="row" >
								<div class="4u 12u$(xsmall)" >
									<label style="float: right;">Realiza alguna actividad f&iacute;sica?</label>
								</div>
								<div class="2u 12u$(xsmall)" > <form>
																<input id="demo-priority-siActividad" name="actividadFisica" value="Si" type="radio">
																<label style="float: left;" for="demo-priority-siActividad">Si</label>
																<input id="demo-priority-noActividad" name="actividadFisica" value="No" type="radio">
																<label style="float: left;" for="demo-priority-noActividad">No</label> </form>
								</div>
								<div class="1u 12u$(xsmall)  divActividad" style="display: none;">
									<label>&ntilde;Cu&aacute;l?</label>
								</div>
								<div class="5u 12u$(xsmall  divActividad" style="display: none;">
									<input type="text" id="txtActividad" />
								</div>
								
							</div>
							
							
							<br />
							
							<div class="row  divActividad" style="display: none;">
							
								<div class="3u 12u$(xsmall)">
									<label>&ntilde;Cu&aacute;nto tiempo?</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtTiempo" class="numeric" maxlength="2" />
								</div>
								<div class="2u 12u$(xsmall)">
								<div class="select-wrapper">
									<select name="demo-category" id="slcTiempo">
									<option value="hrs">Hrs</option>
									<option value="min">Min</option>
									</select>
								</div>
								</div>
								<div class="2u 12u$(xsmall)">
									<label>Frecuencia:</label>
								</div>
								<div class="3u 12u$(xsmall)"><form >
																<input id="demo-priority-1Ejecicio" name="actividadTiempo" value="1" type="radio">
																<label style="float: left;" for="demo-priority-1Ejecicio">Diario</label>
																<input id="demo-priority-2Ejecicio" name="actividadTiempo" value="2" type="radio">
																<label style="float: left;" for="demo-priority-2Ejecicio">Casi diario</label>
																<input id="demo-priority-3Ejecicio" name="actividadTiempo" value="3" type="radio">
																<label style="float: left;" for="demo-priority-3Ejecicio">Eventualmente</label> </form>
								</div>
								
							</div>
							
							<br />
							
							<div class="row">
								<div class="7u 12u$(xsmall)">
									<label>&ntilde;Qu&eacute; tan motivado(a) est&aacute; para iniciar el plan nutricional? </label>
								</div>
								<div class="2u 12u$(xsmall)">
								<div class="select-wrapper">
									<select name="demo-category" id="slcMotivacion">
										<?php for ($i = 1; $i<=10; $i++) {
										    echo "<option value='$i'>$i</option>";
										}?>
									
									</select>
								</div>
								</div>
								
							</div>
							
							<br />
							
							<div class="row">
								<div class="4u 12u$(xsmall)">
									<label>Horario de levantarse: </label>
								</div>
								<div class="3u 12u$(xsmall)">
									<div class="select-wrapper">
										<select name="demo-category" id="slcHrLevantar">
										<?php echo $comboHr;?>
									</select>
									</div>
								</div>
							</div>
								
							<br />
							
							<div class="row">
								<div class="4u 12u$(xsmall)">
									<label>Horario de acostarse: </label>
								</div>
								<div class="3u 12u$(xsmall)">
									<div class="select-wrapper">
										<select name="demo-category" id="slcHrAcostar">
										<?php echo $comboHr;?>
									</select>
									</div>
								</div>
							
							</div>
							
							<br />
							
							<div class="row">
								<div class="4u 12u$(xsmall)">
									<label>Horario de actividad f&iacute;sica: </label>
								</div>
								<div class="3u 12u$(xsmall)">
									<div class="select-wrapper">
										<select name="demo-category" id="slcHrEjercicio">
										<?php echo $comboHr;?>
									</select>
									</div>
								</div>
							</div>
							
							<br />
							<div class="row">
								<div class="5u 12u$(xsmall)">
									<h3>Recordatorio de 24 HRS</h3>
								</div>
							</div>
							<div class="row">
								<div class="4u 12u$(xsmall)">&emsp;</div>
								<div class="5u 12u$(xsmall)">
									<h4 style="float: left;">Desayuno</h4>
								</div>
							
							</div>
							
							<br />
							
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Horario: </label>
								</div>
								<div class="2u 12u$(xsmall)">
									<div class="select-wrapper">
										<select name="demo-category" id="slcHrDesayuno">
										<?php echo $comboHr;?>
									</select>
									</div>
								</div>
								<div class="2u 12u$(xsmall)">
									<label>Actividades: </label>
								</div>
								<div class="6u 12u$(xsmall)">
								<textarea rows="2" cols="" id="txtDesayuno"></textarea>
								</div>
								
							</div>
							
							<br />
							
							<div class="row">
								<div class="4u 12u$(xsmall)">&emsp;</div>
								<div class="5u 12u$(xsmall)">
									<h4 style="float: left;">Colaci&oacute;n 1</h4>
								</div>
							
							</div>
							
							<br />
							
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Horario: </label>
								</div>
								<div class="2u 12u$(xsmall)">
									<div class="select-wrapper">
										<select name="demo-category" id="slcHrColacion1">
										<?php echo $comboHr;?>
									</select>
									</div>
								</div>
								<div class="2u 12u$(xsmall)">
									<label>Actividades: </label>
								</div>
								<div class="6u 12u$(xsmall)">
								<textarea rows="2" cols="" id="txtColacion1"></textarea>
								</div>
								
							</div>
							
							
							<br />
							
							<div class="row">
								<div class="4u 12u$(xsmall)">&emsp;</div>
								<div class="5u 12u$(xsmall)">
									<h4 style="float: left;">Comida</h4>
								</div>
							
							</div>
							
							<br />
							
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Horario: </label>
								</div>
								<div class="2u 12u$(xsmall)">
									<div class="select-wrapper">
										<select name="demo-category" id="slcHrComida">
										<?php echo $comboHr;?>
									</select>
									</div>
								</div>
								<div class="2u 12u$(xsmall)">
									<label>Actividades: </label>
								</div>
								<div class="6u 12u$(xsmall)">
								<textarea rows="2" cols="" id="txtComida"></textarea>
								</div>
								
							</div>
							
							
							<br />
							
							<div class="row">
								<div class="4u 12u$(xsmall)">&emsp;</div>
								<div class="5u 12u$(xsmall)">
									<h4 style="float: left;">Colaci&oacute;n 2</h4>
								</div>
							
							</div>
							
							<br />
							
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Horario: </label>
								</div>
								<div class="2u 12u$(xsmall)">
									<div class="select-wrapper">
										<select name="demo-category" id="slcHrColacion2">
										<?php echo $comboHr;?>
									</select>
									</div>
								</div>
								<div class="2u 12u$(xsmall)">
									<label>Actividades: </label>
								</div>
								<div class="6u 12u$(xsmall)">
								<textarea rows="2" cols="" id="txtColacion2"></textarea>
								</div>
								
							</div>
							
							
							<br />
							
							
							<div class="row">
								<div class="4u 12u$(xsmall)">&emsp;</div>
								<div class="5u 12u$(xsmall)">
									<h4 style="float: left;">Cena</h4>
								</div>
							
							</div>
							
							<br />
							
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Horario: </label>
								</div>
								<div class="2u 12u$(xsmall)">
									<div class="select-wrapper">
										<select name="demo-category" id="slcHrCena">
										<?php echo $comboHr;?>
									</select>
									</div>
								</div>
								<div class="2u 12u$(xsmall)">
									<label>Actividades: </label>
								</div>
								<div class="6u 12u$(xsmall)">
								<textarea rows="2" cols="" id="txtCena"></textarea>
								</div>
								
							</div>
							
							<br />
							
							<br />
							
							<div class="row">
								<div class="12u"></div>
								<a id="btnGuardar" class="button special">Guardar</a>
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