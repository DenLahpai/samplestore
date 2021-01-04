<?php  
require_once "../functions.php";
$db = new Database();
$stm = "SELECT DISTINCT Cat1 FROM Products ORDER BY Cat1 ;";
$db->query($stm);
$rows_Cat1 = $db->resultset();
?>
<!-- menu-collection -->
<div class="menu-collection">
	<div class="menu-collection-items-container">
		<?php foreach ($rows_Cat1 as $row_Cat1): ?>
			<?php 	$rowCount = table_Products ('row_Count_for_each_cat1', $row_Cat1->Cat1, NULL, NULL, NULL, NULL, NULL); ?>
			<!-- menu-collection-item -->
			<div class="menu-collection-item">
				<div class="menu-collection-item-name" onclick="window.location.href='browse_items.html?Cat1=<? echo $row_Cat1->Cat1; ?>'">
					<?php echo $row_Cat1->Cat1; ?>
				</div>
				<div class="menu-collection-item-count">
					Items(<?php echo $rowCount; ?>)
				</div>
			</div>
			<!-- end of menu-collection-item -->
		<?php endforeach ?>
	</div>
</div>
<!-- end of menu-collection -->