<?php 
require_once "../functions.php";

if ($_SESSION['link']) {

	// generating OrdersLink
	$OrdersLink = uniqid('Ord_', true);

	//generating CustomersLink
	$CustomersLink = uniqid('Ctm_', true);

	//generating InvoiceLink
	$InvoicesLink = uniqid('Inv_', true);

	//inserting data to the table Orders 
	$db = new Database();
	$stm = "INSERT INTO Orders SET 
		SessionLink = :SessionLink,
		OrdersLink = :OrdersLink,
		CustomersLink = :CustomersLink,
		InvoicesLink = :InvoicesLink		
	;";
	$db->query($stm);
	$db->bind(":SessionLink", $_SESSION['link']);
	$db->bind(":OrdersLink", $OrdersLink);
	$db->bind(":CustomersLink", $CustomersLink);
	$db->bind(":InvoicesLink", $InvoicesLink);
	if ($db->execute()) {
		
		// generating InvoiceNo
		$InvoiceNo = table_Invoices ('generate_invoice_no', NULL, NULL, NULL, NULL, NULL, NULL);
		//Inserting data to the table Invoices 
		$stm = "INSERT INTO Invoices SET 
			InvoicesLink = :InvoicesLink,
			InvoiceNo = :InvoiceNo, 
			Total = :Total
		;";
		$db->query($stm);
		$db->bind(":InvoicesLink", $InvoicesLink);
		$db->bind(":InvoiceNo", $InvoiceNo);
		$db->bind(":Total", $_POST['Total']);
		if ($db->execute()) {
			echo $OrdersLink;
		}
	}

	// Note: nothing is returned if there is an error! 
}
?>