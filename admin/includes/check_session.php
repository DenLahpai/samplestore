<?php 
require_once "../functions.php";

if (isset($_SESSION['Username'])) {
	echo "<div class='company-name'>".$_SESSION['StoresName']."</div>";
	$today = date('Y-m-d');
	$seven_dbf = date("Y-m-d", strtotime($_SESSION['Expiry']."-"."7 days"));
	if ($today >= $seven_dbf) {
		echo "<div class='expiry' style='font-weight: bold;'>Exp: ".date('d-M-Y', strtotime($_SESSION['Expiry']))." &#10071; &#10071; &#10071;</div>";
	}
	else {
		echo "<div class='expiry'>Exp: ".date('d-M-Y', strtotime($_SESSION['Expiry']))."</div>";
	}
}
else {
	// two is return for no SESSION.
	echo "2";
}
?>