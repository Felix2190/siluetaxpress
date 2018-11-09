<?php

	class ModeloBaseBloqueos extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseBloqueos";

		
		var $idBloqueo=0;
		var $idPaciente=0;
		var $idUsuario=0;
		var $fecha='';
		var $motivo='';
		var $idSucursal=0;

		var $__s=array("idBloqueo","idPaciente","idUsuario","fecha","motivo","idSucursal");
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

		
		public function setIdBloqueo($idBloqueo)
		{
			if($idBloqueo==0||$idBloqueo==""||!is_numeric($idBloqueo)|| (is_string($idBloqueo)&&!ctype_digit($idBloqueo)))return $this->setError("Tipo de dato incorrecto para idBloqueo.");
			$this->idBloqueo=$idBloqueo;
			$this->getDatos();
		}
		public function setIdPaciente($idPaciente)
		{
			
			$this->idPaciente=$idPaciente;
		}
		public function setIdUsuario($idUsuario)
		{
			
			$this->idUsuario=$idUsuario;
		}
		public function setFecha($fecha)
		{
			$this->fecha=$fecha;
		}
		public function setMotivo($motivo)
		{
			$this->motivo=$motivo;
		}
		public function setIdSucursal($idSucursal)
		{
			
			$this->idSucursal=$idSucursal;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdBloqueo()
		{
			return $this->idBloqueo;
		}
		public function getIdPaciente()
		{
			return $this->idPaciente;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getFecha()
		{
			return $this->fecha;
		}
		public function getMotivo()
		{
			return $this->motivo;
		}
		public function getIdSucursal()
		{
			return $this->idSucursal;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idBloqueo=0;
			$this->idPaciente=0;
			$this->idUsuario=0;
			$this->fecha='';
			$this->motivo='';
			$this->idSucursal=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO bloqueos(idPaciente,idUsuario,fecha,motivo,idSucursal)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idPaciente) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "','" . mysqli_real_escape_string($this->dbLink,$this->motivo) . "','" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseBloqueos::Insertar]");
				
				$this->idBloqueo=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE bloqueos SET idPaciente='" . mysqli_real_escape_string($this->dbLink,$this->idPaciente) . "',idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "',fecha='" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "',motivo='" . mysqli_real_escape_string($this->dbLink,$this->motivo) . "',idSucursal='" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "'
					WHERE idBloqueo=" . $this->idBloqueo;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseBloqueos::Update]");
				
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
				$SQL="DELETE FROM bloqueos
				WHERE idBloqueo=" . mysqli_real_escape_string($this->dbLink,$this->idBloqueo);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseBloqueos::Borrar]");
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
						idBloqueo,idPaciente,idUsuario,fecha,motivo,idSucursal
					FROM bloqueos
					WHERE idBloqueo=" . mysqli_real_escape_string($this->dbLink,$this->idBloqueo);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseBloqueos::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idBloqueo==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>