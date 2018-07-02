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

		</section>

		<!-- Menu -->
		<nav id="menu">
			<ul>
				<li><span class="opener <?php if($seccion=="cuenta") echo "active";?>" class="opener">Mi cuenta</span>
					<ul>
						<li><a class="<?php if($subseccion=="") echo "active";?>" href="">Perfil</a></li>
						<li><a class="<?php if($subseccion=="") echo "active";?>" href="">Cambiar contrase&ntilde;a</a></li>
						<li><a href="logout.php">Cerrar sessi&oacute;n</a></li>
					</ul></li>

				<li><span class="opener <?php if($seccion=="administracionn") echo "active";?>" class="opener">Administrar</span>
					<ul>
						<li><a class="<?php if($subseccion=="") echo "active";?>" href="">Consultorios</a></li>
						<li><a class="<?php if($subseccion=="") echo "active";?>" href="">Usuarios</a></li>
					</ul></li>

				<li><span class="opener <?php if($seccion=="pacientes") echo "active";?>" class="opener">Pacientes</span>
					<ul>
						<li><a class="<?php if($subseccion=="listadoPacientes") echo "active";?>" href="listadoPacientes.php">Listado</a></li>
						<li><a class="<?php if($subseccion=="altaPaciente") echo "active";?>" href="altaPaciente.php">Agregar nuevo</a></li>
						<li><a class="<?php if($subseccion=="") echo "active";?>" href="">B&uacute;squeda</a></li>
					</ul></li>

				<li><span class="opener <?php if($seccion=="citas") echo "active";?>">Citas</span>
					<ul>
						<li><a class="<?php if($subseccion=="listadoCitas") echo "active";?>" href="listadoCitas.php">Listado</a></li>
						<li><a class="<?php if($subseccion=="nuevaCita") echo "active";?>" href="nuevaCita.php">Agregar nueva</a></li>
						<li><a class="<?php if($subseccion=="") echo "active";?>" href="">B&uacute;squedad</a></li>
						<li><a class="<?php if($subseccion=="horariosDisponibles") echo "active";?>" href="horariosDisponibles.php">Disponibilidad</a></li>
						
					</ul></li>


				<li><a class="<?php if($subseccion=="") echo "active";?>" href="">Promociones</a></li>
				<li><a class="<?php if($subseccion=="") echo "active";?>" href="">Cr&eacute;ditos SMS</a></li>

			</ul>
		</nav>


		<!-- Footer -->
		<?php include_once 'footer.php';?>
	</div>
</div>
