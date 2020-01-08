<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Mis notificaciones</title>
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
									<h3 id="content"><img src="images/seg.png" style="width: 95px;" />&ensp;Nueva notificaci&oacute;n</h3>
									
								</section>

				<div class="row">
					<div class="3u 12u$(xsmall)">
						<form>
							<input id="demo-priority-Correo" name="datos" value="Correo"
								type="radio"> <label
								for="demo-priority-Correo">Correo</label>
							<input id="demo-priority-SMS" name="datos" value="SMS"
								type="radio"> <label for="demo-priority-SMS">SMS</label>
						</form>
					</div>

				</div>
				<hr />
				
				<div class="row" style="display: none;" id="divSMS">
					<div class="12u 12u$(xsmall)" >
						<h4>Enviar SMS</h4>
					</div>
					<div class="12u 12u$(small)" >
    					<div class="box">
    						<div class="row">
								<div class="5u 12u$(xsmall)">
									<div class="2u 12u$(xsmall)">
										<label>Nombre:</label>
									</div>
									<div class="12u 12u$(xsmall)">
										<input type="text" id="txtNombreSMS"  maxlength="50" />
									</div>
									<div class="2u 12u$(xsmall)">
										<label>Texto:</label>
									</div>
									<div class="12u 12u$(xsmall)">
										<textarea rows="1" cols="" id="txtTextoSMS" onkeydown="return limitar(event,this.value,155)" onkeyup="return limitar(event,this.value,155)"></textarea>
									</div>
								</div>
								
								<div class="7u 12u$(xsmall)">
									<div class="12u 12u$(xsmall)">
									A:
									</div>
									<br />
									<div class="row">
									<div class="8u 12u$(xsmall)">
										<div class="2u 12u$(xsmall)">
											<label>Paciente</label>
										</div>
										<div class="row">
										
            								<div class="8u 12u$(xsmall)">
    											<select id="txtPacienteSMS" style="width: 150px;">
    											</select>
    										</div>
            								<div class="4u 12u$(xsmall)">
            									<a style="float: right;" id="btnAgregarSMS" class="button" >A&ntilde;adir</a>&ensp;
    										</div>
    										
										</div>
										<br />
										<br />
										<div class="row">
										<textarea rows="5" cols="" id="txtSMS" ></textarea>
										</div>
										<div class="row">
										<div class="6u 12u$(xsmall)">
											Total: <span id="spnTotalSMS"></span>
											</div>
											
											<div class="12u 12u$(xsmall)">
            									<a style="float: right;" id="btnEliminarSMS" class="button" >Quitar &uacute;ltimo	</a>&ensp;
    										</div>
										</div>
									</div>
									<div class="4u 12u$(xsmall)">
										<div class="2u 12u$(xsmall)">
											<label>Sucursal</label>
										</div>
											<div class="row" >
                								<?php 
                								$text='';
                								foreach ($arrSucursal as $id=>$valor)
                								$text.='<div class="12u 12u$(xsmall)"><input class="checkSucursal" value="'.$id.'" id="SMSchk'.$id.'" name="SMSchk'.$id.'"  type="checkbox"> <label for="SMSchk'.$id.'">'.$valor.'</label></div>';
                								echo $text;
                								?>
											</div>
							
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				
				
				<div class="row" style="display: none;" id="divCorreo">
					<div class="12u 12u$(xsmall)" >
						<h4>Enviar correo electr&oacute;nico</h4>
					</div>
					<div class="12u 12u$(small)" >
    					<div class="box">
    						<div class="row">
								<div class="5u 12u$(xsmall)">
									<div class="3u 12u$(xsmall)">
										<label>Asunto:</label>
									</div>
									<div class="12u 12u$(xsmall)">
										<input type="text" id="txtNombreCorreo"  maxlength="50" />
									</div>
									<br />
									<div class="2u 12u$(xsmall)">
										<label>Texto:</label>
									</div>
									<div class="12u 12u$(xsmall)">
										<textarea rows="1" cols="" id="txtTextoCorreo"></textarea>
									</div>
									<br />
									<div class="6u 12u$(xsmall)">
										<label>Adjuntar imagenes</label>
									</div>
    								<div class="row">
										<div class="12u 12u$(xsmall)">
												<div class="11u 12u$(xsmall)" style="justify-content: center;">
            									    <input type="file" name="fileToUpload" id="fileToUpload" />              
            									</div>
										</div>
									<br />
										<div class="8u 12u$(xsmall)">
											<a style="float: right;" id="btnAgregarIma" class="button" >A&ntilde;adir</a>&ensp;
										</div>
        						<div class="12u 12u$(xsmall)" id="divTablaI" style="display: ;">
        								<table id="tblImagen">
        									<thead>
        										<tr><th colspan="4">Imagen</th><th></th></tr>
        									</thead>
        									<tbody id="tbodyProducto">
        									</tbody>
        								 </table>
        						</div>
										
									</div>
								</div>
								
								<div class="7u 12u$(xsmall)">
									<div class="12u 12u$(xsmall)">
									A:
									</div>
									<br />
									<div class="row">
									<div class="8u 12u$(xsmall)">
										<div class="2u 12u$(xsmall)">
											<label>Paciente</label>
										</div>
										<div class="row">
										
            								<div class="8u 12u$(xsmall)">
    											<input id="txtPacienteCorreo" style="width: 100%;"/>
    										</div>
            								<div class="4u 12u$(xsmall)">
            									<a style="float: right;" id="btnAgregarCorreo" class="button" >A&ntilde;adir</a>&ensp;
    										</div>
    										
										</div>
										<br />
										<br />
										<div class="row">
										<textarea rows="5" cols="" id="	txtCorreo"></textarea>
										</div>
										<div class="row">
											<div class="6u 12u$(xsmall)">
											Total: <span id="spnTotalCorreo"></span>
											</div>
											<div class="6u 12u$(xsmall)">
            									<a style="float: right;" id="btnEliminarCorreo" class="button" >Quitar &uacute;ltimo	</a>&ensp;
    										</div>
										</div>
									</div>
									<div class="4u 12u$(xsmall)">
										<div class="2u 12u$(xsmall)">
											<label>Sucursal</label>
										</div>
											<div class="row" >
                								<?php 
                								$text='';
                								foreach ($arrSucursal as $id=>$valor)
                								$text.='<div class="12u 12u$(xsmall)"><input class="checkSucursal" value="'.$id.'" id="Correochk'.$id.'" name="Correochk'.$id.'"  type="checkbox"> <label for="Correochk'.$id.'">'.$valor.'</label></div>';
                								echo $text;
                								?>
											</div>
							
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				
										<div class="row">
											<div class="12u 12u$(xsmall)">
            									<a style="float: right; display: none" id="btnGuardar" class="button" >Enviar</a>&ensp;
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