<?php
require_once "../functions.php";

//getting data from the table Showcase1
$db = new Database ();
$stm = "SELECT * FROM Showcase1 WHERE Status = 1 ORDER BY Updated DESC ;";
$db->query($stm);
$rows_Showcase1 = $db->resultset();
?>

<!-- glider-contain multiple -->
<div class="glider-contain multiple">
    <div class="box-showcase1-title">
        <h1 style="font-style: italic">Trending now!</h1>
    </div>
    <button class="glider-prev"><</button>
    <!-- glider -->
    <div class="glider">
    <? foreach ($rows_Showcase1 as $row_Showcase1): ?>
        <?php
        // getting data from the table Products
        $rows_Products = table_Products ('select_one', $row_Showcase1->ProductsLink, NULL, NULL, NULL, NULL, NULL);
        foreach ($rows_Products as $row_Products) {
            # code...
        }
        ?>
        <div class="glider">
            <!-- box-showcase1 -->
            <div class="box-showcase1" onclick="window.location.href='view_item.html?link=<? echo $row_Showcase1->ProductsLink; ?>' ">
                <div class="box-showcase1-img">
                    <img src="../images/<? echo $row_Products->MainImg; ?>" alt="">
                </div>
                <div class="box-showcase1-desc">
                    <div>
                        <? 
                        echo $row_Products->Name; 
                        echo " by ";
                        echo "<span style='font-style: italic'>$row_Products->BrandsName</span>";
                        ?>
                    </div>
                </div>
            </div>
            <!-- end of box-showcase1 -->
        </div>
    <? endforeach; ?>    
    </div>
    <!-- end of glider -->
    <button class="glider-next">></button>
    <div id="dots" class="glider-dots"></div>
</div>
<!-- end of glider-contain multiple -->
<script src="../scripts/jquery.js"></script>
<script src="../scripts/glider.js"></script>
<script src="../scripts/main.js"></script>
<script>
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