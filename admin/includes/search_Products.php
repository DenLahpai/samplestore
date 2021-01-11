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

if (isset($_REQUEST['Search']) || !empty($_REQUEST['Search'])) {
    $Search = '%'.trim($_REQUEST['Search']).'%';
    $rows_Products = table_Products ('search', $Search, NULL, NULL, $order, $limit, $offset);
}
?>
<!-- products-box-container -->
<div class="products-box-container">
	<!-- products-boxes -->
	<div class="products-boxes">
		<? foreach ($rows_Products as $row_Products): ?>
		<!-- products-box -->
		<div class="products-box" style= "border: 3px solid  <? echo $row_Products->Color; ?>">
			<div class="products-box-desc">
				<div>
					<h4 style="display: inline;"><? echo $row_Products->BrandsName." | "?></h4>
					<? echo $row_Products->Name; ?>
				</div>
				<div>
					<? echo $row_Products->ProductsCode; ?>
				</div>
				<div>
					<? echo $row_Products->Cat1; ?>
				</div>
				<div>
					<? echo $row_Products->Target; ?>
					| <? echo $row_Products->Size; ?>
				</div>
				<div>
					<? echo $row_Products->Price; ?> MMK
				</div>
				<div class="color-preview" style="background: <? echo $row_Products->Color; ?>;"></div>
				<div style="margin-top: 12px; display: flex; justify-content: space-between;">
					<a href="update_Products.html?link=<? echo $row_Products->ProductsLink; ?>">Edit</a>
					<a href="view_Products.php?link=<? echo $row_Products->ProductsLink; ?>">View</a>
				</div>
				<div>
					
				</div>
			</div>
			<div class='products-box-img'>
				<? if (empty($row_Products->MainImg) || $row_Products->MainImg == ""): ?>
					<div class="img-upload" onclick="window.location.href = 'upload_main_img_Products.html?link=<? echo $row_Products->ProductsLink; ?>';">Upload image!</div>
				<? else: ?>
					<?php
					//getting the extension to find out whether the image is .png
	                $ext = explode('.', $row_Products->MainImg);
					$file_ext = strtolower(end($ext));
					if ($file_ext == 'png') {
						$img_path = "../images/".$row_Products->MainImg;				
					}
					else {
						$img_path = "../images/thumbnails/".$row_Products->MainImg;
					}
					?>
					<div class="products-img" onclick="window.location.href= '<? echo $img_path; ?>';">
						<img src="<? echo $img_path; ?>" alt="">
					</div>
				<? endif;?>
			</div>
		</div>
		<!-- end of products-box  -->
		<? endforeach; ?>
	</div>
	<!-- end of products-boxes -->
</div>
<!-- end fo products-box-container  -->