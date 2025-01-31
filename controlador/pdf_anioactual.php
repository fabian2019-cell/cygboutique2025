<?php
require_once("../vista/fpdf/fpdf.php");
require_once("DAOVentaproducto.php");
require_once("DAOProducto.php");

class PDF extends FPDF
{
// Cabecera de página
     function Header()
         {
           $this->Image('../vista/dist/img/logCGn.png', 10, 10, 20, 20);
           //$this->Image('../vista/dist/img/logo_elcarmen.jpg', 130, 10, 15, 15);
          // $this->Image('../vista/dist/img/logo_elcarmen.jpg', 250, 10, 20, 20);
           $this->SetFont('Arial','B',10);
           $this->SetXY(110,15);
           $this->Cell(70,10,utf8_decode('CG BOUTIQUE'),0,0,'C');
           $this->Ln();
           $this->SetXY(110,20);
           $this->Cell(70,10,utf8_decode('Moda, calidad y estilo.'),0,0,'C');
           $this->Ln();
           $this->SetLineWidth(0.5);
           $this->SetDrawColor(0,0,139);
           $this->Line(10, 32, 270, 32);
           $this->SetLineWidth(0.2);
           $this->Line(10, 33, 270, 33);
           $this->SetXY(110,34);
           $this->Cell(70,10,utf8_decode('Reporte de Ventas del año actual.'),0,0,'C');
           $this->Ln();

           $this->SetDrawColor(0,0,0);
           $this->SetFont('Arial','B',9);
           $this->Cell(30,10,utf8_decode('Cód. Venta'),1,0,'C',0);
            $this->Cell(40,10,'Cod. Producto',1,0,'C',0);
            $this->Cell(35,10,'Nombre',1,0,'C',0);
            $this->Cell(20,10,'Marca',1,0,'C',0);
            $this->Cell(25,10,'Color',1,0,'C',0);
            $this->Cell(20,10,'Talla',1,0,'C',0);
            $this->Cell(30,10,'Precio',1,0,'C',0);
            $this->Cell(30,10,'Descuento',1,0,'C',0);
            $this->Cell(32,10,'Subtotal',1,1,'C',0);
         }
                       
      // Pie de página
     function Footer()
         {
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
 $this->Cell(0,10,'Pag '.$this->PageNo().'/{nb}'.'    Fecha '.date('d/m/Y'),0,0,'C');         }
}

// Creación del objeto de la clase heredada
//$pdf = new PDF();
$pdf=new PDF('L','mm','letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',9);

        
     $daoVP=new DAOVentaproducto();
     $daoP=new DAOProducto();
     $fila=$daoVP->consultaVentas_esteanio();
     $objP=null;
     $acum=0;
     foreach ($fila as $key=> $value) {
    $pdf->Cell(30,10,''.$value->getId_venta(),1,0,'C',0);
    $objP=$daoP->consultaIndividual($value->getId_producto());
    $pdf->Cell(40,10,''.utf8_decode($objP->getCodigo()),1,0,'C',0);
    $pdf->Cell(35,10,''.utf8_decode($objP->getNombre()),1,0,'C',0);
    $pdf->Cell(20,10,''.utf8_decode($objP->getMarca()),1,0,'C',0);
    $pdf->Cell(25,10,''.utf8_decode($objP->getColor()),1,0,'C',0);
    $pdf->Cell(20,10,''.utf8_decode($objP->getTallas()),1,0,'C',0);
    $pdf->Cell(30,10,'$'.number_format($value->getPrecio_venta(),2),1,0,'C',0);
    if($value->getCantidad_des()>0){
    $pdf->SetTextColor(255,0,0);
}
    $pdf->Cell(30,10,'$'.number_format($value->getCantidad_des(),2),1,0,'C',0);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(32,10,''.$value->getSubtotal(),1,1,'C',0);
   // $pdf->Cell(30,10,''.utf8_decode($value->getResponsable()),1,0,'C',0);
   # $pdf->MultiCell(30,10,utf8_decode($value->getUnidad()),1,1,'FJ',1);
    $acum+=$value->getSubtotal();
   
}
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(480,10,'TOTAL $ '.number_format($acum,2),0,0,'C');
 $pdf->Output();
?>