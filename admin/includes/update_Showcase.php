<?php
require_once "../functions.php";
if (isset($_REQUEST)) {
    $Table = 'Showcase'.$_REQUEST['num'];

    $db = new Database();

    if ($_REQUEST['task'] == 'insert') {
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