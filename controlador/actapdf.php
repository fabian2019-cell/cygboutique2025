<?php
require_once("../vista/fpdf/fpdf.php");
require_once("DAOTipoBien.php");
date_default_timezone_set("America/El_Salvador");
setlocale(LC_ALL, 'spanish');



    if (isset($_REQUEST['id'])) {/* comprobamos si la variable que viene en la url si existe */
        # code...
        require ("DAOAnexo.php");
        require ("DAOContrayente.php");
        require ("DAOTestigo.php");
        $daoA=new DAOAnexo();
        $daoC=new DAOContrayente();
        $daoT=new DAOTestigo();
        $id=base64_decode($_REQUEST['id']);
        $objA=null;
        $objC1=null;
        $objC2=null;
        $objT1=null;
        $objT2=null;
        $objA=$daoA->consultaIndividualporDui($id);
        $objC1=$daoC->consultaIndividualContrayente($objA->getContrayente1());
        $objC2=$daoC->consultaIndividualContrayente($objA->getContrayente2());
        $objT1=$daoT->consultaIndividualTestigo($objA->getTestigo1());
        $objT2=$daoT->consultaIndividualTestigo($objA->getTestigo2());

        //$DateTime1 = DateTime::createFromFormat('Y-m-d', $objA->getFecha_matrimonio());
        //$horas = $DateTime1->format('Y');



        /*value="<?php echo $idespecifico = ($idespecifico=='') ? '' : $idespecifico ; ?>" para los inputs*/
    }


class PDF extends FPDF
{
// Cabecera de página
     function Header()
         {
           $this->Image('../vista/dist/img/logo_sv.jpeg', 10, 10, 20, 20);
           //$this->Image('../vista/dist/img/logo_elcarmen.jpg', 130, 10, 15, 15);
           $this->Image('../vista/dist/img/logo_elcarmen.jpg', 180, 10, 20, 20);
           $this->SetFont('Arial','B',10);
           $this->SetXY(70,15);
           $this->Cell(70,10,utf8_decode('ALCALDIA MUNICIPAL DE VILLA EL CARMEN'),0,0,'C');
           $this->Ln();
           $this->SetXY(70,20);
           $this->Cell(70,10,utf8_decode('DEPARTAMENTO DE CUSCATLAN'),0,0,'C');
           $this->Ln();
           $this->SetLineWidth(0.5);
           $this->SetDrawColor(0,0,139);
           $this->Line(10, 32, 200, 32);
           $this->SetLineWidth(0.2);
           $this->Line(10, 33, 200, 33);
           $this->SetXY(70,34);
           $this->Cell(70,10,utf8_decode('ACTA MATRIMONIAL'),0,0,'C');
           $this->Ln();
           $this->SetXY(70,39);
           //$this->Cell(70,10,utf8_decode('AÑO'),0,0,'C');
           $this->Cell(70,10,utf8_decode('AÑO ').date('Y'),0,1,'C');
           $this->Ln();



      /*     $this->SetDrawColor(0,0,0);
           $this->SetFont('Arial','B',9);
           $this->Cell(30,10,utf8_decode('Código'),1,0,'C',0);
            $this->Cell(25,10,'Articulo',1,0,'C',0);
            $this->Cell(25,10,'Modelo',1,0,'C',0);
            $this->Cell(25,10,'Marca',1,0,'C',0);
            $this->Cell(20,10,'Costo',1,0,'C',0);
            $this->Cell(25,10,'Fecha Adq',1,0,'C',0);
            $this->Cell(30,10,'Responsable',1,0,'C',0);
            $this->Cell(30,10,'Unidad',1,0,'C',0);
            $this->Cell(50,10,'Proveedor',1,1,'C',0);
            */
         }
                       
