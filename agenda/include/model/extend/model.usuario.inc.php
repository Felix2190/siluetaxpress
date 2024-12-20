<?php

	require FOLDER_MODEL_BASE . "model.base.usuario.inc.php";

	class ModeloUsuario extends ModeloBaseUsuario
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseUsuario";

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
		
		public function obtenerUsuarios()
		{
		    global $objSession;
		    $query = "Select u.idUsuario, concat_ws(' ', u.nombre, u.apellidos) as nombreCompleto, correo, telefonoCel,
                    tu.nombre, s.sucursal from usuario as u 
                    inner join tipousuario as tu on u.idTipoUsuario=tu.idTipoUsuario
                    inner join sucursal as s on u.idSucursal=s.idSucursal where u.idTipoUsuario<>1 and s.idFranquicia=".$objSession->getIdFranquicia();
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $arreglo[] = $row_inf;
		        }
		    }
		    return $arreglo;
		}
		
		//obtener el admin por franquicia
		public function obtenerAdminByFranquicia($idFranquicia)
		{
		    $query = "Select u.idUsuario from usuario as u
                    inner join login as l on u.idUsuario=l.idUsuario
                    where idRol=1 and idFranquicia=".$idFranquicia;
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        $row_inf = mysqli_fetch_assoc($resultado);
		        return $row_inf['idUsuario'];
		    }
		    return 0;
		}
		
		public function obtenerIdsAdmin()
		{
		    $query = "Select idUsuario from login where idRol=1 and idUsuario<>14";
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado))
		        array_push($arreglo, $row_inf['idUsuario']);
		    }
		    return $arreglo;
		}
		
	}

