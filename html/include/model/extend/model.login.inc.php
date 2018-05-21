<?php
require FOLDER_MODEL_BASE . "model.base.login.inc.php";

class ModeloLogin extends ModeloBaseLogin
{

    // ------------------------------------------------------------------------------------------------------#
    // ----------------------------------------------Propiedades---------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    var $_nombreClase = "ModeloBaseLogin";

    var $__ss = array();

    // ------------------------------------------------------------------------------------------------------#
    // --------------------------------------------Inicializacion--------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {}

    // ------------------------------------------------------------------------------------------------------#
    // ------------------------------------------------Setter------------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    
    // ------------------------------------------------------------------------------------------------------#
    // -----------------------------------------------Unsetter-----------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    
    // ------------------------------------------------------------------------------------------------------#
    // ------------------------------------------------Getter------------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    
    // ------------------------------------------------------------------------------------------------------#
    // ------------------------------------------------Querys------------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    
    // ------------------------------------------------------------------------------------------------------#
    // ------------------------------------------------Otras-------------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    public function validarUsuarioPassword($infoUsuario)
    {
        $query = "SELECT * from login WHERE userName ='" . mysqli_real_escape_string($this->dbLink, $infoUsuario['username']) . "'  LIMIT 1";
        // die($query);
        // return $query;
        $result = mysqli_query($this->dbLink, $query);
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $password = hash('sha512', $infoUsuario['password'] . $row['salt']);
                if ($row['password'] == $password) {
                    $arrInfoUsuario =$this->obtenerDatosUsuario($row['idUsuario']);
                    if (count($arrInfoUsuario) > 0) {
                        $arrInfoUsuario['userName'] = $infoUsuario['username'];
                        $arrInfoUsuario['idRol'] = $row['idRol'];
                        return array(true,$arrInfoUsuario);
                    }else {
                        // error al encontrar el usuario
                        return array(false,'Error al cargar los datos del usuario');
                    }
                } else {
                    // contraseña incorrecta
                    return array(false,'La contrase&ntilde;a ingresada es incorrecta');
                }
            } else {
                // El usuario no existe.
                return array(false,'El usuario no se encontr&oacute; en el sistema');
            }
        } else {
            // die("[" . $query . "]" . mysqli_error($mysqli));
            return array(false,mysqli_error($mysqli));
        }
    }

    public function obtenerDatosUsuario($idUsuario)
    {
        $query = "Select idUsuario, u.nombre, apellidos, t.nombre as tipoUsuario, sucursal, m.NOM_MUN as lugar, correo, u.idSucursal from usuario as u
    		inner join tipousuario as t on u.idTipoUsuario=t.idTipoUsuario inner join sucursal as s on u.idSucursal=s.idSucursal
	       	inner join inegidomgeo_cat_municipio as m on CVE_ENT=cveEstado and CVE_MUN=cveMunicipio
            where idUsuario=" . $idUsuario;
        $arreglo = array();
        $resultado = mysqli_query($this->dbLink, $query);
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $row_inf = mysqli_fetch_assoc($resultado);
            $arreglo = $row_inf;
        }
        return $arreglo;
    }
}

