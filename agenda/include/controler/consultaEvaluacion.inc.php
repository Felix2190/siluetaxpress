<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.consulta.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.encuesta.inc.php";
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


function verEvaluacion($mes, $anio){
    $r=new xajaxResponse();
    
    $encuesta = new ModeloEncuesta();
    $tipoConsulta = new ModeloConsulta();
    $txt="";
    $arrInfo = $encuesta->obtenerEvaluacion($mes, $anio);
    foreach ($arrInfo as $t => $evaluaciones){
        $tipoConsulta->setIdConsulta($t);
        $tipo=$tipoConsulta->getTipoConsulta();
        $txt.='<div class="row">
					<div class="12u 12u$(small)">
						<h4>'.$tipo.'</h4>
					</div>';
        foreach ($evaluaciones as $nombre=>$info){
            if (round($info[1],2)>=8){
                $color="#22AA11";
            }else if (round($info[1],2)>=5){
                $color="#f7e253";
            }else {
                $color="#ff3535";
            }
            $txt.='<div class=" row 12u 12u$(small)">
                     <div class="2u 12u$(small)">
						<label>'.$nombre.' '.round($info[1],2).' ('.$info[0].')</label>
					</div>
					<div class="4u 12u$(small)">
                        <div class="barra">
                          <span style="width: '.round($info[1]*10).'%;  background-color:'.$color.'"></span>
                        </div>
					</div> </div>';
        }
        $txt.="</div>";
    }
    
    if (count($arrInfo)>0){
        $txtComen="<ul>";
        $arrComentarios = $encuesta->obtenerComentarios($mes, $anio);
        foreach ($arrComentarios as $comentario){
            $txtComen.="<li>$comentario</li>";
        }
        $txtComen.="</ul>";
        $r->assign("comen", "innerHTML", $txtComen);
    }
    
    $r->assign("divEvalua", "innerHTML", $txt);
    
    return $r;
    
}

$xajax->registerFunction("verEvaluacion");

$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
$mes=date("m");
$anio=date("Y");
$anioI=2021;

$meses =  array (
    "01"=>"Enero",
    "02"=>"Febrero",
    "03"=>"Marzo",
    "04"=>"Abril",
    "05"=>"Mayo",
    "06"=>"Junio",
    "07"=>"Julio",
    "08"=>"Agosto",
    "09"=>"Septiembre",
    "10"=>"Octubre",
    "11"=>"Noviembre",
    "12"=>"Diciembre"
);
$comboAnio=$comboMeses="";
foreach ($meses as $key => $opcion)
    $comboMeses.='<option value="'.$key.'" '.($key==$mes?' selected ':'').'>'.$opcion.'</option>';
    for ($a=$anioI;$a<=$anio;$a++)
        $comboAnio.='<option value="'.$a.'" '.($a==$anio?' selected ':'').'>'.$a.'</option>';
        
?>