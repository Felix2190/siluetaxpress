<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
// -----------------------------------------------------------------------------------------------------------------#
// --------------------------------------------Inicializacion de control--------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ----------------------------------------------------Funciones----------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
function obtenMes($numMes){
    $MESES=  array (
        "1"=>"Enero",
        "2"=>"Febrero",
        "3"=>"Marzo",
        "4"=>"Abril",
        "5"=>"Mayo",
        "6"=>"Junio",
        "7"=>"Julio",
        "8"=>"Agosto",
        "9"=>"Septiembre",
        "10"=>"Octubre",
        "11"=>"Noviembre",
        "12"=>"Diciembre"
    );
    if ($numMes=='')
        return $MESES;
        return $MESES[''.$numMes];
}

// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------------------Seccion AJAX--------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

$xajax = new xajax();

function consultarCitas($informacion,$fechaI){
    $r=new xajaxResponse();
    global $objSession;
    $dias = array(
        '',
        'Lunes',
        'Martes',
        'Miercoles',
        'Jueves',
        'Viernes',
        'S&aacute;bado',
        'domingo'
    );
    
    $fecha2=explode(" ", $fechaI);
    $fecha2=explode("-", $fecha2[0]);
    $fechaHaceUnaSemana = date ("Y-m-d",strtotime ( '-7 day' , strtotime ( $fechaI) ) );
    $fechaSig = date ("Y-m-d",strtotime ( '+7 day' , strtotime ( $fechaI) ) );
    $fecha1=explode("-", $fechaHaceUnaSemana);
    $rango="$fecha1[2]/".obtenMes(''.intval($fecha1[1]))."/$fecha1[0] al $fecha2[2]/".obtenMes(''.intval($fecha2[1]))."/$fecha2[0]";
    
    $arrEncabezado=array('Hora','Paciente','Consulta','Detalles','Servicio','Estatus','Opciones');
        $tabla="";
        
   foreach ($informacion as $fecha_=>$Citas){
       $fecha=explode("-", $fecha_);
       $_dia = date('N', strtotime($fecha_));
        
        $tabla.="<div class='row'><div class='3u 12u$(xsmall)'><h4>$dias[$_dia] $fecha[2] de ".obtenMes(''.intval($fecha[1]))." del $fecha[0]</h4>
    								</div></div><div class='row'><div class='12u'><table><thead><tr>";
        foreach ($arrEncabezado as $idem){
            $colspan="";
            if ($idem=='Servicio')
               $colspan=" colspan='2'";
            if ($idem=='Detalles')
                $colspan=" colspan='2'";
            $tabla.="<th $colspan>$idem</th>";
        }
        
        $tabla.="</tr></thead><tbody>";
        foreach ($Citas as $id=>$cita){
            
            $hr=intval($cita['duracion']/60);
            $min=$cita['duracion']%60;
            $duracion=($hr>0?($hr. ' hora'.($hr>1?'s':'')).($min>0?(', '.$min.' minutos'):''):('').$min.' minutos');
            
            $detalles="<div id='l".$cita['idCita']."'> <p> <strong>Consultorio: </strong> ".$cita['cabina']."</p>
                        <a onClick='verDetalles(".$cita['idCita'].")'>Ver detalles </a> </div>
                       <div id='c".$cita['idCita']."' style='display: none'; > <blockqoute> 
                            <!-- <p> <strong>Servicio: </strong> ".$cita['servicio']."</p> -->
                            <p> <strong>Consultorio: </strong> ".$cita['cabina']."</p>
                            <p> <strong>Duraci&oacute;n: </strong> ".$duracion."</p> 
                            <p> <a onClick='ocultarDetalles(".$cita['idCita'].")'>Ocultar </a> </p>  </blockqoute></div>";
            
            
            $tabla.="<tr><td>".$cita['hora']." - ".$cita['horaFin']."</td><td >".$cita['nombre_paciente']."</td><td>".$cita['tipoConsulta']."</td>
                    <td colspan='2'>".$detalles."</td><td colspan='2'>".$cita['servicio']."</td><td>".$cita['descripcion']."</td>";
//        if ($objSession->getidRol()==1||$objSession->getidUsuario()==$cita['idUsuario'])
            $tabla.="<td><a onclick='verCita(\"".$cita['idCita']."\")'><img src='images/editaCita.png' title='Ver/editar' style='width: 34px' /></a></td>";
 /*           else 
                $tabla.="<td><a onclick='verOpciones(\"".$cita['idCita']."\")'><img src='images/cancelarCita2.png' title='Cancelar cita' style='width: 34px' /></a></td>";
   */
  if ($objSession->getidRol()==1||$objSession->getEnvioLink()==1){
      $tabla.="<td><a onclick='enviaEncuesta(\"".$cita['idCita']."\")'><img src='images/whats.webp' title='Enviar encuesta' style='width: 34px' /></a></td>";
      
  }
 
 $tabla.="</tr>";
        }
        $tabla.="</tbody></table></div></div><br />";
    }
    //$fecha1=explode(" ", $fechaI);
    $fActual=strtotime($fechaI);
    $fhoy=strtotime(date ( 'Y-m-d'));
    $fSig=strtotime($fechaSig);
    $funo=strtotime($fechaHaceUnaSemana);

    
    $disable="";
    if ($fActual>=$fhoy){
        $disable="disabled";
    }
    if ($fSig>$fhoy){
        $fechaSig=date ( 'Y-m-d');
    }
    
    $btn='<a id="btnSig" class="button small '.$disable.'">Siguiente semana</a>';
    $r->assign('divTabla', 'innerHTML', $tabla);
    $r->assign('fechasEntre', 'innerHTML', $rango);
    $r->assign('divBtnSig', 'innerHTML', $btn);
    $r->call('colocaFechas', $fechaHaceUnaSemana,$fechaI,$fechaSig);
    return $r;
    
}
$xajax->registerFunction("consultarCitas");

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
//$citas = new ModeloCita();
$cabina=$paciente=$usuario=$consulta=$sucursal='';
$altaCita="";
if (isset($_SESSION['altaCita'])){
    $paciente=$_SESSION['altaCita'];
    $altaCita="si";
    $pacient= new ModeloPaciente();
    $pacient->setIdPaciente($paciente);
    $Nombre=$pacient->getNombre();
    $Apellidos=$pacient->getApellidos();
}
if ($objSession->getidRol()!=1){
    $usuario=$objSession->getidUsuario();
    $sucursal=$objSession->getIdSucursal();
    
}

?>