<?php

	class ModeloBaseCita_control_whatsapp extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseCita_control_whatsapp";

		
		var $idControl=0;
		var $idCita=0;
		var $idPlantilla=0;
		var $numeroCelular='';
		var $estatus='Pendiente';
		var $fechaEnvio='';
		var $fechaRespuesta='';
		var $errorMeta='';
		var $idUsuario=0;

		var $__s=array("idControl","idCita","idPlantilla","numeroCelular","estatus","fechaEnvio","fechaRespuesta","errorMeta","idUsuario");
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

		
		public function setIdControl($idControl)
		{
			if($idControl==0||$idControl==""||!is_numeric($idControl)|| (is_string($idControl)&&!ctype_digit($idControl)))return $this->setError("Tipo de dato incorrecto para idControl.");
			$this->idControl=$idControl;
			$this->getDatos();
		}
		public function setIdCita($idCita)
		{
			
			$this->idCita=$idCita;
		}
		public function setIdPlantilla($idPlantilla)
		{
			
			$this->idPlantilla=$idPlantilla;
		}
		public function setNumeroCelular($numeroCelular)
		{
			$this->numeroCelular=$numeroCelular;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusPendiente()
		{
			$this->estatus='Pendiente';
		}
		public function setEstatusConfirmada()
		{
			$this->estatus='Confirmada';
		}
		public function setEstatusCancelada()
		{
			$this->estatus='Cancelada';
		}
		public function setEstatusError()
		{
			$this->estatus='Error';
		}
		public function setEstatusNoAplica()
		{
			$this->estatus='NoAplica';
		}
		public function setFechaEnvio($fechaEnvio)
		{
			$this->fechaEnvio=$fechaEnvio;
		}
		public function setFechaRespuesta($fechaRespuesta)
		{
			$this->fechaRespuesta=$fechaRespuesta;
		}
		public function setErrorMeta($errorMeta)
		{
			$this->errorMeta=$errorMeta;
		}
		public function setIdUsuario($idUsuario)
		{
			
			$this->idUsuario=$idUsuario;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdControl()
		{
			return $this->idControl;
		}
		public function getIdCita()
		{
			return $this->idCita;
		}
		public function getIdPlantilla()
		{
			return $this->idPlantilla;
		}
		public function getNumeroCelular()
		{
			return $this->numeroCelular;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getFechaEnvio()
		{
			return $this->fechaEnvio;
		}
		public function getFechaRespuesta()
		{
			return $this->fechaRespuesta;
		}
		public function getErrorMeta()
		{
			return $this->errorMeta;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idControl=0;
			$this->idCita=0;
			$this->idPlantilla=0;
			$this->numeroCelular='';
			$this->estatus='Pendiente';
			$this->fechaEnvio='';
			$this->fechaRespuesta='';
			$this->errorMeta='';
			$this->idUsuario=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO cita_control_whatsapp(idCita,idPlantilla,numeroCelular,estatus,fechaEnvio,fechaRespuesta,errorMeta,idUsuario)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idCita) . "','" . mysqli_real_escape_string($this->dbLink,$this->idPlantilla) . "','" . mysqli_real_escape_string($this->dbLink,$this->numeroCelular) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaEnvio) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaRespuesta) . "','" . mysqli_real_escape_string($this->dbLink,$this->errorMeta) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseCita_control_whatsapp::Insertar]");
				
				$this->idControl=mysqli_insert_id($this->dbLink);
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		protected function Actualizar()
		{
			try
			{
				$SQL="UPDATE cita_control_whatsapp SET idCita='" . mysqli_real_escape_string($this->dbLink,$this->idCita) . "',idPlantilla='" . mysqli_real_escape_string($this->dbLink,$this->idPlantilla) . "',numeroCelular='" . mysqli_real_escape_string($this->dbLink,$this->numeroCelular) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',fechaEnvio='" . mysqli_real_escape_string($this->dbLink,$this->fechaEnvio) . "',fechaRespuesta='" . mysqli_real_escape_string($this->dbLink,$this->fechaRespuesta) . "',errorMeta='" . mysqli_real_escape_string($this->dbLink,$this->errorMeta) . "',idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "'
					WHERE idControl=" . $this->idControl;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseCita_control_whatsapp::Update]");
				
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		public function Borrar()
		{
			if($this->getError())
				return false;
			try
			{
				$SQL="DELETE FROM cita_control_whatsapp
				WHERE idControl=" . mysqli_real_escape_string($this->dbLink,$this->idControl);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseCita_control_whatsapp::Borrar]");
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		public function getDatos()
		{
			try
			{
				$SQL="SELECT
						idControl,idCita,idPlantilla,numeroCelular,estatus,fechaEnvio,fechaRespuesta,errorMeta,idUsuario
					FROM cita_control_whatsapp
					WHERE idControl=" . mysqli_real_escape_string($this->dbLink,$this->idControl);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseCita_control_whatsapp::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

				if(mysqli_num_rows($result)==0)
				{
					$this->limpiarPropiedades();
				}
				else
				{
					$datos=mysqli_fetch_assoc($result);
					foreach($datos as $k=>$v)
					{
						$campo="" . $k;
						$this->$campo=$v;
					}
				}
				return true;
			}
			catch (Exception $e)
			{
				return $this->setErrorCatch($e);
			}
		}
		

		
		public function Guardar()
		{
			if(!$this->validarDatos())
				return false;
			if($this->getError())
				return false;
			if($this->idControl==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>