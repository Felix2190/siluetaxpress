<?php

	class ModeloBaseFranquicia extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseFranquicia";

		
		var $idFranquicia=0;
		var $franquicia='';
		var $idUsuario=0;
		var $envio_sms='0';
		var $cuenta='';
		var $clave='';
		var $fechaRegistro='';

		var $__s=array("idFranquicia","franquicia","idUsuario","envio_sms","cuenta","clave","fechaRegistro");
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

		
		public function setIdFranquicia($idFranquicia)
		{
			if($idFranquicia==0||$idFranquicia==""||!is_numeric($idFranquicia)|| (is_string($idFranquicia)&&!ctype_digit($idFranquicia)))return $this->setError("Tipo de dato incorrecto para idFranquicia.");
			$this->idFranquicia=$idFranquicia;
			$this->getDatos();
		}
		public function setFranquicia($franquicia)
		{
			
			$this->franquicia=$franquicia;
		}
		public function setIdUsuario($idUsuario)
		{
			
			$this->idUsuario=$idUsuario;
		}
		public function setEnvio_sms()
		{
			$this->envio_sms=1;
		}
		public function setCuenta($cuenta)
		{
			
			$this->cuenta=$cuenta;
		}
		public function setClave($clave)
		{
			
			$this->clave=$clave;
		}
		public function setFechaRegistro($fechaRegistro)
		{
			$this->fechaRegistro=$fechaRegistro;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function unsetEnvio_sms()
		{
			$this->envio_sms=0;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdFranquicia()
		{
			return $this->idFranquicia;
		}
		public function getFranquicia()
		{
			return $this->franquicia;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getEnvio_sms()
		{
			return $this->envio_sms;
		}
		public function getCuenta()
		{
			return $this->cuenta;
		}
		public function getClave()
		{
			return $this->clave;
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
			
			$this->idFranquicia=0;
			$this->franquicia='';
			$this->idUsuario=0;
			$this->envio_sms='0';
			$this->cuenta='';
			$this->clave='';
			$this->fechaRegistro='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO franquicia(franquicia,idUsuario,envio_sms,cuenta,clave,fechaRegistro)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->franquicia) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->envio_sms) . "','" . mysqli_real_escape_string($this->dbLink,$this->cuenta) . "','" . mysqli_real_escape_string($this->dbLink,$this->clave) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseFranquicia::Insertar]");
				
				$this->idFranquicia=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE franquicia SET franquicia='" . mysqli_real_escape_string($this->dbLink,$this->franquicia) . "',idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "',envio_sms='" . mysqli_real_escape_string($this->dbLink,$this->envio_sms) . "',cuenta='" . mysqli_real_escape_string($this->dbLink,$this->cuenta) . "',clave='" . mysqli_real_escape_string($this->dbLink,$this->clave) . "',fechaRegistro='" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "'
					WHERE idFranquicia=" . $this->idFranquicia;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseFranquicia::Update]");
				
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
				$SQL="DELETE FROM franquicia
				WHERE idFranquicia=" . mysqli_real_escape_string($this->dbLink,$this->idFranquicia);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseFranquicia::Borrar]");
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
						idFranquicia,franquicia,idUsuario,envio_sms,cuenta,clave,fechaRegistro
					FROM franquicia
					WHERE idFranquicia=" . mysqli_real_escape_string($this->dbLink,$this->idFranquicia);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseFranquicia::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idFranquicia==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>