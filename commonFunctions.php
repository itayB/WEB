<?php

	function openMySqlConnection() {
		include("dbconfig.php");
		$db = mysql_connect($dbhost,$dbuser,$dbpassword);
		if (!$db) {
			die('Could not connect: ' . mysql_error());
		}
		if (!mysql_select_db($database)) {
			die('Could not select database: ' . mysql_error());
		}	
		// support hebrew
		mysql_query("SET character_set_client=utf8"); 
		mysql_query("SET character_set_connection=utf8"); 
		mysql_query("SET character_set_database=utf8"); 
		mysql_query("SET character_set_results=utf8"); 
		mysql_query("SET character_set_server=utf8"); 
		
		return $db;
	}

	function closeMySqlConnection($db) {
		mysql_close($db);
	}
	
	function getDir() {
		if ($_COOKIE['language'] == 'he')
				echo "rtl";
		else
				echo "ltr";
	}
	
	function getUserIndex($username) {
		$db = openMySqlConnection();
		$username =$_SESSION['loginUser']; 
		$SQL = "SELECT * FROM usersTable WHERE userName='$username'";
		$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
		$count = mysql_num_rows($result);
		$userIndex = "-1";
		if( $count > 0 ) {
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			$userIndex = $row['index'];
		}
		closeMySqlConnection($db);
		return $userIndex;
	}
	
	function updateLoginInfo($usernameIndex,$timestamp,$timezoneOffset) {
	
		// save current user ip
		$ipAddress = $_SERVER['REMOTE_ADDR'];
		
		// get entry from usersInfoTable
		
		$SQL = "SELECT * FROM usersInfoTable WHERE userIndex='$usernameIndex'";
		$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
		$count = mysql_num_rows($result);
		
		if( $count == 0 ) { // if entry doesn't exist - create it
			$SQL = "INSERT INTO usersInfoTable (userIndex, lastLoginTime, timezoneOffset, lastLoginIP) VALUES ($usernameIndex, '$timestamp', '$timezoneOffset', '$ipAddress')";
			$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error()); 
		}
		else { // else update existing entry
			$SQL = "UPDATE usersInfoTable SET lastLoginTime='$timestamp', timezoneOffset='$timezoneOffset', lastLoginIP='$ipAddress' WHERE userIndex=$usernameIndex";
			$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error()); 
		}
	}
?>