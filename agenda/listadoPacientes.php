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
									<h2 id="content"><img src="images/pacientes.png" style="width: 60px;" />&ensp;Listado Pacientes </h2>
									
								<div class="4u 12u$(xsmall)" style="float: right;">
								<p id="fechasEntre"></p>
									</div>
									<input type="hidden" id="hdnRol" value="<?php echo $objSession->getidRol();?>"/>
									<input type="hidden" id="hdnSucursal" value="<?php echo $sucursal;?>"/>
			<!--						<?php 
									if ($objSession->getidRol()!=1):
									echo "<p><strong>Sucursal:</strong> ".$objSession->getSucursal()."</p>";
									endif;
									?>
				-->					<div class="row uniform" id="divInicio">
									
		<!--						<?php //if ($objSession->getidRol()==1){?>
			-->						<div class="1u 12u$(xsmall)">
									<label>Sucursal:</label>
								</div>
								<div class="4u 12u$(xsmall)">
									<div class="select-wrapper">
									<select name="demo-category" id="slcSucursalFranquicia">
									</select>
									</div>
									</div>
	<!-- 							<?php //} ?>
		-->						</div>
									
								
								</section>
								
							<table class="table" id="tablesorting-1">
                  											<thead>
                  											<tr >
                  											<td colspan="8" style="text-align: right;">
                  											</td>
                  											
                  											</tr>
                  												<tr>
                  													<th>Nombre</th>
                  													<th>Tel&eacute;fono</th>
                  													<th>Completitud (Hoja cl&iacute;nica)</th>
                  													<th>Fecha de registro</th>
                  													<th>Consultas realizadas</th>
                  													<th>Consultas pr&oacute;ximas</th>
                  													<th>Cita pr&oacute;xima</th>
                  													<th>Opciones</th>
                  												</tr>
                  											</thead>
                  											<tbody>
                  									
                  											</tbody>
                  											<tfoot>
                  												<tr>
                  													<td colspan="8" class="pager form-horizontal">
                  														<button class="btn first"><i class="fa fa-step-backward"></i></button>
                  														<button class="btn prev"><i class="fa fa-arrow-left"></i></button>
                  														<span class="pagedisplay"></span> <!-- this can be any element, including an input -->
                  														<button class="btn next"><i class="fa fa-arrow-right"></i></button>
                  														<button class="btn last"><i class="fa fa-step-forward"></i></button>
                  														<div class="select-wrapper 1u 12u$(xsmall)" style="float: right;">
                  														<select class="pagesize demo-category">
                  														<option value="10">10</option>
                  															<option value="20" selected="selected">20</option>
                  															<option value="50">50</option>
                  														</select>
                  											</div>
                  											<label>N&uacute;mero de registros:&emsp;</label> 
                  											
                  													</td>
                  												</tr>
                  											</tfoot>
                  										</table>

								
								
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