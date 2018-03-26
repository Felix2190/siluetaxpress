<?php
require_once 'masterInclude.inc.php';

//require_once '../include/Conexion/clsBasicCommon.inc.php';
require_once FOLDER_MODEL_EXTEND . "model.user.inc.php";
$Conectar = new ModeloUser();
$Conectar->setNombre('felix');

$Conectar->Guardar();;


