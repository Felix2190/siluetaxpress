<?php

	class ModeloBaseGanadores_promocion extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseGanadores_promocion";

		
		var $idGanador=0;
		var $idPaciente=0;
		var $idFranquicia=0;
		var $promocion='';
		var $fecha='';
		var $codigo='';
		var $estatus='Nuevo';
		var $idUsuarioActivo=0;

		var $__s=array("idGanador","idPaciente","idFranquicia","promocion","fecha","codigo","estatus","idUsuarioActivo");
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

		
		public function setIdGanador($idGanador)
		{
			if($idGanador==0||$idGanador==""||!is_numeric($idGanador)|| (is_string($idGanador)&&!ctype_digit($idGanador)))return $this->setError("Tipo de dato incorrecto para idGanador.");
			$this->idGanador=$idGanador;
			$this->getDatos();
		}
		public function setIdPaciente($idPaciente)
		{
			
			$this->idPaciente=$idPaciente;
		}
		public function setIdFranquicia($idFranquicia)
		{
			
			$this->idFranquicia=$idFranquicia;
		}
		public function setPromocion($promocion)
		{
			
			$this->promocion=$promocion;
		}
		public function setFecha($fecha)
		{
			$this->fecha=$fecha;
		}
		public function setCodigo($codigo)
		{
			$this->codigo=$codigo;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusNuevo()
		{
			$this->estatus='Nuevo';
		}
		public function setEstatusUtilizado()
		{
			$this->estatus='Utilizado';
		}
		public function setIdUsuarioActivo($idUsuarioActivo)
		{
			
			$this->idUsuarioActivo=$idUsuarioActivo;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdGanador()
		{
			return $this->idGanador;
		}
		public function getIdPaciente()
		{
			return $this->idPaciente;
		}
		public function getIdFranquicia()
		{
			return $this->idFranquicia;
		}
		public function getPromocion()
		{
			return $this->promocion;
		}
		public function getFecha()
		{
			return $this->fecha;
		}
		public function getCodigo()
		{
			return $this->codigo;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getIdUsuarioActivo()
		{
			return $this->idUsuarioActivo;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idGanador=0;
			$this->idPaciente=0;
			$this->idFranquicia=0;
			$this->promocion='';
			$this->fecha='';
			$this->codigo='';
			$this->estatus='Nuevo';
			$this->idUsuarioActivo=0;
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO ganadores_promocion(idPaciente,idFranquicia,promocion,fecha,codigo,estatus,idUsuarioActivo)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idPaciente) . "','" . mysqli_real_escape_string($this->dbLink,$this->idFranquicia) . "','" . mysqli_real_escape_string($this->dbLink,$this->promocion) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "','" . mysqli_real_escape_string($this->dbLink,$this->codigo) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioActivo) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseGanadores_promocion::Insertar]");
				
				$this->idGanador=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE ganadores_promocion SET idPaciente='" . mysqli_real_escape_string($this->dbLink,$this->idPaciente) . "',idFranquicia='" . mysqli_real_escape_string($this->dbLink,$this->idFranquicia) . "',promocion='" . mysqli_real_escape_string($this->dbLink,$this->promocion) . "',fecha='" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "',codigo='" . mysqli_real_escape_string($this->dbLink,$this->codigo) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',idUsuarioActivo='" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioActivo) . "'
					WHERE idGanador=" . $this->idGanador;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseGanadores_promocion::Update]");
				
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
				$SQL="DELETE FROM ganadores_promocion
				WHERE idGanador=" . mysqli_real_escape_string($this->dbLink,$this->idGanador);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseGanadores_promocion::Borrar]");
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
						idGanador,idPaciente,idFranquicia,promocion,fecha,codigo,estatus,idUsuarioActivo
					FROM ganadores_promocion
					WHERE idGanador=" . mysqli_real_escape_string($this->dbLink,$this->idGanador);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseGanadores_promocion::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idGanador==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>