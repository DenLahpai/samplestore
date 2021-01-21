<?php 
require_once "../functions.php";
	
if (isset($_POST['Search'])) {
	$Search = '%'.$_POST['Search'].'%';
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
		WHERE CONCAT(
			Brands.BrandsName, 
			Brands.Country, 
			Products.Name,
			Targets.Target,
			Products.Size, 
			Products.Color,
			Products.Price,
			Products.Description
		) LIKE :Search
	;";
	$db->query($stm);
	$db->bind(":Search", $Search);
	$rows_Products = $db->resultset();
	$rowCount = $db->rowCount();
}

else {
	echo "<span style='color: red;'>There was an error! Please try again!</span>";
}

?>
<div class="search-result-desc">
	Displaying <? echo $rowCount; ?> result(s) for search: '<? echo $_POST['Search']; ?>'.
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