<?php

	class ModeloBaseSeguimiento_sintomas extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseSeguimiento_sintomas";

		
		var $idSeguimientoSintoma=0;
		var $estrenimiento='sinrespuesta';
		var $cansancio='sinrespuesta';
		var $sueno='sinrespuesta';
		var $mareo='sinrespuesta';
		var $nausea='sinrespuesta';
		var $bocaSeca='sinrespuesta';

		var $__s=array("idSeguimientoSintoma","estrenimiento","cansancio","sueno","mareo","nausea","bocaSeca");
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

		
		public function setIdSeguimientoSintoma($idSeguimientoSintoma)
		{
			if($idSeguimientoSintoma==0||$idSeguimientoSintoma==""||!is_numeric($idSeguimientoSintoma)|| (is_string($idSeguimientoSintoma)&&!ctype_digit($idSeguimientoSintoma)))return $this->setError("Tipo de dato incorrecto para idSeguimientoSintoma.");
			$this->idSeguimientoSintoma=$idSeguimientoSintoma;
			$this->getDatos();
		}
		public function setEstrenimiento($estrenimiento)
		{
			
			$this->estrenimiento=$estrenimiento;
		}
		public function setEstrenimientoSi()
		{
			$this->estrenimiento='Si';
		}
		public function setEstrenimientoNo()
		{
			$this->estrenimiento='No';
		}
		public function setEstrenimientoSinrespuesta()
		{
			$this->estrenimiento='sinrespuesta';
		}
		public function setCansancio($cansancio)
		{
			
			$this->cansancio=$cansancio;
		}
		public function setCansancioSi()
		{
			$this->cansancio='Si';
		}
		public function setCansancioNo()
		{
			$this->cansancio='No';
		}
		public function setCansancioSinrespuesta()
		{
			$this->cansancio='sinrespuesta';
		}
		public function setSueno($sueno)
		{
			
			$this->sueno=$sueno;
		}
		public function setSuenoSi()
		{
			$this->sueno='Si';
		}
		public function setSuenoNo()
		{
			$this->sueno='No';
		}
		public function setSuenoSinrespuesta()
		{
			$this->sueno='sinrespuesta';
		}
		public function setMareo($mareo)
		{
			
			$this->mareo=$mareo;
		}
		public function setMareoSi()
		{
			$this->mareo='Si';
		}
		public function setMareoNo()
		{
			$this->mareo='No';
		}
		public function setMareoSinrespuesta()
		{
			$this->mareo='sinrespuesta';
		}
		public function setNausea($nausea)
		{
			
			$this->nausea=$nausea;
		}
		public function setNauseaSi()
		{
			$this->nausea='Si';
		}
		public function setNauseaNo()
		{
			$this->nausea='No';
		}
		public function setNauseaSinrespuesta()
		{
			$this->nausea='sinrespuesta';
		}
		public function setBocaSeca($bocaSeca)
		{
			
			$this->bocaSeca=$bocaSeca;
		}
		public function setBocaSecaSi()
		{
			$this->bocaSeca='Si';
		}
		public function setBocaSecaNo()
		{
			$this->bocaSeca='No';
		}
		public function setBocaSecaSinrespuesta()
		{
			$this->bocaSeca='sinrespuesta';
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdSeguimientoSintoma()
		{
			return $this->idSeguimientoSintoma;
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
		public function getBocaSeca()
		{
			return $this->bocaSeca;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idSeguimientoSintoma=0;
			$this->estrenimiento='sinrespuesta';
			$this->cansancio='sinrespuesta';
			$this->sueno='sinrespuesta';
			$this->mareo='sinrespuesta';
			$this->nausea='sinrespuesta';
			$this->bocaSeca='sinrespuesta';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO seguimiento_sintomas(estrenimiento,cansancio,sueno,mareo,nausea,bocaSeca)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->estrenimiento) . "','" . mysqli_real_escape_string($this->dbLink,$this->cansancio) . "','" . mysqli_real_escape_string($this->dbLink,$this->sueno) . "','" . mysqli_real_escape_string($this->dbLink,$this->mareo) . "','" . mysqli_real_escape_string($this->dbLink,$this->nausea) . "','" . mysqli_real_escape_string($this->dbLink,$this->bocaSeca) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseSeguimiento_sintomas::Insertar]");
				
				$this->idSeguimientoSintoma=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE seguimiento_sintomas SET estrenimiento='" . mysqli_real_escape_string($this->dbLink,$this->estrenimiento) . "',cansancio='" . mysqli_real_escape_string($this->dbLink,$this->cansancio) . "',sueno='" . mysqli_real_escape_string($this->dbLink,$this->sueno) . "',mareo='" . mysqli_real_escape_string($this->dbLink,$this->mareo) . "',nausea='" . mysqli_real_escape_string($this->dbLink,$this->nausea) . "',bocaSeca='" . mysqli_real_escape_string($this->dbLink,$this->bocaSeca) . "'
					WHERE idSeguimientoSintoma=" . $this->idSeguimientoSintoma;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseSeguimiento_sintomas::Update]");
				
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
				$SQL="DELETE FROM seguimiento_sintomas
				WHERE idSeguimientoSintoma=" . mysqli_real_escape_string($this->dbLink,$this->idSeguimientoSintoma);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseSeguimiento_sintomas::Borrar]");
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
						idSeguimientoSintoma,estrenimiento,cansancio,sueno,mareo,nausea,bocaSeca
					FROM seguimiento_sintomas
					WHERE idSeguimientoSintoma=" . mysqli_real_escape_string($this->dbLink,$this->idSeguimientoSintoma);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseSeguimiento_sintomas::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idSeguimientoSintoma==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>