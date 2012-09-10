<?php			
	$dbhost = "mysql11.000webhost.com";
	$dbuser = "a3102621_db1";
	$dbpassword = "itay1901";
	$database = "a3102621_db1";
	
	$db = mysql_connect($dbhost,$dbuser,$dbpassword);
	if (!$db) {
		die('Could not connect: ' . mysql_error());
	}
	if (!mysql_select_db($database)) {
		die('Could not select database: ' . mysql_error());
	}	
?>
