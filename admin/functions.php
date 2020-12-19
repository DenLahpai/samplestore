<?php 
require_once "../../conn.php";

// function to use data from the table Brands
function table_Brands ($job, $var1, $var2, $var3, $order, $limit, $offset) {
	$db = new Database();

	switch ($job) {
		case 'select_all':
			# code...
			$stm = "SELECT * FROM Brands $order LIMIT $limit OFFSET $offset ;";
			$db->query($stm);
			return $db->resultset();
			break;
		
		default:
			# code...
			break;
	}
}

?>