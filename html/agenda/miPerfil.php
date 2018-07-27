<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Agenda virtual &curren;<?php echo ' '.$objSession->getUserName();?></title>
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
									<h2 id="content">Mi perfil</h2>
								</section>

            				<div class="row">
            					<div class="11u">
            						<div class="box" style="height: 350px;">
            						<div class="row">
            							<div class="5u 12u$(xsmall)">
            								<div class="row" style="height: 280px;" id="divFoto">
            									<img id="imgFoto" src="<?php echo $usuario->getFoto();?>" style="height:100%; " />
            									<input type="hidden" value="<?php echo $usuario->getFoto();?>" id="hdnFoto"/>
            								</div>
            								<div class="row editar" style="display: none;">
            									<div class="11u 12u$(xsmall)" style="justify-content: center;">
            									    <input type="file" name="fileToUpload" id="fileToUpload" />              
            									</div>
            								</div>
            							</div>
            							<div class="7u 12u$(xsmall)"> 
            								<div class="row">
                								<div class="4u 12u$(small)">
                									Nombre:
                								</div>
                								<div class="8u 12u$(xsmall)">
                									<p><strong><?php echo $usuario->getNombre()    .' '. $usuario->getApellidos();?></strong></p>
                								</div>
                								<div class="4u 12u$(small)">
                									Cargo:
                								</div>
                								<div class="8u 12u$(xsmall)">
                									<p><strong><?php echo $tipousuario->getNombre().' ';?></strong></p>
                								</div>
                								<div class="4u 12u$(small)">
                									Sucursal:
                								</div>
                								<div class="8u 12u$(xsmall)">
                									<p><strong><?php echo $sucursal->getSucursal().' ';?></strong></p>
                								</div>
                								<div class="4u 12u$(small)">
                									Tel&eacute;fono:
                								</div>
                								<div class="8u 12u$(xsmall)">
                								<div class="11u 12u$(xsmall definido" >
                									<p><strong><?php echo $usuario->getTelefonoCel().' ';?></strong></p>
                								</div>
                								<div class="11u 12u$(xsmall editar"  style="display: none;">
                									<input type="text" id="txtTelefono" maxlength="10" class="numeric" style="height: 32px;" value="<?php echo $usuario->getTelefonoCel();?>"/> <br />
                								</div>
                								
                								</div>
                								<div class="4u 12u$(small)">
                									Correo electr&oacute;nico:
                								</div>
                								<div class="8u 12u$(xsmall)">
                								<div class="11u 12u$(xsmall definido" >
                									<p><strong><?php echo $usuario->getCorreo().' ';?></strong></p>
                								</div>
                								<div class="11u 12u$(xsmall editar"  style="display: none;">
                									<input type="text" id="txtCorreo" style="height: 32px;" value="<?php echo $usuario->getCorreo();?>"/> <br />
                								</div>
                								
                								</div>
                								
                								<div class="row definido" style="float: right;">
                    								<div class="12u"></div>
                    								<a id="btnEditar" class="button">Editar</a>
                    							</div>
                    							
                    							<div class="row editar"  style="display: none; float: right;">
                    								<div class="12u"></div>
                    								<a id="btnGuardar" class="button special">Guardar</a>
                    							</div>
                    							
											</div>
            							</div>
            						</div>
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