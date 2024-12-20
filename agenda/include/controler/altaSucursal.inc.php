<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.cabina.inc.php";
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


function guardarSucursal($ent,$mun,$sucursalN,$direccion,$hrEntreI,$hrEntreF,$hrSabI,$hrSabF,$numCon,$numCa){
    $r=new xajaxResponse();
    global $objSession;
    $sucursal= new ModeloSucursal();
    $sucursal->setCveEstado($ent);
    $sucursal->setCveMunicipio($mun);
    $sucursal->setSucursal($sucursalN);
    $sucursal->setDireccion($direccion);
    $sucursal->setEntreSemanaEntrada($hrEntreI);
    $sucursal->setEntreSemanaSalida($hrEntreF);
    $sucursal->setSabadoEntrada($hrSabI);
    $sucursal->setSabadoSalida($hrSabF);
    $sucursal->setEstatusActiva();
    $sucursal->setIdFranquicia($objSession->getIdFranquicia());
    $sucursal->Guardar();
    
    if ($sucursal->getError()){
        $r->call('mostrarMsjError',$sucursal->getStrError(),5);
        return $r;
    }
    
    $cabinas= array();
    $con=-1;
    $tipo="consultorio";
    
    for($i=1;$i<=$numCon;$i++){
        $cabinas[]="Consultorio ".$i;
        $con++;
    }
        for($i=1;$i<=$numCa;$i++)
            $cabinas[]="Cabina ".$i;
            
            foreach ($cabinas as $id=>$cabina){
                if ($id>$con)
                    $tipo="cabina";
                $c = new ModeloCabina();
                $c->setIdSucursal($sucursal->getIdSucursal());
                $c->setTipo($tipo);
                $c->setNombre($cabina);
                $c->Guardar();
                
                if ($c->getError()){
                    $r->call('mostrarMsjError',$c->getStrError(),5);
                    return $r;
                }
            }
            
            $r->call('mostrarMsjExito','Se agreg&oacute; correctamente la sucursal!',4);
            $r->redirect('listadoSucursal.php',5);
    return $r;
    
}

$xajax->registerFunction("guardarSucursal");


$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
$arr=array();
for ($hr=6;$hr<=22;$hr++){
    $hora=($hr<10?'0':'').$hr;
     $arr[$hr]=$hora.':00';
}

$combo='';
foreach ($arr as $key => $opcion)
    $combo.='<option value="'.$key.'">'.$opcion.'</option>';
    

?>