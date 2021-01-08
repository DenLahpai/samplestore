<?php  
require_once "../functions.php";

if (isset($_POST['link'])) {
	$db = new Database();
	//updating the quantity
	$stm = "UPDATE Cart SET Qty = :Qty WHERE 
		ProductsLink = :link AND 
		SessionLink = :SessionLink
	;";
	$db->query($stm);
	$db->bind(":Qty", $_POST['Qty']);
	$db->bind(":link", $_POST['link']);
	$db->bind(":SessionLink", $_SESSION['link']);
	$db->execute();

	//getting data from the table
	$rows_Products = table_Products ('select_one', $_POST['link'], NULL, NULL, NULL, NULL, NULL);
	foreach ($rows_Products as $row_Products) {
		# code...
	}
	// checking if there is a discount
	if ($row_Products->Discount > 0) {
		// applying discount
		$discounted = $row_Products->Price - ($row_Products->Price * $row_Products->Discount / 100);
		echo $new_price = $discounted * $_POST['Qty'];	
	}
	else {
		echo $new_price = $row_Products->Price * $_POST['Qty'];		
	}
}
else {
	echo "Please insert proper number for Qty!";
}
?>