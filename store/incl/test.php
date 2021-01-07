<?php 
require_once "../functions.php"; 
$db = new Database();
$stm = "SELECT * FROM Customers ;";
$db->query($stm);
$rows_Customers = $db->resultset();
if (isset($_POST['create_pdf'])) {
    require_once ("tcpdf_min/tcpdf.php");
    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    //Title of the document
    $obj_pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");
    //header image logo and tile of doc.
    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    //FONT style and size
    $obj_pdf->SetHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $obj_pdf->SetFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $obj_pdf->SetDefaultMonospaceFont('helvetica');
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
    $obj_pdf->setPrintHeader(false); // if true print header & footer
    $obj_pdf->setPrintFooter(false);
    $obj_pdf->SetAutoPageBreak(TRUE, 10); //2nd arguement is distce frm pg break
    $obj_pdf->SetFont('helvetica', '', 12);

    $content = '';

    $content .= '
        <table border="1" cellspacing="0" cellpadding="5">
            <tr>
                <th>Title</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Address</th>
            </tr>
    ';

    $contents .= $row_Customers;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .contain {
            display: grid;
            place-items: center;
        }
    </style>
</head>
<body>
    <div class="contain">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows_Customers as $row_Customers): ?>
                    <tr>
                        <td><? echo $row_Customers->Title; ?></td>
                        <td><? echo $row_Customers->Name; ?></td>
                        <td><? echo $row_Customers->Mobile; ?></td>
                        <td><? echo $row_Customers->Address; ?></td>
                    </tr>
                <? endforeach; ?>    
            </tbody>
        </table>
        <div>
            <form action="#" method="post">
                <button type="submit" name="create_pdf">Generate</button>
            </form>
        </div>  
    </div>
    <?php  

    ?>
</body>
</html>