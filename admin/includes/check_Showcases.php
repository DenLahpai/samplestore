<?php
require_once "../functions.php";

$Table = 'Showcase'.$_REQUEST['table'];

if (isset($_REQUEST['link']) && isset($_REQUEST['table'])) {
    
    $db = new Database();
    $stm = "SELECT * FROM $Table WHERE ProductsLink = :ProductsLink AND Status = 1;";
    $db->query($stm);
    $db->bind(":ProductsLink", $_REQUEST['link']);
    echo $db->rowCount();
}
elseif (empty($_REQUEST['link']) && isset($_REQUEST['table'])) {
    $limit = 6;
    $db = new Database();
    $stm = "SELECT * FROM $Table WHERE Status = 1 ;";
    $db->query($stm);
    $rowCount = $db->rowCount();
    echo $limit - $rowCount;
}
?>