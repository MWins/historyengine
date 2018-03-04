<html>
<head>
	<title>Untitled</title>
</head>
<?php include ( "./name_array.php" );?>
<body>
<div align="center">
<form action="nameGen.php">
<table width="600" border="0" bgcolor="#c9c9c9" cellpadding="0">
<tr><td><select name="num_syls"><option value="r">Random</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="15">Gnome</option>
</select></td><td><!--female <input type="radio" name="gender" value="female" checked>&nbsp; &nbsp; male <input type="radio" name="gender" value="male">--></td></tr>
<tr><td>

<?php 
for ( $i = 0; $i < count ( $languages); $i++ ) {
	echo  $languages[$i]." &nbsp;<input type=\"checkbox\" name=\"langA[]\" value=\"$languages[$i]\"> &nbsp;";
}?>
</script></td><td>Number of Names: <input type="text" name="num_names" size="2" maxlength="2" value="2"></td></tr>
<tr><td>Reduce End To: 
<?php 
for ( $i = 0; $i < count ($lastLanguages); $i++ ) {
	echo $lastLanguages[$i]." &nbsp;<input type=\"checkbox\" name=\"langB[]\" value=\"$lastLanguages[$i]\"> &nbsp;";
}
?></td><td><input type="submit" name="submit" value="Generate Names"></td></tr>
</table>
</form>

</body>
</html>
