<?php 
require_once "../functions.php";

if (isset($_POST['link'])) {
	$db = new Database();
	$stm = "SELECT * FROM Products WHERE ProductsLink = :ProductsLink AND Status = 'Soldout' ;";
	$db->query($stm);
	$db->bind(":ProductsLink", $_POST['link']);
	
	echo $db->rowCount();
}
?>