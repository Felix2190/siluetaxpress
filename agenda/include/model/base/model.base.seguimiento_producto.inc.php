<?php

	class ModeloBaseSeguimiento_producto extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseSeguimiento_producto";

		
		var $idSeguimientoProducto=0;
		var $idSeguimiento=0;
		var $idProducto=0;
		var $idUsuario=0;
		var $estatus='activo';
		var $fechaRegistro='';

		var $__s=array("idSeguimientoProducto","idSeguimiento","idProducto","idUsuario","estatus","fechaRegistro");
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

		
		public function setIdSeguimientoProducto($idSeguimientoProducto)
		{
			if($idSeguimientoProducto==0||$idSeguimientoProducto==""||!is_numeric($idSeguimientoProducto)|| (is_string($idSeguimientoProducto)&&!ctype_digit($idSeguimientoProducto)))return $this->setError("Tipo de dato incorrecto para idSeguimientoProducto.");
			$this->idSeguimientoProducto=$idSeguimientoProducto;
			$this->getDatos();
		}
		public function setIdSeguimiento($idSeguimiento)
		{
			
			$this->idSeguimiento=$idSeguimiento;
		}
		public function setIdProducto($idProducto)
		{
			
			$this->idProducto=$idProducto;
		}
		public function setIdUsuario($idUsuario)
		{
			
			$this->idUsuario=$idUsuario;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusActivo()
		{
			$this->estatus='activo';
		}
		public function setEstatusBaja()
		{
			$this->estatus='baja';
		}
		public function setFechaRegistro($fechaRegistro)
		{
			$this->fechaRegistro=$fechaRegistro;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdSeguimientoProducto()
		{
			return $this->idSeguimientoProducto;
		}
		public function getIdSeguimiento()
		{
			return $this->idSeguimiento;
		}
		public function getIdProducto()
		{
			return $this->idProducto;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getFechaRegistro()
		{
			return $this->fechaRegistro;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idSeguimientoProducto=0;
			$this->idSeguimiento=0;
			$this->idProducto=0;
			$this->idUsuario=0;
			$this->estatus='activo';
			$this->fechaRegistro='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO seguimiento_producto(idSeguimiento,idProducto,idUsuario,estatus,fechaRegistro)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idSeguimiento) . "','" . mysqli_real_escape_string($this->dbLink,$this->idProducto) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseSeguimiento_producto::Insertar]");
				
				$this->idSeguimientoProducto=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE seguimiento_producto SET idSeguimiento='" . mysqli_real_escape_string($this->dbLink,$this->idSeguimiento) . "',idProducto='" . mysqli_real_escape_string($this->dbLink,$this->idProducto) . "',idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',fechaRegistro='" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "'
					WHERE idSeguimientoProducto=" . $this->idSeguimientoProducto;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseSeguimiento_producto::Update]");
				
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
				$SQL="DELETE FROM seguimiento_producto
				WHERE idSeguimientoProducto=" . mysqli_real_escape_string($this->dbLink,$this->idSeguimientoProducto);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseSeguimiento_producto::Borrar]");
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
						idSeguimientoProducto,idSeguimiento,idProducto,idUsuario,estatus,fechaRegistro
					FROM seguimiento_producto
					WHERE idSeguimientoProducto=" . mysqli_real_escape_string($this->dbLink,$this->idSeguimientoProducto);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseSeguimiento_producto::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idSeguimientoProducto==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>