<?php

	class ModeloBasePlantilla_whatsapp extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBasePlantilla_whatsapp";

		
		var $idPlantilla=0;
		var $codigo='';
		var $descripcion='';
		var $activa='';
		var $idUsuario=0;
		var $fecha_registro=0;

		var $__s=array("idPlantilla","codigo","descripcion","activa","idUsuario","fecha_registro");
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

		
		public function setIdPlantilla($idPlantilla)
		{
			if($idPlantilla==0||$idPlantilla==""||!is_numeric($idPlantilla)|| (is_string($idPlantilla)&&!ctype_digit($idPlantilla)))return $this->setError("Tipo de dato incorrecto para idPlantilla.");
			$this->idPlantilla=$idPlantilla;
			$this->getDatos();
		}
		public function setCodigo($codigo)
		{
			
			$this->codigo=$codigo;
		}
		public function setDescripcion($descripcion)
		{
			$this->descripcion=$descripcion;
		}
		public function setActiva()
		{
			$this->activa=1;
		}
		public function setIdUsuario($idUsuario)
		{
			
			$this->idUsuario=$idUsuario;
		}
		public function setFecha_registro($fecha_registro)
		{
			
			$this->fecha_registro=$fecha_registro;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function unsetActiva()
		{
			$this->activa=0;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdPlantilla()
		{
			return $this->idPlantilla;
		}
		public function getCodigo()
		{
			return $this->codigo;
		}
		public function getDescripcion()
		{
			return $this->descripcion;
		}
		public function getActiva()
		{
			return $this->activa;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getFecha_registro()
		{
			return $this->fecha_registro;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idPlantilla=0;
			$this->codigo='';
			$this->descripcion='';
			$this->activa='';
			$this->idUsuario=0;
			$this->fecha_registro=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO plantilla_whatsapp(codigo,descripcion,activa,idUsuario,fecha_registro)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->codigo) . "','" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "','" . mysqli_real_escape_string($this->dbLink,$this->activa) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha_registro) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBasePlantilla_whatsapp::Insertar]");
				
				$this->idPlantilla=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE plantilla_whatsapp SET codigo='" . mysqli_real_escape_string($this->dbLink,$this->codigo) . "',descripcion='" . mysqli_real_escape_string($this->dbLink,$this->descripcion) . "',activa='" . mysqli_real_escape_string($this->dbLink,$this->activa) . "',idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "',fecha_registro='" . mysqli_real_escape_string($this->dbLink,$this->fecha_registro) . "'
					WHERE idPlantilla=" . $this->idPlantilla;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePlantilla_whatsapp::Update]");
				
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
				$SQL="DELETE FROM plantilla_whatsapp
				WHERE idPlantilla=" . mysqli_real_escape_string($this->dbLink,$this->idPlantilla);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePlantilla_whatsapp::Borrar]");
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
						idPlantilla,codigo,descripcion,activa,idUsuario,fecha_registro
					FROM plantilla_whatsapp
					WHERE idPlantilla=" . mysqli_real_escape_string($this->dbLink,$this->idPlantilla);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBasePlantilla_whatsapp::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idPlantilla==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>