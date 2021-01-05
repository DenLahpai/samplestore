<?php  
require_once "../functions.php";
$db = new Database();
$stm = "SELECT * FROM Targets ORDER BY Id ;";
$db->query($stm);
$rows_Targets = $db->resultset();
?>
<!-- menu-target-->
<div class="menu-target">
	<div class="menu-collection-items-container">
		<?php foreach ($rows_Targets as $row_Targets): ?>
			<?php 	$rowCount = table_Products ('row_Count_for_each_TargetsId', $row_Targets->Id, NULL, NULL, NULL, NULL, NULL); ?>
			<!-- menu-collection-item -->
			<div class="menu-collection-item">
				<div class="menu-collection-item-name" onclick="window.location.href='browse_items_by_targets.html?Tgt=<? echo $row_Targets->Id; ?>'">
					<?php echo $row_Targets->Target; ?>
				</div>
				<div class="menu-collection-item-count">
					Items(<?php echo $rowCount; ?>)
				</div>
			</div>
			<!-- end of menu-collection-item -->
		<?php endforeach ?>
	</div>
</div>
<!-- end of menu-target -->