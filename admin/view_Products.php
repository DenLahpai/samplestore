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
        Products.Gender,
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
        WHERE Products.ProductsCode = :ProductsCode
        AND Products.Color = :Color
        AND Products.Size != :Size 
    ;";
    $db->query($stm);
    $db->bind(":ProductsCode", $row_Products->ProductsCode);
    $db->bind(":Color", $row_Products->Color);
    $db->bind(":Size", $row_Products->Size);
    $rows_Size = $db->resultset();

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
                        Gender: <? echo $row_Products->Gender; ?>
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
                        <div class="color" style="background: <? echo $row_Products->Color; ?>; width: 60px; height: 60px; border-radius: 12px; box-shadow: 6px 6px 6px rgba(0, 0, 0, 0.6); "></div>            
                    </div>
                    <div style="border-bottom: 3px double #000000;">
                        Status:
                        <? echo $row_Products->Status; ?>
                    </div>
                    <div style="text-align: center;">
                        <h3>Variants</h3>                        
                    </div>
                    <div>
                        Size:
                        <button type="button" class="products-cmd" onclick="Toggle('#Size')">Create another Size</button>
                        <select class="products-cmd" name="Size" id="Size" style="display: none;" onchange="duplicateProduct('Size', '<? echo $row_Products->Size;?>', '<? echo $_REQUEST['link']; ?>');">
                                <option value="">Select One</option>
                                <option value="FREE">Free Size</option>
								<option value="S">Small</option>
								<option value="M">Medium</option>
								<option value="L">Large</option>
								<option value="XL">XL</option>
								<option value="XXL">XXL</option>
                        </select>            
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
                            <button type="button" class="products-cmd">Create</button>
                            <div class="color-preview"></div>
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
   
	checkSession();    
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