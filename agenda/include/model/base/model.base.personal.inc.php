<?php

	class ModeloBasePersonal extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBasePersonal";

		
		var $idPersonal=0;
		var $nombreCompleto='';
		var $idSucursal=0;
		var $tipoConsulta=0;
		var $activo='1';

		var $__s=array("idPersonal","nombreCompleto","idSucursal","tipoConsulta","activo");
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

		
		public function setIdPersonal($idPersonal)
		{
			if($idPersonal==0||$idPersonal==""||!is_numeric($idPersonal)|| (is_string($idPersonal)&&!ctype_digit($idPersonal)))return $this->setError("Tipo de dato incorrecto para idPersonal.");
			$this->idPersonal=$idPersonal;
			$this->getDatos();
		}
		public function setNombreCompleto($nombreCompleto)
		{
			
			$this->nombreCompleto=$nombreCompleto;
		}
		public function setIdSucursal($idSucursal)
		{
			
			$this->idSucursal=$idSucursal;
		}
		public function setTipoConsulta($tipoConsulta)
		{
			
			$this->tipoConsulta=$tipoConsulta;
		}
		public function setActivo()
		{
			$this->activo=1;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function unsetActivo()
		{
			$this->activo=0;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdPersonal()
		{
			return $this->idPersonal;
		}
		public function getNombreCompleto()
		{
			return $this->nombreCompleto;
		}
		public function getIdSucursal()
		{
			return $this->idSucursal;
		}
		public function getTipoConsulta()
		{
			return $this->tipoConsulta;
		}
		public function getActivo()
		{
			return $this->activo;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idPersonal=0;
			$this->nombreCompleto='';
			$this->idSucursal=0;
			$this->tipoConsulta=0;
			$this->activo='1';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO personal(nombreCompleto,idSucursal,tipoConsulta,activo)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->nombreCompleto) . "','" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "','" . mysqli_real_escape_string($this->dbLink,$this->tipoConsulta) . "','" . mysqli_real_escape_string($this->dbLink,$this->activo) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBasePersonal::Insertar]");
				
				$this->idPersonal=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE personal SET nombreCompleto='" . mysqli_real_escape_string($this->dbLink,$this->nombreCompleto) . "',idSucursal='" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "',tipoConsulta='" . mysqli_real_escape_string($this->dbLink,$this->tipoConsulta) . "',activo='" . mysqli_real_escape_string($this->dbLink,$this->activo) . "'
					WHERE idPersonal=" . $this->idPersonal;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePersonal::Update]");
				
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
				$SQL="DELETE FROM personal
				WHERE idPersonal=" . mysqli_real_escape_string($this->dbLink,$this->idPersonal);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePersonal::Borrar]");
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
						idPersonal,nombreCompleto,idSucursal,tipoConsulta,activo
					FROM personal
					WHERE idPersonal=" . mysqli_real_escape_string($this->dbLink,$this->idPersonal);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBasePersonal::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idPersonal==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>