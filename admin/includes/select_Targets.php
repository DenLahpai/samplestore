<?php  
require_once "../functions.php";

$rows_Targets = table_Targets ('select_all', NULL, NULL, NULL, NULL, NULL, NULL);
foreach ($rows_Targets as $row_Targets) {
	if ($_REQUEST['selected'] == $row_Targets->Id) {
		echo "<option value=\"$row_Targets->Id\" selected>".$row_Targets->TargetsCode.' - '.$row_Targets->Target."</option>";
	}
	else {
		echo "<option value=\"$row_Targets->Id\">".$row_Targets->TargetsCode.' - '.$row_Targets->Target."</option>";
	}
}
?>
