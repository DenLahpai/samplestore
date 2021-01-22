<?php
require_once "../functions.php";
$db = new Database();
$stm = "SELECT * FROM Delivery_Fees WHERE Delivery_FeesLink = :link ;";
$db->query($stm);
$db->bind(":link", $_POST['link']);
$rows = $db->resultset();
foreach ($rows as $row) {
    echo "<td></td>";
    echo "<td>Delivery Fees: ".$row->Town." ".$row->Township."<br>";
    echo "(".$row->Remark.")";
    echo "</td>";
    echo "<td></td>";
    echo "<td><input type='number' class=\"subtotal\" id=\"subtotal0\" value=\"$row->Fees\" readonly></td>";
}

?>