<?php
require_once "../functions.php";
$rows_Products = table_Products ('select_one', $_REQUEST['link'], NULL, NULL, NULL, NULL, NULL);
foreach ($rows_Products as $row_Products) {
    # code...
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="refresh" content="1; ../view_item.html?link=<? echo $_REQUEST['link']; ?>">
    <link rel="stylesheet" href="../css/glider.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="Shortcut icon" href="docs/lotus-flower.png"/>
    <title><? echo $row_Products->Name." by ".$row_Products->BrandsName; ?></title>
    <style>
        .big-img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <!-- wrapper    -->
    <div class="wrapper">
        <!-- container -->
        <div class="container">
            <section id="main-data">
                <div class="big-img">
                    <img src="../../images/<? echo $row_Products->MainImg; ?>" alt="">
                </div>
            </section>
        </div>
        <!-- end of container  -->
    </div>
    <!-- end of wrapper -->
</body>
</html>