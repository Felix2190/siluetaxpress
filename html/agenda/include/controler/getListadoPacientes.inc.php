<?php

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
          if($filtros=='')
          {
            $filtros .= " and B.idBeneficiario  LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND B.idBeneficiario  LIKE '".$valor."%' ";
          }
        }
        else if($clave==1)
        {
          if($filtros=='')
          {
            $filtros .= " and P.NB_NOMBRE LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND P.NB_NOMBRE LIKE '".$valor."%' ";
          }
        }
        else if($clave==2)
        {
          if($filtros=='')
          {
            $filtros .= " and P.NB_PRIMER_AP LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND P.NB_PRIMER_AP LIKE '".$valor."%' ";
          }
        }
        else if($clave==3)
        {
          if($filtros=='')
          {
            $filtros .= " and P.NB_SEGUNDO LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND P.NB_SEGUNDO LIKE '".$valor."%' ";
          }
        }
        else if($clave==4)
        {
          if($filtros=='')
          {
            $filtros .= " and P.FH_NACIMIENTO LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND P.FH_NACIMIENTO LIKE '".$valor."%' ";
          }
        }
        else if($clave==7)
        {
          if($filtros=='')
          {
            $filtros .= " and T.numTarjeta LIKE '".$valor."%' ";
          }
          else
          {
            $filtros .= " AND T.numTarjeta LIKE '".$valor."%' ";
          }
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
            $ordenar = 'ORDER BY ID ASC';
          }
          else
          {
            $ordenar = 'ORDER BY ID DESC';
          }
        }
        else if($clave==1)
        {
          if($valor==0)
          {
            $ordenar = 'ORDER BY nombre ASC';
          }
          else
          {
            $ordenar = 'ORDER BY nombre DESC';
          }
        }
        else if($clave==2)
        {
          if($valor==0)
          {
            $ordenar = 'ORDER BY paterno ASC';
          }
          else
          {
            $ordenar = 'ORDER BY paterno DESC';
          }
        }
        else if($clave==3)
        {
          if($valor==0)
          {
            $ordenar = 'ORDER BY materno ASC';
          }
          else
          {
            $ordenar = 'ORDER BY materno DESC';
          }
        }
        else if($clave==4)
        {
          if($valor==0)
          {
            $ordenar = 'ORDER BY FN ASC';
          }
          else
          {
            $ordenar = 'ORDER BY FN DESC';
          }
        }
        else if($clave==7)
        {
          if($valor==0)
          {
            $ordenar = 'ORDER BY tarjeta ASC';
          }
          else
          {
            $ordenar = 'ORDER BY tarjeta DESC';
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
    $query="Select p.idPaciente, concat_ws(' ', p.nombre, p.apellidos) as nombreP, telefonoCel, sucursal, completitud, 
                    DATE_FORMAT(p.fechaRegistro,'%Y-%m-%d') as fecha, 
                    (select count(*) from cita where idPaciente=p.idPaciente and estatus='realizada') as consultasHechas, 
                    (select count(*) from cita where idPaciente=p.idPaciente and (estatus='nueva' or estatus='curso')) as consultasProximas,
                    (select DATE_FORMAT(fechaInicio,'%Y-%m-%d') from cita where idPaciente=p.idPaciente and estatus='nueva' order by fechaInicio limit 1) as fechaProxima ,
                     (select idCita from cita where idPaciente=p.idPaciente and estatus='nueva' order by fechaInicio limit 1) as cita 
                    from paciente as p 
		             inner join sucursal as s on p.idSucursal=s.idSucursal
                       inner join hojaclinica as h on p.idHojaClinica=h.idHojaClinica where s.idSucursal=$objSession->getIdSucursal()  and p.estatus='activo'
          ".$filtros."
  			  ".$ordenar." LIMIT $inicial, $tamano";
    
    
  }
  else
  {
  $query="Select p.idPaciente, concat_ws(' ', p.nombre, p.apellidos) as nombreP, telefonoCel, sucursal, completitud, 
                    DATE_FORMAT(p.fechaRegistro,'%Y-%m-%d') as fecha, 
                    (select count(*) from cita where idPaciente=p.idPaciente and estatus='realizada') as consultasHechas, 
                    (select count(*) from cita where idPaciente=p.idPaciente and (estatus='nueva' or estatus='curso')) as consultasProximas,
                    (select DATE_FORMAT(fechaInicio,'%Y-%m-%d') from cita where idPaciente=p.idPaciente and estatus='nueva' order by fechaInicio limit 1) as fechaProxima ,
                     (select idCita from cita where idPaciente=p.idPaciente and estatus='nueva' order by fechaInicio limit 1) as cita 
                    from paciente as p 
		             inner join sucursal as s on p.idSucursal=s.idSucursal
                       inner join hojaclinica as h on p.idHojaClinica=h.idHojaClinica where $where  and p.estatus='activo' ".$ordenar." LIMIT $inicial, $tamano"; 	
  }
//  echo $query;
  $result=mysqli_query($dbLink,$query);
	if(!$result)
		die("Ocurrio un error en la consulta de Llamadas.");

	while($row = $result->fetch_array(MYSQL_ASSOC)) {
    $arreglo_filas[] = $row;
  }

  if(isset($arreglo_filas))
  {
    if($filtros!='')
    {
      $query="SELECT COUNT(*) AS total 		   			      		  	 
  				FROM beneficiario AS B 
			  	INNER JOIN persona As P ON B.idPersona=P.idPersona 
			  	INNER JOIN beneficiario_tarjeta as T ON B.idBeneficiario=T.idBeneficiario and T.estatus='vigente'
			  	INNER JOIN persona_datos_extra DE ON DE.idPersona = P.idPersona
			  	INNER JOIN persona_domicilio PD ON PD.idPersona = P.idPersona and PD.esVigente=1  	 
			  	INNER JOIN inegidomgeo_domicilio_geografico D ON D.DOMICILIO_ID = PD.DOMICILIO_ID
    			where not exists(select * from ccoutbound_llamada      		 
    				left join ccoutbound_cat_estatus on ccoutbound_llamada.idccoutboundcatestatus = ccoutbound_cat_estatus.idccoutboundcatestatus
            		where B.idBeneficiario = ccoutbound_llamada.idBeneficiario
    				and ccoutbound_cat_estatus.marcado <> 'activo' and ccoutbound_llamada.IdCcoutbound=0) 
  				and  (P.TEL_MOVIL <> '' or P.TEL_CASA <> '' or DE.telcasa<>'' or DE.telcel<>'')AND D.CVE_ENT = $edo AND D.CVE_MUN = $mun
            ".$filtros."";
    }
    else
    {
      $query="SELECT COUNT(*) AS total    			 
			  	FROM beneficiario AS B 
			  	INNER JOIN persona As P ON B.idPersona=P.idPersona 
			  	INNER JOIN beneficiario_tarjeta as T ON B.idBeneficiario=T.idBeneficiario and T.estatus='vigente'
			  	INNER JOIN persona_datos_extra DE ON DE.idPersona = P.idPersona
			  	INNER JOIN persona_domicilio PD ON PD.idPersona = P.idPersona and PD.esVigente=1  	 
			  	INNER JOIN inegidomgeo_domicilio_geografico D ON D.DOMICILIO_ID = PD.DOMICILIO_ID
      			where not exists(select * from ccoutbound_llamada      		 
    				left join ccoutbound_cat_estatus on ccoutbound_llamada.idccoutboundcatestatus = ccoutbound_cat_estatus.idccoutboundcatestatus
            		where B.idBeneficiario = ccoutbound_llamada.idBeneficiario
    				and ccoutbound_cat_estatus.marcado <> 'activo' and ccoutbound_llamada.IdCcoutbound=0) 
  				and  (P.TEL_MOVIL <> '' or P.TEL_CASA <> '' or DE.telcasa<>'' or DE.telcel<>'')AND D.CVE_ENT = $edo AND D.CVE_MUN = $mun
      		";
    }//echo $query;
    $result=mysqli_query($dbLink,$query);
    if(!$result)
    	die("Ocurrio un error en la consulta de listado de Llamadas.");
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
