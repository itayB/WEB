<?php
	include("dbconfig.php");

	$page = $_GET['page']; // get the requested page
	$limit = $_GET['rows']; // get how many rows we want to have into the grid
	$sidx = $_GET['sidx']; // get index row - i.e. user click to sort
	$sord = $_GET['sord']; // get the direction
	if(!$sidx) $sidx =1;
	// connect to the database
	
	$db = mysql_connect($dbhost,$dbuser,$dbpassword);
	if (!$db) {
		die('Could not connect: ' . mysql_error());
	}
	if (!mysql_select_db($database)) {
		die('Could not select database: ' . mysql_error());
	}	
		
	$result = mysql_query("SELECT COUNT(*) AS count FROM users");
	$row = mysql_fetch_array($result,MYSQL_ASSOC);
	$count = $row['count'];

	if( $count >0 ) {
		$total_pages = ceil($count/$limit);
	} else {
		$total_pages = 0;
	}
	if ($page > $total_pages) $page=$total_pages;
	$start = $limit*$page - $limit; // do not put $limit*($page - 1)
	$SQL = "SELECT id,name,email FROM users";// ORDER BY $sidx $sord LIMIT $start , $limit";
	$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());

	// we should set the appropriate header information. Do not forget this.
	header("Content-type: text/xml;charset=utf-8");
	 
	$s = "<?xml version='1.0' encoding='utf-8'?>";
	$s .=  "<rows>";
	$s .= "<page>".$page."</page>";
	$s .= "<total>".$total_pages."</total>";
	$s .= "<records>".$count."</records>";
	 
	// be sure to put text data in CDATA
	while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
		$s .= "<row id='". $row['id']."'>";            
		$s .= "<cell>". $row['id']."</cell>";
		$s .= "<cell>". $row['name']."</cell>";
		$s .= "<cell>". $row['email']."</cell>";
		$s .= "</row>";
	}
	$s .= "</rows>"; 
	 
	echo $s;
?>	