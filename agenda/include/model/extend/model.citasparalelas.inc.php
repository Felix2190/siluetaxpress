<?php

	require FOLDER_MODEL_BASE . "model.base.citasparalelas.inc.php";

	class ModeloCitasparalelas extends ModeloBaseCitasparalelas
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseCitasparalelas";

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

		// buscar cita1 y cita2
		public function exiteProblemaCitas()
		{
		    $query = "Select * from citasparalelas where estatus='pendiente' and 
                ((idCita1=$this->idCita1  and idCita2=$this->idCita2) or (idCita1=$this->idCita2  and idCita2=$this->idCita1))
                limit 1";
		    $respuesta = false;
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        return true;
		    }
		    return $respuesta ;
		}
		//totAl problematicas
		public function obtenerTotalProblemaCitasByUsuario($idUsuario)
		{
		    $query = "Select * from citasparalelas where estatus='pendiente' and idUsuario=$idUsuario";
		    $resultado = mysqli_query($this->dbLink, $query);
		    $arr=array();
		    if ($resultado && mysqli_num_rows($resultado)){
		        while ($row=mysqli_fetch_assoc($resultado)){
		            array_push($arr, $row['idCita1']);
		        }
		    }
		    return $arr;
		}
		
		//array problematicas
		public function obtenerCitasProblematicas($array)
		{
		    $query = "Select  c.idCita, cp.actualizable,c.idUsuario,c.idPaciente as pa, idCita1,idCita2,
                    DATE_FORMAT(fechaInicio,'%Y-%m-%d') as fecha, DATE_FORMAT(fechaInicio,'%H:%i') as hora, 
                    (select concat_ws(' ', p.nombre, p.apellidos) from paciente as p where p.idPaciente=pa) as nombre_paciente, DATE_FORMAT(fechaFin,'%H:%i') as horaFin,
                    ca.nombre as cabina, sucursal, concat_ws(' ', u.nombre, u.apellidos) as nombre_usuario from citasparalelas as cp
                    inner join cita as c on (cp.idCita1=c.idCita or cp.idCita2=c.idCita)
                    inner join usuario as u on c.idUsuario=u.idUsuario
                    inner join sucursal as s on c.idSucursal=s.idSucursal
                    inner join cabina as ca on c.idCabina=ca.idCabina
                    where cp.estatus='pendiente' and (cp.idCita1 in ($array) or cp.idCita2 in ($array)) order by c.fechaInicio asc";
		    $resultado = mysqli_query($this->dbLink, $query);
		    $arr=array();
		    if ($resultado && mysqli_num_rows($resultado)){
		        while ($row=mysqli_fetch_assoc($resultado)){
		            array_push($arr, $row);
		        }
		    }
		    return $arr;
		}
		  
		public function resolverProblemaCitasByCita($idCita)
		{
		    $query = "update citasparalelas set estatus='resuelto' where idCita1=$idCita or idCita2=$idCita";
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado){
		        return true;
		    }
		    return false;
		}
		
	}

