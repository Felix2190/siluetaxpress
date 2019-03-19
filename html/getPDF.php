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

require_once  FOLDER_INCLUDE."lib/pdf/fpdf.php";
require_once(CLASS_COMUN);

if (isset($_SESSION['info'])){
    $info =json_decode($_SESSION['info'],true);;
    ///echo $info['txtNombre'];
    
    class PDF extends FPDF{
        var $posY=32;
        function Header()
        {
            $this->SetFont('Arial','B',15);
            $this->Cell(80);
            $this->Cell(30,10,'Datos',0,0,'C');
            // Salto de línea
            $this->Ln(20);
        }
        function imprmeColumna($idem,$texto){
            $this->SetFont('Arial','I',11);
            //$pdf->Cell(20,8,' Nombre: ',0,0,'L',1);
            $this->SetFillColor( 177, 250, 250 );
            $this->MultiCell(40,20,$idem,1,'J',1);
            $this->SetY($this->posY);
            $this->SetX(50);
            $this->SetFillColor(255,255,255);/// color blanco celda
            $this->MultiCell(140,20,utf8_decode($texto),1,'J',1);
            $this->posY+=20;
        }
        function Footer()
        {
            // Posición: a 1,5 cm del final
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Número de página
            $this->Cell(0,10,"Ejemplo",0,0,'C');
        }
    }
    
    $pdf = new PDF();
    
    $pdf->AliasNbPages();
    //$pdf->AddPage();
    $pdf->AddPage();
    $pdf->SetTitle("ejemplo.pdf");
    //$pdf->PaginaUno($responsable,$sucursal->getSucursal(),utf8_decode($sucursal->getDireccion()),$objSession->getAbrev());
   
    
    $pdf->SetFillColor(255,255,255);/// color blanco celda
    ///$pdf->Cell(190,8,'tjkj ','B',0,'L',0);
    $pdf->Ln(2);
    foreach ($info as $idem=>$texto){
        $pdf->imprmeColumna($idem, $texto);
    }
    $pdf->Output();
}else{
    
}
?>