      // Pie de página
     function Footer()
         {
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
// $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}'.'  Fecha '.date('d/m/Y'),0,0,'C');         }
           $this->Cell(0,10,' Fecha '.date('d/m/Y'),0,0,'C'); 
       }
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
//$pdf=new PDF('L','mm','letter');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',10);

//$DateTime1 = DateTime::createFromFormat('Y-m-d', $objA->getFecha_matrimonio());
        //$horas = $DateTime1->format('Y');

//$pdf->SetFont('Arial','',10);
$pdf->SetDrawColor(255,255,255);
$pdf->SetFillColor(255,255,255);

$pdf->SetXY(149,34);
$pdf->Cell(70,10,utf8_decode('FOLIO N° '.$objA->getN_Folio()),0,0,'C');

$texto='ACTA NÚMERO '.convertir($objA->getN_Acta()).'- En la alcaldia Municipal de El Carmen, Departamento de Cuscatlán alas '.strtolower(convertir(intval(date_format(date_create($objA->getFecha_matrimonio()),'H')))).' horas del dia '.strtolower(convertir(intval(date_format(date_create($objA->getFecha_matrimonio()),'d')))).' de '.nameMonth(''.date_format(date_create($objA->getFecha_matrimonio()),'F')).' de '.strtolower(convertir(intval(date_format(date_create($objA->getFecha_matrimonio()),'Y')))).' siendo este lugar, hora y fecha, señalada para poder proceder a la celebración del Matrimonio Civil entre los señores: '.$objC1->getNombres().' '.$objC1->getApellidos().' Y '.$objC2->getNombres().' '.$objC2->getApellidos().'. EL PRIMERO: '.$objC1->getEstado_civil().', de '.strtolower(convertir(intval($objC1->getEdad()))).' años de edad, '.$objC1->getOficio_Ocupacion().' ,quien nacio el dia '.strtolower(convertir(intval(date_format(date_create($objC1->getFecha_nacimiento()),'d')))).' de '.nameMonth(''.date_format(date_create($objC1->getFecha_nacimiento()),'F')).' de '.strtolower(convertir(intval(date_format(date_create($objC1->getFecha_nacimiento()),'Y')))).' de origen '.$objC1->getOrigen().' y domicilio '.$objC1->getDomicilio().', de nacionalidad '.$objC1->getNacionalidad().' portador del documento Único de Identidad número '.$objC1->getDui_contrayente().', siendo hijo de '.$objC1->getPadre().' Y '.$objC1->getMadre().', residentes de '.$objC1->getResidencia_padres().'. Y LA SEGUNDA: '.$objC2->getEstado_civil().', de '.strtolower(convertir(intval($objC2->getEdad()))).' años de edad, '.$objC2->getOficio_Ocupacion().' , quien nacio el dia '.strtolower(convertir(intval(date_format(date_create($objC2->getFecha_nacimiento()),'d')))).' de '.nameMonth(''.date_format(date_create($objC2->getFecha_nacimiento()),'F')).' de '.strtolower(convertir(intval(date_format(date_create($objC2->getFecha_nacimiento()),'Y')))).' de origen '.$objC2->getOrigen().' y domicilio '.$objC2->getDomicilio().', de nacionalidad '.$objC2->getNacionalidad().' portadora del documento Único de Identidad número '.$objC2->getDui_contrayente().', siendo hija de '.$objC2->getPadre().' Y '.$objC2->getMadre().', residentes de '.$objC2->getResidencia_padres().'. Estando presentes los contrayentes, La secretaria Municipal de Actuaciones y Testigos hábiles: '.$objT1->getNombrest().' '.$objT1->getApellidost().' de '.strtolower(convertir(intval($objT1->getEdad()))).' años de edad, '.$objT1->getOficio().', de origen '.$objT1->getOrigen().' y domicilio '.$objT1->getDomicilio().', de Nacionalidad '.$objT1->getNacionalidad().', portador de su Documento Único de Identidad número '.$objT1->getDui_testigo().', y '.$objT2->getNombrest().' '.$objT2->getApellidost().' de '.strtolower(convertir(intval($objT2->getEdad()))).' años de edad, '.$objT2->getOficio().', de origen '.$objT2->getOrigen().' y domicilio '.$objT2->getDomicilio().', de Nacionalidad '.$objT2->getNacionalidad().', portador de su Documento Único de Identidad número '.$objT2->getDui_testigo().'. EL infranscrito Alcalde Municipal, Señor '.$objA->getNombre_alcalde().', indicó el objetivo de la reunión, cumpliendo con las formalidades de Ley en la celebración de este Matrimonio enseguida, la secretaria Municipal Sra. '.$objA->getNombre_secretario().', le dio lectura a los articulos once, doce, catorce, quince, dieciséis, diecisiete, treinta y seis, y treinta y nueve. todos del Código de Familia. -A continuación se interrogó a cada uno de los Contrayentes del modo que sigue: '.$objC1->getNombres().' '.$objC1->getApellidos().', quieres unirte en matrimonio con '.$objC2->getNombres().' '.$objC2->getApellidos().', y este contesto "SI QUIERO"; '.$objC2->getNombres().' '.$objC2->getApellidos().', quieres unirte en matrimonio con '.$objC1->getNombres().' '.$objC1->getApellidos().' y esta contestó "SI QUIERO", por lo que el referido funcionario les dirigio las siguientes palabras "EN NOMBRE DE LA REPUBLICA QUEDAN UNIDOS SOLEMNEMENTE EN MATRIMONIO Y ESTAN OBLIGADOS A GUARDARSE FIDELIDAD Y ASISTIRSE MUTUAMENTE EN TODAS LAS CIRCUNSTANCIAS DE LA VIDA." De conformidad a lo prescrito en el Articulo veintiuno de la Ley del Nombre de la Persona natural, la contrayente utilizará a continuación de su primer apellido del cónyugue precedido de la particula "'.$objA->getParticula().'", y manifiestan que optan por el Régimen Patrimonial de '.$objA->getRegimen().' Y no habiendo más que hacer constar damos por terminado acto y acta que firmamos.';
// Print 2 Cells
$pdf->SetXY(10,46);
$pdf->MultiCell(190,7,utf8_decode($texto),1,1,'FJ',1);
$pdf->Ln();

$pdf->SetFont('Times','',11);
$pdf->SetXY(10,233);
$pdf->Cell(0,10,utf8_decode(''.$objA->getNombre_alcalde()),0,0,'C'); 
$pdf->SetFont('Times','',10);
$pdf->SetXY(10,237);
$pdf->Cell(0,10,utf8_decode('Alcalde Municipal'),0,0,'C'); 

$pdf->SetFont('Times','',11);
$pdf->SetXY(10,245);
$pdf->Cell(0,10,utf8_decode(''.$objC1->getNombres().' '.$objC1->getApellidos()),0,0,'L');
$pdf->SetFont('Times','',10);
$pdf->SetXY(10,249);
$pdf->Cell(0,10,utf8_decode('Contrayente'),0,0,'L'); 

$pdf->SetFont('Times','',11);
$pdf->SetXY(10,245);
$pdf->Cell(0,10,utf8_decode(''.$objC2->getNombres().' '.$objC2->getApellidos()),0,0,'R');
$pdf->SetFont('Times','',10);
$pdf->SetXY(10,249);
$pdf->Cell(0,10,utf8_decode('Contrayente'),0,0,'R'); 

$pdf->SetFont('Times','',11);
$pdf->SetXY(10,262);
$pdf->Cell(0,10,utf8_decode(''.$objT1->getNombrest().' '.$objT1->getApellidost()),0,0,'L');
$pdf->SetFont('Times','',10);
$pdf->SetXY(10,266);
$pdf->Cell(0,10,utf8_decode('Testigo'),0,0,'L'); 

$pdf->SetFont('Times','',11);
$pdf->SetXY(10,262);
$pdf->Cell(0,10,utf8_decode(''.$objT2->getNombrest().' '.$objT2->getApellidost()),0,0,'R');
$pdf->SetFont('Times','',10);
$pdf->SetXY(10,266);
$pdf->Cell(0,10,utf8_decode('Testigo'),0,0,'R'); 

$pdf->Output();

/*
     $daoE=new DAOTipoBien();
     $fila=$daoE->consultaBMR();
     foreach ($fila as $key=> $value) {
    $pdf->Cell(30,10,''.$value->getCodigo(),1,0,'C',0);
    $pdf->Cell(25,10,''.$value->getArticulo(),1,0,'C',0);
    $pdf->Cell(25,10,''.$value->getModelo(),1,0,'C',0);
    $pdf->Cell(25,10,''.$value->getMarca(),1,0,'C',0);
    $pdf->Cell(20,10,'$'.$value->getCosto(),1,0,'C',0);
    $pdf->Cell(25,10,''.$value->getFecha_aquisicion(),1,0,'C',0);
    $pdf->Cell(30,10,''.$value->getResponsable(),1,0,'C',0);
    $pdf->Cell(30,10,''.$value->getUnidad(),1,0,'C',0);
    $pdf->Cell(50,10,''.$value->getProveedor(),1,1,'C',0);
   
}*/

function unidad($numuero){
    switch ($numuero)
    {
        case 9:
        {
            $numu = "NUEVE";
            break;
        }
        case 8:
        {
            $numu = "OCHO";
            break;
        }
        case 7:
        {
            $numu = "SIETE";
            break;
        }
        case 6:
        {
            $numu = "SEIS";
            break;
        }
        case 5:
        {
            $numu = "CINCO";
            break;
        }
        case 4:
        {
            $numu = "CUATRO";
            break;
        }
        case 3:
        {
            $numu = "TRES";
            break;
        }
        case 2:
        {
            $numu = "DOS";
            break;
        }
        case 1:
        {
            $numu = "UNO";
            break;
        }
        case 0:
        {
            $numu = "";
            break;
        }
    }
    return $numu;
}
 
function decena($numdero){
 
        if ($numdero >= 90 && $numdero <= 99)
        {
            $numd = "NOVENTA ";
            if ($numdero > 90)
                $numd = $numd."Y ".(unidad($numdero - 90));
        }
        else if ($numdero >= 80 && $numdero <= 89)
        {
            $numd = "OCHENTA ";
            if ($numdero > 80)
                $numd = $numd."Y ".(unidad($numdero - 80));
        }
        else if ($numdero >= 70 && $numdero <= 79)
        {
            $numd = "SETENTA ";
            if ($numdero > 70)
                $numd = $numd."Y ".(unidad($numdero - 70));
        }
        else if ($numdero >= 60 && $numdero <= 69)
        {
            $numd = "SESENTA ";
            if ($numdero > 60)
                $numd = $numd."Y ".(unidad($numdero - 60));
        }
        else if ($numdero >= 50 && $numdero <= 59)
        {
            $numd = "CINCUENTA ";
            if ($numdero > 50)
                $numd = $numd."Y ".(unidad($numdero - 50));
        }
        else if ($numdero >= 40 && $numdero <= 49)
        {
            $numd = "CUARENTA ";
            if ($numdero > 40)
                $numd = $numd."Y ".(unidad($numdero - 40));
        }
        else if ($numdero >= 30 && $numdero <= 39)
        {
            $numd = "TREINTA ";
            if ($numdero > 30)
                $numd = $numd."Y ".(unidad($numdero - 30));
        }
        else if ($numdero >= 20 && $numdero <= 29)
        {
            if ($numdero == 20)
                $numd = "VEINTE ";
            else
                $numd = "VEINTI".(unidad($numdero - 20));
        }
        else if ($numdero >= 10 && $numdero <= 19)
        {
            switch ($numdero){
            case 10:
            {
                $numd = "DIEZ ";
                break;
            }
            case 11:
            {
                $numd = "ONCE ";
                break;
            }
            case 12:
            {
                $numd = "DOCE ";
                break;
            }
            case 13:
            {
                $numd = "TRECE ";
                break;
            }
            case 14:
            {
                $numd = "CATORCE ";
                break;
            }
            case 15:
            {
                $numd = "QUINCE ";
                break;
            }
            case 16:
            {
                $numd = "DIECISEIS ";
                break;
            }
            case 17:
            {
                $numd = "DIECISIETE ";
                break;
            }
            case 18:
            {
                $numd = "DIECIOCHO ";
                break;
            }
            case 19:
            {
                $numd = "DIECINUEVE ";
                break;
            }
            }
        }
        else
            $numd = unidad($numdero);
    return $numd;
}
 
