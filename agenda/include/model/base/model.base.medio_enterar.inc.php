<?php

	class ModeloBaseMedio_enterar extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseMedio_enterar";

		
		var $idMedio=0;
		var $medio='';
		var $principal='0';

		var $__s=array("idMedio","medio","principal");
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

		
		public function setIdMedio($idMedio)
		{
			if($idMedio==0||$idMedio==""||!is_numeric($idMedio)|| (is_string($idMedio)&&!ctype_digit($idMedio)))return $this->setError("Tipo de dato incorrecto para idMedio.");
			$this->idMedio=$idMedio;
			$this->getDatos();
		}
		public function setMedio($medio)
		{
			
			$this->medio=$medio;
		}
		public function setPrincipal()
		{
			$this->principal=1;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function unsetPrincipal()
		{
			$this->principal=0;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdMedio()
		{
			return $this->idMedio;
		}
		public function getMedio()
		{
			return $this->medio;
		}
		public function getPrincipal()
		{
			return $this->principal;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idMedio=0;
			$this->medio='';
			$this->principal='0';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO medio_enterar(medio,principal)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->medio) . "','" . mysqli_real_escape_string($this->dbLink,$this->principal) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseMedio_enterar::Insertar]");
				
				$this->idMedio=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE medio_enterar SET medio='" . mysqli_real_escape_string($this->dbLink,$this->medio) . "',principal='" . mysqli_real_escape_string($this->dbLink,$this->principal) . "'
					WHERE idMedio=" . $this->idMedio;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseMedio_enterar::Update]");
				
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
				$SQL="DELETE FROM medio_enterar
				WHERE idMedio=" . mysqli_real_escape_string($this->dbLink,$this->idMedio);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseMedio_enterar::Borrar]");
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
						idMedio,medio,principal
					FROM medio_enterar
					WHERE idMedio=" . mysqli_real_escape_string($this->dbLink,$this->idMedio);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseMedio_enterar::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idMedio==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>