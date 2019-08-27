<?php

	require FOLDER_MODEL_BASE . "model.base.seguimiento_producto.inc.php";

	class ModeloSeguimiento_producto extends ModeloBaseSeguimiento_producto
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseSeguimiento_producto";

		var $__ss=array();

		#------------------------------------------------------------------------------------------------------#
		#--------------------------------------------Inicializacion--------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		function __construct()
		{
			parent::__construct();
		}

		function __destruct()
		{
			
		}

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Setter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#-----------------------------------------------Unsetter-----------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Getter------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#



		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Querys------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#

		#------------------------------------------------------------------------------------------------------#
		#------------------------------------------------Otras-------------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		
		public function validarDatos()
		{
			return true;
		}
		
		public function bajaSegProductos($idSegProducto)
		{
		    $query = "update seguimiento_producto set estatus='baja' where idSeguimientoProducto=".$idSegProducto;
		    mysqli_query($this->dbLink, $query);
		}
		
		public function guardarSegProducto ()
		{
		    global $objSession;
		    $query = "Select * from seguimiento_producto where idProducto=".$this->getIdProducto()." and idSeguimiento=".$this->getIdSeguimiento();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        $row_inf = mysqli_fetch_assoc($resultado);
		        $this->setIdSeguimientoProducto($row_inf['idSeguimientoProducto']);
		        $this->setEstatusActivo();
		        
		    }else {
		        $this->setIdUsuario($objSession->getidUsuario());
		        $this->setFechaRegistro(date("Y-m-d H:i:s"));
		    }
		    $this->Guardar();
		     
		}
		
		public function obtenerProductosByIdSeg($idSeguimiento)
		{
		    $query = "Select p.idProducto, producto as nombreP from seguimiento_producto as sp
                        inner join productos as p on sp.idProducto=p.idProducto where sp.estatus='activo' and idSeguimiento=".$idSeguimiento;
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $arreglo[$row_inf['idProducto']] = $row_inf['nombreP'];
		        }
		    }
		    return $arreglo;
		}
		
	}

