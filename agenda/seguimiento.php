<?php 
require_once 'masterInclude.inc.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Notas de seguimiento</title>
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
									<h3 id="content"><img src="images/seg.png" style="width: 95px;" />&ensp;Seguimiento</h3>
									&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<strong><?php echo $paciente->getNombre().' '.$paciente->getApellidos();?></strong>
								</section>
								
				<div class="row">
					<input type="hidden" id="idPaciente" value="<?php echo $idPaciente;?>"/>
				
					<div class="12u 12u$(xsmall)">
						<h4> <a onclick="visualizacion();"> Registrar avance </a></h4>
					</div>
					<div class="12u 12u$(small)" style="display: none;" id="divReg">
    					<div class="box">
    						<div class="row">
    							<div class="8u 12u$(xsmall)" style="text-align: right;">
    							 <strong> Fecha: </strong>
    							</div>
    							<div class="3u 12u$(small)" style="text-align: right;">
        								<input type="text" id="txtFecha" placeholder="AAAA-MM-DD" readonly="readonly"
    																class="datepicker" value="<?php echo date("Y-m-d");?>"/>
                				</div>
            				</div>
            					<br />
    						<div class="12u 12u$(xsmall)">
							 <strong> Medidas </strong>
							</div>
							
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Peso (Kg):</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtPeso" class="numeric imc" maxlength="5" />
								</div>
								<div class="2u 12u$(xsmall)">
									<label>Estatura:</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtEstatura" class="numeric imc" maxlength="5" />
								</div>
								<div class="2u 12u$(xsmall)">
									<label>IMC:</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtIMC" class="numeric" disabled="disabled" maxlength="5"/>
								</div>
								
							</div>
							<br />
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Talle:</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtTalle" class="numeric" maxlength="5" />
								</div>
								<div class="2u 12u$(xsmall)">
									<label>Pecho:</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtPecho" class="numeric" maxlength="5" />
								</div>
								<div class="2u 12u$(xsmall)">
									<label>Cintura:</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtCintura" class="numeric" maxlength="5" />
								</div>
								
							</div>
							
							<br />
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Abdomen:</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtAbdomen" class="numeric" maxlength="5" />
								</div>
								<div class="2u 12u$(xsmall)">
									<label>Cadera:</label>
								</div>
								<div class="2u 12u$(xsmall)">
									<input type="text" id="txtCadera" class="numeric" maxlength="5" />
								</div>
								
							</div>
						
							<br />
						
						<div class="12u 12u$(xsmall)">
							 <strong> Notas </strong>
							</div>
							
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>S&iacute;ntomas</label>
								</div>
								<div class="8u 12u$(xsmall)">
								<textarea rows="1" cols="" id="txtSintomas"></textarea>
								</div>
							</div>
							
							
								<br />
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Dieta</label>
								</div>
								<br />
								<div class="8u 12u$(xsmall)">
								<textarea rows="3" cols="" id="txtDieta"></textarea>
								</div>
							</div>
							
							
								<br />
							<div class="row">
								<div class="2u 12u$(xsmall)">
									<label>Tratamiento</label>
								</div>
								<br />
								<div class="8u 12u$(xsmall)">
								<textarea rows="3" cols="" id="txtTratamiento"></textarea>
								</div>
							</div>
						 
						</div>
					
    				<br />
    				
    				<div class="row">
								<div class="12u"></div>
								<a id="btnGuardar" class="button special">Guardar</a>
						</div>
				</div>							
    				
				</div>
				<hr />					
				<div class="row">
					<div class="12u 12u$(xsmall)">
									<h4>Historial</h4>
					</div>
					
					<br />
					<div class="table-wrapper" id="divTabla">
					</div>
						
						
    					<div id="divInfoSeg" class="12u 12u$(small)" style="display: none;">
    						<div class="box">
								<div class="row">
    								<div class="5u 12u$(small)" style="text-align: right;">Captur&oacute;: <i id="dtNombre"></i>
            						</div>
            						<div class="4u 12u$(small)" style="text-align: right;">en <i  id="dtSucursal"></i>
            						</div>
            						<div class="3u 12u$(small)" style="text-align: right;">Fecha: <strong id="dtFecha"></strong>
            						</div>
            						
            						<br />
            						<div class="12u 12u$(small)">
            						<p>
            						
            						</p >
            						</div>
            						<br />
            						
            						<div class="2u 12u$(small)">
            							<div class="12u$(small)">
        									Peso:&ensp;<strong style="border-bottom: 2px solid;"  id="dtPeso"></strong>
        								</div>
        								<br />
        								<div class="12u$(small)">
        									Estatura:&ensp;<strong style="border-bottom: 2px solid;"  id="dtEstatura"></strong>
        								</div>
        								<br />
        								<div class="12u$(small)">
        									IMC:&ensp;<strong style="border-bottom: 2px solid;"  id="dtIMC"></strong>
        								</div>
        								<br />
        								
        							</div>
        							
            						<div class="3u 12u$(small)">
            							<div class="12u$(small)">
        									Pecho:&ensp;<strong style="border-bottom: 2px solid;" id="dtPecho"></strong>
        								</div>
        								<br />
        								<div class="12u$(small)">
        									Talle:&ensp;<strong style="border-bottom: 2px solid;" id="dtTalle"></strong>
        								</div>
        								<br />
        								<div class="12u$(small)">
        									Cintura:&ensp;<strong style="border-bottom: 2px solid;" id="dtCintura"></strong>
        								</div>
        								<br />
        								<div class="12u$(small)">
        									Abdomen:&ensp;<strong style="border-bottom: 2px solid;" id="dtAbdomen"></strong>
        								</div>
        								<br />
        								<div class="12u$(small)">
        									Cadera:&ensp;<strong style="border-bottom: 2px solid;" id="dtCadera"></strong>
        								</div>
        								<br />
        								
        							</div>
        							<div class="7u 12u$(small)">
        								<div class="12u$(small)">S&iacute;ntomas
        									<p id="dtSintomas"> </p>
        								</div>
        								<br />
        								<div class="12u$(small)">Dieta
        									<p id="dtDieta"> </p>
        								</div>
        								<br />
        								<div class="12u$(small)">Tratamiento
        									<p id="dtTratamiento"> </p>
        								</div>
        								<br />
        								
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