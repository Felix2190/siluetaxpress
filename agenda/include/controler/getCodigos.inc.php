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
            $filtros .= " AND telefonoCel LIKE '".$valor."%' ";
        }
        else if($clave==3)
        {
            $filtros .= " AND gp.estatus LIKE '".$valor."%' ";
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
                $ordenar = 'ORDER BY telefonoCel ASC';
            }
            else
            {
                $ordenar = 'ORDER BY telefonoCel DESC';
            }
        }
        else if($clave==3)
        {
          if($valor==0)
          {
            $ordenar = 'ORDER BY gp.estatus ASC';
          }
          else
          {
            $ordenar = 'ORDER BY gp.estatus DESC';
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
    $query="select codigo, promocion, telefonoCel, gp.estatus from ganadores_promocion as gp 
        inner join paciente p on gp.idPaciente=p.idPaciente
       where date_format(fecha,'%Y-%m')='".date("Y-m")."' and idFranquicia=".$objSession->getIdFranquicia()." $filtros $ordenar LIMIT $inicial, $tamano";
  }
  else
  {
      $query="select codigo, promocion, telefonoCel, gp.estatus from ganadores_promocion as gp 
        inner join paciente p on gp.idPaciente=p.idPaciente
       where date_format(fecha,'%Y-%m')='".date("Y-m")."' and idFranquicia=".$objSession->getIdFranquicia()." $ordenar LIMIT $inicial, $tamano";
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
      $query="SELECT COUNT(*) AS total from ganadores_promocion as gp 
        inner join paciente p on gp.idPaciente=p.idPaciente
       where date_format(fecha,'%Y-%m')='".date("Y-m")."' and idFranquicia=".$objSession->getIdFranquicia()." ".$filtros."";
    }
    else
    {
      $query="SELECT COUNT(*) AS total from ganadores_promocion as gp 
        inner join paciente p on gp.idPaciente=p.idPaciente
       where date_format(fecha,'%Y-%m')='".date("Y-m")."' and idFranquicia=".$objSession->getIdFranquicia()." ";
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
