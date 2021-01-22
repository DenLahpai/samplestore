<?php  
require_once "../functions.php";

if (isset($_POST)){
	$db = new Database();
	$stm = "INSERT INTO Orders_List SET 
		OrdersLink = :OrdersLink,
		ProductsLink = :ProductsLink,
		Qty = :Qty,
		Subtotal = :Subtotal
	;";
	$db->query($stm);
	$db->bind(":OrdersLink", $_POST['OrdersLink']);
	$db->bind(":ProductsLink", $_POST['ProductsLink']);
	$db->bind(":Qty", $_POST['Qty']);
	$db->bind(":Subtotal", $_POST['Subtotal']);
	if ($db->execute()) {
		return true;
	}
	else {
		echo "<span style='color:red; '>There was a connection error! Please try again!</span>";
	}
}
?>