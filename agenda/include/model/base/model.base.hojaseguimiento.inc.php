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
		var $fc='';
		var $pa='';
		var $brazoDer='';
		var $brazoIzq='';
		var $bocaSeca='0';
		var $estrenimiento='0';
		var $cansancio='0';
		var $sueno='0';
		var $mareo='0';
		var $nausea='0';
		var $idSintomas=0;
		var $otrosSintomas='';
		var $dieta='';
		var $tratamiento='';
		var $fechaRegistro='';
		var $fechaSeguimiento='';

		var $__s=array("idHojaSeguimiento","idPaciente","idUsuario","idSucursal","pesoKg","IMC","pecho","talla","cintura","abdomen","cadera","pierna","musculo","grasa","fc","pa","brazoDer","brazoIzq","bocaSeca","estrenimiento","cansancio","sueno","mareo","nausea","idSintomas","otrosSintomas","dieta","tratamiento","fechaRegistro","fechaSeguimiento");
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
		public function setFc($fc)
		{
			$this->fc=$fc;
		}
		public function setPa($pa)
		{
			$this->pa=$pa;
		}
		public function setBrazoDer($brazoDer)
		{
			$this->brazoDer=$brazoDer;
		}
		public function setBrazoIzq($brazoIzq)
		{
			$this->brazoIzq=$brazoIzq;
		}
		public function setBocaSeca()
		{
			$this->bocaSeca=1;
		}
		public function setEstrenimiento()
		{
			$this->estrenimiento=1;
		}
		public function setCansancio()
		{
			$this->cansancio=1;
		}
		public function setSueno()
		{
			$this->sueno=1;
		}
		public function setMareo()
		{
			$this->mareo=1;
		}
		public function setNausea()
		{
			$this->nausea=1;
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
		public function setFechaSeguimiento($fechaSeguimiento)
		{
			$this->fechaSeguimiento=$fechaSeguimiento;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function unsetBocaSeca()
		{
			$this->bocaSeca=0;
		}
		public function unsetEstrenimiento()
		{
			$this->estrenimiento=0;
		}
		public function unsetCansancio()
		{
			$this->cansancio=0;
		}
		public function unsetSueno()
		{
			$this->sueno=0;
		}
		public function unsetMareo()
		{
			$this->mareo=0;
		}
		public function unsetNausea()
		{
			$this->nausea=0;
		}

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
		public function getFc()
		{
			return $this->fc;
		}
		public function getPa()
		{
			return $this->pa;
		}
		public function getBrazoDer()
		{
			return $this->brazoDer;
		}
		public function getBrazoIzq()
		{
			return $this->brazoIzq;
		}
		public function getBocaSeca()
		{
			return $this->bocaSeca;
		}
		public function getEstrenimiento()
		{
			return $this->estrenimiento;
		}
		public function getCansancio()
		{
			return $this->cansancio;
		}
		public function getSueno()
		{
			return $this->sueno;
		}
		public function getMareo()
		{
			return $this->mareo;
		}
		public function getNausea()
		{
			return $this->nausea;
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
		public function getFechaSeguimiento()
		{
			return $this->fechaSeguimiento;
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
			$this->fc='';
			$this->pa='';
			$this->brazoDer='';
			$this->brazoIzq='';
			$this->bocaSeca='0';
			$this->estrenimiento='0';
			$this->cansancio='0';
			$this->sueno='0';
			$this->mareo='0';
			$this->nausea='0';
			$this->idSintomas=0;
			$this->otrosSintomas='';
			$this->dieta='';
			$this->tratamiento='';
			$this->fechaRegistro='';
			$this->fechaSeguimiento='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO hojaseguimiento(idPaciente,idUsuario,idSucursal,pesoKg,IMC,pecho,talla,cintura,abdomen,cadera,pierna,musculo,grasa,fc,pa,brazoDer,brazoIzq,bocaSeca,estrenimiento,cansancio,sueno,mareo,nausea,idSintomas,otrosSintomas,dieta,tratamiento,fechaRegistro,fechaSeguimiento)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->idPaciente) . "','" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "','" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "','" . mysqli_real_escape_string($this->dbLink,$this->pesoKg) . "','" . mysqli_real_escape_string($this->dbLink,$this->IMC) . "','" . mysqli_real_escape_string($this->dbLink,$this->pecho) . "','" . mysqli_real_escape_string($this->dbLink,$this->talla) . "','" . mysqli_real_escape_string($this->dbLink,$this->cintura) . "','" . mysqli_real_escape_string($this->dbLink,$this->abdomen) . "','" . mysqli_real_escape_string($this->dbLink,$this->cadera) . "','" . mysqli_real_escape_string($this->dbLink,$this->pierna) . "','" . mysqli_real_escape_string($this->dbLink,$this->musculo) . "','" . mysqli_real_escape_string($this->dbLink,$this->grasa) . "','" . mysqli_real_escape_string($this->dbLink,$this->fc) . "','" . mysqli_real_escape_string($this->dbLink,$this->pa) . "','" . mysqli_real_escape_string($this->dbLink,$this->brazoDer) . "','" . mysqli_real_escape_string($this->dbLink,$this->brazoIzq) . "','" . mysqli_real_escape_string($this->dbLink,$this->bocaSeca) . "','" . mysqli_real_escape_string($this->dbLink,$this->estrenimiento) . "','" . mysqli_real_escape_string($this->dbLink,$this->cansancio) . "','" . mysqli_real_escape_string($this->dbLink,$this->sueno) . "','" . mysqli_real_escape_string($this->dbLink,$this->mareo) . "','" . mysqli_real_escape_string($this->dbLink,$this->nausea) . "','" . mysqli_real_escape_string($this->dbLink,$this->idSintomas) . "','" . mysqli_real_escape_string($this->dbLink,$this->otrosSintomas) . "','" . mysqli_real_escape_string($this->dbLink,$this->dieta) . "','" . mysqli_real_escape_string($this->dbLink,$this->tratamiento) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "','" . mysqli_real_escape_string($this->dbLink,$this->fechaSeguimiento) . "')";
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
				$SQL="UPDATE hojaseguimiento SET idPaciente='" . mysqli_real_escape_string($this->dbLink,$this->idPaciente) . "',idUsuario='" . mysqli_real_escape_string($this->dbLink,$this->idUsuario) . "',idSucursal='" . mysqli_real_escape_string($this->dbLink,$this->idSucursal) . "',pesoKg='" . mysqli_real_escape_string($this->dbLink,$this->pesoKg) . "',IMC='" . mysqli_real_escape_string($this->dbLink,$this->IMC) . "',pecho='" . mysqli_real_escape_string($this->dbLink,$this->pecho) . "',talla='" . mysqli_real_escape_string($this->dbLink,$this->talla) . "',cintura='" . mysqli_real_escape_string($this->dbLink,$this->cintura) . "',abdomen='" . mysqli_real_escape_string($this->dbLink,$this->abdomen) . "',cadera='" . mysqli_real_escape_string($this->dbLink,$this->cadera) . "',pierna='" . mysqli_real_escape_string($this->dbLink,$this->pierna) . "',musculo='" . mysqli_real_escape_string($this->dbLink,$this->musculo) . "',grasa='" . mysqli_real_escape_string($this->dbLink,$this->grasa) . "',fc='" . mysqli_real_escape_string($this->dbLink,$this->fc) . "',pa='" . mysqli_real_escape_string($this->dbLink,$this->pa) . "',brazoDer='" . mysqli_real_escape_string($this->dbLink,$this->brazoDer) . "',brazoIzq='" . mysqli_real_escape_string($this->dbLink,$this->brazoIzq) . "',bocaSeca='" . mysqli_real_escape_string($this->dbLink,$this->bocaSeca) . "',estrenimiento='" . mysqli_real_escape_string($this->dbLink,$this->estrenimiento) . "',cansancio='" . mysqli_real_escape_string($this->dbLink,$this->cansancio) . "',sueno='" . mysqli_real_escape_string($this->dbLink,$this->sueno) . "',mareo='" . mysqli_real_escape_string($this->dbLink,$this->mareo) . "',nausea='" . mysqli_real_escape_string($this->dbLink,$this->nausea) . "',idSintomas='" . mysqli_real_escape_string($this->dbLink,$this->idSintomas) . "',otrosSintomas='" . mysqli_real_escape_string($this->dbLink,$this->otrosSintomas) . "',dieta='" . mysqli_real_escape_string($this->dbLink,$this->dieta) . "',tratamiento='" . mysqli_real_escape_string($this->dbLink,$this->tratamiento) . "',fechaRegistro='" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "',fechaSeguimiento='" . mysqli_real_escape_string($this->dbLink,$this->fechaSeguimiento) . "'
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
						idHojaSeguimiento,idPaciente,idUsuario,idSucursal,pesoKg,IMC,pecho,talla,cintura,abdomen,cadera,pierna,musculo,grasa,fc,pa,brazoDer,brazoIzq,bocaSeca,estrenimiento,cansancio,sueno,mareo,nausea,idSintomas,otrosSintomas,dieta,tratamiento,fechaRegistro,fechaSeguimiento
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