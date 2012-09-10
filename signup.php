<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-8-i" />
	<title>Signup free</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<script>
	function clearErrorMessage(input) {
		document.getElementById(input.name + 'ErrorMessage').textContent = "";
	}
	
	function submitValidation() {
		// clear messages
		document.getElementById('generalErrorMessage').textContent = "";
	
		// verify empty fields
		var emptyInput = false;
		var inputArray = document.getElementsByTagName('input');
		for (var i = 0; i < inputArray.length; i++) {
			if (inputArray[i].value == "" ) {
				var messageName = inputArray[i].name + 'ErrorMessage';
				if (document.getElementById(messageName) != null) {
					document.getElementById(messageName).textContent = "missing field";
					emptyInput = true;
				}
			}
		}
		
		if (emptyInput)
			return false;
		
		// verify password
		if (document.getElementsByName('password')[0].value != document.getElementsByName('passwordVerification')[0].value) {
			document.getElementById('generalErrorMessage').textContent = "Password doesn't match";
			return false;
		}		
		return true;
	}
	
	function inputValidation(input) {
		if (input.value != "")
			document.getElementById(input.name + 'ErrorMessage').textContent = "";
		else
			document.getElementById(input.name + 'ErrorMessage').textContent = "missing field";
	}
</script>
<?php
	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
		include("dbconfig.php");
		
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$email = $_POST["email"];
		
		$SQL = "SELECT COUNT(*) AS count FROM usersTable WHERE userName='$username'";

		$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		$count = $row['count'];
		
		if( $count == 0 ) {
			$SQL = "INSERT INTO usersTable (userName, password, email, firstName, lastName) VALUES ('$username', '$password', '$email', '$firstname', '$lastname')";
			$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
			echo "created succussfully";
		}
		else {
			$error="Username already exist - Please choose other uesrname.";
		}
	}
?>

	<form action="" method="post">
	<table align="center">
		<tr>
			<td>
				<br>
				<div id="generalErrorMessage" class="errorClass"></div>
			</td>
		</tr>
		<tr>
			<td>
				<label for="firstname">First name</label>
			</td>
			<td>
				<input name="firstname" class="inputClass" onclick="clearErrorMessage(this)">
			</td>
			<td>
				<div id="firstnameErrorMessage" class="errorClass"></div>
			</td>			
		</tr>
		<tr>
			<td>
				<label for="lastname">Last name</label>
			</td>
			<td>
				<input name="lastname" class="inputClass" onclick="clearErrorMessage(this)">
			</td>
			<td>
				<div id="lastnameErrorMessage" class="errorClass"></div>
			</td>
		</tr>
		<tr>
			<td>
				<label for="username">Username</label>
			</td>
			<td>
				<input name="username" class="inputClass" onclick="clearErrorMessage(this)">
			</td>
			<td>
				<div id="usernameErrorMessage" style="color:#cc0000;"><?php echo $error; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<label for="password">Password</label>
			</td>
			<td>	
				<input name="password" type="password" class="inputClass" onclick="clearErrorMessage(this)">
			</td>
			<td>
				<div id="passwordErrorMessage" class="errorClass"></div>
			</td>
		</tr>
		<tr>
			<td>
				<label for="passwordVerification">Confirm your password</label>
			</td>
			<td>		
				<input name="passwordVerification" type="password" class="inputClass" onclick="clearErrorMessage(this)">
			</td>
			<td>
				<div id="passwordVerificationErrorMessage" class="errorClass"></div>
			</td>
		</tr>
		<tr>
			<td>
				<label for="email">Email address</label>
			</td>
			<td>					
				<input name="email" class="inputClass" onclick="clearErrorMessage(this)">
			</td>
			<td>
				<div id="emailErrorMessage" class="errorClass"></div>
			</td>			
		</tr>
		<tr>
			<td colspan="2" style="text-align: center">
				<br>
				<input name="signup" type="submit" value="Sign up" class="buttonsClass" onclick="return submitValidation();">
			</td>
		</tr>
	</table>
	</form>
</body>
</html>