<?php
require_once "../functions.php";

//getting data from the table Brands
if (isset($_REQUEST['link'])) {
    $rows_Brands = table_Brands ('select_by_link', NULL, NULL, NULL, NULL, NULL, NULL);
    foreach ($rows_Brands as $row_Brands) {
        #code...
    }
}
?>
<div class="form">
    <form id="post-form" method="post" action="" enctype="multipart/form-data">
        <div>
            <input type="text" id="BrandsName" placeholder="Brand's Name" value="<? echo $row_Brands->BrandsName; ?>">
        </div>
        <div>
            <input type="text" id="Country" placeholder="Country of the brand" value="<? echo $row_Brands->Country; ?>">
        </div>
        <?php if (empty($row_Brands->Image) ): ?>
        <div>
            <label for="Image">Upload Image</label>
            <input type="file" style="display: none;" name="Image" id="Image" onchange="imagePreview(this);">   
        </div>
        <div class="image_preview">
            <img id="image_preview">
        </div>
        <?php else: ?>
        <div>
            <label for="Image">Change Image</label>
            <input type="file" style="display: none;" name="Image" id="Image" onchange="imagePreview(this);">   
        </div>
        <div class="image_preview">
            <img id="image_preview" src="<? echo "../logos/".$row_Brands->Image; ?>">
        </div>
        <?php endif; ?>    
        <div>
            <button type="button" id="btn-submit" class="medium-button" onclick="updateBrands('<? echo $_REQUEST['link']?>');">Submit</button>
        </div>                        
    </form>    
</div>   