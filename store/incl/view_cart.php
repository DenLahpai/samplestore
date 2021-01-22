<?php  
require_once "../functions.php";

if (empty($_SESSION['link'])) {
	$d = date('dM');
	$ip = $_SERVER['REMOTE_ADDR'];
	$_SESSION['link'] = uniqid($d.'_', true);
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
	echo "Please add some items to your cart and come back!";
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
 				<?php
 				$i = 1; 
 				foreach ($rows_Cart as $row_Cart): 
 				?>
 					<? 
 					$rows_Products = table_Products ('select_one', $row_Cart->ProductsLink, NULL, NULL, NULL, NULL, NULL); 
 					foreach ($rows_Products as $row_Products) {
 						# code...
 					}
 					?>
 					<tr>
 						<td>
 							<div style="cursor: pointer;" onclick="removeItem('<? echo $row_Cart->ProductsLink; ?>')">&#10008;</div>
 							
 							<input type="hidden" id="ProductsLink<? echo $i;?>" name="ProductsLink<? echo $i;?>" value="<? echo $row_Cart->ProductsLink; ?>">
 						</td>
 						<td><? echo $row_Products->Name.": ".$row_Products->Color.", ".$row_Products->Size; ?></td>
 						<td>
 							<input type="number" class="Qty" id="Qty<? echo $i; ?>" name="Qty<? echo $i; ?>" step="1" min=1  value="<? echo $row_Cart->Qty; ?>" onchange="updatePrice(<? echo $i; ?>, 'subtotal', '<? echo $row_Cart->ProductsLink; ?>');">
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
 							<input type="number" class="subtotal" id="subtotal<? echo $i; ?>" name="subtotal<? echo $i; ?>" value="<? echo $subtotal * $row_Cart->Qty; ?>" readonly>
 						</td>
 					</tr>
 				<?php
 					$i++; 
 					endforeach; 
				?>	
					<tr id="deli-fees">
						
					</tr>
					<tr style="border-top: 2px solid silver;">
						<td colspan="3" style="text-align: center;">Grand Total:</td>
						<td style="text-align: right"><div id="grand-total"></div></td>
					</tr>
 			</tbody>
		</table>
	</div>
</div>
<!-- end of item-list-contain -->
<div class="client-form">
	<form action="#" id="client-form" method="post">
		<div>
			Title:
			<select name="Title" id="Title">
				<option value="Mr">Mr.</option>
				<option value="Mrs">Mrs.</option>
				<option value="Ms">Ms.</option>
			</select>
		</div>
		<div>
			<input type="text" name="Name" id="Name" placeholder="Your Name">
		</div>
		<div>
			<input type="text" name="Email" id="Email" placeholder="Email" onblur="validateEmail (this.value);">
		</div>
		<div>
			<input type="text" name="Mobile" id="Mobile" placeholder="Mobile No">
		</div>
		<div>
			<textarea name="Address" id="Address" cols="30" rows="10" placeholder="Address"></textarea>
		</div>
		<div>
			<select name="Delivery_FeesLink" id="Delivery_FeesLink" onchange="applyDeliFees(this.value);">
				<option value="Select Township"></option>
			</select>
		</div>
		<div>
			<textarea name="Note" id="Note" cols="30" rows="3" placeholder="Deliver Note"></textarea>
		</div>
		<div id="msg">
					 
		</div>						
	</form>
</div>
<div class="button-menu">
	<button type="button" onclick="createOrder();">Confirm Your Order</button>
</div>
<script>

$(document).ready(function () {
	calculateTotal ('subtotal');
});	
</script>