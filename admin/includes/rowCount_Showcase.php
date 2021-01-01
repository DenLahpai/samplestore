<?php
require_once "../functions.php";
if (isset($_REQUEST)) {
    $Table = 'Showcase'.$_REQUEST['table'];
    $db = new Database();
    $stm = "SELECT * FROM $Table WHERE ProductsLink = :ProductsLink AND Status = 1 ;";
    $db->query($stm);
    $db->bind(":ProductsLink", $_REQUEST['link']);
    $rowCount = $db->rowCount();

}
?>