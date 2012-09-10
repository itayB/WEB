<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-8-i" />
<title>Welcome  <?php echo $login_session; ?></title>
	
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="jQuery-UI/css/ui-lightness/jquery-ui-1.8.23.custom.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="jqGrid/css/ui.jqgrid.css" />
	<script src="jquery-1.8.0.min.js"></script>
	<script src="jqGrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="jqGrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>

</head>
<body>
<?php
	include('lock.php');
?>



<h1>Welcome <?php echo $login_session; ?></h1> 

<h2><a href="logout.php">Sign Out</a></h2>
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
</body>
</html>