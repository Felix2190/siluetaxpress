<?php
define("DEVELOPER", false);
if (! DEVELOPER) {
    /**
     * constantes de producción
     */
    define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "/siluetaexpress/include/");
    
} else {
    /**
     * constantes de desarrollo
     */
    define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "siluetaxpress/html/include/");
}

define("CLASS_CONEXION", FOLDER_INCLUDE.'Conexion/Conexion.php');

define("FOLDER_MODEL", FOLDER_INCLUDE . "model/");
define("FOLDER_MODEL_BASE", FOLDER_MODEL . "base/");
define("FOLDER_MODEL_EXTEND", FOLDER_MODEL . "extend/");

define("FOLDER_MODEL_DATA", FOLDER_INCLUDE . "model/data/");

define("CLASS_COMUN", FOLDER_MODEL_DATA . "clsBasicCommon.inc.php");

require_once(CLASS_COMUN);

require_once FOLDER_MODEL_EXTEND . "model.inegidomgeo_cat_estado.inc.php";

$slcMunicipios=$slcEstados = '<option value="">Seleccione una opci&oacute;n</option>';
$etados = new ModeloInegidomgeo_cat_estado();
$arrEst = $etados->getAll();
if (! $etados->getError())
    foreach ($arrEst as $cvEst => $nombre)
        $slcEstados .= '<option value="' . $cvEst . '"  >' . $nombre . '</option>';
        
?>
<!DOCTYPE HTML>
<!--
	Minimaxing by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	<!-- End WOWSlider.com HEAD section -->
			<script src="assets/js/jquery.min.js"></script>
			<script type="text/javascript" src="js/system/headerLogo.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/skel-viewport.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
	
	 <link rel="stylesheet" href="assets/css/alertify.min.css" />
        <script src="js/lib/jquery-1.11.0.min.js"></script>
	 <script type="text/javascript" src="js/lib/common.js"></script>
        <script src="js/lib/alertifyjs/alertify.min.js"></script>
        
	<script type="text/javascript">
	$(document).ready(function(){
		iniciar();
	});
		 
	function iniciar(){
		$("#btnEnviar").click(creaPDF);
		$("#slcEstado").change(function(){
			$.ajax({
				method : "post",
				url : "funciones.php",
				data : {
					estado: $("#slcEstado").val().trim()
				},
				success : function(data) {
					$( "#hdnEstado" ).val(data);
				}
			});
		});
	}

	function creaPDF(){
		var existeError = false;
		var datos={};
		datos['Nombre']= $("#txtNombre").val().trim();
		if (datos['Nombre'] == "") {
			existeError = true;
			console.log("Error: txtNombre");
		}
		
		datos['Estado']= $("#hdnEstado").val().trim();
		if (datos['Estado'] == "") {
			existeError = true;
			console.log("Error: txtEstado");
		}
		
		datos['Ciudad']= $("#txtCiudad").val().trim();
		if (datos['Ciudad'] == "") {
			existeError = true;
			console.log("Error: txtCiudad");
		}
		
		datos['Direccion']= $("#txtDireccion").val().trim();
		if (datos['Direccion'] == "") {
			existeError = true;
			console.log("Error: txtDireccion");
		}
		datos['Tel']= $("#txtTel").val().trim();
		if (datos['Tel'] == "") {
			existeError = true;
			console.log("Error: txTelt");
		}
		datos['Email']= $("#txtEmail").val().trim();
		if (datos['Email'] == "") {
			existeError = true;
			console.log("Error: txtEmail");
		}
	
		if(existeError){
			mostrarMsjError('Datos incompletos!! <br />Por favor, llene la informaaci&oacute;n que se solicita',5);
			return false;
		}else{
			$.ajax({
				method : "post",
				url : "funciones.php",
				data : {
					info: JSON.stringify(datos) 
				},
				success : function(data) {
					//respuesta=JSON.parse(data);
					//$( "#slcSucursal2" ).html(respuesta);
					window.location="getPDF.php";
				}
			});
		}
		
	}

	function mostrarMsjError(texto, tiempo){
        alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right
        alertify.notify(texto,'error', tiempo, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click
  }
     function mostrarMsjExito(texto, tiempo){
        alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right
        alertify.notify(texto,'success', tiempo, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click
  }
     function mostrarMsjEspera(texto, tiempo){
        alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right
        alertify.notify(texto,'warning', tiempo, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click
  }
     function mostrarMensaje(texto, tiempo){
        alertify.set('notifier','position', 'top-right'); //top-left, top-right, bootom-left, bottom-right
        alertify.notify(texto, tiempo, null); //mensaje, tipo, tiempo en segundo (0 siempre visible, quitar al hacer click
  }
	
	</script>
	</head>
	<body>
		<div id="page-wrapper">
		<?php 
		include_once 'navhome.php';
		?>

		<div id="main">
			<div class="container">
				<div class="row main-row">
					<div class="12u">

						<section>
							<h2>Ejemplo de formulario</h2>
							<p></p>
							 							
						</section>

					</div>
					
					<div class="12u">
					<div class="row"  id="formulario">
								
						<div class="1u 12u(mobile)">
						<section></section>
						</div>
						
						<div class="6u 12u(mobile)">
						<div class="row" id="divFormulario">

							<div class="3u 12u$(xsmall)">
								<label>Nombre completo:</label>
							</div> 
							<div class="9u 12u$(xsmall)">
								<input type="text" id="txtNombre"/>
							</div>
						</div>
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Estado:</label>
							</div> 
						<div class="5u 12u$(xsmall)">
							<div class="select-wrapper">
								<select id="slcEstado">
									<?php echo $slcEstados;?>
								</select>
							</div>
						</div>
						</div>
						<input type="hidden" id="hdnEstado" value=""/>
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Ciudad:</label>
							</div> 
							<div class="9u 12u$(xsmall)">
								<input type="text" id="txtCiudad"/>
							</div>
						</div>
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Direcci&oacute;n:</label>
							</div> 
							<div class="9u 12u$(xsmall)">
								<input type="text" id="txtDireccion"/>
							</div>
						</div>
						<div class="row">
							<div class="3u 12u$(xsmall)">
								<label>Tel&eacute;fono:</label>
							</div> 
							<div class="3u 12u$(xsmall)">
								<input type="text" id="txtTel"/>
							</div>
							<div class="2u 12u$(xsmall)">
								<label>Correo electr&oacute;nico:</label>
							</div> 
							<div class="4u 12u$(xsmall)">
								<input type="text" id="txtEmail"/>
							</div>
						</div>
						
						
						<div class="row">
						<div class="12u"></div>
						<a id="btnEnviar" class="button">Enviar</a>
						</div>
						
						
						</div>
					</div>
					<

				</div>

			</div>

		</div>

		</div>
		<?php include_once 'footer.php';?>

		<!-- Scripts -->

	</body>
</html>