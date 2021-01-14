<?php
require_once "../functions.php";
if (isset($_POST['link'])) {
    //getting data from the table Orders 
    $rows_Orders = table_Orders ('select_one', $_POST['link'], NULL, NULL, NULL, NULL, NULL);
    foreach ($rows_Orders as $row_Orders) {
        # code...        
    }

    //getting data from the table Customers 
    $rows_Customers = table_Customers ('select_one', $row_Orders->CustomersLink, NULL, NULL, NULL, NULL, NULL);
    foreach ($rows_Customers as $row_Customers) {
        # code...
    }

    //getting data from the table Invoices 
    $rows_Invoices = table_Invoices ('select_one', $row_Orders->InvoicesLink, NULL, NULL, NULL, NULL, NULL);
    foreach ($rows_Invoices as $row_Invoices) {
        # code...
    }

    //getting data from the table Orders_List
    $rows_Orders_List = table_Orders_List ('select_one_order', $_POST['link'], NULL, NULL, NULL, NULL, NULL);

}
?>
<!-- view-orders-contents -->
<div class="view-orders-contents">
    <div class="view-orders-content">
        <div class="view-orders-customer">
             <div>
                <?php echo $row_Customers->Title.". ".$row_Customers->Name;?>
            </div>
        </div>
        <div class="view-orders-customer">
            <div>
                <?php echo $row_Customers->Address."<br>".$row_Customers->Town;?>
            </div>
        </div>
        <div class="view-orders-customer">
            <div>
                <?php echo $row_Customers->Mobile?>
            </div>
        </div>
        <div class="view-orders-customer">
            <div>
                <?php echo "Note: ". $row_Customers->Note;?>
            </div>
        </div>
        <div class="view-orders-list">
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Item</th>
                            <th>Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <? foreach ($rows_Orders_List as $row_Orders_List): ?>
                        <tr>
                            <td>
                                <? echo $row_Orders_List->ProductsCode; ?>
                            </td>
                            <td>
                                <? echo $row_Orders_List->Name.' | '.$row_Orders_List->Color.", ".$row_Orders_List->Size; ?>
                            </td>
                            <td>
                                <? echo $row_Orders_List->Qty; ?>
                            </td>
                        </tr>        
                        <? endforeach; ?>    
                    </tbody>
                </table>
            </div>
        </div>
        <div class="view-orders-summary">
            <div>
                Order Status: <? echo $row_Orders->Status; ?> 
            </div> 
            <div>
                Payment: <? echo $row_Invoices->Status; ?>
                <a href="../Invoices/Invoice-<? echo $row_Invoices->InvoiceNo; ?>.pdf">View Invoice</a>
            </div>
            <div>
                Delivery: <? //TODO ?>
            </div>
        </div>
    </div>    
</div>
<!-- end of view-orders-contents  -->