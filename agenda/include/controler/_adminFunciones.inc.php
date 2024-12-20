<?php

ini_set('max_execution_time', 300);
ini_set('max_input_time', 300);

if(!empty($_FILES['imagen']))
{
    $carpeta=FOLDER_FOTOS;
    $archivo=$_FILES['imagen'];
    if($archivo['name']!=''){
        $tempFile = $archivo['tmp_name'];
        if (!file_exists($carpeta))
            mkdir($carpeta,0777);
            $targetFile =  ($_POST['id'].'_'.$archivo['name']);
            $targetFileFinal = $carpeta.$targetFile;
            try{
                move_uploaded_file($tempFile,$targetFileFinal);
                echo "../tmp/fotosperfil/".$targetFile;
            }catch(Exception $e){
                echo '';
            }
    }
    
}

if(!empty($_FILES['imagenCorreo']))
{
    
    $carpeta=$_SERVER['DOCUMENT_ROOT']."/tmp/notificaciones/";
//    echo $carpeta;
    $archivo=$_FILES['imagenCorreo'];
    if($archivo['name']!=''){
        $tempFile = $archivo['tmp_name'];
        if (!file_exists($carpeta))
            mkdir($carpeta,0777);
            $targetFile =  ($_POST['id'].'_'.$archivo['name']);
            $targetFileFinal = $carpeta.$targetFile;
            try{
              move_uploaded_file($tempFile,$targetFileFinal);
                  echo "../tmp/fotosperfil/".$targetFile;
                }catch(Exception $e){
                    echo false;
                }
    }
    
}

if (isset($_POST['sucursalesRuleta'])){
    require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
    $sucursal = new ModeloSucursal();
    $sucursal->setIdFranquicia( $_POST['sucursalesRuleta']);
    $combo='<option value="">Selecciona una opci&oacute;n</option>';
    foreach ($sucursal->obtenerSucuralesFranquicia() as $key => $opcion)
        $combo.='<option value="'.$key.'" >'.$opcion.'</option>';
        
        echo json_encode($combo);
}

if (isset($_POST['idPacienteGanador'])&&isset($_POST['codigoPromo'])){
    require_once FOLDER_MODEL_EXTEND. "model.ganadores_promocion.inc.php";
    $codigoPromo = new ModeloGanadores_promocion();
    $info = $codigoPromo->consultaCodigo($_POST['idPacienteGanador'], $_POST['codigoPromo']);
    if (count($info)>0){
        if ($info['estatus']=="Utilizado"){
            echo json_encode(array(false,"El c&oacute;digo ya fue canjeado!"));
        }else {
            echo json_encode(array(true,$info['idGanador'],$info['promocion']));
            
        }
    }else{
        echo json_encode(array(false,"El c&oacute;digo es inv&aacute;lido!"));
    }
}

if (isset($_POST['numTel'])){
    require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
    $paciente = new ModeloPaciente();
    $arrPaciente=$paciente->obtenerInfoPacienteByCelular($_POST['numTel']);
    if (count($arrPaciente)>0){
        require_once FOLDER_MODEL_EXTEND. "model.promociones_ruleta.inc.php";
        $promocion = new ModeloPromociones_ruleta();
        echo json_encode(array(true,$arrPaciente['idPaciente'],$arrPaciente['nombrePaciente'],$promocion->obtenerPromociones($arrPaciente['idFranquicia'])));
    }else 
        echo json_encode(array(false));
}

if (isset($_POST['idPacienteRuleta'])){
    $arrCodigos = obtenerPromocionesMesActual($_POST['idPacienteRuleta']);
    echo json_encode(array(count($arrCodigos),$arrCodigos));
}

function obtenerPromocionesMesActual($idPaciente){
    require_once FOLDER_MODEL_EXTEND. "model.ganadores_promocion.inc.php";
    $codigos = new ModeloGanadores_promocion();
    return $codigos->obtenerCodigosByPersonal($idPaciente);
}

if (isset($_POST['idEncuesta'])){
    require_once FOLDER_MODEL_EXTEND. "model.encuesta.inc.php";
    $encuesta = new ModeloEncuesta();
    $encuesta->setIdEncuesta($_POST['idEncuesta']);
    if ($encuesta->getIdEncuesta()>0){
        if ($encuesta->getEstatus()==1){
            echo json_encode(array(false,"Esta encuesta ya fue evaluada! Si no ha sido usted, comun&iacute;quese a Silueta Express"));
        }else{
            require_once FOLDER_MODEL_EXTEND. "model.personal.inc.php";
            $personal = new ModeloPersonal();
            $arrPersonal=$personal->obtenerPersonal($encuesta->getIdTipoConsulta(), $encuesta->getIdSucursal());
            if (count($arrPersonal)>0){
                $txtRadio="";
                foreach ($arrPersonal as $id=> $nombre){
                    $txtRadio.="<input id='demo-priority-$id' name='personal' value='$id' type='radio' >
											<label for='demo-priority-$id' style='float: left; padding-right: 40px;'>$nombre</label>";
                }
                
                $arrPersonal=$personal->obtenerPersonal(4, $encuesta->getIdSucursal());
                $txtRadioR="";
                if (count($arrPersonal)>0)
                    foreach ($arrPersonal as $id=> $nombre){
                        $txtRadioR.="<input id='demo-priority-$id' name='recepcion' value='$id' type='radio' checked>
											<label for='demo-priority-$id' style='float: left; padding-right: 40px;'>$nombre</label>";
                    }
                $atender="terapista";
                if(intval($encuesta->getIdTipoConsulta())==1){
                    $atender="nutri&oacute;loga";
                }
                    
                require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
                $sucursal = new ModeloSucursal();
                $sucursal->setIdSucursal($encuesta->getIdSucursal());
                echo json_encode(array(true,$txtRadio,$sucursal->getSucursal(),$txtRadioR!=""?true:false,$txtRadioR,$atender));
            }else {
                echo json_encode(array(false,"No hay personal de atenci&oacute;n para el ID encuesta!"));
            }
        }
    }else 
    echo json_encode(array(false,"No existe el ID ingresado!"));
}

if (isset($_POST['idPacienteInasistencias'])){
    require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    $cita = new ModeloCita();
    $cita->setIdPaciente($_POST['idPacienteInasistencias']);
    echo $cita->totalInasistencias();
}

if (isset($_POST['sucursalVerificaAsistencia'])){
require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    $cita = new ModeloCita();
        $cita->setIdSucursal($_POST['sucursalVerificaAsistencia']);
                echo json_encode($cita->verificaAsistenciaPaciente(date("Y-m-d H:i:s")));
}

if (isset($_POST['listadoVerifica'])){
    require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    $cita = new ModeloCita();
    $cita->setIdSucursal($objSession->getIdSucursal());
    echo json_encode($cita->listadoverificaAsistenciaPaciente());
}

if (isset($_POST['idCitaVerifica'])&&isset($_POST['estatus'])){
    $estatus="no_realizada";
    if ($_POST['estatus']=='true') {
        $estatus="realizada";
    }
    require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    $cita = new ModeloCita();
    $cita->setIdCita($_POST['idCitaVerifica']);
    $cita->setEstatus($estatus);
    $cita->unsetVerificaAsistencia();
    $cita->Guardar();
    
    if ($_POST['estatus']=='true') {
        require_once FOLDER_MODEL_EXTEND. "model.encuesta.inc.php";
        $encuesta = new ModeloEncuesta();
        $encuesta->setIdSucursal($cita->getIdSucursal());
        $encuesta->setIdTipoConsulta($cita->getIdConsulta());
        $encuesta->setIdPaciente($cita->getIdPaciente());
        $encuesta->setIdUsuarioRegistro($objSession->getidUsuario());
        $encuesta->setEvaluacion(0);
        $encuesta->unsetEstatus();
        $encuesta->setFechaRegistro(date("Y-m-d H:i:s"));
        $encuesta->Guardar();
        if (!$encuesta->getError())
            //echo json_encode(utf8_encode("Silueta Express le agradece su preferencia. Por favor podr�a realizar una encuesta de Satisfaci�n en el sig. link? https://bit.ly/3GVXqnM ingresando el ID ".$encuesta->getIdEncuesta()));
            echo json_encode(utf8_encode("Silueta Express agradece tu visita. Ay�danos a mejorar el servicio contestando esta peque�a encuesta AN�NIMA de 3 preguntas r�pidas link https://bit.ly/3GVXqnM ingresando el ID ".$encuesta->getIdEncuesta()));
            else 
            echo "";
    }
    else{
        echo json_encode(utf8_encode("Lamentamos mucho que no hayas podido asistir a tu cita el d�a de hoy, te pedimos para la siguiente cancelar por lo menos con 24 hrs de antelaci�n, recuerda que despu�s de 3 citas con falta sin cancelar se te tomar� como realizada. Todo esto con finalidad de mejorar el servicio y tener disponibilidad para otros pacientes. Estamos a tus �rdenes Atte. Silueta Express"));
    }
}

if (isset($_POST['pacientes'])){
    require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
    $pacientes = new ModeloPaciente();
    $pacientes->setIdSucursal($_POST['pacientes']);
    echo json_encode(obtenCombo($pacientes->obtenerPacientes(),'Seleccione una opci&oacute;n'));
}

