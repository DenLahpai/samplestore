<?php  
require_once "../functions.php";

if (empty($_POST['order'])) {
    $order = "ORDER BY Id ASC ";
}
else  {
    $order = $_POST['order'];
}

if (empty($_POST['limit'])) {
    $limit = 10;
}
else {
    $limit = $_POST['limit'];   
}

if (empty($_POST['page'])) {
    $page = 1;
}
else {
    $page = $_POST['page'];
}

//getting offset
$offset = ($page * $limit) - $limit;

$rows_Brands = table_Brands ('select_all', NULL, NULL, NULL, $order, $limit, $offset);
?>
<!-- cards-container -->
<div class="cards-container">
	<div class="cards">
		<!-- box -->
		<div class="box">
			<div class="box-title">
				Alien 
			</div>
			<div class="box-img">
				<img src="../logos/thumbnails/test2.jpg" alt="">
			</div>
			<div class="box-label">
				Add New 
			</div>
		</div>
		<!-- end of box -->
		<!-- box -->
		<div class="box">
			<div class="box-img">
				<div>
					<img src="../logos/thumbnails/test.jpeg" alt="">
				</div>
			</div>
			<div class="box-label">
				Add
			</div>
		</div>
		<!-- end of box -->
		<?php foreach($rows_Brands as $row_Brands): ?>
		<!-- box -->
		<div class="box">
			
		</div>
		<!-- end of box -->
		<?php endforeach; ?>
	</div>
	<!-- end of cards -->
</div>
<!-- end of cards-container -->