    function centena($numc){
        if ($numc >= 100)
        {
            if ($numc >= 900 && $numc <= 999)
            {
                $numce = "NOVECIENTOS ";
                if ($numc > 900)
                    $numce = $numce.(decena($numc - 900));
            }
            else if ($numc >= 800 && $numc <= 899)
            {
                $numce = "OCHOCIENTOS ";
                if ($numc > 800)
                    $numce = $numce.(decena($numc - 800));
            }
            else if ($numc >= 700 && $numc <= 799)
            {
                $numce = "SETECIENTOS ";
                if ($numc > 700)
                    $numce = $numce.(decena($numc - 700));
            }
            else if ($numc >= 600 && $numc <= 699)
            {
                $numce = "SEISCIENTOS ";
                if ($numc > 600)
                    $numce = $numce.(decena($numc - 600));
            }
            else if ($numc >= 500 && $numc <= 599)
            {
                $numce = "QUINIENTOS ";
                if ($numc > 500)
                    $numce = $numce.(decena($numc - 500));
            }
            else if ($numc >= 400 && $numc <= 499)
            {
                $numce = "CUATROCIENTOS ";
                if ($numc > 400)
                    $numce = $numce.(decena($numc - 400));
            }
            else if ($numc >= 300 && $numc <= 399)
            {
                $numce = "TRESCIENTOS ";
                if ($numc > 300)
                    $numce = $numce.(decena($numc - 300));
            }
            else if ($numc >= 200 && $numc <= 299)
            {
                $numce = "DOSCIENTOS ";
                if ($numc > 200)
                    $numce = $numce.(decena($numc - 200));
            }
            else if ($numc >= 100 && $numc <= 199)
            {
                if ($numc == 100)
                    $numce = "CIEN ";
                else
                    $numce = "CIENTO ".(decena($numc - 100));
            }
        }
        else
            $numce = decena($numc);
 
        return $numce;
}
 
