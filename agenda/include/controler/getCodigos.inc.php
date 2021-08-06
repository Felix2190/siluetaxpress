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
           $filtros .= " AND codigo LIKE '%".$valor."%' ";
          
        }
        else if($clave==1)
        {
           $filtros .= " AND promocion LIKE '".$valor."%' ";
        }

        else if($clave==2)
        {
            $filtros .= " AND estatus LIKE '".$valor."%' ";
        }
        
      }
    }
    return $filtros;
  }

  function ordenar()
  {
    $ordenar = '';
    if(isset($_GET['col']) && $_GET['col']!='')
    {
      foreach ($_GET['col'] as $clave => $valor)
      {
        if($clave==0)
        {
          if($valor==0)
          {
            $ordenar = 'ORDER BY codigo ASC';
          }
          else
          {
            $ordenar = 'ORDER BY codigo DESC';
          }
        }
        else if($clave==1)
        {
          if($valor==0)
          {
            $ordenar = 'ORDER BY promocion ASC';
          }
          else
          {
            $ordenar = 'ORDER BY promocion DESC';
          }
        }
        else if($clave==2)
        {
          if($valor==0)
          {
            $ordenar = 'ORDER BY estatus ASC';
          }
          else
          {
            $ordenar = 'ORDER BY estatus DESC';
          }
        }
        
      }
    }
    return $ordenar;
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
  $ordenar = ordenar();
  
  $inicial = (($pagina) * $tamano);
  if($filtros!='')
  {
    $query="select codigo, promocion, estatus from ganadores_promocion 
       where date_format(fecha,'%Y-%m')='".date("Y-m")."' $filtros $ordenar LIMIT $inicial, $tamano";
  }
  else
  {
      $query="select codigo, promocion, estatus from ganadores_promocion
       where date_format(fecha,'%Y-%m')='".date("Y-m")."' $ordenar LIMIT $inicial, $tamano";
  }
//  echo $query;
  $result=mysqli_query($dbLink,$query);
	if(!$result)
		die("Ocurrio un error en la consulta de codigos");

  while($row = mysqli_fetch_array($result)) {
    $arreglo_filas[] = $row;
  }

  if(isset($arreglo_filas))
  {
    if($filtros!='')
    {
      $query="SELECT COUNT(*) AS total from ganadores_promocion
       where date_format(fecha,'%Y-%m')='".date("Y-m")."' ".$filtros."";
    }
    else
    {
      $query="SELECT COUNT(*) AS total from ganadores_promocion
       where date_format(fecha,'%Y-%m')='".date("Y-m")."' ";
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
