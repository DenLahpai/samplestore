<?php  
require_once "../functions.php";
if (isset($_POST['link'])) {
	$db = new Database();
	$stm = "UPDATE Cart SET Status = 0 WHERE 
		ProductsLink = :link AND
		SessionLink = :SessionLink
	;";
	$db->query($stm);
	$db->bind(":link", $_POST['link']);
	$db->bind(":SessionLink", $_SESSION['link']);
	if ($db->execute()) {
		return true;
	}
	else {
		echo "There was a connectin erro! Please try again!";
	}
}
?>