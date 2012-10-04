<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-8-i" />

<?php
include('lock.php');
include("defines.php");
include("commonFunctions.php");
?>

<?php
function getLastTimestamp() {
	$username =$_SESSION['loginUser']; 
	include("dbconfig.php");
	$SQL = "SELECT * FROM usersTable WHERE userName='$username'";
	$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
	$count = mysql_num_rows($result);
	if( $count > 0 ) {
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$userIndex = $row['index'];
		$SQL = "SELECT * FROM usersInfoTable WHERE userIndex='$userIndex'";
		$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
		$count = mysql_num_rows($result);
		if( $count > 0 ) {
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			$lastLoginTime = $row['lastLoginTime'];
			updateLoginInfo($userIndex,$_SESSION['timestamp'],$_SESSION['timezoneOffset']);
			return $lastLoginTime;
		}
	}
	return "0";
}

?>
	
<title>Welcome  <?php echo $login_session; ?></title>
	
	<link rel="stylesheet" type="text/css" href="style.php" />
	<link rel="stylesheet" type="text/css" media="screen" href="jQuery-UI/css/ui-lightness/jquery-ui-1.8.23.custom.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="jqGrid/css/ui.jqgrid.css" />
	<script src="jquery-1.8.0.min.js"></script>
	<script src="jqGrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="jqGrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
	<script>
		function getLoginTime() {
			var currentTimestamp = <?php echo $_SESSION['timestamp']; ?>; // it's take the old one somehow... try to parse the min of this num 
			var lastTimestamp = <?php echo getLastTimestamp(); ?>;
			var date = new Date(lastTimestamp);
			var lastDateString = "Your last login was at: ";
			lastDateString += date.getDate() + "/" + (date.getMonth()+1) + "/" + date.getFullYear() + ", " + date.getHours() + ":" + date.getMinutes();
			document.getElementById("loginTime").textContent = lastDateString;
			document.getElementById("loginTime").nodeValue = lastDateString;
		}
	</script>
</head>
<body style="margin: 0;padding: 0" dir="<?php getDir() ?>" onload="getLoginTime();">
	<div class="topFrame">
	</div>

	<div id="signoutDiv">
		<a href="logout.php"><?php echo $signout; ?></a>
	</div>
	<div id="welcomeDiv">
		<p><?php echo $welcome; ?> <?php echo $login_session; ?>,</p>
	</div>	

	<p id="loginTime"></p>
			
	<?php 
		//echo "<br>";
		//foreach ($_FILES['uploadedfile'] as $i => $value) {
		//	echo $_FILES['uploadedfile'][$i].",".$i;
		//	echo "<br>";	
		//}
		//echo "<br>";
		if ($_FILES['uploadedfile'] != null) {
			$filename = $_FILES['uploadedfile']['tmp_name'];	// the file saved with temporary filename 

			//echo "<br>";
			$homepage = file_get_contents($filename,FILE_USE_INCLUDE_PATH);
			echo $homepage;
		}
		
		// test the following 4 lines!!!!!!!!!!!!!!!!!!!
		/*
		$xml = simplexml_load_file("test.xml");

		echo $xml->getName() . "<br />";

		foreach($xml->children() as $child)
		 {
		  echo $child->getName() . ": " . $child . "<br />";
		 }
		*/
	?>
	<form enctype="multipart/form-data" action="" method="POST">
		<input type="file" name="uploadedfile">
		<input type="submit" value="Upload File" />
	</form>
	
	<table id="userTable"></table>
	<div id="userPager"></div>	
	<script>
		$(function(){
			$("#userTable").jqGrid({
				url:'example.php',
				datatype: 'xml',
				mtype: 'GET',				
				height: 300, 
				colNames:['id','Name','e-mail'], 
				colModel:[ 
					{name:'id',index:'id', width:100}, 
					{name:'name',index:'name', width:200},
					{name:'email',index:'email', width:250}
				],
				pager: '#userPager',
				rowNum:10,
				rowList:[10,20,30],
				sortname: 'id',
				sortorder: 'desc',
				viewrecords: true,
				gridview: true,
				caption: "Users table" 
			}); 
		});
	</script>	
	
	<form action="" method="post">
	<?php include("bottomToolbar.php"); ?>
	<form>
	
</body>
</html>