if (isset($_POST['franquicias'])){
    require_once FOLDER_MODEL_EXTEND. "model.franquicia.inc.php";
    $franquicia = new ModeloFranquicia();
    $combo='';
    foreach ($franquicia->obtenerFranquicias() as $key => $opcion)
        $combo.='<option value="'.$key.'" >'.$opcion.'</option>';
        
        echo json_encode($combo);
}

if (isset($_POST['idFranquiciaLogin'])){
    require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
    $sucursal = new ModeloSucursal();
    $sucursal->setIdFranquicia($_POST['idFranquiciaLogin']);
    $combo='<option value="">Selecciona una opci&oacute;n</option>';
    foreach ($sucursal->obtenerSucuralesFranquicia() as $key => $opcion)
        $combo.='<option value="'.$key.'" >'.$opcion.'</option>';
        
        echo $combo;
}

if (isset($_POST['sucursalFranquicia'])){
    require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
    $sucursal = new ModeloSucursal();
    $combo='<option value="">Todas</option>';
    foreach ($sucursal->obtenerSucuralesFranquiciaSesion() as $key => $opcion)
        $combo.='<option value="'.$key.'" '.($key==$objSession->getIdSucursal()?'selected':'').'>'.$opcion.'</option>';
        
        echo $combo;
}


if (isset($_POST['sucursalCitaNueva'])){
    require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
    $sucursal = new ModeloSucursal();
    $combo='';
    foreach ($sucursal->obtenerSucuralesFranquiciaSesion() as $key => $opcion)
        $combo.='<option value="'.$key.'" '.($key==$objSession->getIdSucursal()?'selected':'').'>'.$opcion.'</option>';
        
        echo $combo;
}

if (isset($_POST['sucursales'])){
    require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
    $sucursal = new ModeloSucursal();
    $sucursal->setIdFranquicia( $objSession->getIdFranquicia());
    $combo='';
    foreach ($sucursal->obtenerSucuralesFranquicia() as $key => $opcion)
        $combo.='<option value="'.$key.'" '.($key==$objSession->getIdSucursal()?'selected':'').'>'.$opcion.'</option>';
        
    echo json_encode($combo);
}

if (isset($_POST['tiposConsulta'])){
    require_once FOLDER_MODEL_EXTEND. "model.consulta.inc.php";
    $consultas = new ModeloConsulta();
    echo json_encode(obtenCombo($consultas->obtenerConsulta(),'Seleccione una opci&oacute;n'));
}

if (isset($_POST['consultaArea'])){
    require_once FOLDER_MODEL_EXTEND. "model.consulta.inc.php";
    $consultas = new ModeloConsulta();
    echo json_encode(obtenCombo($consultas->obtenerArea(),'Seleccione una opci&oacute;n'));
}

if (isset($_POST['idConsulta'])&&isset($_POST['idSucursal'])&&isset($_POST['fecha'])&&isset($_POST['duracion'])&&isset($_POST['idConsultorio'])){
    echo obtenerHorarioDisponibles($_POST['idConsulta'],$_POST['idSucursal'],$_POST['fecha'],$_POST['duracion'],$_POST['idConsultorio']);
}

if (isset($_POST['idConsulta_'])){
    require_once FOLDER_MODEL_EXTEND. "model.servicio.inc.php";
    $servicio = new ModeloServicio();
    $servicio->setIdConsulta($_POST['idConsulta_']);
    echo json_encode($servicio->obtenerConsulta());
}

if (isset($_POST['fechaConvertir'])&&isset($_POST['horaInicial'])&&isset($_POST['duracion'])&&isset($_POST['sucursal'])){
    $dias = array('','lunes','martes','miercoles','jueves','viernes','sabado','domingo');
    
    // obtener rangos fecha
    $fechaCitaInicio=$_POST['fechaConvertir'].' '.$_POST['horaInicial'];
    $fechaCitaFinal= date('Y-m-d H:i:s',strtotime ( '+'.intval($_POST['duracion']).' min' , strtotime ( $fechaCitaInicio) ) );
    $dia=date('N', strtotime($_POST['fechaConvertir']));
    $horaValida = 'false';
    if ($dia==6){
        $horaValida = 'true';
    }else {
        require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
        $sucursal=new ModeloSucursal();
        $sucursal->setIdSucursal($_POST['sucursal']);
        $hrInicio = $sucursal->getSabadoEntrada();
        $hrFin = $sucursal->getSabadoSalida();
    
    $fechaRangoInicio=$_POST['fechaConvertir'].' '.$hrInicio.':00:00';
    $fechaRangoFinal=$_POST['fechaConvertir'].' '.$hrFin.':00:00';
    
    $tcitaI=strtotime($fechaCitaInicio);
    $tcitaF=strtotime($fechaCitaFinal);
    $trangoI=strtotime($fechaRangoInicio);
    $trangoF=strtotime($fechaRangoFinal);
    
    if ($tcitaI>=$trangoI&&$tcitaF<=$trangoF)
        $horaValida='true';
    
    }
    echo json_encode(array(strtolower($dias[$dia]),$horaValida));
}

if (isset($_POST['sucursal'])&&isset($_POST['paciente'])&&isset($_POST['usuario'])&&isset($_POST['cabina'])&&isset($_POST['fechaInicio'])){
    require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    $cita = new ModeloCita();
    if ($_POST['sucursal']!='')
        $cita->setIdSucursal($_POST['sucursal']);
        if ($_POST['paciente']!='')
            $cita->setIdPaciente($_POST['paciente']);
 //           if ($_POST['usuario']!='')
//                $cita->setIdUsuario($_POST['usuario']);
                if ($_POST['cabina']!='')
                    $cita->setIdCabina($_POST['cabina']);
                    
   $cita->setFechaInicio($_POST['fechaInicio']);
    echo json_encode($cita->obtenerCitas());
}

if (isset($_POST['Consulta'])&&isset($_POST['Sucursal'])){
    echo obtenCombo(obtenerConsultorios($_POST['Consulta'],$_POST['Sucursal']),'Selecciona una opci&oacute;n');
}

if (isset($_POST['Sucursal'])&&isset($_POST['Consultorio'])&&isset($_POST['fechaInicio'])){
    echo obtenerIntervalosDisponibles($_POST['Sucursal'], $_POST['Consultorio'], $_POST['fechaInicio']);
}

if (isset($_POST['listadoPacientes'])){
    echo obtenerListadoPacientes($_POST['listadoPacientes']);
}

if (isset($_POST['idSucursalB'])&&isset($_POST['fechaB'])){
    echo obtenerHorarioByDia($_POST['idSucursalB'],$_POST['fechaB']);
}

if (isset($_POST['sucursalB'])&&isset($_POST['pacienteB'])&&isset($_POST['estatusB'])&&isset($_POST['cabinaB'])&&isset($_POST['fechaInicioB'])&&isset($_POST['horaB'])&&isset($_POST['consultaB'])){
    require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    $cita = new ModeloCita();
    if ($_POST['sucursalB']!='')
        $cita->setIdSucursal($_POST['sucursalB']);
        if ($_POST['pacienteB']!='')
            $cita->setIdPaciente($_POST['pacienteB']);
            if ($_POST['estatusB']!='')
                $cita->setEstatus($_POST['estatusB']);
                if ($_POST['cabinaB']!='')
                    $cita->setIdCabina($_POST['cabinaB']);
                    if ($_POST['consultaB']!='')
                    $cita->setIdConsulta($_POST['consultaB']);
                    echo json_encode($cita->buscarCitas($_POST['fechaInicioB'],$_POST['horaB']));
}

if (isset($_POST['estatusCita'])){
    require_once FOLDER_MODEL_EXTEND. "model.estatuscita.inc.php";
    $estatus = new ModeloEstatuscita();
  echo json_encode(obtenCombo($estatus->obtenerEstatus(),'Seleccione una opci&oacute;n'));
}

if (isset($_POST['password'])){
    require_once FOLDER_MODEL_EXTEND. "model.login.inc.php";
    $login = new ModeloLogin();
    echo $login->validaPassword($_POST['password']);
}

if (isset($_POST['passwordNuevo'])){
    require_once FOLDER_MODEL_EXTEND. "model.login.inc.php";
    $login = new ModeloLogin();
    echo $login->cambiaPassword($_POST['passwordNuevo']);
}

if (isset($_POST['idCita'])){
    require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    $cita = new ModeloCita();
    $cita->setIdCita($_POST['idCita']);
    echo json_encode($cita->obtenerInformacionCita());
}

if (isset($_POST['idCitaCancelar'])&&isset($_POST['por'])){
    require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
    require_once FOLDER_MODEL_EXTEND. "model.consulta.inc.php";
    
    global $objSession;
    $cita = new ModeloCita();
    $cita->setIdCita($_POST['idCitaCancelar']);
    $cita->setEstatus("cancelada_".$_POST['por']);
    $cita->setIdUsuarioCancela($objSession->getidUsuario());
    
    $sucursal = new ModeloSucursal();
    $sucursal->setIdSucursal($cita->getIdSucursal());
    $consulta = new ModeloConsulta();
    $consulta->setIdConsulta($cita->getIdConsulta());
    
    $cita->Guardar();
    if ($cita->getError())
        echo 'false';
    else{
        if ($_POST['por']=='paciente')
            $aux="Ha";
        else
            $aux="Se ha";
            if (strlen($cita->getTelefonoPaciente())==12){
                enviaSMS($cita->getTelefonoPaciente(), "$aux cancelado su cita para ".$consulta->getTipoConsulta()." en ".$sucursal->getSucursal());
                echo 'true';
            }else {
                echo 'false2'; 
                
            }
    }
}

