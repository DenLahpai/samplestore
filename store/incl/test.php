<?php 
class Database {
    private $database;
    private $stm;

    //connect to db
    public function __construct() {

        try {
            $this->database = new PDO("mysql: host=localhost;
                port=3601;  dbname=denlpmm_samplestore; charset=UTF8",
                "denlpmm_Store_Admin", "LinkCorp@21");
            $this->database->setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
            $this->database->setAttribute(PDO:: ATTR_DEFAULT_FETCH_MODE, PDO:: FETCH_OBJ);
        }
        catch (PDOException $e){
            throw new Exception($e->getMessage());
        }
    }

    public function query($query) {
        $this->stm = $this->database->prepare($query);
    }

    public function bind($params, $value) {
        // if(is_null($type)) {
        //     switch (true) {
        //         case is_int($value):
        //             $type = PDO:: PARAM_INT;
        //             break;
        //         case is_bool($value):
        //              $type = PDO:: PARAM_BOOL;
        //              break;
        //         case is_null($value):
        //             $type = PDO:: PARAM_NULL;
        //         default:
        //             $type = PDO:: PARAM_STR;
        //             break;
        //     }
        // }
        $this->stm->bindParam($params, $value);
    }

    public function execute() {
        return $this->stm->execute();
    }

    public function resultset() {
        $this->execute();
        return $this->stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function resultsetArray() {
        $this->execute();
        return $this->stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function rowCount() {
        $this->execute();
        return $this->stm->rowCount();
    }
} 

function fetch_data () {
    $db = new Database();
    $stm = "SELECT * FROM Customers ;";
    $db->query($stm);
    $output = "";
    $rows_Customers = $db->resultset();
    foreach ($rows_Customers as $row_Customers) {
        $output .= "<tr>";
        $output .= "<td>".$row_Customers->Title."</td>";
        $output .= "<td>".$row_Customers->Name."</td>";
        $output .= "<td>".$row_Customers->Mobile."</td>";
        $output .= "<td>".$row_Customers->Address."</td>";
        $output .= "</tr>";
    }
    return $output;
}

if (isset($_POST['create_pdf'])) {
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

    $content .= fetch_data();

    $content .= "</table>";

    $obj_pdf->writeHTML($content);

    // $obj_pdf->Output("/opt/lampp/htdocs/sites/samplestore/sample.pdf", "FD");
    //this needs an absolute path once on the web server.... IMPORTANT
    $obj_pdf->Output("/home/denlpmm/public_html/samplestore/Invoices/InvoiceNo.pdf", "FD");
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
                <?php echo fetch_data(); ?>
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