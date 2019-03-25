<?php

	class ModeloBasePersona_contacto extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBasePersona_contacto";

		
		var $idContacto=0;
		var $nombre='';
		var $apellidos='';
		var $telefono=0;
		var $correo='';
		var $fecha='';
		var $comentarios='';

		var $__s=array("idContacto","nombre","apellidos","telefono","correo","fecha","comentarios");
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

		
		public function setIdContacto($idContacto)
		{
			if($idContacto==0||$idContacto==""||!is_numeric($idContacto)|| (is_string($idContacto)&&!ctype_digit($idContacto)))return $this->setError("Tipo de dato incorrecto para idContacto.");
			$this->idContacto=$idContacto;
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
		public function setTelefono($telefono)
		{
			
			$this->telefono=$telefono;
		}
		public function setCorreo($correo)
		{
			
			$this->correo=$correo;
		}
		public function setFecha($fecha)
		{
			$this->fecha=$fecha;
		}
		public function setComentarios($comentarios)
		{
			$this->comentarios=$comentarios;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdContacto()
		{
			return $this->idContacto;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getApellidos()
		{
			return $this->apellidos;
		}
		public function getTelefono()
		{
			return $this->telefono;
		}
		public function getCorreo()
		{
			return $this->correo;
		}
		public function getFecha()
		{
			return $this->fecha;
		}
		public function getComentarios()
		{
			return $this->comentarios;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idContacto=0;
			$this->nombre='';
			$this->apellidos='';
			$this->telefono=0;
			$this->correo='';
			$this->fecha='';
			$this->comentarios='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO persona_contacto(nombre,apellidos,telefono,correo,fecha,comentarios)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "','" . mysqli_real_escape_string($this->dbLink,$this->apellidos) . "','" . mysqli_real_escape_string($this->dbLink,$this->telefono) . "','" . mysqli_real_escape_string($this->dbLink,$this->correo) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "','" . mysqli_real_escape_string($this->dbLink,$this->comentarios) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBasePersona_contacto::Insertar]");
				
				$this->idContacto=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE persona_contacto SET nombre='" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "',apellidos='" . mysqli_real_escape_string($this->dbLink,$this->apellidos) . "',telefono='" . mysqli_real_escape_string($this->dbLink,$this->telefono) . "',correo='" . mysqli_real_escape_string($this->dbLink,$this->correo) . "',fecha='" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "',comentarios='" . mysqli_real_escape_string($this->dbLink,$this->comentarios) . "'
					WHERE idContacto=" . $this->idContacto;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePersona_contacto::Update]");
				
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
				$SQL="DELETE FROM persona_contacto
				WHERE idContacto=" . mysqli_real_escape_string($this->dbLink,$this->idContacto);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePersona_contacto::Borrar]");
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
						idContacto,nombre,apellidos,telefono,correo,fecha,comentarios
					FROM persona_contacto
					WHERE idContacto=" . mysqli_real_escape_string($this->dbLink,$this->idContacto);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBasePersona_contacto::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idContacto==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>