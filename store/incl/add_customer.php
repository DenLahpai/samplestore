<?php  
require_once "../functions.php";
if (isset($_POST)) {
	//generating CustomersLink
	$rows_Orders = table_Orders ('select_one', $_REQUEST['link'], NULL, NULL, NULL, NULL, NULL);
	foreach ($rows_Orders as $row_Orders) {
		# code...
	}

	$db = new Database();
	$stm = "INSERT INTO Customers SET 
		CustomersLink = :CustomersLink,
		OrdersLink = :OrdersLink,
		Title = :Title,
		Name = :Name, 
		Email = :Email, 
		Mobile = :Mobile, 
		Address = :Address,
		Town = :Town,
		Note = :Note 
	;";
	$db->query($stm);
	$db->bind(":CustomersLink", $row_Orders->CustomersLink);
	$db->bind(":OrdersLink", $_REQUEST['link']);
	$db->bind(":Title", $_POST['Title']);
	$db->bind(":Name", trim($_POST['Name']));
	$db->bind(":Email", trim($_POST['Email']));
	$db->bind(":Mobile", trim($_POST['Mobile']));
	$db->bind(":Address", trim($_POST['Address']));
	$db->bind(":Town", trim($_POST['Town']));
	$db->bind(":Note", trim($_POST['Note']));
	if ($db->execute()) {
		return true;
	}
	else {
		echo "There was a connection error! Please try again!";
	}
}
?>