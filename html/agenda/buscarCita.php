<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Citas</title>
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
									<h2 id="content">B&uacute;squeda de cita</h2>
									
									<input type="hidden" id="hdnRol" value="<?php echo $objSession->getidRol();?>"/>
									<div class="row" id="">

                						<div class="1u 12u$(xsmall)">
                							<label>D&iacute;a:</label>
                						</div>
                						<div class="2u 12u$(xsmall)">
                							<input type="text" id="txtFecha" placeholder="AAAA-MM-DD"
                								readonly="readonly" class="datepicker" />
                						</div>

						<?php if ($objSession->getidRol()==1){?>
    								<div class="1u 12u$(xsmall)">
    									<label>Sucursal:</label>
    								</div>
    								<div class="3u 12u$(xsmall)">
    									<div class="select-wrapper">
    										<select name="demo-category" id="slcSucursal">
	    									</select>
    									</div>
    								</div>
    								<?php } else {?>
									<input type="hidden" id="slcSucursal" value="<?php echo $objSession->getIdSucursal();?>"/>
									<?php } ?>

						<div class="1u 12u$(xsmall)">
							<label>Paciente:</label>
						</div>
						<div class="5u 12u$(xsmall)" id="divPaciente">
							<select id="slcPaciente" style="width: 450px;">
							</select>
						</div>

					</div>
					<br />
					<div class="row " id="">
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

					</div>
					<br />
					<div class="row">
						<div class="1u 12u$(xsmall)">
							<label>Estatus:</label>
						</div>

						<div class="3u 12u$(xsmall)">
							<div class="select-wrapper">
								<select name="demo-category" id="slcEstatus">
									<option value="">Todos</option>
									<option value="nueva">Nueva</option>
									<option value="cancelada">Cancelada</option>
									<option value="realizada">Realizada</option>
								</select>
							</div>
						</div>
						
								<div class="7u"></div>
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