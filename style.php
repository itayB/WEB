<?php header("Content-type: text/css"); 
	 
	$position = "right";
	if ($_COOKIE['language'] == 'he')
			$position = "left";	
			
	function opp($pos) {
		if ($pos == "right")
			return "left";
		return "right";
	}
?>


div#signupDiv {
	position:fixed;
	top:3px;
	<?php echo $position; ?>:5px;
}

div#welcomeDiv {
	position:fixed;
	top:-7px;
	color:white;
	<?php echo opp($position); ?>:15px;
}

div#signoutDiv {
	position:fixed;
	top:7px;
	<?php echo $position; ?>:15px;
}

span#toolbarSpan {
	position:fixed;
	color:gray;
	<?php echo $position; ?>:10px;
}

.buttonsClass {
	-moz-box-shadow:inset 0px 1px 0px 0px #cae3fc;
	-webkit-box-shadow:inset 0px 1px 0px 0px #cae3fc;
	box-shadow:inset 0px 1px 0px 0px #cae3fc;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #4197ee) );
	background:-moz-linear-gradient( center top, #79bbff 5%, #4197ee 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#4197ee');
	background-color:#79bbff;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #469df5;
	display:inline-block;
	color:#ffffff;
	font-family:arial;
	font-size:15px;
	font-weight:bold;
	padding:4px 24px;
	text-decoration:none;
	text-shadow:1px 1px 0px #287ace;
}.buttonsClass:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #4197ee), color-stop(1, #79bbff) );
	background:-moz-linear-gradient( center top, #4197ee 5%, #79bbff 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#4197ee', endColorstr='#79bbff');
	background-color:#4197ee;
}.buttonsClass:active {
	position:relative;
	top:1px;
}

.inputClass {
	border: 1px solid #e3e3e3;
	/** remember to change image path **/
	background: url(none) no-repeat #FFFFFF;
	/** font-family: tahoma, helvetica, sans-serif; **/
	font-style: normal;
	/** font-size: 17px;  **/
	color: #454743;
	outline-color: #AAF7B3;
	width: 100%;
	padding: 3px;
}

.loginBox {
	background-color: #F4FBFF;
	border 1px solid #e3e3e3;
	padding: 20px 25px 15px;
}

.topFrame {
    background: #505A50;
    height: 38px;
    margin: 0;
}

.errorClass {
	color: #DD4B39;
}

.statusMsg{  
	text-align: center ; 
    padding: 3px; /* Some padding to make some more space for our text  */  
    background: #EDEDED; /* Add a background color to our status message   */  
    border: 1px solid #DFDFDF; /* Add a border arround our status message   */  
}