if (isset($_POST['SucursalIndex'])&&isset($_POST['usuarioIndex'])&&isset($_POST['fechaIndex'])){
    $dia=date('N',strtotime ($_POST['fechaIndex']));
    if ($dia==7) //es domingo
        echo json_encode(array());
    else {
    require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    $cita = new ModeloCita();
    $cita->setIdSucursal($_POST['SucursalIndex']);
    $cita->setIdUsuario($_POST['usuarioIndex']);
    echo json_encode($cita->resumenCitas($_POST['fechaIndex']));
    }
}

if (isset($_POST['sucursalP'])&&isset($_POST['cabinaP'])&&isset($_POST['fechaRegistroP'])&&isset($_POST['servicioP'])&&isset($_POST['consultaP'])
    &&isset($_POST['nombreP'])&&isset($_POST['edadP'])&&isset($_POST['sexoP'])&&isset($_POST['citaP'])&&isset($_POST['telP'])&&isset($_POST['apellidosP'])&&isset($_POST['estatusP'])){
    
    require_once CLASS_CONEXION;
    $condicion=$inner="";
    if($_POST['nombreP']!="")
        $condicion.=" and p.nombre LIKE '".$_POST['nombreP']."%' ";
    
        if($_POST['apellidosP']!="")
            $condicion.=" and p.apellidos LIKE '%".$_POST['apellidosP']."%' ";
            
            if($_POST['sexoP']!="")
                $condicion.=" and p.sexo='".$_POST['sexoP']."' ";
                
                if($_POST['edadP']!="")
                    $condicion.=" and p.edad=".$_POST['edadP'];
                    
                    if($_POST['fechaRegistroP']!="")
                        $condicion.=" and DATE_FORMAT(p.fechaRegistro,'%Y-%m-%d') ='".$_POST['fechaRegistroP']."'";
                        
                        if($_POST['telP']!="")
                            $condicion.=" and p.telefonoCel LIKE '".$_POST['telP']."%' ";
                            
                            if($_POST['sucursalP']!=""&&$_POST['sucursalP']!="0")
                                $condicion.=" and p.idSucursal = ".$_POST['sucursalP'];
                            
                                
                                if($_POST['estatusP']!="")
                                    $condicion.=" and p.estatus='".$_POST['estatusP']."' ";
                                    
                            if($_POST['citaP']=="si"){
                                $inner.=" inner join cita as c on p.idPaciente=c.idPaciente ";
                                    if($_POST['consultaP']!="")
                                        $condicion.=" and c.idConsulta = ".$_POST['consultaP'];
                                        if($_POST['cabinaP']!="")
                                            $condicion.=" and c.idCabina = ".$_POST['cabinaP'];
                                            if($_POST['servicioP']!=""){
                                                $inner.=" inner join servicio as se on c.idServicio=se.idServicio";
                                                $condicion.=" and se.nombre ='".$_POST['servicioP']."%'";
                                            }
                            }
                                
                            
                            $query = "Select distinct p.idPaciente, concat_ws(' ', p.nombre, p.apellidos) as nombreP, telefonoCel, sucursal, completitud, p.estatus as estatusPaciente,
                    DATE_FORMAT(p.fechaRegistro,'%Y-%m-%d') as fecha,
                    (select count(*) from cita where idPaciente=p.idPaciente and estatus='realizada') as consultasHechas,
                    (select count(*) from cita where idPaciente=p.idPaciente and estatus='nueva') as consultasProximas,
                    (select DATE_FORMAT(fechaInicio,'%Y-%m-%d') from cita where idPaciente=p.idPaciente and estatus='nueva' order by fechaInicio limit 1) as fechaProxima ,
                     (select idCita from cita where idPaciente=p.idPaciente and estatus='nueva' order by fechaInicio limit 1) as cita
                    from paciente as p $inner
		             inner join sucursal as s on p.idSucursal=s.idSucursal
                       inner join hojaclinica as h on p.idHojaClinica=h.idHojaClinica where true $condicion";
                            
        $respuesta = array();
        $Conexion =  new mysqli(BD_HOST,BD_USER,BD_PASS,BD_DB);
        $Conexion->set_charset(BD_CHARSET);
        $resultado = mysqli_query($Conexion, $query);
        
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            while ($row_inf = mysqli_fetch_assoc($resultado)){
                $respuesta[]=$row_inf;
            }
        }
        
        echo json_encode($respuesta);
}

if (isset($_POST['consultaCredito'])){
    $idSucursal=($sucursal!=""?$sucursal:$objSession->getIdSucursal());
    require_once FOLDER_MODEL_EXTEND. "model.claves.inc.php";
    $claves = new ModeloClaves();
    $clave= $claves->obtenerUsuarioClaveByReferencia("sms".$idSucursal);
    if (count($clave)==0)
        echo false;
        else {
            require_once 'funcionesSMS.php';
            
            echo json_encode(consultaCredito($clave));
        }
}

if (isset($_POST['consultaSMS'])){
    require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    require_once FOLDER_MODEL_EXTEND. "model.compra_sms.inc.php";
    $sms = new ModeloCompra_sms();
    $cita = new ModeloCita();
    $fechaUltimaCompra=$sms->obtenerFechaUltimaCompra($objSession->getIdFranquicia());
    echo json_encode(array($cita->SMSEnviadosBySucursal($fechaUltimaCompra),date("d/m/Y",strtotime($fechaUltimaCompra))));//,
  //              $cita->SMSEnviadosByFranquicia($sms->obtenerFechaUltimaCompra())));
}

if (isset($_POST['listadoSucursal'])){
    require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
    $sucursal = new ModeloSucursal();
    echo json_encode($sucursal->listadoSucursales());
}

if (isset($_POST['listadoUsuario'])){
    require_once FOLDER_MODEL_EXTEND. "model.usuario.inc.php";
    $usuario = new ModeloUsuario();
    echo json_encode($usuario->obtenerUsuarios());
}

if (isset($_POST['listadoTipoUsuario'])){
    require_once FOLDER_MODEL_EXTEND. "model.tipousuario.inc.php";
    $tipo = new ModeloTipoUsuario();
    echo json_encode($tipo->obtenerTipoUsuarios());
}

if (isset($_POST['listadoCargos'])){
    require_once FOLDER_MODEL_EXTEND. "model.tipousuario.inc.php";
    $tipo = new ModeloTipoUsuario();
    echo json_encode(obtenCombo($tipo->obtenerCargos(),'Seleccione una opci&oacute;n'));
}

if (isset($_POST['listadoEstados'])){
    require_once FOLDER_MODEL_EXTEND. "model.inegidomgeo_cat_estado.inc.php";
    $estados = new ModeloInegidomgeo_cat_estado();
    echo json_encode(obtenCombo($estados->getAll(),'Seleccione una opci&oacute;n'));
}

if (isset($_POST['cve_ent'])){
    require_once FOLDER_MODEL_EXTEND. "model.inegidomgeo_cat_municipio.inc.php";
    $municipio = new ModeloInegidomgeo_cat_municipio();
    $municipio->setCVE_ENT($_POST['cve_ent']);
    echo json_encode(obtenCombo($municipio->getAllByCVE_Est($_POST['cve_ent']),'Seleccione una opci&oacute;n'));
}

if (isset($_POST['correo'])&&isset($_POST['mensaje'])&&isset($_POST['asunto'])){
//    echo enviar_mail($_POST['correo'],$_POST['mensaje'],$_POST['asunto']);
}

if (isset($_POST['valor'])&&isset($_POST['campo'])&&isset($_POST['tabla'])){
    require_once FOLDER_MODEL_EXTEND. "model.login.inc.php";
    $login=new ModeloLogin();
    echo $login->validarCampo($_POST['tabla'],$_POST['campo'],$_POST['valor']);
}


if (isset($_POST['estatusU'])&&isset($_POST['idLogin'])){
    require_once FOLDER_MODEL_EXTEND. "model.login.inc.php";
    $usuario = new ModeloLogin();
    $usuario->setIdLogin($_POST['idLogin']);
    $usuario->setEstatus($_POST['estatusU']);
    $usuario->Guardar();
    if ($usuario->getError())
        echo $usuario->getStrError();
    else 
        echo 'true';
}

if (isset($_POST['SucursalA'])){
    echo json_encode(obtenerConsultorios('',$_POST['SucursalA']));
}

if (isset($_POST['idSucursalA'])&&isset($_POST['fechaA'])){
    echo obtenerHorarioSucursal($_POST['idSucursalA'],$_POST['fechaA']);
}

if (isset($_POST['sucursalBar'])){
    require_once FOLDER_MODEL_EXTEND. "model.usuariosucursal.inc.php";
    $sucursal = new ModeloUsuariosucursal();
    $tmp=$sucursal->obtenerSucurales();
    $arrSucursal=$tmp[0];
    $idSucursal=$tmp[1];
    $combo='';
    foreach ($arrSucursal as $key => $nombre)
        $combo.='<option value="'.$key.'" '.($idSucursal==$key?'selected':'').'>'.$nombre.'</option>';
     echo $combo;
}

