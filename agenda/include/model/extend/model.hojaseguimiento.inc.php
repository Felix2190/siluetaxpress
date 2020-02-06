<?php

	require FOLDER_MODEL_BASE . "model.base.hojaseguimiento.inc.php";

	class ModeloHojaseguimiento extends ModeloBaseHojaseguimiento
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseHojaseguimiento";

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

		public function getSeguimientos($idPaciente)
		{
		    $query = "Select idHojaSeguimiento,DATE_FORMAT(fechaSeguimiento,'%d/%m/%Y') as fecha, 
                        pesoKg,IMC,pecho,talla,cintura,abdomen,cadera,dieta,tratamiento from hojaseguimiento 
                        where idPaciente=".$idPaciente." order by fechaRegistro asc";
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    $total=mysqli_num_rows($resultado);
		    if ($resultado && $total > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $arreglo[] = $row_inf;
		        }
		    }
		    return array('total'=>$total,'info'=>$arreglo);
		}
		
		public function getDetalleSeguimiento($idSeg)
		{
		    $query = "Select idHojaSeguimiento,DATE_FORMAT(fechaSeguimiento,'%d/%m/%Y') as fecha, hs.* ,
                   DATE_FORMAT(fechaSeguimiento,'%Y-%m-%d') as fecha2, concat_ws(' ', nombre,apellidos) as nombreCom,sucursal from hojaseguimiento as hs
                        inner join sucursal as s on hs.idSucursal=s.idSucursal
                        inner join usuario as u on hs.idUsuario=u.idUsuario
                         where idHojaSeguimiento=".$idSeg;
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    $total=mysqli_num_rows($resultado);
		    if ($resultado && $total > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $arreglo  = $row_inf;
		        }
		    }
		    return $arreglo;
		}
		
		public function getValoresByCampo($idPaciente,$campo)
		{
		    $query = "Select distinct DATE_FORMAT(fechaSeguimiento,'%d/%m/%Y') as fecha, $campo  from hojaseguimiento
                        where idPaciente=".$idPaciente." order by fechaSeguimiento desc limit 15";
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    $total=mysqli_num_rows($resultado);
		    if ($resultado && $total > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $arreglo[$row_inf['fecha']] = $row_inf["$campo"];
		        }
		    }
		    return array('total'=>$total,'info'=>array_reverse($arreglo));
		}

		public function getPrimerRegistro($idPaciente)
		{
		    $query = "Select pesoKg,IMC from hojaseguimiento
                     where idPaciente=".$idPaciente." order by fechaSeguimiento asc limit 1";
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    $total=mysqli_num_rows($resultado);
		    if ($resultado && $total > 0) {
		        $row_inf = mysqli_fetch_assoc($resultado);
		            $arreglo = $row_inf;
		    }
		    return $arreglo;
		}
		
		public function verificaFecha($idPaciente, $idSeg, $fecha)
		{
		    $query = "Select * from hojaseguimiento where idPaciente=$idPaciente and DATE_FORMAT(fechaSeguimiento,'%Y-%m-%d')='$fecha' and idHojaSeguimiento<>".$idSeg;
		    $resultado = mysqli_query($this->dbLink, $query);
		    $total=mysqli_num_rows($resultado);
		    if ($resultado && $total > 0) {
		        return true;
		    }
		    return false;
		}
		
	}