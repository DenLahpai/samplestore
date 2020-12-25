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
	<div class="boxes">
		<?php foreach($rows_Brands as $row_Brands): ?>
		<!-- box -->
		<div class="box">
			<div class="box-img">
				<div>
				<? if (!empty($row_Brands->Image)): ?>
					<?
					//getting the extension to find out whether the image is .png
	                $ext = explode('.', $row_Brands->Image);
	                $file_ext = strtolower(end($ext));
	                if ($file_ext == 'png'):
	                //if image is .png, getting the image from ../logos folder as no thumbnails
	                ?>
	                	<img src="<? echo '../logos/'.$row_Brands->Image; ?>" alt="" onclick="<? echo "window.location.href='../logos/".$row_Brands->Image."'";?>">
	                <? else: ?>
	                    <img src="<? echo '../logos/thumbnails/'.$row_Brands->Image; ?>" alt="" onclick="<? echo "window.location.href='../logos/".$row_Brands->Image."'";?>">
	                <? endif; ?>
	            <? else: ?>
	                <button type="button" onclick="<? echo "window.location.href='update_Brands.html?link=".$row_Brands->BrandsLink."'"; ?>">Add a logo!</button>
	            <? endif;?>
	            </div>
			</div>
			<!-- end of box-img -->
			<!-- box-desc -->
            <div class="box-desc">
                <div class="box-desc-title">
                    <h3><? echo $row_Brands->BrandsName; ?></h3>
                </div>
                <div class="box-desc-body">
                    <p><? echo $row_Brands->Country; ?></p>
                </div>
                <div class="box-desc-footer">
                    <a href="update_Brands.html?link=<? echo $row_Brands->BrandsLink; ?>">Edit</a>
                </div>
            </div>
            <!-- end of box-desc -->
		</div>
		<!-- end of box -->
		<?php endforeach; ?>
	</div>
	<!-- end of boxes -->
</div>
<!-- end of cards-container -->
