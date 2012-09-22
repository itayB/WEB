<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-8-i" />

<?php
include("defines.php");
include("commonFunctions.php");
?>

	<title><?php echo $signupTitle ?></title>
	<link rel="stylesheet" type="text/css" href="style.php" />
	<script>
		function clearErrorMessage(input) {
			input.style.borderColor = "";
			var inputElement = document.getElementById(input.name + 'ErrorMessage');
			if (inputElement != null)
			inputElement.textContent = "";
		}
		
		function submitValidation() {
			// clear messages
			document.getElementById('generalErrorMessage').textContent = "";
		
			// verify empty fields
			var emptyInput = false;
			var inputArray = document.getElementsByClassName('inputClass');
			for (var i = 0; i < inputArray.length; i++) {
				if (inputArray[i].value == "" ) {
					emptyInput = true;
					inputArray[i].style.borderColor = "#DD4B39";
					var messageName = inputArray[i].name + 'ErrorMessage';
					if (document.getElementById(messageName) != null) {
						document.getElementById(messageName).textContent = "<?php echo $emptyFieldErrMsg ?>";
					}
				}
			}
			
			if (emptyInput)
				return false;
			
			// verify password
			if (document.getElementsByName('password')[0].value != document.getElementsByName('passwordVerification')[0].value) {
				document.getElementById('generalErrorMessage').textContent = "<?php echo $passwordFieldErrMsg ?>";
				return false;
			}		
			return true;
		}
		
		//function inputValidation(input) {
		//	if (input.value != "")
		//		document.getElementById(input.name + 'ErrorMessage').textContent = "";
		//	else
		//		document.getElementById(input.name + 'ErrorMessage').textContent = "<?php $emptyFieldErrMsg ?>";
		//}
	</script>	
</head>
<body style="margin: 0;padding: 0" dir="<?php getDir() ?>" >
<div class="topFrame">
<?php
	if(isset($_POST['signup'])) {
	
		if(isset($_POST['firstname']) && !empty($_POST['firstname']) AND
		   isset($_POST['lastname']) && !empty($_POST['lastname']) AND
		   isset($_POST['username']) && !empty($_POST['username']) AND
		   isset($_POST['password']) && !empty($_POST['password']) AND
		   isset($_POST['email']) && !empty($_POST['email'])){  
			$firstname = mysql_escape_string($_POST['firstname']);
			$lastname = mysql_escape_string($_POST['lastname']);
			$username = mysql_escape_string($_POST['username']);
			$password = md5(mysql_escape_string($_POST['password']));
			$email = mysql_escape_string($_POST['email']);
			
			if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){  
				// Return Error - Invalid Email  
				$msg = 'The email you have entered is invalid, please try again.';  
			}else{  
				// Return Success - Valid Email  			
				include("dbconfig.php");
				
				$SQL = "SELECT COUNT(*) AS count FROM usersTable WHERE userName='$username'";
				$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
				$row = mysql_fetch_array($result,MYSQL_ASSOC);
				$count = $row['count'];
				
				if( $count != 0 ) {
					$error="Username already exist - Please choose other uesrname.";
				}else {
					$hash = md5( rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
					$SQL = "INSERT INTO usersTable (userName, password, hash, email, firstName, lastName) VALUES ('$username', '$password', '$hash', '$email', '$firstname', '$lastname')";
					$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error()); 
					include("verificationEmail.php");
					header("location: activation.php");
					$msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.'; 
				}
			}
		}
	}
