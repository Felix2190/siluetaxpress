<?php

	class ModeloBaseCitaactualizacion extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseCitaactualizacion";

		
		var $idActualizacion=0;
		var $idCita=0;
		var $idUsuario=0;
		var $fecha='';
		var $tipo='Actualizacion';
		var $idCabina=0;
		var $fechaCita='';
		var $hora='';
		var $duracion=0;
		var $sms='0';

		var $__s=array("idActualizacion","idCita","idUsuario","fecha","tipo","idCabina","fechaCita","hora","duracion","sms");
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

		
		public function setIdActualizacion($idActualizacion)
		{
			if($idActualizacion==0||$idActualizacion==""||!is_numeric($idActualizacion)|| (is_string($idActualizacion)&&!ctype_digit($idActualizacion)))return $this->setError("Tipo de dato incorrecto para idActualizacion.");
			$this->idActualizacion=$idActualizacion;
			$this->getDatos();
		}
		public function setIdCita($idCita)
		{
			
			$this->idCita=$idCita;
		}
		public function setIdUsuario($idUsuario)
		{
			
			$this->idUsuario=$idUsuario;
		}
		public function setFecha($fecha)
		{
			$this->fecha=$fecha;
		}
		public function setTipo($tipo)
		{
			
			$this->tipo=$tipo;
		}
		public function setTipoCreacion()
		{
			$this->tipo='Creacion';
		}
		public function setTipoActualizacion()
		{
			$this->tipo='Actualizacion';
		}
		public function setIdCabina($idCabina)
		{
			
			$this->idCabina=$idCabina;
		}
		public function setFechaCita($fechaCita)
		{
			$this->fechaCita=$fechaCita;
		}
		public function setHora($hora)
		{
			
			$this->hora=$hora;
		}
		public function setDuracion($duracion)
		{
			
			$this->duracion=$duracion;
		}
		public function setSms()
		{
			$this->sms=1;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function unsetSms()
		{
			$this->sms=0;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdActualizacion()
		{
			return $this->idActualizacion;
		}
		public function getIdCita()
		{
			return $this->idCita;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getFecha()
		{
			return $this->fecha;
		}
		public function getTipo()
		{
			return $this->tipo;
		}
		public function getIdCabina()
		{
			return $this->idCabina;
		}
		public function getFechaCita()
		{
			return $this->fechaCita;
		}
		public function getHora()
		{
			return $this->hora;
		}
		public function getDuracion()
		{
			return $this->duracion;
		}
		public function getSms()
		{
			return $this->sms;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idActualizacion=0;
			$this->idCita=0;
			$this->idUsuario=0;
			$this->fecha='';
			$this->tipo='Actualizacion';
			$this->idCabina=0;
			$this->fechaCita='';
			$this->hora='';
			$this->duracion=0;
			$this->sms='0';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO citaactualizacion(idCita,idUsuario,fecha,tipo,idCabina,fechaCita,hora,duracion,sms)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idCita) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "','" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "','" . mysqli_real_escape_string($this->dbLink,$this->idCabina) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaCita) . "','" . mysqli_real_escape_string($this->dbLink,$this->hora) . "','" . mysqli_real_escape_string($this->dbLink,$this->duracion) . "','" . mysqli_real_escape_string($this->dbLink,$this->sms) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseCitaactualizacion::Insertar]");
				
				$this->idActualizacion=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE citaactualizacion SET idCita='" . mysqli_real_escape_string($this->dbLink,$this->idCita) . "',idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "',fecha='" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "',tipo='" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "',idCabina='" . mysqli_real_escape_string($this->dbLink,$this->idCabina) . "',fechaCita='" . mysqli_real_escape_string($this->dbLink,$this->fechaCita) . "',hora='" . mysqli_real_escape_string($this->dbLink,$this->hora) . "',duracion='" . mysqli_real_escape_string($this->dbLink,$this->duracion) . "',sms='" . mysqli_real_escape_string($this->dbLink,$this->sms) . "'
					WHERE idActualizacion=" . $this->idActualizacion;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseCitaactualizacion::Update]");
				
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
				$SQL="DELETE FROM citaactualizacion
				WHERE idActualizacion=" . mysqli_real_escape_string($this->dbLink,$this->idActualizacion);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseCitaactualizacion::Borrar]");
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
						idActualizacion,idCita,idUsuario,fecha,tipo,idCabina,fechaCita,hora,duracion,sms
					FROM citaactualizacion
					WHERE idActualizacion=" . mysqli_real_escape_string($this->dbLink,$this->idActualizacion);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseCitaactualizacion::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idActualizacion==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>