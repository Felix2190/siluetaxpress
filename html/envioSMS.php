<?php

// sDestination: lista de numeros de celular separados por comas.
// Cada numero debe comenzar por el prefijo internacional de pais. Por
// ejemplo: 52 para M�xico.
// sMessage: hasta 160 caracteres
// sSenderId: remitente autorizado por Altiria al dar de alta el servicio. Disponible
// s�lo en ciertos pa�ses. Omitir el parametro si no se cuenta con ninguno.
// debug: Si es true muestra por pantalla la respuesta completa del servidor
// XX, YY y ZZ se corresponden con los valores de identificacion del
// usuario en el sistema. Proporcionados por Altiria al contratar el servicio o solicitar prueba
// Como ejemplo la peticion se envia a www.altiria.net/sustituirPOSTsms
// Se debe reemplazar la cadena '/sustituirPOSTsms' por la parte correspondiente
// de la URL suministrada por Altiria al dar de alta el servicio

function AltiriaSMS($sDestination, $sMessage, $sSenderId, $debug){
    $sData ='cmd=sendsms&';
    $sData .='domainId=siluetaexpress&';
    $sData .='login=lic.lezliedelariva@gmail.com&';
    $sData .='passwd=L7fr9P3sPMw6&';
    // Omitir la linea del remitente (senderId) si no se cuenta con ninguno autorizado
//    $sData .='senderId='.$sSenderId.'&';
    $sData .='dest='.str_replace(',','&dest=',$sDestination).'&';
    $sData .='msg='.urlencode(utf8_encode(substr($sMessage,0,160)));
    
    //Tiempo m�ximo de espera para conectar con el servidor = 5 seg
    $timeOut =5;
    
    $fp = fsockopen('www.altiria.net', 80, $errno, $errstr, $timeOut);
    if (!$fp) {
        //Error de conexion o tiempo maximo de conexion rebasado
        $output = "ERROR de conexion: $errno - $errstr\n";
        $output .= "Compruebe que ha configurado correctamente la direccion/url ";
        $output .= "suministrada por altiria";
        return $output;
    } else {
        // Reemplazar la cadena '/sustituirPOSTsms' por la parte correspondiente
        // de la URL suministrada por Altiria al dar de alta el servicio
        $buf = "POST http://www.altiria.net/api/http HTTP/1.0\r\n";
        $buf .= "Host: www.altiria.net\r\n";
        $buf .= "Content-type: application/x-www-form-urlencoded; charset=UTF-8\r\n";
        $buf .= "Content-length: ".strlen($sData)."\r\n";
        $buf .= "\r\n";
        $buf .= $sData;
        fputs($fp, $buf);
        $buf = "";
        
        //Tiempo m�ximo de espera de respuesta del servidor = 60 seg
        $responseTimeOut = 60;
        stream_set_timeout($fp,$responseTimeOut);
        stream_set_blocking ($fp, true);
        if (!feof($fp)){
            if (($buf=fgets($fp,128))===false){
                // TimeOut?
                $info = stream_get_meta_data($fp);
                if ($info['timed_out']){
                    $output = 'ERROR Tiempo de respuesta agotado';
                    return $output;
                } else {
                    $output = 'ERROR de respuesta';
                    return $output;
                }
            } else{
                while(!feof($fp)){
                    $buf.=fgets($fp,128);
                }
            }
        } else {
            $output = 'ERROR de respuesta';
            return $output;
        }
        
        fclose($fp);
        
        //Si la llamada se hace con debug, se muestra la respuesta completa del servidor
        if ($debug){
            print "Respuesta del servidor: ".$buf."";
        }
        
        //Se comprueba que se ha conectado realmente con el servidor
        //y que se obtenga un codigo HTTP OK 200
        if (strpos($buf,"HTTP/1.1 200 OK") === false){
            $output = "ERROR. Codigo error HTTP: ".substr($buf,9,3)."\n";
            $output .= "Compruebe que ha configurado correctamente la direccion/url ";
            $output .= "suministrada por Altiria";
            return $output;
        }
        //Se comprueba la respuesta de Altiria
        if (strstr($buf,"ERROR")){
            $output = $buf."<br />\n";
            $output .= " Ha ocurrido algun error. Compruebe la especificacion";
            return $output;
        } else {
            $output = $buf."\n";
            $output .= " Exito";
            return $output;
        }
    }
}


$resp= AltiriaSMS("527331258053", "Mensaje de prueba", "remitente", false);
echo $resp;


?>