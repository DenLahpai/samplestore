<?php  
require_once "../functions.php";
if (isset($_POST)) {
	//generating CustomersLink
	$d = date("d-M");
	$CustomersLink = uniqid("Cl_".$d."_", true);

	$db = new Database();
	$stm = "INSERT INTO Customers SET 
		CustomersLink = :CustomersLink,
		SessionLink = :SessionLink,
		Title = :Title,
		Name = :Name, 
		Email = :Email, 
		Mobile = :Mobile, 
		Address = :Address,
		Town = :Town,
		Note = :Note 
	;";
	$db->query($stm);
	$db->bind(":CustomersLink", $CustomersLink);
	$db->bind(":SessionLink", $_SESSION['link']);
	$db->bind(":Title", $_POST['Title']);
	$db->bind(":Name", trim($_POST['Name']));
	$db->bind(":Email", trim($_POST['Email']));
	$db->bind(":Mobile", trim($_POST['Mobile']));
	$db->bind(":Address", trim($_POST['Address']));
	$db->bind(":Town", trim($_POST['Town']));
	$db->bind(":Note", trim($_POST['Note']));
	if ($db->execute()) {

		//generating OrdersLink
		$OrdersLink = uniqid("Ord_".$d."_", true);

		//getting data from the table Cart 
		$stm = "SELECT * FROM Cart WHERE 
			SessionLink = :SessionLink 
			AND Status = 1 
		;";
		$db->query($stm);
		$db->bind(":SessionLink", $_SESSION['link']);
		$rows_Cart = $db->resultset();

		foreach ($rows_Cart as $row_Cart) {
			table_Orders ('insert', $OrdersLink, $CustomersLink, $row_Cart->ProductsLink, NULL, NULL, NULL);
		}
		
	}
}
?>