if (isset($_POST['actualizaSucursal'])){
    require_once FOLDER_MODEL_EXTEND. "model.usuario.inc.php";
    require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
    
    $objSession=unserialize($_SESSION['objSession']);
    
    $objSession->setIdSucursal($_POST['actualizaSucursal']);
    $sucursal=new ModeloSucursal();
    $sucursal->setIdSucursal($_POST['actualizaSucursal']);
    $objSession->setSucursal($sucursal->getSucursal());
    $objSession->setLugar($sucursal->getDireccion());
    
    $usuario=new ModeloUsuario();
    $usuario->setIdUsuario($objSession->getIdUsuario());
    $usuario->setIdSucursal($sucursal->getIdSucursal());
    
    $usuario->Guardar();
    
    $_SESSION['objSession']=serialize($objSession);
    
    echo "true";
    
}

if (isset($_POST['idCitaAct'])){
    require_once FOLDER_MODEL_EXTEND. "model.citaactualizacion.inc.php";
    $cita = new ModeloCitaactualizacion();
    $cita->setIdCita($_POST['idCitaAct']);
    echo json_encode($cita->obtenerCitas());
}

if (isset($_POST['sucursalAn'])&&isset($_POST['pacienteAn'])&&isset($_POST['usuarioAn'])&&isset($_POST['cabinaAn'])&&isset($_POST['fechaInicioAn'])){
    require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    $cita = new ModeloCita();
    if ($_POST['sucursalAn']!='')
        $cita->setIdSucursal($_POST['sucursalAn']);
        if ($_POST['pacienteAn']!='')
            $cita->setIdPaciente($_POST['pacienteAn']);
            //           if ($_POST['usuario']!='')
                //                $cita->setIdUsuario($_POST['usuario']);
            if ($_POST['cabinaAn']!='')
                $cita->setIdCabina($_POST['cabinaAn']);
                
                $cita->setFechaFin($_POST['fechaInicioAn']);
                echo json_encode($cita->obtenerCitasAnteriores());
}

if (isset($_POST['eliminarPaciente'])){
            require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
            $paciente = new ModeloPaciente();
            $paciente->setIdPaciente($_POST['eliminarPaciente']);
            $paciente->setEstatusSuspendido();
            $paciente->Guardar();
            if ($paciente->getError()){
                echo json_encode(array('false',$paciente->getStrError()));
            }else {
                echo json_encode(array('true'));
            }
}

if (isset($_POST['bloqueos'])){
    require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
    $pacientes = new ModeloPaciente();
    echo json_encode(obtenCombo($pacientes->PacientesBloqueo(false),'Seleccione una opci&oacute;n'));
}

if (isset($_POST['listaBloqueos'])){
    require_once FOLDER_MODEL_EXTEND. "model.bloqueos.inc.php";
    $bloqueos = new ModeloBloqueos();
    echo json_encode($bloqueos->listaBloqueos());
}

if (isset($_POST['idBloqueo'])){
    require_once FOLDER_MODEL_EXTEND. "model.bloqueos.inc.php";
    $bloqueos = new ModeloBloqueos();
    $bloqueos->setIdBloqueo($_POST['idBloqueo']);
    $bloqueos->Borrar();
    if ($bloqueos->getError())
        echo json_encode(array('false',$bloqueos->getStrError()));
    else 
        echo json_encode(array('true'));
}

if (isset($_POST['consultaBloqueo'])){
    require_once FOLDER_MODEL_EXTEND. "model.bloqueos.inc.php";
    $bloqueos = new ModeloBloqueos();
    $bloqueos->setIdPaciente($_POST['consultaBloqueo']);
    echo json_encode($bloqueos->buscarPaciente());
}

if (isset($_POST['notificacion'])){
    session_start();
    
    date_default_timezone_set('America/Mexico_City');
    if (true) {
        define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "/include/");
    } else {
        define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "siluetaxpress/html/include/");
    }
    define("FOLDER_LIB", FOLDER_INCLUDE . "lib/");
    $mensaje="Se han enviado correctamente tus datos. <br />En breve nos pondremos en contacto contigo.<br /> <br />Gracias por su comentario.";
//    echo enviar_mail($_POST['notificacion'], "Notificaci�n @siluetaexpress", $mensaje);
}

if (isset($_POST['listadoSucursales'])){
    require_once FOLDER_MODEL_EXTEND. "model.usuariosucursal.inc.php";
    $sucursal = new ModeloUsuariosucursal();
    $sucursal->setIdUsuario($_POST['listadoSucursales']);
    echo json_encode($sucursal->obtenerSucuralesByUsuario());
}

if (isset($_POST['completitud'])&&isset($_POST['idPaciente'])){
    require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
    $paciente = new ModeloPaciente();
    $paciente->setIdPaciente($_POST['idPaciente']);
    if ($paciente->getLlenado()=="Minimo")
        $paciente->setFechaNacimiento("1900-01-01");
    $paciente->setLlenado($_POST['completitud']);
    $paciente->Guardar();
    echo true;
}

if (isset($_POST['idPacienteSeguimiento'])){
    require_once FOLDER_MODEL_EXTEND. "model.hojaseguimiento.inc.php";
    $seg = new ModeloHojaseguimiento();
    echo json_encode($seg->getSeguimientos($_POST['idPacienteSeguimiento']));
}

if (isset($_POST['idSeguimiento'])){
    require_once FOLDER_MODEL_EXTEND. "model.hojaseguimiento.inc.php";
    require_once FOLDER_MODEL_EXTEND. "model.seguimiento_producto.inc.php";
    $seg = new ModeloHojaseguimiento();
    $seg_producto = new ModeloSeguimiento_producto();
    echo json_encode(array('nota'=>$seg->getDetalleSeguimiento($_POST['idSeguimiento']),'productos'=>$seg_producto->obtenerProductosByIdSeg($_POST['idSeguimiento'])));
}

if (isset($_POST['txtProductos'])){
    require_once FOLDER_MODEL_EXTEND. "model.productos.inc.php";
    $producto = new ModeloProductos();
    echo json_encode($producto->obtenerProductos());
}

if (isset($_POST['agregaProducto'])){
    require_once FOLDER_MODEL_EXTEND. "model.productos.inc.php";
    $producto = new ModeloProductos();
    echo $producto->buscarProductoByNombre($_POST['agregaProducto']);
}

if (isset($_POST['notificacionCita'])){
    require_once FOLDER_MODEL_EXTEND. "model.citasparalelas.inc.php";
    $citas = new ModeloCitasparalelas();
    $arrIds=$citas->obtenerTotalProblemaCitasByUsuario($objSession->getIdUsuario());
    echo json_encode($citas->obtenerCitasProblematicas(implode(",", $arrIds)));
}

if (isset($_POST['SucursalServ'])&&isset($_POST['ConsultorioServ'])&&isset($_POST['fechaInicioServ'])){
    echo obtenerHorariosServicios($_POST['Sucursal'], $_POST['Consultorio'], $_POST['fechaInicio']);
}

if (isset($_POST['nPaciente'])&&isset($_POST['idSucursal'])){
    require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
    $pacientes = new ModeloPaciente();
    echo json_encode($pacientes->obtenerPacientesSeccion($_POST['nPaciente'],$_POST['idSucursal']));
}

if (isset($_POST['idPacienteSucursal'])){
    require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
    $pacientes = new ModeloPaciente();
    $pacientes->setIdPaciente($_POST['idPacienteSucursal']);
    echo $pacientes->getIdSucursal();
}

if (isset($_POST['medios'])){
    require_once FOLDER_MODEL_EXTEND. "model.medio_enterar.inc.php";
    $medios = new ModeloMedio_enterar();
    echo json_encode(obtenCombo($medios->obtenerMedios(),'Seleccione una opci&oacute;n'));
}

if (isset($_POST['nombreN'])&&isset($_POST['textoN'])&&isset($_POST['seccionN'])){
    require_once FOLDER_MODEL_EXTEND. "model.notificacion.inc.php";
    $notif= new ModeloNotificacion();
    $notif->setFechaRegistro(date("Y-m-d H:i:s"));
    $notif->setIdSucursal($objSession->getIdSucursal());
    $notif->setIdUsuario($objSession->getidUsuario());
    $notif->setNombre($_POST['nombreN']);
    $notif->setTexto($_POST['textoN']);
    $notif->setTipo($_POST['seccionN']);
    if ($_POST['seccionN']=="Correo"){
        if (isset($_POST['rutaN']))
        foreach ($_POST['rutaN'] as $id=>$ruta){
            switch ($id){
                case 0:
                    $notif->setImagen1($ruta);
                    break;
                case 1:
                    $notif->setImagen2($ruta);
                    break;
                case 2:
                    $notif->setImagen3($ruta);
                    break;
                case 3:
                    $notif->setImagen4($ruta);
                    break;
                case 4:
                    $notif->setImagen5($ruta);
                    break;
                    
            }
        }
    }
    $notif->Guardar();
    if ($notif->getError()){
        echo json_encode(array(0,$notif->getStrError()));
    } else {
        echo json_encode(array($notif->getIdNotificacion()));
    }
}

function obtenCombo($array,$default){
    $combo='<option value="">'.$default.'</option>';
    foreach ($array as $key => $opcion)
        $combo.='<option value="'.$key.'">'.$opcion.'</option>';
    return $combo;
}

