<?php

	class ModeloBasePrueba extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBasePrueba";

		
		var $id=0;
		var $tel='';
		var $texto='';
		var $idcita='';

		var $__s=array("id","tel","texto","idcita");
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

		
		public function setId($id)
		{
			if($id==0||$id==""||!is_numeric($id)|| (is_string($id)&&!ctype_digit($id)))return $this->setError("Tipo de dato incorrecto para id.");
			$this->id=$id;
			$this->getDatos();
		}
		public function setTel($tel)
		{
			
			$this->tel=$tel;
		}
		public function setTexto($texto)
		{
			
			$this->texto=$texto;
		}
		public function setIdcita($idcita)
		{
			
			$this->idcita=$idcita;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getId()
		{
			return $this->id;
		}
		public function getTel()
		{
			return $this->tel;
		}
		public function getTexto()
		{
			return $this->texto;
		}
		public function getIdcita()
		{
			return $this->idcita;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->id=0;
			$this->tel='';
			$this->texto='';
			$this->idcita='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO prueba(tel,texto,idcita)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->tel) . "','" . mysqli_real_escape_string($this->dbLink,$this->texto) . "','" . mysqli_real_escape_string($this->dbLink,$this->idcita) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBasePrueba::Insertar]");
				
				$this->id=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE prueba SET tel='" . mysqli_real_escape_string($this->dbLink,$this->tel) . "',texto='" . mysqli_real_escape_string($this->dbLink,$this->texto) . "',idcita='" . mysqli_real_escape_string($this->dbLink,$this->idcita) . "'
					WHERE id=" . $this->id;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePrueba::Update]");
				
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
				$SQL="DELETE FROM prueba
				WHERE id=" . mysqli_real_escape_string($this->dbLink,$this->id);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePrueba::Borrar]");
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
						id,tel,texto,idcita
					FROM prueba
					WHERE id=" . mysqli_real_escape_string($this->dbLink,$this->id);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBasePrueba::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->id==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>