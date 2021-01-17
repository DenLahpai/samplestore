<?php
require_once "../functions.php";

if (empty($_POST['order'])) {
    $order = "ORDER BY Payments.Created DESC ";
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

$rows_Payments = table_Payments ('select_all', NULL, NULL, NULL, $order, $limit, $offset);
?>
<div class="payments-container">
	<div class="boxes">
		<? foreach ($rows_Payments as $row_Payments):?>
			<div class="payments-box">
				<div class="payments-box-header">
					<div class="payments-box-header-title">
						Invoice No: <? echo $row_Payments->InvoiceNo; ?>
					</div>
					<div class="payments-box-header-date" style="font-style: italic;">
						<? echo date('d-M-y', strtotime($row_Payments->Created)); ?>
					</div>
				</div>
				<div class="payments-box-body">
					<div class="payments-box-body-content">
						<? echo "Status: ".$row_Payments->Status;?>
					</div>
					<div class="payments-box-content">
						<?php
						if (!empty($row_Payments->Method)) {
							echo "Method: ".$row_Payments->Method;
						}	
						?>
					</div>
					<div class="payments-box-content">
						<?php
						if (!empty($row_Payments->PaidOn)) {
							echo "Date of Payment: ".date('d-M-y', strtotime($row_Payments->PaidOn));
						}	
						?>
					</div>
				</div>
				<div class="payments-box-footer">
					<div class="payments-box-footer-button">
						<a href="../payments/<? echo $row_Payments->Image?>" target="_blank">View Doc</a>
					</div>
					<div class="payments-box-footer-button">
						<a href="update_Payments.html?link=<? echo $row_Payments->InvoicesLink ; ?>">Update</a>
					</div>
				</div>
			</div>	
		<? endforeach; ?>	
	</div>
</div>
