<?php
	function getDir() {
		if ($_COOKIE['language'] == 'he')
				echo "rtl";
		else
				echo "ltr";
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