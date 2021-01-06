<?php 
require_once "../functions.php"; 

//making sure that there is a session 
if (empty($_SESSION['link'])) {
    $d = date('dM');
    $_SESSION['link'] = uniqid($d.'_', true);
    $ip = $_SERVER['REMOTE_ADDR'];
    insertSession($ip);
}

//getting rowCount of items in the shoppping cart
$db = new Database ();
$stm = "SELECT Id FROM Cart WHERE SessionLink = :SessionLink ;";
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
        <div class="header-bar-menu-item">
            <img src="docs/cart.png" alt="">
            <?php if ($rowCount > 0): ?>
                <div class="rowCount-Cart"><? echo $rowCount; ?></div>
            <?php endif ?>
        </div>  
    </div>
    <!-- end of header-bar-content -->

</div>
<!-- end of header-bar