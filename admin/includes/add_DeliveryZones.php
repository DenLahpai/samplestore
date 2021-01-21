<?php
require_once "../functions.php";
if (isset($_POST)) {
    //generating Delivery_FeesLink 
    $Delivery_FeesLink = uniqid('DLF_', true);
    $db = new Database();
    
    //checking for duplicate entry
    $stm = "SELECT * FROM Delivery_Fees WHERE 
        Town = :Town AND
        Township = :Township
    ;";
    $db->query($stm);
    $db->bind(":Town", trim($_POST['Town']));
    $db->bind(":Township", trim($_POST['Township']));
    $rowCount = $db->rowCount();

    if ($rowCount == 0) {
        // inserting data to the table Deliver_Fees
        $stm = "INSERT INTO Delivery_Fees SET 
        Delivery_FeesLink = :Delivery_FeesLink, 
        Town = :Town,
        Township = :Township,
        Fees = :Fees,
        Remark = :Remark
    ;";
        $db->query($stm);
        $db->bind(":Delivery_FeesLink", $Delivery_FeesLink);
        $db->bind(":Town", trim($_POST['Town']));
        $db->bind(":Township", trim($_POST['Township']));
        $db->bind(":Fees", $_POST['Fees']);
        $db->bind(":Remark", trim($_POST['Remark']));
        if ($db->execute()) {
            $i = true;
        }
        else {
            echo "<span style='color: red'>There was a connection error! Please try again!</span>";
        }
    }
    else {
        echo "<span style='color: red'>Duplicate Entry!</span>";
    }   
}
?>