<?php
//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'logofinal5.png';
        $this->Image($image_file, 10, 10, 15, '', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, 'Reporte de movimiento de material', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sigpi');
$pdf->SetTitle('Reporte de material');
$pdf->SetSubject('movimiento');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
require_once('../controladores/controladorTramite.php');

$idMaterial = $_REQUEST['idMaterial'];

$controlador = new controladorTramite();

if ($conteoEntrada = mysqli_fetch_array($controlador->reporteConteoEntrada($idMaterial)))
    {
        $numEntrada = $conteoEntrada['numero'];
    }
if ($conteoSalida = mysqli_fetch_array($controlador->reporteConteoSalida($idMaterial)))
    {
        $numSalida = $conteoSalida['numero'];
    }
if ($conteoDevolucion = mysqli_fetch_array($controlador->reporteConteoDevolucion($idMaterial)))
    {
        $numDevolucion = $conteoDevolucion['numero'];
    }


// set font
$pdf->SetFont('times', '', 14);

// add a page
$pdf->AddPage();



if ($tabla = mysqli_fetch_array($controlador->reporteConsultaMaterial($idMaterial))){
    $nombre = $tabla['referencia'];
    $especificaciones = $tabla['especificaciones'];
    $unidadMedida = $tabla['unidadMedida'];
    $cantidad = $tabla['cantidadDisponible'];
}
// set some text to print
$material= <<<EOD

Nombre del material: $nombre 
Especificaciones: $especificaciones
Unidad de medida: $unidadMedida
Cantidad en almacen: $cantidad
EOD;



$entrada = <<<EOD
    Ingresos
EOD;

$salida = <<<EOD
    Asignaciones
EOD;

$devolucion = <<<EOD
    Devoluciones
EOD;

    $pdf->Write(0, $material, '', 0, 'C', true, 0, false, false, 0);
    $pdf->Ln();

    $pdf->Write(0, $entrada, '', 0, 'C', true, 0, false, false, 0);
    $pdf->Ln();
// create some HTML content

$tbl_header = '<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    margin: 0 20px;
}
tr {
    padding: 3px 0;
}

th {
    background-color: #CCCCCC;
    border: 1px solid #DDDDDD;
    color: #333333;
    font-family: trebuchet MS;
    font-size: 15px;
    padding-bottom: 4px;
    padding-left: 6px;
    padding-top: 5px;
    text-align: left;
}
td {
    border: 1px solid #CCCCCC;
    font-size: 15px;
    padding: 3px 7px 2px;
}
</style>
<table width="600" cellspacing="2" cellpadding="1" border="0">'
;

$tbl_footer = '</table>';


if($numEntrada > 0){
    $consultaEntrada= $controlador->reporteEntradaMaterial($idMaterial);
    $tbl_cabecera = 
        '<tr>
            <th><font face="Arial, Helvetica, sans-serif">Fecha</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Empleado</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Cantidad</font></th>
        </tr>'
        ;  
    $tbl = '';
    while ($tabla = mysqli_fetch_array($consultaEntrada)) {
    $tbl .= '
        <tr>
            <td>'.$tabla['fecha'].'</td>
            <td>'.$tabla['nombreCompleto'].'</td>
            <td>'.$tabla['cantidadAsignada'].'</td>
        </tr>
    ';
    }
    $pdf->writeHTML($tbl_header .$tbl_cabecera. $tbl . $tbl_footer, true, false, false, false, '');
}else{

$noEntrada = <<<EOD
    No hay entradas registradas
EOD;

    $pdf->Write(0, $noEntrada, '', 0, 'C', true, 0, false, false, 0);
    $pdf->Ln();
}

   $pdf->Write(0, $salida, '', 0, 'C', true, 0, false, false, 0);
   $pdf->Ln();

if($numSalida > 0){
    $consultaSalida= $controlador->reporteSalidaMaterial($idMaterial);
    $tbl_cabecera = 
        '<tr>
            <th><font face="Arial, Helvetica, sans-serif">Fecha</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Empleado</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Cantidad</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Proyecto</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Plano</font></th>
        </tr>'
        ;  
    $tbl = '';
    while ($tabla = mysqli_fetch_array($consultaSalida)) {
    $tbl .= '
        <tr>
            <td>'.$tabla['fecha'].'</td>
            <td>'.$tabla['nombreCompleto'].'</td>
            <td>'.$tabla['cantidadAsignada'].'</td>
            <td>'.$tabla['proyecto'].'</td>
            <td>'.$tabla['plano'].'</td>
        </tr>
    ';
    }
    $pdf->writeHTML($tbl_header .$tbl_cabecera. $tbl . $tbl_footer, true, false, false, false, '');
}else{

$noSalida = <<<EOD
    No hay asignaciones registradas
EOD;

    $pdf->Write(0, $noSalida, '', 0, 'C', true, 0, false, false, 0);
    $pdf->Ln();
}

   $pdf->Write(0, $devolucion, '', 0, 'C', true, 0, false, false, 0);
   $pdf->Ln();

if($numDevolucion > 0){
    $consultaDevolucion= $controlador->reporteDevolucionMaterial($idMaterial);
    $tbl_cabecera = 
        '<tr>
            <th><font face="Arial, Helvetica, sans-serif">Fecha</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Empleado</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Cantidad</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Proyecto</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Plano</font></th>
        </tr>'
        ;  
    $tbl = '';
    while ($tabla = mysqli_fetch_array($consultaDevolucion)) {
    $tbl .= '
        <tr>
            <td>'.$tabla['fecha'].'</td>
            <td>'.$tabla['nombreCompleto'].'</td>
            <td>'.$tabla['cantidadAsignada'].'</td>
            <td>'.$tabla['proyecto'].'</td>
            <td>'.$tabla['plano'].'</td>
        </tr>
    ';
    }
    $pdf->writeHTML($tbl_header .$tbl_cabecera. $tbl . $tbl_footer, true, false, false, false, '');
}else{

$noDevolucion = <<<EOD
    No hay devoluciones registradas
EOD;

    $pdf->Write(0, $noDevolucion, '', 0, 'C', true, 0, false, false, 0);
    $pdf->Ln();
}





// output the HTML content








// output the HTML content

// print a block of text using Write()


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('reporteMaterial', 'I');

//============================================================+
// END OF FILE
//============================================================+