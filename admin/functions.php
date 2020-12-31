<?php 
require_once "conn.php";

//function to use data from the table Users 
function table_Users ($job, $var1, $var2, $var3, $order, $limit) {
    $db = new Database();
    switch ($job) {
        case 'check_with_two_param':
            # Checking if the users email and mobile provided in the forgot_password form are correct!
            $stm = "SELECT * FROM Users WHERE 
                $var1 = :var1 AND
                $var2 = :var2
            ;";
            $db->query($stm);
            $db->bind(':var1', $_POST["$var1"]);
            $db->bind(':var2', $_POST["$var2"]);
            return $db->rowCount();
            break;

        case 'select_users_with_one_column': 
            //var1 = Column name
            //var2 = data
            $stm = "SELECT * FROM Users WHERE $var1 = :var2 ;";
            $db->query($stm);
            $db->bind(':var2', $var2);
            return $db->resultset(); 
            break;

        case 'reset_password':
            $stm = "UPDATE Users SET Password = :Password WHERE
                Email = :Email AND
                DOB = :DOB
            ;";    
            $db->query($stm);
            $db->bind(':Password', md5($_REQUEST['Password']));
            $db->bind(':Email', $_REQUEST['Email']);
            $db->bind(':DOB', $_REQUEST['DOB']);
            if ($db->execute()) {
                $msg = "Your password has been updated successfully! Please <a href='index.html'>login</a> with your new password!";
                return $msg;
            }
            else {
                $msg = "<span style='color: red;'>There was a connection problem! Please try again!</span>";
                return $msg;
            }
            break;    
        
        default:
            # code...
            break;
    }
    $db = NULL;
}

// function to use data from the table Brands
function table_Brands ($job, $var1, $var2, $var3, $order, $limit, $offset) {
	$db = new Database();

	switch ($job) {
		case 'select_all':
			# code...
			$stm = "SELECT * FROM Brands $order LIMIT $limit OFFSET $offset ;";
			$db->query($stm);
			return $db->resultset();
			break;

		case 'row_count_before_insert':
			# var1 = BrandsName
			$stm = "SELECT * FROM Brands WHERE BrandsName = :BrandsName ;";
			$db->query($stm);
			$db->bind(":BrandsName", trim($_REQUEST["$var1"]));
			return $db->rowCount();
			break;

		case 'insert':
			$stm = "INSERT INTO Brands SET 
                BrandsName = :BrandsName,
                BrandsLink = :BrandsLink,
                Image = :var1,
                Country = :Country
            ;";
            $db->query($stm);
            $db->bind(":BrandsName", trim($_REQUEST['BrandsName']));
            $db->bind(":BrandsLink", uniqid('Brd_', true));
            $db->bind(":var1", $var1);
            $db->bind(":Country", trim($_REQUEST['Country']));
            if ($db->execute()) {
                return true;
            }
            else {
                return "<span style='color: red'>There was a connection error! Please try again! </span>";
            }
			break;	

        case 'select_by_link':
            # code...
            $stm = "SELECT * FROM Brands WHERE BrandsLink = :BrandsLink ;";
            $db->query($stm);
            $db->bind(":BrandsLink", $_REQUEST['link']);
            return $db->resultset();
            break;  

        case 'check_before_update':
            # code... 
            $stm = "SELECT * FROM Brands WHERE 
                BrandsName = :BrandsName AND
                BrandsLink != :BrandsLink
            ;";
            $db->query($stm);
            $db->bind(':BrandsName', trim($_REQUEST['BrandsName']));
            $db->bind(':BrandsLink', $_REQUEST['link']);
            return $db->rowCount();
            break;    

        case 'update':
            # var1 = Image
            $stm = "UPDATE Brands SET 
                BrandsName = :BrandsName,
                Country = :Country,
                Image = :var1
                WHERE BrandsLink = :BrandsLink
            ;";
            $db->query($stm);
            $db->bind(':BrandsName', trim($_REQUEST['BrandsName']));
            $db->bind(':Country', trim($_REQUEST['Country']));
            $db->bind(':var1', $var1);
            $db->bind(':BrandsLink', $_REQUEST['link']);
            if ($db->execute()) {
                return true;
            }
            else {
                return "<span style='color: red'>There was a connection error! Please try again! </span>";
            }
            break;

        case 'update_without_image':
            # code...
            $stm = "UPDATE Brands SET 
                BrandsName = :BrandsName,
                Country = :Country
                WHERE BrandsLink = :BrandsLink
            ;";
            $db->query($stm);
            $db->bind(':BrandsName', trim($_REQUEST['BrandsName']));
            $db->bind(':Country', trim($_REQUEST['Country']));            
            $db->bind(':BrandsLink', $_REQUEST['link']);
            if ($db->execute()) {
                return true;
            }
            else {
                return "<span style='color: red'>There was a connection error! Please try again! </span>";
            }
            break;
            
        case 'search':
            # var1 = :Search 
            $stm = "SELECT * FROM Brands WHERE CONCAT (
                BrandsName,
                Country
                ) LIKE :Search $order LIMIT $limit OFFSET $offset
            ;";
            $db->query($stm);
            $db->bind(':Search', $var1);
            return $db->resultset();
            break;

        case 'select_all_array':
            #code...
            $stm = "SELECT 
                Id, 
                BrandsName AS Name,
                Country,
                Image,
                Created, 
                Updated
                FROM Brands ;";
            $db->query($stm);
            return $db->resultsetArray();
            break;
            
        case 'search_all_array': 
            #code...
            $Search = '%'.$_REQUEST['Search'].'%';
            $stm = "SELECT 
                Id, 
                BrandsName AS Name, 
                Country,
                Image, 
                Created, 
                Updated
                FROM Brands WHERE CONCAT(
                    BrandsName, 
                    Country
                ) LIKE :Search
            ;";
            $db->query($stm);
            $db->bind(':Search', $Search);
            return $db->resultsetArray();
            break;     
		
		default:
			# code...
			break;
	}
}

