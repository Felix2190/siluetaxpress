<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.comentarioscita.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.hojaclinica.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.consulta.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.citaactualizacion.inc.php";
require_once FOLDER_INCLUDE_AGENDA.'controler/adminFunciones.inc.php';
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

function _obtenCombo($array,$idem){
    $combo='';
    foreach ($array as $key => $opcion)
        $combo.="<option value='$key' ".($key==$idem?"selected":"").">$opcion</option>";
        return $combo;
}
// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------------------Seccion AJAX--------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

$xajax = new xajax();


function cargarInformacion($informacion,$txtDuracion,$hora,$minuto,$cabina,$chkbox,$txtComentario,$txtFecha){
    $r=new xajaxResponse();
    global $objSession;
    $arrTiempo=array();
    for ($tiempoI=10;$tiempoI<=240;$tiempoI+=10){
        $hr=intval($tiempoI/60);
        $min=$tiempoI%60;
        $_duracion=($hr>0?($hr. ' hora'.($hr>1?'s':'')).($min>0?(', '.$min.' minutos'):''):('').$min.' minutos');
        $arrTiempo[$tiempoI]=$_duracion;
    }
    $hr=intval(intval($informacion['duracion'])/60);
    $min=intval(intval($informacion['duracion'])%60);
    $duracion_=($hr>0?($hr. ' hora'.($hr>1?'s':'')).($min>0?(', '.$min.' minutos'):''):('').$min.' minutos');
    
    $duracion=_obtenCombo($arrTiempo,intval($txtDuracion));

    $arrConsultorios=obtenerConsultorios($informacion['idConsulta'],$informacion['idSucursal']);
    $consultorios=_obtenCombo($arrConsultorios,$cabina);
    
    $horarios=obtenerHorarioDisponibles($informacion['idConsulta'],$informacion['idSucursal'],$informacion['fecha'],$informacion['duracion'],$informacion['idCabina']);
    
    $comentarios= new ModeloComentarioscita();
    $comentarios->setIdCita($informacion['idCita']);
    $arrComentarios=$comentarios->obtenerComentarios();
    $AUX=explode(":", $informacion['hora']);
    
    $auxFecha=explode('-',$informacion['fecha']);
    $auxFecha="$auxFecha[2] de ".obtenMes(intval($auxFecha[1]))." del $auxFecha[0]";
    
    $textCita= "<div class='7u 12u$(small)'><div class='box'><div class='row'><div class='3u 12u$(xsmall)'><h3>Informaci&oacute;n</h3></div></div>
					<div class='row'>
                    <input type='hidden' id='hdnSucursal' value='".$informacion['idSucursal']."'/>
                    <input type='hidden' id='hdnCabina' value='".$informacion['idCabina']."'/>
                    <input type='hidden' id='hdnDuracion' value='".$informacion['duracion']."'/>
						<input type='hidden' id='hdnConsulta' value='".$informacion['idConsulta']."'/>
                    <input type='hidden' id='hdnHR' value='".$AUX[0]."'/><input type='hidden' id='hdnMIN' value='".$AUX[1]."'/>
						<input type='hidden' id='hdnFecha' value='".$informacion['fecha']."'/>
						
					<ul><li><strong>Fecha: </strong>".$auxFecha."</li><li><strong>Paciente: </strong>".$informacion['nombre_paciente']."</li>
                        <li><strong>Sucursal: </strong>".$informacion['sucursal']."</li>
						<li><strong>Horario: </strong>".$informacion['hora']." - ".$informacion['horaFin']."</li><li><strong>Consulta: </strong>".$informacion['tipoConsulta']."</li>
                        <li><strong>Duracion: </strong>".$duracion_."</li>
                        <li><strong>Servicio: </strong>".$informacion['servicio']."</li>
						<li><strong>Cabina: </strong>".$informacion['cabina']."</li> <li><strong>Responsable: </strong>".$informacion['nombre_usuario']."</li>
                    <li><strong>Estatus: </strong>".$informacion['descripcion']."</li>";
    if (intval($informacion['idUsuarioCancela'])>0&&($informacion['descripcion']=="Cancelada por el paciente"||$informacion['descripcion']=="Cancelada por el encargado"))
        $textCita.= "<li><strong>Cancelada por: </strong>".$informacion['personaCancela']."</li>";
        
     if ($informacion['descripcion']=='Nueva'/*&&($objSession->getidUsuario()==$informacion['idUsuario']||$objSession->getidRol()==1)*/)
        $textCita.= "</ul></div>
					<div class='row'><div class='3u 12u$(xsmall)'><h4>Editar</h4></div></div>
					<div class='row'><div class='2u 12u$(xsmall)'><label>D&iacute;a:</label></div>
					 <div class='6u 12u$(xsmall)'>
                            <input type='text' id='txtFecha' placeholder='AAAA-MM-DD' readonly='readonly' class='datepicker'  value='".$txtFecha."'/>
                     </div></div><br />
					
                    <div class='row'><div class='2u 12u$(xsmall)'><label>Duraci&oacute;n:</label></div>
					 <div class='6u 12u$(xsmall)'><div class='select-wrapper'><select name='demo-category' id='slcDuracion'>$duracion</select></div></div></div><br />
					<div class='row'><div class='2u 12u$(xsmall)'><label>Consultorio:</label></div>
					 <div class='6u 12u$(xsmall)'><div class='select-wrapper'><select name='demo-category' id='slcConsultorio'>$consultorios</select></div></div></div><br />
					<div class='row'><div class='2u 12u$(xsmall)'><label>Hora:</label></div>
					<div class='3u 12u$(xsmall)'><div class='select-wrapper'><select name='demo-category' id='slcHr'><option value=''></option></select></div></div>
					<div class='3u 12u$(xsmall)'><div class='select-wrapper'><select name='demo-category' id='slcMin'><option value=''></option></select></div></div>
					";
				   
        $textCita.= "</div></div></div><div class='5u 12u$(small)'><div class='12u'>
        			<div class='box'><div class='row'><div class='3u 12u$(xsmall)'><h3>Comentarios</h3></div></div>
        			<div class='row'><br />";
        
        if (intval($arrComentarios)>0){
            foreach ($arrComentarios as $comentario){
                $auxFecha=explode('-',$comentario['fecha']);
                $auxFecha="$auxFecha[2]/".obtenMes(intval($auxFecha[1]))."/$auxFecha[0]";
                $textCita.="<div class='12u'><strong>[$auxFecha | ".$comentario['hora']."]</strong> ".$comentario['comentario']." <hr /></div>";
            }
            
        }else
            $textCita.="<div class='12u'><i>No hay comentarios. <br /></i></div><div class='12u'><hr /></div>";
                
        if (($informacion['descripcion']=="En curso"||$informacion['descripcion']=="Nueva")&&($objSession->getidUsuario()==$informacion['idUsuario']||$objSession->getidRol()==1))
            $textCita.="<div class='12u'><textarea rows='2' cols='' id='txtComentarios'>$txtComentario</textarea></div>
                        <div class='12u'><br /><a id='btnAgregar' class='button' ><img src='images/agregar.png' style='width: 18px;' />&ensp;Agregar comentario</a></div>";
                    
     if ($informacion['descripcion']=="Nueva"&&($objSession->getidUsuario()==$informacion['idUsuario']||$objSession->getidRol()==1)){
        $recordatorio="";
        if ($chkbox=='1'||$chkbox=='true')
             $recordatorio="checked";
         if ($informacion['recordatorio2']=='1')
             $recordatorio.=" disabled";
         
                    $textCita.="</div></div><br />";
                    if ($informacion['descripcion']=="Nueva")
                        $textCita.="<div class='12u'><div class='box'><div class='row'><div class='3u 12u$(xsmall)'><h3>Opciones</h3></div></div><br />
        						<div class='row'><div class='6u 12u$(xsmall)'><a id='btnCancelar' class='button' ><img src='images/cancelarCita.png' style='width: 18px;' />&ensp;Cancelar cita</a></div>
        			 			<div class='6u 12u$(xsmall)'>
        						<input id='checkRecordatorio' $recordatorio name='checkRecordatorio' type='checkbox' > <label for='checkRecordatorio'>Enviar recordatorio</label>
        						</div></div></div></div>";
        }
        $textCita.="</div></div>";
                        
                        
    $r->assign("divInformacion", "innerHTML", $textCita);
    
    $visible="none";
    if ($informacion['descripcion']=="Nueva"){
        $r->call("cargarHorasMin",$horarios,$hora,$minuto);
        $visible="si";
    }
    $r->call("visualizar",$visible,$informacion['descripcion']);
    return $r;
    
}

