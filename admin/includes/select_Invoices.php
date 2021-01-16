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
$rows_Invoices = table_Invoices ('select_all', NULL, NULL, NULL, $order, $limit, $offset);
?>
<div class="Invoices-container">
	<!-- boxes -->
	<div class="boxes">
		<?php foreach ($rows_Invoices as $row_Invoices): ?>
		<?php  
		//getting OrdersLink
		$db = new Database();
		$stm = "SELECT * FROM Orders WHERE InvoicesLink = :InvoicesLink ;";
		$db->query($stm);
		$db->bind(":InvoicesLink", $row_Invoices->InvoicesLink);
		$rows_Orders = $db->resultset();
		foreach ($rows_Orders as $row_Orders) {
			# code...
		}
		// getting data from the tabel Customers
		$stm = "SELECT * FROM Customers WHERE OrdersLink = :OrdersLink ;";
		$db->query($stm);
		$db->bind(":OrdersLink", $row_Orders->OrdersLink);
		$rows_Customers = $db->resultset();
		foreach ($rows_Customers as $row_Customers){
			# code...
		}
		?>	
		<a href="../Invoices/Invoice-<? echo $row_Invoices->InvoiceNo ?>.pdf" target="_blank">
			<div class="Invoice-box">
				<div class="Invoice-box-header">
					<div class="Invoice-box-header-title" style='font-weight: bold'>
						<?php echo "InvoiceNo: ".$row_Invoices->InvoiceNo; ?>
					</div>
					<div class="Invoice-box-header-date">
						<?php echo date("d-M-y", strtotime($row_Invoices->Created)); ?>	
					</div>
				</div>
				<div class="Invoice-box-body">
					<div class="Invoice-box-body-content" style='font-weight: bold'>
						<?php echo $row_Customers->Name; ?>	
					</div>
					<div class="Invoice-box-body-content">
						<?php echo "Amount: ".$row_Invoices->Total; ?>
					</div>
					<div class="Invoice-box-body-content">
						<?php echo "Status: ".$row_Invoices->Status; ?>
					</div>
					<div class="Invoice-box-body-content">
						<?php  
						if (!empty($row_Invoices->Method)) {
							echo "By: ".$row_Invoices->Method;
						}
						?>
					</div>
					<div class="Invoice-box-body-content">
						<?php  
						if (!empty($row_Invoices->PaidOn)) {
							echo "On: ".date("d-M-Y", strtotime($row_Invoices->PaidOn));
						}
						?>
					</div>
				</div>
			</div>	
		</a>
		<?php endforeach ?>
	</div>
	<!-- end of boxes -->
</div>