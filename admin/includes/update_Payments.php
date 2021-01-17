<?php
require_once "../functions.php";
//getting data from table Payments and Invoices
$rows_Payments = table_Payments ('select_one', $_POST['link'], NULL, NULL, NULL, NULL, NULL);
foreach ($rows_Payments as $row_Payments) {
    # code...
}
?>
<div class="form">
    <form action="#" method="post" id="payments-form">
        <div>
            <input type="hidden" name="InvoicesLink" id="InvoicesLink" value="<? echo $_POST['link']; ?>">
        </div>
        <div>
            <input type="text" name="Status" id="Status" value="<? echo $row_Payments->Status; ?>">
        </div>
        <div>
            <input type="text" name="Method" id="Method" placeholder="Payment Method" value="<? if (!empty($row_Payments)){ echo $row_Payments->Method; } ?>">
        </div>
        <div>
            <input type="date" name="PaidOn" id="PaidOn" value="<? if (!empty($row_Payments->PaidOn)) { echo $row_Payments->PaidOn; } ?>">
        </div>
        <div>
            <button type="button" id="btn-submit" onclick="updatePayments();">Update</button>
        </div>
    </form>
</div>