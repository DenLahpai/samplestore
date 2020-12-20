<?php  
require_once "../functions.php";
if (isset($_POST['Table'])) {
	$Table = $_POST['Table'];
	$db = new Database();
	$stm = "SELECT * FROM $Table ;";
	$db->query($stm);
	echo $db->rowCount();
}
?>