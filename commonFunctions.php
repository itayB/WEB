<?php
	function getDir() {
		if ($_COOKIE['language'] == 'he')
				echo "rtl";
		else
				echo "ltr";
	}
?>