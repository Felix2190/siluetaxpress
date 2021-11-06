<?php

	class ModeloBaseUsuario extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseUsuario";

		
		var $idUsuario=0;
		var $nombre='';
		var $apellidos='';
		var $correo='';
		var $telefonoCel='';
		var $idSucursal=0;
		var $idTipoUsuario=0;
		var $foto='';

		var $__s=array("idUsuario","nombre","apellidos","correo","telefonoCel","idSucursal","idTipoUsuario","foto");
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

		
		public function setIdUsuario($idUsuario)
		{
			if($idUsuario==0||$idUsuario==""||!is_numeric($idUsuario)|| (is_string($idUsuario)&&!ctype_digit($idUsuario)))return $this->setError("Tipo de dato incorrecto para idUsuario.");
			$this->idUsuario=$idUsuario;
			$this->getDatos();
		}
		public function setNombre($nombre)
		{
			
			$this->nombre=$nombre;
		}
		public function setApellidos($apellidos)
		{
			
			$this->apellidos=$apellidos;
		}
		public function setCorreo($correo)
		{
			
			$this->correo=$correo;
		}
		public function setTelefonoCel($telefonoCel)
		{
			
			$this->telefonoCel=$telefonoCel;
		}
		public function setIdSucursal($idSucursal)
		{
			
			$this->idSucursal=$idSucursal;
		}
		public function setIdTipoUsuario($idTipoUsuario)
		{
			
			$this->idTipoUsuario=$idTipoUsuario;
		}
		public function setFoto($foto)
		{
			$this->foto=$foto;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getApellidos()
		{
			return $this->apellidos;
		}
		public function getCorreo()
		{
			return $this->correo;
		}
		public function getTelefonoCel()
		{
			return $this->telefonoCel;
		}
		public function getIdSucursal()
		{
			return $this->idSucursal;
		}
		public function getIdTipoUsuario()
		{
			return $this->idTipoUsuario;
		}
		public function getFoto()
		{
			return $this->foto;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idUsuario=0;
			$this->nombre='';
			$this->apellidos='';
			$this->correo='';
			$this->telefonoCel='';
			$this->idSucursal=0;
			$this->idTipoUsuario=0;
			$this->foto='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO usuario(nombre,apellidos,correo,telefonoCel,idSucursal,idTipoUsuario,foto)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "','" . mysqli_real_escape_string($this->dbLink,$this->apellidos) . "','" . mysqli_real_escape_string($this->dbLink,$this->correo) . "','" . mysqli_real_escape_string($this->dbLink,$this->telefonoCel) . "','" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "','" . mysqli_real_escape_string($this->dbLink,$this->idTipoUsuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->foto) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseUsuario::Insertar]");
				
				$this->idUsuario=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE usuario SET nombre='" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "',apellidos='" . mysqli_real_escape_string($this->dbLink,$this->apellidos) . "',correo='" . mysqli_real_escape_string($this->dbLink,$this->correo) . "',telefonoCel='" . mysqli_real_escape_string($this->dbLink,$this->telefonoCel) . "',idSucursal='" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "',idTipoUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idTipoUsuario) . "',foto='" . mysqli_real_escape_string($this->dbLink,$this->foto) . "'
					WHERE idUsuario=" . $this->idUsuario;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseUsuario::Update]");
				
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
				$SQL="DELETE FROM usuario
				WHERE idUsuario=" . mysqli_real_escape_string($this->dbLink,$this->idUsuario);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseUsuario::Borrar]");
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
						idUsuario,nombre,apellidos,correo,telefonoCel,idSucursal,idTipoUsuario,foto
					FROM usuario
					WHERE idUsuario=" . mysqli_real_escape_string($this->dbLink,$this->idUsuario);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseUsuario::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idUsuario==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>