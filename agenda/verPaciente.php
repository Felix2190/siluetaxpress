<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Detalles del paciente</title>
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
									<h3 id="content"><img src="images/verPerfil.png" style="width: 55px;" />&ensp;<?php echo $titulo;?></h3>
								</section>
								<input type="hidden" value="<?php echo $paciente->getLlenado();?>" />
								
							<div class="row">
					<div class="12u 12u$(small)">
						<div class="box">
							<div class="row">
								<div class="1u 12u$(small)">
									Nombre:
								</div>
								<div class="5u 12u$(xsmall)">
									<p style="border-bottom: 2px solid;"><?php echo "$paciente->nombre $paciente->apellidos";?></p>
								</div>
								<div class="1u 12u$(small)">
									Edad:
								</div>
								<div class="1u 12u$(xsmall)">
									<p style="border-bottom: 2px solid;"><?php echo "$paciente->edad";?></p>
								</div>
								<div class="2u 12u$(small)">
									Fecha de nac.:
								</div>
								<div class="2u 12u$(xsmall)">
								<?php if ($paciente->fechaNacimiento!='0000-00-00'){
								    $fecha=explode("-",$paciente->fechaNacimiento);
								?>
									<p style="border-bottom: 2px solid;"><?php echo "$fecha[2] de ".obtenMes(''.intval($fecha[1]))." del $fecha[0]";?>
									</p> <?php } ?>
								</div>
								
							</div>	
						</div>
					</div>
						</div>
						
								
				
				<br />
				<?php if ($paciente->getLlenado()=="Completo"){?>
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<h4>Hoja cl&iacute;nica</h4>
								</div>
							</div>
							
			
				<div class="box">
				
			<?php $arrOpciones=array("1"=>"Diario","2"=>"Casi diario","3"=>"Eventualmente");
			
			if ($hojaClinica->getCirugia()=="Si"){?>
			<div class="row">
				<div class="2u 12u$(small)">
					<ul>
						<li><strong>Cirug&iacute;as: </strong><?php echo $hojaClinica->getCirugia();?></li>
					</ul>
					</div>
				<?php if ($hojaClinica->getCirugia()=="Si"){ ?>
					<div class="5u 12u$(small)">
						<p><?php echo $hojaClinica->getCirugias();?></p>
					</div>
			    <?php }?>
			 </div>
			<?php }?>
				
					<?php if ($hojaClinica->getEnfermedades()!=""){?>
			<div class="row">
				<div class="2u 12u$(small)">
					<ul>
						<li><strong>Enfermedades:&emsp;</strong></li>
					</ul>
					</div>
				<div class="5u 12u$(small)">
						<p><?php echo $hojaClinica->getEnfermedades();?></p>
					</div>
			 </div>
			<?php }?>
			
				<?php if ($hojaClinica->getEstrenimiento()!="sinrespuesta"){?>
			<div class="row">
				<div class="3u 12u$(small)">
					<ul>
						<li><strong>Estre&ntilde;imiento:&emsp;</strong><?php echo $hojaClinica->getEstrenimiento();?></li>
					</ul>
					</div>
				<?php if ($hojaClinica->getEstrenimiento()=="Si"){ ?>
					<div class="5u 12u$(small)">
						<p> <strong>Frecuencia:&emsp;</strong> <?php echo $arrOpciones[$hojaClinica->getEstrenimientoFrecuencia()];?></p>
					</div>
			    <?php }?>
			 </div>
			<?php }?>
			
			
				<?php if ($hojaClinica->getMenstruacion()!="sinrespuesta"){?>
			<div class="row">
				<div class="4u 12u$(small)">
					<ul>
						<li><strong>Periodo menstrual:&emsp;</strong><?php echo $hojaClinica->getMenstruacion();?></li>
					</ul>
				</div>
			 </div>
			<?php }?>
			
			
				<?php if ($hojaClinica->getAlergia()!="sinrespuesta"){?>
			<div class="row">
				<div class="3u 12u$(small)">
					<ul>
						<li><strong>Alergias:&emsp;</strong><?php echo $hojaClinica->getAlergia();?></li>
					</ul>
					</div>
				<?php if ($hojaClinica->getAlergia()=="Si"){ ?>
					<div class="5u 12u$(small)">
						<p><strong>a:&emsp;</strong> <?php echo $hojaClinica->getAlimento();?></p>
					</div>
			    <?php }?>
			 </div>
			<?php }?>
			
				<?php if ($hojaClinica->getHrsDormir()!=0||$hojaClinica->getHrsComer()!=0){?>
			<div class="row">
			
				<?php if ($hojaClinica->getHrsDormir()!=0){?>
				<div class="3u 12u$(small)">
					<ul>
						<li><strong>Duerme:&emsp;</strong><?php echo $hojaClinica->getHrsDormir();?> hrs</li>
					</ul>
				</div>
			<?php }?>
			
				<?php if ($hojaClinica->getHrsComer()!=0){?>
				<div class="5u 12u$(small)">
					<ul>
						<li><strong>Comidas al d&iacute;a:&emsp;</strong><?php echo $hojaClinica->getHrsComer();?> </li>
					</ul>
			 </div>
			<?php }?>
			
			 </div>
			<?php }?>
			
			
			<?php if ($hojaClinica->getCafe()!="sinrespuesta"){?>
			<div class="row">
				<div class="3u 12u$(small)">
					<ul>
						<li><strong>Toma caf&eacute;:&emsp;</strong><?php echo $hojaClinica->getCafe();?></li>
					</ul>
					</div>
				<?php if ($hojaClinica->getCafe()=="Si"){ ?>
					<div class="5u 12u$(small)">
						<p> <strong>Frecuencia:&emsp;</strong> <?php echo $arrOpciones[$hojaClinica->getCafeFrecuencia()];?></p>
					</div>
			    <?php }?>
			 </div>
			<?php }?>
			
			<?php if ($hojaClinica->getBeber()!="sinrespuesta"){?>
			<div class="row">
				<div class="4u 12u$(small)">
					<ul>
						<li><strong>Ingiere bebidas alcoh&oacute;licas:&emsp;</strong><?php echo $hojaClinica->getBeber();?></li>
					</ul>
					</div>
				<?php if ($hojaClinica->getBeber()=="Si"){ ?>
					<div class="5u 12u$(small)">
						<p> <strong>Frecuencia:&emsp;</strong> <?php echo $arrOpciones[$hojaClinica->getBeberFrecuencia()];?></p>
					</div>
			    <?php }?>
			 </div>
			<?php }?>
			
			<?php if ($hojaClinica->getFuma()!="sinrespuesta"){?>
			<div class="row">
				<div class="3u 12u$(small)">
					<ul>
						<li><strong>Fuma:&emsp;</strong><?php echo $hojaClinica->getFuma();?></li>
					</ul>
					</div>
				<?php if ($hojaClinica->getFuma()=="Si"){ ?>
					<div class="5u 12u$(small)">
						<p> <strong>Frecuencia:&emsp;</strong> <?php echo $arrOpciones[$hojaClinica->getFumaFrecuencia()];?></p>
					</div>
			    <?php }?>
			 </div>
			<?php }?>
			
					<?php if ($hojaClinica->getDesagradables()!=""){?>
			<div class="row">
				<div class="3u 12u$(small)">
					<ul>
						<li><strong>Alimentos desagradables:&emsp;</strong></li>
					</ul>
					</div>
				<div class="5u 12u$(small)">
						<p><?php echo $hojaClinica->getDesagradables();?></p>
					</div>
			 </div>
			<?php }?>
			
			
			<?php if ($hojaClinica->getAnsiedad()!="sinrespuesta"){?>
			<div class="row">
				<div class="2u 12u$(small)">
					<ul>
						<li><strong>Ansieda:&emsp;</strong><?php echo $hojaClinica->getAnsiedad();?></li>
					</ul>
				</div>
			 </div>
			<?php }?>
			
			
				<?php if ($hojaClinica->getActividadFisica()!="sinrespuesta"){?>
			<div class="row">
				<div class="3u 12u$(small)">
					<ul>
						<li><strong>Actividad f&iacute;sica:&emsp;</strong><?php echo $hojaClinica->getActividadFisica();?></li>
					</ul>
					</div>
				<?php if ($hojaClinica->getAlergia()=="Si"){ ?>
					<div class="4u 12u$(small)">
						<p><strong>realiza:&emsp;</strong> <?php echo $hojaClinica->getActividad();?></p>
					</div>
			    <?php }?>
			    
				<?php if ($hojaClinica->getTiempo()>0){ ?>
					<div class="2u 12u$(small)">
						<p> <strong>Tiempo:&emsp;</strong> <?php echo $hojaClinica->getTiempo().' '.$hojaClinica->getTiempoSimbolo();?></p>
					</div>
			    <?php }?>
			    <?php if ($hojaClinica->getActividadFisicaFrecuencia()>0){ ?>
					<div class="3u 12u$(small)">
						<p> <strong>Frecuencia:&emsp;</strong> <?php echo $arrOpciones[$hojaClinica->getActividadFisicaFrecuencia()];?></p>
					</div>
				<?php }?>
			 </div>
			<?php }?>
				
				 
			<div class="row">
				<div class="8u 12u$(small)">
					<ul>
						<li><strong>Motivaci&oacute;n para iniciar el plan nutricional:&emsp;</strong><?php echo $hojaClinica->getMotivacion();?></li>
					</ul>
				</div>
			 </div>
			
			
			<?php if ($hojaClinica->getHorarioLevantarse()!="00:00 AM"||$hojaClinica->getHorarioAcostarse()!="00:00 AM"||$hojaClinica->getHorarioActividad()!="00:00 AM"){?>
			<div class="row">
			
			<?php if ($hojaClinica->getHorarioLevantarse()!="00:00 AM"){?>
				<div class="4u 12u$(small)">
					<ul>
						<li><strong>Horario de levantarse:&emsp;</strong><?php echo $hojaClinica->getHorarioLevantarse();?></li>
					</ul>
				</div>
			<?php }?>
			
			<?php if ($hojaClinica->getHorarioAcostarse()!="00:00 AM"){?>
				<div class="4u 12u$(small)">
					<ul>
						<li><strong>Horario de acostarse:&emsp;</strong><?php echo $hojaClinica->getHorarioAcostarse();?></li>
					</ul>
				</div>
			<?php }?>
			
			<?php if ($hojaClinica->getHorarioActividad()!="00:00 AM"){?>
				<div class="4u 12u$(small)">
					<ul>
						<li><strong>Horario de actividad f&iacute;sica:&emsp;</strong><?php echo $hojaClinica->getHorarioActividad();?></li>
					</ul>
				</div>
			<?php }?>
			 </div>
			<?php }?>
			
			
				<!-- 
					 -->
				 
				</div>
				<br />
							<div class="row">
								<div class="3u 12u$(xsmall)">
									<h4>Recordatorio de 24 hrs</h4>
								</div>
							</div>
							
				<br />
				<div class="row">
					<div class="12u 12u$(small)">
						<div class="table-wrapper">
														<table class="alt">
															<thead>
																<tr>
																	<th></th>
																	<th>Horario</th>
																	<th colspan="3">Alimentos</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																<td >Desayuno</td>
																	<td><?php echo ($hojaClinica->getHorarioDesayuno()=="00:00 AM"?"-":$hojaClinica->getHorarioDesayuno());?></td>
																	<td colspan="3"><?php echo $hojaClinica->getActividadDesayuno();?></td>
																</tr>
																<tr>
																<td >Colaci&oacute;n 1</td>
																	<td><?php echo ($hojaClinica->getHorarioColacion()=="00:00 AM"?"-":$hojaClinica->getHorarioColacion());?></td>
																	<td colspan="3"><?php echo $hojaClinica->getActividadColacion();?></td>
																</tr>
																<tr>
																<td >Comida</td>
																	<td><?php echo ($hojaClinica->getHorarioComida()=="00:00 AM"?"-":$hojaClinica->getHorarioComida());?></td>
																	<td colspan="3"><?php echo $hojaClinica->getActividadComida();?></td>
																</tr>
																<tr>
																<td >Colaci&oacute;n 2</td>
																	<td><?php echo ($hojaClinica->getHorarioColacion2()=="00:00 AM"?"-":$hojaClinica->getHorarioColacion2());?></td>
																	<td colspan="3"><?php echo $hojaClinica->getActividadColacion2();?></td>
																</tr>
																<tr>
																<td >Cena</td>
																	<td><?php echo ($hojaClinica->getHorarioCena()=="00:00 AM"?"-":$hojaClinica->getHorarioCena());?></td>
																	<td colspan="3"><?php echo $hojaClinica->getActividadCena();?></td>
																</tr>
																
															</tbody>
														</table>
													</div>
					</div>
				</div>
				
				
				<?php } ?>
				<br />
				
				<div class="row">
				
					<div class="12u 12u$(small)">
						<a id="aPDF" onclick="verOpciones();" class="button special">Descargar PDF</a>
					</div>
				</div>
				<br />
				<div class="row">
					<div class="12u 12u$(small)">
					</div>
				</div>
				
				<br />		
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
	<div class="alertify  ajs-movable ajs-closable ajs-pinnable ajs-slide" id="msjConfirm" style="display: none;">
		<div class="ajs-dimmer"></div>
		<div class="ajs-modal" tabindex="0">
			<div class="ajs-dialog" tabindex="0" style="">
				<div class="ajs-commands">
					<button class="ajs-close"  id="btnCerrar"></button>
				</div>
				<div class="ajs-header">Hoja cl&iacute;nica</div>
				<div class="ajs-body">
					<div class="ajs-content">&iquest;Ver la opci&oacute;n de firma del paciente?</div>
				</div>
				<div class="ajs-footer">
					<div class="ajs-auxiliary ajs-buttons"></div>
					<div class="ajs-primary ajs-buttons">
						<button class="ajs-button " id="btnSi">Si</button>
						<button class="ajs-button " id="btnNo">No</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	</body>
</html>