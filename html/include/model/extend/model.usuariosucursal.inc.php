<?php

	require FOLDER_MODEL_BASE . "model.base.usuariosucursal.inc.php";

	class ModeloUsuariosucursal extends ModeloBaseUsuariosucursal
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseUsuariosucursal";

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
		
		public function obtenerSucurales()
		{
		    global $objSession;
		    $query = "Select s.idSucursal, s.sucursal from usuariosucursal as us
                    inner join sucursal as s on us.idSucursal=s.idSucursal 
                where idUsuario=".$objSession->getidUsuario();
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $arreglo[$row_inf['idSucursal']] = $row_inf['sucursal'];
		        }
		    }
		    return array($arreglo,$objSession->getIdSucursal());
		}
		
		public function obtenerSucuralesByUsuario ()
		{
		    $query = "Select s.idSucursal, s.sucursal from usuariosucursal as us
                    inner join sucursal as s on us.idSucursal=s.idSucursal
                where idUsuario=".$this->getIdUsuario();
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $arreglo[$row_inf['idSucursal']] = $row_inf['sucursal'];
		        }
		    }
		    return $arreglo;
		}
		
		public function eliminarByUsuario ()
		{
		    $query = "delete from usuariosucursal where idUsuario=".$this->getIdUsuario();
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado) {
		        return true;
		    }
		    return false;
		}

	}
