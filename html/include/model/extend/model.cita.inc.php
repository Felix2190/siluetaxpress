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
		    $fecha=date("Y-m-d H:i:s");
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
                    concat_ws(' ', p.nombre, p.apellidos) as nombre_paciente, DATE_FORMAT(fechaFin,'%H:%i') as horaFin,
                    tipoConsulta, sucursal, ser.nombre as servicio, ca.nombre as cabina from cita as c
                    inner join usuario as u on c.idUsuario=u.idUsuario
                    inner join paciente as p on c.idPaciente=p.idPaciente
                    inner join sucursal as s on c.idSucursal=s.idSucursal
                    inner join consulta as co on c.idConsulta=co.idConsulta
                    inner join servicio as ser on c.idServicio=ser.idServicio
                    inner join cabina as ca on c.idCabina=ca.idCabina
                    where (c.estatus='nueva' or c.estatus='curso') and fechaInicio>='$this->fechaInicio'  $condicion order by fechaInicio,c.idCabina";

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
		    $idCita=0;
		    if (isset($_SESSION['verCita'])){
		    $aux =$_SESSION['verCita'];
		    $idCita=$aux['idCita'];
		    }
		    $fechaF = strtotime ( '+1 day' , strtotime ( $this->fechaFin ) ) ;
		    $fechaF = date ( 'Y-m-d' , $fechaF );
		    $query = "Select idCita, fechaInicio, fechaFin, duracion from cita 
                    where idCita<>$idCita and (estatus='nueva' or estatus='curso') and idSucursal=$this->idSucursal and idConsulta=$this->idConsulta and idCabina=$this->idCabina and fechaInicio between DATE('$this->fechaInicio') and DATE('$fechaF')";
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
                    where (estatus='nueva' or estatus='curso') and idSucursal=$this->idSucursal and idConsulta=$this->idConsulta and idCabina=$this->idCabina 
            and (('$this->fechaInicio'>=fechaInicio and '$this->fechaInicio'<fechaFin) or ('$this->fechaFin'>fechaInicio and '$this->fechaFin'<=fechaFin)
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
                    where (estatus='nueva' or estatus='curso') $condicion and 
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
                    concat_ws(' ', p.nombre, p.apellidos) as nombre_paciente,ec.descripcion,u.idUsuario,
                    tipoConsulta, sucursal, ser.nombre as servicio, ca.nombre as cabina from cita as c
                    inner join usuario as u on c.idUsuario=u.idUsuario
                    inner join paciente as p on c.idPaciente=p.idPaciente
                    inner join sucursal as s on c.idSucursal=s.idSucursal
                    inner join consulta as co on c.idConsulta=co.idConsulta
                    inner join servicio as ser on c.idServicio=ser.idServicio
                    inner join cabina as ca on c.idCabina=ca.idCabina
                    inner join estatuscita as ec on c.estatus=ec.estatusCita
                    where  $condicion order by fechaInicio,c.idCabina";
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

    public function obtenerInformacionCita()
    {
        $query = "Select idCita, DATE_FORMAT(fechaInicio,'%Y-%m-%d') as fecha, DATE_FORMAT(fechaInicio,'%H:%i') as hora, duracion,
                    concat_ws(' ', p.nombre, p.apellidos) as nombre_paciente, DATE_FORMAT(fechaFin,'%H:%i') as horaFin,
                    tipoConsulta, sucursal, ser.nombre as servicio, ca.nombre as cabina,enviarRecordatorio2,recordatorio2,
                    idUsuarioCancela, concat_ws(' ', u.nombre, u.apellidos) as nombre_usuario, e.descripcion,
                    s.idSucursal,ca.idCabina,co.idConsulta,c.idUsuario,
                    if(idUsuarioCancela=0,'', (select concat_ws(' ', nombre, apellidos) from usuario where idUsuario=idUsuarioCancela)) as personaCancela from cita as c
                    inner join usuario as u on c.idUsuario=u.idUsuario
                    inner join paciente as p on c.idPaciente=p.idPaciente
                    inner join sucursal as s on c.idSucursal=s.idSucursal
                    inner join consulta as co on c.idConsulta=co.idConsulta
                    inner join servicio as ser on c.idServicio=ser.idServicio
                    inner join cabina as ca on c.idCabina=ca.idCabina
                    inner join estatuscita as e on c.estatus=e.estatusCita
                    where idCita=$this->idCita";
        
        $respuesta = array();
        $resultado = mysqli_query($this->dbLink, $query);
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            while ($row_inf = mysqli_fetch_assoc($resultado)) {
		        $respuesta[] = $row_inf;
            }
        }
        return $respuesta;
    }
		
    public function resumenCitas($fecha)
    {
        $condicion = " ";
        if ($this->idSucursal > 0)
            $condicion .= " and c.idSucursal=" . $this->idSucursal;
        if ($this->idUsuario)
            $condicion .= " and c.idUsuario=" . $this->idUsuario;
        
        $query = "Select count(*) as resultado, '0' from cita as c
                    where c.estatus='curso' and DATE_FORMAT(c.fechaInicio,'%Y-%m-%d')>='$fecha' and DATE_FORMAT(c.fechaFin,'%Y-%m-%d')<='$fecha'  $condicion
               union 
                Select count(*) as resultado, '1' from cita as c
                    where estatus='realizada' and DATE_FORMAT(c.fechaInicio,'%Y-%m-%d')>='$fecha' and DATE_FORMAT(c.fechaFin,'%Y-%m-%d')<='$fecha'  $condicion
               union 
                Select count(*) as resultado, '2' from cita as c
                    where c.estatus='nueva' and DATE_FORMAT(c.fechaInicio,'%Y-%m-%d')>='$fecha' and DATE_FORMAT(c.fechaFin,'%Y-%m-%d')<='$fecha'  $condicion
               union 
                Select count(*) as resultado, '3' from cita as c
                    where estatus='cancelada_encargado' and  DATE_FORMAT(c.fechaInicio,'%Y-%m-%d')>='$fecha' and DATE_FORMAT(c.fechaFin,'%Y-%m-%d')<='$fecha'  $condicion
               union 
                Select count(*) as resultado, '4' from cita as c
                    where c.estatus='cancelada_paciente' and  DATE_FORMAT(c.fechaInicio,'%Y-%m-%d')>='$fecha' and DATE_FORMAT(c.fechaFin,'%Y-%m-%d')<='$fecha'  $condicion";
               
               $items = array("divCitaCurso","divCitaRea","divCitaProxs","divCitaCP","divCitaCE");
               $titulos = array("en curso","realizadas","pr&oacute;ximas","canceladas por el encargado","canceladas por el paciente");
        $total=0;
        $respuesta = array();
        $resultado = mysqli_query($this->dbLink, $query);
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $i=0;
            while ($row_inf = mysqli_fetch_assoc($resultado)) {
                $respuesta[$items[$i]]= array($row_inf['resultado'],$titulos[$i]);
                    $total+=$row_inf['resultado'];
                $i++;
            }
            $respuesta['divCitaTot']=array($total,'totales',100);
        }
        $i=0;
        if ($total==0)
            $porcentaje=0;
        else
            $porcentaje=100/$total;
        foreach ($items as $item){
            $respuesta[$item][2]=intval($respuesta[$item][0]*$porcentaje);
        }
        
        $citasProximas=$citasCurso = array();
        
        if ($this->idSucursal>0)
        {
        $query="select distinct c.idCabina, idCita, ca.nombre as cabina from cita as c inner join cabina as ca on c.idCabina=ca.idCabina
                    where estatus='curso' and  DATE_FORMAT(fechaInicio,'%Y-%m-%d')>='$fecha'  and DATE_FORMAT(fechaFin,'%Y-%m-%d')<='$fecha'
                 $condicion  order by fechaInicio asc ";
            
             $resultado = mysqli_query($this->dbLink, $query);
            
            if ($resultado && mysqli_num_rows($resultado) > 0) {
                while ($row_inf = mysqli_fetch_assoc($resultado)) {
                    if (!key_exists($row_inf['idCabina'], $citasCurso))
                        $citasCurso[$row_inf['idCabina']]=array('idCita'=>$row_inf['idCita'],'cabina'=>$row_inf['cabina']);
                }
            }
        
        $query="select distinct c.idCabina, idCita, ca.nombre as cabina from cita as c inner join cabina as ca on c.idCabina=ca.idCabina
                    where estatus='nueva' and  DATE_FORMAT(fechaInicio,'%Y-%m-%d')>='$fecha'  and DATE_FORMAT(fechaFin,'%Y-%m-%d')<='$fecha'
                 $condicion  order by fechaInicio asc ";
        
                 $resultado = mysqli_query($this->dbLink, $query);
                 
                 if ($resultado && mysqli_num_rows($resultado) > 0) {
                     while ($row_inf = mysqli_fetch_assoc($resultado)) {
                         if (!key_exists($row_inf['idCabina'], $citasProximas))
                             $citasProximas[$row_inf['idCabina']]=array('idCita'=>$row_inf['idCita'],'cabina'=>$row_inf['cabina']);
                     }
                 }
        }
        return array($respuesta,$citasCurso,$citasProximas);
    }
    
    public function SMSEnviados()
    {
          $query = "Select count(*) as total from cita where recordatorio1=1
                    union
                    Select count(*) as total from cita where recordatorio2=1
                    union
                    Select count(*) as total from cita where idUsuarioCancela=0 and estatus='cancelada_paciente'";
                
                $titulos = array("Confirmaci&oacute;n de cita","Recordatorio","Respuesta de cancelaci&oacute;n");
                $total=0;
                $respuesta = array();
                $resultado = mysqli_query($this->dbLink, $query);
                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    $i=0;
                    while ($row_inf = mysqli_fetch_assoc($resultado)) {
                        $respuesta[$titulos[$i]]= $row_inf['total'];
                        $total+=$row_inf['total'];
                        $i++;
                    }
                    $respuesta['Total']=$total;
                }
                
                        return json_encode($respuesta);
    }
}

