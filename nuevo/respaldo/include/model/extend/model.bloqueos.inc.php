<?php

	require FOLDER_MODEL_BASE . "model.base.bloqueos.inc.php";

	class ModeloBloqueos extends ModeloBaseBloqueos
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseBloqueos";

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
		
		public function listaBloqueos()
		{
		    global $objSession;
		    
		    $query = "Select b.idBloqueo, concat_ws(' ', u.nombre, u.apellidos) as nombreUsuario, concat_ws(' ', p.nombre, p.apellidos) as nombreP, 
                        DATE_FORMAT(b.fecha,'%Y-%m-%d') as fecha, DATE_FORMAT(b.fecha,'%H:%i') as hora, s.sucursal, motivo from bloqueos as b
		              inner join paciente as p on p.idPaciente=b.idPaciente 
                     inner join usuario as u on b.idUsuario=u.idUsuario
                        inner join sucursal as s on p.idSucursal=s.idSucursal where b.idSucursal=".$objSession->getIdSucursal();
		              $arreglo = array();
		              $resultado = mysqli_query($this->dbLink, $query);
		              if ($resultado && mysqli_num_rows($resultado) > 0) {
		                  while ($row_inf = mysqli_fetch_assoc($resultado)){
		                      $arreglo[$row_inf['idBloqueo']] = $row_inf  ;
		                  }
		              }
		              return $arreglo;
		}
		
		
		public function buscarPaciente()
		{
		    global $objSession;
		    
		    $query = "Select motivo from bloqueos where idPaciente=".$this->idPaciente;
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        $row_inf = mysqli_fetch_assoc($resultado);
		        return array(true, $row_inf['motivo'])  ;
		        
		    }
		    return array(false)  ;
		}
		

	}

