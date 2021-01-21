<?php  
require_once "../functions.php";

// getting data fromt the table Showcase2
$db = new Database();
$stm = "SELECT  
	Products.ProductsLink,
	Products.ProductsCode, 
	Products.MainImg, 
	Brands.BrandsName, 
	Brands.Country, 
	Products.Name,
	Products.Cat1, 
	Products.TargetsId, 
	Targets.TargetsCode, 
	Targets.Target,
	Products.Size,
	Products.Color,
	Products.Price, 
	Products.Discount, 
	Products.Description,
	Products.Status		
	FROM Products LEFT OUTER JOIN Brands ON Products.BrandsId = Brands.Id 
	LEFT OUTER JOIN Targets ON Products.TargetsId = Targets.Id
	WHERE Discount > 0 ORDER BY Products.Updated DESC;
;";
$db->query($stm);
$rowCount = $db->rowCount();
$rows_Products = $db->resultset();
?>
<? if ($rowCount > 0): ?>
<div class="sub-title">
	<h3>SALE</h3>
</div>
<!-- boxes -->
<div class="boxes">
<? foreach ($rows_Products as $row_Products): ?>
	<!-- box -->
	<div class="box" onclick="window.location.href='view_item.html?link=<? echo $row_Products->ProductsLink; ?>';">
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
				<div class="box-price-discount">
					<div>
					<?php  
					$dsc = explode(".", $row_Products->Discount);
					$value = current($dsc);
					echo $value." % OFF"
					?>
					</div>
				</div>
				<!-- end of box-price-discount -->
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
				<!-- box-price-norm  -->
				<div class="box-price-norm" style="text-decoration: line-through;">
					K- <? echo number_format($row_Products->Price); ?>
					<?php  
					$new_price = $row_Products->Price - ($row_Products->Price * $row_Products-> Discount / 100);				
					?>
				</div>
				<!-- end of box-price-norm -->
				<!-- box-price-norm -->
				<div class="box-price-norm" style="color: red">
					K- <? echo number_format($new_price); ?>
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
<?php endif; ?>