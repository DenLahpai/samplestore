<?php
require_once "fonctions.php";
$d = date('dM');
$_SESSION['link'] = uniqid($d.'_', true);
$ip = $_SERVER['REMOTE_ADDR'];
getSession($ip);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="refresh" content="3;home.html">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="Shortcut icon" href="lotus-flower.png"/>
	<title>Welcome</title>
	<style>
		.logo  {
            width: 100%;
            height: auto;
            text-align: center;
        }
        .logo img {
            display: block;
            width: 100%;
        }
	</style>
</head>
</head>
<body>
    <div class="logo">
        <img src="lotus-flower.png" alt="">
    </div>
</body>
</html>