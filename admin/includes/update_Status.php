<?php  
require_once "../functions.php";

if (isset($_POST)) {
	$db = new Database();
	$stm = "UPDATE Products SET Status = :Status WHERE ProductsLink = :ProductsLink ;";
	$db->query($stm);
	$db->bind(":Status", $_POST['Status']);
	$db->bind(":ProductsLink", $_POST['link']);
	if ($db->execute()) {
		$i = true;
	}
	else {
		echo "<span style='color:red'>There was an error! Please try again!</span>";
	}
}
?>