$xajax->registerFunction("cargarInformacion");

function cargarActualizaciones($informacion){
    $r=new xajaxResponse();
    $arrEncabezado=array('Fecha de actualizaci&oacute;n','Tipo','Usuario','Consultorio','Hora','Duraci&oacute;n');
    if (intval($informacion)>0){
        $tabla="<div class='box'><div class='row'><div class='3u 12u$(xsmall)'><h3>Actualizaciones</h3></div></div><div class='row'><div class='12u'><table><thead><tr>";
        foreach ($arrEncabezado as $idem){
            $tabla.="<th>$idem</th>";
        }
        
        $tabla.="</tr></thead><tbody>";
        
        foreach ($informacion as $cita){
            $fecha=explode("-", $cita['fecha_']);
            
            
                $hr=intval($cita['duracion']/60);
                $min=$cita['duracion']%60;
                $duracion=($hr>0?($hr. ' hora'.($hr>1?'s':'')).($min>0?(', '.$min.' minutos'):''):('').$min.' minutos');
                
                
      $tabla.="<tr><td>$fecha[2] de ".obtenMes(''.intval($fecha[1]))." del $fecha[0] [".$cita['hora_']."]</td>
                        <td > ".$cita['tipo']."</td><td>".$cita['nombre_usuario']."</td><td >".$cita['cabina']."</td><td>".$cita['hora']."</td><td>".$duracion."</td></tr>";
    }
    $tabla.="</tbody></table></div></div></div><br />";
    }else{
        $tabla="<div class='box'><div class='row'><div class='3u 12u$(xsmall)'><h3>Actualizaciones</h3></div></div><div class='row'>
                    <div class='12u'><i>No hay actualizaciones. <br /></i></div></div></div>";
    }
    $r->assign('divTablaAct', 'innerHTML', $tabla);
    return $r;
    
}

