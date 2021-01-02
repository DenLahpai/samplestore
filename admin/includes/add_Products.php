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
		Cat1 = :Cat1, 
		TargetsId = :TargetsId,
		Size = :Size,
		Description = :Description,
		Price = :Price, 
		Discount = :Discount,
		Color = :Color,
		UsersId = :UsersId
	;";
	$db->query($stm);
	$db->bind(":ProductsLink", $ProductsLink);
	$db->bind(":ProductsCode", trim($_REQUEST['ProductsCode']));
	$db->bind(":BrandsId", $_REQUEST['BrandsId']);
	$db->bind(":Name", trim($_REQUEST['Name']));
	$db->bind(":Cat1", trim($_REQUEST['Cat1']));
	$db->bind(":TargetsId", $_REQUEST['TargetsId']);
	$db->bind(":Size", $_REQUEST['Size']);
	$db->bind(":Color", trim($_REQUEST['Color']));
	$db->bind(":Price", trim($_REQUEST['Price']));
	$db->bind(":Description", trim($_REQUEST['Description']));
	$db->bind("Discount", trim($_REQUEST['Discount']));
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