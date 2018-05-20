<?php

	require FOLDER_MODEL_BASE . "model.base.cita.inc.php";

	class ModeloCita extends ModeloBaseCita
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseCita";

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
		
		public function obtenerCitasFechaDuracion()
		{
		    $fechaF = strtotime ( '+1 day' , strtotime ( $this->fechaFin ) ) ;
		    $fechaF = date ( 'Y-m-d' , $fechaF );
		    $query = "Select idCita, fechaInicio, fechaFin, duracion from cita 
                    where idSucursal=$this->idSucursal and idConsulta=$this->idConsulta and fechaInicio between DATE('$this->fechaInicio') and DATE('$fechaF')";
		    $respuesta = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $respuesta[] = $row_inf;
		        }
		    }
		    return $respuesta;
		}
		
		public function validarDatos(){
		    return true;
		}
		
		public function disponibliadDia()
		{
		    $query = "Select * from cita
                    where idSucursal=$this->idSucursal and idConsulta=$this->idConsulta 
            and (('$this->fechaInicio'>=fechaInicio and '$this->fechaInicio'<=fechaFin) or ('$this->fechaFin'>=fechaInicio and '$this->fechaFin'<=fechaFin)
            or ('$this->fechaInicio'<=fechaInicio and '$this->fechaFin'>=fechaFin))";
		    $respuesta = true;
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        return false;
		    }
		    return $respuesta;
		}
		
		
	}

