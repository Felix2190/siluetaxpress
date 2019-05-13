<?php

	class ModeloBasePaciente extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBasePaciente";

		
		var $idPaciente=0;
		var $nombre='';
		var $apellidos='';
		var $telefonoCasa='';
		var $telefonoCel='';
		var $edad=0;
		var $sexo='';
		var $fechaNacimiento='';
		var $ocupacion='';
		var $correo='';
		var $idHojaClinica=0;
		var $fechaRegistro='';
		var $idUsuarioRegistro=0;
		var $idSucursal=0;
		var $llenado='Completo';
		var $estatus='activo';

		var $__s=array("idPaciente","nombre","apellidos","telefonoCasa","telefonoCel","edad","sexo","fechaNacimiento","ocupacion","correo","idHojaClinica","fechaRegistro","idUsuarioRegistro","idSucursal","llenado","estatus");
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

		
		public function setIdPaciente($idPaciente)
		{
			if($idPaciente==0||$idPaciente==""||!is_numeric($idPaciente)|| (is_string($idPaciente)&&!ctype_digit($idPaciente)))return $this->setError("Tipo de dato incorrecto para idPaciente.");
			$this->idPaciente=$idPaciente;
			$this->getDatos();
		}
		public function setNombre($nombre)
		{
			
			$this->nombre=$nombre;
		}
		public function setApellidos($apellidos)
		{
			
			$this->apellidos=$apellidos;
		}
		public function setTelefonoCasa($telefonoCasa)
		{
			
			$this->telefonoCasa=$telefonoCasa;
		}
		public function setTelefonoCel($telefonoCel)
		{
			
			$this->telefonoCel=$telefonoCel;
		}
		public function setEdad($edad)
		{
			
			$this->edad=$edad;
		}
		public function setSexo($sexo)
		{
			
			$this->sexo=$sexo;
		}
		public function setSexoMasculino()
		{
			$this->sexo='Masculino';
		}
		public function setSexoFemenino()
		{
			$this->sexo='Femenino';
		}
		public function setFechaNacimiento($fechaNacimiento)
		{
			$this->fechaNacimiento=$fechaNacimiento;
		}
		public function setOcupacion($ocupacion)
		{
			
			$this->ocupacion=$ocupacion;
		}
		public function setCorreo($correo)
		{
			
			$this->correo=$correo;
		}
		public function setIdHojaClinica($idHojaClinica)
		{
			
			$this->idHojaClinica=$idHojaClinica;
		}
		public function setFechaRegistro($fechaRegistro)
		{
			$this->fechaRegistro=$fechaRegistro;
		}
		public function setIdUsuarioRegistro($idUsuarioRegistro)
		{
			
			$this->idUsuarioRegistro=$idUsuarioRegistro;
		}
		public function setIdSucursal($idSucursal)
		{
			
			$this->idSucursal=$idSucursal;
		}
		public function setLlenado($llenado)
		{
			
			$this->llenado=$llenado;
		}
		public function setLlenadoCompleto()
		{
			$this->llenado='Completo';
		}
		public function setLlenadoMinimo()
		{
			$this->llenado='Minimo';
		}
		public function setEstatus($estatus)
		{
			
			$this->estatus=$estatus;
		}
		public function setEstatusActivo()
		{
			$this->estatus='activo';
		}
		public function setEstatusSuspendido()
		{
			$this->estatus='suspendido';
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdPaciente()
		{
			return $this->idPaciente;
		}
		public function getNombre()
		{
			return $this->nombre;
		}
		public function getApellidos()
		{
			return $this->apellidos;
		}
		public function getTelefonoCasa()
		{
			return $this->telefonoCasa;
		}
		public function getTelefonoCel()
		{
			return $this->telefonoCel;
		}
		public function getEdad()
		{
			return $this->edad;
		}
		public function getSexo()
		{
			return $this->sexo;
		}
		public function getFechaNacimiento()
		{
			return $this->fechaNacimiento;
		}
		public function getOcupacion()
		{
			return $this->ocupacion;
		}
		public function getCorreo()
		{
			return $this->correo;
		}
		public function getIdHojaClinica()
		{
			return $this->idHojaClinica;
		}
		public function getFechaRegistro()
		{
			return $this->fechaRegistro;
		}
		public function getIdUsuarioRegistro()
		{
			return $this->idUsuarioRegistro;
		}
		public function getIdSucursal()
		{
			return $this->idSucursal;
		}
		public function getLlenado()
		{
			return $this->llenado;
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
			
			$this->idPaciente=0;
			$this->nombre='';
			$this->apellidos='';
			$this->telefonoCasa='';
			$this->telefonoCel='';
			$this->edad=0;
			$this->sexo='';
			$this->fechaNacimiento='';
			$this->ocupacion='';
			$this->correo='';
			$this->idHojaClinica=0;
			$this->fechaRegistro='';
			$this->idUsuarioRegistro=0;
			$this->idSucursal=0;
			$this->llenado='Completo';
			$this->estatus='activo';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO paciente(nombre,apellidos,telefonoCasa,telefonoCel,edad,sexo,fechaNacimiento,ocupacion,correo,idHojaClinica,fechaRegistro,idUsuarioRegistro,idSucursal,llenado,estatus)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "','" . mysqli_real_escape_string($this->dbLink,$this->apellidos) . "','" . mysqli_real_escape_string($this->dbLink,$this->telefonoCasa) . "','" . mysqli_real_escape_string($this->dbLink,$this->telefonoCel) . "','" . mysqli_real_escape_string($this->dbLink,$this->edad) . "','" . mysqli_real_escape_string($this->dbLink,$this->sexo) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaNacimiento) . "','" . mysqli_real_escape_string($this->dbLink,$this->ocupacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->correo) . "','" . mysqli_real_escape_string($this->dbLink,$this->idHojaClinica) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioRegistro) . "','" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "','" . mysqli_real_escape_string($this->dbLink,$this->llenado) . "','" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBasePaciente::Insertar]");
				
				$this->idPaciente=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE paciente SET nombre='" . mysqli_real_escape_string($this->dbLink,$this->nombre) . "',apellidos='" . mysqli_real_escape_string($this->dbLink,$this->apellidos) . "',telefonoCasa='" . mysqli_real_escape_string($this->dbLink,$this->telefonoCasa) . "',telefonoCel='" . mysqli_real_escape_string($this->dbLink,$this->telefonoCel) . "',edad='" . mysqli_real_escape_string($this->dbLink,$this->edad) . "',sexo='" . mysqli_real_escape_string($this->dbLink,$this->sexo) . "',fechaNacimiento='" . mysqli_real_escape_string($this->dbLink,$this->fechaNacimiento) . "',ocupacion='" . mysqli_real_escape_string($this->dbLink,$this->ocupacion) . "',correo='" . mysqli_real_escape_string($this->dbLink,$this->correo) . "',idHojaClinica='" . mysqli_real_escape_string($this->dbLink,$this->idHojaClinica) . "',fechaRegistro='" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "',idUsuarioRegistro='" . mysqli_real_escape_string($this->dbLink,$this->idUsuarioRegistro) . "',idSucursal='" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "',llenado='" . mysqli_real_escape_string($this->dbLink,$this->llenado) . "',estatus='" . mysqli_real_escape_string($this->dbLink,$this->estatus) . "'
					WHERE idPaciente=" . $this->idPaciente;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBasePaciente::Update]");
				
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
				$SQL="DELETE FROM paciente
				WHERE idPaciente=" . mysqli_real_escape_string($this->dbLink,$this->idPaciente);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBasePaciente::Borrar]");
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
						idPaciente,nombre,apellidos,telefonoCasa,telefonoCel,edad,sexo,fechaNacimiento,ocupacion,correo,idHojaClinica,fechaRegistro,idUsuarioRegistro,idSucursal,llenado,estatus
					FROM paciente
					WHERE idPaciente=" . mysqli_real_escape_string($this->dbLink,$this->idPaciente);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBasePaciente::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idPaciente==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>