<?php  
require_once "../../tcpdf_min/tcpdf.php";

//setting up the oject for pdf
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

require_once "../conn.php";

$db = new Database(); 

// getting data from the table Orders 
$stm = "SELECT * FROM Orders WHERE OrdersLink = :OrdersLink ;";
$db->query($stm);
$db->bind(":OrdersLink", $_GET['link']);
$rows_Orders = $db->resultset();	
foreach ($rows_Orders as $row_Orders) {
 	# code...
}
// getting data from the table Invoices
$stm = "SELECT * FROM Invoices WHERE InvoicesLink = :InvoicesLink ;";
$db->query($stm);
$db->bind(":InvoicesLink", $row_Orders->InvoicesLink);
$rows_Invoices = $db->resultset();
foreach ($rows_Invoices as $row_Invoices) {
 	# code...
}

//getting data from the tabel Customers
$stm = "SELECT * FROM Customers WHERE CustomersLink = :CustomersLink ;";
$db->query($stm);
$db->bind(":CustomersLink", $row_Orders->CustomersLink);	
$rows_Customers = $db->resultset();
foreach ($rows_Customers as $row_Customers) {
	# code...
}
//functoin to fetch data from the table Orders_List;
function fetch_data ($link) {
	$db = new Database();
	$stm = "SELECT 
		Orders_List.ProductsLink, 
		Orders_List.Qty,
		Orders_List.Subtotal, 
		Products.Name,
		Products.Size, 
		Products.Color
		FROM Orders_List LEFT OUTER JOIN Products ON Orders_List.ProductsLink = Products.ProductsLink
		WHERE Orders_List.OrdersLink = :OrdersLink
	;";
	$db->query($stm);
	$db->bind(":OrdersLink", $link);
	$rows_Orders_List = $db->resultset();

	$output = '';

	foreach ($rows_Orders_List as $row_Orders_List) {
		$output .= '<tr>';
		$output .= '<td>'.$row_Orders_List->Name.": ".$row_Orders_List->Color.", ".$row_Orders_List->Size.'</td>';
		$output .= '<td>'.$row_Orders_List->Qty.'</td>';
		$output .= '<td  style="text-align: right;">'.$row_Orders_List->Subtotal.'</td>';
		$output .= '</tr>';
	}
	return $output;
}


$content = '<style>'.file_get_contents('pdfstyles.css').'</style>';

$content .= '<div class="header">';
$content .= '<table>';
$content .= '<thead>';
$content .= '<tr>';
$content .= '<th>';
$content .= '<img src="../docs/logo.png" style="width: 120px">';
$content .= '</th>';
$content .= '<th>';
$content .= '<span style="font-weight: bold">Sample Store</span><br>';
$content .= 'No 116, Rm 13, 15th Street<br>';
$content .= 'Lanmataw Township, Yangon <br>';
$content .= 'Phone: 09402590317<br>';
$content .= 'www.samplestore.com<br>';
$content .= '</th>';
$content .= '</tr>';
$content .= '</thead>';

$content .= '<tbody>';
$content .= '<tr>';
$content .= '<td>';
$content .= 'To: ';
$content .= '<span style="font-weight: bold">'.$row_Customers->Title.'. '.$row_Customers->Name.'</span>';
$content .= '</td>';
$content .= '<td>';
$content .= 'Invoice No: ';
$content .= '<span style="font-weight: bold">'.$row_Invoices->InvoiceNo.'</span>';
$content .= '</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>';

$content .= $row_Customers->Address.', '.$row_Customers->Town;
$content .= '</td>';
$content .= '<td>';
$content .= '</td>';
$content .= '</tr>';

$content .= '<tr>';
$content .= '<td>';
$content .= 'Mobile: ';
$content .= '<span style="font-weight: bold">'.$row_Customers->Mobile.'</span>';
$content .= '</td>';
$content .= '<td>';	
$content .= '</td>';
$content .= '</tr>';

$content .= '</tbody>';
$content .= '</table>';
$content .= '</div>';

$content .= '<div class="body">';
$content .= '<h1 style="text-align: center">Invoice</h1>';
$content .= '<table cellpadding="6">';
$content .= '<thead style="border-bottom: 1px solid silver;">';
$content .= '<tr style="font-weight: bold;">';
$content .= '<td>';
$content .= 'Items';
$content .= '</td>';
$content .= '<td>';
$content .= 'Qty';
$content .= '</td>';
$content .= '<td style="text-align: right;">';
$content .= 'Amount';
$content .= '</td>';
$content .= '</tr>';
$content .= '</thead>';
$content .= '<tbody>';

$content .= fetch_data($_REQUEST['link']);	

$content .= '</tbody>';	
$content .= '</table>';
$content .= '<table cellpadding="6">';
$content .= '<tr>';
$content .= '<th>';
$content .= '</th>';
$content .= '<th style="font-weight: bold; text-align: center; ">';
$content .= 'Total';
$content .= '</th>';

$content .= '<th style="font-weight: bold; text-align: right;">';
$content .= $row_Invoices->Total;
$content .= '</th>';
$content .= '</tr>';
$content .= '</table>';
$content .= '</div>';

$content .= '<h2 style="text-align: center">Please save this pdf file or take a screenshot for your reference.</h2>';

$content .= '<div class="payments">';
$content .= '<p>';
$content .= 'Payments: ';
$content .= '</p>';
$content .= '</div>';

$content .= '<table style="margin: 6px auto;">';
$content .= '<tr>';
$content .= '<td>';
$content .= '<h3>KBZ Pay</h3>';
$content .= 'Name: L Mung Den Nong<br>';
$content .= 'Account: 09402590317';
$content .= '</td>';

$content .= '<td>';
$content .= '<h3>Aya Pay</h3>';
$content .= 'Name: L Mung Den Nong<br>';
$content .= 'Account: 09402590317';
$content .= '</td>';

$content .= '</tr>';
$content .= '</table>';
$content .= '<br>';
$content .= '<br>';
$content .= '<br>';
$content .= '<div class="link" style="margin-top: 12px;">';
$content .= 'After processsing your payment, 
please submit the proof of your payment at the link below.<br>';
$content .= '<a href="https://denlp.com/samplestore/store/submit_payment.php?InvoiceNo='.$row_Invoices->InvoiceNo.'">https://denlp.com/samplestore/store/submit_payment.php?InvoiceNo='.$row_Invoices->InvoiceNo.'</a>';
// this needs and absolute path once on the webserver.... IMPORTANT
$content .= '</div>';

$obj_pdf->writeHTML($content);

//for local server
$obj_pdf->Output("/opt/lampp/htdocs/sites/samplestore/sample.pdf", "FD");

// $obj_pdf->Output("/home/denlpmm/public_html/samplestore/Invoices/Invoice-$row_Invoices->InvoiceNo.pdf", "FD");
?>
