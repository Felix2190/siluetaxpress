<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.promociones_ruleta.inc.php";
// -----------------------------------------------------------------------------------------------------------------#
// --------------------------------------------Inicializacion de control--------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ----------------------------------------------------Funciones----------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------------------Seccion AJAX--------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

$xajax = new xajax();


function actualizar($arrPromociones){
    $r=new xajaxResponse();
    global $objSession;
    $fecha = date("Y-m-d");
    $promocion = new ModeloPromociones_ruleta();
    foreach ($arrPromociones as $id=>$promo){
        $promocion->setIdPromocionRuleta($id);
        if (intval($promocion->getIdPromocionRuleta())>0){
            $promocion->setNombrePromocion($promo);
            $promocion->setIdUsuarioModifico($objSession->getidUsuario());
            $promocion->setFechaModificacion($fecha);
            $promocion->Guardar();
        }
    }
    $r->call("mostrarMsjExito","Se han guardado los cambios correctamente");
    $r->redirect("editarPromociones",3);
    return $r;
    
}

$xajax->registerFunction("actualizar");

$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

$promociones = new ModeloPromociones_ruleta();

$arrPromociones = $promociones->obtenerPromociones($objSession->getIdFranquicia(),$objSession->getIdSucursal());
$totalPromo = count($arrPromociones);

$fecha = date("Y-m-d");
while ($totalPromo<10){
    $promocion = new ModeloPromociones_ruleta();
    $promocion->setIdSucursal($objSession->getIdSucursal());
    $promocion->setIdFranquicia($objSession->getIdFranquicia());
    $promocion->setNombrePromocion("Promo ".($totalPromo+1));
    $promocion->setIdUsuarioModifico($objSession->getidUsuario());
    $promocion->setFechaModificacion($fecha);
    if($promocion->Guardar())
        $arrPromociones[$promocion->getIdPromocionRuleta()]=$promocion->getNombrePromocion();
    $totalPromo++;
}
?>