$xajax->registerFunction("cargarActualizaciones");


function agregaComentario($txtComentario,$idCita){
    $r=new xajaxResponse();
    $comentarios= new ModeloComentarioscita();
    $comentarios->setIdCita($idCita);
    $comentarios->setFechaComentario(date("Y-m-d H:i:s"));
    $comentarios->setComentario($txtComentario);
    $comentarios->Guardar();
    
    if ($comentarios->getError()){
        $r->call('mostrarMsjError',$comentarios->getStrError(),5);
        return $r;
    }
    $r->call('mostrarMsjExito','Se agreg&oacute; correctamente el comentario!',3);
    $r->call('actualizarCita');
    return $r;
    
}

$xajax->registerFunction("agregaComentario");

function guardarCambios($idCita,$duracion,$hora,$minuto,$consultorio,$chkbox,$fecha){
    global $objSession;
    $r=new xajaxResponse();
    $cita = new ModeloCita();
    $cita->setIdCita($idCita);
    
//    $fecha=explode(" ",$cita->getFechaInicio());
    
    $fecha=$fecha." $hora:$minuto:00";
    
    $cita->setFechaInicio($fecha);
    $cita->setDuracion($duracion);
    $cita->setIdCabina($consultorio);
    $auxFecha = strtotime ( '+'.$duracion.' minute' , strtotime ( $fecha ) ) ;
    $cita->setFechaFin(date( 'Y-m-d H:i:s' , $auxFecha));
    
    $cita->unsetEnviarRecordatorio2();
    if ($chkbox=="true")
       $cita->setEnviarRecordatorio2();
    
       $cita->Guardar();
       if ($cita->getError()){
           $r->call('mostrarMsjError',$cita->getStrError(),5);
           return $r;
       }
       
       //tabla actualizacion
       $citaactualizacion = new ModeloCitaactualizacion();
       $citaactualizacion->setHora($hora.':'.$minuto);
       $citaactualizacion->setIdCabina($consultorio);
       $citaactualizacion->setFecha(date( 'Y-m-d H:i:s'));
       $citaactualizacion->setDuracion($duracion);
       $citaactualizacion->setIdUsuario($objSession->getidUsuario());
       $citaactualizacion->setIdCita($cita->getIdCita());
       
       $nSucursal= new ModeloSucursal();
       $nSucursal->setIdSucursal($cita->getIdSucursal());
       $nConsulta= new ModeloConsulta();
       $nConsulta->setIdConsulta($cita->getIdConsulta());
       
       if (strlen($cita->getTelefonoPaciente())==12){
           $Res=enviaSMS_CitaModificada($cita->getTelefonoPaciente(), date("d/m/Y",strtotime($fecha)), "$hora:$minuto", $nSucursal->getSucursal(), $idCita);
           $citaactualizacion->setSms();
       } else{
          $r->call('mostrarMsjError',"No se puede enviar el SMS, el n&uacute;mero es incorrecto ",3);
       }
       
       
       $citaactualizacion->Guardar();
       if ($citaactualizacion->getError()){
           $r->call('mostrarMsjError',$citaactualizacion->getStrError(),5);
           return $r;
       }
       
               
       $r->call('mostrarMsjExito','Se han guardado correctamente los cambios!' , 3);
       
       $r->redirect('verCita.php',4);
    return $r;
}
$xajax->registerFunction("guardarCambios");
$xajax->processRequest();


// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

if (!isset($_SESSION['verCita'])){
    header("Location: listadoCitas.php");
}

$aux =$_SESSION['verCita'];
$idCita=$aux['idCita'];

$citas = new ModeloCita();
$citas->setIdCita($idCita);

if ($citas->getIdCita()>0){
    $paciente = new ModeloPaciente();
    $paciente->setIdPaciente($citas->getIdPaciente());
    
}else {
    header("Location: listadoCitas.php");
}

?>