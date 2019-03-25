<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Pacientes</title>
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
									<h2 id="content"><img src="images/buscarPaciente.png" style="width: 45px;" />&ensp; B&uacute;squeda de paciente</h2>
									
									<input type="hidden" id="hdnRol" value="<?php echo $objSession->getidRol();?>"/>
									
					<div class="row" id="">
					
					<div class="1u 12u$(xsmall)">
							<label>Nombre:</label>
						</div>
						<div class="3u 12u$(xsmall)" >
							<input type="text" id="txtNombre" />
						</div>
						
						<div class="1u 12u$(xsmall)">
							<label>Apellidos:</label>
						</div>
						<div class="3u 12u$(xsmall)" >
							<input type="text" id="txtApellidos" />
						</div>

						<div class="2u 12u$(xsmall)">
							<label>Fecha de registro:</label>
						</div>
						<div class="2u 12u$(xsmall)">
							<input type="text" id="txtFecha" placeholder="AAAA-MM-DD"
								readonly="readonly" class="datepicker" />
						</div>

						
    				</div>
    				<br />
    				
    		<div class="row" id="">

						<div class="1u 12u$(xsmall)">
							<label>Sexo:</label>
						</div>
						<div class="3u 12u$(xsmall)">
							<form>
								<input id="demo-priority-Masculino" name="sexo"
									value="Masculino" type="radio"> <label
									for="demo-priority-Masculino">Masculino</label> <input
									id="demo-priority-Femenino" name="sexo" value="Femenino"
									type="radio"> <label for="demo-priority-Femenino">Femenino</label>
							</form>
						</div>
						<div class="1u 12u$(xsmall)">
							<label>Edad:</label>
						</div>
						<div class="1u 12u$(xsmall)">
							<input type="text" id="txtEdad" class="numeric" maxlength="2" />
						</div>

						<div class="1u 12u$(xsmall)">
							<label>Tel&eacute;fono (m&oacute;vil):</label>
						</div>
						<div class="2u 12u$(xsmall)">
							<input type="text" id="txtTelMovil" class="numeric"
								maxlength="10" />
						</div>
						
						<div class="1u 12u$(xsmall)">
							<label>Estatus:</label>
						</div>
						<div class="2u 12u$(xsmall)">
							<div class="select-wrapper">
								<select name="demo-category" id="slcEstatus">
								<option value="activo">Activo</option>
								<option value="suspendido">Eliminado</option>
								</select>
							</div>
						</div>
						
				</div>
				<br />
				
				<div class="row" id="">

						<div class="1u 12u$(xsmall)">
							<label>Sucursal:</label>
						</div>
						<div class="3u 12u$(xsmall)">
							<div class="select-wrapper">
								<select name="demo-category" id="slcSucursal">
								</select>
							</div>
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
				
				<div class="row" id="">
						<div class="1u 12u$(xsmall)">
							<label>Servicio:</label>
						</div>
						<div class="3u 12u$(xsmall)">
							<input id="txtServicio" style="width: 100%;" />
						</div>
					</div>
								<br />
				
				<div class="row" id="">
				<a id="btnBuscar" class="button special" >Buscar</a>
				</div>
			</section>
			
								
					<div class="table-wrapper" id="divTabla">
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