<?php
require_once "functions.php";

if (isset($_REQUEST['link'])) {
    
    $rows_Products = table_Products ('select_by_link', NULL, NULL, NULL, NULL, NULL, NULL);
    foreach ($rows_Products as $row_Products) {
        # code...
    }

    // looking for the product with different sizes
    $db = new Database();
    $stm = "SELECT 
        Products.Id, 
        Products.ProductsLink,
        Products.ProductsCode, 
        Products.MainImg, 
        Products.BrandsId, 
        Brands.BrandsName, 
        Brands.Country,
        Products.Name,
        Products.Cat1,
        Products.TargetsId, 
        Targets.TargetsCode, 
        Targets.Target,
        Products.Description, 
        Products.Size,
        Products.Price, 
        Products.Discount, 
        Products.Status, 
        Products.Color, 
        Products.UsersId, 
        Products.Created, 
        Products.Updated
        FROM Products LEFT OUTER JOIN Brands ON Products.BrandsId = Brands.Id 
        LEFT OUTER JOIN Targets ON Products.TargetsId = Targets.Id
        WHERE Products.ProductsCode = :ProductsCode
        AND Products.Color = :Color
        AND Products.Size != :Size 
    ;";
    $db->query($stm);
    $db->bind(":ProductsCode", $row_Products->ProductsCode);
    $db->bind(":Color", $row_Products->Color);
    $db->bind(":Size", $row_Products->Size);
    $rows_Size = $db->resultset();

    // looking for products with different colors
    $stm = "SELECT 
        Products.Id, 
        Products.ProductsLink,
        Products.ProductsCode, 
        Products.MainImg, 
        Products.BrandsId, 
        Brands.BrandsName, 
        Brands.Country,
        Products.Name,
        Products.Cat1,
        Products.TargetsId, 
        Targets.TargetsCode,
        Targets.Target,
        Products.Description, 
        Products.Size,
        Products.Price, 
        Products.Discount, 
        Products.Status, 
        Products.Color, 
        Products.UsersId, 
        Products.Created, 
        Products.Updated
        FROM Products LEFT OUTER JOIN Brands ON Products.BrandsId = Brands.Id 
        LEFT OUTER JOIN Targets ON Products.TargetsId = Targets.Id
        WHERE Products.ProductsCode = :ProductsCode
        AND Products.Color != :Color
        AND Products.Size = :Size 
    ;";
    $db->query($stm);
    $db->bind(":ProductsCode", $row_Products->ProductsCode);
    $db->bind(":Color", $row_Products->Color);
    $db->bind(":Size", $row_Products->Size);
    $rows_Color = $db->resultset();

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/glider.css">
    <link rel="stylesheet" href="styles/styles.css">
	<link rel="Shortcut icon" href="../logo_small.png"/>
    <title>View Product</title>
    <style>
        .color-box {
            width: 60px; 
            height: 60px; 
            border-radius: 12px; 
            box-shadow: 6px 6px 6px rgba(0, 0, 0, 0.6);
        }

        .color-box:active {
            box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.3);
        }

    </style>
