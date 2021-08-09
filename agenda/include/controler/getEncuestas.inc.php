<?php
$dbLink =  new mysqli(BD_HOST,BD_USER,BD_PASS,BD_DB);
$dbLink->set_charset(BD_CHARSET);

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Includes-------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------------Funciones------------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
  function armar_filtros()
  {
    $filtros = '';
    if(isset($_GET['filter']) && $_GET['filter']!='')
    {
      foreach ($_GET['filter'] as $clave => $valor)
      {
        if($clave==0)
        {
           $filtros .= " AND s.sucursal LIKE '%".$valor."%' ";
          
        }
        else if($clave==1)
        {
           $filtros .= " AND c.tipoConsulta LIKE '".$valor."%' ";
        }
        
      }
    }
    return $filtros;
  }

	#----------------------------------------------------------------------------------------------------------------------#
	#-----------------------------------------------------Seccion AJAX-----------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#


	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Procesamiento de formulario----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#


	#----------------------------------------------------------------------------------------------------------------------#
	#---------------------------------------------Inicializacion de variables----------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
  $pagina =  $_GET["page"];
  $tamano =  $_GET["size"];
  $fecha =  $_GET["fecha"];
  $filtros= armar_filtros();
  $ordenar="";
  
  $inicial = (($pagina) * $tamano);
  
  if($filtros!='')
  {
      $query="SELECT e.idEncuesta,s.sucursal, c.tipoConsulta, p.telefonoCel FROM encuesta e INNER join sucursal s on e.idSucursal=s.idSucursal 
    INNER JOIN consulta c on e.idTipoConsulta=c.idConsulta INNER JOIN paciente p on e.idPaciente=p.idPaciente
   WHERE e.estatus=0 and date_format(e.fechaRegistro,'%Y-%m-%d')='$fecha' and s.idFranquicia=".$objSession->getIdFranquicia()." ".$filtros."  LIMIT $inicial, $tamano";
  }else {
      $query="SELECT e.idEncuesta,s.sucursal, c.tipoConsulta, p.telefonoCel FROM encuesta e INNER join sucursal s on e.idSucursal=s.idSucursal 
    INNER JOIN consulta c on e.idTipoConsulta=c.idConsulta INNER JOIN paciente p on e.idPaciente=p.idPaciente
   WHERE e.estatus=0 and date_format(e.fechaRegistro,'%Y-%m-%d')='$fecha' and s.idFranquicia=".$objSession->getIdFranquicia()."  LIMIT $inicial, $tamano";
  }
//  echo $query;
  $result=mysqli_query($dbLink,$query);
	if(!$result)
		die("Ocurrio un error en la consulta de encuestas");

  while($row = mysqli_fetch_array($result)) {
    $arreglo_filas[] = $row;
  }

  if(isset($arreglo_filas))
  {
    if($filtros!='')
    {
      $query="SELECT COUNT(*) AS total from encuesta e INNER join sucursal s on e.idSucursal=s.idSucursal 
    INNER JOIN consulta c on e.idTipoConsulta=c.idConsulta INNER JOIN paciente p on e.idPaciente=p.idPaciente
   WHERE e.estatus=0 and date_format(e.fechaRegistro,'%Y-%m-%d')='$fecha' and s.idFranquicia=".$objSession->getIdFranquicia()." ".$filtros."";
    }
    else
    {
      $query="SELECT COUNT(*) AS total from encuesta e INNER join sucursal s on e.idSucursal=s.idSucursal 
    INNER JOIN consulta c on e.idTipoConsulta=c.idConsulta INNER JOIN paciente p on e.idPaciente=p.idPaciente
   WHERE e.estatus=0 and date_format(e.fechaRegistro,'%Y-%m-%d')='$fecha' and s.idFranquicia=".$objSession->getIdFranquicia()." ";
    }//echo $query;
    $result=mysqli_query($dbLink,$query);
    if(!$result)
    	die("Ocurrio un error en la consulta.");
    while($r=mysqli_fetch_assoc($result)){
    	$total = $r['total'];
    }
    
    echo json_encode(array($total, $arreglo_filas));
  }
  else
  {
    echo json_encode('');
  }

	#----------------------------------------------------------------------------------------------------------------------#
	#-------------------------------------------------Salida de Javascript-------------------------------------------------#
	#----------------------------------------------------------------------------------------------------------------------#
