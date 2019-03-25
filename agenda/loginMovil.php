<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo $sesion==true?'Bienvenido '.$objSession->getUserName():'Iniciar sesi&oacute;n'; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets2/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets2/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	<!-- End WOWSlider.com HEAD section -->

		<?php require_once 'importar_scripts2.php'; ?>
	</head>
	<body>
		<div id="page-wrapper">
			
			<div id="banner-wrapper">
				<div class="container">
				
					<div id="banner_Movillogin">
					<?php if (!$sesion){?>
					
						
						<div class="row" >
							<div class="4u " style="padding: 30px 50px 0 0;">
								<h2>Ingresar al sistema</h2>
								</div>
						</div>
						<div class="row" >
							<div class="4u " style="padding: 70px 10px 0 0;">
								<label>Usuario:</label>
							</div> 
							<div class="8u" style="padding: 70px 10px 0 0;">
								<input type="text" id="txtUserName"/>
							</div>
						</div>
						<div class="row" >
							<div class="4u " style="padding: 40px 10px 0 0;">
								<label>Contrase&ntilde;a:</label>
							</div> 
							<div class="8u" style="padding: 40px 10px 0 0;">
								<input type="password" id="txtPassword"/>
							</div>
						</div>
						<div class="row" >
							<div class="4u " style="padding: 40px 10px 0 0;">
								<label>Sucursal:</label>
							</div> 
							<div class="8u" style="padding: 40px 10px 0 0;">
								<div class="select-wrapper">
									<select name="demo-category" id="slcSucursal">
									<?php echo $txtSucursal;?>
									</select>
								</div>
							</div>
						</div>
						
						<div class="row" >
							<div class="12u " style="padding: 30px 0 0 0;">
								<a class="button2" id="btnEntrar" >Entrar</a>
								<input type="hidden" id="sesion" value=""/>
							</div>
						</div>
						
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
						<input type="hidden" id="hdnURL" value="<?php echo $URL;?>"/>
						</section>
					
					<?php }?>	
					</div>
				</div>
			</div>
			

		</div>

		<!-- Scripts -->
			<script src="assets2/js/skel.min.js"></script>
			<script src="assets2/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->

	</body>
</html>