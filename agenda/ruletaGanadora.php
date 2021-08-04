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
		
		<?php require_once 'importar_scripts2.php'; ?>
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
									<h3 id="content">Ruleta ganadora</h3>
								</section>
								<div class="12u 12u$(xsmall)" >
<section>           							
            							<div class="row">
            							<div class="6u 12u$(xsmall) table-wrapper" >
            							<div id="tsparticles"></div>

            								<table>
            									<thead>
            										<tr> 
            										<td> Opción </td>
            										<td> Promoción </td>
            										</tr>
            									</thead>
            									
            									<tbody>
            										<tr>
            											<td>1 </td>
            											<td>50% OFF DEPILACION  </td>
            										</tr>
            										<tr>
            											<td>2 </td>
            											<td>30% OFF REFUCTIVOS Y MOLDEADORES </td>
            										</tr>
            										<tr>
            											<td>3</td>
            											<td>15% EN FACIALES  </td>
            										</tr>
            										<tr>
            											<td>4</td>
            											<td>1 consulta de nutrición con balinés  gratis  </td>
            										</tr>
            										<tr>
            											<td>5</td>
            											<td>DETOX Gratis </td>
            										</tr>
            										<tr>
            											<td>6</td>
            											<td>50% OFF DEPILACION  </td>
            										</tr>
            										<tr>
            											<td>7</td>
            											<td>30% OFF REFUCTIVOS Y MOLDEADORES </td>
            										</tr>
            										<tr>
            											<td>8</td>
            											<td>15% EN FACIALES  </td>
            										</tr>
            										<tr>
            											<td>9</td>
            											<td>una consulta de nutrición con balinés  gratis  </td>
            										</tr>
            										<tr>
            											<td>10</td>
            											<td>DETOX Gratis </td>
            										</tr>
            									</tbody>
            								</table>
            							</div>
            							<div class="6u 12u$(xsmall)" >
            								<a  id="btnGirar" class="button special">Girar</a>
            								<canvas id="canvas" width="500" height="500"></canvas>
            							</div>
            							
            						</div>
            					<canvas id="confeti"></canvas>
         </section>   							
</div>            					</div>

						</div>
					</div>


		<!-- Scripts -->
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
<script type="text/javascript" src="tsparticles.min.js"></script>
   
	</body>
</html>