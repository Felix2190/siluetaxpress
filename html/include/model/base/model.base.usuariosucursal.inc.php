<?php

	class ModeloBaseUsuariosucursal extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseUsuariosucursal";

		
		var $idUS=0;
		var $idUsuario=0;
		var $idSucursal=0;
		var $fechaAlta='';
		var $estatus='activo';

		var $__s=array("idUS","idUsuario","idSucursal","fechaAlta","estatus");
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

		
		public function setIdUS($idUS)
		{
			if($idUS==0||$idUS==""||!is_numeric($idUS)|| (is_string($idUS)&&!ctype_digit($idUS)))return $this->setError("Tipo de dato incorrecto para idUS.");
			$this->idUS=$idUS;
			$this->getDatos();
		}
		public function setIdUsuario($idUsuario)
		{
			
			$this->idUsuario=$idUsuario;
		}
		public function setIdSucursal($idSucursal)
		{
			
			$this->idSucursal=$idSucursal;
		}
		public function setFechaAlta($fechaAlta)
		{
			$this->fechaAlta=$fechaAlta;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusActivo()
		{
			$this->estatus='activo';
		}
		public function setEstatusInactivo()
		{
			$this->estatus='inactivo';
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdUS()
		{
			return $this->idUS;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getIdSucursal()
		{
			return $this->idSucursal;
		}
		public function getFechaAlta()
		{
			return $this->fechaAlta;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idUS=0;
			$this->idUsuario=0;
			$this->idSucursal=0;
			$this->fechaAlta='';
			$this->estatus='activo';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO usuariosucursal(idUsuario,idSucursal,fechaAlta,estatus)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaAlta) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseUsuariosucursal::Insertar]");
				
				$this->idUS=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE usuariosucursal SET idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "',idSucursal='" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "',fechaAlta='" . mysqli_real_escape_string($this->dbLink,$this->fechaAlta) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "'
					WHERE idUS=" . $this->idUS;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseUsuariosucursal::Update]");
				
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
				$SQL="DELETE FROM usuariosucursal
				WHERE idUS=" . mysqli_real_escape_string($this->dbLink,$this->idUS);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseUsuariosucursal::Borrar]");
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
						idUS,idUsuario,idSucursal,fechaAlta,estatus
					FROM usuariosucursal
					WHERE idUS=" . mysqli_real_escape_string($this->dbLink,$this->idUS);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseUsuariosucursal::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idUS==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>