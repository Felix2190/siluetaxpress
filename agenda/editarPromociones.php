<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Promociones </title>
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
									<h2 id="content">Actualizar promociones</h2>
								</section>
								
								
								<div class="12u 12u$(xsmall)" >
								<?php $num=1;
								    foreach ($arrPromociones as $id=>$promo):
								?>
            						<div class="row">
            							<div class="1u 12u$(xsmall)" >
            								<label><?php echo $num;?></label>
            							</div>
            							<div class="10u 12u$(xsmall)" >
            								<input type="hidden" id="hd<?php echo $num;?>" value="<?php echo $id;?>">
            								<input type="text" value="<?php echo $promo;?>" id="txtPromocion<?php echo $num;?>" maxlength="50">
            							</div>
            						</div>
            						<br>
            					<?php $num++; endforeach;?>
            					
						<div class="9u 12u$(xsmall)" >
								<a  id="btnGuardar" class="button special">Guardar cambios</a>
								<br />
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