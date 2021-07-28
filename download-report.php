<?php
// [REQUIRE] //
require_once('tcpdf/tcpdf_include.php');


// [INIT] //
$html = '';
$data = array();
$date = date('l jS \of F Y h:i:s A');


// [POST-VALUES] //
/*
$data['vin'] = $vin = $_POST['vin'];
$data['email'] = $_POST['email'];
$data['password'] = $_POST['password'];
$data['is_salvage'] = $_POST['is_salvage'];
$data['vehicle_title'] = $_POST['vehicle_title'];
$data['loss_type'] = $_POST['loss_type'];
$data['mileage'] = $_POST['mileage'];
$data['primary_damage'] = $_POST['primary_damage'];
$data['secondary_damage'] = $_POST['secondary_damage'];
*/
$vin = 'vin3';
$data['vin'] = 'vin';
$data['email'] = 'email';
$data['password'] = 'password';
$data['is_salvage'] = 'is_salvage';
$data['vehicle_title'] = 'vehicle_title';
$data['loss_type'] = 'loss_type';
$data['mileage'] = 'mileage';
$data['primary_damage'] = 'primary_damage';
$data['secondary_damage'] = 'secondary_damage';


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


// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$html .= '<h1>VIN HISTORY REPORTS AMARICA</h1>
Report Generated of VIN Number : <h2>' . $vin. '</h2>
Date: '. $date;


// create some HTML content

$html .= '<h2>Essentials Report</h2>
<table border="1" cellspacing="1" cellpadding="1">
	<tr>
		<th></th>
		<th align="right"></th>
	</tr>
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
</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

$name = $data['vin'];

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

