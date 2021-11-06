<?php

	class ModeloBaseTipousuario extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseTipousuario";

		
		var $idTipoUsuario=0;
		var $nombre='';
		var $descripcion='';
		var $abrev='';

		var $__s=array("idTipoUsuario","nombre","descripcion","abrev");
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

		
		public function setIdTipoUsuario($idTipoUsuario)
		{
			if($idTipoUsuario==0||$idTipoUsuario==""||!is_numeric($idTipoUsuario)|| (is_string($idTipoUsuario)&&!ctype_digit($idTipoUsuario)))return $this->setError("Tipo de dato incorrecto para idTipoUsuario.");
			$this->idTipoUsuario=$idTipoUsuario;
			$this->getDatos();
		}
		public function setNombre($nombre)
		{
			
			$this->nombre=$nombre;
		}
		public function setDescripcion($descripcion)
		{
			$this->descripcion=$descripcion;
		}
		public function setAbrev($abrev)
		{
			
			$this->abrev=$abrev;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdTipoUsuario()
		{
			return $this->idTipoUsuario;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getDescripcion()
		{
			return $this->descripcion;
		}
		public function getAbrev()
		{
			return $this->abrev;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idTipoUsuario=0;
			$this->nombre='';
			$this->descripcion='';
			$this->abrev='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO tipousuario(nombre,descripcion,abrev)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "','" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->abrev) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseTipousuario::Insertar]");
				
				$this->idTipoUsuario=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE tipousuario SET nombre='" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "',descripcion='" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "',abrev='" . mysqli_real_escape_string($this->dbLink,$this->abrev) . "'
					WHERE idTipoUsuario=" . $this->idTipoUsuario;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseTipousuario::Update]");
				
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
				$SQL="DELETE FROM tipousuario
				WHERE idTipoUsuario=" . mysqli_real_escape_string($this->dbLink,$this->idTipoUsuario);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseTipousuario::Borrar]");
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
						idTipoUsuario,nombre,descripcion,abrev
					FROM tipousuario
					WHERE idTipoUsuario=" . mysqli_real_escape_string($this->dbLink,$this->idTipoUsuario);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseTipousuario::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idTipoUsuario==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>