<?php
require_once "../functions.php";
if (isset($_REQUEST['link'])) {
    if ($_FILES['Image'] || !empty($_FILES['Image'])) {
        $file = $_FILES['Image'];
        if ($file['error'] == 0) {
            //getting extension of the file
            $ext = explode('.', $file['name']);
            $file_ext = strtolower(end($ext));

            //setting new file name and file path
            $file_name = uniqid('', true).'.'.$file_ext;
            $file_path = "../../payments/".$file_name;

            //uploading the file
            move_uploaded_file($file['tmp_name'], $file_path);

            // updating data to the table
            $db = new Database();
            $stm = "INSERT INTO Payments SET 
                InvoicesLink = :InvoicesLink,
                Image = :Image
            ;";
            $db->query($stm);
            $db->bind(":InvoicesLink", $_REQUEST['link']);
            $db->bind(":Image", $file_name);
            if ($db->execute()) {
                $i = true;
            }
            else {
                echo "There was a connection error! Please try again!";
            }
         }
    }
}
?>