function obtenerHorariosServicios($idSucursal,$idCabina){
    require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
    require_once FOLDER_MODEL_EXTEND. "model.cabina.inc.php";
    require_once FOLDER_MODEL_EXTEND. "model.servicio.inc.php";
    
    $cita = new ModeloCita();
    $sucursal=new ModeloSucursal();
    $arrSucursales=array();
    $arrFechas = array();
    
    if ($idSucursal==''){
        $arr=$sucursal->obtenerSucurales();
        foreach ($arr as $idS=>$nombre)
            array_push($arrSucursales, $idS);
    }else {
        array_push($arrSucursales, $idSucursal);
    }
    
    $horarioDisponible = array();
    $fechaInicio=date("Y-m-d");
    foreach ($arrSucursales as $idSucursal) {
        $segundo=false;
        $fechaInicial=$fechaInicio;
        $dia=date('N',strtotime ($fechaInicial));
        
        $hrInicio = date("H");
        if ($dia==7){ //es domingo
            $segundo=true;
            $auxFecha = strtotime ( '+1 day' , strtotime ( $fechaInicial ) ) ;
            $fechaInicial = date ( 'Y-m-d' , $auxFecha);
            $dia=date('N',strtotime ($fechaInicial));
        }
        
        $sucursal->setIdSucursal($idSucursal);
        
        // sacar hr
        if ($dia==6){
            $hrInicio = $sucursal->getSabadoEntrada();
            $hrFin=$sucursal->getSabadoSalida();
        }else {
            $hrInicio = $sucursal->getEntreSemanaEntrada();
            $hrFin = $sucursal->getEntreSemanaSalida();
        }
        
        $auxFechaEntrada=strtotime(date(date("Y-m-d", strtotime($fechaInicio)). " $hrInicio:00:00"));
        $auxFechaFin=strtotime(date(date("Y-m-d", strtotime($fechaInicio)). " $hrFin:00:00"));
        $auxFechaActual=strtotime(date("Y-m-d H:i:s"));
        
        if ($auxFechaActual<$auxFechaEntrada)
            $segundo=true;
            
            $fechaFin = date(date("Y-m-d", strtotime($fechaInicial)). " $hrFin:00:00");
            if ($segundo) {
                //  si el dia es domingo 
                $fechaInicial = date($fechaInicial . " $hrInicio:00:00");
            }
            
            
            $cita->setFechaInicio($fechaInicial);
            $cita->setFechaFin($fechaFin);
            $cita->setIdSucursal($idSucursal);
            
            $cabina = new ModeloCabina();
            $cabina->setIdSucursal($idSucursal);
            $cabina->setTipo('');
            if ($idCabina=='')
                $arrCabinas = $cabina->obtenerConsultorios();
                /**/       else {
                $cabina->setIdCabina($idCabina);
                $arrCabinas=array($idCabina=>$cabina->getNombre());
                }
                $minInicio=0;
                /**/    //return json_encode($arrCabinas);
                foreach ($arrCabinas as $idConsultorio=>$nomConsultorio) {
                    ///$auxFechaActual=strtotime(date("Y-m-d H:i:s"));
                    $fecha=$fechaInicial;
                    $auxFechaEntrada=strtotime(date(date("Y-m-d", strtotime($fecha)). " $hrInicio:00:00"));
                    $auxFechaFin=strtotime(date(date("Y-m-d", strtotime($fecha)). " $hrFin:00:00"));
                    $cita->setIdCabina($idConsultorio);
                    
                    for ($hr=$hrInicio;$hr<$hrFin;$hr++){
                        $minInicio=0;
                        for ($min=$minInicio;$min<=50;$min+=30){
                            $fecha = date(date("Y-m-d", strtotime($fecha)). " $auxHrInicio:$minInicio:00");
                            $cita->setFechaInicio($fecha);
                            if($cita->disponibliadDia()){
                                
                            }else {
                                
                            }
                        }
                    }
                    
                    if ($auxFechaActual>$auxFechaEntrada&&$auxFechaActual<$auxFechaFin){  // hora entre horario de citas
                        $fecha=date("Y-m-d H:i:s");
                        $hrInicio = intval(date("H"));
                        $auxHrInicio=($hrInicio<10?'0':'').$hrInicio;
                        $auxMin=intval(date("i"));
                        if ($auxMin<10)
                            $minInicio=0;
                            else if ($auxMin<20)
                                $minInicio=10;
                                else if ($auxMin<30)
                                    $minInicio=20;
                                    else if ($auxMin<40)
                                        $minInicio=30;
                                        else if ($auxMin<50)
                                            $minInicio=40;
                                            else if ($auxMin<59)
                                                $minInicio=50;
                                                $fecha = date(date("Y-m-d", strtotime($fecha)). " $auxHrInicio:$minInicio:00");
                    }
                    $cita->setIdCabina($idConsultorio);
                    ///            if ($idConsultorio>1)
                    //             return $fecha;
                    do{
                        $auxFechaEntrada=strtotime(date(date("Y-m-d", strtotime($fecha)). " $hrInicio:00:00"));
                        $auxFechaFin=strtotime(date(date("Y-m-d", strtotime($fecha)). " $hrFin:00:00"));
                        //$auxFechaActual=strtotime($fecha.date(" H:i:s"));
                        if ($auxFechaActual<$auxFechaEntrada)
                            $segundo=true;
                            $fechaFin = date(date("Y-m-d", strtotime($fecha)). " $hrFin:00:00");
                            $cita->setFechaInicio($fecha);
                            $cita->setFechaFin($fechaFin);
                            $arrCitas = $cita->obtenerCitasSucursalConsultorioFechaDuracion();
                            $horasDisponibles=array();
                            $horarioAgendado=array();
                            // obtener hora inicio y duracion
                            foreach ($arrCitas as $info) {
                                $horarioAgendado[$info['fechaInicio']] = $info['fechaFin'];
                            }
                            //          return json_encode($fecha);
                            if ($auxFechaActual>$auxFechaFin){
                                array_push($horasDisponibles, "Horario fuera de servcio");
                            }else{
                                $horaInicio=($hrInicio<10?'0':'').$hrInicio.":".($minInicio<10?'0':'').$minInicio;
                                for ($hr=$hrInicio;$hr<$hrFin;$hr++){
                                    for ($min=$minInicio;$min<=50;$min+=10){
                                        
                                    }
                                }
                            }
                            $auxFecha=date("Y-m-d", strtotime($fecha));
                            $horarioDisponible[$idSucursal][$idConsultorio][$auxFecha]=$horasDisponibles;
                            if (!in_array($auxFecha, $arrFechas)) /// fechas de los d�as a mostrar
                                array_push($arrFechas, $auxFecha);
                                
                                $hrInicio = $sucursal->getEntreSemanaEntrada();
                                $fecha = date ("Y-m-d $hrInicio:00:00",strtotime ( '+1 day' , strtotime ( $fecha) ) );
                                $segundo=true;
                                $auxDia=date('N',strtotime ($fecha));
                                if (intval($auxDia)==7){
                                    $fecha = date ("Y-m-d $hrInicio:00:00",strtotime ( '+1 day' , strtotime ( $fecha) ) );
                                    $auxDia=date('N',strtotime ($fecha));
                                }else {
                                }
                                //            $hrInicio = $sucursal->getEntreSemanaEntrada();
                                //$fecha = date($fecha . " $hrInicio:00:00");
                                
                                // sacar hr
                                if ($auxDia==6){
                                    $hrInicio = $sucursal->getSabadoEntrada();
                                    $hrFin=$sucursal->getSabadoSalida();
                                }else {
                                    $hrInicio = $sucursal->getEntreSemanaEntrada();
                                    $hrFin = $sucursal->getEntreSemanaSalida();
                                }
                    }while ($dia!=$auxDia);
                $segundo=false;
                }
    }
    
}

