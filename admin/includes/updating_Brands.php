<?php
require_once "../functions.php";

//checking if BrandsName is set 
if (isset($_REQUEST['BrandsName'])) {
    //checking for duplicate BrandsName
    $rowCount = table_Brands ('check_before_update', NULL, NULL, NULL, NULL, NULL, NULL);
    if ($rowCount > 0) {
        // duplicate entry found
        echo "<span style='color: red;'>The brand already exists in your database!</span>";
    }
    else {
        // since no duplicate entry is found
        if (isset($_FILES['Image']) || !empty($_FILES['Image'])) {
            // if there is a file 
            $file = $_FILES['Image'];
            if ($file['error'] == 0) {
                //getting extension of the file
                $ext = explode('.', $file['name']);
                $file_ext = strtolower(end($ext));
    
                //setting new file name and file path
                $file_name = uniqid('', true).'.'.$file_ext;
                $file_path = "../../logos/".$file_name;
    
                //uploading the file
                move_uploaded_file($file['tmp_name'], $file_path);
                
                // creating and uploading thumbnail if image type is jpg or jpeg
                // no thumb created for png as CreateThumbnail would not allow png files.
                $extensions = array ('jpg', 'jpeg');
                if (in_array($file_ext, $extensions)) {
                    $thumb_path = "../../logos/thumbnails/".$file_name;
                    CreateThumbnail($file_path, $thumb_path, 300, $quality = 100);
                } 

                // inserting to the table Brands with Image
                $i = table_Brands ('update', $file_name, NULL, NULL, NULL, NULL, NULL);
                if ($i == true) {
                    return true;
                }
                else {
                    echo $i;
                }
            }                    
        }
        else {
            // if no files updating without images
            $i = table_Brands ('update_without_image', NULL, NULL, NULL, NULL, NULL, NULL);
            if ($i == true) {
                return true;
            }
            else {
                echo $i;
            }
        }
    }
}
?>