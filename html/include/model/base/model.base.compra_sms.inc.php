<?php

	class ModeloBaseCompra_sms extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseCompra_sms";

		
		var $idCompra=0;
		var $saldo_anterior='';
		var $compra='';
		var $total='';
		var $fecha_compra='';

		var $__s=array("idCompra","saldo_anterior","compra","total","fecha_compra");
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
		public function setSaldo_anterior($saldo_anterior)
		{
			$this->saldo_anterior=$saldo_anterior;
		}
		public function setCompra($compra)
		{
			$this->compra=$compra;
		}
		public function setTotal($total)
		{
			$this->total=$total;
		}
		public function setFecha_compra($fecha_compra)
		{
			$this->fecha_compra=$fecha_compra;
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
		public function getSaldo_anterior()
		{
			return $this->saldo_anterior;
		}
		public function getCompra()
		{
			return $this->compra;
		}
		public function getTotal()
		{
			return $this->total;
		}
		public function getFecha_compra()
		{
			return $this->fecha_compra;
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
			$this->saldo_anterior='';
			$this->compra='';
			$this->total='';
			$this->fecha_compra='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO compra_sms(saldo_anterior,compra,total,fecha_compra)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->saldo_anterior) . "','" . mysqli_real_escape_string($this->dbLink,$this->compra) . "','" . mysqli_real_escape_string($this->dbLink,$this->total) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha_compra) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseCompra_sms::Insertar]");
				
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
				$SQL="UPDATE compra_sms SET saldo_anterior='" . mysqli_real_escape_string($this->dbLink,$this->saldo_anterior) . "',compra='" . mysqli_real_escape_string($this->dbLink,$this->compra) . "',total='" . mysqli_real_escape_string($this->dbLink,$this->total) . "',fecha_compra='" . mysqli_real_escape_string($this->dbLink,$this->fecha_compra) . "'
					WHERE idCompra=" . $this->idCompra;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseCompra_sms::Update]");
				
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
				$SQL="DELETE FROM compra_sms
				WHERE idCompra=" . mysqli_real_escape_string($this->dbLink,$this->idCompra);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseCompra_sms::Borrar]");
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
						idCompra,saldo_anterior,compra,total,fecha_compra
					FROM compra_sms
					WHERE idCompra=" . mysqli_real_escape_string($this->dbLink,$this->idCompra);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseCompra_sms::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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