<?php
require_once LIB_FPDF;
require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.hojaclinica.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.hojaseguimiento.inc.php";

// -----------------------------------------------------------------------------------------------------------------#
// --------------------------------------------Inicializacion de control--------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
Function pdfErrorMensaje($texto){
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->SetTitle("Constancia.pdf");
    $pdf->Cell(40,10,utf8_decode($texto));
    $pdf->Output();
}

if (isset($_SESSION['idPacientePDF'])&&isset($_SESSION['IMC'])&&isset($_SESSION['PESO'])) {
    $idPaciente=$_SESSION['idPacientePDF'];
    $imgIMC = $_SESSION['IMC'];
    $imgPESO = $_SESSION['PESO'];
    
    $paciente = new ModeloPaciente();
    $paciente->setIdPaciente($idPaciente);
    $hojaClinica = new ModeloHojaclinica();
    $hojaClinica->setIdHojaClinica($paciente->getIdHojaClinica());
    
    $responsable=$objSession->getNombre()." ".$objSession->getApellidos();
    $sucursal = new ModeloSucursal();
    $sucursal->setIdSucursal($objSession->getIdSucursal());
  
    class PDF extends FPDF{
        var $direccion;
        function PaginaUno($responsable,$sucursal,$dir,$cargo,$fecha){
            $this->SetFont('Arial','B',20);
            $this->Cell(190,27,'',1,0,'C',0);
            $this->Image('images/logo_siluetaExpress.png',15,13,45,null);//
            $this->SetFont('Arial','',16);
            $this->Ln(1);
            $this->direccion=$dir;
            //TItulo
            
            $this->Cell(185,15,'Seguimiento ',0,0,'R',0);
            $this->Ln(4);
            $this->SetFont('Arial','B',8);
            $this->Cell(185,18,'Fecha de registro: '.$fecha,0,0,'R',0);
            $this->Ln(6);
            $this->SetFont('Arial','',10);
            $this->Cell(185,18,$cargo.' '.utf8_decode($responsable),0,0,'R',0);
            $this->Ln(5);
            $this->SetFont('Arial','',8);
            $this->Cell(185,18,utf8_decode($sucursal),0,0,'R',0);
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
    
    $fecha = explode(" ",$paciente->getFechaRegistro());
    $fecha = explode("-", $fecha[0]);
    $fecha = $fecha[2]."/".$fecha[1]."/".$fecha[0];
    
    $pdf = new PDF();
    
    $pdf->AliasNbPages();
    //$pdf->AddPage();
    $pdf->AddPage();
    $pdf->SetTitle("Seguimiento_".utf8_decode($paciente->getNombre(). ' '.$paciente->getApellidos()).".pdf");
    $pdf->PaginaUno($responsable,$sucursal->getSucursal(),utf8_decode($sucursal->getDireccion()),$objSession->getAbrev(),$fecha);
    
    $pdf->SetFillColor(255,255,255);/// color blanco celda
    $pdf->Cell(160,8,' ','B',0,'L',0);
    $pdf->Ln(2);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(20,8,' Nombre: ',0,0,'L',1);
    $pdf->Cell(85,8,utf8_decode($paciente->getNombre(). ' '.$paciente->getApellidos()),0,0,'L');
    $pdf->Cell(13,8,' Edad: ',0,0,'L',1);
    $pdf->Cell(8,8,$paciente->getEdad(),0,0,'C',0);
    $pdf->Cell(20,8,' Estatura:',0,0,'L',1);
    $pdf->Cell(10,8,$hojaClinica->getEstatura(),0,0,'C',0);
    
    $pdf->Ln(12);
    
    $pdf->SetFont('Arial','B',13);
    $pdf->Cell(185,5,' Gráfica de control de peso ',0,0,'C');
    $pdf->Ln(4);
    $pdf->Image($imgPESO,10,60,35,null);//
    
    $pdf->Ln(47);
    
    $pdf->Cell(185,5,' Gráfica de IMC',0,0,'C');
    $pdf->Ln(4);
    $pdf->Image($imgIMC,10,110,35,null);//
    
    $pdf->Ln(47);
    
    $pdf->Cell(185,5,'Historial',0,0,'C');
    $pdf->Ln(5);
    
    $pdf->SetFillColor(194,246,199);///verde
    
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(30,5,' ',1,0,'C',1);
    $pdf->Cell(25,5,'Horario',1,0,'C',1);
    $pdf->Cell(130,5,'Alimentos',1,0,'C',1);
    
    $pdf->Output();
    
    
}
else{
    pdfErrorMensaje('No se especifico un id.');
}
?>