    function miles($nummero){
        if ($nummero >= 1000 && $nummero < 2000){
            $numm = "MIL ".(centena($nummero%1000));
        }
        if ($nummero >= 2000 && $nummero <10000){
            $numm = unidad(Floor($nummero/1000))." MIL ".(centena($nummero%1000));
        }
        if ($nummero < 1000)
            $numm = centena($nummero);
 
        return $numm;
    }
 
    function decmiles($numdmero){
        if ($numdmero == 10000)
            $numde = "DIEZ MIL";
        if ($numdmero > 10000 && $numdmero <20000){
            $numde = decena(Floor($numdmero/1000))."MIL ".(centena($numdmero%1000));
        }
        if ($numdmero >= 20000 && $numdmero <100000){
            $numde = decena(Floor($numdmero/1000))." MIL ".(miles($numdmero%1000));
        }
        if ($numdmero < 10000)
            $numde = miles($numdmero);
 
        return $numde;
    }
 
    function cienmiles($numcmero){
        if ($numcmero == 100000)
            $num_letracm = "CIEN MIL";
        if ($numcmero >= 100000 && $numcmero <1000000){
            $num_letracm = centena(Floor($numcmero/1000))." MIL ".(centena($numcmero%1000));
        }
        if ($numcmero < 100000)
            $num_letracm = decmiles($numcmero);
        return $num_letracm;
    }
 