// functions to use data from the table Products
function table_Products ($job, $var1, $var2, $var3, $order, $limit, $offset) {
    $db = new Database();

    switch ($job) {
        case 'select_all':
            # code...
            $stm = "SELECT 
                Products.Id, 
                Products.ProductsLink,
                Products.ProductsCode, 
                Products.MainImg, 
                Products.BrandsId, 
                Brands.BrandsName, 
                Brands.Country,
                Products.Name,
                Products.Cat1,
                Products.Gender, 
                Products.Size,
                Products.Description,
                Products.Price, 
                Products.Discount,
                Products.Status, 
                Products.Color, 
                Products.UsersId, 
                Products.Created, 
                Products.Updated
                FROM Products LEFT OUTER JOIN Brands ON Brands.Id = Products.BrandsId
                $order limit $limit OFFSET $offset 
            ;";
            $db->query($stm);
            return $db->resultset();
            break;

        case 'update_MainImg':
            # $var1 = MainImg
            $stm = "UPDATE Products SET MainImg = :var1 WHERE ProductsLink = :ProductsLink ;";
            $db->query($stm);
            $db->bind(":var1", $var1);
            $db->bind(":ProductsLink", $_REQUEST['link']);
            if ($db->execute()) {
                return true;
            }
            else {
                echo "<span style='color: red'>There was a connection problem! Please try again!</span>";
            }
            break;
        
        case 'select_by_link':
            $stm = "SELECT 
                Products.Id, 
                Products.ProductsLink,
                Products.ProductsCode, 
                Products.MainImg, 
                Products.BrandsId, 
                Brands.BrandsName, 
                Brands.Country,
                Products.Name,
                Products.Cat1, 
                Products.Gender,
                Products.Description, 
                Products.Size,
                Products.Price, 
                Products.Discount, 
                Products.Status, 
                Products.Color, 
                Products.UsersId, 
                Products.Created, 
                Products.Updated
                FROM Products LEFT OUTER JOIN Brands ON Brands.Id = Products.BrandsId
                WHERE Products.ProductsLink = :link
            ;";
            $db->query($stm);
            $db->bind(':link', $_REQUEST['link']);
            if ($db->execute()) {
                return $db->resultset();
            }
            break;

        case 'search':
            # var1 = Search
            $stm = "SELECT 
                Products.Id, 
                Products.ProductsLink,
                Products.ProductsCode, 
                Products.MainImg, 
                Products.BrandsId, 
                Brands.BrandsName, 
                Brands.Country,
                Products.Name,
                Products.Cat1,
                Products.Gender,
                Products.Description, 
                Products.Size,
                Products.Price, 
                Products.Discount, 
                Products.Status, 
                Products.Color, 
                Products.UsersId, 
                Products.Created, 
                Products.Updated
                FROM Products LEFT OUTER JOIN Brands ON Brands.Id = Products.BrandsId
                WHERE CONCAT(
                    Products.ProductsCode, 
                    Brands.BrandsName, 
                    Brands.Country, 
                    Products.Name, 
                    Products.Gender,
                    Products.Description,
                    Products.Size, 
                    Products.Color,
                    Products.Status
                ) LIKE :Search $order LIMIT $limit OFFSET $offset
            ;";
            $db->query($stm);
            $db->bind(":Search", $var1);
            return $db->resultset();
            break;
        
        default:
            # code...
            break;
    }
}

