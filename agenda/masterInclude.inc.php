<?php
define("DEVELOPER", true);
require_once 'include/config/constantes.php';
if (!$sesion&&$__FILE_NAME__!="login"&&$__FILE_NAME__!="loginMovil"&&$__FILE_NAME__!="encuesta"&&!isset($_POST['idEncuesta'])&&$__FILE_NAME__!="ruletaGanadora"&&!isset($_POST['numTel'])&&!isset($_POST['idPacienteRuleta'])&&!isset($_POST['sucursalesRuleta'])&&!isset($_POST['idFranquiciaLogin'])){
    header('Location: login.php');
}
?>