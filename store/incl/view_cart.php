<?php  
require_once "../functions.php";

if (empty($_SESSION['link'])) {
	$d = date('dM');
	$_SESSION['link'] = uniqid($d.'_', true);
	$ip = $_SERVER['REMOTE_ADDR'];
	insertSession($ip);
}

//getting data from the table Cart
$db = new Database();
$stm = "SELECT * FROM Cart WHERE SessionLink = :SessionLink AND Status = 1 ORDER BY Created ASC;";
$db->query($stm);
$db->bind(":SessionLink", $_SESSION['link']);
$rows_Cart = $db->resultset();
$rowCount = $db->rowCount();

if ($rowCount == 0 ) {
	alert("Please add some items to your cart and come back!");
}
else {
	foreach ($rows_Cart as $row_Cart) {
	# code...
	}
}
?>
<!-- item-list-contain -->
<div class="item-list-contain">
	<div class="item-table">
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Item</th>
					<th>Qty.</th>
					<th>MMK</th>
				</tr>	
			</thead>
 			<tbody>
 				<?php foreach ($rows_Cart as $row_Cart): ?>
 					<? 
 					$rows_Products = table_Products ('select_one', $row_Cart->ProductsLink, NULL, NULL, NULL, NULL, NULL); 
 					foreach ($rows_Products as $row_Products) {
 						# code...
 					}
 					?>
 					<tr>
 						<td><div>&#10008;</div></td>
 						<td><? echo $row_Products->Name.": ".$row_Products->Color.", ".$row_Products->Size; ?></td>
 						<td>
 							<input type="number" class="qty" step="1" value="1" onchange="updatePrice(this.value, '<? echo $row_Cart->ProductsLink; ?>');">
 						</td>
 						<td>
 							<?php  
 							if ($row_Products->Discount > 0) {
 								$subtotal = $row_Products->Price - ($row_Products->Price * $row_Products->Discount / 100);			
 							}

 							else {
 								$subtotal = $row_Products->Price;
 							}
 							?>
 							<input type="text" class="subtotal" id="sub_<? echo $row_Cart->ProductsLink; ?>"  value="<? echo $subtotal; ?>" readonly>
 						</td>
 					</tr>
 				<?php endforeach ?>
 				<tr>
 					<td colspan="3" style="text-align: center;">Grand Total:</td>
 					<td><button type="button" onclick="calculateTotal('subtotal');">test</button></td>
 				</tr>
 			</tbody>
		</table>
	</div>
</div>
<!-- end of item-list-contain -->