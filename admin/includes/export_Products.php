<?php
header ('Content-Type: text/csv; charset=utf-8');
header ('Content-Disposition: attachment; filename=Products.csv');
$output = fopen("php://output", "w");

require_once "../conn.php";

$table_titles = array(
    'Id',
    'Product Code',
    'Brand',
    'Country',
    'Name',
    'Cat1',
    'Target',
    'Size',
    'Color',
    'Price',
    'Discount',
    'Description',
    'Status'
);
fputcsv($output, $table_titles);

$db = new Database();

// getting data from the table 
if (empty($_REQUEST['Search']) || $_REQUEST['Search'] == "" || $_REQUEST['Search'] == NULL) {
    $stm = "SELECT 
		Products.Id, 
        Products.ProductsCode, 
        Brands.BrandsName, 
        Brands.Country, 
        Products.Name, 
        Products.Cat1, 
        Targets.Target,
        Products.Size,
        Products.Color,
        Products.Price, 
        Products.Discount,
        Products.Description,
        Products.Status
		FROM Products LEFT OUTER JOIN Brands ON Products.BrandsId = Brands.Id 
        LEFT OUTER JOIN Targets ON Products.TargetsId = Targets.Id
    ;";
	$db->query($stm);
	$rows_Products = $db->resultsetArray();	 
}
else {
	$Search = '%'.$_REQUEST['Search'].'%';
    $stm = "SELECT 
        Products.Id, 
        Products.ProductsCode, 
        Brands.BrandsName, 
        Brands.Country, 
        Products.Name, 
        Products.Cat1, 
        Targets.Target,
        Products.Size,
        Products.Color,
        Products.Price, 
        Products.Discount,
        Products.Description,
        Products.Status
        FROM Products LEFT OUTER JOIN Brands ON Products.BrandsId = Brands.Id 
        LEFT OUTER JOIN Targets ON Products.TargetsId = Targets.Id
        WHERE CONCAT(
        Products.ProductsCode,
        Brands.BrandsName, 
        Brands.Country,
        Products.Name,
        Products.Cat1,
        Targets.Target,
        Products.Size,
        Products.Color,
        Products.Description
        ) LIKE :Search 
    ;";
    $db->query($stm);
    $db->bind(':Search', $Search);
    $rows_Products = $db->resultsetArray();
	
}
foreach ($rows_Products as $row_Products) {
    fputcsv ($output, $row_Products);
}
fclose($output);
?>