<?php
require_once("fpdf.php");
require_once("../../controlador/DAODepreciacion.php");

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../../vista/dist/img/logo_elcarmen.jpg',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'Reporte de Bienes Muebles por Unidad',5,0,'C');
    // Salto de línea
    $this->Ln(30);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);


     $daoE=new DAODepreciacion();
     $fila=$daoE->consultaDepreciacion();
     foreach ($fila as $key=> $value) {
    $pdf->Cell(0,10,''.$value->getId_depreciacion(),0,1);
   
}
 $pdf->Output();
?>