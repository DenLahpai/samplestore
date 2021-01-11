<?php  
require_once "functions.php";

if (isset($_POST)) {
	$db = new Database();
	$stm = "SELECT * FROM Users WHERE 
		BINARY Username = :Username AND
		BINARY Password = :Password AND
		StoresCode = :StoresCode
	;";
	$db->query($stm);
	$db->bind(":Username", $_POST['Username']);
	$db->bind(":Password", md5($_POST['Password']));
	$db->bind(":StoresCode", $_POST['StoresCode']);
	$r = $db->rowCount();
	$rows = $db->resultsetArray();

	if ($r == 1) {
		foreach ($rows as $_SESSION) {
			
		}
		// zero is returned for no error!
		echo 0;
		
	} 
	else {
		echo "<span style='color: red'>Wrong username, password or store code!</span><br>";
		echo "Forgot your password? <a href='forgot_password.html'>Click here</a> to reset!";
	}
}
else {
	echo "<span style='color: red;'>There was a connection error! Please try again!</span>";
}


?>