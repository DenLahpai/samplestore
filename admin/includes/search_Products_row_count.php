<?php
require_once "../functions.php";
if (isset($_REQUEST['Search']) || !empty($_REQUEST['Search'])) {
    $Table = $_REQUEST['Table'];
    $Search = '%'.$_REQUEST['Search'].'%';

    //getting row Counts
    $db = new Database();
    $stm = "SELECT Products.Id FROM Products 
        LEFT OUTER JOIN Brands ON Products.BrandsId = Brands.Id
        WHERE CONCAT (
            Prodicts.ProductsCode, 
            Brands.BrandsName, 
            Brands.Country,
            Products.Name, 
            Products.Gender,
            Products.Size,
            Products.Color,
            Products.Price, 
            Products.Description,
            Products.Status
        ) LIKE :Search
    ;";
    $db->query($db);
    $db->bind(":Search", $Search);
    echo $db->rowCount(); 

    $db = null;
}
?>