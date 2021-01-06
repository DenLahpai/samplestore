<?php
require_once "../functions.php";


if (empty($_SESSION['link'])) {
	$d = date('dM');
	$_SESSION['link'] = uniqid($d.'_', true);
	$ip = $_SERVER['REMOTE_ADDR'];
	insertSession($ip);
}

if (isset($_SESSION['link'])) {
	$db = new Database();
	
	//check whether the items is in the chart
	$stm = "SELECT * FROM Cart WHERE 
		SessionLink = :SessionLink AND 
		ProductsLink = :link
	;";
	$db->query($stm);
	$db->bind(":SessionLink", $_SESSION['link']);
	$db->bind(":link", $_POST['link']);
	$rowCount = $db->rowCount();

	if ($rowCount == 0) {
		//inserting data to the table Cart
		$stm = "INSERT INTO Cart SET 
		SessionLink = :SessionLink,
		ProductsLink = :link
		;";
		$db->query($stm);
		$db->bind(":SessionLink", $_SESSION['link']);
		$db->bind(":link", $_POST['link']);
		if ($db->execute()) {
			echo "The item has been added in your cart!";
		}
	}

	else {
		echo "The item is already in your cart! You can adjust the quatity of your items in your cart before check out!";
	}
}
?>