<?php  
require_once "../functions.php";
if (isset($_REQUEST)) {

	// generating products link
	$ProductsLink = uniqid('Prd_', true);

	$db = new Database();
	$stm = "INSERT INTO Products SET 
		ProductsLink = :ProductsLink, 
		ProductsCode = :ProductsCode,
		BrandsId = :BrandsId, 
		Name = :Name, 
		Gender = :Gender, 
		Size = :Size, 
		Color = :Color,
		UsersId = :UsersId
	;";
	$db->query($stm);
	$db->bind(":ProductsLink", $ProductsLink);
	$db->bind(":ProductsCode", trim($_REQUEST['ProductsCode']));
	$db->bind(":BrandsId", $_REQUEST['BrandsId']);
	$db->bind(":Name", trim($_REQUEST['Name']));
	$db->bind(":Gender", $_REQUEST['Gender']);
	$db->bind(":Size", $_REQUEST['Size']);
	$db->bind(":Color", trim($_REQUEST['Color']));
	$db->bind(":UsersId", $_SESSION['Id']);
	if ($db->execute()) {
		echo 0;
	}
	else {
		echo "<span style='color: red'>There was a connection problem! Please try again!</span>";
	}
	
}
else {
	echo "<span style='color: red'>There was a connection problem! Please try again!</span>";
}

?>