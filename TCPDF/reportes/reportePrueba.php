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
include('../../controladores/controladorTramite.php');



$controlador = new controladorTramite();
$consultaEntrada= $controlador->reporteEntradaMaterial(2); 

// set font
$pdf->SetFont('times', '', 14);

// add a page
$pdf->AddPage();
$nombre = 'Tornillo';
$especificaciones = '6 X 3/4';

// set some text to print
$txt = <<<EOD

$nombre / $especificaciones
EOD;

$txt2 = <<<EOD
$nombre
EOD;

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
<table width="600" cellspacing="2" cellpadding="1" border="0">
<tr>
        <th><font face="Arial, Helvetica, sans-serif">Fecha del ingreso</font></th>
        <th><font face="Arial, Helvetica, sans-serif">Nombre del Empleado</font></th>
        <th><font face="Arial, Helvetica, sans-serif">Cantidad ingresada</font></th>
      </tr>';
$tbl_footer = '</table>';
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
// output the HTML content








// output the HTML content

// print a block of text using Write()
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln();
$pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');

$pdf->AddPage();
$pdf->Write(0, $txt2, '', 0, 'C', true, 0, false, false, 0);
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('reporteMaterial', 'I');

//============================================================+
// END OF FILE
//============================================================+