<?php

	class ModeloBaseServicio extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseServicio";

		
		var $idServicio=0;
		var $nombre='';
		var $idConsulta=0;

		var $__s=array("idServicio","nombre","idConsulta");
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

		
		public function setIdServicio($idServicio)
		{
			if($idServicio==0||$idServicio==""||!is_numeric($idServicio)|| (is_string($idServicio)&&!ctype_digit($idServicio)))return $this->setError("Tipo de dato incorrecto para idServicio.");
			$this->idServicio=$idServicio;
			$this->getDatos();
		}
		public function setNombre($nombre)
		{
			
			$this->nombre=$nombre;
		}
		public function setIdConsulta($idConsulta)
		{
			
			$this->idConsulta=$idConsulta;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdServicio()
		{
			return $this->idServicio;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getIdConsulta()
		{
			return $this->idConsulta;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idServicio=0;
			$this->nombre='';
			$this->idConsulta=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO servicio(nombre,idConsulta)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "','" . mysqli_real_escape_string($this->dbLink,$this->idConsulta) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseServicio::Insertar]");
				
				$this->idServicio=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE servicio SET nombre='" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "',idConsulta='" . mysqli_real_escape_string($this->dbLink,$this->idConsulta) . "'
					WHERE idServicio=" . $this->idServicio;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseServicio::Update]");
				
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
				$SQL="DELETE FROM servicio
				WHERE idServicio=" . mysqli_real_escape_string($this->dbLink,$this->idServicio);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseServicio::Borrar]");
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
						idServicio,nombre,idConsulta
					FROM servicio
					WHERE idServicio=" . mysqli_real_escape_string($this->dbLink,$this->idServicio);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseServicio::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idServicio==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>