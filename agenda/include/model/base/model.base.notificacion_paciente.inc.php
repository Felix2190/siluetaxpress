<?php

	class ModeloBaseNotificacion_paciente extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseNotificacion_paciente";

		
		var $idNotificacionPaciente=0;
		var $idNotificacion=0;
		var $idPaciente=0;
		var $estatus='';
		var $fechaEnvio='';
		var $msjError='';

		var $__s=array("idNotificacionPaciente","idNotificacion","idPaciente","estatus","fechaEnvio","msjError");
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

		
		public function setIdNotificacionPaciente($idNotificacionPaciente)
		{
			if($idNotificacionPaciente==0||$idNotificacionPaciente==""||!is_numeric($idNotificacionPaciente)|| (is_string($idNotificacionPaciente)&&!ctype_digit($idNotificacionPaciente)))return $this->setError("Tipo de dato incorrecto para idNotificacionPaciente.");
			$this->idNotificacionPaciente=$idNotificacionPaciente;
			$this->getDatos();
		}
		public function setIdNotificacion($idNotificacion)
		{
			
			$this->idNotificacion=$idNotificacion;
		}
		public function setIdPaciente($idPaciente)
		{
			
			$this->idPaciente=$idPaciente;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusEspera()
		{
			$this->estatus='espera';
		}
		public function setEstatusEnviado()
		{
			$this->estatus='enviado';
		}
		public function setEstatusError()
		{
			$this->estatus='error';
		}
		public function setEstatusCancelado()
		{
			$this->estatus='cancelado';
		}
		public function setFechaEnvio($fechaEnvio)
		{
			$this->fechaEnvio=$fechaEnvio;
		}
		public function setMsjError($msjError)
		{
			$this->msjError=$msjError;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdNotificacionPaciente()
		{
			return $this->idNotificacionPaciente;
		}
		public function getIdNotificacion()
		{
			return $this->idNotificacion;
		}
		public function getIdPaciente()
		{
			return $this->idPaciente;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getFechaEnvio()
		{
			return $this->fechaEnvio;
		}
		public function getMsjError()
		{
			return $this->msjError;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idNotificacionPaciente=0;
			$this->idNotificacion=0;
			$this->idPaciente=0;
			$this->estatus='';
			$this->fechaEnvio='';
			$this->msjError='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO notificacion_paciente(idNotificacion,idPaciente,estatus,fechaEnvio,msjError)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idNotificacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->idPaciente) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaEnvio) . "','" . mysqli_real_escape_string($this->dbLink,$this->msjError) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseNotificacion_paciente::Insertar]");
				
				$this->idNotificacionPaciente=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE notificacion_paciente SET idNotificacion='" . mysqli_real_escape_string($this->dbLink,$this->idNotificacion) . "',idPaciente='" . mysqli_real_escape_string($this->dbLink,$this->idPaciente) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',fechaEnvio='" . mysqli_real_escape_string($this->dbLink,$this->fechaEnvio) . "',msjError='" . mysqli_real_escape_string($this->dbLink,$this->msjError) . "'
					WHERE idNotificacionPaciente=" . $this->idNotificacionPaciente;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseNotificacion_paciente::Update]");
				
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
				$SQL="DELETE FROM notificacion_paciente
				WHERE idNotificacionPaciente=" . mysqli_real_escape_string($this->dbLink,$this->idNotificacionPaciente);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseNotificacion_paciente::Borrar]");
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
						idNotificacionPaciente,idNotificacion,idPaciente,estatus,fechaEnvio,msjError
					FROM notificacion_paciente
					WHERE idNotificacionPaciente=" . mysqli_real_escape_string($this->dbLink,$this->idNotificacionPaciente);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseNotificacion_paciente::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idNotificacionPaciente==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>