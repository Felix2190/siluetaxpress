<?php

	require FOLDER_MODEL_BASE . "model.base.encuesta.inc.php";

	class ModeloEncuesta extends ModeloBaseEncuesta
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseEncuesta";

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

		public function obtenerEvaluacion($mes, $anio)
		{
		    global $objSession;
		    $query = "SELECT idTipoConsulta,e.idPersonal, p.nombreCompleto, COUNT(*) total, 
            SUM(evaluacion)/count(*)*(10/4) promedio FROM encuesta e 
                INNER JOIN personal p on e.idPersonal=p.idPersonal
                where p.activo=1 and p.idSucursal=".$objSession->getIdSucursal()." and evaluacion>0 and date_format(e.fechaRegistro,'%m-%Y')='$mes-$anio'
                GROUP by e.idTipoConsulta,idPersonal";
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)) {
		            $arreglo[$row_inf['idTipoConsulta']][$row_inf['nombreCompleto']] = array($row_inf['total'],$row_inf['promedio']);
		        }
		    }
		    $query = "SELECT idTipoConsulta,e.idPersonalRecepcion, p.nombreCompleto, COUNT(*) total,
            SUM(evaluacionRecepcion)/count(*)*(10/4) promedioRecepcion FROM encuesta e
                INNER JOIN personal p on e.idPersonalRecepcion=p.idPersonal
                where p.activo=1 and p.idSucursal=".$objSession->getIdSucursal()." and evaluacionRecepcion>0 and date_format(e.fechaRegistro,'%m-%Y')='$mes-$anio'
                GROUP by idPersonalRecepcion";
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)) {
		            $arreglo[4][$row_inf['nombreCompleto']] = array($row_inf['total'],$row_inf['promedioRecepcion']);
		        }
		    }
		    return $arreglo;
		}
		
		public function obtenerComentarios($mes, $anio)
		{
		    global $objSession;
		    $query = "SELECT opinion FROM encuesta e
                where e.idSucursal=".$objSession->getIdSucursal()." and opinion<>'' and date_format(e.fechaRegistro,'%m-%Y')='$mes-$anio'";
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)) {
		            $arreglo[] = $row_inf['opinion'];
		        }
		    }
		    return $arreglo;
		}
		
		public function existeEncuestaByIdCita($idCita)
		{
		    $query = "SELECT idEncuesta FROM encuesta where idCita=$idCita";
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        $row_inf = mysqli_fetch_assoc($resultado);
		        return $row_inf['idEncuesta'];
		    }
		        return 0;
		}
		
	}