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
	
	mysql_query("SET character_set_client=utf8"); 
	mysql_query("SET character_set_connection=utf8"); 
	mysql_query("SET character_set_database=utf8"); 
	mysql_query("SET character_set_results=utf8"); 
	mysql_query("SET character_set_server=utf8"); 
?>
