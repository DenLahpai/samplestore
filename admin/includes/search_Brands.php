<?php
require_once "../functions.php";
if (empty($_POST['order'])) {
    $order = "ORDER BY Id ASC ";
}
else  {
    $order = $_POST['order'];
}

if (empty($_POST['limit'])) {
    $limit = 10;
}
else {
    $limit = $_POST['limit'];   
}

if (empty($_POST['page'])) {
    $page = 1;
}
else {
    $page = $_POST['page'];
}

//getting offset
$offset = ($page * $limit) - $limit;

if (isset($_REQUEST['Search']) || !empty($_REQUEST['Search'])) {
    $Search = '%'.$_REQUEST['Search'].'%';
    $rows_Brands = table_Brands ('search', $Search, NULL, NULL, $order, $limit, $offset);
    
}
?>

<!-- module-cards-container -->
<div class="module-cards-container">
<?php foreach($rows_Brands as $row_Brands): ?>
    <!-- module-card -->
    <div class="module-card" id="module-brands">
        <!-- module-card-body -->
        <div class="module-card-body">
            <!-- module-card-body-contents -->
            <div class="module-card-body-contents">
                <!-- module-card-title -->
                <div class="module-card-title">                    
                    <div class="logo">
                    <? if (!empty($row_Brands->Image)):?>
                        <?  
                        $ext = explode('.', $row_Brands->Image);
                        $file_ext = strtolower(end($ext)); 
                        if ($file_ext == 'png'):   
                        ?>
                            <img src="<? echo '../logos/'.$row_Brands->Image; ?>" alt="" onclick="<? echo "window.location.href='../logos/".$row_Brands->Image."'";?>">
                        <? else: ?>
                            <img src="<? echo '../logos/thumbnails/'.$row_Brands->Image; ?>" alt="" onclick="<? echo "window.location.href='../logos/".$row_Brands->Image."'";?>">
                        <? endif; ?>    
                    <? else: ?>
                        <button type="button" onclick="<? echo "window.location.href='update_image_Brands.html?link=".$row_Brands->BrandsLink."'"; ?>">Add a logo!</button>    
                    <? endif;?>    
                    </div>
                </div>
                <!-- end of module-card-title  -->
            </div>
            <!-- end of module-card-body-contents -->
            <!-- module-card-body-contents -->
            <div class="module-card-body-contents">
                <div class="module-card-body-contents-desc">
                    <h3><? echo $row_Brands->BrandsName; ?></h3>
                    <div>
                        <? echo $row_Brands->Country; ?>
                    </div>
                </div>
            </div>                                
            <!-- end of module-card-body-contents -->            
            <!-- module-card-body-contents  -->
            <div class="module-card-body-contents">
                <div class="module-card-body-contents-count" onclick="window.location.href='<? echo "update_Brands.html?link=$row_Brands->BrandsLink";?>'">
                    <div class="row-counts">
                        <p>Edit</p>
                    </div>
                    <div>
                        <a href="<? echo "update_image_Brands.html?link=$row_Brands->BrandsLink"; ?>">Update Logo</a>
                    </div>                    
                </div>
            </div>
            <!-- end of module-card-body-contents -->
        </div>
        <!-- end of module-card-body -->
    </div>
    <!-- end of module-card -->
<? endforeach;?>    
</div>
<!-- end of module-cards-container -->