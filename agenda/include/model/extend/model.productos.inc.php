<?php

	require FOLDER_MODEL_BASE . "model.base.productos.inc.php";

	class ModeloProductos extends ModeloBaseProductos
	{
		#------------------------------------------------------------------------------------------------------#
		#----------------------------------------------Propiedades---------------------------------------------#
		#------------------------------------------------------------------------------------------------------#
		var $_nombreClase="ModeloBaseProductos";

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

		public function obtenerProductos()
		{
		    global $objSession;
		/*    if ($this->idSucursal==0){
		        ///    $where = " p.idSucursal=".$objSession->getIdSucursal();
		    }else{
		        $where = " p.idSucursal=".$this->idSucursal;
		    }
		    $inner=" inner join sucursal as s on p.idSucursal=s.idSucursal ";
		*/    
		    $query = "Select producto as nombreP from productos as p  where estatus='activo'";
		    $arreglo = array();
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        while ($row_inf = mysqli_fetch_assoc($resultado)){
		            $arreglo[] = $row_inf['nombreP'];
		        }
		    }
		    return $arreglo;
		}
		
		public function buscarProductoByNombre($Producto)
		{
		    global $objSession;
		    $query = "Select * from productos where producto='".$Producto."'";
		    $resultado = mysqli_query($this->dbLink, $query);
		    if ($resultado && mysqli_num_rows($resultado) > 0) {
		        $row_inf = mysqli_fetch_assoc($resultado);
		        return $row_inf['idProducto'];
		    }else {
		        $this->setProducto($Producto);
		        $this->setIdUsuario($objSession->getidUsuario());
		        $this->setFechaRegistro(date("Y-m-d H:i:s"));
		        $this->Guardar();
		        return mysqli_insert_id($this->dbLink);
		    }
		}
		
		
	}

