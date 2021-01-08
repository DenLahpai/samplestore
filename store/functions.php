<?php
session_start();
require_once "conn.php";

// function to get sessions data 
function insertSession ($ip, $session) {
    $db = new Database();

    $stm = "INSERT INTO Sessions SET 
        SessionLink = :SessionLink, 
        Ip = :Ip
    ;";
    $db->query($stm);
    $db->bind(":SessionLink", $session);
    $db->bind(":Ip", $ip);
    $db->execute();
}

// function to get data from the table Products
function table_Products ($job, $var1, $var2, $var3, $order, $limit, $offset) {
	$db = new Database();
	switch ($job) {
		case 'select_one':
			# var1 = ProductsLink
			$stm = "SELECT 
				Products.ProductsCode, 
				Products.MainImg, 
				Brands.BrandsName,
				Brands.Country, 
				Products.Name,
				Products.Cat1, 
				Products.TargetsId,
				Targets.TargetsCode, 
				Targets.Target, 
				Products.Size, 
				Products.Color,
				Products.Price,
				Products.Discount,
				Products.Description, 
				Products.Status
				FROM Products LEFT OUTER JOIN Brands ON Products.BrandsId = Brands.Id 
				LEFT OUTER JOIN Targets ON Products.TargetsId = Targets.Id 
				WHERE Products.ProductsLink = :ProductsLink 
			;";
			$db->query($stm);
			$db->bind(":ProductsLink", $var1);
			return $db->resultset();
			break;

		case 'row_Count_for_each_cat1':
			# var1 = Cat1
			$stm = "SELECT * FROM Products WHERE Cat1 = :var1 ;";
			$db->query($stm);
			$db->bind(":var1", $var1);
			return $db->rowCount();
			break;	

		case 'row_Count_for_each_TargetsId':
			# $var1 = TargetsId 		
			$stm = "SELECT * FROM Products WHERE TargetsId = :var1 ;";
			$db->query($stm);
			$db->bind(":var1", $var1);
			return $db->rowCount();
			break;
		
		default:
			# code...
			break;
	}
}

//function to get data from the table Orders
function table_Orders ($job, $var1, $var2, $var3, $order, $limit, $offet) {

	$db = new Database();

	switch ($job) {
		case 'insert':
			# var1 = OrdersLink
			# var2 = CustomersLink
			# var3 = ProductsLink
			$stm = "INSERT INTO Orders SET 
				OrdersLink = :OrdersLink,
				CustomersLink = :CustomersLink,
				ProductsLink = :ProductsLink
			;";
			$db->query($stm);
			$db->bind(":OrdersLink", $var1);
			$db->bind(":CustomersLink", $var2);
			$db->bind(":ProductsLink", $var3);
			if ($db->execute()) {
				$i = true;
			}
			else {
				echo "<span style='color: red'>There was a connection erro! Please try again!</span>";
			}
			break;
		
		default:
			# code...
			break;
	}
}
?>