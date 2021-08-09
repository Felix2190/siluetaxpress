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
           $filtros .= " AND nombreCompleto LIKE '%".$valor."%' ";
          
        }
        else if($clave==1)
        {
           $filtros .= " AND s.sucursal LIKE '%".$valor."%' ";
        }
        
        else if($clave==2)
        {
            $filtros .= " AND c.tipoConsulta LIKE '%".$valor."%' ";
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
  $filtros="";
  $ordenar="";
  $filtros = armar_filtros();
  
  $inicial = (($pagina) * $tamano);
  if($filtros!='')
  {
    $query="SELECT p.*, s.sucursal, c.tipoConsulta, c.idConsulta FROM personal p INNER JOIN sucursal s on p.idSucursal=s.idSucursal INNER JOIN consulta c on p.tipoConsulta=c.idConsulta 
       where idFranquicia=".$objSession->getIdFranquicia()." $filtros $ordenar LIMIT $inicial, $tamano";
  }
  else
  {
      $query="SELECT p.*, s.sucursal, c.tipoConsulta, idConsulta FROM personal p INNER JOIN sucursal s on p.idSucursal=s.idSucursal INNER JOIN consulta c on p.tipoConsulta=c.idConsulta
       where idFranquicia=".$objSession->getIdFranquicia()."  LIMIT $inicial, $tamano";
  }
//  echo $query;
  $result=mysqli_query($dbLink,$query);
	if(!$result)
		die("Ocurrio un error en la consulta de personal");

  while($row = mysqli_fetch_array($result)) {
    $arreglo_filas[] = $row;
  }

  if(isset($arreglo_filas))
  {
    if($filtros!='')
    {
      $query="SELECT COUNT(*) AS total from personal p INNER JOIN sucursal s on p.idSucursal=s.idSucursal INNER JOIN consulta c on p.tipoConsulta=c.idConsulta
       where idFranquicia=".$objSession->getIdFranquicia()." ".$filtros."";
    }
    else
    {
      $query="SELECT COUNT(*) AS total from personal p INNER JOIN sucursal s on p.idSucursal=s.idSucursal INNER JOIN consulta c on p.tipoConsulta=c.idConsulta
       where idFranquicia=".$objSession->getIdFranquicia()." ";
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
