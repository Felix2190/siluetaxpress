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
		    $query = "Select idHojaSeguimiento,DATE_FORMAT(fechaRegistro,'%d/%m/%Y') as fecha, 
                        pesoKg,estatura,IMC,pecho,talla,cintura,abdomen,cadera from hojaseguimiento 
                        where idPaciente=".$idPaciente." order by fechaRegistro desc";
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
		    $query = "Select idHojaSeguimiento,DATE_FORMAT(fechaRegistro,'%d/%m/%Y') as fecha, dieta, tratamiento, sintomas,
                        pesoKg,estatura,IMC,pecho,talla,cintura,abdomen,cadera, sucursal, concat_ws(' ', nombre,apellidos) as nombreCom from hojaseguimiento as hs
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
	}