function obtenerIntervalosDisponibles($idSucursal,$idCabina,$fechaInicio){
    require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
    require_once FOLDER_MODEL_EXTEND. "model.cabina.inc.php";
    
    $cita = new ModeloCita();
    $sucursal=new ModeloSucursal();
    $arrSucursales=array();
    $horarioDisponible=array();
    $arrFechas = array();
    
    if ($idSucursal==''){
    $arr=$sucursal->obtenerSucurales();
    foreach ($arr as $idS=>$nombre)
        array_push($arrSucursales, $idS);
    }else {
        array_push($arrSucursales, $idSucursal);
    }
    
    $horarioDisponible = array();
    
    foreach ($arrSucursales as $idSucursal) {
        $segundo=false;
        $fechaInicial=$fechaInicio;
        $dia=date('N',strtotime ($fechaInicial));
        
        $hrInicio = date("H");
        if ($dia==7){ //es domingo
            $segundo=true;
            $auxFecha = strtotime ( '+1 day' , strtotime ( $fechaInicial ) ) ;
            $fechaInicial = date ( 'Y-m-d' , $auxFecha);
            $dia=date('N',strtotime ($fechaInicial));
        }
        
        $sucursal->setIdSucursal($idSucursal);
        
        // sacar hr
        if ($dia==6){
            $hrInicio = $sucursal->getSabadoEntrada();
            $hrFin=$sucursal->getSabadoSalida();
        }else {
            $hrInicio = $sucursal->getEntreSemanaEntrada();
            $hrFin = $sucursal->getEntreSemanaSalida();
        }
        
        $auxFechaEntrada=strtotime(date(date("Y-m-d", strtotime($fechaInicio)). " $hrInicio:00:00"));
        $auxFechaFin=strtotime(date(date("Y-m-d", strtotime($fechaInicio)). " $hrFin:00:00"));
        $auxFechaActual=strtotime(date("Y-m-d H:i:s"));
        
        if ($auxFechaActual<$auxFechaEntrada)
            $segundo=true;
        
        $fechaFin = date(date("Y-m-d", strtotime($fechaInicial)). " $hrFin:00:00");
        if ($segundo) {
        //    $hrInicio = $sucursal->getEntreSemanaEntrada();
            $fechaInicial = date($fechaInicial . " $hrInicio:00:00");
        }
                                    
        
        $cita->setFechaInicio($fechaInicial);
        $cita->setFechaFin($fechaFin);
        $cita->setIdSucursal($idSucursal);
        
        $cabina = new ModeloCabina();
        $cabina->setIdSucursal($idSucursal);
        $cabina->setTipo('');
        if ($idCabina=='')
            $arrCabinas = $cabina->obtenerConsultorios();
 /**/       else {
            $cabina->setIdCabina($idCabina);
            $arrCabinas=array($idCabina=>$cabina->getNombre());
            }
            $minInicio=0;
/**/    //return json_encode($arrCabinas);
        foreach ($arrCabinas as $idConsultorio=>$nomConsultorio) {
            ///$auxFechaActual=strtotime(date("Y-m-d H:i:s"));
            $fecha=$fechaInicial;
            $auxFechaEntrada=strtotime(date(date("Y-m-d", strtotime($fecha)). " $hrInicio:00:00"));
            $auxFechaFin=strtotime(date(date("Y-m-d", strtotime($fecha)). " $hrFin:00:00"));
            if ($auxFechaActual>$auxFechaEntrada&&$auxFechaActual<$auxFechaFin){  // hora entre horario de citas
                $fecha=date("Y-m-d H:i:s");
                $hrInicio = intval(date("H"));
                $auxHrInicio=($hrInicio<10?'0':'').$hrInicio;
                $auxMin=intval(date("i"));
                if ($auxMin<10)
                    $minInicio=0;
                    else if ($auxMin<20)
                        $minInicio=10;
                        else if ($auxMin<30)
                            $minInicio=20;
                            else if ($auxMin<40)
                                $minInicio=30;
                                else if ($auxMin<50)
                                    $minInicio=40;
                                    else if ($auxMin<59)
                                        $minInicio=50;
                  $fecha = date(date("Y-m-d", strtotime($fecha)). " $auxHrInicio:$minInicio:00");
            }
            $cita->setIdCabina($idConsultorio);
///            if ($idConsultorio>1)
   //             return $fecha;
            do{
                $auxFechaEntrada=strtotime(date(date("Y-m-d", strtotime($fecha)). " $hrInicio:00:00"));
                $auxFechaFin=strtotime(date(date("Y-m-d", strtotime($fecha)). " $hrFin:00:00"));
                //$auxFechaActual=strtotime($fecha.date(" H:i:s"));
                if ($auxFechaActual<$auxFechaEntrada)
                    $segundo=true;
                $fechaFin = date(date("Y-m-d", strtotime($fecha)). " $hrFin:00:00");
                $cita->setFechaInicio($fecha);
                $cita->setFechaFin($fechaFin);
                $arrCitas = $cita->obtenerCitasSucursalConsultorioFechaDuracion();
            $horasDisponibles=array();
            $horarioAgendado=array();
            // obtener hora inicio y duracion
            foreach ($arrCitas as $info) {
                $horarioAgendado[$info['fechaInicio']] = $info['fechaFin'];
            }
  //          return json_encode($fecha);
            if ($auxFechaActual>$auxFechaFin){
                array_push($horasDisponibles, "Horario fuera de servcio");
            }else{
                $horaInicio=($hrInicio<10?'0':'').$hrInicio.":".($minInicio<10?'0':'').$minInicio;
                for ($hr=$hrInicio;$hr<$hrFin;$hr++){
                    for ($min=$minInicio;$min<=50;$min+=10){
                        $hora=($hr<10?'0':'').$hr;
                        $minuto=($min<10?'0':'').$min;
                        $auxFecha2=$fecha;
                        if ($segundo)
                            $auxFecha2=date("Y-m-d", strtotime($fecha)).' '.$hora.':'.$minuto.':00';
                            else{  // definir hora apartir de la actual
                                $auxFecha=$auxFecha2;
                                $auxFecha=explode(' ', $auxFecha);
                                
                                $auxFecha=explode(':', $auxFecha[1]);
                                $hr=intval($auxFecha[0]);;
                                $auxMin=$min=intval($auxFecha[1]);
                                
                                if ($auxMin<10)
                                    $min=0;
                                    else if ($auxMin<20)
                                        $min=10;
                                        else if ($auxMin<30)
                                            $min=20;
                                            else if ($auxMin<40)
                                                $min=30;
                                                else if ($auxMin<50)
                                                    $min=40;
                                                    else if ($auxMin<59)
                                                        $min=50;
                                $auxFecha2 = date(date("Y-m-d", strtotime($fecha)). " $hora:$min:00");
                                
                                // comparar fechas
                                foreach ($horarioAgendado as $fecha_inicio=>$fecha_fin){
                                    $f1=strtotime($fecha_inicio); // hr agendada inicio
                                    $f2=strtotime($fecha_fin); // hr agendada final
                                    $fI=strtotime($auxFecha2);
                                    if ($fI>$f1&&$fI<$f2){ // dentro
                                        $auxFecha=explode(' ', $fecha_fin);
                                        if ($horaInicio!=$hora.':'.$minuto) //hora igual
                                            array_push($horasDisponibles, $horaInicio.' - '.$hora.':'.$minuto); // intervalo disponible
                                            
                                            $auxFecha=explode(':', $auxFecha[1]);
                                            $hr=intval($auxFecha[0]);;
                                            $min=intval($auxFecha[1]);
                                            $horaInicio=($hr<10?'0':'').$hr.":".($min<10?'0':'').$min;
                                    }
                                }
                            }
            //               return $auxFecha2;
                        $segundo=true;
                        if (key_exists($auxFecha2,$horarioAgendado)){ // EXISTE CITA
                            $auxFecha=$horarioAgendado[$auxFecha2];
                            $auxFecha=explode(' ', $auxFecha);
                            if ($horaInicio!=$hora.':'.$minuto) //hora igual
                                array_push($horasDisponibles, $horaInicio.' - '.$hora.':'.$minuto); // intervalo disponible
                            
                            $auxFecha=explode(':', $auxFecha[1]);
                            $hr=intval($auxFecha[0]);;
                            $min=intval($auxFecha[1]);
                            $horaInicio=($hr<10?'0':'').$hr.":".($min<10?'0':'').$min;
                            //regresar 10 min atras
                            if ($min==0){
                                $min=50;
                                $hr-=1;
                            }else {
                                $min-=10;
                            }
                            
                        }
                    }
                    $minInicio=0;
                }
                if ($horaInicio!=$hora.':'.$minuto&&intval($hr)<=intval($hrFin)) //hora igual
                    array_push($horasDisponibles, $horaInicio.' - '.$hr.':00'); // intervalo disponible
            }
            //array_push($horasDisponibles, "<<<".date ( 'Y-m-d',strtotime ( '+1 day' , strtotime ( $fecha) ) ).">>> ");
            $auxFecha=date("Y-m-d", strtotime($fecha));
            $horarioDisponible[$idSucursal][$idConsultorio][$auxFecha]=$horasDisponibles;
            if (!in_array($auxFecha, $arrFechas)) /// fechas de los d�as a mostrar
                array_push($arrFechas, $auxFecha);
            
            $hrInicio = $sucursal->getEntreSemanaEntrada();
            $fecha = date ("Y-m-d $hrInicio:00:00",strtotime ( '+1 day' , strtotime ( $fecha) ) );
            $segundo=true;
            $auxDia=date('N',strtotime ($fecha));
            if (intval($auxDia)==7){
                $fecha = date ("Y-m-d $hrInicio:00:00",strtotime ( '+1 day' , strtotime ( $fecha) ) );
                $auxDia=date('N',strtotime ($fecha));
            }else {
            }
//            $hrInicio = $sucursal->getEntreSemanaEntrada();
            //$fecha = date($fecha . " $hrInicio:00:00");
            
            // sacar hr
            if ($auxDia==6){
                $hrInicio = $sucursal->getSabadoEntrada();
                $hrFin=$sucursal->getSabadoSalida();
            }else {
                $hrInicio = $sucursal->getEntreSemanaEntrada();
                $hrFin = $sucursal->getEntreSemanaSalida();
            }
            
            }while ($dia!=$auxDia);
            $segundo=false;
        }
    }
 //   return json_encode($auxx);
    return json_encode(array($horarioDisponible,$arrFechas));
}

