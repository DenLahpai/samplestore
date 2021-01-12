<?php  
require_once "../functions.php";
// print_r($_SESSION);
//checking password
$db = new Database();
$stm = "SELECT * FROM Users WHERE BINARY Username = :Username AND BINARY Password = :Password ;";
$db->query($stm);
$db->bind(":Username", $_SESSION['Username']);
$db->bind(":Password", md5($_REQUEST['Password']));
$rowCount = $db->rowCount();

if ($rowCount == 1) {
	//update the data in the table Users
	$stm = "UPDATE Users SET 
		Name = :Name, 
		Mobile = :Mobile,
		Email = :Email, 
		StoresName = :StoresName
		WHERE Id = :Id 
	;";
	$db->query($stm);
	$db->bind(":Name", trim($_POST['Name']));
	$db->bind(":Mobile", trim($_POST['Mobile']));
	$db->bind(":Email", trim($_POST['Email']));
	$db->bind(":StoresName", trim($_POST['StoresName']));
	$db->bind(":Id", $_SESSION['Id']);
	if ($db->execute()) {
		$i = true;
	}
	else {
		echo "<span style='color: red';>There was a connection error! Please try again!</span>";
	}
}
else {
	echo "<span style='color: red;'>Wrong Password!</span>";
}

?>