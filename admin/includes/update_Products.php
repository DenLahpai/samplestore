<?php
require_once "../functions.php";
if (isset($_REQUEST['link'])) {
    // getting data from the table Products
    $rows_Products = table_Products ('select_by_link', NULL, NULL, NULL, NULL, NULL, NULL);
    foreach ($rows_Products as $row_Products) {
        #code...
    }

    // getting data from the table Brands 
    $db = new Database();
    $stm = "SELECT * FROM Brands; ";
    $db->query($stm);
    $rows_Brands = $db->resultset();
}
?>
<!-- form -->
<div class="form">
    <form action="#" method="post" id="update_Products">
        <div>
            <input type="hidden" id="ProductsLink" name="ProductsLink" value="<? echo $_REQUEST['link']; ?>">
        </div>
        <div>
            Brand:<br>
            <select name="BrandsId" id="BrandsId">
                <?
                foreach ($rows_Brands as $row_Brands) {
                    if ($row_Products->BrandsId == $row_Brands->Id) {
                        echo "<option value=\"$row_Brands->Id\" selected>".$row_Brands->BrandsName."</option>";
                    }
                    else {
                        echo "<option value=\"$row_Brands->Id\">".$row_Brands->BrandsName."</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div>
            Code:<br>
            <input type="text" id="ProductsCode" name="ProductsCode" value="<? echo $row_Products->ProductsCode; ?>">    
        </div>
        <div>
            Name:<br>
            <input type="text" name="Name" id="Name" value="<? echo $row_Products->Name; ?>">
        </div>
        <div>
            Category: <br>
            <input type="text" name="Cat1" id="Cat1" value="<? echo $row_Products->Cat1; ?>">
        </div>
        <div>
            For: <br>
            <select name="TargetsId" id="TargetsId">
                <?php  
                $rows_Targets = table_Targets ('select_all', NULL, NULL, NULL, NULL, NULL, NULL);
                foreach ($rows_Targets as $row_Targets) {
                    if ($row_Targets->Id == $row_Products->TargetsId) {
                        
                        echo "<option value=\"$row_Targets->Id\" selected>".$row_Targets->TargetsCode.' - '.$row_Targets->Target."</option>";
                    }
                    else {
                        echo "<option value=\"$row_Targets->Id\">".$row_Targets->TargetsCode.' - '.$row_Targets->Target."</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div>
            Size:<br>
            <input type="text" name="Size" id="Size" value="<? echo $row_Products->Size; ?>">
        </div>
        <div>
            <textarea name="Description" id="Description" cols="27" rows="10"><? echo $row_Products->Description; ?></textarea>
        </div>
        <div>
            Price:<br>
            <input type="number" name="Price" id="Price" value="<? echo $row_Products->Price; ?>">
        </div>
        <div>
            Discount:<br>
            <input type="number" step="0.01" name="Discount" id="Discount" onchange="setTwoNumberDecimal(this.value, 'Discount');" value="<? echo $row_Products->Discount; ?>">
        </div>
        <div>
            Color:<br>
            <input type="text" name="Color" id="Color" placeholder="Color" value="<? echo $row_Products->Color; ?>" onblur="previewColor(this.value);">
        </div>
        <div style="text-align: center;">
            Preview Color: <br>
            <div class="color-preview" style="border: 1px solid black; background: <? echo $row_Products->Color; ?>; display: inline-block;"></div>
        </div>
        <div style="text-align: center;">
            <button type="button" class="medium-button" onclick="updateProducts();">Submit</button>
        </div>
    </form>
    <div class="additional-links">
        <div>
            <a href="update_main_img_Products.html?link=<? echo $_REQUEST['link']; ?>">Change main Image</a>
        </div>
        <div>
            <a href="upload_img_Products.html?link=<? echo $_REQUEST['link'];?>&src=not_main" >Add more Images</a>
        </div>
    </div>
</div>
<!-- end of form -->