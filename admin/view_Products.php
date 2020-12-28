<?php
require_once "functions.php";

if (isset($_REQUEST['link'])) {
    
    $rows_Products = table_Products ('select_by_link', NULL, NULL, NULL, NULL, NULL, NULL);
    foreach ($rows_Products as $row_Products) {
        # code...
    }
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
                    Code:  <? echo $row_Products->ProductsCode; ?>
                </div>
                <!-- end of view-product-desc  -->
            </div>
            <!-- end of view-product  -->
        </section>
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