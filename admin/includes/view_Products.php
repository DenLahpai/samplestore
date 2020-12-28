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
    <!-- view-product -->
    <div class="view-product">
        <!-- view-product-img -->
        <div class="view-product-img">
            
            <!-- view-product-img-cmd  -->
            <div class="view-product-img-cmd">
            
            </div>
            <!-- end of view-product-img-cmd  -->
        </div>
        <!-- end of view-product-img -->
        <!-- view-product-desc -->
        <div class="view-product-desc">
            Code:  <? echo $row_Products->ProductsCode; ?>
        </div>
        <!-- end of view-product-desc  -->
    </div>
    <!-- end of view-product  -->
</section>