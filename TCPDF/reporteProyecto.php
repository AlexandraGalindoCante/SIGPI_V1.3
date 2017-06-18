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
        $this->Cell(0, 15, 'Reporte de proyecto', 0, false, 'C', 0, '', 0, false, 'M', 'M');
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
$pdf->SetTitle('Reporte de proyecto');
$pdf->SetSubject('información');

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
require_once('../controladores/controladorProyecto.php');

$idProyecto = $_REQUEST['idProyectoReporte'];

$controlador = new controladorProyecto();


if ($conteoEquipo = mysqli_fetch_array($controlador->conteoEquipo($idProyecto)))
    {
        $numEquipo = $conteoEquipo['numero'];
    }
if ($conteoOrdenes = mysqli_fetch_array($controlador->conteoOrdenes($idProyecto)))
    {
        $numOrdenes = $conteoOrdenes['numero'];
    }




// set font
$pdf->SetFont('times', '', 14);

// add a page
$pdf->AddPage();





if ($tabla = mysqli_fetch_array($controlador->consultarDatosProyecto($idProyecto))){
    $nombre = $tabla['nombre'];
    $inicio = $tabla['fechaInicio'];
    $entrega = $tabla['fechaEntrega'];
    $estado = $tabla['estado'];
    $cliente = $tabla['cliente'];
    $porcentaje = $tabla['porcentajeAvance'];
}
// set some text to print
$proyecto= <<<EOD

Nombre del proyecto: $nombre 
Fecha de inicio: $inicio
Fecha estimada de entrega: $entrega
Estado del proyecto: $estado
Avance: % $porcentaje
Cliente: $cliente

EOD;



$equipo = <<<EOD
    Equipo de trabajo
EOD;

$ordenes = <<<EOD
    Ordenes
EOD;



    $pdf->Write(0, $proyecto, '', 0, 'C', true, 0, false, false, 0);
    $pdf->Ln();

    $pdf->Write(0, $equipo, '', 0, 'C', true, 0, false, false, 0);
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


if($numEquipo > 0){
    $consultaEquipo= $controlador->consultarEquipoProyecto($idProyecto);
    $tbl_cabecera = 
        '<tr>
            <th><font face="Arial, Helvetica, sans-serif">Empleado</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Rol</font></th>
        </tr>'
        ;  
    $tbl = '';
    while ($tabla = mysqli_fetch_array($consultaEquipo)) {
    $tbl .= '
        <tr>
            <td>'.$tabla['nombreCompleto'].'</td>
            <td>'.$tabla['nombre'].'</td>
        </tr>
    ';
    }
    $pdf->writeHTML($tbl_header .$tbl_cabecera. $tbl . $tbl_footer, true, false, false, false, '');
}else{

$noEquipo = <<<EOD
    No hay un equipo registrado
EOD;

    $pdf->Write(0, $noEquipo, '', 0, 'C', true, 0, false, false, 0);
    $pdf->Ln();
}

   $pdf->Write(0, $ordenes, '', 0, 'C', true, 0, false, false, 0);
   $pdf->Ln();

if($numOrdenes > 0){
    $consultaOrdenes= $controlador->consultarPlanosProyecto($idProyecto);
    $tbl_cabecera = 
        '<tr>
            <th><font face="Arial, Helvetica, sans-serif">Plano</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Material solicitado</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Cantidad</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Consumo</font></th>
            <th><font face="Arial, Helvetica, sans-serif">Estado solicitud</font></th>
        </tr>'
        ;  
    $tbl = '';
    while ($tabla = mysqli_fetch_array($consultaOrdenes)) {
    	if ($tabla['estado']>0) {
    		$estado = 'Entregada';
    	}else{
    		$estado = 'En espera';
    	}
    $tbl .= '
        <tr>
            <td>'.$tabla['descripcion'].'</td>
            <td>'.$tabla['referencia'].' | '.$tabla['especificaciones'].'</td>
            <td>'.$tabla['cantidadRequerida'].'</td>
            <td>'.$tabla['cantidadConsumida'].'</td>
            <td>'.$estado.'</td>
        </tr>
    ';
    }
    $pdf->writeHTML($tbl_header .$tbl_cabecera. $tbl . $tbl_footer, true, false, false, false, '');
}else{

$noOrden = <<<EOD
    No hay planos registrados
EOD;

    $pdf->Write(0, $noOrden, '', 0, 'C', true, 0, false, false, 0);
    $pdf->Ln();
}






// output the HTML content








// output the HTML content

// print a block of text using Write()


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('reporteProyecto', 'I');

//============================================================+
// END OF FILE
//============================================================+