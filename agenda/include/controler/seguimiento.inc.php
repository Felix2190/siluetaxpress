<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.hojaseguimiento.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.hojaclinica.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.productos.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.seguimiento_producto.inc.php";
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
    if (intval($info['idSeg'])>0)
        $seg->setIdHojaSeguimiento($info['idSeg']);
    else 
        $seg->setFechaRegistro($info['Fecha'].' '.date("H:i:s"));
        
    $seg->setPesoKg($info['Peso']);
    $seg->setIMC($info['IMC']);
    $seg->setCintura($info['Cintura']);
    $seg->setPecho($info['Pecho']);
    $seg->setAbdomen($info['Abdomen']);
    $seg->setTalla($info['Talle']);
    $seg->setCadera($info['Cadera']);
    $seg->setPierna($info['Pierna']);
    $seg->setMusculo($info['Musculo']);
    $seg->setGrasa($info['Grasa']);
    $seg->setFc($info['FC']);
    $seg->setPa($info['PA']);
    $seg->setOtrosSintomas($info['Sintomas']);
    $seg->setDieta($info['Dieta']);
    $seg->setTratamiento($info['Tratamiento']);
    $seg->setIdUsuario($objSession->getidUsuario());
    $seg->setIdSucursal($objSession->getIdSucursal());
    $seg->setIdPaciente($info['idPaciente']);
    
    $paciente = new ModeloPaciente();
    $paciente->setIdPaciente($info['idPaciente']);
    $hojaClinica = new ModeloHojaclinica();
    $hojaClinica->setIdHojaClinica($paciente->getIdHojaClinica());
    $recargar=false;
    if ($hojaClinica->getEstatura()==0)
        $recargar=true;
    $hojaClinica->ActualizarEstatura($info['Estatura']);
    
    $arrSintomas = $info['SintomasArr'];
    
    foreach ($arrSintomas as $sintoma){
      switch ($sintoma){
          case "Estrenimiento":
            $seg->setEstrenimiento();
            break;
        case "Cansancio":
            $seg->setCansancio();
            break;
        case "Sueno":
            $seg->setSueno();
            break;
        case "Mareo":
            $seg->setMareo();
            break;
        case "Nausea":
            $seg->setNausea();
            break;
        case "Boca":
            $seg->setBocaSeca();
            break;
      }
    }
    
    
    $seg->Guardar();
    if ($seg->getError()){
        $r->call('mostrarMsjError',$seg->getStrSystemError(),5);
        return $r;
    }
    
    $arrProducto = $info['Productos'];
    
    if (intval($info['idSeg'])>0){
        $seg_producto= new ModeloSeguimiento_producto();
        $seg_producto->bajaSegProductos($info['idSeg']);
        foreach ($arrProducto as $idsp){
            $seg_producto= new ModeloSeguimiento_producto();
            $seg_producto->setIdProducto($idsp);
            $seg_producto->setIdSeguimiento($seg->getIdHojaSeguimiento());
            $seg_producto->guardarSegProducto();
        }
    }else{
        foreach ($arrProducto as $idsp){
            $seg_producto= new ModeloSeguimiento_producto();
            $seg_producto->setIdProducto($idsp);
            $seg_producto->setIdSeguimiento($seg->getIdHojaSeguimiento());
            $seg_producto->setIdUsuario($objSession->getidUsuario());
            $seg_producto->setFechaRegistro(date("Y-m-d H:i:s"));
            
            $seg_producto->Guardar();
            if ($seg_producto->getError()){
                $r->call('mostrarMsjError',$seg_producto->getStrSystemError(),5);
                return $r;
            }
        }
    }
    
    $r->call('limpiarTxt');
    
    $r->call('mostrarMsjExito','Se guard&oacute; correctamente la informaci&oacute;n!',3);
    $r->call('verListado');
    if ($recargar)
        $r->redirect("seguimiento.php",2);
    return $r;
    
}

