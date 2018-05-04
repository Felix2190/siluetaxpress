<?php

	class ModeloBaseHojaClinica extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseHojaClinica";

		
		var $idHojaClinica=0;
		var $fechaRegistro='';
		var $edad=0;

		var $__s=array("idHojaClinica","fechaRegistro","edad");
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

		
		public function setIdHojaClinica($idHojaClinica)
		{
			if($idHojaClinica==0||$idHojaClinica==""||!is_numeric($idHojaClinica)|| (is_string($idHojaClinica)&&!ctype_digit($idHojaClinica)))return $this->setError("Tipo de dato incorrecto para idHojaClinica.");
			$this->idHojaClinica=$idHojaClinica;
			$this->getDatos();
		}
		public function setFechaRegistro($fechaRegistro)
		{
			$this->fechaRegistro=$fechaRegistro;
		}
		public function setEdad($edad)
		{
			
			$this->edad=$edad;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdHojaClinica()
		{
			return $this->idHojaClinica;
		}
		public function getFechaRegistro()
		{
			return $this->fechaRegistro;
		}
		public function getEdad()
		{
			return $this->edad;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idHojaClinica=0;
			$this->fechaRegistro='';
			$this->edad=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO hojaClinica(fechaRegistro,edad)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "','" . mysqli_real_escape_string($this->dbLink,$this->edad) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseHojaClinica::Insertar]");
				
				$this->idHojaClinica=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE hojaClinica SET fechaRegistro='" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "',edad='" . mysqli_real_escape_string($this->dbLink,$this->edad) . "'
					WHERE idHojaClinica=" . $this->idHojaClinica;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseHojaClinica::Update]");
				
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
				$SQL="DELETE FROM hojaClinica
				WHERE idHojaClinica=" . mysqli_real_escape_string($this->dbLink,$this->idHojaClinica);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseHojaClinica::Borrar]");
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
						idHojaClinica,fechaRegistro,edad
					FROM hojaClinica
					WHERE idHojaClinica=" . mysqli_real_escape_string($this->dbLink,$this->idHojaClinica);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseHojaClinica::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idHojaClinica==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>