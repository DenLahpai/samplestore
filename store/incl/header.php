<?php 
require_once "../functions.php"; 

if (empty($_SESSION['link'])) {
    $d = date('dM');
    $ip = $_SERVER['REMOTE_ADDR'];
    $rdm = $d.'_'.md5($ip);
    $_SESSION['link'] = uniqid($rdm.'_', true);
    $device = $_SERVER['HTTP_USER_AGENT'];
    insertSession($ip, $device, $_SESSION['link']);
}

//getting rowCount of items in the shoppping cart
$db = new Database ();
$stm = "SELECT Id FROM Cart WHERE SessionLink = :SessionLink AND Status = 1;";
$db->query($stm);
$db->bind(":SessionLink", $_SESSION['link']);
$rowCount = $db->rowCount();


?>
<!-- header-bar -->
<div class="header-bar">
    <!-- header-bar-content -->
    <div class="header-bar-content">
        <div class="header-bar-logo">
            <a href="home.html"><img src="docs/logo.png" alt=""></a>
        </div>
    </div>
    <!-- end of header-bar-content -->
    <!-- header-bar-content -->
    <div class="header-bar-content">
        <div class="header-bar-menu-item">
            <input type="text" id="Search" name="Search" placeholder="Search an item">
        </div>             
        <div class="header-bar-menu-item">
            <img src="docs/search.png" alt="" onclick="searchItems();">
        </div>                     
        <div class="header-bar-menu-item" onclick="window.location.href='view_cart.html'; ">
            <img src="docs/cart.png" alt="">
            <?php if ($rowCount > 0): ?>
                <div class="rowCount-Cart"><? echo $rowCount; ?></div>
            <?php endif ?>
        </div>  
    </div>
    <!-- end of header-bar-content -->

</div>
<!-- end of header-bar