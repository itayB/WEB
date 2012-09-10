<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-8-i" />
<title>Itay <? print $host; ?></title>
	
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="jQuery-UI/css/ui-lightness/jquery-ui-1.8.23.custom.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="jqGrid/css/ui.jqgrid.css" />
	
	<script src="jquery-1.8.0.min.js"></script>
	<script src="jqGrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="jqGrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
<style type="text/css">
.box{
	border:#666666 solid 3px;
}
</style>
</head>
<body style="margin: 0;padding: 0">
<div class="topFrame">
</div>

<?php
include("Mobile_Detect.php");
include("DesktopFrontPage.php");

$detect = new Mobile_Detect();

if($detect->isiOS()){
    // code to run for the Apple iOS platform.
}
if($detect->isAndroidOS()){
    // code to run for the Google Android platform.
}
if ($detect->isMobile()) {
    // any mobile platform
}
if($detect->isTablet()){
    // any tablet
}
if(!$detect->isMobile() && !$detect->isTablet()){
    // any desktop
	//show();
}

	if(isset($_POST['signin'])) {
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			include("dbconfig.php");
			
			$username = $_POST["username"];
			$password = $_POST["password"];

			$SQL = "SELECT COUNT(*) AS count FROM usersTable WHERE (userName='$username' AND password='$password')";

			$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			$count = $row['count'];

			//echo $result;
			//echo "<br>";

			//echo $row;
			//echo "<br>";	
			
			//echo $count;
			//echo "<br>";
			
			if( $count >0 ) {
				session_register("username");
				$_SESSION['loginUser']=$username;
				header("location: login.php");
			} else {
				$error="Username or Password is invalid";
			}
		}
	}
	else if(isset($_POST['signup'])) {
		header("location: signup.php");
	}
?>
	<form action="" method="post">
		<div style="position:fixed;top:3px;right:5px;">
			<h for="signupButton" style="color:white">don't have account?</h>
			<input name="signup" type="submit" id="signupButton" value="Sign up" class="buttonsClass" style="right:5px;">
		</div>
		<div class="loginBox">
			<input name="username" placeholder="Username" class="inputClass">
			<input name="password" type="password" placeholder="Password" class="inputClass">
			<input name="signin" type="submit" value="Sign in" class="buttonsClass">
			<div style="font-size:14px; color:red; margin-left:5px"><?php echo $error; ?></div>
		</div>
	</form>


</body>
</html>
