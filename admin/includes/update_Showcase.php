<?php
require_once "../functions.php";
if (isset($_REQUEST)) {
    $Table = 'Showcase'.$_REQUEST['num'];

    $db = new Database();

    if ($_REQUEST['task'] == 'insert') {
        // checking before inserting as max item for Showcase1 is 6;

        $stm = "SELECT * FROM Showcase1 WHERE Status = 1 ;";
        $db->query($stm);
        $rowCount = $db->rowCount();
        
        if ($rowCount >= 6) {
            echo "<span style='color: red'>You are allowed to have only 6 items as hot sales</span>";
        }
        else {
            $stm = "INSERT INTO $Table SET 
                ProductsLink = :ProductsLink,
                UsersId = :UsersId
            ;";
            $db->query($stm);
            $db->bind(":ProductsLink", $_REQUEST['link']);
            $db->bind(":UsersId", $_SESSION['Id']);
            if ($db->execute()) {
                $i = true;
            }
            else {
                echo "<span style='color: red'>There was a connection error! Please try again!</span>";
            }
        }        
    }

    elseif ($_REQUEST['task'] == 'remove') {
        $stm = "UPDATE $Table SET Status = :Status WHERE ProductsLink = :ProductsLink ;";
        $db->query($stm);
        $db->bind(":Status", '0');
        $db->bind(":ProductsLink", $_REQUEST['link']);
        if ($db->execute()) {
            $i = true;
        }
        else {
            echo "<span style='color: red'>There was a connection error! Please try again!</span>";
        }
    }
    else {
        echo "<span style='color: red'>There was a connection error! Please try again!</span>";
    }
}
?>