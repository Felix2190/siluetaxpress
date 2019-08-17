<?php

	class ModeloBaseHojaseguimiento extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseHojaseguimiento";

		
		var $idHojaSeguimiento=0;
		var $idPaciente=0;
		var $idUsuario=0;
		var $idSucursal=0;
		var $pesoKg='';
		var $IMC='';
		var $pecho='';
		var $talla='';
		var $cintura='';
		var $abdomen='';
		var $cadera='';
		var $pierna='';
		var $musculo='';
		var $grasa='';
		var $idSintomas=0;
		var $otrosSintomas='';
		var $dieta='';
		var $tratamiento='';
		var $fechaRegistro='';

		var $__s=array("idHojaSeguimiento","idPaciente","idUsuario","idSucursal","pesoKg","IMC","pecho","talla","cintura","abdomen","cadera","pierna","musculo","grasa","idSintomas","otrosSintomas","dieta","tratamiento","fechaRegistro");
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

		
		public function setIdHojaSeguimiento($idHojaSeguimiento)
		{
			if($idHojaSeguimiento==0||$idHojaSeguimiento==""||!is_numeric($idHojaSeguimiento)|| (is_string($idHojaSeguimiento)&&!ctype_digit($idHojaSeguimiento)))return $this->setError("Tipo de dato incorrecto para idHojaSeguimiento.");
			$this->idHojaSeguimiento=$idHojaSeguimiento;
			$this->getDatos();
		}
		public function setIdPaciente($idPaciente)
		{
			
			$this->idPaciente=$idPaciente;
		}
		public function setIdUsuario($idUsuario)
		{
			
			$this->idUsuario=$idUsuario;
		}
		public function setIdSucursal($idSucursal)
		{
			
			$this->idSucursal=$idSucursal;
		}
		public function setPesoKg($pesoKg)
		{
			$this->pesoKg=$pesoKg;
		}
		public function setIMC($IMC)
		{
			$this->IMC=$IMC;
		}
		public function setPecho($pecho)
		{
			$this->pecho=$pecho;
		}
		public function setTalla($talla)
		{
			$this->talla=$talla;
		}
		public function setCintura($cintura)
		{
			$this->cintura=$cintura;
		}
		public function setAbdomen($abdomen)
		{
			$this->abdomen=$abdomen;
		}
		public function setCadera($cadera)
		{
			$this->cadera=$cadera;
		}
		public function setPierna($pierna)
		{
			$this->pierna=$pierna;
		}
		public function setMusculo($musculo)
		{
			$this->musculo=$musculo;
		}
		public function setGrasa($grasa)
		{
			$this->grasa=$grasa;
		}
		public function setIdSintomas($idSintomas)
		{
			
			$this->idSintomas=$idSintomas;
		}
		public function setOtrosSintomas($otrosSintomas)
		{
			$this->otrosSintomas=$otrosSintomas;
		}
		public function setDieta($dieta)
		{
			$this->dieta=$dieta;
		}
		public function setTratamiento($tratamiento)
		{
			$this->tratamiento=$tratamiento;
		}
		public function setFechaRegistro($fechaRegistro)
		{
			$this->fechaRegistro=$fechaRegistro;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdHojaSeguimiento()
		{
			return $this->idHojaSeguimiento;
		}
		public function getIdPaciente()
		{
			return $this->idPaciente;
		}
		public function getIdUsuario()
		{
			return $this->idUsuario;
		}
		public function getIdSucursal()
		{
			return $this->idSucursal;
		}
		public function getPesoKg()
		{
			return $this->pesoKg;
		}
		public function getIMC()
		{
			return $this->IMC;
		}
		public function getPecho()
		{
			return $this->pecho;
		}
		public function getTalla()
		{
			return $this->talla;
		}
		public function getCintura()
		{
			return $this->cintura;
		}
		public function getAbdomen()
		{
			return $this->abdomen;
		}
		public function getCadera()
		{
			return $this->cadera;
		}
		public function getPierna()
		{
			return $this->pierna;
		}
		public function getMusculo()
		{
			return $this->musculo;
		}
		public function getGrasa()
		{
			return $this->grasa;
		}
		public function getIdSintomas()
		{
			return $this->idSintomas;
		}
		public function getOtrosSintomas()
		{
			return $this->otrosSintomas;
		}
		public function getDieta()
		{
			return $this->dieta;
		}
		public function getTratamiento()
		{
			return $this->tratamiento;
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
			
			$this->idHojaSeguimiento=0;
			$this->idPaciente=0;
			$this->idUsuario=0;
			$this->idSucursal=0;
			$this->pesoKg='';
			$this->IMC='';
			$this->pecho='';
			$this->talla='';
			$this->cintura='';
			$this->abdomen='';
			$this->cadera='';
			$this->pierna='';
			$this->musculo='';
			$this->grasa='';
			$this->idSintomas=0;
			$this->otrosSintomas='';
			$this->dieta='';
			$this->tratamiento='';
			$this->fechaRegistro='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO hojaseguimiento(idPaciente,idUsuario,idSucursal,pesoKg,IMC,pecho,talla,cintura,abdomen,cadera,pierna,musculo,grasa,idSintomas,otrosSintomas,dieta,tratamiento,fechaRegistro)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idPaciente) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "','" . mysqli_real_escape_string($this->dbLink,$this->pesoKg) . "','" . mysqli_real_escape_string($this->dbLink,$this->IMC) . "','" . mysqli_real_escape_string($this->dbLink,$this->pecho) . "','" . mysqli_real_escape_string($this->dbLink,$this->talla) . "','" . mysqli_real_escape_string($this->dbLink,$this->cintura) . "','" . mysqli_real_escape_string($this->dbLink,$this->abdomen) . "','" . mysqli_real_escape_string($this->dbLink,$this->cadera) . "','" . mysqli_real_escape_string($this->dbLink,$this->pierna) . "','" . mysqli_real_escape_string($this->dbLink,$this->musculo) . "','" . mysqli_real_escape_string($this->dbLink,$this->grasa) . "','" . mysqli_real_escape_string($this->dbLink,$this->idSintomas) . "','" . mysqli_real_escape_string($this->dbLink,$this->otrosSintomas) . "','" . mysqli_real_escape_string($this->dbLink,$this->dieta) . "','" . mysqli_real_escape_string($this->dbLink,$this->tratamiento) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseHojaseguimiento::Insertar]");
				
				$this->idHojaSeguimiento=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE hojaseguimiento SET idPaciente='" . mysqli_real_escape_string($this->dbLink,$this->idPaciente) . "',idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "',idSucursal='" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "',pesoKg='" . mysqli_real_escape_string($this->dbLink,$this->pesoKg) . "',IMC='" . mysqli_real_escape_string($this->dbLink,$this->IMC) . "',pecho='" . mysqli_real_escape_string($this->dbLink,$this->pecho) . "',talla='" . mysqli_real_escape_string($this->dbLink,$this->talla) . "',cintura='" . mysqli_real_escape_string($this->dbLink,$this->cintura) . "',abdomen='" . mysqli_real_escape_string($this->dbLink,$this->abdomen) . "',cadera='" . mysqli_real_escape_string($this->dbLink,$this->cadera) . "',pierna='" . mysqli_real_escape_string($this->dbLink,$this->pierna) . "',musculo='" . mysqli_real_escape_string($this->dbLink,$this->musculo) . "',grasa='" . mysqli_real_escape_string($this->dbLink,$this->grasa) . "',idSintomas='" . mysqli_real_escape_string($this->dbLink,$this->idSintomas) . "',otrosSintomas='" . mysqli_real_escape_string($this->dbLink,$this->otrosSintomas) . "',dieta='" . mysqli_real_escape_string($this->dbLink,$this->dieta) . "',tratamiento='" . mysqli_real_escape_string($this->dbLink,$this->tratamiento) . "',fechaRegistro='" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "'
					WHERE idHojaSeguimiento=" . $this->idHojaSeguimiento;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseHojaseguimiento::Update]");
				
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
				$SQL="DELETE FROM hojaseguimiento
				WHERE idHojaSeguimiento=" . mysqli_real_escape_string($this->dbLink,$this->idHojaSeguimiento);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseHojaseguimiento::Borrar]");
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
						idHojaSeguimiento,idPaciente,idUsuario,idSucursal,pesoKg,IMC,pecho,talla,cintura,abdomen,cadera,pierna,musculo,grasa,idSintomas,otrosSintomas,dieta,tratamiento,fechaRegistro
					FROM hojaseguimiento
					WHERE idHojaSeguimiento=" . mysqli_real_escape_string($this->dbLink,$this->idHojaSeguimiento);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseHojaseguimiento::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idHojaSeguimiento==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>