<?php

	class ModeloBaseCitasparalelas extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseCitasparalelas";

		
		var $idCitaParalela=0;
		var $idCita1=0;
		var $idCita2=0;
		var $idUsuario=0;
		var $idSucursal=0;
		var $actualizable='';
		var $idCitaParalelaAdmin=0;
		var $idCitaParalelaOtroUsuario=0;
		var $estatus='';
		var $fechaRegistro='';
		var $fechaResolucion='';

		var $__s=array("idCitaParalela","idCita1","idCita2","idUsuario","idSucursal","actualizable","idCitaParalelaAdmin","idCitaParalelaOtroUsuario","estatus","fechaRegistro","fechaResolucion");
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

		
		public function setIdCitaParalela($idCitaParalela)
		{
			if($idCitaParalela==0||$idCitaParalela==""||!is_numeric($idCitaParalela)|| (is_string($idCitaParalela)&&!ctype_digit($idCitaParalela)))return $this->setError("Tipo de dato incorrecto para idCitaParalela.");
			$this->idCitaParalela=$idCitaParalela;
			$this->getDatos();
		}
		public function setIdCita1($idCita1)
		{
			
			$this->idCita1=$idCita1;
		}
		public function setIdCita2($idCita2)
		{
			
			$this->idCita2=$idCita2;
		}
		public function setIdUsuario($idUsuario)
		{
			
			$this->idUsuario=$idUsuario;
		}
		public function setIdSucursal($idSucursal)
		{
			
			$this->idSucursal=$idSucursal;
		}
		public function setActualizable()
		{
			$this->actualizable=1;
		}
		public function setIdCitaParalelaAdmin($idCitaParalelaAdmin)
		{
			
			$this->idCitaParalelaAdmin=$idCitaParalelaAdmin;
		}
		public function setIdCitaParalelaOtroUsuario($idCitaParalelaOtroUsuario)
		{
			
			$this->idCitaParalelaOtroUsuario=$idCitaParalelaOtroUsuario;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusPendiente()
		{
			$this->estatus='pendiente';
		}
		public function setEstatusResuelto()
		{
			$this->estatus='resuelto';
		}
		public function setFechaRegistro($fechaRegistro)
		{
			$this->fechaRegistro=$fechaRegistro;
		}
		public function setFechaResolucion($fechaResolucion)
		{
			$this->fechaResolucion=$fechaResolucion;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function unsetActualizable()
		{
			$this->actualizable=0;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdCitaParalela()
		{
			return $this->idCitaParalela;
		}
		public function getIdCita1()
		{
			return $this->idCita1;
		}
		public function getIdCita2()
		{
			return $this->idCita2;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getIdSucursal()
		{
			return $this->idSucursal;
		}
		public function getActualizable()
		{
			return $this->actualizable;
		}
		public function getIdCitaParalelaAdmin()
		{
			return $this->idCitaParalelaAdmin;
		}
		public function getIdCitaParalelaOtroUsuario()
		{
			return $this->idCitaParalelaOtroUsuario;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getFechaRegistro()
		{
			return $this->fechaRegistro;
		}
		public function getFechaResolucion()
		{
			return $this->fechaResolucion;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idCitaParalela=0;
			$this->idCita1=0;
			$this->idCita2=0;
			$this->idUsuario=0;
			$this->idSucursal=0;
			$this->actualizable='';
			$this->idCitaParalelaAdmin=0;
			$this->idCitaParalelaOtroUsuario=0;
			$this->estatus='';
			$this->fechaRegistro='';
			$this->fechaResolucion='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO citasparalelas(idCita1,idCita2,idUsuario,idSucursal,actualizable,idCitaParalelaAdmin,idCitaParalelaOtroUsuario,estatus,fechaRegistro,fechaResolucion)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idCita1) . "','" . mysqli_real_escape_string($this->dbLink,$this->idCita2) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "','" . mysqli_real_escape_string($this->dbLink,$this->actualizable) . "','" . mysqli_real_escape_string($this->dbLink,$this->idCitaParalelaAdmin) . "','" . mysqli_real_escape_string($this->dbLink,$this->idCitaParalelaOtroUsuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaResolucion) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseCitasparalelas::Insertar]");
				
				$this->idCitaParalela=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE citasparalelas SET idCita1='" . mysqli_real_escape_string($this->dbLink,$this->idCita1) . "',idCita2='" . mysqli_real_escape_string($this->dbLink,$this->idCita2) . "',idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "',idSucursal='" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "',actualizable='" . mysqli_real_escape_string($this->dbLink,$this->actualizable) . "',idCitaParalelaAdmin='" . mysqli_real_escape_string($this->dbLink,$this->idCitaParalelaAdmin) . "',idCitaParalelaOtroUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idCitaParalelaOtroUsuario) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',fechaRegistro='" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "',fechaResolucion='" . mysqli_real_escape_string($this->dbLink,$this->fechaResolucion) . "'
					WHERE idCitaParalela=" . $this->idCitaParalela;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseCitasparalelas::Update]");
				
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
				$SQL="DELETE FROM citasparalelas
				WHERE idCitaParalela=" . mysqli_real_escape_string($this->dbLink,$this->idCitaParalela);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseCitasparalelas::Borrar]");
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
						idCitaParalela,idCita1,idCita2,idUsuario,idSucursal,actualizable,idCitaParalelaAdmin,idCitaParalelaOtroUsuario,estatus,fechaRegistro,fechaResolucion
					FROM citasparalelas
					WHERE idCitaParalela=" . mysqli_real_escape_string($this->dbLink,$this->idCitaParalela);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseCitasparalelas::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idCitaParalela==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>