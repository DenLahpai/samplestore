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
?>