</head>
<body>
    <!-- wrapper -->
    <div class="wrapper">
        <header></header>
        <!-- main-content -->
        <div class="main-content">
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
                        <button class="glider-prev"><</button>
                        <!-- glider -->
                        <div class="glider">
                            <div class="glider-img">
                                <div style="padding: 12px;">
                                    <button type="button" class="products-cmd" onclick="window.location.href='update_main_img_Products.html?link=<? echo $row_Products->ProductsLink; ?>';">Change</button>
                                </div>
                                <img src="../images/<? echo $row_Products->MainImg; ?>" alt="">                                
                            </div>
                            <? 
                                $rows_Images = table_Images ('select_by_link', NULL, NULL, NULL, NULL, NULL, NULL); 
                                foreach ($rows_Images as $row_Images):
                            ?>
                            <div class="glider-img" style="postion: relative;">
                                <div style="padding: 12px; ">
                                    <button type="button" class="products-cmd" onclick="removeImg('<? echo $row_Images->Img; ?>')">Remove</button>
                                </div>
                                <img src="../images/<? echo $row_Images->Img; ?>" alt=""><br>
                            </div>    
                            <? endforeach; ?>    
                        </div>                
                        <!-- end of glider  -->
                        <button class="glider-next">></button>
                        <div id="dots" class="glider-dots"></div>
                    </div>
                    <!-- end of glider-contain multiple  -->
                    <!-- view-product-img-cmd  -->
                    <div class="view-product-img-cmd">
                        <button type="button" class="products-cmd" onclick="window.location.href='upload_img_Products.html?link=<? echo $_REQUEST['link']; ?>&src=not_main'"; >Add Image</button>                       
                    </div>
                    <!-- end of view-product-img-cmd  -->
                </div>
                <!-- end of view-product-img -->
                <!-- view-product-desc -->
                <div class="view-product-desc">
                    <div>
                        Code:  <? echo md5('Testing345');  
                        // echo $row_Products->ProductsCode; ?>
                    </div>
                    <div>
                        Category: <? echo $row_Products->Cat1; ?>
                    </div>
                    <div>
                        For: <? echo $row_Products->TargetsCode; ?>
                    </div>
                    <div>
                        Size: <? echo $row_Products->Size; ?>
                    </div>
                    <div>
                        Description: <br>
                        <span style="font-style: italic;"><? echo $row_Products->Description; ?></span>
                    </div>
                    <div>
                        Price: <span style="font-weight: bold"><? echo $row_Products->Price; ?> MMK</span>
                    </div>
                    <div>
                        Discount: <? echo $row_Products->Discount; ?> %
                    </div>
                    <div>
                        Color: <? echo $row_Products->Color; ?>
                        <div class="color-box" style="background: <? echo $row_Products->Color; ?>;"></div>            
                    </div>
                    <div>
                        Status:
                        <? echo $row_Products->Status; ?>
                    </div>
                    <div>
                        <span style='color: red'>
                            <input type="checkbox" id="Soldout" name="Soldout">
                            <label for="Soldout"> Mark as SOLD OUT!!!</label>
                        </span>
                        <br>
                        The items will be shown in the store with a lable sold out! It will not be able to be added in a cart!
                    </div>
                    <div>
                        <div>
                            Copy and past the link below in your Facebook post.             
                        </div>
                        <div class="ads-link">
                            <p>
                            <? echo "https://samplestore.denlp.com/store/incl/fb_ads_view_item.php?link=".$_REQUEST['link']; ?>
                            </p>
                        </div>
                    </div>
                    <div>
                        <a href="../store/view_item.html?link=<? echo $_REQUEST['link']?>" target="_blank">View in the Store</a>
                    </div>
                    <div style="border: 1px solid #000000;">
                        Sales: <br><br>
                        <input type="checkbox" id="Showcase1" name="Showcase1"  >
                        <label for="Showcase1">Trending</label><br><br><br>
                        <input type="checkbox" id="Showcase2" name="Showcase2">
                        <label for="Showcase2">Featuring</label>                        
                    </div>
                    <div style="text-align: center;">
                        <h3>Create Variants</h3>                        
                    </div>
                    <div>
                        Size: <input type="text" name="Size" id="Size" placeholder="Enter another size">
                        <button type="button" class="products-cmd" onclick="duplicateProduct('Size', '<? echo $row_Products->Size;?>', '<? echo $_REQUEST['link']; ?>');">Create</button>
                        <br>
                        <? foreach ($rows_Size as $row_Size): ?>
                            <? if (isset($row_Size->Size) || !empty($row_Size->Size)): ?>
                            <div style="margin-top: 12px; margin-right: 12px; font-size: 1.8em; display: inline-block;">
                                <a href="view_Products.php?link=<? echo $row_Size->ProductsLink; ?>"><? echo $row_Size->Size; ?></a>
                            </div>
                            <? endif; ?>    
                        <? endforeach; ?>    
                    </div>
                    <div>
                        Color: 
                        <button type="button" class="products-cmd" onclick="Toggle('.Color-form')">Create another Color</button>
                        <div class="Color-form" style="margin-top: 12px; display: none;" >
                            <input type="text" name="Color" id="Color" onblur="previewColor(this.value)";>
                            <div class="color-preview"></div>
                            <br>
                            <button type="button" class="products-cmd" onclick="duplicateProduct('Color', '<? echo $row_Products->Color; ?>', '<? echo $_REQUEST['link']; ?>');">Create</button>
                        </div>
                        <br>
                        <br>
                        <br>
                        View other colors: 
                        <br>
                        <div class="color-boxes">
                            <? foreach ($rows_Color as $row_Color): ?>
                                <? if (isset($row_Color->Color) || !empty($row_Color->Color)): ?>
                                    <div class="color-box" style="background: <? echo $row_Color->Color; ?>" onclick="window.location.href = 'view_Products.php?link=<? echo $row_Color->ProductsLink; ?>' "></div>
                                <? endif; ?>    
                            <? endforeach; ?>
                        </div>    
                    </div>                           
                </div>
                <!-- end of view-product-desc  -->
            </div>
            <!-- end of view-product  -->
        </section>
        <section id="sys_message"></section>
        </div>
        <!-- end of main-content -->
        <footer></footer>
    </div>
    <!-- end of wrapper -->
</body>
<script src="../scripts/jquery.js"></script>
<script src="../scripts/scripts.js"></script>
<script src="../scripts/glider.js"></script>
<script>
$(document).ready(function () {

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const link = urlParams.get('link');
	
	$.post("includes/header.php", function (data) {
		$("header").html(data);
	});

	$.post("includes/footer.php", function (data) {
		$("footer").html(data);
    });

    $("#Showcase1").on("change", function () {
        updateShowcase (1, link);
    });

    $("#Showcase2").on("change", function () {
        updateShowcase (2, link);
    });

    $("#Soldout").on("change", function (){
        updateSoldout(link);
    });
    
    checkShowcases (link);
    rowCountShowcase (1);
	checkSession();
    check_Soldout(link);
});

new Glider(document.querySelector('.glider'), {
    slidesToShow: 1,
    dots: '#dots',
    draggable: true,
    arrows: {
    prev: '.glider-prev',
    next: '.glider-next'
    }
});
</script>
</html>