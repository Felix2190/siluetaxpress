<?php
?>
<div id="sidebar">
	<div class="inner">

		<!-- Search -->
		<section id="search" class="alt">
			<header class="major">
				<h4>Hola</h4>
				<h2><?php echo ' '.$objSession->getNombre();?></h2>
			</header>
			<ul class="contact">
				<li class="fa-home">
					<div class="select-wrapper">
							<select name="demo-category" id="slcSucursalBar">
								</select>
					</div>
				</li>
			</ul>
			
		</section>
		
		<!-- Menu -->
		<nav id="menu">
			<ul>
			<li><a class="<?php if($subseccion=="index") echo "active";?>" href="index.php">Inicio</a></li>
				<li><span class="opener <?php if($seccion=="cuenta") echo "active";?>" class="opener">Mi cuenta</span>
					<ul>
						<li><a class="<?php if($subseccion=="miPerfil") echo "active";?>" href="miPerfil.php">Perfil</a></li>
						<li><a class="<?php if($subseccion=="cambioContrasena") echo "active";?>" href="cambioContrasena.php">Cambiar contrase&ntilde;a</a></li>
						<li><a href="logout.php">Cerrar sessi&oacute;n</a></li>
					</ul></li>
					
					<?php if ($objSession->getidRol()==1||$objSession->getEnvioNotificaciones()==1){?>

				<li><span class="opener <?php if($seccion=="administrar") echo "active";?>" class="opener">Administrar</span>
					<ul>
					<?php if ($objSession->getidRol()==1):?>
						<li><a class="<?php if($subseccion=="listadoSucursal"||$subseccion=="verSucursal"||$subseccion=="altaSucursal") echo "active";?>" href="listadoSucursal.php">Consultorios</a></li>
						<li><a class="<?php if($subseccion=="listadoUsuarios"||$subseccion=="verUsuario"||$subseccion=="nuevoUsuario") echo "active";?>" href="listadoUsuarios.php">Usuarios</a></li>
						<li><a class="<?php if($subseccion=="listadoTipoUsuarios"||$subseccion=="verTipoUsuario"||$subseccion=="nuevoTipo") echo "active";?>" href="listadoTipoUsuarios.php">Roles</a></li>
						<li><a class="<?php if($subseccion=="consultaEvaluacion") echo "active";?>" href="consultaEvaluacion.php">Calificaci&oacute;n encuesta</a></li>
					<?php endif;
					if ($objSession->getEnvioNotificaciones()==1):?>
						<li><a class="<?php if($subseccion=="notificacionPaciente") echo "active";?>" href="notificacionPaciente.php">Notificaciones</a></li>
					<?php endif; ?>						
					
					<?php if ($objSession->getidRol()==1||$objSession->getEnvioLink()==1){?>
						<li><a class="<?php if($subseccion=="enviaLink") echo "active";?>" href="enviaLink.php">Enviar encuesta</a></li>
					<?php }?>
					</ul>
				</li>
				
					<?php }?>
				<li><span class="opener <?php if($seccion=="pacientes") echo "active";?>" class="opener">Pacientes</span>
					<ul>
						<li><a class="<?php if($subseccion=="listadoPacientes") echo "active";?>" href="listadoPacientes.php">Listado</a></li>
						<li><a class="<?php if($subseccion=="altaPaciente") echo "active";?>" href="altaPaciente.php">Agregar nuevo</a></li>
						<li><a class="<?php if($subseccion=="buscarPaciente") echo "active";?>" href="buscarPaciente.php">B&uacute;squeda</a></li>
						<li><a class="<?php if($subseccion=="bloqueos") echo "active";?>" href="bloqueos.php">Bloqueos</a></li>
					</ul></li>

				<li><span class="opener <?php if($seccion=="citas") echo "active";?>">Citas</span>
					<ul>
						<li><a class="<?php if($subseccion=="listadoCitas") echo "active";?>" href="listadoCitas.php">Listado</a></li>
						<li><a class="<?php if($subseccion=="nuevaCita") echo "active";?>" href="nuevaCita.php">Agregar nueva</a></li>
						<li><a class="<?php if($subseccion=="buscarCita") echo "active";?>" href="buscarCita.php">B&uacute;squeda</a></li>
						<li><a class="<?php if($subseccion=="horariosDisponibles") echo "active";?>" href="horariosDisponibles.php">Disponibilidad</a></li>
						<li><a class="<?php if($subseccion=="verificaAsistencia") echo "active";?>" href="verificaAsistencia.php">Asistencia</a></li>
						<li><a class="<?php if($subseccion=="registroApartado") echo "active";?>" href="registroApartado.php">Reservar espacio</a></li>
						<li><a class="<?php if($subseccion=="citasAnteriores") echo "active";?>" href="citasAnteriores.php">Anteriores/Realizadas</a></li>
					</ul></li>


				<!-- <li><a class="<?php if($subseccion=="") echo "active";?>" href="">Promociones</a></li> -->
				<?php if ($objSession->getidRol()==1){?>
				<li><a class="<?php if($subseccion=="creditoSMS") echo "active";?>" href="creditoSMS.php">Cr&eacute;ditos SMS</a></li>
				<?php }?>
				
				<li><span class="opener <?php if($seccion=="herramientas") echo "active";?>" class="opener">Herramientas</span>
					<ul>
						<li><a class="<?php if($subseccion=="buscarCodigo") echo "active";?>" href="buscarCodigo.php">C&oacute;digos</a></li>
					<?php if ($objSession->getidRol()==1){?>
						<li><a class="<?php if($subseccion=="editarPromociones") echo "active";?>" href="editarPromociones.php">Promociones</a></li>
						<li><a class="<?php if($subseccion=="editarPersonal") echo "active";?>" href="editarPersonal.php">Personal encuestas</a></li>
					<?php }?>
					
					<?php if ($objSession->getidRol()==1||$objSession->getEnvioLink()==1){?>
						<li><a class="<?php if($subseccion=="enviaLink") echo "active";?>" href="enviaLink.php">Enviar encuesta</a></li>
						<li><a class="<?php if($subseccion=="listadoEncuestas") echo "active";?>" href="listadoEncuestas.php">Encuestas sin responder</a></li>
					<?php }?>
						<li><a class="<?php if($subseccion=="consultaMedios") echo "active";?>" href="consultaMedios.php">Medios de difusi&oacute;n </a></li>
					</ul>
				</li>
				

			</ul>
		</nav>
		<div id="calendarioVerde"></div>
		
				<!-- Footer -->
		<?php include_once 'footer.php';?>
	</div>
</div>
	<div class="alertify  ajs-movable ajs-closable ajs-pinnable ajs-slide" id="msjVerifica" style="display: none;">
		<div class="ajs-dimmer"></div>
		<div class="ajs-modal" tabindex="0">
			<div class="ajs-dialog" tabindex="0" style="">
				<div class="ajs-commands">
					<button class="ajs-close"  id="btnCerrarVerifica"></button>
				</div>
				<div class="ajs-header">Verifica asistencia</div>
				<div class="ajs-body">
					<div class="ajs-content" id="divVerifica"></div>
				</div>
				<div class="ajs-footer">
					<div class="ajs-auxiliary ajs-buttons"></div>
					<div class="ajs-primary ajs-buttons">
						<button class="ajs-button " id="btnSiVerifica">Si</button>
						<button class="ajs-button " id="btnNoVerifica">No</button>
					</div>
				</div>
			</div>
		</div>
	</div>
