<?php  
require_once "../functions.php";
require_once "../../tcpdf_min/tcpdf.php";
	// getting data from the table Orders 

	$rows_Orders = table_Orders ('select_one', $_REQUEST['link'], NULL, NULL, NULL, NULL, NULL);
	foreach ($rows_Orders as $row_Orders) {
	 	# code...
	}

	$rows_Invoices = table_Invoices ('select_one', $row_Orders->InvoicesLink, NULL, NULL, NULL, NULL, NULl);
	foreach ($rows_Invoices as $row_Invoices) {
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
			$output .= "<tr>";
			$output .= "<td>".$row_Orders_List->Name.": ".$row_Orders_List->Color.", ".$row_Orders_List->Size."</td>";
			$output .= "<td>".$row_Orders_List->Qty."</td>";
			$output .= "<td>".$row_Orders_List->Subtotal."</td>";
			$output .= "</tr>";
		}


		return $output;
	}

	// echo fetch_data($_REQUEST['link']);	
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

    $content = '<style>'.file_get_contents('stylesheet.css').'</style>';

    $content .= '
        <table border-top="1" cellspacing="0" cellpadding="5">
            <tr>
                <th>Items</th>
                <th>Qty</th>
                <th>Amt MMK</th>
                
            </tr>
    ';
    
    $content .= fetch_data($_REQUEST['link']);

 	$content .="</table>";

    $obj_pdf->writeHTML($content);

    $obj_pdf->Output("/opt/lampp/htdocs/sites/samplestore/sample.pdf", "FD");
    // this needs an absolute path once on the web server.... IMPORTANT

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
