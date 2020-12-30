<?php
require_once "../functions.php";
if (isset($_FILES['Image']) || !empty($_FILES['Image'])) {
    $file = $_FILES['Image'];
    if ($file['error'] == 0) {
        //getting extension of the file
        $ext = explode('.', $file['name']);
        $file_ext = strtolower(end($ext));

        //setting new file name and file path
        $file_name = uniqid('', true).'.'.$file_ext;
        $file_path = "../../images/".$file_name;

        //uploading the file
        move_uploaded_file($file['tmp_name'], $file_path);

        // creating and uploading thumbnail if image type is jpg or jpeg
        // no thumb created for png as CreateThumbnail would not allow png files.
        $extensions = array ('jpg', 'jpeg');
        if (in_array($file_ext, $extensions)) {
            $thumb_path = "../../images/thumbnails/".$file_name;
            CreateThumbnail($file_path, $thumb_path, 300, $quality = 100);
        }

        // updating to the table
        if ($_REQUEST['src'] == 'main') {
            $i = table_Products ('update_MainImg', $file_name, NULL, NULL, NULL, NULL, NULL);
                        
        }
        elseif ($_REQUEST['src'] == 'not_main') {
            $rowCount = table_Images ('check_before_insert', NULL, NULL, NULL, NULL, NULL, NULL);
            if ($rowCount >= 5) {
                echo "<span style='color: red'>The limit of images for each product is 6 including main image.</span>";
                $i = false;
            }
            else {
                $i = table_Images ('insert', $file_name, NULL, NULL, NULL, NULL, NULL);
                if ($i == true) {
                    return true;
                }
                else {
                    echo $i;
                }
            }
        }

        else {
            # code...
        }       
    }
    else {
        echo "<span style='color: red'>There was an error! Please try again!</span>";
    }
}
else {
    echo "<span style='color: red'>Please choose an image to upload!</span>";
}
?>