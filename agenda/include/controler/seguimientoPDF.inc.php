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
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(20,8,' Nombre: ',0,0,'L',1);
    $pdf->Cell(85,8,utf8_decode($paciente->getNombre(). ' '.$paciente->getApellidos()),0,0,'L');
    $pdf->Cell(13,8,' Edad: ',0,0,'L',1);
    $pdf->Cell(8,8,$paciente->getEdad(),0,0,'C',0);
    $pdf->Cell(20,8,' Estatura:',0,0,'L',1);
    $pdf->Cell(10,8,$hojaClinica->getEstatura(),0,0,'C',0);
    
    $pdf->Ln(12);
    
    $seg = new ModeloHojaseguimiento();
    $informacion=$seg->getSeguimientos($idPaciente);
    $largo=0;
    $tam=18;
    if (count($informacion['info'])>2)
        $largo=(count($informacion['info'])-2)*5;
    if (isset($_SESSION['segDetalles'])&&$_SESSION['segDetalles']=='si')
        $tam=14;
    
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(185,5,' Gráfica de control de peso ',0,0,'C');
    $pdf->Ln(4);
    $pdf->Image($imgPESO,10,60,30+$largo,null);//
    
    $pdf->Ln(47);
    
    $pdf->Cell(185,5,' Gráfica de IMC ',0,0,'C');
    $pdf->Ln(4);
    $pdf->Image($imgIMC,10,110,30+$largo,null);//
    
    $pdf->Ln(47);
    
    $pdf->Cell(185,5,'Historial',0,0,'C');
    $pdf->Ln(5);
    
    $pdf->SetFillColor(242,250,198);///verde
    
    $pdf->SetFont('Arial','',9);
    $pdf->Cell($tam,5,'Fecha',1,0,'C',1);
    $pdf->Cell($tam,5,'Peso',1,0,'C',1);
    $pdf->Cell($tam,5,'IMC',1,0,'C',1);
    $pdf->Cell($tam,5,'Pecho',1,0,'C',1);
    $pdf->Cell($tam,5,'Talle',1,0,'C',1);
    $pdf->Cell($tam,5,'Cintura',1,0,'C',1);
    $pdf->Cell($tam,5,'Abdomen',1,0,'C',1);
    $pdf->Cell($tam,5,'Cadera',1,0,'C',1);
    if (isset($_SESSION['segDetalles'])&&$_SESSION['segDetalles']=='si'){
        $pdf->Cell(40,5,'Dieta',1,0,'C',1);
        $pdf->Cell(40,5,'Tratamiento',1,0,'C',1);
    }else {
        $pdf->Cell($tam,5,'Brazo Der',1,0,'C',1);
        $pdf->Cell($tam,5,'Brazo Izq',1,0,'C',1);
    }
    $pdf->Ln();
    $pdf->SetFillColor(255,255,255);/// color blanco celda
    foreach ($informacion['info'] as $id => $info){
        $pdf->SetFont('Arial','',7);
        $pdf->Cell($tam,5,$info['fecha'],1,0,'C',1);
        $pdf->SetFont('Arial','',9);
        $pdf->Cell($tam,5,$info['pesoKg'],1,0,'C',1);
        $pdf->Cell($tam,5,$info['IMC'],1,0,'C',1);
        $pdf->Cell($tam,5,$info['pecho'],1,0,'C',1);
        $pdf->Cell($tam,5,$info['talla'],1,0,'C',1);
        $pdf->Cell($tam,5,$info['cintura'],1,0,'C',1);
        $pdf->Cell($tam,5,$info['abdomen'],1,0,'C',1);
        $pdf->Cell($tam,5,$info['cadera'],1,0,'C',1);
        if (isset($_SESSION['segDetalles'])&&$_SESSION['segDetalles']=='si'){
            $pdf->SetFont('Arial','',6);
            $pdf->Cell(40,5,utf8_decode($info['dieta']),1,0,'C',1);
            $pdf->Cell(40,5,utf8_decode($info['tratamiento']),1,0,'C',1);
        }else {
            $pdf->Cell($tam,5,$info['brazoDer'],1,0,'C',1);
            $pdf->Cell($tam,5,$info['brazoIzq'],1,0,'C',1);
            
        }
        $pdf->Ln();
    }
    
    if (isset($_SESSION['segDetalles'])&&$_SESSION['segDetalles']=='si'){
/*        $pdf->Ln(2);
        
        
        $pdf->SetFillColor(242,250,198);///verde
        
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(25,5,'Fecha',1,0,'C',1);
        $pdf->Cell(80,5,'Dieta',1,0,'C',1);
        $pdf->Cell(80,5,'Tratamiento',1,0,'C',1);
        $pdf->Ln();
        $pdf->SetFillColor(255,255,255);/// color blanco celda
        $pdf->SetFont('Arial','',10);
        foreach ($informacion['info'] as $id => $info){
            $pdf->Cell(25,5,$info['fecha'],1,0,'C',1);
            $pdf->Cell(80,5,utf8_decode($info['dieta']),1,0,'C',1);
            $pdf->Cell(80,5,utf8_decode($info['tratamiento']),1,0,'C',1);
            $pdf->Ln();
        }
  */      
    }
    $pdf->Output();
    
    
}
else{
    pdfErrorMensaje('No se especifico un id.');
}
?>