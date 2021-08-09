<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title> Personal </title>
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
									<h2 id="content">Editar personal</h2>
								</section>
								
								<div class="row">
					<div class="12u 12u$(small)">
						<div class="box">
							<div class="row uniform" id="divInicio">
								<input type="hidden" id="hdIdPersonal" value="0">
								<div class="2u 12u$(xsmall)">
									<label>Nombre:</label>
								</div>
								<div class="4u 12u$(xsmall)">
									  <input id="txtNombre" type="text">
								</div>
								<div class="2u 12u$(xsmall)">
									<label>&Aacute;rea:</label>
								</div>
								<div class="3u 12u$(xsmall)">
									  <select id="slcConsulta" >
									 	</select>
								</div>
							</div>
							<br>
							<div class="row ">
								<div class="2u 12u$(xsmall)">
									<label>Sucursal:</label>
								</div>
								<div class="4u 12u$(xsmall)">
									  <select id="slcSucursal">
									 	</select>
								</div>
								<div class="3u 12u$(xsmall)" >
									<a id="btnGuardar" class="button special">Guardar</a>
								</div>
								
							</div>
						</div>
					</div>
					</div>
				
				<div class="row">
					<div class="12u 12u$(small)">
													<table class="table" id="tablesorting-1">
                  											<thead>
                  												<tr>
                  													<th>Nombre</th>
                  													<th>&Aacute;rea</th>
                  													<th>Sucursal</th>
                  													<th>Acciones</th>
                  												</tr>
                  											</thead>
                  											<tbody>
                  									
                  											</tbody>
                  											<tfoot>
                  												<tr>
                  													<td colspan="4" class="pager form-horizontal">
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
                  											
                  													</td>
                  												</tr>
                  											</tfoot>
                  										</table>
						
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