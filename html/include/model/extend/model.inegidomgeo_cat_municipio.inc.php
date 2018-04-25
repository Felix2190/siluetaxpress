<?php

	require FOLDER_MODEL_BASE . "model.base.inegidomgeo_cat_municipio.inc.php";

	class ModeloInegidomgeo_cat_municipio extends ModeloBaseInegidomgeo_cat_municipio
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseInegidomgeo_cat_municipio";

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



		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
	
		public function getAllByCVE_Est ($cveEstado="")
		{
		    if($cveEstado=="")
		        $cveEstado=$this->CVE_ENT;
		        if(is_null($cveEstado)||$cveEstado=="")
		            return $this->setError("No se especifico el estado para la busqueda de los municipios");
		            
		            $query = "SELECT CVE_MUN,NOM_MUN FROM inegidomgeo_cat_municipio WHERE cve_ent='" . mysqli_real_escape_string($this->dbLink,$cveEstado) . "' ORDER BY NOM_MUN ASC";
		            $result = mysqli_query($this->dbLink,$query);
		            if (! $result)
		                return $this->setSystemError(
		                    "Error en una consulta a la base de datos, intentalo de nueva cuenta mas tarde.",
		                    "[" . $query . "][" . mysql_error() ."]");
		                
		                $retorno = array();
		                while ($row = mysqli_fetch_assoc($result))
		                    $retorno[$row['CVE_MUN']] = $row['NOM_MUN'];
		                    return $retorno;
		}
		
		public function getDatos()
		{
		    try
		    {
		        $SQL="SELECT
						CVE_ENT,CVE_MUN,NOM_MUN
					FROM inegidomgeo_cat_municipio
					WHERE CVE_MUN='" . mysqli_real_escape_string($this->dbLink,$this->CVE_MUN) . "' AND CVE_ENT='" . mysqli_real_escape_string($this->dbLink,$this->CVE_ENT) . "'";
		        
		        $result=mysqli_query($this->dbLink,$SQL);
		        if(!$result)
		            return $this->setSystemError("Error en la obtencion de detalles de registro.","[" . $SQL . "][" . mysqli_error($this->dbLink) . "][" . $this->_nombreClase . "::getDatos]");
		            
		            
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
		
		public function validarDatos()
		{
			return true;
		}


	}