function obtenerHorarioDisponibles($idConsulta,$idSucursal,$fecha,$duracion,$idConsultorio){
    require_once FOLDER_MODEL_EXTEND. "model.cita.inc.php";
    require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
    
    $cita = new ModeloCita();
    $cita->setIdSucursal($idSucursal);
    $cita->setIdConsulta($idConsulta);
    $cita->setFechaInicio($fecha);
    $cita->setFechaFin($fecha);
    $cita->setIdCabina($idConsultorio);
    $arrCitas=$cita->obtenerCitasFechaDuracion();
    
    $horarioAgendado=array();
    // obtener hora inicio y duracion
    foreach ($arrCitas as $info){
        $horarioAgendado[$info['fechaInicio']]=$info['fechaFin'];
    }
    
    $sucursal=new ModeloSucursal();
    $sucursal->setIdSucursal($idSucursal);
    
    $dia=date('N',strtotime ($fecha));
    // sacar hr
    if ($dia==6){
        $hrInicio = $sucursal->getSabadoEntrada();
        $hrFin=$sucursal->getSabadoSalida();
    }else {
        $hrInicio = $sucursal->getEntreSemanaEntrada();
        $hrFin = $sucursal->getEntreSemanaSalida();
    }
    
    $horarioDisponible=array();
    $auxFechaEntrada=strtotime(date(date("Y-m-d", strtotime($fecha)). " $hrInicio:00:00"));
    $auxFechaActual=strtotime(date("Y-m-d H:i:s"));
    $minInicio=0;
    if ($auxFechaActual>$auxFechaEntrada){
        $hrInicio = intval(date("H"));
        $auxMin=intval(date("i"));
        if ($auxMin<10)
            $minInicio=0;
            else if ($auxMin<20)
                $minInicio=10;
                else if ($auxMin<30)
                    $minInicio=20;
                    else if ($auxMin<40)
                        $minInicio=30;
                        else if ($auxMin<50)
                            $minInicio=40;
                            else if ($auxMin<59)
                                $minInicio=50;
                                
    }
        
    for ($hr=$hrInicio;$hr<$hrFin;$hr++){
        for ($min=$minInicio;$min<=50;$min+=10){
            $hora=($hr<10?'0':'').$hr;
            $minuto=($min<10?'0':'').$min;
            $auxFecha2=$fecha.' '.$hora.':'.$minuto.':00';
            $finicio=strtotime($auxFecha2); // hr cita nueva inicio
            if (key_exists($auxFecha2,$horarioAgendado)){
                $auxFecha=$horarioAgendado[$auxFecha2];
                $auxFecha=explode(' ', $auxFecha);
                $auxFecha=explode(':', $auxFecha[1]);
                $hr=intval($auxFecha[0]);;
                $min=intval($auxFecha[1]);
                if ($min==0){
                    $min=50;
                    $hr-=1;
                }else {
                    $min-=10;
                }
     //           unset($horarioAgendado[$auxFecha2]);
            }else {
                $b=false;
                $auxFecha = strtotime ( '+'.$duracion.' minute' , strtotime ( $auxFecha2 ) ) ;
                $nuevafecha = date ( 'Y-m-d H:i:s' , $auxFecha);
                $f3=strtotime($nuevafecha); // cita nueva  hr final
                $ffin=strtotime(($fecha.' '.$hrFin.':00:00'));
                
                foreach ($horarioAgendado as $fecha_inicio=>$fecha_fin){
                    $f1=strtotime($fecha_inicio); // hr agendada inicio
                    $f2=strtotime($fecha_fin); // hr agendada final
                        
                    if (($finicio>=$f1&&$finicio<$f2)||($f3>$f1&&$f3<=$f2)||($finicio<$f1&&$f3>$f2)){ // dentro
       //                     unset($horarioAgendado[$fecha_inicio]);
                        $auxFecha=explode(' ', $fecha_fin);
                        $auxFecha=explode(':', $auxFecha[1]);
                        $hr=intval($auxFecha[0]);;
                        $min=intval($auxFecha[1]);
                        if ($min==0){
                            $min=50;
                            $hr-=1;
                        }else {
                            $min-=10;
                        }
                        $b=true;
                    }
                }
                if ($f3>$ffin)
                    $b=true;
                if (!$b){
                    if (!key_exists($hr, $horarioDisponible))
                        $horarioDisponible[$hr]=array();
                    array_push($horarioDisponible[$hr], $min);
                }
            }
            
        }
        $minInicio=0;
    }
    
   return json_encode($horarioDisponible);
}


function obtenerConsultorios($idConsulta,$idSucursal){
    require_once FOLDER_MODEL_EXTEND. "model.consulta.inc.php";
    require_once FOLDER_MODEL_EXTEND. "model.cabina.inc.php";
    
    $consulta =  new ModeloConsulta();
    $consulta->setIdConsulta($idConsulta);
    $cabina = new ModeloCabina();
    $cabina->setTipo($consulta->getConsultorio());
    $cabina->setIdSucursal($idSucursal);
    if ($consulta->getIdConsulta()==0)
        $cabina->setTipo('');
        
    return $cabina->obtenerConsultorios();
    
}

function enviaSMS_CitaNueva($numPaciente, $consulta, $dia, $hora, $sucursal, $numSucursal)
{
    $sMessage = "Ha agendado una cita en SiluetaExpress el dia $dia a las $hora hrs en $sucursal.\nSi desea cancelar su cita, comun�cate al $numSucursal";
    return enviaSMS($numPaciente, $sMessage);
}

function enviaSMS_CitaNueva2($numPaciente, $consulta, $dia, $hora, $sucursal, $numSucursal)
{
    $sMessage = "Ha agendado una cita en SiluetaExpress el dia $dia a las $hora hrs en $sucursal.\nSi desea cancelar su cita, comun�cate al $numSucursal";
    return enviaSMS2($numPaciente, $sMessage);
}

function enviaSMS_CitaModificada($numPaciente, $dia, $hora, $sucursal, $numSucursal)
{
    $sMessage = "Se ha modificado tu cita en SiluetaExpress para el dia $dia a las $hora hrs en $sucursal.\nSi desea cancelar su cita, comun�cate al $numSucursal";
    return enviaSMS($numPaciente, $sMessage);
}

function enviaSMS_recordatorio($numPaciente, $nombre, $servicio, $dia, $hora, $sucursal, $numSucursal)
{
    $sMessage = "SiluetaExpress le recuerda su cita para el dia $dia a las $hora hrs en $sucursal.\nSi desea cancelar su cita, comun�cate al $numSucursal";
    return enviaSMS($numPaciente, $sMessage);
}

function enviaSMS2($numPaciente, $sMessage)
{
    date_default_timezone_set('America/Mexico_City');
    
    $concat="";
    //$concat="concat=true&";
    $sData = 'cmd=sendsms&';
    $sData .= 'domainId=siluetaexpress&';
    $sData .= 'login=lic.lezliedelariva@gmail.com&';
    $sData .= 'passwd= MwPeXyT9i5t3&';
    
    $sData .= 'dest=' . str_replace(',', '&dest=', $numPaciente) . '&';
    $sData .= 'msg=' . urlencode(utf8_encode($sMessage));
    
    $timeOut = 5;
    
    $fp = fsockopen('www.altiria.net', 80, $errno, $errstr, $timeOut);
    if (! $fp) {
        // Error de conexion o tiempo maximo de conexion rebasado
        $output = "ERROR de conexion: $errno - $errstr\n";
        $output .= "Compruebe que ha configurado correctamente la direccion/url ";
        $output .= "suministrada por altiria";
        return $output;
    } else {
        $buf = "POST http://www.altiria.net/api/http HTTP/1.0\r\n";
        $buf .= "Host: www.altiria.net\r\n";
        $buf .= "Content-type: application/x-www-form-urlencoded; charset=UTF-8\r\n";
        $buf .= "Content-length: ".strlen($sData)."\r\n";
        $buf .= "\r\n";
        $buf .= $sData;
        fputs($fp, $buf);
        $buf = "";
        
        //Tiempo m�ximo de espera de respuesta del servidor = 60 seg
        $responseTimeOut = 60;
        stream_set_timeout($fp,$responseTimeOut);
        stream_set_blocking ($fp, true);
        if (!feof($fp)){
            if (($buf=fgets($fp,128))===false){
                // TimeOut?
                $info = stream_get_meta_data($fp);
                if ($info['timed_out']){
                    $output = 'ERROR Tiempo de respuesta agotado';
                    //return false;
                    return $output;
                } else {
                    $output = 'ERROR de respuesta';
                   // return false;
                    return $output;
                }
            } else{
                while(!feof($fp)){
                    $buf.=fgets($fp,128);
                }
            }
        } else {
            $output = 'ERROR de respuesta';
 //           return false;
            return $output;
        }
        
        fclose($fp);
        
        
        //Se comprueba que se ha conectado realmente con el servidor
        //y que se obtenga un codigo HTTP OK 200
        if (strpos($buf,"HTTP/1.1 200 OK") === false){
            $output = "ERROR. Codigo error HTTP: ".substr($buf,9,3)."\n";
            $output .= "Compruebe que ha configurado correctamente la direccion/url ";
            $output .= "suministrada por Altiria";
   //         return false;
            return $output;
        }
        //Se comprueba la respuesta de Altiria
        if (strstr($buf,"ERROR")){
            $output = $buf."<br />\n";
            $output .= " Ha ocurrido algun error. Compruebe la especificacion";
     //       return false;
            return $output;
        } else {
            $output = $buf."\n";
            $output .= " Exito";
       //     return true;
            return $output;
        }
    }
    
    return false;
}

