<?php

	class ModeloBaseEncuesta extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseEncuesta";

		
		var $idEncuesta=0;
		var $idSucursal=0;
		var $idTipoConsulta=0;
		var $idPaciente=0;
		var $idPersonal=0;
		var $evaluacion='';
		var $idPersonalRecepcion=0;
		var $evaluacionRecepcion=0;
		var $opinion='';
		var $estatus='';
		var $idCita=0;
		var $idUsuarioRegistro=0;
		var $fechaRegistro='';

		var $__s=array("idEncuesta","idSucursal","idTipoConsulta","idPaciente","idPersonal","evaluacion","idPersonalRecepcion","evaluacionRecepcion","opinion","estatus","idCita","idUsuarioRegistro","fechaRegistro");
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

		
		public function setIdEncuesta($idEncuesta)
		{
			if($idEncuesta==0||$idEncuesta==""||!is_numeric($idEncuesta)|| (is_string($idEncuesta)&&!ctype_digit($idEncuesta)))return $this->setError("Tipo de dato incorrecto para idEncuesta.");
			$this->idEncuesta=$idEncuesta;
			$this->getDatos();
		}
		public function setIdSucursal($idSucursal)
		{
			
			$this->idSucursal=$idSucursal;
		}
		public function setIdTipoConsulta($idTipoConsulta)
		{
			
			$this->idTipoConsulta=$idTipoConsulta;
		}
		public function setIdPaciente($idPaciente)
		{
			
			$this->idPaciente=$idPaciente;
		}
		public function setIdPersonal($idPersonal)
		{
			
			$this->idPersonal=$idPersonal;
		}
		public function setEvaluacion($evaluacion)
		{
			$this->evaluacion=$evaluacion;
		}
		public function setIdPersonalRecepcion($idPersonalRecepcion)
		{
			
			$this->idPersonalRecepcion=$idPersonalRecepcion;
		}
		public function setEvaluacionRecepcion($evaluacionRecepcion)
		{
			
			$this->evaluacionRecepcion=$evaluacionRecepcion;
		}
		public function setOpinion($opinion)
		{
			$this->opinion=$opinion;
		}
		public function setEstatus()
		{
			$this->estatus=1;
		}
		public function setIdCita($idCita)
		{
			
			$this->idCita=$idCita;
		}
		public function setIdUsuarioRegistro($idUsuarioRegistro)
		{
			
			$this->idUsuarioRegistro=$idUsuarioRegistro;
		}
		public function setFechaRegistro($fechaRegistro)
		{
			$this->fechaRegistro=$fechaRegistro;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function unsetEstatus()
		{
			$this->estatus=0;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdEncuesta()
		{
			return $this->idEncuesta;
		}
		public function getIdSucursal()
		{
			return $this->idSucursal;
		}
		public function getIdTipoConsulta()
		{
			return $this->idTipoConsulta;
		}
		public function getIdPaciente()
		{
			return $this->idPaciente;
		}
		public function getIdPersonal()
		{
			return $this->idPersonal;
		}
		public function getEvaluacion()
		{
			return $this->evaluacion;
		}
		public function getIdPersonalRecepcion()
		{
			return $this->idPersonalRecepcion;
		}
		public function getEvaluacionRecepcion()
		{
			return $this->evaluacionRecepcion;
		}
		public function getOpinion()
		{
			return $this->opinion;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getIdCita()
		{
			return $this->idCita;
		}
		public function getIdUsuarioRegistro()
		{
			return $this->idUsuarioRegistro;
		}
		public function getFechaRegistro()
		{
			return $this->fechaRegistro;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idEncuesta=0;
			$this->idSucursal=0;
			$this->idTipoConsulta=0;
			$this->idPaciente=0;
			$this->idPersonal=0;
			$this->evaluacion='';
			$this->idPersonalRecepcion=0;
			$this->evaluacionRecepcion=0;
			$this->opinion='';
			$this->estatus='';
			$this->idCita=0;
			$this->idUsuarioRegistro=0;
			$this->fechaRegistro='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO encuesta(idSucursal,idTipoConsulta,idPaciente,idPersonal,evaluacion,idPersonalRecepcion,evaluacionRecepcion,opinion,estatus,idCita,idUsuarioRegistro,fechaRegistro)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "','" . mysqli_real_escape_string($this->dbLink,$this->idTipoConsulta) . "','" . mysqli_real_escape_string($this->dbLink,$this->idPaciente) . "','" . mysqli_real_escape_string($this->dbLink,$this->idPersonal) . "','" . mysqli_real_escape_string($this->dbLink,$this->evaluacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->idPersonalRecepcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->evaluacionRecepcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->opinion) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->idCita) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioRegistro) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseEncuesta::Insertar]");
				
				$this->idEncuesta=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE encuesta SET idSucursal='" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "',idTipoConsulta='" . mysqli_real_escape_string($this->dbLink,$this->idTipoConsulta) . "',idPaciente='" . mysqli_real_escape_string($this->dbLink,$this->idPaciente) . "',idPersonal='" . mysqli_real_escape_string($this->dbLink,$this->idPersonal) . "',evaluacion='" . mysqli_real_escape_string($this->dbLink,$this->evaluacion) . "',idPersonalRecepcion='" . mysqli_real_escape_string($this->dbLink,$this->idPersonalRecepcion) . "',evaluacionRecepcion='" . mysqli_real_escape_string($this->dbLink,$this->evaluacionRecepcion) . "',opinion='" . mysqli_real_escape_string($this->dbLink,$this->opinion) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',idCita='" . mysqli_real_escape_string($this->dbLink,$this->idCita) . "',idUsuarioRegistro='" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioRegistro) . "',fechaRegistro='" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "'
					WHERE idEncuesta=" . $this->idEncuesta;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseEncuesta::Update]");
				
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
				$SQL="DELETE FROM encuesta
				WHERE idEncuesta=" . mysqli_real_escape_string($this->dbLink,$this->idEncuesta);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseEncuesta::Borrar]");
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
						idEncuesta,idSucursal,idTipoConsulta,idPaciente,idPersonal,evaluacion,idPersonalRecepcion,evaluacionRecepcion,opinion,estatus,idCita,idUsuarioRegistro,fechaRegistro
					FROM encuesta
					WHERE idEncuesta=" . mysqli_real_escape_string($this->dbLink,$this->idEncuesta);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseEncuesta::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idEncuesta==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>