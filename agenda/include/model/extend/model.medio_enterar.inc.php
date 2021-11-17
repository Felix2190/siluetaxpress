<?php
require FOLDER_MODEL_BASE . "model.base.medio_enterar.inc.php";

class ModeloMedio_enterar extends ModeloBaseMedio_enterar
{

    # ------------------------------------------------------------------------------------------------------#
    # ----------------------------------------------Propiedades---------------------------------------------#
    # ------------------------------------------------------------------------------------------------------#
    var $_nombreClase = "ModeloBaseMedio_enterar";

    var $__ss = array();

    # ------------------------------------------------------------------------------------------------------#
    # --------------------------------------------Inicializacion--------------------------------------------#
    # ------------------------------------------------------------------------------------------------------#
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {}

    # ------------------------------------------------------------------------------------------------------#
    # ------------------------------------------------Setter------------------------------------------------#
    # ------------------------------------------------------------------------------------------------------#

    # ------------------------------------------------------------------------------------------------------#
    # -----------------------------------------------Unsetter-----------------------------------------------#
    # ------------------------------------------------------------------------------------------------------#

    # ------------------------------------------------------------------------------------------------------#
    # ------------------------------------------------Getter------------------------------------------------#
    # ------------------------------------------------------------------------------------------------------#

    # ------------------------------------------------------------------------------------------------------#
    # ------------------------------------------------Querys------------------------------------------------#
    # ------------------------------------------------------------------------------------------------------#

    # ------------------------------------------------------------------------------------------------------#
    # ------------------------------------------------Otras-------------------------------------------------#
    # ------------------------------------------------------------------------------------------------------#
    public function validarDatos()
    {
        return true;
    }

    public function obtenerMedios()
    {
        $query = "Select idMedio, medio from medio_enterar where principal=1";
        $arreglo = array();
        $resultado = mysqli_query($this->dbLink, $query);
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            while ($row_inf = mysqli_fetch_assoc($resultado)) {
                $arreglo[$row_inf['idMedio']] = $row_inf['medio'];
            }
        }
        return $arreglo;
    }
    
    public function obtenerTotalMedios($mes, $anio)
    {
        global $objSession;
        $query = "Select count(*) total from paciente p inner join sucursal s on p.idSucursal=s.idSucursal 
                    where date_format(fechaRegistro,'%m-%Y')='$mes-$anio' and s.idFranquicia=".$objSession->getIdFranquicia();
        $totalRegistros =0;
        $resultado = mysqli_query($this->dbLink, $query);
        if ($resultado && mysqli_num_rows($resultado) > 0){
            $row_inf = mysqli_fetch_assoc($resultado);
            $totalRegistros = $row_inf['total'];
         }
         $porcentaje=0;
         if ($totalRegistros>0)
            $porcentaje= 10/$totalRegistros;
        $otro=0;
        $query = "SELECT m.idMedio, medio, COUNT(*) total from paciente p 
                inner join sucursal s on p.idSucursal=s.idSucursal
                INNER JOIN medio_enterar m on m.idMedio=p.idMedio
                where principal=1 and date_format(fechaRegistro,'%m-%Y')='$mes-$anio' and s.idFranquicia=".$objSession->getIdFranquicia()."
                GROUP by m.idMedio";
        $arreglo = array();
        $resultado = mysqli_query($this->dbLink, $query);
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            while ($row_inf = mysqli_fetch_assoc($resultado)) {
                if (intval($row_inf['idMedio'])<=5){
                    $arreglo[$row_inf['medio']] = array($row_inf['total'],$row_inf['total']*$porcentaje);
                    $otro+=$row_inf['total'];
                }
            }
        }
        $otro=$totalRegistros-$otro;
        $arreglo['Otro'] = array($otro,$otro*$porcentaje);
        
        return $arreglo;
    }
}

