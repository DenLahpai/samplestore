<?php 
session_start();
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
                Products.TargetsId, 
                Targets.TargetsCode, 
                Targets.Target, 
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
                LEFT OUTER JOIN Targets ON Products.TargetsId = Targets.Id
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
                Products.TargetsId,
                Targets.TargetsCode,
                Targets.Target,
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
                LEFT OUTER JOIN Targets ON Products.TargetsId = Targets.Id
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
                Products.TargetsId,
                Targets.TargetsCode,
                Targets.Target, 
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
                LEFT OUTER JOIN Targets ON Products.TargetsId = Targets.Id
                WHERE CONCAT(
                    Products.ProductsCode, 
                    Brands.BrandsName, 
                    Brands.Country, 
                    Products.Name, 
                    Products.Cat1,
                    Targets.Target,
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

        case 'select_one':
            # var1 = ProductsLink
            $stm = "SELECT
                Products.ProductsCode, 
                Brands.BrandsName,
                Brands.Country, 
                Products.Name,
                Products.Size, 
                Products.Color,
                Products.Status 
                FROM Products LEFT OUTER JOIN Brands ON Products.BrandsId = Brands.Id
                WHERE ProductsLink = :ProductsLink
            ;"; 
            $db->query($stm);
            $db->bind(":ProductsLink", $var1);
            return $db->resultset();
            break;
        
        default:
            # code...
            break;
    }
}

//function to use data from the table Delivery_Fees
function table_Delivery_Fees ($job, $var1, $var2, $var3, $order, $limit, $offset) {
    $db = new Database();

    switch ($job) {
        case 'select_one':
            # $var1 = $Deliver_FeesLink
            $stm = "SELECT * FROM Delivery_Fees WHERE Delivery_FeesLink = :var1 ;";
            $db->query($stm);
            $db->bind(":var1", $var1);
            return $db->resultset();
            break;
        
        default:
            # code...
            break;
    }
}

//function to use data from the table Orders 
function table_Orders ($job, $var1, $var2, $var3, $order, $limit, $offset) {
    $db = new Database();

    switch ($job){
    	case 'select_all':
            $stm = "SELECT * FROM Orders $order LIMIT $limit OFFSET $offset ;";
    	    $db->query($stm);
    	    return $db->resultset();
    	    break;

        case 'search':
            $stm = "SELECT
                Orders.OrdersLink, 
                Orders.CustomersLink,
                Orders.InvoicesLink, 
                Orders.Status, 
                Orders.Created,
                Orders.Updated,
                Customers.Title,
                Customers.Name AS CustomersName,
                Customers.Email,
                Customers.Mobile,
                Customers.Address, 
                Customers.Town,
                Customers.Note,
                Orders_List.Qty,
                Orders_List.Subtotal,
                Products.ProductsCode,
                Brands.BrandsName, 
                Products.Name AS ProductsName, 
                Products.Size, 
                Products.Color,
                Products.Description
                FROM Orders
                LEFT OUTER JOIN Orders_List ON Orders.OrdersLink = Orders_List.OrdersLink
                LEFT OUTER JOIN Customers ON Orders.CustomersLink = Customers.CustomersLink
                LEFT OUTER JOIN Products ON Orders_List.ProductsLink = Products.ProductsLink
                LEFT OUTER JOIN Brands ON Products.BrandsId = Brands.Id
                WHERE CONCAT (
                    Customers.Name, 
                    Customers.Email,
                    Customers.Mobile,
                    Customers.Address,
                    Customers.Town,
                    Customers.Note,
                    Brands.BrandsName, 
                    Products.Name,
                    Products.Size,
                    Products.Color,
                    Products.Description
                ) LIKE :Search
            ;";
            $db->query($stm);
            $db->bind(":Search", $var1);
            return $db->resultset();
            break;

        case 'select_one':
            # $var1 = OrdersLink
            $stm = "SELECT * FROM Orders WHERE OrdersLink = :link ;";
            $db->query($stm);
            $db->bind(":link", $var1);
            return $db->resultset();
            break;

        default:
            # code... 
            break;    
    }
}