// function to use data from the table Images
function table_Images ($job, $var1, $var2, $var3, $order, $limit, $offset) {
    $db = new Database();
    
    switch ($job) {
        case 'check_before_insert':
            $stm = "SELECT * FROM Images WHERE ProductsLink = :ProductsLink ;";
            $db->query($stm);
            $db->bind(":ProductsLink", $_REQUEST['link']);
            return $db->rowCount();
            break;

        case 'insert':
            # var1 = Img
            $stm = "INSERT INTO Images SET 
                ProductsLink = :ProductsLink, 
                Img = :var1
            ;";
            $db->query($stm);
            $db->bind(":ProductsLink", $_REQUEST['link']);
            $db->bind(":var1", $var1);
            if ($db->execute()) {
                return true;
            }
            else {
                echo "<span style='color: red';>There was a connection error! Please try again!</span>";
            }
            break;

        case 'select_by_link':
            $stm = "SELECT * FROM Images WHERE ProductsLink = :ProductsLink ;";
            $db->query($stm);
            $db->bind(":ProductsLink", $_REQUEST['link']);
            return $db->resultset();
            break;    
        
        default:
            # code..
            break;    
    }
}

// function to create thumbnail
function CreateThumbnail($pic, $thumb, $thumbwidth, $quality = 100) {
    $im1=ImageCreateFromJPEG($pic);
    
    if(function_exists("exif_read_data")){
        $exif = exif_read_data($pic);
        if(!empty($exif['Orientation'])) {

            switch($exif['Orientation']) {
            case 8:
                $im1 = imagerotate($im1,90,0);
                break;
            case 3:
                $im1 = imagerotate($im1,180,0);
                break;
            case 6:
                $im1 = imagerotate($im1,-90,0);
                break;
            }
        }
    }
    $info = @getimagesize($pic);

    $width = $info[0];

    $w2=ImageSx($im1);
    $h2=ImageSy($im1);
    $w1 = ($thumbwidth <= $info[0]) ? $thumbwidth : $info[0]  ;

    $h1=floor($h2*($w1/$w2));
    $im2=imagecreatetruecolor($w1,$h1);

    imagecopyresampled ($im2,$im1,0,0,0,0,$w1,$h1,$w2,$h2);
    $path=addslashes($thumb);
    ImageJPEG($im2,$path,$quality);
    ImageDestroy($im1);
    ImageDestroy($im2);
}


?>