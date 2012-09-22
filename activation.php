<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-8-i" />

<?php
include("defines.php");
include("commonFunctions.php");

if(isset($_GET['username']) && !empty($_GET['username']) AND isset($_GET['hash']) && !empty($_GET['hash'])){  
    $username = mysql_escape_string($_GET['username']);
    $hash = mysql_escape_string($_GET['hash']);
	
	include("dbconfig.php");
	$search = mysql_query("SELECT username, hash, active FROM usersTable WHERE username='".$username."' AND hash='".$hash."' AND active='0'") or die(mysql_error());  
	$match  = mysql_num_rows($search);  
	if($match > 0){  
		// We have a match, activate the account  
		mysql_query("UPDATE usersTable SET active='1' WHERE username='".$username."' AND hash='".$hash."' AND active='0'") or die(mysql_error());  
		$msg = "Your account has been activated, you can now login."; 
	}else{  
		// No match -> invalid url or account has already been activated.
		$msg = "The url is either invalid or you already have activated your account.";		
	}  
}
else {
	$msg = $emailActivationMsg."<br>".$activationGuideMsg."<a href=\"/activation.php\">".$resendActivationEmailMsg."</a>.";
	
}
?>
<title>Account Activation <? print $host; ?></title>
	
	<link rel="stylesheet" type="text/css" href="style.php" />
	<link rel="stylesheet" type="text/css" media="screen" href="jQuery-UI/css/ui-lightness/jquery-ui-1.8.23.custom.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="jqGrid/css/ui.jqgrid.css" />
	
	<script src="jquery-1.8.0.min.js"></script>
	<script src="jqGrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="jqGrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>


</head>
<body style="margin: 0;padding: 0" dir="<?php getDir() ?>" >
<div class="topFrame" ></div>

<div class="statusMsg">
	<?php echo $msg ?>
</div>

<?php include("bottomToolbar.php"); ?>
		
</body>
</html>
