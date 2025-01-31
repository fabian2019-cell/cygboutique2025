<?php
 if (isset($_REQUEST['id'])) {/* comprobamos si la variable que viene en la url si existe */
        # code...
        $id=$_REQUEST['id'];
        /*value="<?php echo $idespecifico = ($idespecifico=='') ? '' : $idespecifico ; ?>" para los inputs*/
    }
require_once("../vista/fpdf/fpdf.php");
require_once("DAOVenta.php");
require_once("DAOVentaproducto.php");
require_once("DAOProducto.php");
require_once("DAOEmpleado.php");
require_once("DAOCliente.php");

class PDF extends FPDF
{
// Cabecera de página
     function Header()
         {
           $this->Image('../vista/dist/img/logCGn.png', 10, 10, 20, 20);
           //$this->Image('../vista/dist/img/logo_elcarmen.jpg', 130, 10, 15, 15);
          // $this->Image('../vista/dist/img/logo_elcarmen.jpg', 250, 10, 20, 20);
           $this->SetFont('Arial','B',10);
           $this->SetXY(20,15);
           $this->Cell(70,10,utf8_decode('CG BOUTIQUE      [Moda, calidad y estilo.]'),0,0,'L');
           $this->Ln();
           $this->SetXY(20,20);
           $this->Cell(70,10,utf8_decode('Fecha/Hora: '),0,0,'L');
           $this->Ln();
           $this->SetXY(20,25);
           $this->Cell(70,10,utf8_decode('Colaborador: '),0,0,'L');
           $this->Ln();
           $this->SetXY(20,30);
           $this->Cell(70,10,utf8_decode('Cliente: '),0,0,'L');

           $this->Ln();
           $this->SetDrawColor(0,0,139);
           $this->SetLineWidth(0.2);
           $this->Line(10, 40, 210, 40);
           
           
           $this->Ln();

           $this->SetDrawColor(0,0,0);
           $this->SetFont('Arial','B',9);
            $this->Cell(20,10,'Cant.',1,0,'C',0);
            $this->Cell(20,10,'IDP.',1,0,'C',0);
            $this->Cell(85,10,utf8_decode('Descripción'),1,0,'C',0);
            $this->Cell(25,10,'Precio',1,0,'C',0);
            $this->Cell(25,10,'Descuento',1,0,'C',0);
            $this->Cell(20,10,'Subtotal',1,0,'C',0);
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
$pdf->AddPage('portrait','LETTER');
//$pdf->SetFont('Times','',9);

        
     $daoVP=new DAOVentaproducto();
     $daoP=new DAOProducto();
     $daoV=new DAOVenta();
     $daoE=new DaoEmpleado();
     $daoC=new DaoCliente();
     $fila=$daoVP->consultaVentasprod($id);
     $ObjV=null;
     $ObjE=null;
     $ObjC=null;
     
     $ObjV=$daoV->consultaIndividualVenta($id);
     $ObjE=$daoE->consultaIndividualEmpleado($ObjV->getEmpleado());
     $ObjC=$daoC->consultaIndividualCliente2($ObjV->getCliente());
     $objP=null;


     $acum=0;
     $descu=0;
     $pdf->SetFont('Arial','B',10);
     $pdf->SetXY(50,20);
     $pdf->Cell(70,10,utf8_decode(''.$ObjV->getFecha_venta()),0,0,'L');
     $pdf->SetXY(50,20);
     $pdf->Cell(70,20,utf8_decode(''.$ObjE->getNombres().' '.$ObjE->getApellidos()),0,0,'L');
     $pdf->SetXY(50,25);
     $pdf->Cell(70,20,utf8_decode(''.$ObjC->getNombres().' '.$ObjC->getApellidos()),0,0,'L');
     $pdf->Ln();
     $pdf->Ln();
    $pdf->SetFont('Times','',9);
    $pdf->SetXY(10,60);
     foreach ($fila as $key=> $value) {
        $pdf->Cell(20,10,'1',1,0,'C',0);
        $pdf->Cell(20,10,''.$value->getId_producto(),1,0,'C',0);
        $objP=$daoP->consultaIndividual($value->getId_producto());
        $pdf->Cell(85,10,utf8_decode(''.$objP->getNombre().' '.$objP->getMarca().' '.$objP->getColor().' '.$objP->getTallas()),1,0,'L',0);
        $pdf->Cell(25,10,'$'.number_format($value->getPrecio_venta(),2),1,0,'C',0);
        if($value->getCantidad_des()>0){
            $pdf->SetTextColor(255,0,0);
            $descu+=$value->getCantidad_des();
        }

        $pdf->Cell(25,10,'$'.number_format($value->getCantidad_des(),2),1,0,'C',0);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(20,10,''.$value->getSubtotal(),1,1,'C',0);
   // $pdf->Cell(30,10,''.utf8_decode($value->getResponsable()),1,0,'C',0);
   # $pdf->MultiCell(30,10,utf8_decode($value->getUnidad()),1,1,'FJ',1);
        $acum+=$value->getSubtotal();

    }
    $pdf->SetFont('Arial','B',10);
    if($descu>0){
        $pdf->SetTextColor(255,0,0);
    }

    $pdf->Cell(350,10,'T.DES $ '.number_format($descu,2),0,0,'C');
    $pdf->SetTextColor(0,0,0);
    $pdf->Ln();
    $pdf->Cell(350,10,'TOTAL $ '.number_format($acum,2),0,0,'C');
    $pdf->Output();
?>