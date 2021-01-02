<?php
require_once "../functions.php";


if (isset($_REQUEST['Img'])) {
    $db = new Database ();
    $stm = "UPDATE Images SET ProductsLink = 'XXX' WHERE Img = :Img ;";
    $db->query($stm);
    $db->bind(":Img", $_REQUEST['Img']);
    if ($db->execute()) {
        $file = "../../images/".$_REQUEST['Img'];
        unlink($file);
        $ext = explode('.', $_REQUEST['Img']);
        $file_ext = end($ext);

        if ($file_ext != 'png') {
            $thumb = "../../images/thumbnails/".$_REQUEST['Img'];
            unlink($thumb);    
        }
        
        die();
    }
    else {
        echo "<span style='color: red'>There was a connection error! Please try again!</span>";
    }       
}
?>
