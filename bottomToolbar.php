<div style="position:absolute;bottom:0px;margin:20px">
	<span id="toolbarSpan">
	© 2012
	</span>
	<select name="language" onchange="submit();" >
		<option id="en" value="en" <?php if ($_COOKIE['language']=="en") echo "selected"; ?>>English</option>
		<option id="he" value="he" <?php if ($_COOKIE['language']=="he") echo "selected"; ?>>עברית</option>
	</select>
</div>