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
            <input type="text" id="ProductsLink" name="ProductsLink" value="<? echo $_REQUEST['link']; ?>">
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
            Gender:<br>
            <select name="Gender" id="Gender">
                <? if ($row_Products->Gender == "F"): ?>
                    <option value="F" selected>F - Women</option>
                    <option value="M">M - Men</option>
                    <option value="U">U - Unisex</option>
                <? elseif ($row_Products->Gender == "M"): ?>
                    <option value="F">F - Women</option>
                    <option value="M" selected>M - Men</option>
                    <option value="U">U - Unisex</option>
                <? else: ?>
                    <option value="F">F - Women</option>
                    <option value="M">M - Men</option>
                    <option value="U" selected>U - Unisex</option>
                <? endif; ?>    
            </select>
        </div>
        <div>
            Size:<br>
            <select name="Size" id="Size">
                <? if ($row_Products->Size == 'FREE'): ?>
                    <option value="FREE" selected>Free Size</option>
                    <option value="S">Small</option>
                    <option value="M">Medium</option>
                    <option value="L">Large</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                <? elseif ($row_Products->Size == 'S'): ?>
                    <option value="FREE">Free Size</option>
                    <option value="S" selected>Small</option>
                    <option value="M">Medium</option>
                    <option value="L">Large</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                <? elseif ($row_Products->Size == "M"): ?>
                    <option value="FREE">Free Size</option>
                    <option value="S">Small</option>
                    <option value="M" selected>Medium</option>
                    <option value="L">Large</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                <? elseif ($row_Products->Size == "L"): ?>
                    <option value="FREE">Free Size</option>
                    <option value="S">Small</option>
                    <option value="M">Medium</option>
                    <option value="L" selected>Large</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                <? elseif ($row_Products->Size == "XL"): ?>
                    <option value="FREE">Free Size</option>
                    <option value="S">Small</option>
                    <option value="M">Medium</option>
                    <option value="L">Large</option>
                    <option value="XL" selected>XL</option>
                    <option value="XXL">XXL</option>
                <? elseif ($row_Products->Size == "XXL"): ?>
                    <option value="FREE">Free Size</option>
                    <option value="S">Small</option>
                    <option value="M">Medium</option>
                    <option value="L">Large</option>
                    <option value="XL">XL</option>
                    <option value="XXL" selected>XXL</option>
                <? else : ?>
                <? endif; ?>
            </select>        
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
            <a href="">Add more Images</a>
        </div>
    </div>
</div>
<!-- end of form -->