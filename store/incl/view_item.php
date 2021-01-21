<?php  
require_once "../functions.php";

if (isset($_REQUEST['link'])) {
    //getting data from the table
    $db = new Database ();
    $stm = "SELECT 
        Products.ProductsCode,
        Products.MainImg,
        Products.BrandsId,
        Brands.BrandsName,
        Brands.LogoImage,
        Brands.Country,
        Products.Name,
        Products.Cat1,
        Products.TargetsId,
        Targets.TargetsCode,
        Targets.Target,
        Products.Size,
        Products.Color,
        Products.Discount,
        Products.Price,
        Products.Description,
        Products.Status
        FROM Products LEFT OUTER JOIN Brands ON Products.BrandsId = Brands.Id
        LEFT OUTER JOIN Targets ON Products.TargetsId = Targets.Id
        WHERE Products.ProductsLink = :link         
    ;";
    $db->query($stm);
    $db->bind(":link", $_REQUEST['link']);
    $rows_Products = $db->resultset();
    foreach ($rows_Products as $row_Products) {
        #code...
    }

    //getting images from the table Images
    $stm = "SELECT * FROM Images WHERE ProductsLink = :link ORDER BY Updated ASC;";
    $db->query($stm);
    $db->bind(":link", $_REQUEST['link']);
    $rows_Images = $db->resultset();
    foreach ($rows_Images as $row_Images) {
        # code...
    }
}
?>
<div class="sub-title">
    <h3>View: <? echo $row_Products->Name; ?></h3> <? echo "by <span style='italic'>$row_Products->BrandsName</span>"; ?>
</div>
<!-- view-product-container -->
<div class="view-product-container">
    <!-- view-product-img -->
    <div id="view-product-img">
        <!-- swiper-container -->
        <div class="swiper-container">
            <!-- swiper-wrapper -->
            <div class="swiper-wrapper">

                <!-- swiper-slide -->
                <div class="swiper-slide">
                    <div class="swiper-slide-img">
                        <img src="../images/<? echo $row_Products->MainImg; ?>" alt="" onclick="window.location.href='../images/<? echo $row_Products->MainImg; ?>'; ">
                    </div>
                </div>
                <!-- end of swiper-slide -->

                <?php foreach ($rows_Images as $row_Images): ?>
                    <!-- swiper-slide -->
                    <div class="swiper-slide">
                        <div class="swiper-slide-img">
                            <img src="../images/<? echo $row_Images->Img; ?>" alt="" onclick="window.location.href='../images/<? echo $row_Images->Img; ?>'; ">
                        </div>
                    </div>
                    <!-- end of swiper-slide -->
                <?php endforeach ?>
                
            </div>
            <!-- end of swiper-wrapper -->
        </div>
        <!-- end of swiper-container -->
    </div>
    <!-- end of view-product-img -->
    <!-- view-product-desc -->
    <div class="view-product-desc">
        <!-- end of view-products-sizes -->
        <div class="view-product-price">
            <div class="view-product-price-box">
            <?php  
            if ($row_Products->Discount <= 0) {
                echo "<h4>K- $row_Products->Price</h4>";
            }
            else {
                //getting the discount rate
                $discounted = $row_Products->Price - ($row_Products->Price * $row_Products->Discount / 100);
                echo "<h4 style='text-decoration: line-through; font-style: italic; font-weight: normal'>K- ".number_format($row_Products->Price)."</h4>";
                echo "<h4 style='color: red;'>K- ".number_format($discounted)."</h4>";
            }
            ?>
            </div>
            <!-- end for view-product-price-box -->
            <div class="view-product-cart">
                <?php if ($row_Products->Status != 'Soldout'): ?>
                    <div class="add-cart">
                        Add to Cart        
                    </div>
                <?php else: ?>
                    <div style="color: red">Sold Out!!!</div>    
                <?php endif ?>
            </div>
        </div>
        <!-- view-product-details -->
        <div class="view-product-details">
            <p>
                <?php
                echo $row_Products->Description;
                ?>
            </p>
            <p>
                Size: <?php echo "<span style='font-weight: bold;'>".$row_Products->Size."</span>"; ?>
            </p>
            <p>
                Color: <span style='font-weight: bold'><?php echo $row_Products->Color; ?></span>
            </p>
            <div class="color-block" style="background: <? echo $row_Products->Color; ?>">                    
                </div>
        </div>
        <!-- end of view-product-details -->
        <!-- view-product-colors -->
        <div class="view-product-colors">
            <?php 
            //checking if there is other color
            $stm = "SELECT 
                ProductsLink,
                Color
                FROM Products WHERE 
                ProductsCode = :ProductsCode AND 
                Size = :Size AND 
                Color != :Color
            ;";
            $db->query($stm);
            $db->bind(":ProductsCode", $row_Products->ProductsCode);
            $db->bind(":Size", $row_Products->Size);
            $db->bind(":Color", $row_Products->Color);
            $rowCount_Colors = $db->rowCount();
            $rows_Colors = $db->resultset();
            ?>
            <? if ($rowCount_Colors > 0): ?>
            <h3>View More Colors:</h3>
            <div class="view-product-colors-boxes">
            <? foreach ($rows_Colors as $row_Colors): ?>
            <div class="link-color" style="background: <? echo $row_Colors->Color;?>" onclick="window.location.href='view_item.html?link=<? echo $row_Colors->ProductsLink; ?>'">                
            </div>            
            <? endforeach; ?>
            </div>
            <? endif; ?>
        </div>
        <!-- end of view-product-colors -->
        <!-- view-product-sizes -->
        <div class="view-product-sizes">
            <?php  
            //checking if there are other size
            $stm = "SELECT 
                ProductsLink, 
                Size
                FROM Products WHERE 
                ProductsCode = :ProductsCode AND 
                Color = :Color AND 
                Size != :Size
            ;";
                $db->query($stm);
            $db->bind(":ProductsCode", $row_Products->ProductsCode);
            $db->bind(":Color", $row_Products->Color);
            $db->bind(":Size", $row_Products->Size);
            $rowCount_Sizes = $db->rowCount();
            $rows_Sizes = $db->resultset();
            ?>
            <? if ($rowCount_Sizes > 0): ?>
            <h3>View More Sizes:</h3>
            <div class="view-product-sizes-boxes">
                <? foreach ($rows_Sizes as $row_Sizes): ?>
                <div class="link-size">
                    <a href="view_item.html?link=<? echo $row_Sizes->ProductsLink ?>">
                        <?php echo $row_Sizes->Size; ?>
                    </a>
                </div>
                <? endforeach; ?>
            <? endif; ?>    
            </div>
            <!-- end of view-product-sizes-boxes     -->
        </div>        
    </div>
    <!-- end of view-product-desc -->
</div>
<!-- end of view-product-container -->
<script src="../scripts/jquery.js"></script>
<script src="../scripts/main.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- Initialize Swiper -->
<script>
var swiper = new Swiper('.swiper-container', {
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 'auto',
    coverflowEffect: {
    rotate: 60,
    stretch: 0,
    depth: 600,
    modifier: 1,
    slideShadows: true,
    },
    pagination: {
    el: '.swiper-pagination',
    },
});

$(".add-cart").on("click", function() {
    $.post("incl/add_cart.php", {
        link: '<? echo $_POST["link"]; ?>'}, function (data) {
            location.reload();
            alert(data);
        });
});

</script>