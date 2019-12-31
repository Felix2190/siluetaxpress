<?php

	class ModeloBaseNotificacion extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseNotificacion";

		
		var $idNotificacion=0;
		var $nombre='';
		var $texto='';
		var $tipo='';
		var $fechaRegistro='';
		var $idUsuario=0;
		var $idSucursal=0;
		var $imagen1='';
		var $imagen2='';
		var $imagen3='';
		var $imagen4='';
		var $imagen5='';

		var $__s=array("idNotificacion","nombre","texto","tipo","fechaRegistro","idUsuario","idSucursal","imagen1","imagen2","imagen3","imagen4","imagen5");
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

		
		public function setIdNotificacion($idNotificacion)
		{
			if($idNotificacion==0||$idNotificacion==""||!is_numeric($idNotificacion)|| (is_string($idNotificacion)&&!ctype_digit($idNotificacion)))return $this->setError("Tipo de dato incorrecto para idNotificacion.");
			$this->idNotificacion=$idNotificacion;
			$this->getDatos();
		}
		public function setNombre($nombre)
		{
			
			$this->nombre=$nombre;
		}
		public function setTexto($texto)
		{
			$this->texto=$texto;
		}
		public function setTipo($tipo)
		{
			
			$this->tipo=$tipo;
		}
		public function setTipoSMS()
		{
			$this->tipo='SMS';
		}
		public function setTipoCorreo()
		{
			$this->tipo='Correo';
		}
		public function setFechaRegistro($fechaRegistro)
		{
			$this->fechaRegistro=$fechaRegistro;
		}
		public function setIdUsuario($idUsuario)
		{
			
			$this->idUsuario=$idUsuario;
		}
		public function setIdSucursal($idSucursal)
		{
			
			$this->idSucursal=$idSucursal;
		}
		public function setImagen1($imagen1)
		{
			$this->imagen1=$imagen1;
		}
		public function setImagen2($imagen2)
		{
			$this->imagen2=$imagen2;
		}
		public function setImagen3($imagen3)
		{
			$this->imagen3=$imagen3;
		}
		public function setImagen4($imagen4)
		{
			$this->imagen4=$imagen4;
		}
		public function setImagen5($imagen5)
		{
			$this->imagen5=$imagen5;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdNotificacion()
		{
			return $this->idNotificacion;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getTexto()
		{
			return $this->texto;
		}
		public function getTipo()
		{
			return $this->tipo;
		}
		public function getFechaRegistro()
		{
			return $this->fechaRegistro;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getIdSucursal()
		{
			return $this->idSucursal;
		}
		public function getImagen1()
		{
			return $this->imagen1;
		}
		public function getImagen2()
		{
			return $this->imagen2;
		}
		public function getImagen3()
		{
			return $this->imagen3;
		}
		public function getImagen4()
		{
			return $this->imagen4;
		}
		public function getImagen5()
		{
			return $this->imagen5;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idNotificacion=0;
			$this->nombre='';
			$this->texto='';
			$this->tipo='';
			$this->fechaRegistro='';
			$this->idUsuario=0;
			$this->idSucursal=0;
			$this->imagen1='';
			$this->imagen2='';
			$this->imagen3='';
			$this->imagen4='';
			$this->imagen5='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO notificacion(nombre,texto,tipo,fechaRegistro,idUsuario,idSucursal,imagen1,imagen2,imagen3,imagen4,imagen5)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "','" . mysqli_real_escape_string($this->dbLink,$this->texto) . "','" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "','" . mysqli_real_escape_string($this->dbLink,$this->imagen1) . "','" . mysqli_real_escape_string($this->dbLink,$this->imagen2) . "','" . mysqli_real_escape_string($this->dbLink,$this->imagen3) . "','" . mysqli_real_escape_string($this->dbLink,$this->imagen4) . "','" . mysqli_real_escape_string($this->dbLink,$this->imagen5) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseNotificacion::Insertar]");
				
				$this->idNotificacion=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE notificacion SET nombre='" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "',texto='" . mysqli_real_escape_string($this->dbLink,$this->texto) . "',tipo='" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "',fechaRegistro='" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "',idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "',idSucursal='" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "',imagen1='" . mysqli_real_escape_string($this->dbLink,$this->imagen1) . "',imagen2='" . mysqli_real_escape_string($this->dbLink,$this->imagen2) . "',imagen3='" . mysqli_real_escape_string($this->dbLink,$this->imagen3) . "',imagen4='" . mysqli_real_escape_string($this->dbLink,$this->imagen4) . "',imagen5='" . mysqli_real_escape_string($this->dbLink,$this->imagen5) . "'
					WHERE idNotificacion=" . $this->idNotificacion;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseNotificacion::Update]");
				
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
				$SQL="DELETE FROM notificacion
				WHERE idNotificacion=" . mysqli_real_escape_string($this->dbLink,$this->idNotificacion);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseNotificacion::Borrar]");
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
						idNotificacion,nombre,texto,tipo,fechaRegistro,idUsuario,idSucursal,imagen1,imagen2,imagen3,imagen4,imagen5
					FROM notificacion
					WHERE idNotificacion=" . mysqli_real_escape_string($this->dbLink,$this->idNotificacion);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseNotificacion::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idNotificacion==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>