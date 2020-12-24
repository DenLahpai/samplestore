<?php
require_once "../functions.php";
if (isset($_REQUEST['Search']) || !empty($_REQUEST['Search'])) {
    $Table = $_REQUEST['Table'];
    $Search = '%'.$_REQUEST['Search'].'%';

    //getting row counts
    $db = new Database();
    $stm = "SELECT * FROM $Table WHERE CONCAT (
            BrandsName, 
            Country
        ) LIKE :Search
    ;";
    $db->query($stm);
    $db->bind(':Search', $Search);
    echo $db->rowCount();    

    $db = NULL;
}
?>