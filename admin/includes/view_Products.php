<?php
require_once "../functions.php";
$rows_Products = table_Products ('select_by_link', NULL, NULL, NULL, NULL, NULL, NULL);
foreach ($rows_Products as $row_Products) {
    # code...
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
                    <!-- glider-contain multiple  -->
                    <div class="glider-contain multiple">
                        <button class="glider-prev">
                            <
                        </button>
                        <!-- glider -->
                        <div class="glider">
                            <div class="glider-img">
                                <img src="../images/<? echo $row_Products->MainImg; ?>" alt="">
                            </div>
                            <? 
                                $rows_Images = table_Images ('select_by_link', NULL, NULL, NULL, NULL, NULL, NULL); 
                                foreach ($rows_Images as $row_Images):
                            ?>
                            <div class="glider-img">
                                <img src="../images/<? echo $row_Images->Img; ?>" alt="">
                            </div>    
                            <? endforeach; ?>    
                        </div>                
                        <!-- end of glider  -->
                        <button class="glider-next">
                            >
                        </button>
                        <div id="dots" class="glider-dots"></div>
                    </div>
                    <!-- end of glider-contain multiple  -->
                    <!-- view-product-img-cmd  -->
                    <div class="view-product-img-cmd">
                    
                    </div>
                    <!-- end of view-product-img-cmd  -->
                </div>
                <!-- end of view-product-img -->
                <!-- view-product-desc -->
                <div class="view-product-desc">
                   <div>
                        Code:  <? echo $row_Products->ProductsCode; ?>
                    </div>
                    <div>
                        Brand: <? echo $row_Products->BrandsName; ?>
                    </div>                    
                </div>
                <!-- end of view-product-desc  -->
            </div>
            <!-- end of view-product  -->
        </section>