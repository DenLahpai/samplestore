<?php
require_once "../functions.php";
if (isset($_REQUEST['Password'])) {
    echo table_Users ('reset_password', NULL, NULL, NULL, NULL, NULL);
}

else {
    echo "<span style='color: red;'>There was an error! Please try again!</span>";
}

?>