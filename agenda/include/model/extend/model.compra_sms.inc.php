<?php

	require FOLDER_MODEL_BASE . "model.base.compra_sms.inc.php";

	class ModeloCompra_sms extends ModeloBaseCompra_sms
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseCompra_sms";

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
		
		public function validarDatos()
		{
			return true;
		}

		public function obtenerFechaUltimaCompra()
		{
		    
		    $query = "Select fecha_compra from compra_sms order by idCompra desc limit 1";
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        $row_inf = mysqli_fetch_assoc($resultado);
		            return $row_inf['fecha_compra'];
		    }
		    return date("Y-m-d");
		}
		
	}