function enviaSMS($numPaciente, $sMessage, $sucursal="")
{
    date_default_timezone_set('America/Mexico_City');
    global $objSession;
    $idSucursal=($sucursal!=""?$sucursal:$objSession->getIdSucursal());
    require_once FOLDER_MODEL_EXTEND. "model.claves.inc.php";
    $claves = new ModeloClaves();
    $clave= $claves->obtenerUsuarioClaveByReferencia("sms".$idSucursal);
    if (count($clave)==0)
        return false;
    $concat="";
    $sData = 'cmd=sendsms&';
//    $sData .= 'domainId=siluetaexpress&';
    $sData .= 'login='.$clave[1].'&';
    $sData .= 'passwd='.$clave[0].'&';
    $sData.="concat=true&";
    
    $sData .= 'dest=' . str_replace(',', '&dest=', $numPaciente) . '&';
    $sData .= 'msg=' . urlencode(utf8_encode($sMessage));
    
    $timeOut = 5;
    
    $fp = fsockopen('www.altiria.net', 80, $errno, $errstr, $timeOut);
    if (! $fp) {
        // Error de conexion o tiempo maximo de conexion rebasado
        $output = "ERROR de conexion: $errno - $errstr\n";
        $output .= "Compruebe que ha configurado correctamente la direccion/url ";
        $output .= "suministrada por altiria";
        return $output;
    } else {
         $buf = "POST http://www.altiria.net:8443/api/http HTTP/1.0\r\n";
        $buf .= "Host: www.altiria.net\r\n";
        $buf .= "Content-type: application/x-www-form-urlencoded; charset=UTF-8\r\n";
        $buf .= "Content-length: ".strlen($sData)."\r\n";
        $buf .= "\r\n";
        $buf .= $sData;
        fputs($fp, $buf);
        $buf = "";
        
        //Tiempo m�ximo de espera de respuesta del servidor = 60 seg
        $responseTimeOut = 60;
        stream_set_timeout($fp,$responseTimeOut);
        stream_set_blocking ($fp, true);
        if (!feof($fp)){
            if (($buf=fgets($fp,128))===false){
                // TimeOut?
                $info = stream_get_meta_data($fp);
                if ($info['timed_out']){
                    $output = 'ERROR Tiempo de respuesta agotado';
                    return false;
                    return $output;
                } else {
                    $output = 'ERROR de respuesta';
                    return false;
                    return $output;
                }
            } else{
                while(!feof($fp)){
                    $buf.=fgets($fp,128);
                }
            }
        } else {
            $output = 'ERROR de respuesta';
            return false;
            return $output;
        }
        
        fclose($fp);
        
        
        //Se comprueba que se ha conectado realmente con el servidor
        //y que se obtenga un codigo HTTP OK 200
        if (strpos($buf,"HTTP/1.1 200 OK") === false){
            $output = "ERROR. Codigo error HTTP: ".substr($buf,9,3)."\n";
            $output .= "Compruebe que ha configurado correctamente la direccion/url ";
            $output .= "suministrada por Altiria";
            return false;
            return $output;
        }
        //Se comprueba la respuesta de Altiria
        if (strstr($buf,"ERROR")){
            $output = $buf."<br />\n";
            $output .= " Ha ocurrido algun error. Compruebe la especificacion";
            return false;
            return $output;
        } else {
            $output = $buf."\n";
            $output .= " Exito";
            return true;
            return $output;
        }
    }
    
    return false;
}


function obtenerListadoPacientes($idSucursal){
    require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
    $paciente = new ModeloPaciente();
    return json_encode($paciente->listadoPacientes($idSucursal));
    
}

function obtenerHorarioByDia($idSucursal,$fecha){
    require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
    
    $sucursal=new ModeloSucursal();
    $sucursal->setIdSucursal($idSucursal);
    
    $dia=date('N',strtotime ($fecha));
    // sacar hr
    if ($dia==6){
        $hrInicio = $sucursal->getSabadoEntrada();
        $hrFin=$sucursal->getSabadoSalida();
    }else {
        $hrInicio = $sucursal->getEntreSemanaEntrada();
        $hrFin = $sucursal->getEntreSemanaSalida();
    }
    
    $horarioDisponible=array();
    
    $horarioDisponible['0']=array();
    array_push($horarioDisponible['0'], array('0'));
    
    for ($hr=$hrInicio;$hr<$hrFin;$hr++){
        for ($min=0;$min<=50;$min+=10){
            $hora=($hr<10?'0':'').$hr;
            $minuto=($min<10?'0':'').$min;
                if (!key_exists($hora, $horarioDisponible))
                            $horarioDisponible[$hr]=array();
                            array_push($horarioDisponible[$hr], $minuto);
                         
        }
    }
    return json_encode($horarioDisponible);
}


function enviar_mail($para,$asunto,$mensaje){
    require_once FOLDER_MODEL_EXTEND. "model.claves.inc.php";
    $clave = new ModeloClaves();
    $claveCorreo = $clave->obtenerClaveByReferencia("correo_agenda");
    require_once(FOLDER_LIB.'PHPMailer/class.phpmailer.php');
    require_once(FOLDER_LIB."PHPMailer/class.smtp.php");
    $mailWeb = new PHPMailer();
    $mailWeb->IsSMTP();
    $mailWeb->SMTPSecure = 'tls';
    $mailWeb->Host = "smtp.ionos.mx";
    $mailWeb->SMTPDebug = 0;
    $mailWeb->SMTPAuth = true;
    $mailWeb->Port = 587;
    $mailWeb->Username = "soporte@siluetaexpress.com.mx";
    $mailWeb->Password = $claveCorreo;
    $mailWeb->SetFrom("soporte@siluetaexpress.com.mx", "Soprte SiluetaExpress");
    //    $mailWeb->AddReplyTo("siluetaexpress@pruebassointec.com.mx", "SiluetaExpress @NoReply");
    $mailWeb->Subject = $asunto;
    $mailWeb->AltBody = $mensaje;
    $mailWeb->MsgHTML($mensaje);
    $mailWeb->AddAddress($para);
    try{
        return $mailWeb->Send();
        return true;
    }catch(Exception $e){
        return false;
        echo $e;
    }
}

function enviar_mail_archivos($para,$asunto,$mensaje,$imagenes){
    require_once FOLDER_MODEL_EXTEND. "model.claves.inc.php";
    $clave = new ModeloClaves();
    $claveCorreo = $clave->obtenerClaveByReferencia("correo_agenda");
    require_once(FOLDER_LIB.'PHPMailer/class.phpmailer.php');
    require_once(FOLDER_LIB."PHPMailer/class.smtp.php");
    $mailWeb = new PHPMailer();
    $mailWeb->IsSMTP();
    $mailWeb->SMTPSecure = 'tls';
    $mailWeb->Host = "smtp.ionos.mx";
    $mailWeb->SMTPDebug = 0;
    $mailWeb->SMTPAuth = true;
    $mailWeb->Port = 587;
    $mailWeb->Username = "soporte@siluetaexpress.com.mx";
    $mailWeb->Password = $claveCorreo;
    $mailWeb->SetFrom("soporte@siluetaexpress.com.mx", "Soporte SiluetaExpress");
    //    $mailWeb->AddReplyTo("siluetaexpress@pruebassointec.com.mx", "SiluetaExpress @NoReply");
    $mailWeb->Subject = $asunto;
    $mailWeb->AltBody = $mensaje;
    $mailWeb->MsgHTML($mensaje);
    $mailWeb->AddAddress($para);
  foreach ($imagenes as $im)
      $mailWeb->addAttachment(FOLDER_TMP."$im");
   
    try{
        return $mailWeb->Send();
        return true;
    }catch(Exception $e){
        return false;
        echo $e;
    }
}

function obtenerHorarioSucursal($idSucursal,$fecha){

    require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
    
    $sucursal=new ModeloSucursal();
    $sucursal->setIdSucursal($idSucursal);
    
    $dia=date('N',strtotime ($fecha));
    // sacar hr
    if ($dia==6){
        $hrInicio = $sucursal->getSabadoEntrada();
        $hrFin=$sucursal->getSabadoSalida();
    }else {
        $hrInicio = $sucursal->getEntreSemanaEntrada();
        $hrFin = $sucursal->getEntreSemanaSalida();
    }
    
    $horas=$minutos=array();
    
    for ($hr=$hrInicio;$hr<$hrFin;$hr++)
       array_push($horas, $hr);
    
    
    for ($min=0;$min<=50;$min+=10)
        array_push($minutos, $min);
            
    return json_encode(array($horas,$minutos,$hrFin));

}


/*
$mailWeb->Host = "a2plcpnl0309.prod.iad2.secureserver.net ";
    $mailWeb->SMTPDebug = 0;
    $mailWeb->SMTPAuth = true;
    $mailWeb->Port = 80;
    $mailWeb->Username = "admin@siluetaexpress.com.mx";
    $mailWeb->Password = "admin2018.";
    $mailWeb->SetFrom("admin@siluetaexpress.com.mx", "SiluetaExpress @NoReply");
    $mailWeb->AddReplyTo("admin@siluetaexpress.com.mx", "SiluetaExpress @NoReply");
    
    
    $mailWeb->Host = "smtp.gmail.com";
    $mailWeb->SMTPDebug = 0;
    $mailWeb->SMTPAuth = true;
    $mailWeb->Port = 587;
    $mailWeb->Username = "siluetaexpress2018@gmail.com";
    $mailWeb->Password = "silueta2018";
    $mailWeb->SetFrom("siluetaexpress2018@gmail.com", "SiluetaExpress @NoReply");
    $mailWeb->AddReplyTo("siluetaexpress2018@gmail.com", "SiluetaExpress @NoReply");
    
*/
?>