<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.hojaseguimiento.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
require FOLDER_INCLUDE . 'lib/graficas/GraficasChart.php';

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


function guardar($datos){
    global $objSession;
    $r=new xajaxResponse();
    $info=json_decode($datos,true);
    
    $seg = new ModeloHojaseguimiento();
    $seg->setPesoKg($info['Peso']);
    $seg->setEstatura($info['Estatura']);
    $seg->setIMC($info['IMC']);
    $seg->setCintura($info['Cintura']);
    $seg->setPecho($info['Pecho']);
    $seg->setAbdomen($info['Abdomen']);
    $seg->setTalla($info['Talle']);
    $seg->setCadera($info['Cadera']);
    $seg->setSintomas($info['Sintomas']);
    $seg->setDieta($info['Dieta']);
    $seg->setTratamiento($info['Tratamiento']);
    $seg->setIdUsuario($objSession->getidUsuario());
    $seg->setIdSucursal($objSession->getIdSucursal());
    $seg->setFechaRegistro($info['Fecha'].' '.date("H:i:s"));
    $seg->setIdPaciente($info['idPaciente']);
    
    $seg->Guardar();
    if ($seg->getError()){
        $r->call('mostrarMsjError',$seg->getStrSystemError(),5);
        return $r;
    }
    $r->call('limpiarTxt');
    
    $r->call('mostrarMsjExito','Se guard&oacute; correctamente la informaci&oacute;n!',3);
    $r->call('verListado');
    
    return $r;
    
}

$xajax->registerFunction("guardar");

function mostrarTabla($informacion)
{
    $r = new xajaxResponse();
    $arrTitulos=array("Fecha","Peso (kg)","Estatura (mts)","IMC","Pecho","Talle","Cintura","Abdomen","Cadera","");
    $tabla = "<table><thead><tr>";
        
        foreach ($arrTitulos as $titulo)
            $tabla .= "<th>$titulo</th>";
            
            $tabla.="</tr></thead><tbody>";
            
            foreach ($informacion as $id => $arr)
                $tabla .= "<tr><td>".$arr['fecha']."</td><td>".$arr['pesoKg']."</td><td>".$arr['estatura']."</td><td>".$arr['IMC']."</td>
                        <td>".$arr['pecho']."</td><td>".$arr['talla']."</td><td>".$arr['cintura']."</td><td>".$arr['abdomen']."</td><td>".$arr['cadera']."</td>
                <td><a onclick='verDetalle(\"".$arr['idHojaSeguimiento']."\")'><img src='images/ver.png' title='Ver/editar' style='width: 15px' /></a></td></tr>";
                
                $tabla .= "</tbody></table>";
    
    $r->assign('divTabla', 'innerHTML', $tabla);
    
    $areaGraficas = '<div id="canvas-holder">
						<div id="grafPay" style="display: none" class="col-sm-3 text-right">
							<canvas id="chart-area" width="700" height="300"></canvas>
						</div>
					</div>
				
			<div class="spacer-30"></div>';
    
    $r->assign ( "misgraficas", "innerHTML", $areaGraficas );
    
    $GraficaChart = new DatosGraficaChart();
    $GraficaChart->setAleaotorio ( true );
    $GraficaChart->setTipoGrafica ( "Linea" );
    $datosGraf = $GraficaChart->GraficaValores( array("d1"=>7,"d2"=>9,"d3"=>4,"d4"=>14) );
    
    $r->call ( "iniciarGraf", $datosGraf);
//    $r->call('mostrarMsjExito',json_encode($datosGraf),60);
    
    return $r;
}
$xajax->registerFunction("mostrarTabla");

$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

if (!isset($_SESSION['verSeg'])){
    header("Location: listadoPacientes.php");
}

$idPaciente =$_SESSION['verSeg'];

$paciente = new ModeloPaciente();
$paciente->setIdPaciente($idPaciente);

?>