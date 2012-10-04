<?php
include('dbconfig.php');
session_start();
$userCheck=$_SESSION['loginUser'];

$ses_sql=mysql_query("select username from usersTable where username='$userCheck' ");

$row=mysql_fetch_array($ses_sql);

$login_session=$row['username'];

if(!isset($login_session))
{
	header("Location: login.php");
}
?>