<?php
include("commonFunctions.php");

$db = openMySqlConnection();
session_start();
$userCheck=$_SESSION['loginUser'];

$result = mysql_query("select username from usersTable where username='$userCheck' ");

$row = mysql_fetch_array($result);

$login_session=$row['username'];

if(!isset($login_session)) {
	header("Location: login.php");
}
closeMySqlConnection($db);
?>