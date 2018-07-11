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
		    $fecha=date("Y-m-d");
		    $condicion=" ";
		    
		    if ($this->idPaciente>0)
		        $condicion.=" and c.idPaciente=$this->idPaciente";
		        else{
		            $fechaFin = date ("Y-m-d",strtotime ( '+7 day' , strtotime ( $this->fechaInicio) ) );
		            $condicion.="and fechaInicio<='$fechaFin' ";
		        }
		    if ($this->idSucursal>0)
		        $condicion.=" and c.idSucursal=".$this->idSucursal;
		    if ($this->idUsuario)
		        $condicion.=" and c.idUsuario=".$this->idUsuario;
		    if ($this->idCabina>0)
		        $condicion.=" and c.idCabina=$this->idCabina";
		    
		    $query = "Select idCita, DATE_FORMAT(fechaInicio,'%Y-%m-%d') as fecha, DATE_FORMAT(fechaInicio,'%H:%i') as hora, duracion, 
                    concat_ws(' ', p.nombre, p.apellidos) as nombre_paciente, 
                    tipoConsulta, sucursal, ser.nombre as servicio, ca.nombre as cabina from cita as c
                    inner join usuario as u on c.idUsuario=u.idUsuario
                    inner join paciente as p on c.idPaciente=p.idPaciente
                    inner join sucursal as s on c.idSucursal=s.idSucursal
                    inner join consulta as co on c.idConsulta=co.idConsulta
                    inner join servicio as ser on c.idServicio=ser.idServicio
                    inner join cabina as ca on c.idCabina=ca.idCabina
                    where  fechaInicio>='$this->fechaInicio'  $condicion order by fecha,hora,c.idCabina";

		    $respuesta = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $respuesta[$row_inf['fecha']][$row_inf['idCita']] = $row_inf;
		        }
		    }
		    return $respuesta;
		}
		
		public function obtenerCitasFechaDuracion()
		{
		    $fechaF = strtotime ( '+1 day' , strtotime ( $this->fechaFin ) ) ;
		    $fechaF = date ( 'Y-m-d' , $fechaF );
		    $query = "Select idCita, fechaInicio, fechaFin, duracion from cita 
                    where idSucursal=$this->idSucursal and idConsulta=$this->idConsulta and idCabina=$this->idCabina and fechaInicio between DATE('$this->fechaInicio') and DATE('$fechaF')";
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
                    where idSucursal=$this->idSucursal and idConsulta=$this->idConsulta and idCabina=$this->idCabina 
            and (('$this->fechaInicio'>=fechaInicio and '$this->fechaInicio'<=fechaFin) or ('$this->fechaFin'>=fechaInicio and '$this->fechaFin'<=fechaFin)
            or ('$this->fechaInicio'<=fechaInicio and '$this->fechaFin'>=fechaFin))";
		    $respuesta = true;
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        return false;
		    }
		    return $respuesta;
		}
		
		public function obtenerCitasSucursalConsultorioFechaDuracion( )
		{
		    $condicion=" ";
		    if ($this->idSucursal>0)
		        $condicion.=" and idSucursal=".$this->idSucursal;
		            if ($this->idCabina>0)
		                $condicion.=" and idCabina=$this->idCabina";
		                
		    $query = "Select idSucursal, idCabina, fechaInicio, fechaFin, duracion from cita
                    where true $condicion and 
                    fechaInicio >='$this->fechaInicio' and fechaFin<='$this->fechaFin' order by idSucursal, idCabina, fechaInicio";
		    $respuesta = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $respuesta[] = $row_inf;
		        }
		    }
		    return $respuesta;
		}
		
		public function buscarCitas($fecha,$hora)
		{
		    $condicion="true ";
		    if ($hora!="0:0")
		        $condicion.=" and DATE_FORMAT(fechaInicio,'%H:%i')='$hora'";
		    if ($fecha!="")
		        $condicion.="and DATE_FORMAT(fechaInicio,'%Y-%m-%d')='$fecha' ";
		        if ($this->idPaciente!="")
		        $condicion.=" and c.idPaciente=$this->idPaciente";
		        
		        if ($this->idSucursal!="")
		            $condicion.=" and c.idSucursal=".$this->idSucursal;
		            if ($this->idConsulta!="")
		                $condicion.=" and c.idConsulta=".$this->idConsulta;
		                if ($this->idCabina!="")
		                    $condicion.=" and c.idCabina=$this->idCabina";
		                    if ($this->estatus!="")
		                        $condicion.=" and c.estatus=$this->estatus";
		                        
		                    $query = "Select idCita, DATE_FORMAT(fechaInicio,'%Y-%m-%d') as fecha, DATE_FORMAT(fechaInicio,'%H:%i') as hora, duracion,
                    concat_ws(' ', p.nombre, p.apellidos) as nombre_paciente,c.estatus,u.idUsuario,
                    tipoConsulta, sucursal, ser.nombre as servicio, ca.nombre as cabina from cita as c
                    inner join usuario as u on c.idUsuario=u.idUsuario
                    inner join paciente as p on c.idPaciente=p.idPaciente
                    inner join sucursal as s on c.idSucursal=s.idSucursal
                    inner join consulta as co on c.idConsulta=co.idConsulta
                    inner join servicio as ser on c.idServicio=ser.idServicio
                    inner join cabina as ca on c.idCabina=ca.idCabina
                    where  $condicion order by fecha,hora,c.idCabina";
		                 // return $query;
		                    $respuesta = array();
		                    $resultado = mysqli_query($this->dbLink, $query);
		                    if ($resultado && mysqli_num_rows($resultado) > 0) {
		                        while ($row_inf = mysqli_fetch_assoc($resultado)){
		                            $respuesta[] = $row_inf;
		                        }
		                    }
		                    return $respuesta;
		}
		
	}