    function millon($nummiero){
        if ($nummiero >= 1000000 && $nummiero <2000000){
            $num_letramm = "UN MILLON ".(cienmiles($nummiero%1000000));
        }
        if ($nummiero >= 2000000 && $nummiero <10000000){
            $num_letramm = unidad(Floor($nummiero/1000000))." MILLONES ".(cienmiles($nummiero%1000000));
        }
        if ($nummiero < 1000000)
            $num_letramm = cienmiles($nummiero);
 
        return $num_letramm;
    }
 
    function decmillon($numerodm){
        if ($numerodm == 10000000)
            $num_letradmm = "DIEZ MILLONES";
        if ($numerodm > 10000000 && $numerodm <20000000){
            $num_letradmm = decena(Floor($numerodm/1000000))."MILLONES ".(cienmiles($numerodm%1000000));
        }
        if ($numerodm >= 20000000 && $numerodm <100000000){
            $num_letradmm = decena(Floor($numerodm/1000000))." MILLONES ".(millon($numerodm%1000000));
        }
        if ($numerodm < 10000000)
            $num_letradmm = millon($numerodm);
 
        return $num_letradmm;
    }
 
    function cienmillon($numcmeros){
        if ($numcmeros == 100000000)
            $num_letracms = "CIEN MILLONES";
        if ($numcmeros >= 100000000 && $numcmeros <1000000000){
            $num_letracms = centena(Floor($numcmeros/1000000))." MILLONES ".(millon($numcmeros%1000000));
        }
        if ($numcmeros < 100000000)
            $num_letracms = decmillon($numcmeros);
        return $num_letracms;
    }
 
