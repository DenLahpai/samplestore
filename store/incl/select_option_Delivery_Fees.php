<?php
require_once "../functions.php";
$db = new Database();
$stm = "SELECT * FROM Delivery_Fees ;";
$db->query($stm);
$rows = $db->resultset();
    echo "<option>Select Township City</option>";
foreach ($rows as $row) {
    echo "<option value=\"$row->Delivery_FeesLink\">".$row->Town." ".$row->Township."</option>";
}
?>