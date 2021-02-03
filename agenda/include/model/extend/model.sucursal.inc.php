<?php

	require FOLDER_MODEL_BASE . "model.base.sucursal.inc.php";

	class ModeloSucursal extends ModeloBaseSucursal
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseSucursal";

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
		
		public function obtenerSucurales()
		{
		    $query = "Select idSucursal, sucursal from sucursal where idSucursal<>1";
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		        $arreglo[$row_inf['idSucursal']] = $row_inf['sucursal'];
		        }
		    }
		    return $arreglo;
		}
		
		public function obtenerInfoSucursal($idSucural)
		{
		    $query = "Select idSucursal, sucursal from sucursal where idSucursal=".$idSucural;
		    $respuesta = '';
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $respuesta = $row_inf['sucursal'];
		        }
		    }
		    return $respuesta;
		}
		
		public function listadoSucursales()
		{
		    global $objSession;
		    $query = "Select s.idSucursal, s.sucursal, direccion, NOM_ENT, NOM_MUN, entreSemanaEntrada, entreSemanaSalida, sabadoEntrada, sabadoSalida from sucursal as s
                    inner join inegidomgeo_cat_estado as e on s.cveEstado=e.CVE_ENT
                    inner join inegidomgeo_cat_municipio as m on s.cveEstado=m.CVE_ENT and s.cveMunicipio=m.CVE_MUN where s.idSucursal<>1 and s.idFranquicia=".$objSession->getIdFranquicia();
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $arreglo[] = $row_inf;
		        }
		    }
		    return $arreglo;
		}
		
		
		public function obtenerSucuralesFranquicia()
		{
		    $query = "Select idSucursal, sucursal from sucursal where idSucursal<>1 and idFranquicia=".$this->getIdFranquicia();
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $arreglo[$row_inf['idSucursal']] = $row_inf['sucursal'];
		        }
		    }
		    return $arreglo;
		}
		
		
		public function obtenerSucuralesFranquiciaSesion()
		{
		    global $objSession;
		    $query = "Select idSucursal, sucursal from sucursal where idSucursal<>1 and idFranquicia=".$objSession->getIdFranquicia();
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $arreglo[$row_inf['idSucursal']] = $row_inf['sucursal'];
		        }
		    }
		    return $arreglo;
		}
		
		public function obtenerSucuralesSMS()
		{
		    global $objSession;
		    $query = "Select idSucursal, sucursal from sucursal where idSucursal<>1 and idFranquicia=".$objSession->getIdFranquicia().
		     ($objSession->getidRol()!=1?(" and idSucursal=".$objSession->getIdSucursal()):"");
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $arreglo[$row_inf['idSucursal']] = $row_inf['sucursal'];
		        }
		    }
		    return $arreglo;
		}
		
		public function validarDatos(){
		    return true;
		}
		
	}

