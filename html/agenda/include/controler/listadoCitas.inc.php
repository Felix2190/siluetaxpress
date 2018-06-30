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
    $fecha1=explode("-", $fechaI);
    $fechaFin = date ("Y-m-d",strtotime ( '+7 day' , strtotime ( $fechaI) ) );
    $fechaInicio = date ("Y-m-d",strtotime ( '-7 day' , strtotime ( $fechaI) ) );
    $fecha2=explode("-", $fechaFin);
    $rango="$fecha1[2]/".obtenMes(''.intval($fecha1[1]))."/$fecha1[0] al $fecha2[2]/".obtenMes(''.intval($fecha2[1]))."/$fecha2[0]";
    
    $arrEncabezado=array('Hora','Paciente','Consulta','Detalles','Opciones');
    if ($objSession->getidRol()==1)
        $arrEncabezado=array( 'Hora','Paciente','Consulta','Detalles','Sucursal','Opciones');
//        $arrEncabezado=array('ID Consulta', 'Fecha','Hora','Paciente','Consulta','Duraci&oacute;n','Sucursal','Opciones');
        $tabla="";
        
   foreach ($informacion as $fecha_=>$Citas){
        $fecha=explode("-", $fecha_);
        
        $tabla.="<div class='row'><div class='3u 12u$(xsmall)'><h4>$fecha[2] de ".obtenMes(''.intval($fecha[1]))." del $fecha[0]</h4>
    								</div></div><div class='row'><div class='12u'><table><thead><tr>";
        foreach ($arrEncabezado as $idem){
            $colspan="";
            if ($idem=='Paciente')
               $colspan=" colspan='2'";
            if ($idem=='Detalles')
                $colspan=" colspan='3'";
            $tabla.="<th $colspan>$idem</th>";
        }
        
        $tabla.="</tr></thead><tbody>";
        foreach ($Citas as $id=>$cita){
            $sucursal="";
            if ($objSession->getidRol()==1)
                $sucursal="<td>".$cita['sucursal']."</td>";
            
            $hr=intval($cita['duracion']/60);
            $min=$cita['duracion']%60;
            $duracion=($hr>0?($hr. ' hora'.($hr>1?'s':'')).($min>0?(', '.$min.' minutos'):''):('').$min.' minutos');
            
            $detalles="<div id='l".$cita['idCita']."'> <p> <strong>Consultorio: </strong> ".$cita['cabina']."</p>
                        <a onClick='verDetalles(".$cita['idCita'].")'>Ver detalles </a> </div>

                        <div id='c".$cita['idCita']."' style='display: none'; > <blockqoute> 
                            <p> <strong>Servicio: </strong> ".$cita['servicio']."</p>
                            <p> <strong>Consultorio: </strong> ".$cita['cabina']."</p>
                            <p> <strong>Duraci&oacute;n: </strong> ".$duracion."</p> 
                            <p> <a onClick='ocultarDetalles(".$cita['idCita'].")'>Ocultar </a> </p>  </blockqoute></div>";
            
            
            $tabla.="<tr><td>".$cita['hora']."</td><td colspan='2'>".$cita['nombre_paciente']."</td><td>".$cita['tipoConsulta']."</td>
                    <td colspan='3'>".$detalles."</td>$sucursal<td></td></tr>";
        }
        $tabla.="</tbody></table></div></div><br />";
    }
    $fI=strtotime($fechaI);
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
    $r->assign('divTabla', 'innerHTML', $tabla);
    $r->assign('fechasEntre', 'innerHTML', $rango);
    $r->assign('divBtnAnt', 'innerHTML', $btn);
    $r->call('colocaFechas', $fechaFin,$fechaI,$fechaInicio);
    return $r;
    
}
$xajax->registerFunction("consultarCitas");

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