$xajax->registerFunction("guardar");

function mostrarTabla($informacion)
{
    $r = new xajaxResponse();
    $paciente = new ModeloPaciente();
    $paciente->setIdPaciente($_SESSION['verSeg']);
    $hojaClinica = new ModeloHojaclinica();
    $hojaClinica->setIdHojaClinica($paciente->getIdHojaClinica());
    
    $arrTitulos=array("Fecha","Peso (kg)","IMC","Pecho","Talle","Cintura","Abdomen","Cadera","Dieta","Tratamiento","");
    $tabla = "<div class='12u 12u$(xsmall)'>
							 <strong> Estatura: </strong> ".$hojaClinica->getEstatura()."
							</div>
						<br />
                <table><thead><tr>";
        
        foreach ($arrTitulos as $titulo){
            if ($titulo=="Dieta"||$titulo=="Tratamiento")
                $tabla .= "<th colspan='3'>$titulo</th>";
            else 
                $tabla .= "<th>$titulo</th>";
           }
            $tabla.="</tr></thead><tbody>";
            
            foreach ($informacion as $id => $arr)
                $tabla .= "<tr><td>".$arr['fecha']."</td><td>".$arr['pesoKg']."</td><td>".$arr['IMC']."</td>
                        <td>".$arr['pecho']."</td><td>".$arr['talla']."</td><td>".$arr['cintura']."</td><td>".$arr['abdomen']."</td>
                    <td>".$arr['cadera']."</td><td colspan='3'>".$arr['dieta']."</td><td colspan='3'>".$arr['tratamiento']."</td>
                <td><a onclick='verDetalle(\"".$arr['idHojaSeguimiento']."\")'><img src='images/ver.png' title='Ver' style='width: 15px' /></a>
<a onclick='editar(\"".$arr['idHojaSeguimiento']."\")'><img src='images/editar.png' title='editar' style='width: 15px' /></a></td></tr>";
                
                $tabla .= "</tbody></table>";
    
    $r->assign('divTabla', 'innerHTML', $tabla);
    
    $areaGraficas = '
			 
				<div class="12u 12u$(xsmall)">
			     				<strong>&emsp;&emsp;<h5>Control de peso</h5></strong>
                                <div id="canvas-holder">
						<div id="grafPay" style="display: none"  >
							<canvas id="chart-area" ></canvas>
						</div>
                     </div>
				 </div>
                <div class="12u 12u$(xsmall)">
			          <strong><h5>&emsp;&emsp;IMC</h5></strong>
                       <div id="canvas-holder">
						<div id="grafPay2" style="display: none" >
							<canvas id="chart-area2" ></canvas>
						</div>
                     </div>
				</div>
			       
			<div class="spacer-30"></div>';
    
    $r->assign ( "misgraficas", "innerHTML", $areaGraficas );
    
    $idPaciente =$_SESSION['verSeg'];
    
    $seg = new ModeloHojaseguimiento();
    $datosPeso=$seg->getValoresByCampo($idPaciente, "pesoKg");
    $datosIMC=$seg->getValoresByCampo($idPaciente, "IMC");
    
    $GraficaChart = new DatosGraficaChart();
    $GraficaChart->setTipoGrafica ( "Linea" );
    $GraficaChart->setCampo("pesoKg");
   $datosGraf1 = $GraficaChart->GraficaValores($datosPeso['info']);
   
   
   $GraficaChart = new DatosGraficaChart();
   $GraficaChart->setTipoGrafica ( "Linea" );
   $GraficaChart->setCampo("IMC");
    $datosGraf2 = $GraficaChart->GraficaValores($datosIMC['info']);
    
    $r->call ( "iniciarGraf", $datosGraf1,$datosPeso['total'],$datosGraf2,$datosIMC['total']);
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
$hojaClinica = new ModeloHojaclinica();
$hojaClinica->setIdHojaClinica($paciente->getIdHojaClinica());
?>