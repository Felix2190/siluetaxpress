<?php

	require FOLDER_MODEL_BASE . "model.base.paciente.inc.php";

	class ModeloPaciente extends ModeloBasePaciente
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBasePaciente";

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
		
		public function obtenerPacientes()
		{
		    global $objSession;
		    if ($this->idSucursal==0){
		    ///    $where = " p.idSucursal=".$objSession->getIdSucursal();
		    }else{
		        $where = " p.idSucursal=".$this->idSucursal;
		    }
		    $concat=" ";
		    $inner=" ";
		    if (/*$objSession->getidRol()==1&&*/$this->idSucursal==''){
		        $where=" true ";
		    }
		        $concat=", '(', s.sucursal, ')'";
		        $inner=" inner join sucursal as s on p.idSucursal=s.idSucursal ";
		        
		    //}
		    $query = "Select p.idPaciente, concat_ws(' ', p.nombre, p.apellidos$concat) as nombreP from paciente as p $inner where $where and p.estatus='activo'";
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $arreglo[$row_inf['idPaciente']] = $row_inf['nombreP'];
		        }
		    }
		    return $arreglo;
		}
		
		public function listadoPacientes($idSucursal)
		{
		    global $objSession;
		    $where=" true ";
		    $concat=" ";
		    $inner=" ";
		    if ($objSession->getidRol()!=1){
		        $where = " p.idSucursal=".$objSession->getIdSucursal();
		    }
		    if ($idSucursal!=""){
		        $where = " p.idSucursal=".$idSucursal;
		    }
		    $query = "Select p.idPaciente, concat_ws(' ', p.nombre, p.apellidos) as nombreP, telefonoCel, sucursal, completitud, 
                    DATE_FORMAT(p.fechaRegistro,'%Y-%m-%d') as fecha, 
                    (select count(*) from cita where idPaciente=p.idPaciente and estatus='realizada') as consultasHechas, 
                    (select count(*) from cita where idPaciente=p.idPaciente and (estatus='nueva' or estatus='curso')) as consultasProximas,
                    (select DATE_FORMAT(fechaInicio,'%Y-%m-%d') from cita where idPaciente=p.idPaciente and estatus='nueva' order by fechaInicio limit 1) as fechaProxima ,
                     (select idCita from cita where idPaciente=p.idPaciente and estatus='nueva' order by fechaInicio limit 1) as cita 
                    from paciente as p 
		             inner join sucursal as s on p.idSucursal=s.idSucursal
                       inner join hojaclinica as h on p.idHojaClinica=h.idHojaClinica where $where  and p.estatus='activo'";
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $arreglo[] = $row_inf;
		        }
		    }
		    return $arreglo;
		}
		
		
		public function validarDatos(){
		    return true;
		}
		
	}

