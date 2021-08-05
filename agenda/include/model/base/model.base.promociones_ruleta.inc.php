<?php

	class ModeloBasePromociones_ruleta extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBasePromociones_ruleta";

		
		var $idPromocionRuleta=0;
		var $idFranquicia=0;
		var $nombrePromocion='';
		var $idUsuarioModifico=0;
		var $fechaModificacion='';

		var $__s=array("idPromocionRuleta","idFranquicia","nombrePromocion","idUsuarioModifico","fechaModificacion");
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

		
		public function setIdPromocionRuleta($idPromocionRuleta)
		{
			if($idPromocionRuleta==0||$idPromocionRuleta==""||!is_numeric($idPromocionRuleta)|| (is_string($idPromocionRuleta)&&!ctype_digit($idPromocionRuleta)))return $this->setError("Tipo de dato incorrecto para idPromocionRuleta.");
			$this->idPromocionRuleta=$idPromocionRuleta;
			$this->getDatos();
		}
		public function setIdFranquicia($idFranquicia)
		{
			
			$this->idFranquicia=$idFranquicia;
		}
		public function setNombrePromocion($nombrePromocion)
		{
			
			$this->nombrePromocion=$nombrePromocion;
		}
		public function setIdUsuarioModifico($idUsuarioModifico)
		{
			
			$this->idUsuarioModifico=$idUsuarioModifico;
		}
		public function setFechaModificacion($fechaModificacion)
		{
			$this->fechaModificacion=$fechaModificacion;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdPromocionRuleta()
		{
			return $this->idPromocionRuleta;
		}
		public function getIdFranquicia()
		{
			return $this->idFranquicia;
		}
		public function getNombrePromocion()
		{
			return $this->nombrePromocion;
		}
		public function getIdUsuarioModifico()
		{
			return $this->idUsuarioModifico;
		}
		public function getFechaModificacion()
		{
			return $this->fechaModificacion;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idPromocionRuleta=0;
			$this->idFranquicia=0;
			$this->nombrePromocion='';
			$this->idUsuarioModifico=0;
			$this->fechaModificacion='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO promociones_ruleta(idFranquicia,nombrePromocion,idUsuarioModifico,fechaModificacion)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idFranquicia) . "','" . mysqli_real_escape_string($this->dbLink,$this->nombrePromocion) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioModifico) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaModificacion) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBasePromociones_ruleta::Insertar]");
				
				$this->idPromocionRuleta=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE promociones_ruleta SET idFranquicia='" . mysqli_real_escape_string($this->dbLink,$this->idFranquicia) . "',nombrePromocion='" . mysqli_real_escape_string($this->dbLink,$this->nombrePromocion) . "',idUsuarioModifico='" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioModifico) . "',fechaModificacion='" . mysqli_real_escape_string($this->dbLink,$this->fechaModificacion) . "'
					WHERE idPromocionRuleta=" . $this->idPromocionRuleta;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePromociones_ruleta::Update]");
				
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
				$SQL="DELETE FROM promociones_ruleta
				WHERE idPromocionRuleta=" . mysqli_real_escape_string($this->dbLink,$this->idPromocionRuleta);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePromociones_ruleta::Borrar]");
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
						idPromocionRuleta,idFranquicia,nombrePromocion,idUsuarioModifico,fechaModificacion
					FROM promociones_ruleta
					WHERE idPromocionRuleta=" . mysqli_real_escape_string($this->dbLink,$this->idPromocionRuleta);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBasePromociones_ruleta::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idPromocionRuleta==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>