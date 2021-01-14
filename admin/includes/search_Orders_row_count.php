<?php  
require_once "../functions.php";
if (isset($_REQUEST['Search']) || !empty($_REQUEST['Search'])) {
	$Table = $_REQUEST['Table'];
	$Search = '%'.$_REQUEST['Search'].'%';

	//getting row Counts
	$db = new Database();
	$stm = "SELECT Orders.Id FROM Orders 
		LEFT OUTER JOIN Customers ON Orders.CustomersLink = Customers.CustomersLink
		LEFT OUTER JOIN Orders_List ON Orders.OrdersLink = Orders_List.OrdersLink
		LEFT OUTER JOIN Products ON Orders_List.ProductsLink = Products.ProductsLink
		LEFT OUTER JOIN Brands ON Products.BrandsId = Brands.Id
		WHERE CONCAT(
			Products.ProductsCode,
			Products.Name,
			Brands.BrandsName, 
			Products.Color,
			Products.Description, 
			Customers.Name, 
			Customers.Mobile,
			Customers.Address,
			Customers.Town, 
			Customers.Note
		) LIKE :Search
	;";
	$db->query($stm);
	$db->bind(":Search", $Search);
	echo $db->rowCount();

	$db = null;
}
?>