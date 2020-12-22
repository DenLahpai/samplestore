<?php 
require_once "../functions.php";

$db = new Database ();
$stm = "SELECT * FROM Brands ;";
$db->query($stm);
$rows = $db->resultset();
foreach ($rows as $row) {
	echo "<option value=\"$row->Id\">$row->BrandsName</option>";
}

?>