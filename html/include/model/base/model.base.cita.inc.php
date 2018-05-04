<?php

	class ModeloBaseCita extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseCita";

		
		var $idCita=0;
		var $idPaciente=0;
		var $telefonoPaciente='';
		var $idUsuario=0;
		var $idSucursal=0;
		var $fechaInicio='';
		var $fechaFin='';
		var $idConsulta=0;
		var $estatus='';
		var $recordatorio1='0';
		var $recordatorio2='0';

		var $__s=array("idCita","idPaciente","telefonoPaciente","idUsuario","idSucursal","fechaInicio","fechaFin","idConsulta","estatus","recordatorio1","recordatorio2");
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

		
		public function setIdCita($idCita)
		{
			if($idCita==0||$idCita==""||!is_numeric($idCita)|| (is_string($idCita)&&!ctype_digit($idCita)))return $this->setError("Tipo de dato incorrecto para idCita.");
			$this->idCita=$idCita;
			$this->getDatos();
		}
		public function setIdPaciente($idPaciente)
		{
			
			$this->idPaciente=$idPaciente;
		}
		public function setTelefonoPaciente($telefonoPaciente)
		{
			
			$this->telefonoPaciente=$telefonoPaciente;
		}
		public function setIdUsuario($idUsuario)
		{
			
			$this->idUsuario=$idUsuario;
		}
		public function setIdSucursal($idSucursal)
		{
			
			$this->idSucursal=$idSucursal;
		}
		public function setFechaInicio($fechaInicio)
		{
			$this->fechaInicio=$fechaInicio;
		}
		public function setFechaFin($fechaFin)
		{
			$this->fechaFin=$fechaFin;
		}
		public function setIdConsulta($idConsulta)
		{
			
			$this->idConsulta=$idConsulta;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusNueva()
		{
			$this->estatus='nueva';
		}
		public function setEstatusCancelada()
		{
			$this->estatus='cancelada';
		}
		public function setRecordatorio1()
		{
			$this->recordatorio1=1;
		}
		public function setRecordatorio2()
		{
			$this->recordatorio2=1;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function unsetRecordatorio1()
		{
			$this->recordatorio1=0;
		}
		public function unsetRecordatorio2()
		{
			$this->recordatorio2=0;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdCita()
		{
			return $this->idCita;
		}
		public function getIdPaciente()
		{
			return $this->idPaciente;
		}
		public function getTelefonoPaciente()
		{
			return $this->telefonoPaciente;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getIdSucursal()
		{
			return $this->idSucursal;
		}
		public function getFechaInicio()
		{
			return $this->fechaInicio;
		}
		public function getFechaFin()
		{
			return $this->fechaFin;
		}
		public function getIdConsulta()
		{
			return $this->idConsulta;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getRecordatorio1()
		{
			return $this->recordatorio1;
		}
		public function getRecordatorio2()
		{
			return $this->recordatorio2;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idCita=0;
			$this->idPaciente=0;
			$this->telefonoPaciente='';
			$this->idUsuario=0;
			$this->idSucursal=0;
			$this->fechaInicio='';
			$this->fechaFin='';
			$this->idConsulta=0;
			$this->estatus='';
			$this->recordatorio1='0';
			$this->recordatorio2='0';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO cita(idPaciente,telefonoPaciente,idUsuario,idSucursal,fechaInicio,fechaFin,idConsulta,estatus,recordatorio1,recordatorio2)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idPaciente) . "','" . mysqli_real_escape_string($this->dbLink,$this->telefonoPaciente) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaInicio) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaFin) . "','" . mysqli_real_escape_string($this->dbLink,$this->idConsulta) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->recordatorio1) . "','" . mysqli_real_escape_string($this->dbLink,$this->recordatorio2) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseCita::Insertar]");
				
				$this->idCita=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE cita SET idPaciente='" . mysqli_real_escape_string($this->dbLink,$this->idPaciente) . "',telefonoPaciente='" . mysqli_real_escape_string($this->dbLink,$this->telefonoPaciente) . "',idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "',idSucursal='" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "',fechaInicio='" . mysqli_real_escape_string($this->dbLink,$this->fechaInicio) . "',fechaFin='" . mysqli_real_escape_string($this->dbLink,$this->fechaFin) . "',idConsulta='" . mysqli_real_escape_string($this->dbLink,$this->idConsulta) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',recordatorio1='" . mysqli_real_escape_string($this->dbLink,$this->recordatorio1) . "',recordatorio2='" . mysqli_real_escape_string($this->dbLink,$this->recordatorio2) . "'
					WHERE idCita=" . $this->idCita;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseCita::Update]");
				
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
				$SQL="DELETE FROM cita
				WHERE idCita=" . mysqli_real_escape_string($this->dbLink,$this->idCita);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseCita::Borrar]");
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
						idCita,idPaciente,telefonoPaciente,idUsuario,idSucursal,fechaInicio,fechaFin,idConsulta,estatus,recordatorio1,recordatorio2
					FROM cita
					WHERE idCita=" . mysqli_real_escape_string($this->dbLink,$this->idCita);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseCita::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idCita==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>