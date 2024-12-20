<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.citasparalelas.inc.php";
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

function verGraficas($arrayInformacion,$sucursal){
    $r=new xajaxResponse();
    $tex='';
    $item = array("divCitaTot","divCitaCurso","divCitaRea","divCitaProxs","divCitaCP","divCitaCE");
    $informacion=$arrayInformacion[0];
    $arrCitasCurso=$arrayInformacion[1];
    $arrCitasProx=$arrayInformacion[2];
    
    for($i=0;$i<6;$i++){
    $tex.='<div class="6u 12u$(xsmall)" style="text-align: center;">
							<strong>Citas '.$informacion[$item[$i]][1].'</strong>
							</div>';
	$tex.='<div class="6u 12u$(xsmall)" style="text-align: center;">
							<strong>Citas '.$informacion[$item[$i+1]][1].'</strong>
							</div>';
			
	$tex.='<div class="6u 12u$(xsmall)" style="display: flex; justify-content: center;" id="'.$item[$i].'">
							<div class="circular-stats radius-60" >
                                    <div class="circular-stats-inner">	                        			
                                        <div class="circular-stats-data">
                                            <strong>'.$informacion[$item[$i]][0].'</strong>
                                            <span>'.$informacion[$item[$i]][2].'%</span>
                                        </div>	
                                        <input class="knob" data-width="120" data-cursor="false" data-fgColor="#a6a453" data-bgColor="#e4e3c9" data-thickness=".30" 
                                        value="'.$informacion[$item[$i]][2].'" data-readOnly="true" data-angleOffset="-0" data-displayInput="false" />
                                    </div>
                                </div>
			                </div>';
			$tex.='<div class="6u 12u$(xsmall)" style="display: flex; justify-content: center;" id="'.$item[$i+1].'">
							<div class="circular-stats radius-60" >
                                    <div class="circular-stats-inner">
                                        <div class="circular-stats-data">
                                            <strong>'.$informacion[$item[$i+1]][0].'</strong>
                                            <span>'.$informacion[$item[$i+1]][2].'%</span>
                                        </div>
                                        <input class="knob" data-width="120" data-cursor="false" data-fgColor="#a6a453" data-bgColor="#e4e3c9" data-thickness=".30"
                                        value="'.$informacion[$item[$i+1]][2].'" data-readOnly="true" data-angleOffset="-0" data-displayInput="false" />
                                    </div>
                                </div>
			                </div>';
			
			$tex.='<div class="12u 12u$(xsmall)">
						<hr />
						</div>';
			$i++;
    }
    
    if ($sucursal!=''&&count($arrCitasCurso)>0){
        $tex.='<div class="12u" style="text-align: center;"><strong>Citas en curso </strong></div>
                <div class="12u" style="display: flex; justify-content: center;">';
        foreach ($arrCitasCurso as $idCabina){
            $tex.="<a onclick='verCita(\"".$idCabina['idCita']."\")'>".$idCabina['cabina']."</a>&ensp;";
        }
        $tex.='</div><div class="12u 12u$(xsmall)"><hr /></div>';
    }
    
    
    if ($sucursal!=''&&count($arrCitasProx)>0){
        $tex.='<div class="12u" style="text-align: center;"><strong>Citas pr&oacute;ximas </strong></div>
                <div class="12u" style="display: flex; justify-content: center;">';
        foreach ($arrCitasProx as $idCabina){
            $tex.="<a onclick='verCita(\"".$idCabina['idCita']."\")'>".$idCabina['cabina']."</a>&ensp;";
        }
        $tex.='</div><div class="12u 12u$(xsmall)"><hr /></div>';
    }
    
    $r->assign("divGraficas", "innerHTML", $tex);
    $r->call("knob_");
    return $r;
    
}

$xajax->registerFunction("verGraficas");

function verCita($idCita){
    $r=new xajaxResponse();
    
    $_SESSION['verCita']=array('titulo'=>'Detalles de la cita','idCita'=>$idCita);
    $r->call('mostrarMsjEspera','Consultando informaci&oacute;n de la cita...',1);
    $r->redirect("verCita.php",2);
    return $r;
}
$xajax->registerFunction("verCita");

$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
$problemasCitas=new ModeloCitasparalelas();
$total=count($problemasCitas->obtenerTotalProblemaCitasByUsuario($objSession->getidUsuario()));

?>