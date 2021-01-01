<?php
require_once "../fonctions.php";

//getting data from the table Showcase1
$db = new Database ();
$stm = "SELECT * FROM Showcase1  ;";
$db->query($stm);
$rows_Showcase1 = $db->resultset();
?>
<!-- glider-contain multiple -->
<div class="glider-contain multiple">
    <button class="glider-prev"><</button>
    <!-- glider -->
    <div class="glider">
    <? foreach ($rows_Showcase1 as $row_Showcase1): ?>
        <div>
            <? echo $row_Showcase1->ProductsLink; ?>
        </div>
    <? endforeach; ?>    
    </div>
    <!-- end of glider -->
    <button class="glider-next">></button>
    <div id="dots" class="glider-dots"></div>
</div>
<!-- end of glider-contain multiple -->
<script src="scripts/jquery.js"></script>
<script src="scripts/glider.js"></script>
<script src="scripts/main.js"></script>
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