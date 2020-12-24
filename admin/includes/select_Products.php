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

$rows_Products = table_Products ('select_all', NULL, NULL, NULL, $order, $limit, $offset);
?>
<!-- cards-container -->
<div class="cards-container">
	<!-- cards -->
	<div class="cards">
		<?php foreach ($rows_Products as $row_Products): ?>
		<!-- card -->
		<div class="card" id="<? echo $row_Products->ProductsLink; ?>">
			<div class="card-title">
				<div>
					<? echo $row_Products->BrandsName;?>
				</div>
				<div>
					<div>Upload Image!</div>
				</div>
			</div>
			<div class="card-body">
				<div>
					<? echo $row_Products->Name; ?>
				</div>
				<div>
					<? echo $row_Products->ProductsCode; ?>
				</div>
				<div style="font-weight: bold">
					<?
                        echo "Gd: ".$row_Products->Gender."<br>";
                        echo "Sz: ".$row_Products->Size;
                    ?>
				</div>
			</div>
			<div class="card-command" onclick="window.location.href='<? echo "edit_Products.html?link=$row_Products->ProductsLink"; ?>';">
				<div class=counter style="cursor: pointer; background-color: <? echo $row_Products->Color; ?>"></div>
				<div style="text-decoration: underline; cursor: pointer">
					Edit
				</div>
			</div>
		</div>
		<!-- end of card -->
		<?php endforeach ?>
	</div>
	<!-- end of cards -->
</div>
<!-- end of cards-container -->
