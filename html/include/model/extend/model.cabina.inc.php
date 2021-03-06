<?php
require FOLDER_MODEL_BASE . "model.base.cabina.inc.php";

class ModeloCabina extends ModeloBaseCabina
{

    // ------------------------------------------------------------------------------------------------------#
    // ----------------------------------------------Propiedades---------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    var $_nombreClase = "ModeloBaseCabina";

    var $__ss = array();

    // ------------------------------------------------------------------------------------------------------#
    // --------------------------------------------Inicializacion--------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {}

    // ------------------------------------------------------------------------------------------------------#
    // ------------------------------------------------Setter------------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    
    // ------------------------------------------------------------------------------------------------------#
    // -----------------------------------------------Unsetter-----------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    
    // ------------------------------------------------------------------------------------------------------#
    // ------------------------------------------------Getter------------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    
    // ------------------------------------------------------------------------------------------------------#
    // ------------------------------------------------Querys------------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    
    // ------------------------------------------------------------------------------------------------------#
    // ------------------------------------------------Otras-------------------------------------------------#
    // ------------------------------------------------------------------------------------------------------#
    public function validarDatos()
    {
        return true;
    }

    public function obtenerConsultorios()
    {
        $condicion = " ";
        if ($this->idSucursal > 0)
            $condicion .= " and idSucursal=" . $this->idSucursal;
        if ($this->tipo!= "")
            $condicion .= " and tipo='$this->tipo'";
        
        $query = "Select idCabina, nombre from cabina where true $condicion";
        $arreglo = array();
        $resultado = mysqli_query($this->dbLink, $query);
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            while ($row_inf = mysqli_fetch_assoc($resultado)) {
                $arreglo[$row_inf['idCabina']] = $row_inf['nombre'];
            }
        }
        return $arreglo;
    }

    public function obtenerTotalBySucussal()
    {
        $condicion = " and idSucursal=" . $this->idSucursal;
        
        $query = "Select tipo, count(*) as total from cabina where true $condicion group by tipo";
        $arreglo = array();
        $resultado = mysqli_query($this->dbLink, $query);
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            while ($row_inf = mysqli_fetch_assoc($resultado)) {
                $arreglo[$row_inf['tipo']] = $row_inf['total'];
            }
        }
        return $arreglo;
    }
}

