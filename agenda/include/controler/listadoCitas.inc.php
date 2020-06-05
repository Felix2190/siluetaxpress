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

function consultarCitas($informacion,$fechaI,$checkCabina){
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
    
    $fecha1=explode(" ", $fechaI);
    $fecha1=explode("-", $fecha1[0]);
    $fechaFin = date ("Y-m-d",strtotime ( '+7 day' , strtotime ( $fechaI) ) );
    $fechaInicio = date ("Y-m-d",strtotime ( '-7 day' , strtotime ( $fechaI) ) );
    $fecha2=explode("-", $fechaFin);
    $rango="$fecha1[2]/".obtenMes(''.intval($fecha1[1]))."/$fecha1[0] al $fecha2[2]/".obtenMes(''.intval($fecha2[1]))."/$fecha2[0]";
    
    $arrEncabezado=array('Hora','Paciente','Consulta','Detalles','Servicio','Opciones');
 //   if ($objSession->getidRol()==1)
//        $arrEncabezado=array( 'Hora','Paciente','Consulta','Detalles','Sucursal','Servicio','Opciones');
//        $arrEncabezado=array('ID Consulta', 'Fecha','Hora','Paciente','Consulta','Duraci&oacute;n','Sucursal','Opciones');
    if ($checkCabina)    
        $arrEncabezado=array('Horario','Paciente','Opciones');
    
    $seccion="";
        
   foreach ($informacion as $fecha_=>$Citas){
       $fecha=explode("-", $fecha_);
       $_dia = date('N', strtotime($fecha_));
       $cabina="";
        $seccion.="<div class='row'><div class='4u 12u$(xsmall)'><h4>$dias[$_dia] $fecha[2] de ".obtenMes(''.intval($fecha[1]))." del $fecha[0]</h4>
    								</div></div><div class='row'><div class='12u'>";
        
        if (!$checkCabina){
            $seccion.="<table><thead><tr>";
            foreach ($arrEncabezado as $idem){
                $colspan="";
                if ($idem=='Servicio')
                   $colspan=" colspan='2'";
                if ($idem=='Detalles')
                    $colspan=" colspan='2'";
                $seccion.="<th $colspan>$idem</th>";
            }
            
            $seccion.="</tr></thead><tbody>";
            foreach ($Citas as $id=>$cita){
                $sucursal="";
    //            if ($objSession->getidRol()==1)
    //                $sucursal="<td>".$cita['sucursal']."</td>";
                
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
                
                
                $seccion.="<tr><td>".$cita['hora']." - ".$cita['horaFin']."</td><td >".$cita['nombre_paciente']."</td><td>".$cita['tipoConsulta']."</td>
                        <td colspan='2'>".$detalles."</td>$sucursal <td colspan='2'>".$cita['servicio']."</td>";
    //        if ($objSession->getidRol()==1||$objSession->getidUsuario()==$cita['idUsuario'])
                $seccion.="<td><a onclick='verCita(\"".$cita['idCita']."\")'><img src='images/editaCita.png' title='Ver/editar' style='width: 34px' /></a> 
                         <a onclick='verOpciones(\"".$cita['idCita']."\")'><img src='images/cancelarCita2.png' title='Cancelar cita' style='width: 34px' /></a></td>";
     /*           else 
                    $tabla.="<td><a onclick='verOpciones(\"".$cita['idCita']."\")'><img src='images/cancelarCita2.png' title='Cancelar cita' style='width: 34px' /></a></td>";
       */         $seccion.="</tr>";
            }
            $seccion.="</tbody></table>";
        }else {
            $seccion.="<div class='row'>";
       foreach ($Citas as $id=>$cita){
           if ($cabina==""||$cita['cabina']!=$cabina){
               $cabina=$cita['cabina'];
               if ($cabina!="")
                   $seccion.="</tbody></table></div></div>";
                   $seccion.="<div class='4u 12u$(xsmall)'><strong>$cabina</strong><div class='12'><table><thead><tr>";
                   foreach ($arrEncabezado as $idem){
                       $colspan="";
                       if ($idem=='Horario'||$idem=='Paciente')
                           $colspan=" colspan='2'";
                       $seccion.="<th $colspan>$idem</th>";
                   }
                   $seccion.="</tr></thead><tbody>";
           }
           $hr=intval($cita['duracion']/60);
           $min=$cita['duracion']%60;
           $duracion=($hr>0?($hr. ' hora'.($hr>1?'s':'')).($min>0?(', '.$min.' minutos'):''):('').$min.' minutos');
           
           $seccion.="<tr><td colspan='2'>".$cita['hora']."-".$cita['horaFin']."</td> 
   <td colspan='2'><div id='l".$cita['idCita']."'> <a onClick='verDetalles(".$cita['idCita'].")'>".$cita['nombre_paciente']."</a></div>
                <div id='c".$cita['idCita']."' style='display: none'; > <blockqoute> 
                                <p> <strong>Paciente: </strong> ".$cita['nombre_paciente']."</p>
                                <p> <strong>Tel&eacute;fono: </strong> ".$cita['telefono']."</p>
                                <p> <strong>Servicio: </strong> ".$cita['servicio']."</p>
                                <p> <strong>Duraci&oacute;n: </strong> ".$duracion."</p> 
                                <p> <a onClick='ocultarDetalles(".$cita['idCita'].")'>Ocultar </a> </p>  </blockqoute></div> </td>
                <td><a onclick='verCita(\"".$cita['idCita']."\")'><img src='images/editaCita.png' title='Ver/editar' style='width: 20px' /></a> 
                   <a onclick='verOpciones(\"".$cita['idCita']."\")'><img src='images/cancelarCita2.png' title='Cancelar cita' style='width: 20px' /></a>
                </td></tr>";
       }
       $seccion.="</tbody></table></div></div></div>";
   }
        $seccion.="</div></div><br />";
    }
    $fecha1=explode(" ", $fechaI);
    $fI=strtotime($fecha1[0]);
    $fh=strtotime(date ( 'Y-m-d'));
    $fA=strtotime($fechaInicio);
    
    $disable="";
    if ($fI<=$fh){
        $disable="disabled";
    }
    if ($fA<$fh){
        $fechaInicio=date ( 'Y-m-d');
    }
    
    $btn='<a id="btnAnt" class="button small '.$disable.'">Anterior semana</a>';
    $r->assign('divTabla', 'innerHTML', $seccion);
    $r->assign('fechasEntre', 'innerHTML', $rango);
    $r->assign('divBtnAnt', 'innerHTML', $btn);
    $r->call('colocaFechas', $fechaFin,$fechaI,$fechaInicio);
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