<?php  
require_once "../functions.php";
if (isset($_REQUEST['page'])) {
	$page = $_REQUEST['page'];
}
else {
	$page = 1;
}

if (isset($_REQUEST['limit'])) {
	$limit = $_REQUEST['limit'];
}
else {
	$limit = 12;
}

$order = "ORDER BY Products.Updated DESC ";

$offset = ($page * $limit) - $limit;

$db = new Database();
$stm = "SELECT 
	Products.ProductsLink,
	Products.ProductsCode,
	Products.MainImg,
	Products.BrandsId,  
	Brands.BrandsName, 
	Brands.Country, 
	Products.Name, 
	Products.TargetsId, 
	Targets.TargetsCode, 
	Targets.Target, 
	Products.Size, 
	Products.Color, 
	Products.Price,
	Products.Discount,
	Products.Description,
	Products.Status, 
	Products.Created,
	Products.Updated 
	FROM Products LEFT OUTER JOIN Brands ON Products.BrandsId = Brands.Id 
	LEFT OUTER JOIN Targets ON Products.TargetsId = Targets.Id
	WHERE Products.TargetsId = :TargetsId
	ORDER BY Products.Updated LIMIT $limit OFFSET $offset
;";
$db->query($stm);
$db->bind(":TargetsId", $_REQUEST['TargetsId']);
$rows_Products = $db->resultset();
foreach ($rows_Products as $row_Products) {
    #Code...
}

// getting row counts
$r = "SELECT Products.Id 
	FROM Products LEFT OUTER JOIN Brands ON Products.BrandsId = Brands.Id 
	LEFT OUTER JOIN Targets ON Products.TargetsId = Targets.Id
	WHERE Products.TargetsId = :TargetsId
;";
$db->query($r);
$db->bind(":TargetsId", $_REQUEST['TargetsId']);	
$rowCount = $db->rowCount();	

$total_pages = ceil($rowCount / $limit);

//getting Targets
$stm = "SELECT * FROM Targets WHERE Id = :TargetsId ;";
$db->query($stm);
$db->bind(":TargetsId", $_REQUEST['TargetsId']);
$rows_Targets = $db->resultset();
foreach ($rows_Targets as $row_Targets) {
    #code...
}

?>
<div class="sub-title">
	<h3>Browse Items: <? echo $row_Targets->Target; ?></h3>
</div>
<!-- boxes -->
<div class="boxes">
<? foreach ($rows_Products as $row_Products): ?>
	<!-- box -->
	<div class="box" onclick="window.location.href='view_item.html?link=<? echo $row_Products->ProductsLink; ?>'">
		<!-- box-contents -->
		<div class="box-contents">
			<div class="box-img">
				<?php
				//checking if img is png or jpg (if jpg = thbnail)
				$ext = explode ('.', $row_Products->MainImg);
				$file_ext = strtolower(end($ext));
				if ($file_ext == 'png') {
					$path = "../images/".$row_Products->MainImg;
				}
				else {
					$path = "../images/thumbnails/".$row_Products->MainImg;
				}
				?>
				<img src="<? echo $path;?>" alt="">
				<? if ($row_Products->Status == 'Soldout'): ?>
					<div class="on-img">Sold Out</div>
				<? endif; ?>
			</div>
			<!-- box-desc -->
			<div class="box-desc">
				<!-- box-desc-title -->
				<div class="box-desc-title">
					<h4>
						<? echo $row_Products->Name; ?>
					</h4>
				</div>
				<!-- end of box-desc-title -->
				<!-- box-desc-body -->
				<div class="box-desc-body">
					<? echo $row_Products->BrandsName; ?>
				</div>
				<!-- end of box-desc-body -->			
			</div>
			<!-- end of box-desc -->
			<!-- box-price -->
			<div class="box-price">
				<!-- box-price-discount -->
				<div class="box-price-discount"></div>
				<!-- end of box-price-discount -->
				<!-- box-price-norm  -->
				<div class="box-price-norm">
					K- <? echo number_format($row_Products->Price); ?>
				</div>
				<!-- end of box-price-norm -->
			</div>
			<!-- end of box-price -->
		</div>
		<!-- end of box-contents -->
	</div>
	<!-- end of box -->
	<? endforeach; ?>
</div>
<!-- end of boxes -->
<!-- pagination -->
<div class="pagination">
	<div class="page-numbers">
		
		<? if ($page == 1): ?>
		<div class="page-button" style="display: none;"><<< Prev</div>
		<? else: ?>
		<div class="page-button" id="prevPage" onclick="changePage(<? echo $page -1; ?>);"><<< Prev</div>
		<? endif; ?>
		<div class="page-button" style="border-radius: 50%;"><? echo $page; ?></div>
		<? if ($page == $total_pages): ?>
		<div class="page-button" style="display: none;">Next >>></div>
		<? else: ?>
		<div class="page-button" id="nextPage" onclick="changePage(<? echo $page +1; ?>)">Next >>></div>
		<? endif; ?>	
	</div>
</div>
<!-- end of pagination -->
