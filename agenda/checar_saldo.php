<?php
define("DEVELOPER",false);
date_default_timezone_set('America/Mexico_City');
//require_once 'include/config/constantes.php';
if (! DEVELOPER) {
    define("FOLDER_INCLUDE", "/var/www/vhosts/siluetaexpress.com.mx/agenda.siluetaexpress.com.mx/include/");
    define("FOLDER_INCLUDE_AGENDA", "/var/www/vhosts/siluetaexpress.com.mx/agenda.siluetaexpress.com.mx/include/"); //agenda
    
} else {
    define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "/siluetaxpress/html/include/");
    define("FOLDER_INCLUDE_AGENDA", $_SERVER['DOCUMENT_ROOT'] . "/siluetaxpress/html/agenda/include/"); //agenda
}

define("CLASS_CONEXION", FOLDER_INCLUDE.'Conexion/Conexion.php');

require_once CLASS_CONEXION;
require_once FOLDER_INCLUDE_AGENDA.'controler/funcionesSMS.php';
$fecha=date("Y-m-d");

$arrSaldo=consultaCredito();

if($arrSaldo[0]){ // si hay una respuesta positiva
    $saldo_actual= doubleval($arrSaldo[1]);

    $query = "Select saldo from credito_sms order by fecha desc limit 1 ";
    $Conexion =  new mysqli(BD_HOST,BD_USER,BD_PASS,BD_DB);
    $resultado = mysqli_query($Conexion, $query);
    $saldo_anterior=0;
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $row_inf = mysqli_fetch_assoc($resultado);
            $saldo_anterior=doubleval($row_inf['saldo']);
    }
    
    if ($saldo_actual>$saldo_anterior){ // si se ha comprado crédito
        $diferencia=$saldo_actual-$saldo_anterior;
        $query = "INSERT INTO compra_sms VALUES (null,'$saldo_anterior', '$diferencia', '$saldo_actual','$fecha')";
        mysqli_query($Conexion, $query);
        
    }//else{
        // si no,  solo guarda el saldo actual
        $query = "INSERT INTO credito_sms VALUES ('$fecha', '$saldo_actual')";
        mysqli_query($Conexion, $query);
        
    //}
}

?>