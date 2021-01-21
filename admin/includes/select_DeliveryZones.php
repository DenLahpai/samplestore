<?php
require_once "../functions.php";
$db = new Database();
$stm = "SELECT * FROM Delivery_Fees ORDER BY Updated  DESC ;";
$db->query($stm);
$rows = $db->resultset();
?>
<!-- Delivery-Zones-container -->
<div class="Delivery-Zones-container">
    <div class="boxes">
        <? foreach ($rows as $row): ?>
        <div class="Delivery-Zones-box" onclick="window.location.href= 'update_DeliveryZones.html?link=<? echo $row->Delivery_FeesLink ?>' ">
            <div class="Delivery-Zones-box-header">
                <div>
                    <? echo $row->Town.", ".$row->Township; ?>
                </div>
            </div>
            <div class="Delivery-Zones-box-body">
                <div>
                    Delivery Fees: <? echo $row->Fees." MMK"; ?>
                </div>
                <div>
                    Remark: <? echo $row->Remark; ?>
                </div>
            </div>
        </div>    
        <? endforeach; ?>    
    </div>
</div>
<!-- end of Delivery-Zones-container -->