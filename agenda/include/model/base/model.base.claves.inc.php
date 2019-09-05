<?php

	class ModeloBaseClaves extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseClaves";

		
		var $idClave=0;
		var $referencia='';
		var $clave='';

		var $__s=array("idClave","referencia","clave");
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

		
		public function setIdClave($idClave)
		{
			if($idClave==0||$idClave==""||!is_numeric($idClave)|| (is_string($idClave)&&!ctype_digit($idClave)))return $this->setError("Tipo de dato incorrecto para idClave.");
			$this->idClave=$idClave;
			$this->getDatos();
		}
		public function setReferencia($referencia)
		{
			
			$this->referencia=$referencia;
		}
		public function setClave($clave)
		{
			
			$this->clave=$clave;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdClave()
		{
			return $this->idClave;
		}
		public function getReferencia()
		{
			return $this->referencia;
		}
		public function getClave()
		{
			return $this->clave;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idClave=0;
			$this->referencia='';
			$this->clave='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO claves(referencia,clave)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->referencia) . "','" . mysqli_real_escape_string($this->dbLink,$this->clave) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseClaves::Insertar]");
				
				$this->idClave=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE claves SET referencia='" . mysqli_real_escape_string($this->dbLink,$this->referencia) . "',clave='" . mysqli_real_escape_string($this->dbLink,$this->clave) . "'
					WHERE idClave=" . $this->idClave;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseClaves::Update]");
				
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
				$SQL="DELETE FROM claves
				WHERE idClave=" . mysqli_real_escape_string($this->dbLink,$this->idClave);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseClaves::Borrar]");
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
						idClave,referencia,clave
					FROM claves
					WHERE idClave=" . mysqli_real_escape_string($this->dbLink,$this->idClave);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseClaves::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idClave==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>