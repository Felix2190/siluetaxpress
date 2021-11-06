<?php

	class ModeloBaseSucursal extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseSucursal";

		
		var $idSucursal=0;
		var $sucursal='';
		var $cveEstado='';
		var $cveMunicipio='';
		var $direccion='';
		var $estatus='activa';
		var $entreSemanaEntrada=0;
		var $entreSemanaSalida=0;
		var $sabadoEntrada=0;
		var $sabadoSalida=0;
		var $numTelefono='';

		var $__s=array("idSucursal","sucursal","cveEstado","cveMunicipio","direccion","estatus","entreSemanaEntrada","entreSemanaSalida","sabadoEntrada","sabadoSalida","numTelefono");
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

		
		public function setIdSucursal($idSucursal)
		{
			if($idSucursal==0||$idSucursal==""||!is_numeric($idSucursal)|| (is_string($idSucursal)&&!ctype_digit($idSucursal)))return $this->setError("Tipo de dato incorrecto para idSucursal.");
			$this->idSucursal=$idSucursal;
			$this->getDatos();
		}
		public function setSucursal($sucursal)
		{
			
			$this->sucursal=$sucursal;
		}
		public function setCveEstado($cveEstado)
		{
			
			$this->cveEstado=$cveEstado;
		}
		public function setCveMunicipio($cveMunicipio)
		{
			
			$this->cveMunicipio=$cveMunicipio;
		}
		public function setDireccion($direccion)
		{
			
			$this->direccion=$direccion;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusActiva()
		{
			$this->estatus='activa';
		}
		public function setEstatusInactiva()
		{
			$this->estatus='inactiva';
		}
		public function setEntreSemanaEntrada($entreSemanaEntrada)
		{
			
			$this->entreSemanaEntrada=$entreSemanaEntrada;
		}
		public function setEntreSemanaSalida($entreSemanaSalida)
		{
			
			$this->entreSemanaSalida=$entreSemanaSalida;
		}
		public function setSabadoEntrada($sabadoEntrada)
		{
			
			$this->sabadoEntrada=$sabadoEntrada;
		}
		public function setSabadoSalida($sabadoSalida)
		{
			
			$this->sabadoSalida=$sabadoSalida;
		}
		public function setNumTelefono($numTelefono)
		{
			$this->numTelefono=$numTelefono;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdSucursal()
		{
			return $this->idSucursal;
		}
		public function getSucursal()
		{
			return $this->sucursal;
		}
		public function getCveEstado()
		{
			return $this->cveEstado;
		}
		public function getCveMunicipio()
		{
			return $this->cveMunicipio;
		}
		public function getDireccion()
		{
			return $this->direccion;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getEntreSemanaEntrada()
		{
			return $this->entreSemanaEntrada;
		}
		public function getEntreSemanaSalida()
		{
			return $this->entreSemanaSalida;
		}
		public function getSabadoEntrada()
		{
			return $this->sabadoEntrada;
		}
		public function getSabadoSalida()
		{
			return $this->sabadoSalida;
		}
		public function getNumTelefono()
		{
			return $this->numTelefono;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idSucursal=0;
			$this->sucursal='';
			$this->cveEstado='';
			$this->cveMunicipio='';
			$this->direccion='';
			$this->estatus='activa';
			$this->entreSemanaEntrada=0;
			$this->entreSemanaSalida=0;
			$this->sabadoEntrada=0;
			$this->sabadoSalida=0;
			$this->numTelefono='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO sucursal(sucursal,cveEstado,cveMunicipio,direccion,estatus,entreSemanaEntrada,entreSemanaSalida,sabadoEntrada,sabadoSalida,numTelefono)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->sucursal) . "','" . mysqli_real_escape_string($this->dbLink,$this->cveEstado) . "','" . mysqli_real_escape_string($this->dbLink,$this->cveMunicipio) . "','" . mysqli_real_escape_string($this->dbLink,$this->direccion) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->entreSemanaEntrada) . "','" . mysqli_real_escape_string($this->dbLink,$this->entreSemanaSalida) . "','" . mysqli_real_escape_string($this->dbLink,$this->sabadoEntrada) . "','" . mysqli_real_escape_string($this->dbLink,$this->sabadoSalida) . "','" . mysqli_real_escape_string($this->dbLink,$this->numTelefono) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseSucursal::Insertar]");
				
				$this->idSucursal=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE sucursal SET sucursal='" . mysqli_real_escape_string($this->dbLink,$this->sucursal) . "',cveEstado='" . mysqli_real_escape_string($this->dbLink,$this->cveEstado) . "',cveMunicipio='" . mysqli_real_escape_string($this->dbLink,$this->cveMunicipio) . "',direccion='" . mysqli_real_escape_string($this->dbLink,$this->direccion) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',entreSemanaEntrada='" . mysqli_real_escape_string($this->dbLink,$this->entreSemanaEntrada) . "',entreSemanaSalida='" . mysqli_real_escape_string($this->dbLink,$this->entreSemanaSalida) . "',sabadoEntrada='" . mysqli_real_escape_string($this->dbLink,$this->sabadoEntrada) . "',sabadoSalida='" . mysqli_real_escape_string($this->dbLink,$this->sabadoSalida) . "',numTelefono='" . mysqli_real_escape_string($this->dbLink,$this->numTelefono) . "'
					WHERE idSucursal=" . $this->idSucursal;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseSucursal::Update]");
				
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
				$SQL="DELETE FROM sucursal
				WHERE idSucursal=" . mysqli_real_escape_string($this->dbLink,$this->idSucursal);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseSucursal::Borrar]");
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
						idSucursal,sucursal,cveEstado,cveMunicipio,direccion,estatus,entreSemanaEntrada,entreSemanaSalida,sabadoEntrada,sabadoSalida,numTelefono
					FROM sucursal
					WHERE idSucursal=" . mysqli_real_escape_string($this->dbLink,$this->idSucursal);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseSucursal::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idSucursal==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>