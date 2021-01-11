<?php
require_once "../functions.php";
if (isset($_REQUEST['Search']) || !empty($_REQUEST['Search'])) {
    $Table = $_REQUEST['Table'];
    $Search = '%'.$_REQUEST['Search'].'%';

    //getting row Counts
    $db = new Database();
    $stm = "SELECT Products.Id FROM Products 
        LEFT OUTER JOIN Brands ON Products.BrandsId = Brands.Id
        LEFT OUTER JOIN Targets ON Products.TargetsId = Targets.Id
        WHERE CONCAT (
            Products.ProductsCode, 
            Brands.BrandsName, 
            Brands.Country,
            Products.Name, 
            Products.Cat1,
            Targets.Target,
            Products.Size,
            Products.Color,
            Products.Price, 
            Products.Description,
            Products.Status
        ) LIKE :Search
    ;";
    $db->query($stm);
    $db->bind(":Search", $Search);
    echo $db->rowCount(); 

    $db = null;
}
?>