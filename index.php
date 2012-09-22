<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-8-i" />

<?php
include("Mobile_Detect.php");
include("DesktopFrontPage.php");
include("defines.php");
include("commonFunctions.php");

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
		include("dbconfig.php");
		
		if(isset($_POST['username']) && !empty($_POST['username']) AND isset($_POST['password']) && !empty($_POST['password'])) {  
			$username = mysql_escape_string($_POST['username']);
			$password = md5(mysql_escape_string($_POST['password']));

			$SQL = "SELECT userName,active FROM usersTable WHERE (userName='$username' AND password='$password')";

			$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
			$count = mysql_num_rows($result);
			
			if( $count == 0 ) {
				$error=$usernameOrPasswordInvalidMsg;
			} else {
				$row = mysql_fetch_array($result,MYSQL_ASSOC);
				if ($row['active'] == '0') {
					$error="Make sure that you have activated your account.";
				} else {
					session_register("username");
					$_SESSION['loginUser']=$username;
					header("location: login.php");
				}
			}
		}
		else {
			$error=$missingFieldsMsg;
		}
	}
	else if(isset($_POST['signup'])) {
		header("location: signup.php");
	}
	
?>

<title>Itay <? print $host; ?></title>
	
	<link rel="stylesheet" type="text/css" href="style.php" />
	<link rel="stylesheet" type="text/css" media="screen" href="jQuery-UI/css/ui-lightness/jquery-ui-1.8.23.custom.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="jqGrid/css/ui.jqgrid.css" />
	
	<script src="jquery-1.8.0.min.js"></script>
	<script src="jqGrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="jqGrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>

<script>
	function validateKey(element) {
		var valid = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"
		var key;

		if(window.event) // IE8 and earlier
			key=String.fromCharCode(event.keyCode);
		else if(event.which) // IE9/Firefox/Chrome/Opera/Safari
			key=String.fromCharCode(event.which);
		
		if (valid.indexOf(key) == -1) {
			alert("<?php echo $invalidKeyMessage; ?>");
			return false;
		}
	}	
</script>
</head>
<body style="margin: 0;padding: 0" dir="<?php getDir() ?>" >
<div class="topFrame">
</div>
	<form action="" method="post">
		<div id="signupDiv">
			<h for="signupButton" style="color:white"><?php echo $signUpMessage; ?></h>
			<input name="signup" type="submit" id="signupButton" value="<?php echo $signUp; ?>" class="buttonsClass" style="right:5px;">
		</div>
		<div class="loginBox">
			<input name="username" placeholder="<?php echo $usernameHint; ?>" class="inputClass" style="width:150px;" onkeypress="return validateKey(this)">
			<input name="password" type="password" placeholder="<?php echo $passwordHint; ?>" class="inputClass" style="width:150px;">
			<input name="signin" type="submit" value="<?php echo $signIn; ?>" class="buttonsClass">
			<div style="font-size:14px; color:red; margin-left:5px"><?php echo $error; ?></div>
		</div>
		
<?php include("bottomToolbar.php"); ?>
		
	</form>

</body>
</html>
