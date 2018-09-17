<?php

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------Archivos necesarios Require Include---------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
require_once LIB_FPDF;
require_once FOLDER_MODEL_EXTEND. "model.sucursal.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.hojaclinica.inc.php";
require_once FOLDER_MODEL_EXTEND. "model.paciente.inc.php";

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

if (isset($_GET['idPaciente']) && isset($_GET['firma'])) {
    $idPaciente=$_GET['idPaciente'];
    $firma=$_GET['firma'];
    $paciente = new ModeloPaciente();
    $paciente->setIdPaciente($idPaciente);
    $hojaClinica = new ModeloHojaclinica();
    $hojaClinica->setIdHojaClinica($paciente->getIdHojaClinica());
    
    $responsable=$objSession->getNombre()." ".$objSession->getApellidos();
    $sucursal = new ModeloSucursal();
    $sucursal->setIdSucursal($objSession->getIdSucursal());
    class PDF extends FPDF{
        var $direccion;
        function PaginaUno($responsable,$sucursal,$dir,$cargo){
            $this->SetFont('Arial','B',30);
            $this->Cell(190,27,'',1,0,'C',0);
            $this->Image('images/logo_siluetaExpress.png',15,13,45,null);//
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
    
    $arrOpciones=array("1"=>"Diario","2"=>"Casi diario","3"=>"Eventualmente");
    
    $pdf = new PDF();
    
    $pdf->AliasNbPages();
    //$pdf->AddPage();
    $pdf->AddPage();
    $pdf->SetTitle("hoja_clinica.pdf");
    $pdf->PaginaUno($responsable,$sucursal->getSucursal(),utf8_decode($sucursal->getDireccion()),$objSession->getAbrev());
    
    $pdf->SetFillColor(255,255,255);/// color blanco celda
    $pdf->Cell(190,8,' ','B',0,'L',0);
    $pdf->Ln(2);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(20,8,' Nombre: ',0,0,'L',1);
    $pdf->Cell(85,8,utf8_decode($paciente->getNombre(). ' '.$paciente->getApellidos()),0,0,'L');
    $pdf->Cell(13,8,' Edad: ',0,0,'L',1);
    $pdf->Cell(8,8,$paciente->getEdad(),0,0,'C',0);
    $pdf->Cell(14,8,' Sexo:',0,0,'L',1);
    $pdf->Cell(20,8,$paciente->getSexo(),0,0,'C',0);
    $pdf->Cell(10,8,' Cel:',0,0,'L',1);
    $pdf->Cell(25,8,$paciente->getTelefonoCel(),0,0,'C',0);
    
    $pdf->Ln(12);
    
    if ($paciente->getLlenado()=="Completo"){
        
    
    if ($hojaClinica->getCirugia()!="sinrespuesta"){
        $pdf->SetFont('Arial','U',11);
        $pdf->Cell(20,5,' Cirugías: ',0,0,'L');
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(15,5,$hojaClinica->getCirugia(),0,0,'L',0);
        
        if ($hojaClinica->getCirugia()=="Si"){
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(30,5,'las cuales son: ',0,0,'J');
            //$pdf->SetXY(80,65);
            $pdf->MultiCell(115,6,utf8_decode($hojaClinica->getCirugias()),0,'J',0);
            $pdf->Ln(5);
        }else
            $pdf->Ln(10);
    }
    if ($hojaClinica->getEnfermedades()!=""){
        $pdf->SetFont('Arial','U',11);
        $pdf->Cell(60,5,' Enfermedades que padece: ',0,0,'L');
        $pdf->SetFont('Arial','',11);
        $pdf->MultiCell(125,6,utf8_decode($hojaClinica->getEnfermedades()),0,'J',0);
        $pdf->Ln(5);
    }
    
    if ($hojaClinica->getEstrenimiento()!="sinrespuesta"){
        $pdf->SetFont('Arial','U',11);
        $pdf->Cell(35,5,' Estreñimiento: ',0,0,'L');
        
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(15,5,$hojaClinica->getEstrenimiento(),0,0,'L',0);
        
        if ($hojaClinica->getEstrenimiento()=="Si"){
            $pdf->SetFont('Arial','U',11);
            $pdf->Cell(25,5,'Frecuencia: ',0,0,'L');
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(55,6,$arrOpciones[$hojaClinica->getEstrenimientoFrecuencia()],0,0,'L',0);
            
        }
        $pdf->Ln(10);
    }
    if ($hojaClinica->getMenstruacion()!="sinrespuesta"){
        $pdf->SetFont('Arial','U',11);
        $pdf->Cell(40,5,' Periodo menstrual: ',0,0,'L');
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(15,5,$hojaClinica->getMenstruacion(),0,0,'L',0);
        $pdf->Ln(10);
    }
    if ($hojaClinica->getAlergia()!="sinrespuesta"){
        $pdf->SetFont('Arial','U',11);
        $pdf->Cell(50,5,' Alergia a algún alimento: ',0,0,'L');
        
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(15,5,$hojaClinica->getAlergia(),0,0,'L',0);
        
        if ($hojaClinica->getAlergia()=="Si"){
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(15,5,' como ',0,0,'L');
            //$pdf->SetFont('Arial','',12);
            //$pdf->Cell(30,5,'',0,0,'L');
            $pdf->MultiCell(115,6,utf8_decode($hojaClinica->getAlimento()),0,'J',0);
            $pdf->Ln(5);
        }else
            $pdf->Ln(10);
    }
    
    if ($hojaClinica->getHrsDormir()!=""){
        $pdf->SetFont('Arial','U',11);
        $pdf->Cell(42,5,' Horas que duerme: ',0,0,'L');
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(30,5,$hojaClinica->getHrsDormir(),0,0,'L');
    }
    
    if ($hojaClinica->getHrsComer()!=""){
        $pdf->SetFont('Arial','U',11);
        $pdf->Cell(40,5,' Comidas al día: ',0,0,'L');
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(30,5,$hojaClinica->getHrsComer(),0,0,'L');
    }
    
    if ($hojaClinica->getHrsDormir()!=""||$hojaClinica->getHrsComer()!=""){
        $pdf->Ln(10);
    }
    
    if ($hojaClinica->getDesagradables()!=""){
        $pdf->SetFont('Arial','U',11);
        $pdf->Cell(50,5,' Alimentos desagradables: ',0,0,'L');
        $pdf->SetFont('Arial','',11);
        $pdf->MultiCell(125,6,utf8_decode($hojaClinica->getDesagradables()),0,'J',0);
        $pdf->Ln(5);
    }
    
    if ($hojaClinica->getCafe()!="sinrespuesta"){
        $pdf->SetFont('Arial','U',11);
        $pdf->Cell(25,5,' Toma café: ',0,0,'L');
        
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(15,5,$hojaClinica->getCafe(),0,0,'L',0);
        
        if ($hojaClinica->getCafe()=="Si"){
            $pdf->SetFont('Arial','U',11);
            $pdf->Cell(25,5,'Frecuencia: ',0,0,'L');
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(40,6,$arrOpciones[$hojaClinica->getCafeFrecuencia()],0,0,'L',0);
            
        }
    }
    
    if ($hojaClinica->getFuma()!="sinrespuesta"){
        $pdf->SetFont('Arial','U',11);
        $pdf->Cell(15,5,' Fuma: ',0,0,'L');
        
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(15,5,$hojaClinica->getFuma(),0,0,'L',0);
        
        if ($hojaClinica->getFuma()=="Si"){
            $pdf->SetFont('Arial','U',11);
            $pdf->Cell(25,5,'Frecuencia: ',0,0,'L');
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(30,6,$arrOpciones[$hojaClinica->getFumaFrecuencia()],0,0,'L',0);
            
        }
    }
    
    if ($hojaClinica->getCafe()!="sinrespuesta"||$hojaClinica->getFuma()!="sinrespuesta"){
        $pdf->Ln(10);
    }
    
    if ($hojaClinica->getBeber()!="sinrespuesta"){
        $pdf->SetFont('Arial','U',11);
        $pdf->Cell(55,5,' Ingiere bebidas alcohólicas: ',0,0,'L');
        
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(15,5,$hojaClinica->getBeber(),0,0,'L',0);
        
        if ($hojaClinica->getBeber()=="Si"){
            $pdf->SetFont('Arial','U',11);
            $pdf->Cell(25,5,'Frecuencia: ',0,0,'L');
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(55,6,$arrOpciones[$hojaClinica->getBeberFrecuencia()],0,0,'L',0);
            
        }
        $pdf->Ln(10);
    }
    
    if ($hojaClinica->getActividadFisica()!="sinrespuesta"){
        $pdf->SetFont('Arial','U',11);
        $pdf->Cell(32,5,' Actividad física: ',0,0,'L');
        
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(4,5,$hojaClinica->getActividadFisica(),0,0,'L',0);
        
        if ($hojaClinica->getActividadFisica()=="Si"){
            if ($hojaClinica->getActividad()!=""){
                $pdf->Cell(70,5,', '.utf8_decode($hojaClinica->getActividad()),0,0,'L');
            }
            
            if ($hojaClinica->getTiempo()!="0"){
                $pdf->SetFont('Arial','U',11);
                $pdf->Cell(23,5,' Tiempo: ',0,0,'L');
                $pdf->SetFont('Arial','',11);
                $pdf->Cell(15,5,$hojaClinica->getTiempo().' '.$hojaClinica->getTiempoSimbolo(),0,0,'L');
            }
            
            if ($hojaClinica->getActividadFisicaFrecuencia()!="sinrespuesta"){
                $pdf->SetFont('Arial','U',11);
                $pdf->Cell(25,5,'Frecuencia: ',0,0,'L');
                $pdf->SetFont('Arial','',11);
                $pdf->Cell(30,5,$arrOpciones[$hojaClinica->getActividadFisicaFrecuencia()],0,0,'L');
            }
        }
        $pdf->Ln(10);
    }
    
    
    if ($hojaClinica->getMotivacion()!=""){
        $pdf->SetFont('Arial','U',11);
        $pdf->Cell(90,5,' Motivación para iniciar el plan nutricional: ',0,0,'L');
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(10,5,$hojaClinica->getMotivacion(),0,0,'L');
        $pdf->Ln(10);
    }
    
    if ($hojaClinica->getHorarioLevantarse()!="00:00 AM"){
        $pdf->SetFont('Arial','U',11);
        $pdf->Cell(45,5,' Horario de levantarse: ',0,0,'L');
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(20,5,$hojaClinica->getHorarioLevantarse(),0,0,'L');
    }
    
    if ($hojaClinica->getHorarioAcostarse()!="00:00 AM"){
        $pdf->SetFont('Arial','U',11);
        $pdf->Cell(42,5,' Horario de acostarse: ',0,0,'L');
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(20,5,$hojaClinica->getHorarioAcostarse(),0,0,'L');
    }
    
    if ($hojaClinica->getHorarioActividad()!="00:00 AM"){
        $pdf->SetFont('Arial','U',11);
        $pdf->Cell(41,5,'Horario de act. física: ',0,0,'L');
        $pdf->SetFont('Arial','',11);
        $pdf->Cell(20,5,$hojaClinica->getHorarioActividad(),0,0,'L');
    }
    
    if ($hojaClinica->getHorarioLevantarse()!="00:00 AM"||$hojaClinica->getHorarioAcostarse()!="00:00 AM"||$hojaClinica->getHorarioActividad()!="00:00 AM"){
        $pdf->Ln(10);
    }
    $pdf->Ln(3);
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell(185,7,' Recordatorio 24 hrs ',1,0,'C');
    $pdf->Ln(8);
    
    $pdf->SetFillColor(194,246,199);///verde
    
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(30,6,' ',1,0,'C',1);
    $pdf->Cell(25,6,'Horario',1,0,'C',1);
    $pdf->Cell(130,6,'Alimentos',1,0,'C',1);
    
    $pdf->Ln();
    $pdf->SetFillColor(255,255,255);/// color blanco celda
    $pdf->SetFont('Arial','',10);
    
    $pdf->Cell(30,7,'Desayuno',1,0,'C');
    $horario=$hojaClinica->getHorarioDesayuno();
    if ($horario=="00:00 AM"){
        $horario="-";
    }
    $pdf->Cell(25,7,$horario,1,0,'C');
    $alimento=$hojaClinica->getActividadDesayuno();
    if ($alimento==""){
        $alimento="-";
    }
    $pdf->MultiCell(130,7,utf8_decode($alimento),1,'J',1);
    
    $pdf->Cell(30,7,'Colación 1',1,0,'C');
    $horario=$hojaClinica->getHorarioColacion();
    if ($horario=="00:00 AM"){
        $horario="-";
    }
    $pdf->Cell(25,7,$horario,1,0,'C');
    $alimento=$hojaClinica->getActividadColacion();
    if ($alimento==""){
        $alimento="-";
    }
    $pdf->MultiCell(130,7,utf8_decode($alimento),1,'J',1);
    
    $pdf->Cell(30,7,'Comida',1,0,'C');
    $horario=$hojaClinica->getHorarioComida();
    if ($horario=="00:00 AM"){
        $horario="-";
    }
    $pdf->Cell(25,7,$horario,1,0,'C');
    $alimento=$hojaClinica->getActividadComida();
    if ($alimento==""){
        $alimento="-";
    }
    $pdf->MultiCell(130,7,utf8_decode($alimento),1,'J',1);
    
    $pdf->Cell(30,7,'Colación 2',1,0,'C');
    $horario=$hojaClinica->getHorarioColacion2();
    if ($horario=="00:00 AM"){
        $horario="-";
    }
    $pdf->Cell(25,7,$horario,1,0,'C');
    $alimento=$hojaClinica->getActividadColacion2();
    if ($alimento==""){
        $alimento="-";
    }
    $pdf->MultiCell(130,7,utf8_decode($alimento),1,'J',1);
    
    $pdf->Cell(30,7,'Cena',1,0,'C');
    $horario=$hojaClinica->getHorarioCena();
    if ($horario=="00:00 AM"){
        $horario="-";
    }
    $pdf->Cell(25,7,$horario,1,0,'C');
    $alimento=$hojaClinica->getActividadCena();
    if ($alimento==""){
        $alimento="-";
    }
    $pdf->MultiCell(130,7,utf8_decode($alimento),1,'J',1);
    
    }
    
    if ($firma=='Si'){
    $pdf->SetFont('Arial','',9);
    $pdf->Ln(5);
    $pdf->SetX(120);
    $pdf->Cell(60,8,' ','B',0,'L',0);
    $pdf->Ln();
    $pdf->SetX(120);
    $pdf->Cell(60,8,'FIRMA DEL PACIENTE',0,0,'C');
 
    
    $pdf->SetFont('Arial','',8);
    $pdf->Ln(8);
    $pdf->SetX(90);
    $pdf->Cell(130,5,'Acepto que la información en este expediente es VERÁS y PRESENTE',0,0,'L');
    $pdf->Ln();
    $pdf->SetX(90);
    $pdf->Cell(130,5,'Acepto que Silueta Express comparta mis logros en redes sociales',0,0,'L');
    }
    /*
     $pdf->Cell(30,8,'',1,0,'C');
    $horario=$hojaClinica->getHorario;
    if ($horario==""){
        $horario="-";
    }
    $pdf->Cell(25,8,$horario,1,0,'C');
    $alimento=$hojaClinica->getActividad;
    if ($alimento==""){
        $alimento="-";
    }
    $pdf->Cell(130,8,$alimento,1,'J',1);
    $pdf->Ln();
     * 
    if ($hojaClinica->get!="sinrespuesta"){
        $pdf->SetFont('Arial','U',12);
        $pdf->Cell(20,5,' : ',0,0,'L');
        
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(15,5,$hojaClinica->get,0,0,'L',0);
        
        if ($hojaClinica->get=="Si"){
            $pdf->SetFont('Arial','',12);
            $pdf->Cell(30,5,'',0,0,'L');
            //$pdf->SetFont('Arial','',12);
             //$pdf->Cell(30,5,'',0,0,'L');
            $pdf->MultiCell(115,6,$hojaClinica->get(),0,'J',0);
        $pdf->Ln(5);
        }else 
            $pdf->Ln(10);
    }
    */
    
    
    $pdf->Output();
    
    
}
else{
    pdfErrorMensaje('No se especifico un id.');
}

// -----------------------------------------------------------------------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// ---------------------------------------------------Seccion AJAX--------------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#

// -----------------------------------------------------------------------------------------------------------------#
// -------------------------------------------Inicializacion de variables-------------------------------------------#
// -----------------------------------------------------------------------------------------------------------------#
?>