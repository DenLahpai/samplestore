<?php
require_once "../functions.php";

if (isset($_POST['link'])) {
	$db = new Database();
	$stm = "INSERT INTO Products_Views SET 
		ProductsLink = :link, 
		SessionLink = :SessionLink
	;";
	$db->query($stm);
	$db->bind(":link", $_POST['link']);
	$db->bind(":SessionLink", $_SESSION['link']);
	if ($db->execute()) {
		echo "OK";
		print_r($_SESSION);
	}

	else {
		echo 'no!';
		print_r($_SESSION);
	}
}

?>