<?php
require_once "../functions.php";

if (empty($_SESSION['link'])) {
	$d = date('dM');
	$_SESSION['link'] = uniqid($d.'_', true);
	$ip = $_SERVER['REMOTE_ADDR'];
	insertSession($ip);
}

?>