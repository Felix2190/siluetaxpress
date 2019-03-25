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
           $filtros .= " AND nombreP LIKE '".$valor."%' ";
          
        }
        else if($clave==1)
        {
           $filtros .= " AND telefonoCel LIKE '".$valor."%' ";
        }

        else if($clave==2)
        {
            $filtros .= " AND completitud LIKE '".$valor."%' ";
        }
        
        else if($clave==3)
        {
            $filtros .= " AND fecha LIKE '".$valor."%' ";
        }
        
        else if($clave==4)
        {
            $filtros .= " AND consultasHechas LIKE '".$valor."%' ";
        }
        
        else if($clave==5)
        {
            $filtros .= " AND consultasProximas LIKE '".$valor."%' ";
            
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
            $ordenar = 'ORDER BY nombreP ASC';
          }
          else
          {
            $ordenar = 'ORDER BY nombreP DESC';
          }
        }
        else if($clave==1)
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
        else if($clave==2)
        {
          if($valor==0)
          {
            $ordenar = 'ORDER BY completitud ASC';
          }
          else
          {
            $ordenar = 'ORDER BY completitud DESC';
          }
        }
        else if($clave==3)
        {
          if($valor==0)
          {
            $ordenar = 'ORDER BY fecha ASC';
          }
          else
          {
            $ordenar = 'ORDER BY fecha DESC';
          }
        }
        else if($clave==4)
        {
          if($valor==0)
          {
            $ordenar = 'ORDER BY consultasHechas ASC';
          }
          else
          {
            $ordenar = 'ORDER BY consultasHechas DESC';
          }
        }
        else if($clave==5)
        {
          if($valor==0)
          {
            $ordenar = 'ORDER BY consultasProximas ASC';
          }
          else
          {
            $ordenar = 'ORDER BY consultasProximas DESC';
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
  $sucursal =  $_GET["sucursal"];
  $pagina =  $_GET["page"];
  $tamano =  $_GET["size"];
  $filtros="";
  $ordenar="";
  $filtros = armar_filtros();
  $ordenar = ordenar();
	
  $inicial = (($pagina) * $tamano);
  if($filtros!='')
  {
    $query="select idPaciente, nombreP, telefonoCel, sucursal, completitud, fecha,  consultasHechas, consultasProximas, fechaProxima , cita 
          from vw_listado_pacientes where idSucursal=".$sucursal." and estatus='activo'  ".$filtros.$ordenar." LIMIT $inicial, $tamano";
    
    
  }
  else
  {
      $query="select idPaciente, nombreP, telefonoCel, sucursal, completitud, fecha,  consultasHechas, consultasProximas, fechaProxima , cita
          from vw_listado_pacientes where idSucursal=".$sucursal." and estatus='activo' ".$ordenar." LIMIT $inicial, $tamano"; 	
  }
//  echo $query;
  $result=mysqli_query($dbLink,$query);
	if(!$result)
		die("Ocurrio un error en la consulta de Llamadas.");

  while($row = mysqli_fetch_array($result)) {
    $arreglo_filas[] = $row;
  }

  if(isset($arreglo_filas))
  {
    if($filtros!='')
    {
      $query="SELECT COUNT(*) AS total 		   			      		  	 
  				FROM vw_listado_pacientes where idSucursal=".$sucursal." and estatus='activo' 
            ".$filtros."";
    }
    else
    {
      $query="SELECT COUNT(*) AS total    			 
			  	FROM vw_listado_pacientes where idSucursal=".$sucursal." and estatus='activo'  ".$filtros;
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
