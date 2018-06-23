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
				<li><span class="opener">Mi cuenta</span>
					<ul>
						<li><a href="">Perfil</a></li>
						<li><a href="">Cambiar contrase&ntilde;a</a></li>
						<li><a href="logout.php">Cerrar sessi&oacute;n</a></li>
					</ul></li>

				<li><span class="opener">Administrar</span>
					<ul>
						<li><a href="">Consultorios</a></li>
						<li><a href="">Usuarios</a></li>
					</ul></li>

				<li><span class="opener">Pacientes</span>
					<ul>
						<li><a href="">Listado</a></li>
						<li><a href="altaPaciente.php">Agregar nuevo</a></li>
						<li><a href="">B&uacute;squedad</a></li>
					</ul></li>

				<li><span class="opener">Citas</span>
					<ul>
						<li><a href="listadoCitas.php">Listado</a></li>
						<li><a href="nuevaCita.php">Agregar nueva</a></li>
						<li><a href="">B&uacute;squedad</a></li>
						<li><a href="horariosDisponibles.php">Disponibilidad</a></li>
						
					</ul></li>


				<li><a href="">Promociones</a></li>
				<li><a href="">Cr&eacute;ditos SMS</a></li>

			</ul>
		</nav>


		<!-- Footer -->
		<?php include_once 'footer.php';?>
	</div>
</div>
