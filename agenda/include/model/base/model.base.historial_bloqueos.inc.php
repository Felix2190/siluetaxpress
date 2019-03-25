<?php

	class ModeloBaseHistorial_bloqueos extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseHistorial_bloqueos";

		
		var $idHistorial=0;
		var $idBloqueo=0;
		var $estatus='Bloqueado';

		var $__s=array("idHistorial","idBloqueo","estatus");
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

		
		public function setIdHistorial($idHistorial)
		{
			if($idHistorial==0||$idHistorial==""||!is_numeric($idHistorial)|| (is_string($idHistorial)&&!ctype_digit($idHistorial)))return $this->setError("Tipo de dato incorrecto para idHistorial.");
			$this->idHistorial=$idHistorial;
			$this->getDatos();
		}
		public function setIdBloqueo($idBloqueo)
		{
			
			$this->idBloqueo=$idBloqueo;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusDisponible()
		{
			$this->estatus='Disponible';
		}
		public function setEstatusBloqueado()
		{
			$this->estatus='Bloqueado';
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdHistorial()
		{
			return $this->idHistorial;
		}
		public function getIdBloqueo()
		{
			return $this->idBloqueo;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idHistorial=0;
			$this->idBloqueo=0;
			$this->estatus='Bloqueado';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO historial_bloqueos(idBloqueo,estatus)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idBloqueo) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseHistorial_bloqueos::Insertar]");
				
				$this->idHistorial=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE historial_bloqueos SET idBloqueo='" . mysqli_real_escape_string($this->dbLink,$this->idBloqueo) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "'
					WHERE idHistorial=" . $this->idHistorial;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseHistorial_bloqueos::Update]");
				
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
				$SQL="DELETE FROM historial_bloqueos
				WHERE idHistorial=" . mysqli_real_escape_string($this->dbLink,$this->idHistorial);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseHistorial_bloqueos::Borrar]");
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
						idHistorial,idBloqueo,estatus
					FROM historial_bloqueos
					WHERE idHistorial=" . mysqli_real_escape_string($this->dbLink,$this->idHistorial);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseHistorial_bloqueos::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idHistorial==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>