<?php 
require_once 'masterInclude.inc.php';
$paciente = new ModeloPaciente();
$paciente->setIdPaciente($idPaciente);
$hojaClinica=new ModeloHojaclinica();
$hojaClinica->setIdHojaClinica($paciente->getIdHojaClinica());
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Editar paciente </title>
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
									<h2 id="content"><img src="images/editPaciente.png" style="width: 55px;" />&emsp;Actualizar informaci&oacute;n del paciente </h2>
								</section>

				<div class="row">
					<div class="11u 12u$(small)">
					<input type="hidden" value="<?php echo $hojaClinica->getIdHojaClinica();?>" id="idHoja"/>
					<input type="hidden" value="<?php echo $paciente->getIdPaciente();?>" id="idPaciente"/>
					<input type="hidden" value="<?php echo $hojaClinica->getMotivacion();?>" id="hdnMotivacion"/>
				<input type="hidden" value="<?php echo $hojaClinica->getHorarioAcostarse();?>" id="hdnHorarioAcostarse"/>
				<input type="hidden" value="<?php echo $hojaClinica->getHorarioActividad();?>" id="hdnHorarioActividad"/>
				<input type="hidden" value="<?php echo $hojaClinica->getHorarioCena();?>" id="hdnHorarioCena"/>
				<input type="hidden" value="<?php echo $hojaClinica->getHorarioColacion();?>" id="hdnHorarioColacion"/>
				<input type="hidden" value="<?php echo $hojaClinica->getHorarioColacion2();?>" id="hdnHorarioColacion2"/>
				<input type="hidden" value="<?php echo $hojaClinica->getHorarioComida();?>" id="hdnHorarioComida"/>
				<input type="hidden" value="<?php echo $hojaClinica->getHorarioDesayuno();?>" id="hdnHorarioDesayuno"/>
				<input type="hidden" value="<?php echo $hojaClinica->getHorarioLevantarse();?>" id="hdnHorarioLevantarse"/>
				<input type="hidden" value="<?php echo $paciente->getLlenado();?>" id="hdnLlenado"/>
									
				
							<div class="row">
								<div class="3u 12u$(xsmall)"> <form>
																<input id="demo-priority-Minimo" name="datos" value="Minimo" type="radio" <?php if ($paciente->getLlenado()=="Minimo") :?>checked="checked" <?php endif;?> <?php if ($paciente->getLlenado()=="Completo") :?> disabled="disabled" <?php endif;?> >
																<label for="demo-priority-Minimo">M&iacute;nimo</label> 
																<input id="demo-priority-Completo" name="datos" value="Completo" type="radio" <?php if ($paciente->getLlenado()=="Completo") :?>checked="checked" <?php endif;?>>
																<label for="demo-priority-Completo">Completo</label>
															</form>
								</div>
							</div>
									
					<div id="divMinimo" style="display:<?php echo ($paciente->getLlenado()=='Minimo'?" ":"none");?>">
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<h3>Datos personales</h3>
								</div>
							</div>
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Nombre:</label>
								</div>
								<div class="7u 12u$(xsmall)">
									<input type="text" id="txtNombre2" value="<?php echo $paciente->getNombre();?>"/>
								</div>
							</div>
							<br />
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Apellidos:</label>
								</div>
								<div class="7u 12u$(xsmall)">
									<input type="text" id="txtApellidos2" value="<?php echo $paciente->getApellidos();?>"/>
								</div>
							</div>
							<br />
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Tel&eacute;fono (m&oacute;vil):</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtTelMovil2" class="numeric" maxlength="10" value="<?php echo $paciente->getTelefonoCel();?>"/>
								</div>
								<div class="2u 12u$(xsmall)">
									<label>Sexo:</label>
								</div>
								<div class="2u 12u$(xsmall)"> <form>
																<input id="demo-priority-Masculino2" name="sexo2" value="Masculino" type="radio" <?php if ($paciente->getSexo()=="Masculino") echo "checked";?> disabled="disabled">
																<label for="demo-priority-Masculino2">Masculino</label>
																<input id="demo-priority-Femenino2" name="sexo2" value="Femenino" type="radio" <?php if ($paciente->getSexo()=="Femenino") echo "checked";?> disabled="disabled">
																<label for="demo-priority-Femenino2">Femenino</label> </form>
								</div>
							</div>
							<br />
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Correo electr&oacute;nico:</label>
								</div>
								<div class="4u 12u$(xsmall)">
									<input type="text" id="txtCorreo2" value="<?php echo $paciente->getCorreo();?>"/>
								</div>
							</div>					
							<br />
							
							<div class="row">
								<div class="12u"></div>
								<a id="btnGuardar2" class="button special">Guardar</a>
							</div>

					</div>		
							
				<div id="divCompleto" style="display:<?php echo ($paciente->getLlenado()=='Completo'?" ":"none");?>">
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<h3>Datos personales</h3>
								</div>
							</div>
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Nombre:</label>
								</div>
								<div class="7u 12u$(xsmall)">
									<input type="text" id="txtNombre" value="<?php echo $paciente->getNombre();?>"/>
								</div>
							</div>
							<br />
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Apellidos:</label>
								</div>
								<div class="7u 12u$(xsmall)">
									<input type="text" id="txtApellidos" value="<?php echo $paciente->getApellidos();?>"/>
								</div>
							</div>
							<br />
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Ocupaci&oacute;n:</label>
								</div>
								<div class="7u 12u$(xsmall)">
									<input type="text" id="txtOcupacion" value="<?php echo $paciente->getOcupacion();?>" readonly="readonly"/>
								</div>
							</div>
							<br />
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Tel&eacute;fono (casa):</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtTelCasa" class="numeric" maxlength="10" value="<?php echo $paciente->getTelefonoCasa();?>"/>
								</div>
								<div class="3u 12u$(xsmall)">
									<label>Tel&eacute;fono (m&oacute;vil):</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtTelMovil" class="numeric" maxlength="10" value="<?php echo $paciente->getTelefonoCel();?>"/>
								</div>
							</div>
							<br />
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Sexo:</label>
								</div>
								<div class="2u 12u$(xsmall)"> <form>
																<input id="demo-priority-Masculino" name="sexo" value="Masculino" type="radio" <?php if ($paciente->getSexo()=="Masculino") echo "checked";?> disabled="disabled">
																<label for="demo-priority-Masculino">Masculino</label>
																<input id="demo-priority-Femenino" name="sexo" value="Femenino" type="radio" <?php if ($paciente->getSexo()=="Femenino") echo "checked";?> disabled="disabled">
																<label for="demo-priority-Femenino">Femenino</label> </form>
								</div>
								<div class="3u 12u$(xsmall)">
									<label>Edad:</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtEdad" class="numeric" maxlength="2" value="<?php echo $paciente->getEdad();?>"  readonly="readonly"/>
								</div>
							</div>
							<br />
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Correo electr&oacute;nico:</label>
								</div>
								<div class="4u 12u$(xsmall)">
									<input type="text" id="txtCorreo" value="<?php echo $paciente->getCorreo();?>"/>
								</div>
							</div>
							<br />
							<div class="row">	
								<div class="7u 12u$(xsmall)">
									<label>Fecha de nacimiento:</label>
								</div>
								<div class="3u 12u$(xsmall)">
									<input type="date" id="txtFecha" value="<?php echo $paciente->getFechaNacimiento();?>" readonly="readonly"/>
								</div>
								
							</div>
							<br />
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<h3>Hoja cl&iacute;nica</h3>
								</div>
							</div>
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Cirug&iacute;as:</label>
								</div>
								<div class="2u 12u$(xsmall)"> <form >
																<input id="demo-priority-si" name="cirugias"  value="Si" type="radio" <?php if ($hojaClinica->getCirugia()=="Si") echo "checked";?>>
																<label style="float: left;" for="demo-priority-si">Si</label>
																<input id="demo-priority-no" name="cirugias" value="No" type="radio" <?php if ($hojaClinica->getCirugia()=="No") echo "checked";?>>
																<label style="float: left;" for="demo-priority-no">No</label> </form>
								</div>
								<div class="2u 12u$(xsmall) divCirugia" style="display: <?php if ($hojaClinica->getCirugia()=="No") echo "none";?>;">
									<label>&iquest;Cu&aacute;l?</label>
								</div>
								<div class="5u 12u$(xsmall) divCirugia" style="display: <?php if ($hojaClinica->getCirugia()=="No") echo "none";?>;">
									<input type="text" id="txtCirugias"  value="<?php echo $hojaClinica->getCirugias();?>"/>
								</div>
								
							</div>
							
							<br />
							
							<div class="row">
							<div class="2u 12u$(xsmall)">
									<label>Enfermedades:</label>
								</div>
								
								<div class="6u 12u$(xsmall)">
								<textarea rows="1" cols="" id="txtEnfermedades"><?php echo $hojaClinica->getEnfermedades();?></textarea>
							</div>
							
							</div>
							<br />
							
							<div class="row" >
								<div class="3u 12u$(xsmall)" >
									<label style="float: right;">Padece de estre&ntilde;imiento:</label>
								</div>
								<div class="2u 12u$(xsmall)" > <form>
																<input id="demo-priority-siE" name="estrenimiento" value="Si" type="radio" <?php if ($hojaClinica->getEstrenimiento()=="Si") echo "checked";?>>
																<label style="float: left;" for="demo-priority-siE">Si</label>
																<input id="demo-priority-noE" name="estrenimiento" value="No" type="radio" <?php if ($hojaClinica->getEstrenimiento()=="No") echo "checked";?>>
																<label style="float: left;" for="demo-priority-noE">No</label> </form>
								</div>
								<div class="2u 12u$(xsmall) divEstren" style="display: <?php if ($hojaClinica->getEstrenimiento()=="No") echo "none";?>;">
									<label>&iquest;Qu&eacute; tan frecuente?</label>
								</div>
								<div class="5u 12u$(xsmall)  divEstren" style="display: <?php if ($hojaClinica->getEstrenimiento()=="No") echo "none";?>;"><form >
																<input id="demo-priority-1E" name="estrenimientoF" value="1" type="radio" <?php if ($hojaClinica->getEstrenimientoFrecuencia()=="1") echo "checked";?>>
																<label style="float: left;" for="demo-priority-1E">Diario</label>
																<input id="demo-priority-2E" name="estrenimientoF" value="2" type="radio" <?php if ($hojaClinica->getEstrenimientoFrecuencia()=="2") echo "checked";?>>
																<label style="float: left;" for="demo-priority-2E">Casi diario</label>
																<input id="demo-priority-3E" name="estrenimientoF" value="3" type="radio" <?php if ($hojaClinica->getEstrenimientoFrecuencia()=="3") echo "checked";?>>
																<label style="float: left;" for="demo-priority-3E">Eventualmente</label> </form>
								</div>
							</div>
							
							<br />
							
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Periodo menstrual:</label>
								</div>
								<div class="12u$(xsmall)">
											<form>					<input id="demo-priority-regular" name="menstrual" value="Regular" type="radio" <?php if ($hojaClinica->getMenstruacion()=="Regular") echo "checked";?>>
																<label style="float: left;" for="demo-priority-regular">Regular</label>
																<input id="demo-priority-irregular" name="menstrual" value="Irregular" type="radio" <?php if ($hojaClinica->getMenstruacion()=="Irregular") echo "checked";?>> 
																<label style="float: left;" for="demo-priority-irregular">Irregular</label>
																<input id="demo-priority-menopausa" name="menstrual" value="Menopausa" type="radio" <?php if ($hojaClinica->getMenstruacion()=="Menopausa") echo "checked";?>> 
																<label style="float: left;" for="demo-priority-menopausa">Menopausa</label>
																<input id="demo-priority-yano" name="menstrual" value="No" type="radio" <?php if ($hojaClinica->getMenstruacion()=="") echo "No";?>> 
																<label style="float: left;" for="demo-priority-yano">Ya no menstr&uacute;a</label> 
														</form>
								</div>
							</div>
							
							<br />
							
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<label>Alergia a alg&uacute;n alimento:</label>
								</div>
								<div class="2u 12u$(xsmall)"> <form >
																<input id="demo-priority-siA" name="alergia" value="Si" type="radio" <?php if ($hojaClinica->getAlergia()=="Si") echo "checked";?>>
																<label style="float: left;" for="demo-priority-siA">Si</label>
																<input id="demo-priority-noA" name="alergia" value="No" type="radio" <?php if ($hojaClinica->getAlergia()=="No") echo "checked";?>>
																<label style="float: left;" for="demo-priority-noA">No</label> </form>
								</div>
								<div class="1u 12u$(xsmall)  divAlergia" style="display: <?php if ($hojaClinica->getAlergia()=="No") echo "none";?>;">
									<label>&iquest;Cu&aacute;l?</label>
								</div>
								<div class="5u 12u$(xsmall)  divAlergia" style="display: <?php if ($hojaClinica->getAlergia()=="No") echo "none";?>;">
									<input type="text" id="txtAlergias" class="" value="<?php echo $hojaClinica->getAlimento();?>"/>
								</div>
							</div>
							
							<br />
							
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<label>&iquest;Cu&aacute;ntas horas duerme?</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtDormir" class="numeric" maxlength="2" value="<?php echo $hojaClinica->getHrsDormir();?>"/>
								</div>
								
								<div class="3u 12u$(xsmall)">
									<label>&iquest;Cu&aacute;ntas comidas realiza al d&iacute;a?</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtComidas" class="numeric" maxlength="2" value="<?php echo $hojaClinica->getHrsComer();?>"/>
								</div>
							</div>
							
							<br />
							
							<div class="row" >
								<div class="2u 12u$(xsmall)" >
									<label style="float: right;">Toma caf&eacute;?</label>
								</div>
								<div class="2u 12u$(xsmall)" > <form>
																<input id="demo-priority-siCafe" name="cafe" value="Si" type="radio" <?php if ($hojaClinica->getCafe()=="Si") echo "checked";?>>
																<label style="float: left;" for="demo-priority-siCafe">Si</label>
																<input id="demo-priority-noCafe" name="cafe" value="No" type="radio" <?php if ($hojaClinica->getCafe()=="No") echo "checked";?>>
																<label style="float: left;" for="demo-priority-noCafe">No</label> </form>
								</div>
								<div class="3u 12u$(xsmall)  divCafe" style="display: <?php if ($hojaClinica->getCafe()=="No") echo "none";?>;">
									<label>&iquest;Qu&eacute; tan frecuente?</label>
								</div>
								<div class="5u 12u$(xsmall) divCafe" style="display: <?php if ($hojaClinica->getCafe()=="No") echo "none";?>;"><form >
																<input id="demo-priority-1Cafe" name="cafeF" value="1" type="radio" <?php if ($hojaClinica->getCafeFrecuencia()=="1") echo "checked";?>>
																<label style="float: left;" for="demo-priority-1Cafe">Diario</label>
																<input id="demo-priority-2Cafe" name="cafeF" value="2" type="radio" <?php if ($hojaClinica->getCafeFrecuencia()=="2") echo "checked";?>>
																<label style="float: left;" for="demo-priority-2Cafe">Casi diario</label>
																<input id="demo-priority-3Cafe" name="cafeF" value="3" type="radio" <?php if ($hojaClinica->getCafeFrecuencia()=="3") echo "checked";?>>
																<label style="float: left;" for="demo-priority-3Cafe">Eventualmente</label> </form>
								</div>
							</div>
							
							<br />
							
							<div class="row" >
								<div class="2u 12u$(xsmall)" >
									<label style="float: right;">&iquest;Fuma?</label>
								</div>
								<div class="2u 12u$(xsmall)" > <form>
																<input id="demo-priority-siFuma" name="fuma" value="Si" type="radio" <?php if ($hojaClinica->getFuma()=="Si") echo "checked";?>>
																<label style="float: left;" for="demo-priority-siFuma">Si</label>
																<input id="demo-priority-noFuma" name="fuma" value="No" type="radio"  <?php if ($hojaClinica->getFuma()=="No") echo "checked";?>>
																<label style="float: left;" for="demo-priority-noFuma">No</label> </form>
								</div>
								<div class="3u 12u$(xsmall) divFuma" style="display: <?php if ($hojaClinica->getFuma()=="No") echo "none";?>;">
									<label>&iquest;Qu&eacute; tan frecuente?</label>
								</div>
								<div class="5u 12u$(xsmall) divFuma" style="display: <?php if ($hojaClinica->getFuma()=="No") echo "none";?>;"> <form >
																<input id="demo-priority-1Fuma" name="fumaF" value="1" type="radio" <?php if ($hojaClinica->getFumaFrecuencia()=="1") echo "checked";?>>
																<label style="float: left;" for="demo-priority-1Fuma">Diario</label>
																<input id="demo-priority-2Fuma" name="fumaF" value="2" type="radio" <?php if ($hojaClinica->getFumaFrecuencia()=="2") echo "checked";?>>
																<label style="float: left;" for="demo-priority-2Fuma">Casi diario</label>
																<input id="demo-priority-3Fuma" name="fumaF" value="3" type="radio"  <?php if ($hojaClinica->getFumaFrecuencia()=="3") echo "checked";?>>
																<label style="float: left;" for="demo-priority-3Fuma">Eventualmente</label> </form>
								</div>
							</div>
							
							<br />
							
							<div class="row" >
								<div class="3u 12u$(xsmall)" >
									<label style="float: right;">Ingiere bebidas alcoh&oacute;licas?</label>
								</div>
								<div class="2u 12u$(xsmall)" > <form>
																<input id="demo-priority-siBebe" name="bebidas" value="Si" type="radio" <?php if ($hojaClinica->getBeber()=="Si") echo "checked";?>>
																<label style="float: left;" for="demo-priority-siBebe">Si</label>
																<input id="demo-priority-noBebe" name="bebidas" value="No" type="radio" <?php if ($hojaClinica->getBeber()=="No") echo "checked";?>>
																<label style="float: left;" for="demo-priority-noBebe">No</label> </form>
								</div>
								<div class="2u 12u$(xsmall)  divBebidas" style="display: <?php if ($hojaClinica->getBeber()=="No") echo "none";?>;">
									<label>Frecuencia</label>
								</div>
								<div class="5u 12u$(xsmall) divBebidas" style="display: <?php if ($hojaClinica->getBeber()=="No") echo "none";?>;"> <form >
																<input id="demo-priority-1Bebe" name="bebidasF" value="1" type="radio" <?php if ($hojaClinica->getBeberFrecuencia()=="1") echo "checked";?>>
																<label style="float: left;" for="demo-priority-1Bebe">Diario</label>
																<input id="demo-priority-2Bebe" name="bebidasF" value="2" type="radio" <?php if ($hojaClinica->getBeberFrecuencia()=="2") echo "checked";?>>
																<label style="float: left;" for="demo-priority-2Bebe">Casi diario</label>
																<input id="demo-priority-3Bebe" name="bebidasF" value="3" type="radio" <?php if ($hojaClinica->getBeberFrecuencia()=="3") echo "checked";?>>
																<label style="float: left;" for="demo-priority-3Bebe">Eventualmente</label> </form>
								</div>
							</div>
							
							<div class="row">
							<div class="3u 12u$(xsmall)">
									<label>Alimentos desagradables:</label>
								</div>
								
								<div class="5u 12u$(xsmall)">
								<textarea rows="1" cols="" id="txtDesagradable"><?php echo $hojaClinica->getDesagradables();?></textarea>
								</div>
								
								<div class="2u 12u$(xsmall)">
									<label>Ansiedad:</label>
								</div>
								<div class="2u 12u$(xsmall)"> <form >
																<input id="demo-priority-siAnsiedad" name="ansiedad" value="Si" type="radio" <?php if ($hojaClinica->getAnsiedad()=="Si") echo "checked";?>>
																<label style="float: left;" for="demo-priority-siAnsiedad">Si</label>
																<input id="demo-priority-noAnsiedad" name="ansiedad" value="No" type="radio" <?php if ($hojaClinica->getAnsiedad()=="No") echo "checked";?>>
																<label style="float: left;" for="demo-priority-noAnsiedad">No</label> </form>
								</div>
							</div>
							
							<br />
							
							<div class="row" >
								<div class="3u 12u$(xsmall)" >
									<label style="float: right;">Realiza alguna actividad f&iacute;sica?</label>
								</div>
								<div class="2u 12u$(xsmall)" > <form>
																<input id="demo-priority-siActividad" name="actividadFisica" value="Si" type="radio" <?php if ($hojaClinica->getActividadFisica()=="Si") echo "checked";?>>
																<label style="float: left;" for="demo-priority-siActividad">Si</label>
																<input id="demo-priority-noActividad" name="actividadFisica" value="No" type="radio" <?php if ($hojaClinica->getActividadFisica()=="No") echo "checked";?>>
																<label style="float: left;" for="demo-priority-noActividad">No</label> </form>
								</div>
								<div class="1u 12u$(xsmall)  divActividad" style="display: <?php if ($hojaClinica->getActividadFisica()=="No") echo "none";?>;">
									<label>&iquest;Cu&aacute;l?</label>
								</div>
								<div class="5u 12u$(xsmall  divActividad" style="display: <?php if ($hojaClinica->getActividadFisica()=="No") echo "none";?>;">
									<input type="text" id="txtActividad" value="<?php echo $hojaClinica->getActividad();?>"/>
								</div>
								
							</div>
							
							
							<br />
							
							<div class="row  divActividad" style="display: <?php if ($hojaClinica->getActividadFisica()=="No") echo "none";?>;">
							
								<div class="2u 12u$(xsmall)">
									<label>&iquest;Cu&aacute;nto tiempo?</label>
								</div>
								<div class="1u 12u$(xsmall)">
									<input type="text" id="txtTiempo" class="numeric" maxlength="2" value="<?php echo $hojaClinica->getTiempo();?>"/>
								</div>
								<div class="2u 12u$(xsmall)">
								<div class="select-wrapper">
									<select name="demo-category" id="slcTiempo">
									<option value="hrs" <?php if ($hojaClinica->getTiempoSimbolo()=="hrs") echo "selected";?>>Hrs</option>
									<option value="min" <?php if ($hojaClinica->getTiempoSimbolo()=="min") echo "selected";?>>Min</option>
									</select>
								</div>
								</div>
								<div class="2u 12u$(xsmall)">
									<label>Frecuencia:</label>
								</div>
								<div class="5u 12u$(xsmall)"><form >
																<input id="demo-priority-1Ejecicio" name="actividadTiempo" value="1" type="radio" <?php if ($hojaClinica->getActividadFisicaFrecuencia()=="1") echo "checked";?>>
																<label style="float: left;" for="demo-priority-1Ejecicio">Diario</label>
																<input id="demo-priority-2Ejecicio" name="actividadTiempo" value="2" type="radio" <?php if ($hojaClinica->getActividadFisicaFrecuencia()=="2") echo "checked";?>>
																<label style="float: left;" for="demo-priority-2Ejecicio">Casi diario</label>
																<input id="demo-priority-3Ejecicio" name="actividadTiempo" value="3" type="radio" <?php if ($hojaClinica->getActividadFisicaFrecuencia()=="3") echo "checked";?>>
																<label style="float: left;" for="demo-priority-3Ejecicio">Eventualmente</label> </form>
								</div>
								
							</div>
							
							<br />
							
							<div class="row">
								<div class="5u 12u$(xsmall)">
									<label>&iquest;Qu&eacute; tan motivado(a) est&aacute; para iniciar el plan nutricional? </label>
								</div>
								<div class="1u 12u$(xsmall)">
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
								<div class="3u 12u$(xsmall)">
									<label>Horario de levantarse: </label>
								</div>
								<div class="2u 12u$(xsmall)">
									<div class="select-wrapper">
										<select name="demo-category" id="slcHrLevantar">
										<?php echo $comboHr;?>
									</select>
									</div>
								</div>
							</div>
								
							<br />
							
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<label>Horario de acostarse: </label>
								</div>
								<div class="2u 12u$(xsmall)">
									<div class="select-wrapper">
										<select name="demo-category" id="slcHrAcostar">
										<?php echo $comboHr;?>
									</select>
									</div>
								</div>
							
							</div>
							
							<br />
							
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<label>Horario de actividad f&iacute;sica: </label>
								</div>
								<div class="2u 12u$(xsmall)">
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
								<div class="3u 12u$(xsmall)">&emsp;</div>
								<div class="2u 12u$(xsmall)">
									<h4 style="float: left;">Desayuno</h4>
								</div>
								<div class="3u 12u$(xsmall)"> <form >
																<input id="demo-priority-sidesayunoF" name="desayunoF"  value="Si" type="radio" <?php if ($hojaClinica->getDesayuno()=="Si") echo "checked";?>>
																<label style="float: left;" for="demo-priority-sidesayunoF">Si</label>
																<input id="demo-priority-nodesayunoF" name="desayunoF" value="No" type="radio" <?php if ($hojaClinica->getDesayuno()=="No") echo "checked";?>>
																<label style="float: left;" for="demo-priority-nodesayunoF">No</label> </form>
								</div>
							
							</div>
							
							<br />
							
							<div class="row divDesayuno" style="display: <?php if ($hojaClinica->getDesayuno()=="No") echo "none";?>;">
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
									<label>Alimentos: </label>
								</div>
								<div class="6u 12u$(xsmall)">
								<textarea rows="2" cols="" id="txtDesayuno"><?php echo $hojaClinica->getActividadDesayuno();?></textarea>
								</div>
								
							</div>
							
							<br />
							
							<div class="row">
								<div class="3u 12u$(xsmall)">&emsp;</div>
								<div class="2u 12u$(xsmall)">
									<h4 style="float: left;">Colaci&oacute;n 1</h4>
								</div>
								<div class="3u 12u$(xsmall)"> <form >
																<input id="demo-priority-sicolacionF" name="colacionF"  value="Si" type="radio" <?php if ($hojaClinica->getColacion()=="Si") echo "checked";?>>
																<label style="float: left;" for="demo-priority-sicolacionF">Si</label>
																<input id="demo-priority-nocolacionF" name="colacionF" value="No" type="radio" <?php if ($hojaClinica->getColacion()=="No") echo "checked";?>>
																<label style="float: left;" for="demo-priority-nocolacionF">No</label> </form>
								</div>
							
							</div>
							
							<br />
							
							<div class="row  divColacion1" style="display: <?php if ($hojaClinica->getColacion()=="No") echo "none";?>;">
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
									<label>Alimentos: </label>
								</div>
								<div class="6u 12u$(xsmall)">
								<textarea rows="2" cols="" id="txtColacion1"><?php echo $hojaClinica->getActividadColacion();?></textarea>
								</div>
								
							</div>
							
							
							<br />
							
							<div class="row">
								<div class="3u 12u$(xsmall)">&emsp;</div>
								<div class="2u 12u$(xsmall)">
									<h4 style="float: left;">Comida</h4>
								</div>
								<div class="3u 12u$(xsmall)"> <form >
																<input id="demo-priority-sicomidaF" name="comidaF"  value="Si" type="radio" <?php if ($hojaClinica->getComida()=="Si") echo "checked";?>>
																<label style="float: left;" for="demo-priority-sicomidaF">Si</label>
																<input id="demo-priority-nocomidaF" name="comidaF" value="No" type="radio" <?php if ($hojaClinica->getComida()=="No") echo "checked";?>>
																<label style="float: left;" for="demo-priority-nocomidaF">No</label> </form>
								</div>
							
							</div>
							
							<br />
							
							<div class="row divComida" style="display: <?php if ($hojaClinica->getComida()=="No") echo "none";?>;">
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
									<label>Alimentos: </label>
								</div>
								<div class="6u 12u$(xsmall)">
								<textarea rows="2" cols="" id="txtComida"><?php echo $hojaClinica->getActividadComida();?></textarea>
								</div>
								
							</div>
							
							
							<br />
							
							<div class="row">
								<div class="3u 12u$(xsmall)">&emsp;</div>
								<div class="2u 12u$(xsmall)">
									<h4 style="float: left;">Colaci&oacute;n 2</h4>
								</div>
								<div class="3u 12u$(xsmall)"> <form >
																<input id="demo-priority-sicolacion2F" name="colacion2F"  value="Si" type="radio" <?php if ($hojaClinica->getColacion2()=="Si") echo "checked";?>>
																<label style="float: left;" for="demo-priority-sicolacion2F">Si</label>
																<input id="demo-priority-nocolacion2F" name="colacion2F" value="No" type="radio" <?php if ($hojaClinica->getColacion2()=="No") echo "checked";?>>
																<label style="float: left;" for="demo-priority-nocolacion2F">No</label> </form>
								</div>
							
							</div>
							
							<br />
							
							<div class="row divColacion2" style="display: <?php if ($hojaClinica->getColacion2()=="No") echo "none";?>;">
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
									<label>Alimentos: </label>
								</div>
								<div class="6u 12u$(xsmall)">
								<textarea rows="2" cols="" id="txtColacion2"><?php echo $hojaClinica->getActividadColacion2();?></textarea>
								</div>
								
							</div>
							
							
							<br />
							
							
							<div class="row">
								<div class="3u 12u$(xsmall)">&emsp;</div>
								<div class=2u 12u$(xsmall)">
									<h4 style="float: left;">Cena</h4>
								</div>
								<div class="3u 12u$(xsmall)"> <form >
																<input id="demo-priority-sicenaF" name="cenaF"  value="Si" type="radio" <?php if ($hojaClinica->getCena()=="Si") echo "checked";?>>
																<label style="float: left;" for="demo-priority-sicenaF">Si</label>
																<input id="demo-priority-nocenaF" name="cenaF" value="No" type="radio" <?php if ($hojaClinica->getCena()=="No") echo "checked";?>>
																<label style="float: left;" for="demo-priority-nocenaF">No</label> </form>
								</div>
							
							</div>
							
							<br />
							
							<div class="row divCena" style="display: <?php if ($hojaClinica->getCena()=="No") echo "none";?>;">
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
									<label>Alimentos: </label>
								</div>
								<div class="6u 12u$(xsmall)">
								<textarea rows="2" cols="" id="txtCena"><?php echo $hojaClinica->getActividadCena();?></textarea>
								</div>
								
							</div>
							<br />
							
							<div class="row">
								<div class="12u"></div>
								<a id="btnGuardar" class="button special">Guardar</a>
							</div>

				</div>
				
				
							<br />
							<input type="hidden" id="hdnRol" value="<?php echo $objSession->getidRol();?>"/>
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