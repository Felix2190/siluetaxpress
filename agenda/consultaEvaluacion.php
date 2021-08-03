<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title> </title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		
		<?php require_once 'importar_scripts.php'; ?>
	<script type="text/css">
    </script>
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
									<h2 id="content"></h2>
								</section>
								<input type="hidden" id="hdnRol" value="<?php echo $objSession->getidRol();?>">
				<?php if ($objSession->getidRol()==1) { ?>
			<div class="12u 12u$(small)">
				<div class="row">
					<div class="2u 12u$(small)">
						<label>Mes</label>
					</div>
					<div class="3u 12u$(small)">
    					<div class="select-wrapper">
    						<select name="demo-category" id="slcMes">
    							<?php echo $comboMeses;?>
	    					</select>
    					</div>
					</div>
					<div class="2u 12u$(small)">
						<label>A&ntilde;o</label>
					</div>
					<div class="2u 12u$(small)">
    					<div class="select-wrapper">
    						<select name="demo-category" id="slcAnio">
    							<?php echo $comboAnio;?>
	    					</select>
    					</div>
					</div>
				</div>
			</div>
			<?php  } ?>
			<br>
			
			<div id="divEvalua">

			</div>
			<br>
			<div class="12u 12u$(small)" id="divComentarios">
				<div class="row">
					<div class="12u 12u$(small)">
						<h5>Comentarios</h5>
					</div>
				</div>
				<div class="row">
					<div class="8u 12u$(small)" id="comen">
						<ul>
							<li>uj</li>
						</ul>
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