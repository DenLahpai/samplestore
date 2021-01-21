<?php
require_once "../functions.php";
if (isset($_POST)) {
    $db = new Database();
    //checking for duplicate entry!
    $stm = "SELECT * FROM Delivery_Fees WHERE 
    Town = :Town AND 
    Township = :Township AND
    Delivery_FeesLink != :link
    ;";
    $db->query($stm);
    $db->bind(":Town", trim($_POST['Town']));
    $db->bind(":Township", trim($_POST['Township']));
    $db->bind(":link", $_POST['link']);
    $rowCount = $db->rowCount();
    if ($rowCount == 0) {
        $stm = "UPDATE Delivery_Fees SET 
            Town = :Town, 
            Township = :Township,
            Fees = :Fees,
            Remark = :Remark
            WHERE Delivery_FeesLink = :link
        ;";
        $db->query($stm);
        $db->bind(":Town", trim($_POST['Town']));
        $db->bind(":Township", trim($_POST['Township']));
        $db->bind(":Fees", $_POST['Fees']);
        $db->bind(":Remark", trim($_POST['Remark']));
        $db->bind(":link", $_POST['link']);
        if ($db->execute()) {
            $i = true;
        }
        else {            
            echo "<span style='color: red;>There was a connection error! Please try again!</span>";
        }
    }
    else {
        echo $rowCount;
        echo "<span style='color: red'>Duplicate entry!</span>";
    }
}
?>