<?php  
require_once "../functions.php";

//checking if the password is correct
$db = new Database();
$stm = "SELECT * FROM Users WHERE 
	BINARY Username = :Username AND 
	BINARY Password = :Password 
;";
$db->query($stm);
$db->bind(":Username", $_SESSION['Username']);
$db->bind(":Password", md5($_REQUEST['Password']));
$rowCount = $db->rowCount();


if ($rowCount == 1) {
	// checking if 2 passwords match
	if ($_POST['new_password1'] == $_POST['new_password2']) {
		//checking if the string length of the new password
		$new_password = trim($_POST['new_password1']);
		$l = strlen(trim($new_password));
		if ($l < 6) {
			echo "<span style='color: red;'>Your password must have at least 6 letters!</span>";
		}
		else {
			// updating data to the table Users
			$stm = "UPDATE Users SET Password = :Password WHERE Username = :Username ;";
			$db->query($stm);
			$db->bind(":Password", trim(md5($new_password)));
			$db->bind(":Username", $_SESSION['Username']);
			if ($db->execute()) {
				echo "<span style='color: blue'>Your password has been updated successfully!</span>";
			}
			else {
				echo "<span style='color: red;'>There was a connectoin error! Please try again!</span>";
			}
		}
	}
	else {
		echo "<span style='color: red;'>Your new passwords don't match!</span>";
	}
}
else {
	echo "<span style='color: red;'>Wrong Password!</span>";
}
?>