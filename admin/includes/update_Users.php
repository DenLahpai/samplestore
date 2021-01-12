<?php  
require_once "../functions.php";

//getting data from the table Users 
$rows_Users = table_Users ('select_users_with_one_column','Id', $_SESSION['Id'], NULL, NULL, NULL, NULL);
foreach ($rows_Users as $row_Users) {
	# code...
}
?>
<div class="form">
	<form action="#" id="Users-form" method="post">
		<div>
			<input type="text" name="Name" id="Name" value="<? echo $row_Users->Name; ?>">
		</div>
		<div>
			<input type="text" name="Mobile" id="Mobile" value="<? echo $row_Users->Mobile; ?>">
		</div>
		<div>
			<input type="text" name="Email" id="Email" value="<? echo $row_Users->Email; ?>" onblur="validateEmail(this.value)">
		</div>
		<div>
			<input type="text" name="StoresName" id="StoresName" value="<? echo $row_Users->StoresName; ?>">
		</div>
		<div>
			<input type="password" name="Password" id="Password" placeholder="Pls enter your current password!">
		</div>
		<div>
			<button type="button" id="btn-submit" class="medium-button" onclick="updateUsers();">Submit</button>
		</div>
	</form>
</div>