<?php
// [INCLUDE] //
include('./common/session.php');


// [REQUIRE] //
require_once('tcpdf/tcpdf_include.php');


// [INIT] //
$html = '';
$data = array();
$date = date('l jS \of F Y h:i:s A');


// [INIT] //
$vin = 'undefined';
$data['vin'] = 'undefined';
$data['is_salvage'] = 'undefined';
$data['vehicle_title'] = 'undefined';
$data['loss_type'] = 'undefined';
$data['mileage'] = 'undefined';
$data['primary_damage'] = 'undefined';
$data['secondary_damage'] = 'undefined';


// [POST-VALUES] //
if ($_POST['vin'] != '') { $vin = $_POST['vin']; }
if ($_POST['vin'] != '') { $data['vin'] = $_POST['vin']; }
if ($_POST['is_salvage'] != '') { $data['is_salvage'] = $_POST['is_salvage']; }
if ($_POST['vehicle_title'] != '') { $data['vehicle_title'] = $_POST['vehicle_title']; }
if ($_POST['loss_type'] != '') { $data['loss_type'] = $_POST['loss_type']; }
if ($_POST['mileage'] != '') { $data['mileage'] = $_POST['mileage']; }
if ($_POST['primary_damage'] != '') { $data['primary_damage'] = $_POST['primary_damage']; }
if ($_POST['secondary_damage'] != '') { $data['secondary_damage'] = $_POST['secondary_damage']; }


error_reporting(E_ALL);
error_reporting(-1);

ini_set('error_reporting', E_ALL);


// create new PDF document
$pdf = new TCPDF(
	PDF_PAGE_ORIENTATION,
	PDF_UNIT,
	PDF_PAGE_FORMAT,
	true,
	'UTF-8',
	false
);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('americanvinhistory.com');
$pdf->SetTitle('VIN HISTORY REPORTS AMARICA');
$pdf->SetSubject('VIN HISTORY REPORTS AMARICA');
$pdf->SetKeywords('VIN, ISTORY REPORTS AMARICA');


// set default header data
$pdf->SetHeaderData(
	PDF_HEADER_LOGO,
	PDF_HEADER_LOGO_WIDTH,
	PDF_HEADER_TITLE.' 006',
	PDF_HEADER_STRING
);


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
// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// create some HTML content
$html .= '
<h1>VIN HISTORY REPORTS AMARICA</h1>
Report Generated of VIN Number : <h2>' . $vin. '</h2>
Date: '. $date
;


// create some HTML content

$html .= '
	<h2>Essentials Report</h2>
	<table border="1" cellspacing="1" cellpadding="1">
		<tr>
			<td>VIN Number</td>	
			<td>'.$data['vin'].'</td>
		</tr>
		<tr>
			<td>Is salvage?</td>	
			<td>'.$data['is_salvage'].'</td>
		</tr>
		<tr>
			<td>Vehicle title</td>	
			<td>'.$data['vehicle_title'].'</td>
		</tr>

		<tr>
			<td>Loss type</td>	
			<td>'.$data['loss_type'].'</td>
		</tr>
		<tr>
			<td>Mileage</td>	
			<td>'.$data['mileage'].'</td>
		</tr>
		<tr>
			<td>Primary damage</td>	
			<td>'.$data['primary_damage'].'</td>
		</tr>
		<tr>
			<td>Secondary damage</td>	
			<td>'.$data['secondary_damage'].'</td>
		</tr>
	</table>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

$name = $data['vin'];

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');