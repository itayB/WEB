<?php
if($_COOKIE['language']==""){
	$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];//Detecting Default Browser language
}
else {
	$lang = $_COOKIE['language'];//Detecting if cookie was set
}
switch($lang){
	case "en":
		require("lang/english.php");
		break;
	case "he":
		require("lang/hebrew.php");
		break;
	default:
		require("lang/english.php");
		break;
}
?>