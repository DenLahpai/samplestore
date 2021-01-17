<?php
require_once "../functions.php";
// print_r($_POST);
if (isset($_POST)) {
    $db = new Database();
    $stm = "UPDATE Invoices Set 
        Status = :Status,
        Method = :Method, 
        PaidOn = :PaidOn
        WHERE InvoicesLink = :InvoicesLink
    ;";
    $db->query($stm);
    $db->bind(":Status", $_REQUEST['Status']);
    $db->bind(":Method", $_REQUEST['Method']);
    $db->bind(":PaidOn", $_REQUEST['PaidOn']);
    $db->bind(":InvoicesLink", $_REQUEST['InvoicesLink']);
    if ($db->execute()) {
        $i = true;
    }
    else {
        echo "<span style='color: red;'>There was a connection errro! Please try again!</span>";
    }
}
?>