//function to use data from the table Customers
function table_Customers ($job, $var1, $var2, $var3, $order, $limit, $offset) {
    $db = new Database();

    switch ($job) {
        case 'select_one':
            # $var1 = CustomersLink
            $stm = "SELECT * FROM Customers WHERE CustomersLink = :CustomersLink ;";
            $db->query($stm);
            $db->bind(":CustomersLink", $var1);
            if ($db->execute()) {
                return $db->resultset();
            }
            break;
        
        default:
            # code...
            break;
    }
}

//function to use data from the table Orders_List
function table_Orders_List ($job, $var1, $var2, $var3, $order, $limit, $offet) {
    $db = new Database();

    switch ($job) {
        case 'select_one_order':
            # $var1 = $OrdersLink
            $stm = "SELECT 
                Orders_List.Qty,
                Orders_List.Subtotal,
                Products.ProductsCode, 
                Products.Name,
                Brands.BrandsName,
                Products.Size, 
                Products.Color
                FROM Orders_List LEFT OUTER JOIN Products ON Orders_List.ProductsLink = Products.ProductsLink
                LEFT OUTER JOIN Brands ON Products.BrandsId = Brands.Id  
                WHERE Orders_List.OrdersLink = :OrdersLink
            ;";
            $db->query($stm);
            $db->bind(":OrdersLink", $var1);
            return $db->resultset();
            break;
        
        default:
            # code...
            break;
    }
}

// functoin to use data from the table Invoices 
function table_Invoices ($job, $var1, $var2, $var3, $order, $limit, $offset) {
    $db = new Database();

    switch ($job) {
        case 'select_one':
            # $var1 = $InvoicesLink
            $stm = "SELECT * FROM Invoices WHERE InvoicesLink = :InvoicesLink ;";
            $db->query($stm);
            $db->bind(":InvoicesLink", $var1);
            return $db->resultset();
            break;

        case 'select_all':
            # code...
            $stm = "SELECT 
                Invoices.InvoicesLink,
                Invoices.InvoiceNo,
                Invoices.Total,
                Invoices.Status,
                Invoices.Method,
                Invoices.Created,
                Invoices.Updated,
                Invoices.PaidOn
                FROM Invoices $order LIMIT $limit OFFSET $offset
            ;";
            $db->query($stm);
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

//function to use data from the table Targats 
function table_Targets ($job, $var1, $var2, $var3, $order, $limit, $offset) {
    $db = new Database();

    switch ($job) {
        case 'select_all':
            # code...
            $stm = "SELECT * FROM Targets ;";
            $db->query($stm);
            return $db->resultset();
            break;
        
        default:
            # code...
            break;
    }
}

// function to use data from the table Payments
function table_Payments ($job, $var1, $var2, $var3, $order, $limit, $offset) {
    $db = new Database();

    switch ($job) {
        case 'select_all':
            # code...
            $stm = "SELECT Payments.InvoicesLink, 
                Payments.Image, 
                Invoices.InvoiceNo,
                Invoices.Status,
                Invoices.Method,
                Invoices.PaidOn,
                Invoices.Created,
                Invoices.Updated
                FROM Payments LEFT OUTER JOIN Invoices ON Invoices.InvoicesLink = Payments.InvoicesLink
                $order LIMIT $limit OFFSET $offset;
            ;";
            $db->query($stm);
            return $db->resultset();
            break;

        case 'select_one':
            # var1 = InvoicesLink
            $stm = "SELECT Payments.InvoicesLink, 
                Payments.Image, 
                Invoices.InvoiceNo,
                Invoices.Status,
                Invoices.Method,
                Invoices.PaidOn,
                Invoices.Created,
                Invoices.Updated
                FROM Payments LEFT OUTER JOIN Invoices ON Invoices.InvoicesLink = Payments.InvoicesLink
                WHERE Payments.InvoicesLink = :InvoicesLink
            ;";
            $db->query($stm);
            $db->bind(":InvoicesLink", $var1);
            return $db->resultset();
            break;    
        
        default:
            # code...
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
