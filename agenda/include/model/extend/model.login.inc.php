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
                        if ($row['estatus']=='activo') {
                            $query2 = "SELECT s.sucursal,s.idSucursal from usuariosucursal as us 
                                inner join sucursal as s on us.idSucursal=s.idSucursal
                                WHERE idUsuario =" .$row['idUsuario']. " and us.idSucursal =" .$infoUsuario['sucursal']. " and us.estatus ='activo'   LIMIT 1";
                            $result2 = mysqli_query($this->dbLink, $query2);
                            if ($result2&&mysqli_num_rows($result2) == 1) {
                                //actualiza sucursal
                                $query3 = "update usuario set envioPassword=0, idSucursal=" .$infoUsuario['sucursal']. " WHERE idUsuario =" .$row['idUsuario'];
                                mysqli_query($this->dbLink, $query3);
                                
                                $row2= mysqli_fetch_assoc($result2);
                                $arrInfoUsuario['userName'] = $infoUsuario['username'];
                                $arrInfoUsuario['idRol'] = $row['idRol'];
                                $arrInfoUsuario['idSucursal'] = $row2['idSucursal'];
                                $arrInfoUsuario['sucursal'] = $row2['sucursal'];
                                return array(true,$arrInfoUsuario);
                            }else {
                                // sucursal inválida
                                return array(false,'No tiene acceso a esta sucursal');
                            }
                        }else{
                            //_usuario bloqueado
                            return array(false,'Tu cuenta ha sido bloqueada, contacte al administador para activar su cuenta.');
                        }
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
        $query = "Select idUsuario, u.nombre, apellidos, t.nombre as tipoUsuario, sucursal, m.NOM_MUN as lugar, correo, u.idSucursal,abrev from usuario as u
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
    
    function validaPassword($password)
    {
        global $objSession;
        $query = "SELECT * from login WHERE idUsuario =".$objSession->getidUsuario();
        $result = mysqli_query($this->dbLink, $query);
        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $password = hash('sha512', $password . $row['salt']);
            if ($row['password'] == $password) {
                return 'true';
            }
        }
        return 'false';
    }
    
    function cambiaPassword($password)
    {
        global $objSession;
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
        $passwordSalt = hash('sha512', $password. $random_salt);
        
        $query = "update login set password='$passwordSalt', salt='$random_salt' WHERE idUsuario =".$objSession->getidUsuario();
        $result = mysqli_query($this->dbLink, $query);
        if ($result) 
            return 'true';
         
        return 'false';
    }
    
    public function validarCampo($tabla,$campo,$valor)
    {
        $query = "SELECT * from $tabla WHERE $campo ='" . mysqli_real_escape_string($this->dbLink, $valor) . "'  LIMIT 1";
        $result = mysqli_query($this->dbLink, $query);
        //return $query;
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                return 'false';
            }
            return 'true';
        }else {
            return 'false';
        }
    }
    
    public function getDatosByIdUsuario()
    {
        try
        {
            $SQL="SELECT
						idLogin,idUsuario,userName,password,salt,idRol,estatus
					FROM login
					WHERE idUsuario=" . mysqli_real_escape_string($this->dbLink,$this->idUsuario);
            
            $result=mysqli_query($this->dbLink,$SQL);
            if(!$result)
                return $this->setSystemError("Error en la obtencion de detalles de registro.","[ModeloBaseLogin::getDatos][" . $SQL . "][" . mysqli_error($this->dbLink) . "]");
                
                
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
    
    
    
    public function validarDatos(){
        return true;
    }
    
    
}