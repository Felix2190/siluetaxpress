<?php
function consultaCredito()
{
    $sData = 'cmd=getcredit&';
    $sData .= 'domainId=siluetaexpress&';
    $sData .= 'login=lic.lezliedelariva@gmail.com&';
    $sData .= 'passwd=L7fr9P3sPMw6&';
    
    $timeOut = 5;
    
    $fp = fsockopen('www.altiria.net', 80, $errno, $errstr, $timeOut);
    if (! $fp) {
        // Error de conexion o tiempo maximo de conexion rebasado
        $output = "ERROR de conexion: $errno - $errstr\n";
        $output .= "Compruebe que ha configurado correctamente la direccion/url ";
        $output .= "suministrada por altiria";
        return array(false,$output);
        return $output;
    } else {
        $buf = "POST http://www.altiria.net/api/http HTTP/1.0\r\n";
        $buf .= "Host: www.altiria.net\r\n";
        $buf .= "Content-type: application/x-www-form-urlencoded; charset=UTF-8\r\n";
        $buf .= "Content-length: ".strlen($sData)."\r\n";
        $buf .= "\r\n";
        $buf .= $sData;
        fputs($fp, $buf);
        $buf = "";
        
        // Tiempo máximo de espera de respuesta del servidor = 60 seg
        $responseTimeOut = 60;
        stream_set_timeout($fp, $responseTimeOut);
        stream_set_blocking($fp, true);
        if (! feof($fp)) {
            if (($buf = fgets($fp, 128)) === false) {
                // TimeOut?
                $info = stream_get_meta_data($fp);
                if ($info['timed_out']){
                    $output = 'ERROR Tiempo de respuesta agotado';
                    return array(false,$output);
                    return $output;
                } else {
                    $output = 'ERROR de respuesta';
                    return array(false,$output);
                    return $output;
                }
            } else{
                while(!feof($fp)){
                    $buf.=fgets($fp,128);
                }
            }
        } else {
            $output = 'ERROR de respuesta';
            return array(false,$output);
            return $output;
        }
        
        fclose($fp);
        
        
        //Se comprueba que se ha conectado realmente con el servidor
        //y que se obtenga un codigo HTTP OK 200
        if (strpos($buf,"HTTP/1.1 200 OK") === false){
            $output = "ERROR. Codigo error HTTP: ".substr($buf,9,3)."\n";
            $output .= "Compruebe que ha configurado correctamente la direccion/url ";
            $output .= "suministrada por Altiria";
            return array(false,$output);
            return $output;
        }
        //Se comprueba la respuesta de Altiria
        if (strstr($buf,"ERROR")){
            $output = $buf."<br />\n";
            $output .= " Ha ocurrido algun error. Compruebe la especificacion";
            return array(false,$output);
            return $output;
        } else {
            $respuesta=explode(' ', $buf);
            $respuesta=explode(':', $respuesta[12]);
            $output = $buf."\n";
            $output .= " Exito";
            return array(true,$respuesta[1]);
        }
    }
}
?>