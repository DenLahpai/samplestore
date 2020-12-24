<?php
require_once "../functions.php";

header ('Content-Type: text/csv; charset=utf-8');
header ('Content-Disposition: attachment; filename=Brands.csv');
$output = fopen("php://output", "w");
$table_titles = array(
    'Id',
    'Name',
    'Country',
    'Image',
    'Created',
    'Updated'
);
fputcsv($output, $table_titles);

// getting data from the table 
if (empty($_REQUEST['Search']) || $_REQUEST['Search'] == "" || $_REQUEST['Search'] == NULL) {
    $rows_Brands = table_Brands ('select_all_array', NULL, NULL, NULL, NULL, NULL, NULL);    
}
else {
    $rows_Brands = table_Brands ('search_all_array', NULL, NULL, NULL, NULL, NULL, NULL);
}
foreach ($rows_Brands as $row_Brands) {
    fputcsv ($output, $row_Brands);
}
fclose($output);
?>