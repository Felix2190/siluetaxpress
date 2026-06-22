<?php
define("DEVELOPER", false);
date_default_timezone_set('America/Mexico_City');
// require_once 'include/config/constantes.php';
if (! DEVELOPER) {
    define("FOLDER_INCLUDE", "/var/www/vhosts/siluetaexpress.com.mx/agenda.siluetaexpress.com.mx/include/");
    define("FOLDER_INCLUDE_AGENDA", "/var/www/vhosts/siluetaexpress.com.mx/agenda.siluetaexpress.com.mx/include/"); //agenda
    define("FOLDER_TMP", "/var/www/vhosts/siluetaexpress.com.mx/agenda.siluetaexpress.com.mx/");
} else {
    define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "siluetaxpress/html/include/");
    define("FOLDER_INCLUDE_AGENDA", $_SERVER['DOCUMENT_ROOT'] . "siluetaxpress/html/agenda/include/");
}

define("CLASS_CONEXION", FOLDER_INCLUDE . 'Conexion/Conexion.php');
define("FOLDER_MODEL", FOLDER_INCLUDE . "model/");
define("FOLDER_MODEL_BASE", FOLDER_MODEL . "base/");
define("FOLDER_MODEL_EXTEND", FOLDER_MODEL . "extend/");
define("FOLDER_MODEL_DATA", FOLDER_MODEL . "data/");

define("CLASS_COMUN", FOLDER_MODEL_DATA . "clsBasicCommon.inc.php");
require_once CLASS_COMUN;
require_once CLASS_CONEXION;
require_once FOLDER_INCLUDE_AGENDA.'controler/adminFunciones.inc.php';
require_once FOLDER_MODEL_EXTEND. "model.prueba.inc.php";

require_once FOLDER_INCLUDE_AGENDA.'controler/adminMeta.inc.php';
require_once FOLDER_MODEL_EXTEND. "model.cita_control_whatsapp.inc.php";

require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";

require_once FOLDER_MODEL_EXTEND. "model.franquicia.inc.php";

require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";

$fechaActual = date("Y-m-d H:i:s");

if (!function_exists("get_magic_quotes_runtime")){
    function get_magic_quotes_runtime(){
        return false;
    }
}

// Configuración de tu token de verificación (debe coincidir con el de Meta App Dashboard)
$verify_token = "siluetaexpress0";

// 1. VERIFICACIÓN DEL WEBHOOK (Método GET)
// Meta envía una petición GET para comprobar que la URL es válida
if (isset($_GET['hub_mode']) && isset($_GET['hub_verify_token'])) {
    $mode = $_GET['hub_mode'];
    $token = $_GET['hub_verify_token'];
    $challenge = $_GET['hub_challenge'];
    
    if ($mode === 'subscribe' && $token === $verify_token) {
        echo $challenge; // Devuelve el challenge para confirmar
        exit;
    }
    http_response_code(403);
    exit;
}

// 2. RECEPCIÓN DE MENSAJES (Método POST)
// Meta envía los mensajes entrantes en formato JSON
$input = file_get_contents('php://input');
$response = json_decode($input, true);

// Registramos el log para ver toda la estructura que envía WhatsApp
// (Útil para debuggear y extraer el texto, imagen, etc.)
error_log($input, 3, "whatsapp_logs.txt");

if (isset($response['entry'][0]['changes'][0]['value']['messages'][0])) {
    $message_data = $response['entry'][0]['changes'][0]['value']['messages'][0];
    
    // Extraemos datos básicos
    $phone_number = $message_data['from']; // Número del usuario
    $message_type = $message_data['type']; // 'text', 'image', etc.
    
    // Procesar mensaje de texto
    if ($message_type === 'text') {
        $message_text = $message_data['text']['body'];
        
        $cm = new ModeloCita_control_whatsapp();
        $arrInfo = $cm->buscaCitaPorTel($phone_number);
        if ($arrInfo['idControl']!=0){
            $cm->setIdControl($arrInfo['idControl']);
            $cm->setFechaRespuesta($fechaActual);
            if (strtoupper($message_text)=='SI')
                $cm->setEstatusConfirmada();
                if (strtoupper($message_text)=='NO')
                    $cm->setEstatusCancelada();
                    $cm->Guardar();         
                    
                    $cita = new ModeloCita();
                    $cita->setIdCita($arrInfo['idCita']);
                    $sucursal = new ModeloSucursal();
                    $sucursal->setIdSucursal($cita->getIdSucursal());
                    $franquicia= new ModeloFranquicia();
                    $franquicia->setIdFranquicia($sucursal->getIdFranquicia());
                    
                    if (strtoupper($message_text)=='SI')
                        $mensaje='Gracias por confirmar tu cita!';
                        if (strtoupper($message_text)=='NO')
                            $mensaje='Has cancelado tu cita';                            
                            $parametros['texto']= $mensaje;
                            $objeto=obtenerJSONMeta($cita->getTelefonoPaciente(), $parametros);
       
        $resWh = enviaWhatsapp($objeto, $franquicia->getIdentificadorMeta());
                    if (strtoupper($message_text)=='NO')
                    {
                        $cita->setEstatus('cancelada_paciente');
                        $cita->Guardar();
                        
                    }
        }else {
        $prueba = new ModeloPrueba();
        $prueba->setTel($phone_number);
        $prueba->setTexto($arrInfo);
        $prueba->Guardar();
    }
        // Aquí llamarías a tu función para responder, por ejemplo:
        // enviarMensajeWhatsApp($phone_number, "Hola, recibí tu mensaje: " . $message_text);
    }
}

// Respondemos con un HTTP 200 para confirmar a Meta que recibimos el evento
http_response_code(200);
echo "EVENT_RECEIVED";
?>