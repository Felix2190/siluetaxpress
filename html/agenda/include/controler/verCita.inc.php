<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.hojaclinica.inc.php";
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


// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------------------Seccion AJAX--------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

$xajax = new xajax();


function cargarInformacion($informacion){
    $r=new xajaxResponse();
    
    $arrTiempo=array();
    for ($tiempoI=10;$tiempoI<=240;$tiempoI+=10){
        $hr=intval($tiempoI/60);
        $min=$tiempoI%60;
        $duracion=($hr>0?($hr. ' hora'.($hr>1?'s':'')).($min>0?(', '.$min.' minutos'):''):('').$min.' minutos');
        $arrTiempo[$tiempoI]=$duracion;
    }
    
    $duracion=obtenCombo($arrTiempo,'Seleccione una opci&oacute;n');
    
    
    $textCita= "<div class='7u 12u$(small)'><div class='box'><div class='row'><div class='3u 12u$(xsmall)'><h3>Informaci&oacute;n</h3></div></div>
					<div class='row'>
					<ul><li><strong>Fecha: </strong>".$informacion['fecha']."</li><li><strong>Paciente: </strong>".$informacion['nombre_paciente']."</li>
                        <li><strong>Sucursal: </strong>".$informacion['sucursal']."</li>
						<li><strong>Horario: </strong>".$informacion['hora']." - ".$informacion['horaFin']."</li><li><strong>Consulta: </strong>".$informacion['tipoConsulta']."</li>
                        <li><strong>Servicio: </strong>".$informacion['servicio']."</li>
						<li><strong>Cabina: </strong>".$informacion['cabina']."</li> <li><strong>Responsable: </strong>".$informacion['nombre_usuario']."</li>
                    <li><strong>Estatus: </strong>".$informacion['descripcion']."</li>";
    if (intval($informacion['idUsuarioCancela'])>0)
        $textCita.= "<li><strong>Cancelada por: </strong>$</li>";
        
        $textCita.= "</ul></div>
					<div class='row'><div class='3u 12u$(xsmall)'><h4>Editar</h4></div></div>
					<div class='row'><div class='2u 12u$(xsmall)'><label>Duraci&oacute;n:</label></div>
					 <div class='6u 12u$(xsmall)'><div class='select-wrapper'><select name='demo-category' id='slcDuracion'>$duracion</select></div></div></div><br />
					<div class='row'><div class='2u 12u$(xsmall)'><label>Hora:</label></div>
					<div class='3u 12u$(xsmall)'><div class='select-wrapper'><select name='demo-category' id='slcHr'><option value=''></option></select></div></div>
					<div class='3u 12u$(xsmall)'><div class='select-wrapper'><select name='demo-category' id='slcMin'><option value=''></option></select></div></div>
					</div></div></div>
				    <div class='5u 12u$(small)'><div class='12u'>
        			<div class='box'><div class='row'><div class='3u 12u$(xsmall)'><h3>Comentarios</h3></div></div>
        			<div class='row'><br />";
        $arrComentarios=array();
        if (intval($arrComentarios)>0)
            foreach ($arrComentarios as $comentario)
                $textCita.="<div class='12u'>$comentario <hr /></div>";
                else
                    $textCita.="<i>No hay comentarios. <br /></i>";
                    
        $recordatorio="";
        if ($informacion['enviarRecordatorio2'])
             $recordatorio="disabled";
                    
                    $textCita.="</div></div><br />";
                    if ($informacion['descripcion']=="Nueva")
                        $textCita.="<div class='12u'><div class='box'><div class='row'><div class='3u 12u$(xsmall)'><h3>Opciones</h3></div></div><br />
        						<div class='row'><div class='6u 12u$(xsmall)'><a id='btnCancelar' class='button' >Cancelar cita</a></div>
        						<div class='6u 12u$(xsmall)'>
        						<input id='checkRecordatorio' $recordatorio name='checkRecordatorio' type='checkbox' > <label for='checkRecordatorio'>Enviar recordatorio</label>
        						</div></div></div></div>";
                        
                        $textCita.="</div></div>";
                        
    $r->assign("divInformacion", "innerHTML", $textCita);
                        
    return $r;
    
}

$xajax->registerFunction("cargarInformacion");

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