<?php  
require_once "../functions.php";


function fetch_page () {
	$page = include_once "../invoice.html";
	return $page;
}

require_once "../../tcpdf_min/tcpdf.php";

    $obj_pdf = new TCPDF('p', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    //Title of the document
    $obj_pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");
    //header image logo and tile of doc.
    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    //FONT style and size
    $obj_pdf->SetHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $obj_pdf->SetFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $obj_pdf->SetDefaultMonospacedFont('helvetica');
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
    $obj_pdf->setPrintHeader(false); // if true print header & footer
    $obj_pdf->setPrintFooter(false);
    $obj_pdf->SetAutoPageBreak(TRUE, 10); //2nd arguement is distce frm pg break
    $obj_pdf->SetFont('helvetica', '', 12);
    $obj_pdf->AddPage();

    $content = fetch_page();

    $obj_pdf->writeHTML($content);

    $obj_pdf->Output("/opt/lampp/htdocs/sites/samplestore/samplex.pdf", "FD");
    //this needs an absolute path once on the web server.... IMPORTANT


?>