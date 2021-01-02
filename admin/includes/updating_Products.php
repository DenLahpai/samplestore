<?php
require_once "../functions.php";

if (isset($_REQUEST)) {
    $db = new Database();
    $stm = "UPDATE Products SET 
        ProductsCode = :ProductsCode, 
        BrandsId = :BrandsId, 
        Name = :Name, 
        Cat1 = :Cat1,
        TargetsId = :TargetsId,
        Size = :Size,
        Price = :Price, 
        Discount = :Discount,          
        Color = :Color
        WHERE ProductsLink = :ProductsLink
    ;";
    $db->query($stm);
    $db->bind("ProductsCode", trim($_REQUEST['ProductsCode']));
    $db->bind(":BrandsId", $_REQUEST['BrandsId']);
    $db->bind(":Name", trim($_REQUEST['Name']));
    $db->bind(":Cat1", trim($_REQUEST['Cat1']));
    $db->bind(":TargetsId", $_REQUEST['TargetsId']);
    $db->bind(':Size', $_REQUEST['Size']);
    $db->bind(":Price", $_REQUEST['Price']);
    $db->bind(":Discount", $_REQUEST['Discount']);
    $db->bind(':Color', trim($_REQUEST['Color']));
    $db->bind(':ProductsLink', $_REQUEST['ProductsLink']);
    if ($db->execute()) {
        $i = true;
    }
    else {
        echo "<span style='color: red'>There was a connection error! Please try again!</span>";
    }    
}
?>