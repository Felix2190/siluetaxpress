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
		
		public function obtenerCitas()
		{
		    $condicion=" ";
		    if ($this->idPaciente>0)
		        $condicion.=" and c.idPaciente=$this->idPaciente";
		    if ($this->idSucursal>0)
		        $condicion.=" and c.idSucursal=".$this->idSucursal;
		    if ($this->idUsuario)
		        $condicion.=" and c.idUsuario=".$this->idUsuario;
		    $fecha=date("Y-m-d");
		    $query = "Select idCita, DATE_FORMAT(fechaInicio,'%Y-%m-%d') as fecha, DATE_FORMAT(fechaInicio,'%H:%i') as hora, duracion, 
                    concat_ws(' ', p.nombre, p.apellidos) as nombre_paciente, 
                    tipoConsulta, sucursal from cita as c
                    inner join usuario as u on c.idUsuario=u.idUsuario
                    inner join paciente as p on c.idPaciente=p.idPaciente
                    inner join sucursal as s on c.idSucursal=s.idSucursal
                    inner join consulta as co on c.idConsulta=co.idConsulta
                    where  fechaInicio>='$fecha' $condicion order by fecha,hora";
		    $respuesta = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $respuesta[] = $row_inf;
		        }
		    }
		    return $respuesta;
		}
		
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

