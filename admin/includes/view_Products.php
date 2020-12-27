<?php
require_once "../functions.php";

if (isset($_REQUEST['link'])) {
    
    $rows_Products = table_Products ('select_by_link', NULL, NULL, NULL, NULL, NULL, NULL);
    foreach ($rows_Products as $row_Products) {
        # code...
    }
}
?>
<section id="page-title">
    <div class="page-title">
        <h1>
            <? echo $row_Products->BrandsName." - ".$row_Products->Name; ?>
        </h1>
    </div>
</section>
<section id="main-data">
    <div class="view-product">
        <div>
            
        </div>
        <div>
             Code:
            <? echo $row_Products->ProductsCode; ?>
        </div>
    </div>
</section>