    function milmillon($nummierod){
        if ($nummierod >= 1000000000 && $nummierod <2000000000){
            $num_letrammd = "MIL ".(cienmillon($nummierod%1000000000));
        }
        if ($nummierod >= 2000000000 && $nummierod <10000000000){
            $num_letrammd = unidad(Floor($nummierod/1000000000))." MIL ".(cienmillon($nummierod%1000000000));
        }
        if ($nummierod < 1000000000)
            $num_letrammd = cienmillon($nummierod);
 
        return $num_letrammd;
    }

    function nameMonth($mes){
                        switch($mes)
                {   
                    case "January":
                    $monthNameSpanish = "Enero";
                    break;

                    case "February":
                    $monthNameSpanish = "Febrero";
                    break;

                    case "March":
                    $monthNameSpanish = "Marzo";
                    break;
                    case "April":
                    $monthNameSpanish = "Abril";
                    break;

                    case "May":
                    $monthNameSpanish = "Mayo";
                    break;

                    case "June":
                    $monthNameSpanish = "Junio";
                    break;
                    case "July":
                    $monthNameSpanish = "Julio";
                    break;

                    case "August":
                    $monthNameSpanish = "Agosto";
                    break;

                    case "September":
                    $monthNameSpanish = "Septiembre";
                    break;
                    case "October":
                    $monthNameSpanish = "Octubre";
                    break;

                    case "November":
                    $monthNameSpanish = "Noviembre";
                    break;

                    case "December":
                    $monthNameSpanish = "Diciembre";
                    break;

                }
 
        return $monthNameSpanish;
    }
 
 
function convertir($numero){
             $num = str_replace(",","",$numero);
             $num = number_format($num,2,'.','');
             $cents = substr($num,strlen($num)-2,strlen($num)-1);
             $num = (int)$num;
 
             $numf = milmillon($num);
 
        return " ".$numf;
}

 
?>