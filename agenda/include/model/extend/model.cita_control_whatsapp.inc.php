<?php

	require FOLDER_MODEL_BASE . "model.base.cita_control_whatsapp.inc.php";

	class ModeloCita_control_whatsapp extends ModeloBaseCita_control_whatsapp
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseCita_control_whatsapp";

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
		
		public function validacion($idCita)
		{
		    
		    $query = "Select * from cita_control_whatsapp where idCita=".$idCita." order by fechaEnvio desc limit 1";
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        $row_inf = mysqli_fetch_assoc($resultado);
		        if ($row_inf['estatus']=='Pendiente'||$row_inf['estatus']=='Error'){
		            if ($row_inf['fechaRespuesta']=='0000-00-00 00:00:00')
		                return array(true,"template");
		            else
		                $fecha = new DateTime($row_inf['fechaRespuesta']);
		            $fecha->add(new DateInterval('PT23H'));
		            $fechaActual = new DateTime(date('Y-m-d H:i:s'));
		            
		            if ($fechaActual<$fecha)
		                return array(true,"text");
		            else
		                return array(true,"template");
		                
		        }else 
		            return array(false);
		    }
		    return array(true,"template");
		}
		
		public function buscaCitaPorTel($tel)
		{
		    
		    $query = "Select idControl,idCita from cita_control_whatsapp where numeroCelular='".$tel."' and estatus<>'Cancelada' order by fechaEnvio desc limit 1";
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        return mysqli_fetch_assoc($resultado);
		       
		    }
		    return array('idControl'=>0);
		}
		
	}

