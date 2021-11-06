<?php

	class ModeloBaseComentarioscita extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseComentarioscita";

		
		var $idComentario=0;
		var $idCita=0;
		var $fechaComentario='';
		var $comentario='';

		var $__s=array("idComentario","idCita","fechaComentario","comentario");
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

		
		public function setIdComentario($idComentario)
		{
			if($idComentario==0||$idComentario==""||!is_numeric($idComentario)|| (is_string($idComentario)&&!ctype_digit($idComentario)))return $this->setError("Tipo de dato incorrecto para idComentario.");
			$this->idComentario=$idComentario;
			$this->getDatos();
		}
		public function setIdCita($idCita)
		{
			
			$this->idCita=$idCita;
		}
		public function setFechaComentario($fechaComentario)
		{
			$this->fechaComentario=$fechaComentario;
		}
		public function setComentario($comentario)
		{
			$this->comentario=$comentario;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdComentario()
		{
			return $this->idComentario;
		}
		public function getIdCita()
		{
			return $this->idCita;
		}
		public function getFechaComentario()
		{
			return $this->fechaComentario;
		}
		public function getComentario()
		{
			return $this->comentario;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idComentario=0;
			$this->idCita=0;
			$this->fechaComentario='';
			$this->comentario='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO comentarioscita(idCita,fechaComentario,comentario)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idCita) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaComentario) . "','" . mysqli_real_escape_string($this->dbLink,$this->comentario) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseComentarioscita::Insertar]");
				
				$this->idComentario=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE comentarioscita SET idCita='" . mysqli_real_escape_string($this->dbLink,$this->idCita) . "',fechaComentario='" . mysqli_real_escape_string($this->dbLink,$this->fechaComentario) . "',comentario='" . mysqli_real_escape_string($this->dbLink,$this->comentario) . "'
					WHERE idComentario=" . $this->idComentario;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseComentarioscita::Update]");
				
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
				$SQL="DELETE FROM comentarioscita
				WHERE idComentario=" . mysqli_real_escape_string($this->dbLink,$this->idComentario);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseComentarioscita::Borrar]");
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
						idComentario,idCita,fechaComentario,comentario
					FROM comentarioscita
					WHERE idComentario=" . mysqli_real_escape_string($this->dbLink,$this->idComentario);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseComentarioscita::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idComentario==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>