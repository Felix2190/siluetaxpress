<?php
define("DEVELOPER", true);
require_once 'include/config/constantes.php';
if (!$sesion&&$__FILE_NAME__!="login"&&$__FILE_NAME__!="loginMovil"){
    header('Location: login.php');
}
?>