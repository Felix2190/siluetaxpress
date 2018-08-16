<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo $sesion==true?'Bienvenido '.$objSession->getUserName():'Iniciar sesi&oacute;n'; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	<!-- End WOWSlider.com HEAD section -->

		<?php require_once 'importar_scripts.php'; ?>
	</head>
	<body>
		<div id="page-wrapper">
			<div id="header-wrapper">
				<div class="container">
					<div class="row">
					
					<div class="12u">
					<header id="header">
					<img src="images/logo_siluetaExpress.png" alt=""  style="width: 16%; margin-top: -10px"/>
					<nav id="nav">
					<?php if (!$sesion){?>
					<a>Iniciar sesi&oacute;n </a>
						<?php }else{
						    echo '<a>'.$objSession->getNombre().' '.$objSession->getApellidos().'</a>';
						}
						    ?>
					</nav>
				</header></div>
					</div>
				</div>
			</div>
			
			<div id="banner-wrapper">
				<div class="container">
				
					<div id="banner_login">
					<?php if (!$sesion){?>
					
						<section>
						<h2>Ingresar al sistema</h2>
						<div class="row" ><section></section></div>
						<div class="row" >
							<div class="4u ">
								<label>Usuario:</label>
							</div> 
							<div class="8u">
								<input type="text" id="txtUserName"/>
							</div>
						</div>
						<div class="row" >
							<div class="4u )">
								<label>Contrase&ntilde;a:</label>
							</div> 
							<div class="8u">
								<input type="password" id="txtPassword"/>
							</div>
						</div>
						</section>
						<section>
						<a class="button2" id="btnEntrar" >Entrar</a>
						<input type="hidden" id="sesion" value=""/>
						</section>
						
					<?php }else{?>
						<section>
						<h2>Redireccionando a Agenda...</h2>
						<br />
						</section>
						<section>
						<div class="row" >
						<p><label class="gris">Usuario: </label> <label> <?php echo $objSession->getUserName();?></label></p>
						</div>
						<div class="row" >
						<p><label class="gris">Sucursal: </label><label> <?php echo $objSession->getSucursal().' ['.$objSession->getLugar().']';?></label></p>
						</div>
						<input type="hidden" id="sesion" value="1"/>
						</section>
					
					<?php }?>	
					</div>
				</div>
			</div>
			
			
		<div id="main">
			<div class="container">
				<div class="row main-row">
				</div>

			</div>

		</div>

		</div>
		<?php include_once 'footer.php';?>

		<!-- Scripts -->
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/skel-viewport.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>