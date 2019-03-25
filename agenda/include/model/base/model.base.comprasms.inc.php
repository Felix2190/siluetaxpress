<?php

	class ModeloBaseComprasms extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseComprasms";

		
		var $idCompra=0;
		var $fecha='';
		var $saldo=0;
		var $saldoAnterior=0;

		var $__s=array("idCompra","fecha","saldo","saldoAnterior");
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

		
		public function setIdCompra($idCompra)
		{
			if($idCompra==0||$idCompra==""||!is_numeric($idCompra)|| (is_string($idCompra)&&!ctype_digit($idCompra)))return $this->setError("Tipo de dato incorrecto para idCompra.");
			$this->idCompra=$idCompra;
			$this->getDatos();
		}
		public function setFecha($fecha)
		{
			$this->fecha=$fecha;
		}
		public function setSaldo($saldo)
		{
			
			$this->saldo=$saldo;
		}
		public function setSaldoAnterior($saldoAnterior)
		{
			
			$this->saldoAnterior=$saldoAnterior;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdCompra()
		{
			return $this->idCompra;
		}
		public function getFecha()
		{
			return $this->fecha;
		}
		public function getSaldo()
		{
			return $this->saldo;
		}
		public function getSaldoAnterior()
		{
			return $this->saldoAnterior;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idCompra=0;
			$this->fecha='';
			$this->saldo=0;
			$this->saldoAnterior=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO comprasms(fecha,saldo,saldoAnterior)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "','" . mysqli_real_escape_string($this->dbLink,$this->saldo) . "','" . mysqli_real_escape_string($this->dbLink,$this->saldoAnterior) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseComprasms::Insertar]");
				
				$this->idCompra=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE comprasms SET fecha='" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "',saldo='" . mysqli_real_escape_string($this->dbLink,$this->saldo) . "',saldoAnterior='" . mysqli_real_escape_string($this->dbLink,$this->saldoAnterior) . "'
					WHERE idCompra=" . $this->idCompra;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseComprasms::Update]");
				
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
				$SQL="DELETE FROM comprasms
				WHERE idCompra=" . mysqli_real_escape_string($this->dbLink,$this->idCompra);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseComprasms::Borrar]");
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
						idCompra,fecha,saldo,saldoAnterior
					FROM comprasms
					WHERE idCompra=" . mysqli_real_escape_string($this->dbLink,$this->idCompra);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseComprasms::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idCompra==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>