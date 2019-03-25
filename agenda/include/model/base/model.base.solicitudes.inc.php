<?php

	class ModeloBaseSolicitudes extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseSolicitudes";

		
		var $idSolicitud=0;
		var $tipo='contacto';
		var $nombre='';
		var $cveEstado='';
		var $cveMunicipio='';
		var $ciudad='';
		var $direccion='';
		var $telefono='';
		var $correo='';
		var $comentarios='';
		var $estatus='nueva';
		var $fecha='';

		var $__s=array("idSolicitud","tipo","nombre","cveEstado","cveMunicipio","ciudad","direccion","telefono","correo","comentarios","estatus","fecha");
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

		
		public function setIdSolicitud($idSolicitud)
		{
			if($idSolicitud==0||$idSolicitud==""||!is_numeric($idSolicitud)|| (is_string($idSolicitud)&&!ctype_digit($idSolicitud)))return $this->setError("Tipo de dato incorrecto para idSolicitud.");
			$this->idSolicitud=$idSolicitud;
			$this->getDatos();
		}
		public function setTipo($tipo)
		{
			
			$this->tipo=$tipo;
		}
		public function setTipoContacto()
		{
			$this->tipo='contacto';
		}
		public function setTipoFranquicia()
		{
			$this->tipo='franquicia';
		}
		public function setNombre($nombre)
		{
			
			$this->nombre=$nombre;
		}
		public function setCveEstado($cveEstado)
		{
			
			$this->cveEstado=$cveEstado;
		}
		public function setCveMunicipio($cveMunicipio)
		{
			
			$this->cveMunicipio=$cveMunicipio;
		}
		public function setCiudad($ciudad)
		{
			
			$this->ciudad=$ciudad;
		}
		public function setDireccion($direccion)
		{
			
			$this->direccion=$direccion;
		}
		public function setTelefono($telefono)
		{
			
			$this->telefono=$telefono;
		}
		public function setCorreo($correo)
		{
			
			$this->correo=$correo;
		}
		public function setComentarios($comentarios)
		{
			$this->comentarios=$comentarios;
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusNueva()
		{
			$this->estatus='nueva';
		}
		public function setFecha($fecha)
		{
			$this->fecha=$fecha;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdSolicitud()
		{
			return $this->idSolicitud;
		}
		public function getTipo()
		{
			return $this->tipo;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getCveEstado()
		{
			return $this->cveEstado;
		}
		public function getCveMunicipio()
		{
			return $this->cveMunicipio;
		}
		public function getCiudad()
		{
			return $this->ciudad;
		}
		public function getDireccion()
		{
			return $this->direccion;
		}
		public function getTelefono()
		{
			return $this->telefono;
		}
		public function getCorreo()
		{
			return $this->correo;
		}
		public function getComentarios()
		{
			return $this->comentarios;
		}
		public function getEstatus()
		{
			return $this->estatus;
		}
		public function getFecha()
		{
			return $this->fecha;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idSolicitud=0;
			$this->tipo='contacto';
			$this->nombre='';
			$this->cveEstado='';
			$this->cveMunicipio='';
			$this->ciudad='';
			$this->direccion='';
			$this->telefono='';
			$this->correo='';
			$this->comentarios='';
			$this->estatus='nueva';
			$this->fecha='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO solicitudes(tipo,nombre,cveEstado,cveMunicipio,ciudad,direccion,telefono,correo,comentarios,estatus,fecha)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "','" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "','" . mysqli_real_escape_string($this->dbLink,$this->cveEstado) . "','" . mysqli_real_escape_string($this->dbLink,$this->cveMunicipio) . "','" . mysqli_real_escape_string($this->dbLink,$this->ciudad) . "','" . mysqli_real_escape_string($this->dbLink,$this->direccion) . "','" . mysqli_real_escape_string($this->dbLink,$this->telefono) . "','" . mysqli_real_escape_string($this->dbLink,$this->correo) . "','" . mysqli_real_escape_string($this->dbLink,$this->comentarios) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "','" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseSolicitudes::Insertar]");
				
				$this->idSolicitud=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE solicitudes SET tipo='" . mysqli_real_escape_string($this->dbLink,$this->tipo) . "',nombre='" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "',cveEstado='" . mysqli_real_escape_string($this->dbLink,$this->cveEstado) . "',cveMunicipio='" . mysqli_real_escape_string($this->dbLink,$this->cveMunicipio) . "',ciudad='" . mysqli_real_escape_string($this->dbLink,$this->ciudad) . "',direccion='" . mysqli_real_escape_string($this->dbLink,$this->direccion) . "',telefono='" . mysqli_real_escape_string($this->dbLink,$this->telefono) . "',correo='" . mysqli_real_escape_string($this->dbLink,$this->correo) . "',comentarios='" . mysqli_real_escape_string($this->dbLink,$this->comentarios) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "',fecha='" . mysqli_real_escape_string($this->dbLink,$this->fecha) . "'
					WHERE idSolicitud=" . $this->idSolicitud;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseSolicitudes::Update]");
				
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
				$SQL="DELETE FROM solicitudes
				WHERE idSolicitud=" . mysqli_real_escape_string($this->dbLink,$this->idSolicitud);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseSolicitudes::Borrar]");
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
						idSolicitud,tipo,nombre,cveEstado,cveMunicipio,ciudad,direccion,telefono,correo,comentarios,estatus,fecha
					FROM solicitudes
					WHERE idSolicitud=" . mysqli_real_escape_string($this->dbLink,$this->idSolicitud);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseSolicitudes::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idSolicitud==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>