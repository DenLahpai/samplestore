<?php
require_once "../functions.php";

if (isset($_REQUEST['link'])) {
    $rows_Products = table_Products ('select_by_link', NULL, NULL, NULL, NULL, NULL, NULL);
    foreach ($rows_Products as $row_Products) {
        #code...         
    }
}
?>
<!-- form -->
<div class="form">
    <form action="#" method="post" enctype="multipart/form-data">
    <?  if ($row_Products->MainImg == "" || empty($row_Products->MainImg)): ?>
        <div style="text-align: center">
            <label for="Image" style="text-align: center;">Upload Image</label>
            <input type="file" style="display: none;" name="Image" id="Image" onchange="imagePreview(this);">
        </div>
        <div style="text-align: center;">
            <button type="button" id="btn-submit" class="medium-button" onclick="updateMainImg('<? echo $_REQUEST['link']; ?>');">Submit</button>
        </div>
        <div style="text-align: center;">
            <div class="image_preview"  style="text-align: center;">
                <img id="image_preview">
            </div>
        </div>
    <? else: ?>
        <div style="text-align: center;">
            <label for="Image" style="text-align: center;">Change Image</label>
            <input type="file" style="display: none;" name="Image" id="Image" onchange="imagePreview(this);">
        </div>
        <div style="text-align: center;">
            <button type="button" id="btn-submit" class="medium-button" onclick="updateMainImg('<? echo $_REQUEST['link']; ?>');">Submit</button>
        </div>
        <div style="text-align: center;">
            <div class="image_preview">
                <img id="image_preview" src="../images/<? echo $row_Products->MainImg; ?>" alt="">
            </div>
        </div>
    <? endif; ?>        
    </form>
</div>
<!-- end of form -->