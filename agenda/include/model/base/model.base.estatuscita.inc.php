<?php

	class ModeloBaseEstatuscita extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseEstatuscita";

		
		var $estatusCita='';
		var $descripcion='';

		var $__s=array("estatusCita","descripcion");
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

		
		public function setEstatusCita($estatusCita)
		{
			if(trim($estatusCita)=="")return $this->setError("El valor estatusCita no puede ser vacio.");
			$this->estatusCita=$estatusCita;
			$this->getDatos();
		}
		public function setDescripcion($descripcion)
		{
			
			$this->descripcion=$descripcion;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getEstatusCita()
		{
			return $this->estatusCita;
		}
		public function getDescripcion()
		{
			return $this->descripcion;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->estatusCita='';
			$this->descripcion='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO estatuscita(descripcion)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseEstatuscita::Insertar]");
				
				$this->estatusCita=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE estatuscita SET descripcion='" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "'
					WHERE estatusCita=" . $this->estatusCita;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseEstatuscita::Update]");
				
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
				$SQL="DELETE FROM estatuscita
				WHERE estatusCita=" . mysqli_real_escape_string($this->dbLink,$this->estatusCita);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseEstatuscita::Borrar]");
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
						estatusCita,descripcion
					FROM estatuscita
					WHERE estatusCita=" . mysqli_real_escape_string($this->dbLink,$this->estatusCita);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseEstatuscita::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->estatusCita==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>