<?php
require_once "conn.php";

// function to get sessions data 
function getSession ($var1) {
    $db = new Database();

    $stm = "INSERT INTO Sessions SET 
        SessionLink = :SessionLink, 
        Ip = :Ip
    ;";
    $db->query($stm);
    $db->bind(":SessionLink", $_SESSION['link']);
    $db->bind(":Ip", $var1);
    $db->execute();
}
?>