?>
	<form action="" method="post">
	<br>
	<br>
	<table align="center" cellpadding="5" frame="box" bordercolor="#e3e3e3">
		<tr>
			<td>
				<div id="generalErrorMessage" class="errorClass"><?php echo $msg ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<label for="firstname"><?php echo $firstname; ?></label>
			</td>
			<td>
				<input name="firstname" class="inputClass" onclick="clearErrorMessage(this)">
			</td>
			<td>
				<div class="errorClass">*</div>
			</td>
			<td>				
				<div id="firstnameErrorMessage" class="errorClass"></div>
			</td>			
		</tr>
		<tr>
			<td>
				<label for="lastname"><?php echo $lastname; ?></label>
			</td>
			<td>
				<input name="lastname" class="inputClass" onclick="clearErrorMessage(this)">
			</td>
			<td>
				<div class="errorClass">*</div>
			</td>
			<td>
				<div id="lastnameErrorMessage" class="errorClass"></div>
			</td>
		</tr>
		<tr>
			<td>
				<label for="username"><?php echo $username; ?></label>
			</td>
			<td>
				<input name="username" class="inputClass" onclick="clearErrorMessage(this)">
			</td>
			<td>
				<div class="errorClass">*</div>
			</td>
			<td>
				<div id="usernameErrorMessage" class="errorClass"><?php echo $error; ?></div>
			</td>
		</tr>
		<tr>
			<td>
				<label for="password"><?php echo $password; ?></label>
			</td>
			<td>	
				<input name="password" type="password" class="inputClass" onclick="clearErrorMessage(this)">
			</td>
			<td>
				<div class="errorClass">*</div>
			</td>
			<td>
				<div id="passwordErrorMessage" class="errorClass"></div>
			</td>
		</tr>
		<tr>
			<td>
				<label for="passwordVerification"><?php echo $passwordVerification; ?></label>
			</td>
			<td>		
				<input name="passwordVerification" type="password" class="inputClass" onclick="clearErrorMessage(this)">
			</td>
			<td>
				<div class="errorClass">*</div>
			</td>
			<td>
				<div id="passwordVerificationErrorMessage" class="errorClass"></div>
			</td>
		</tr>
		<tr>
			<td>
				<label for="gender"><?php echo $gender; ?></label>
			</td>
			<td>					
				<select name="gender" class="inputClass" style="width:100%;" onclick="clearErrorMessage(this)">
					<option value="" disabled="disabled" selected><?php echo $choose; ?></option>
					<option value="male" ><?php echo $male; ?></option>
					<option value="female" ><?php echo $female; ?></option>
				</select>
			</td>
			<td>
				<div class="errorClass">*</div>
			</td>
			<td>
				<div id="emailErrorMessage" class="errorClass"></div>
			</td>			
		</tr>	
		<tr>
			<td>
				<label for="birthday"><?php echo $birthday; ?></label>
			</td>
			<td>					
				<select name="day" class="inputClass" style="width:25%;" onclick="clearErrorMessage(this)">
					<option value="" disabled="disabled" selected><?php echo $day; ?></option>
					<?php
						for ($i = 1; $i <= 31; $i++)
							echo "<option value=\"".$i."\">".$i."</option>";
					?>
				</select>
				<select name="month" class="inputClass" style="width:43%;" onclick="clearErrorMessage(this)">
					<option value="" disabled="disabled" selected><?php echo $month; ?></option>
					<option value="1" ><?php echo $jan; ?></option>
					<option value="2" ><?php echo $feb; ?></option>
					<option value="3" ><?php echo $mar; ?></option>
					<option value="4" ><?php echo $apr; ?></option>
					<option value="5" ><?php echo $may; ?></option>
					<option value="6" ><?php echo $jun; ?></option>
					<option value="7" ><?php echo $jul; ?></option>
					<option value="8" ><?php echo $aug; ?></option>
					<option value="9" ><?php echo $sep; ?></option>
					<option value="10" ><?php echo $oct; ?></option>
					<option value="11" ><?php echo $nov; ?></option>
					<option value="12" ><?php echo $dec; ?></option>
				</select>
				<select name="year" class="inputClass" style="width:27%;" onclick="clearErrorMessage(this)">
					<option value="" disabled="disabled" selected><?php echo $year; ?></option>
					<?php
						$year=date("Y");
						for ($i = 0; $i < 120; $i++)
							echo "<option value=\"".($year-$i)."\">".($year-$i)."</option>";
					?>
				</select>
			</td>		
		</tr>			
		<tr>
			<td>
				<label for="email"><?php echo $email; ?></label>
			</td>
			<td>					
				<input type="email" name="email" class="inputClass" onclick="clearErrorMessage(this)">
			</td>
			<td>
				<div class="errorClass">*</div>
			</td>
			<td>
				<div id="emailErrorMessage" class="errorClass"></div>
			</td>			
		</tr>
		<tr>
			<td colspan="2">
				<input type="checkbox" name="termsOfService">
				<label for="termsOfService"> 
					<?php echo $iAgree; ?>
					<a id="TosLink" href="" target="_blank"><?php echo $termsOfService; ?></a>
					.
				</label>
			</td>
		</tr>
		<tr>
			<td colspan="1" style="text-align: center">
				<div class="errorClass"><?php echo $mandatoryField; ?></div>
			</td>
		</tr>		
		<tr>
			<td colspan="2" style="text-align: center">
				<br>
				<input name="signup" type="submit" value="<?php echo $signUp; ?>" class="buttonsClass" onclick="return submitValidation();">
			</td>
		</tr>
	</table>
	
	<?php include("bottomToolbar.php"); ?>
	
	</form>
</body>
</html>