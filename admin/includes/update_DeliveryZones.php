<?php
require_once "../functions.php";
if (isset($_REQUEST['link'])) {
    //getting data from the table Delivery Fees
    $rows = table_Delivery_Fees ('select_one', $_REQUEST['link'], NULL, NULL, NULL, NULL, NULL);
    foreach ($rows as $row) {
        # code...
    }

}
else {
    echo "<span style='color: red'>There was a connection error! Please try agian!</span>";
}
?>
<div class="form">
    <form action="#" method="post" id="myform">
        <div>
            <input type="hidden" id="link" name="link" value="<? echo $_REQUEST['link']; ?>">
        </div>
        <div>
            <input type="text" id="Town" name="Town" placeholder="Town / City" value="<? echo $row->Town; ?>">
        </div>
        <div>
            <input type="text" id="Township" name="Township" placeholder="Township" value="<? echo $row->Township; ?>">
            <br>
            <span style="font-style: italic; ">Note: do not put anything in township if the delivery fees for all townships of Yangon are the same.</span>
        </div>
        <div>
            <input type="number" id="Fees" name="Fees" placeholder="Fees" value="<? echo $row->Fees; ?>">
        </div>
        <div>
            <input type="text" id="Remark" name="Remark" placeholder="Direct to home? Or Express bus station only?" value="<? echo $row->Remark; ?>">
        </div>
        <div>
            <button type="button" class="medium-button" id="btn-submit" onclick="updateDelivery_Fees();">Submit</button>
        </div>
    </form>
</div>