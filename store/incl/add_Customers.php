<?php  
require_once "../functions.php";
if (isset($_POST)) {
	//generating CustomersLink
	$rows_Orders = table_Orders ('select_one', $_REQUEST['link'], NULL, NULL, NULL, NULL, NULL);
	foreach ($rows_Orders as $row_Orders) {
		# code...
	}

	//getting data from the table Delivery_Fees,
	$rows_Delivery_Fees = table_Delivery_Fees ('select_one', $_POST['Delivery_FeesLink'], NULL, NULL, NULL, NULL, NULL);
	foreach ($rows_Delivery_Fees as $row_Delivery_Fees) {
		# code... 
	}

	$Town = $row_Delivery_Fees->Township." ".$row_Delivery_Fees->Town;
		
	// adding data to the table Customers
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
	$db->bind(":Town", $Town);
	$db->bind(":Note", trim($_POST['Note']));
	if ($db->execute()) {
		$i = true;
	}
	else {
		echo "There was a connection error! Please try again!";
	}

	// adding data to the table Invoiced_Delivery_Fees;
	$stm = "INSERT INTO Invoiced_Delivery_Fees SET 
		InvoicesLink = :InvoicesLink,
		Delivery_FeesLink = :Delivery_FeesLink,
		Fees = :Fees
	;";
	$db->query($stm);
	$db->bind(":InvoicesLink", $row_Orders->InvoicesLink);
	$db->bind(":Delivery_FeesLink", $_POST['Delivery_FeesLink']);
	$db->bind(":Fees", $row_Delivery_Fees->Fees);
	if ($db->execute()) {
		$i = true;
	}
	else {
		echo "<span>There was a connection error! Please try again!</span>";
	}
}
?>