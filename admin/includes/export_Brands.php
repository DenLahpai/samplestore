<?php
header ('Content-Type: text/csv; charset=utf-8');
header ('Content-Disposition: attachment; filename=Brands.csv');
$output = fopen("php://output", "w");

require_once "../conn.php";

$table_titles = array(
    'Id',
    'Name',
    'Country',
    'Image',
    'Created',
    'Updated'
);
fputcsv($output, $table_titles);

$db = new Database();

// getting data from the table 
if (empty($_REQUEST['Search']) || $_REQUEST['Search'] == "" || $_REQUEST['Search'] == NULL) {
    $stm = "SELECT 
		Id, 
		BrandsName AS Name,
		Country,
		Image,
		Created, 
		Updated
		FROM Brands ;";
	$db->query($stm);
	$rows_Brands = $db->resultsetArray();	 
}
else {
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
    $rows_Brands = $db->resultsetArray();
	
}
foreach ($rows_Brands as $row_Brands) {
    fputcsv ($output, $row_Brands);
}
fclose($output);
?>