<?php
require_once "../functions.php";

if (empty($_POST['order'])) {
    $order = "ORDER BY Id ASC ";
}
else  {
    $order = $_POST['order'];
}

if (empty($_POST['limit'])) {
    $limit = 10;
}
else {
    $limit = $_POST['limit'];
}

if (empty($_POST['page'])) {
    $page = 1;
}
else {
    $page = $_POST['page'];
}

//getting offset
$offset = ($page * $limit) - $limit;

$rows_Payments = table_Payments ('select_all', NULL, NULL, NULL, $order, $limit, $offset);
?>

<?php foreach ($rows_Payments as $row_Payments): ?>

<?php endforeach; ?>    