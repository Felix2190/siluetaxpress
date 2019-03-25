<?php
require_once 'masterInclude.inc.php';
?>
<!doctype html>
<html >
<head>
		<title> Reservar espacio </title>
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
									<h2 id="content"><img src="images/cita.png" style="width: 70px;" />&ensp;Registro </h2>
								</section>

				<div class="row">
					<div class="12u 12u$(small)">
						<div class="box">
						<input type="hidden" id="hdnRol" value="<?php echo $objSession->getidRol();?>"/>
							<div class="row uniform" id="divInicio">
								<div class="4u 12u$(xsmall)">
									<form>
										<input id="demo-priority-fechas" name="rango" value="fecha" type="radio" checked="checked"> 
										<label for="demo-priority-fechas">Entre fechas</label> 
										<input id="demo-priority-dia" name="rango" value="dia" type="radio"> 
										<label for="demo-priority-dia">D&iacute;a</label> 
										<input id="demo-priority-hora" name="rango" value="horario" type="radio"> 
										<label for="demo-priority-hora">Horario</label> 
									</form>
								</div>
								
								
							</div>
							
							<div class="row uniform" id="div">
								<div class="2u 12u$(xsmall)">
									<label>Fecha inicial:</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtFecha1" placeholder="AAAA-MM-DD" readonly="readonly"
																class="datepicker" />
								</div>
								
								<div class="2u 12u$(xsmall) Fecha2">
									<label>Fecha final:</label>
								</div>
								<div class="2u 12u$(xsmall) Fecha2">
									<input type="text" id="txtFecha2" placeholder="AAAA-MM-DD" readonly="readonly"
																class="datepicker" />
								</div>
								
							</div>
							
							<div class="row uniform" id="div">
							
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
								
								<div class="8u 12u$(small)" style="display: none;" id="divCabinas">
    								<div class="row" id="checksCabinas">
    								<div class="2u 12u$(small)">
    									<input class="checkDias" value="lunes" id="chklunes" name="chklunes"  type="checkbox"> <label for="chklunes">Lunes</label>
    								</div>
    								
    								</div>
    							</div>
								
							</div>
							
							
							<div class="row uniform" id="div">
								<div class="2u 12u$(xsmall) HrI">
									<label>Hora inicial:</label>
								</div>
								
								<div class="1u 12u$(xsmall) HrI">
									<div class="select-wrapper">
										<select name="demo-category" id="slcHrI">
										<option value=""></option>
									</select>
									</div>
								</div>
								<div class="1u 12u$(xsmall) MinI">
									<div class="select-wrapper">
										<select name="demo-category" id="slcMinI">
										<option value=""></option>
										</select>
									</div>
								</div>
								
								
								<div class="2u 12u$(xsmall) HrF">
									<label>Hora final:</label>
								</div>
								
								<div class="1u 12u$(xsmall) HrF">
									<div class="select-wrapper">
										<select name="demo-category" id="slcHrF">
										<option value=""></option>
									</select>
									</div>
								</div>
								<div class="1u 12u$(xsmall) MinF">
									<div class="select-wrapper">
										<select name="demo-category" id="slcMinF">
										<option value=""></option>
										</select>
									</div>
								</div>
								
							</div>
							
							
								<div class="row uniform" id="div">
									
    								<div class="1u 12u$(xsmall)">
    									<label>Motivo:</label>
    								</div>
    								<div class="5u 12u$(xsmall)">
    									<input id="txtMotivo" type="text"/>
    								</div>
    								
								</div>
							
							
							<div class="row uniform" id="divFechasNoDisponibles" style="display: none;">
								
								<div class="3u 12u$(small)">&emsp;</div>
								<div class="6u 12u$(small)">
									<div id="divFechasNoDisponibles2"></div>
								<ul class="actions" style="float: right;"><li><a id="btnAceptar" class="button special">Aceptar</a></li><li><a id="btnCancelar" class="button">Cancelar</a></li></ul>
								
								</div>
								</div>
								
								<br />
							<br />
								
								
								
								
								
								
								
								
								
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