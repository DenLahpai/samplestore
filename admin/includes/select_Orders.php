<?php  
require_once "../functions.php";
if (empty($_POST['order'])) {
	$order = "ORDER BY Created DESC";
}
else {
	$order = $_POST['order'];
}

if (empty($_POST['limit'])) {
	$limit = 30;
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

$rows_Orders = table_Orders ('select_all', NULL, NULL, NULL, $order, $limit, $offset);
?>
<div class="orders-container">
	<ul>
		<? foreach ($rows_Orders as $row_Orders): ?>
			<?php 
			// getting data from the table Customers 
			$rows_Customers = table_Customers ('select_one', $row_Orders->CustomersLink, NULL, NULL, NULL, NULL, NULL);
			foreach ($rows_Customers as $row_Customers) {
				# code...
			}
			?>
			<li>
				<a href="view_Orders.html?link=<? echo $row_Orders->OrdersLink; ?>">
					<div class="orders-date">
						<? echo date('d-M H:i', strtotime($row_Orders->Created)); ?>
					</div>
					
					<h5>
						<? echo $row_Customers->Name.", ".$row_Customers->Town; ?>
					</h5>

					<div class="orders-status">
						<?php echo "Status:".$row_Orders->Status; ?>
					</div>
					<?php  
					//getting data from the table Orders_List
					$rows_Orders_List = table_Orders_List ('select_one_order', $row_Orders->OrdersLink, NULL, NULL, NULL, NULL, NULL);
					?>					
					<? foreach($rows_Orders_List as $row_Orders_List): ?>
						<p class="orders-list">
							<?php 
							echo $row_Orders_List->Name.": ".$row_Orders_List->Qty; 
							?>
						</p>
					<? endforeach;?>						
				</a>
			</li>	
		<? endforeach; ?>	
	</ul>
</div>