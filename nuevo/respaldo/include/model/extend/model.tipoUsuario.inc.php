<?php

	require FOLDER_MODEL_BASE . "model.base.tipousuario.inc.php";

	class ModeloTipoUsuario extends ModeloBaseTipoUsuario
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseTipoUsuario";

		var $__ss=array();

		#------------------------------------------------------------------------------------------------------#
		#--------------------------------------------Inicializacion--------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		function __construct()
		{
			parent::__construct();
		}

		function __destruct()
		{
			
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Setter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function validarDatos()
		{
			return true;
		}
		
		public function obtenerTipoUsuarios()
		{
		    $query = "Select * from tipousuario where idTipoUsuario<>1";
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $arreglo[] = $row_inf;
		        }
		    }
		    return $arreglo;
		}
		
		public function obtenerCargos()
		{
		    $query = "Select idTipoUsuario, nombre from tipousuario where idTipoUsuario<>1";
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $arreglo[$row_inf['idTipoUsuario']] = $row_inf['nombre'];
		        }
		    }
		    return $arreglo;
		}
		

	}
