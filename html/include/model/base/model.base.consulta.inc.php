<?php

	class ModeloBaseConsulta extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseConsulta";

		
		var $idConsulta=0;
		var $tipoConsulta='';
		var $descripcion='';

		var $__s=array("idConsulta","tipoConsulta","descripcion");
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

		
		public function setIdConsulta($idConsulta)
		{
			if($idConsulta==0||$idConsulta==""||!is_numeric($idConsulta)|| (is_string($idConsulta)&&!ctype_digit($idConsulta)))return $this->setError("Tipo de dato incorrecto para idConsulta.");
			$this->idConsulta=$idConsulta;
			$this->getDatos();
		}
		public function setTipoConsulta($tipoConsulta)
		{
			
			$this->tipoConsulta=$tipoConsulta;
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

		
		public function getIdConsulta()
		{
			return $this->idConsulta;
		}
		public function getTipoConsulta()
		{
			return $this->tipoConsulta;
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
			
			$this->idConsulta=0;
			$this->tipoConsulta='';
			$this->descripcion='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO consulta(tipoConsulta,descripcion)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->tipoConsulta) . "','" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseConsulta::Insertar]");
				
				$this->idConsulta=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE consulta SET tipoConsulta='" . mysqli_real_escape_string($this->dbLink,$this->tipoConsulta) . "',descripcion='" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "'
					WHERE idConsulta=" . $this->idConsulta;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseConsulta::Update]");
				
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
				$SQL="DELETE FROM consulta
				WHERE idConsulta=" . mysqli_real_escape_string($this->dbLink,$this->idConsulta);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseConsulta::Borrar]");
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
						idConsulta,tipoConsulta,descripcion
					FROM consulta
					WHERE idConsulta=" . mysqli_real_escape_string($this->dbLink,$this->idConsulta);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseConsulta::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idConsulta==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>