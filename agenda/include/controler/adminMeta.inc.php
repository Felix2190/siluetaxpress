<?php

function enviaWhatsapp($objeto, $identificador){
    $url = "https://graph.facebook.com/v25.0/$identificador/messages";
    
    // Initialize cURL
    $ch = curl_init($url);
    
    // Encode data to JSON string
    $jsonData = json_encode($objeto);
    
    // Set options for JSON Request Body
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ($jsonData)); // Encodes array to JSON string
    
    // Set necessary headers
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer EAAWYjawweXgBRm03ZA8t9yNHMTmhSnUjCffNNA4XjYfJZCNtQT4cdoim5qBRRuZAaJGwypeZC4TR77FfA4zCDZAyyKR5WLTWyIoZC4CiovCWPywA5qAnMqZAisfTKXQWIFTTcxcZBIBAzgOhb5NqHSvWvwuPPMrE3rlZBBpIyTtUNygsJToLcQL1kGk4IWbMJggZDZD'
    ]);
    
    // Execute request and fetch response
    $response = curl_exec($ch);
    
    // Check for errors
    $success=!curl_errno($ch);
    
    // Close connection
    curl_close($ch);
    return array($success,curl_error($ch));
}

function obtenerJSONMeta($numTel, $parametros, $codigoPlantilla="")
{
    if ($codigoPlantilla == "") {
        $JSON = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $numTel,
            "type" => "text",
            "text" => [
                "body" => $parametros['texto']
            ]
        ];
    } else  if ($codigoPlantilla == "promocion") {
        $JSON = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $numTel,
            "type" => "template",
            "template" => [
                "name" => $codigoPlantilla,
                "language" => [
                    "code" => "es_MX"
                ],
                "components" => array(
                    [
                        "type" => "header",
                        "parameters" => array(
                            [
                                "type" => "text",
                                "parameter_name" => "nombre",
                                "text" => $parametros['nombre']
                            ]
                        )
                    ],
                    [
                        "type" => "body",
                        "parameters" => array(
                            [
                                "type" => "text",
                                "parameter_name" => "noti",
                                "text" => $parametros['noti']
                            ]
                        )
                    ]
                )
            ]
        ];
        
    }else{
        $JSON = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $numTel,
            "type" => "template",
            "template" => [
                "name" => $codigoPlantilla,
                "language" => [
                    "code" => "es_MX"
                ],
                "components" => array(
                    [
                        "type" => "header",
                        "parameters" => array(
                            [
                                "type" => "text",
                                "parameter_name" => "nombre",
                                "text" => $parametros['nombre']
                            ]
                        )
                    ],
                    [
                        "type" => "body",
                        "parameters" => array(
                            [
                                "type" => "text",
                                "text" => $parametros['dia'],
                                "parameter_name" => "dia"
                            ],
                            [
                                "type" => "text",
                                "parameter_name" => "hora",
                                "text" => $parametros['hora']
                            ],
                            [
                                "type" => "text",
                                "parameter_name" => "sucursal",
                                "text" => $parametros['sucursal']
                            ]
                        )
                    ]
                )
            ]
        ];
    }
    return $JSON;
}
?>