<?php

	class ModeloBaseHojaclinica extends clsBasicCommon
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="base.ModeloBaseHojaclinica";

		
		var $idHojaClinica=0;
		var $fechaRegistro='';
		var $cirugia='sinrespuesta';
		var $cirugias='';
		var $enfermedades='';
		var $estrenimiento='sinrespuesta';
		var $estrenimientoFrecuencia='0';
		var $menstruacion='sinrespuesta';
		var $alergia='sinrespuesta';
		var $alimento='';
		var $hrsDormir=0;
		var $hrsComer=0;
		var $cafe='sinrespuesta';
		var $cafeFrecuencia='0';
		var $fuma='sinrespuesta';
		var $fumaFrecuencia='0';
		var $beber='sinrespuesta';
		var $beberFrecuencia='0';
		var $desagradables='';
		var $ansiedad='sinrespuesta';
		var $actividadFisica='sinrespuesta';
		var $actividad='';
		var $tiempo=0;
		var $tiempoSimbolo='hrs';
		var $actividadFisicaFrecuencia='0';
		var $motivacion=0;
		var $horarioLevantarse='';
		var $horarioAcostarse='';
		var $horarioActividad='';
		var $desayuno='No';
		var $horarioDesayuno='';
		var $actividadDesayuno='';
		var $colacion='No';
		var $horarioColacion='';
		var $actividadColacion='';
		var $comida='No';
		var $horarioComida='';
		var $actividadComida='';
		var $colacion2='No';
		var $horarioColacion2='';
		var $actividadColacion2='';
		var $cena='No';
		var $horarioCena='';
		var $actividadCena='';
		var $completitud='';

		var $__s=array("idHojaClinica","fechaRegistro","cirugia","cirugias","enfermedades","estrenimiento","estrenimientoFrecuencia","menstruacion","alergia","alimento","hrsDormir","hrsComer","cafe","cafeFrecuencia","fuma","fumaFrecuencia","beber","beberFrecuencia","desagradables","ansiedad","actividadFisica","actividad","tiempo","tiempoSimbolo","actividadFisicaFrecuencia","motivacion","horarioLevantarse","horarioAcostarse","horarioActividad","desayuno","horarioDesayuno","actividadDesayuno","colacion","horarioColacion","actividadColacion","comida","horarioComida","actividadComida","colacion2","horarioColacion2","actividadColacion2","cena","horarioCena","actividadCena","completitud");
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

		
		public function setIdHojaClinica($idHojaClinica)
		{
			if($idHojaClinica==0||$idHojaClinica==""||!is_numeric($idHojaClinica)|| (is_string($idHojaClinica)&&!ctype_digit($idHojaClinica)))return $this->setError("Tipo de dato incorrecto para idHojaClinica.");
			$this->idHojaClinica=$idHojaClinica;
			$this->getDatos();
		}
		public function setFechaRegistro($fechaRegistro)
		{
			$this->fechaRegistro=$fechaRegistro;
		}
		public function setCirugia($cirugia)
		{
			
			$this->cirugia=$cirugia;
		}
		public function setCirugiaSi()
		{
			$this->cirugia='Si';
		}
		public function setCirugiaNo()
		{
			$this->cirugia='No';
		}
		public function setCirugiaSinrespuesta()
		{
			$this->cirugia='sinrespuesta';
		}
		public function setCirugias($cirugias)
		{
			$this->cirugias=$cirugias;
		}
		public function setEnfermedades($enfermedades)
		{
			$this->enfermedades=$enfermedades;
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
		public function setEstrenimientoFrecuencia($estrenimientoFrecuencia)
		{
			
			$this->estrenimientoFrecuencia=$estrenimientoFrecuencia;
		}
		public function setEstrenimientoFrecuencia0()
		{
			$this->estrenimientoFrecuencia='0';
		}
		public function setEstrenimientoFrecuencia1()
		{
			$this->estrenimientoFrecuencia='1';
		}
		public function setEstrenimientoFrecuencia2()
		{
			$this->estrenimientoFrecuencia='2';
		}
		public function setEstrenimientoFrecuencia3()
		{
			$this->estrenimientoFrecuencia='3';
		}
		public function setMenstruacion($menstruacion)
		{
			
			$this->menstruacion=$menstruacion;
		}
		public function setMenstruacionRegular()
		{
			$this->menstruacion='Regular';
		}
		public function setMenstruacionIrregular()
		{
			$this->menstruacion='Irregular';
		}
		public function setMenstruacionMenopausa()
		{
			$this->menstruacion='Menopausa';
		}
		public function setMenstruacionNo()
		{
			$this->menstruacion='No';
		}
		public function setMenstruacionSinrespuesta()
		{
			$this->menstruacion='sinrespuesta';
		}
		public function setAlergia($alergia)
		{
			
			$this->alergia=$alergia;
		}
		public function setAlergiaSi()
		{
			$this->alergia='Si';
		}
		public function setAlergiaNo()
		{
			$this->alergia='No';
		}
		public function setAlergiaSinrespuesta()
		{
			$this->alergia='sinrespuesta';
		}
		public function setAlimento($alimento)
		{
			
			$this->alimento=$alimento;
		}
		public function setHrsDormir($hrsDormir)
		{
			
			$this->hrsDormir=$hrsDormir;
		}
		public function setHrsComer($hrsComer)
		{
			
			$this->hrsComer=$hrsComer;
		}
		public function setCafe($cafe)
		{
			
			$this->cafe=$cafe;
		}
		public function setCafeSi()
		{
			$this->cafe='Si';
		}
		public function setCafeNo()
		{
			$this->cafe='No';
		}
		public function setCafeSinrespuesta()
		{
			$this->cafe='sinrespuesta';
		}
		public function setCafeFrecuencia($cafeFrecuencia)
		{
			
			$this->cafeFrecuencia=$cafeFrecuencia;
		}
		public function setCafeFrecuencia0()
		{
			$this->cafeFrecuencia='0';
		}
		public function setCafeFrecuencia1()
		{
			$this->cafeFrecuencia='1';
		}
		public function setCafeFrecuencia2()
		{
			$this->cafeFrecuencia='2';
		}
		public function setCafeFrecuencia3()
		{
			$this->cafeFrecuencia='3';
		}
		public function setFuma($fuma)
		{
			
			$this->fuma=$fuma;
		}
		public function setFumaSi()
		{
			$this->fuma='Si';
		}
		public function setFumaNo()
		{
			$this->fuma='No';
		}
		public function setFumaSinrespuesta()
		{
			$this->fuma='sinrespuesta';
		}
		public function setFumaFrecuencia($fumaFrecuencia)
		{
			
			$this->fumaFrecuencia=$fumaFrecuencia;
		}
		public function setFumaFrecuencia0()
		{
			$this->fumaFrecuencia='0';
		}
		public function setFumaFrecuencia1()
		{
			$this->fumaFrecuencia='1';
		}
		public function setFumaFrecuencia2()
		{
			$this->fumaFrecuencia='2';
		}
		public function setFumaFrecuencia3()
		{
			$this->fumaFrecuencia='3';
		}
		public function setBeber($beber)
		{
			
			$this->beber=$beber;
		}
		public function setBeberSi()
		{
			$this->beber='Si';
		}
		public function setBeberNo()
		{
			$this->beber='No';
		}
		public function setBeberSinrespuesta()
		{
			$this->beber='sinrespuesta';
		}
		public function setBeberFrecuencia($beberFrecuencia)
		{
			
			$this->beberFrecuencia=$beberFrecuencia;
		}
		public function setBeberFrecuencia0()
		{
			$this->beberFrecuencia='0';
		}
		public function setBeberFrecuencia1()
		{
			$this->beberFrecuencia='1';
		}
		public function setBeberFrecuencia2()
		{
			$this->beberFrecuencia='2';
		}
		public function setBeberFrecuencia3()
		{
			$this->beberFrecuencia='3';
		}
		public function setDesagradables($desagradables)
		{
			$this->desagradables=$desagradables;
		}
		public function setAnsiedad($ansiedad)
		{
			
			$this->ansiedad=$ansiedad;
		}
		public function setAnsiedadSi()
		{
			$this->ansiedad='Si';
		}
		public function setAnsiedadNo()
		{
			$this->ansiedad='No';
		}
		public function setAnsiedadSinrespuesta()
		{
			$this->ansiedad='sinrespuesta';
		}
		public function setActividadFisica($actividadFisica)
		{
			
			$this->actividadFisica=$actividadFisica;
		}
		public function setActividadFisicaSi()
		{
			$this->actividadFisica='Si';
		}
		public function setActividadFisicaNo()
		{
			$this->actividadFisica='No';
		}
		public function setActividadFisicaSinrespuesta()
		{
			$this->actividadFisica='sinrespuesta';
		}
		public function setActividad($actividad)
		{
			
			$this->actividad=$actividad;
		}
		public function setTiempo($tiempo)
		{
			
			$this->tiempo=$tiempo;
		}
		public function setTiempoSimbolo($tiempoSimbolo)
		{
			
			$this->tiempoSimbolo=$tiempoSimbolo;
		}
		public function setTiempoSimboloHrs()
		{
			$this->tiempoSimbolo='hrs';
		}
		public function setTiempoSimboloMin()
		{
			$this->tiempoSimbolo='min';
		}
		public function setActividadFisicaFrecuencia($actividadFisicaFrecuencia)
		{
			
			$this->actividadFisicaFrecuencia=$actividadFisicaFrecuencia;
		}
		public function setActividadFisicaFrecuencia0()
		{
			$this->actividadFisicaFrecuencia='0';
		}
		public function setActividadFisicaFrecuencia1()
		{
			$this->actividadFisicaFrecuencia='1';
		}
		public function setActividadFisicaFrecuencia2()
		{
			$this->actividadFisicaFrecuencia='2';
		}
		public function setActividadFisicaFrecuencia3()
		{
			$this->actividadFisicaFrecuencia='3';
		}
		public function setMotivacion($motivacion)
		{
			
			$this->motivacion=$motivacion;
		}
		public function setHorarioLevantarse($horarioLevantarse)
		{
			
			$this->horarioLevantarse=$horarioLevantarse;
		}
		public function setHorarioAcostarse($horarioAcostarse)
		{
			
			$this->horarioAcostarse=$horarioAcostarse;
		}
		public function setHorarioActividad($horarioActividad)
		{
			
			$this->horarioActividad=$horarioActividad;
		}
		public function setDesayuno($desayuno)
		{
			
			$this->desayuno=$desayuno;
		}
		public function setDesayunoSi()
		{
			$this->desayuno='Si';
		}
		public function setDesayunoNo()
		{
			$this->desayuno='No';
		}
		public function setHorarioDesayuno($horarioDesayuno)
		{
			
			$this->horarioDesayuno=$horarioDesayuno;
		}
		public function setActividadDesayuno($actividadDesayuno)
		{
			$this->actividadDesayuno=$actividadDesayuno;
		}
		public function setColacion($colacion)
		{
			
			$this->colacion=$colacion;
		}
		public function setColacionSi()
		{
			$this->colacion='Si';
		}
		public function setColacionNo()
		{
			$this->colacion='No';
		}
		public function setHorarioColacion($horarioColacion)
		{
			
			$this->horarioColacion=$horarioColacion;
		}
		public function setActividadColacion($actividadColacion)
		{
			$this->actividadColacion=$actividadColacion;
		}
		public function setComida($comida)
		{
			
			$this->comida=$comida;
		}
		public function setComidaSi()
		{
			$this->comida='Si';
		}
		public function setComidaNo()
		{
			$this->comida='No';
		}
		public function setHorarioComida($horarioComida)
		{
			
			$this->horarioComida=$horarioComida;
		}
		public function setActividadComida($actividadComida)
		{
			$this->actividadComida=$actividadComida;
		}
		public function setColacion2($colacion2)
		{
			
			$this->colacion2=$colacion2;
		}
		public function setColacion2Si()
		{
			$this->colacion2='Si';
		}
		public function setColacion2No()
		{
			$this->colacion2='No';
		}
		public function setHorarioColacion2($horarioColacion2)
		{
			
			$this->horarioColacion2=$horarioColacion2;
		}
		public function setActividadColacion2($actividadColacion2)
		{
			$this->actividadColacion2=$actividadColacion2;
		}
		public function setCena($cena)
		{
			
			$this->cena=$cena;
		}
		public function setCenaSi()
		{
			$this->cena='Si';
		}
		public function setCenaNo()
		{
			$this->cena='No';
		}
		public function setHorarioCena($horarioCena)
		{
			
			$this->horarioCena=$horarioCena;
		}
		public function setActividadCena($actividadCena)
		{
			$this->actividadCena=$actividadCena;
		}
		public function setCompletitud($completitud)
		{
			$this->completitud=$completitud;
		}

		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		
		public function getIdHojaClinica()
		{
			return $this->idHojaClinica;
		}
		public function getFechaRegistro()
		{
			return $this->fechaRegistro;
		}
		public function getCirugia()
		{
			return $this->cirugia;
		}
		public function getCirugias()
		{
			return $this->cirugias;
		}
		public function getEnfermedades()
		{
			return $this->enfermedades;
		}
		public function getEstrenimiento()
		{
			return $this->estrenimiento;
		}
		public function getEstrenimientoFrecuencia()
		{
			return $this->estrenimientoFrecuencia;
		}
		public function getMenstruacion()
		{
			return $this->menstruacion;
		}
		public function getAlergia()
		{
			return $this->alergia;
		}
		public function getAlimento()
		{
			return $this->alimento;
		}
		public function getHrsDormir()
		{
			return $this->hrsDormir;
		}
		public function getHrsComer()
		{
			return $this->hrsComer;
		}
		public function getCafe()
		{
			return $this->cafe;
		}
		public function getCafeFrecuencia()
		{
			return $this->cafeFrecuencia;
		}
		public function getFuma()
		{
			return $this->fuma;
		}
		public function getFumaFrecuencia()
		{
			return $this->fumaFrecuencia;
		}
		public function getBeber()
		{
			return $this->beber;
		}
		public function getBeberFrecuencia()
		{
			return $this->beberFrecuencia;
		}
		public function getDesagradables()
		{
			return $this->desagradables;
		}
		public function getAnsiedad()
		{
			return $this->ansiedad;
		}
		public function getActividadFisica()
		{
			return $this->actividadFisica;
		}
		public function getActividad()
		{
			return $this->actividad;
		}
		public function getTiempo()
		{
			return $this->tiempo;
		}
		public function getTiempoSimbolo()
		{
			return $this->tiempoSimbolo;
		}
		public function getActividadFisicaFrecuencia()
		{
			return $this->actividadFisicaFrecuencia;
		}
		public function getMotivacion()
		{
			return $this->motivacion;
		}
		public function getHorarioLevantarse()
		{
			return $this->horarioLevantarse;
		}
		public function getHorarioAcostarse()
		{
			return $this->horarioAcostarse;
		}
		public function getHorarioActividad()
		{
			return $this->horarioActividad;
		}
		public function getDesayuno()
		{
			return $this->desayuno;
		}
		public function getHorarioDesayuno()
		{
			return $this->horarioDesayuno;
		}
		public function getActividadDesayuno()
		{
			return $this->actividadDesayuno;
		}
		public function getColacion()
		{
			return $this->colacion;
		}
		public function getHorarioColacion()
		{
			return $this->horarioColacion;
		}
		public function getActividadColacion()
		{
			return $this->actividadColacion;
		}
		public function getComida()
		{
			return $this->comida;
		}
		public function getHorarioComida()
		{
			return $this->horarioComida;
		}
		public function getActividadComida()
		{
			return $this->actividadComida;
		}
		public function getColacion2()
		{
			return $this->colacion2;
		}
		public function getHorarioColacion2()
		{
			return $this->horarioColacion2;
		}
		public function getActividadColacion2()
		{
			return $this->actividadColacion2;
		}
		public function getCena()
		{
			return $this->cena;
		}
		public function getHorarioCena()
		{
			return $this->horarioCena;
		}
		public function getActividadCena()
		{
			return $this->actividadCena;
		}
		public function getCompletitud()
		{
			return $this->completitud;
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		

		protected function limpiarPropiedades()
		{
			
			$this->idHojaClinica=0;
			$this->fechaRegistro='';
			$this->cirugia='sinrespuesta';
			$this->cirugias='';
			$this->enfermedades='';
			$this->estrenimiento='sinrespuesta';
			$this->estrenimientoFrecuencia='0';
			$this->menstruacion='sinrespuesta';
			$this->alergia='sinrespuesta';
			$this->alimento='';
			$this->hrsDormir=0;
			$this->hrsComer=0;
			$this->cafe='sinrespuesta';
			$this->cafeFrecuencia='0';
			$this->fuma='sinrespuesta';
			$this->fumaFrecuencia='0';
			$this->beber='sinrespuesta';
			$this->beberFrecuencia='0';
			$this->desagradables='';
			$this->ansiedad='sinrespuesta';
			$this->actividadFisica='sinrespuesta';
			$this->actividad='';
			$this->tiempo=0;
			$this->tiempoSimbolo='hrs';
			$this->actividadFisicaFrecuencia='0';
			$this->motivacion=0;
			$this->horarioLevantarse='';
			$this->horarioAcostarse='';
			$this->horarioActividad='';
			$this->desayuno='No';
			$this->horarioDesayuno='';
			$this->actividadDesayuno='';
			$this->colacion='No';
			$this->horarioColacion='';
			$this->actividadColacion='';
			$this->comida='No';
			$this->horarioComida='';
			$this->actividadComida='';
			$this->colacion2='No';
			$this->horarioColacion2='';
			$this->actividadColacion2='';
			$this->cena='No';
			$this->horarioCena='';
			$this->actividadCena='';
			$this->completitud='';
		}

		

		
		protected function Insertar()
		{
			try
			{
				$SQL="INSERT INTO hojaclinica(fechaRegistro,cirugia,cirugias,enfermedades,estrenimiento,estrenimientoFrecuencia,menstruacion,alergia,alimento,hrsDormir,hrsComer,cafe,cafeFrecuencia,fuma,fumaFrecuencia,beber,beberFrecuencia,desagradables,ansiedad,actividadFisica,actividad,tiempo,tiempoSimbolo,actividadFisicaFrecuencia,motivacion,horarioLevantarse,horarioAcostarse,horarioActividad,desayuno,horarioDesayuno,actividadDesayuno,colacion,horarioColacion,actividadColacion,comida,horarioComida,actividadComida,colacion2,horarioColacion2,actividadColacion2,cena,horarioCena,actividadCena,completitud)
						VALUES('" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "','" . mysqli_real_escape_string($this->dbLink,$this->cirugia) . "','" . mysqli_real_escape_string($this->dbLink,$this->cirugias) . "','" . mysqli_real_escape_string($this->dbLink,$this->enfermedades) . "','" . mysqli_real_escape_string($this->dbLink,$this->estrenimiento) . "','" . mysqli_real_escape_string($this->dbLink,$this->estrenimientoFrecuencia) . "','" . mysqli_real_escape_string($this->dbLink,$this->menstruacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->alergia) . "','" . mysqli_real_escape_string($this->dbLink,$this->alimento) . "','" . mysqli_real_escape_string($this->dbLink,$this->hrsDormir) . "','" . mysqli_real_escape_string($this->dbLink,$this->hrsComer) . "','" . mysqli_real_escape_string($this->dbLink,$this->cafe) . "','" . mysqli_real_escape_string($this->dbLink,$this->cafeFrecuencia) . "','" . mysqli_real_escape_string($this->dbLink,$this->fuma) . "','" . mysqli_real_escape_string($this->dbLink,$this->fumaFrecuencia) . "','" . mysqli_real_escape_string($this->dbLink,$this->beber) . "','" . mysqli_real_escape_string($this->dbLink,$this->beberFrecuencia) . "','" . mysqli_real_escape_string($this->dbLink,$this->desagradables) . "','" . mysqli_real_escape_string($this->dbLink,$this->ansiedad) . "','" . mysqli_real_escape_string($this->dbLink,$this->actividadFisica) . "','" . mysqli_real_escape_string($this->dbLink,$this->actividad) . "','" . mysqli_real_escape_string($this->dbLink,$this->tiempo) . "','" . mysqli_real_escape_string($this->dbLink,$this->tiempoSimbolo) . "','" . mysqli_real_escape_string($this->dbLink,$this->actividadFisicaFrecuencia) . "','" . mysqli_real_escape_string($this->dbLink,$this->motivacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->horarioLevantarse) . "','" . mysqli_real_escape_string($this->dbLink,$this->horarioAcostarse) . "','" . mysqli_real_escape_string($this->dbLink,$this->horarioActividad) . "','" . mysqli_real_escape_string($this->dbLink,$this->desayuno) . "','" . mysqli_real_escape_string($this->dbLink,$this->horarioDesayuno) . "','" . mysqli_real_escape_string($this->dbLink,$this->actividadDesayuno) . "','" . mysqli_real_escape_string($this->dbLink,$this->colacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->horarioColacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->actividadColacion) . "','" . mysqli_real_escape_string($this->dbLink,$this->comida) . "','" . mysqli_real_escape_string($this->dbLink,$this->horarioComida) . "','" . mysqli_real_escape_string($this->dbLink,$this->actividadComida) . "','" . mysqli_real_escape_string($this->dbLink,$this->colacion2) . "','" . mysqli_real_escape_string($this->dbLink,$this->horarioColacion2) . "','" . mysqli_real_escape_string($this->dbLink,$this->actividadColacion2) . "','" . mysqli_real_escape_string($this->dbLink,$this->cena) . "','" . mysqli_real_escape_string($this->dbLink,$this->horarioCena) . "','" . mysqli_real_escape_string($this->dbLink,$this->actividadCena) . "','" . mysqli_real_escape_string($this->dbLink,$this->completitud) . "')";
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la insercion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseHojaclinica::Insertar]");
				
				$this->idHojaClinica=mysqli_insert_id($this->dbLink);
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
				$SQL="UPDATE hojaclinica SET fechaRegistro='" . mysqli_real_escape_string($this->dbLink,$this->fechaRegistro) . "',cirugia='" . mysqli_real_escape_string($this->dbLink,$this->cirugia) . "',cirugias='" . mysqli_real_escape_string($this->dbLink,$this->cirugias) . "',enfermedades='" . mysqli_real_escape_string($this->dbLink,$this->enfermedades) . "',estrenimiento='" . mysqli_real_escape_string($this->dbLink,$this->estrenimiento) . "',estrenimientoFrecuencia='" . mysqli_real_escape_string($this->dbLink,$this->estrenimientoFrecuencia) . "',menstruacion='" . mysqli_real_escape_string($this->dbLink,$this->menstruacion) . "',alergia='" . mysqli_real_escape_string($this->dbLink,$this->alergia) . "',alimento='" . mysqli_real_escape_string($this->dbLink,$this->alimento) . "',hrsDormir='" . mysqli_real_escape_string($this->dbLink,$this->hrsDormir) . "',hrsComer='" . mysqli_real_escape_string($this->dbLink,$this->hrsComer) . "',cafe='" . mysqli_real_escape_string($this->dbLink,$this->cafe) . "',cafeFrecuencia='" . mysqli_real_escape_string($this->dbLink,$this->cafeFrecuencia) . "',fuma='" . mysqli_real_escape_string($this->dbLink,$this->fuma) . "',fumaFrecuencia='" . mysqli_real_escape_string($this->dbLink,$this->fumaFrecuencia) . "',beber='" . mysqli_real_escape_string($this->dbLink,$this->beber) . "',beberFrecuencia='" . mysqli_real_escape_string($this->dbLink,$this->beberFrecuencia) . "',desagradables='" . mysqli_real_escape_string($this->dbLink,$this->desagradables) . "',ansiedad='" . mysqli_real_escape_string($this->dbLink,$this->ansiedad) . "',actividadFisica='" . mysqli_real_escape_string($this->dbLink,$this->actividadFisica) . "',actividad='" . mysqli_real_escape_string($this->dbLink,$this->actividad) . "',tiempo='" . mysqli_real_escape_string($this->dbLink,$this->tiempo) . "',tiempoSimbolo='" . mysqli_real_escape_string($this->dbLink,$this->tiempoSimbolo) . "',actividadFisicaFrecuencia='" . mysqli_real_escape_string($this->dbLink,$this->actividadFisicaFrecuencia) . "',motivacion='" . mysqli_real_escape_string($this->dbLink,$this->motivacion) . "',horarioLevantarse='" . mysqli_real_escape_string($this->dbLink,$this->horarioLevantarse) . "',horarioAcostarse='" . mysqli_real_escape_string($this->dbLink,$this->horarioAcostarse) . "',horarioActividad='" . mysqli_real_escape_string($this->dbLink,$this->horarioActividad) . "',desayuno='" . mysqli_real_escape_string($this->dbLink,$this->desayuno) . "',horarioDesayuno='" . mysqli_real_escape_string($this->dbLink,$this->horarioDesayuno) . "',actividadDesayuno='" . mysqli_real_escape_string($this->dbLink,$this->actividadDesayuno) . "',colacion='" . mysqli_real_escape_string($this->dbLink,$this->colacion) . "',horarioColacion='" . mysqli_real_escape_string($this->dbLink,$this->horarioColacion) . "',actividadColacion='" . mysqli_real_escape_string($this->dbLink,$this->actividadColacion) . "',comida='" . mysqli_real_escape_string($this->dbLink,$this->comida) . "',horarioComida='" . mysqli_real_escape_string($this->dbLink,$this->horarioComida) . "',actividadComida='" . mysqli_real_escape_string($this->dbLink,$this->actividadComida) . "',colacion2='" . mysqli_real_escape_string($this->dbLink,$this->colacion2) . "',horarioColacion2='" . mysqli_real_escape_string($this->dbLink,$this->horarioColacion2) . "',actividadColacion2='" . mysqli_real_escape_string($this->dbLink,$this->actividadColacion2) . "',cena='" . mysqli_real_escape_string($this->dbLink,$this->cena) . "',horarioCena='" . mysqli_real_escape_string($this->dbLink,$this->horarioCena) . "',actividadCena='" . mysqli_real_escape_string($this->dbLink,$this->actividadCena) . "',completitud='" . mysqli_real_escape_string($this->dbLink,$this->completitud) . "'
					WHERE idHojaClinica=" . $this->idHojaClinica;
				
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la actualizacion de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][ModeloBaseHojaclinica::Update]");
				
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
				$SQL="DELETE FROM hojaclinica
				WHERE idHojaClinica=" . mysqli_real_escape_string($this->dbLink,$this->idHojaClinica);
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en el borrado de registro.","[" . $SQL . "][" . mysqli_error() . "][ModeloBaseHojaclinica::Borrar]");
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
						idHojaClinica,fechaRegistro,cirugia,cirugias,enfermedades,estrenimiento,estrenimientoFrecuencia,menstruacion,alergia,alimento,hrsDormir,hrsComer,cafe,cafeFrecuencia,fuma,fumaFrecuencia,beber,beberFrecuencia,desagradables,ansiedad,actividadFisica,actividad,tiempo,tiempoSimbolo,actividadFisicaFrecuencia,motivacion,horarioLevantarse,horarioAcostarse,horarioActividad,desayuno,horarioDesayuno,actividadDesayuno,colacion,horarioColacion,actividadColacion,comida,horarioComida,actividadComida,colacion2,horarioColacion2,actividadColacion2,cena,horarioCena,actividadCena,completitud
					FROM hojaclinica
					WHERE idHojaClinica=" . mysqli_real_escape_string($this->dbLink,$this->idHojaClinica);
					
				$result=mysqli_query($this->dbLink,$SQL);
				if(!$result)
					return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseHojaclinica::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
				

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
			if($this->idHojaClinica==0)
				$this->Insertar();
			else
				$this->Actualizar();
			if($this->getError())
				return false;
			return true;
		}
		
	}

?>