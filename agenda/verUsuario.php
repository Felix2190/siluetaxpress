<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Editar usuario</title>
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
						<div class="inner" id="divArriba">

							<!-- Header -->
								<?php include_once 'header.php';?>

							<!-- Section -->
								<section >
									<h3 id="content"><img src="images/editar.png" style="width: 60px;" />&ensp;Usuario: <i><?php echo $Usuario->getNombre().' '.$Usuario->getApellidos();?></i></h3>
									
								
								</section>

								<div class="12u 12u$(xsmall)" id="divArriba">
						
						
						<div class="row">
						<input type="hidden" value="<?php echo $Usuario->getIdUsuario();?>" id="idUsuario"/>
						<input type="hidden" value="<?php echo $idL;?>" id="idLogin"/>
						<input type="hidden" value="<?php echo $Usuario->getIdSucursal();?>" id="idSucursal"/>
						<input type="hidden" value="<?php echo $Usuario->getIdTipoUsuario();?>" id="idTipoUsuario"/>
							<div class="3u 12u$(xsmall)">
								<label>Nombre:</label>
							</div>
							<div class="5u 12u$(xsmall)">
								<input type="text" id="txtNombre" value="<?php echo $Usuario->getNombre();?>"   readonly="readonly"/>
							</div>
						</div>
						
						<br />
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Apellidos:</label>
							</div>
							<div class="5u 12u$(xsmall)">
								<input type="text" id="txtApellidos" value="<?php echo $Usuario->getApellidos();?>"  readonly="readonly"/>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Sucursal:</label>
							</div>
							<div class="5u 12u$(xsmall)">
								<div class="row" >
								<?php 
								$text='';
								foreach ($arrSucursal as $id=>$valor)
								$text.='<div class="6u 12u$(xsmall)"><input class="checkSucursal" value="'.$id.'" id="chk'.$id.'" name="chk'.$id.'"  type="checkbox"> <label for="chk'.$id.'">'.$valor.'</label></div>';
								echo $text;
								?>
								</div>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Cargo:</label>
							</div>
							<div class="4u 12u$(xsmall)">
								<div class="select-wrapper">
									<select name="demo-category" id="slcCargo"  disabled="disabled">
									<option value="">Seleccione una opci&oacute;n</option>
									</select>
								</div>
							</div>
						</div>
						
						<br />
						
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Correo:</label>
							</div>
							<div class="4u 12u$(xsmall)">
								<input type="text" id="txtCorreo"  readonly="readonly" value="<?php echo $Usuario->getCorreo();?>"/>
							</div>
						</div>
						<br />
						
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Tel&eacute;fono:</label>
							</div>
							<div class="3u 12u$(xsmall)">
								<input type="text" id="txtTelefono" readonly="readonly" class="numeric" maxlength="10" value="<?php echo $Usuario->getTelefonoCel();?>"/>
							</div>
						</div>
						
						<br />
						
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>UserName:</label>
							</div>
							<div class="4u 12u$(xsmall)">
								<input type="text" id="txtUserName" value="<?php echo $userName;?>" readonly="readonly"/>
							</div>
						</div>
						
						<br />
						</div>
						
						<div class="row" >
						<div class="3u 12u$(xsmall)" >
								<a href="listadoUsuarios.php" class="button">Volver al listado</a>
						</div>
						
						
						<div class="4u 12u$(xsmall)" >
							<?php if ($Usuario->getEnvioPassword()==0){?> 
								<a style="float: right;" id="btnPass" class="button" >Crear nueva contrase&ntilde;a</a>&ensp;
								<?php }else{?>
								<div class="row">
									
									<div class="box2">
										<div class="12u$(xsmall)" >
											Se ha enviado la contrase&ntilde;a al correo.
										</div>
									</div>
								</div>
								<?php }?>
						</div>
						
						
						<div class="2u 12u$(xsmall)" >
								<?php if ($estatus=='activo'){?>
								<a style="float: right;" id="btnBloquear" class="button">Bloquear</a>&ensp;
								<?php } else{?>
								<a style="float: right;" id="btnActivar" class="button">Activar</a>&ensp;
								<?php }?>
						</div>
						
						
						<div class="2u 12u$(xsmall)" >
								<a  id="btnGuardar" class="button special">Guardar</a>
								
						</div>
						</div>
						<br /><br />
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