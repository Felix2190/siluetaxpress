<?php
session_start();
define("DEVELOPER", false);
if (! DEVELOPER) {
    /**
     * constantes de producción
     */
    define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "/siluetaexpress/include/");
    
} else {
    /**
     * constantes de desarrollo
     */
    define("FOLDER_INCLUDE", $_SERVER['DOCUMENT_ROOT'] . "siluetaxpress/html/include/");
}

define("CLASS_CONEXION", FOLDER_INCLUDE.'Conexion/Conexion.php');

define("FOLDER_MODEL", FOLDER_INCLUDE . "model/");
define("FOLDER_MODEL_BASE", FOLDER_MODEL . "base/");
define("FOLDER_MODEL_EXTEND", FOLDER_MODEL . "extend/");

define("FOLDER_MODEL_DATA", FOLDER_INCLUDE . "model/data/");

define("CLASS_COMUN", FOLDER_MODEL_DATA . "clsBasicCommon.inc.php");

//require_once  FOLDER_INCLUDE."lib/pdf/fpdf.php";
require_once(CLASS_COMUN);

if (isset($_POST['estado'])){
    require_once FOLDER_MODEL_EXTEND . "model.inegidomgeo_cat_estado.inc.php";
    
    $estados = new ModeloInegidomgeo_cat_estado();
    $estados->setCVE_ENT($_POST['estado']);
    
    echo $estados->getNOM_ENT();
}
if (isset($_POST['info'])){
     $_SESSION['info'] =$_POST['info'];
    echo true;
/*
   header("Location: getPDF.php");
    class PDF extends FPDF{
        var $direccion;
        function PaginaUno($responsable,$sucursal,$dir,$cargo){
            $this->SetFont('Arial','B',30);
            $this->Cell(190,27,'',1,0,'C',0);
     ///       $this->Image('images/logo_siluetaExpress.png',15,13,45,null);//
            $this->SetFont('Arial','',16);
            $this->Ln(1);
            $this->direccion=$dir;
            //TItulo
            
            $this->Cell(185,15,'Hoja clínica ',0,0,'R',0);
            $this->Ln(8);
            $this->SetFont('Arial','',10);
            $this->Cell(185,18,$cargo.' '.utf8_decode($responsable),0,0,'R',0);
            $this->Ln(5);
            $this->SetFont('Arial','',8);
            $this->Cell(185,18,$sucursal,0,0,'R',0);
            $this->Ln(15);
        }
        
        function Footer()
        {
            // Posición: a 1,5 cm del final
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Número de página
            $this->Cell(0,10,$this->direccion,0,0,'C');
        }
    }
    
    $pdf = new PDF();
    
    $pdf->AliasNbPages();
    //$pdf->AddPage();
    $pdf->AddPage();
    $pdf->SetTitle("hoja_clinica.pdf");
    //$pdf->PaginaUno($responsable,$sucursal->getSucursal(),utf8_decode($sucursal->getDireccion()),$objSession->getAbrev());
    $pdf->SetFont('Arial','',12);
    
    $pdf->SetFillColor(255,255,255);/// color blanco celda
    $pdf->Cell(190,8,'tjkj ','B',0,'L',0);
    $pdf->Ln(2);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(20,8,' Nombre: ',0,0,'L',1);
    
    header("Location: ".$pdf->Output());
*/}

?>
