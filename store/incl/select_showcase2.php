<?php  
require_once "../functions.php";

// getting data fromt the table Showcase2
$db = new Database();
$stm = "SELECT * FROM Showcase2 WHERE Status = 1 ORDER BY Updated DESC;";
$db->query($stm);
$rows_Showcase2 = $db->resultset();
?>
<!-- boxes -->
<div class="boxes">
<? foreach ($rows_Showcase2 as $row_Showcase2): ?>
	<?php
	// getting data from the table Products
	$rows_Products = table_Products ('select_one', $row_Showcase2->ProductsLink, NULL, NULL, NULL, NULL, NULL);
	foreach ($rows_Products as $row_Products) {
		# code...
	}
	?>
	<!-- box -->
	<div class="box" onclick="window.location.href='view_item.html?link=<? echo $row_Showcase2->ProductsLink; ?>'">
		<!-- box-contents -->
		<div>
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