<html>
<head>
	<title>History Engine</title>
<script language="JavaScript">
   function Go(x){
 		alert ( x );
      location.href = <?php echo $PHP_SELF?>?pathP=x;
}
</script>
 <?php $pathP = './eventList.txt';
 	include ( "name_array.php" );
 ?>
</head>

<body>
<form action="historyEngine.php" method="get">
<table cellspacing="0" cellpadding="0" border="0">
<tr>
    <td>No "Nation dead"</td>
    <td>'Dead' possible: <input type="radio" name="dead" value="0" checked> Dark Ages: <input type="radio" name="dead" value="1"> 'Crisis' <input type="radio" name="dead" value="2"></td>
</tr>
<tr>
    <td>Print Order</td>
    <td>AD <input type="radio" name="order" value="0" checked> BC <input type="radio" name="order" value="1"></td>
</tr>
<tr>
    <td>Magical</td>
    <td>No <input type="radio" name="magic" value="0" checked> Yes <input type="radio" name="magic" value="1"></td>
</tr>
<tr>
    <td>Name of Nation</td>
    <td><input type="text" name="name" size="20"></td>
</tr>
<tr>
    <td>Start Year</td>
    <td><input type="text" name="year" value="0"></td>
</tr>
<tr>
    <td>Durration</td>
    <td><input type="text" name="dur" value="20"></td>
</tr>
<tr>
    <td valign="top">Number of Surrounding Nations</td>
    <td><select name="numbers"><?php 
	for ( $i=2; $i<11; $i++ ) {
		echo "<option";
		if ( $i==5 ) echo " selected";
		echo ">$i</option>\n";
	}
	?></select></td>
</tr>
<tr>
    <td valign="top" width="200">Fixed Nations<br>(Enter the name of a Nation, separate the nations by a comma (,). You can give a date, at which the nation should be destroyed by adding a colon and a number)</td>
    <td><textarea name="nations" cols="30" rows="6" wrap="soft"></textarea></td>
</tr>
<tr>
    <td valign="top">Health of Nation</td>
    <td><select name="health">
		<option value="50">very weak</option>
		<option value="75">weak</option>
		<option value="100" selected>average</option>
		<option value="150">good</option>
		<option value="200">very good</option>
		<option value="500">long lived</option>
	</select></td>
</tr>
<tr>
    <td valign="top">Vitality of Nation</td>
    <td><select name="vitality">
		<option value="50">very weak</option>
		<option value="75">weak</option>
		<option value="100" selected>average</option>
		<option value="150">good</option>
		<option value="200">very good</option>
		<option value="500">long lived</option>
</select></td>
</tr>
<tr>
    <td valign="top">Aggressivity of Nation</td>
    <td><select name="agressivity">
		<option value="50">very weak</option>
		<option value="75">weak</option>
		<option value="100" selected>average</option>
		<option value="150">good</option>
		<option value="200">very good</option>
	?></select></td>
</tr>
<tr>
    <td valign="top">Military Might of Nation</td>
    <td><select name="military">
		<option value="50">very weak</option>
		<option value="75">weak</option>
		<option value="100" selected>average</option>
		<option value="150">good</option>
		<option value="200">very good</option>
	?></select></td>
</tr>
<tr>
    <td valign="top">War Probability</td>
    <td><select name="warProb">
		<option value="-10:War">1/4</option>
		<option value="-5:War">1/2</option>
		<option value="0:War" selected>average</option>
		<option value="10:War">2*</option>
		<option value="20:War">3*</option>
	?></select></td>
</tr>
<tr>
    <td valign="top">prefered Start</td>
    <td><select name="prefered[]" multiple size=15><?php 
	$handle = file ( $pathP );
	$counter = count ( $handle );
	sort ( $handle );
	$to2 = "";
		for ( $i=0; $i<$counter; $i++ ) {
			list ( $to ) = explode ( ";", $handle[$i] );
			if ( !preg_match ("/^[[:space:]]*$/", $handle[$i]) AND $to != $to2 AND !preg_match ("/^#/", $handle[$i])) {
				echo "<option value=\"$to\">$to</option>\n";
				$to2 = $to;
			}
		}
	?></select></td>
</tr>
<tr>
    <td valign="top">Negativ List<br>(These Events will not happen in your history)</td>
    <td><select name="negative[]" multiple size=15><?php 
	$handle = file ( $pathP );
	$counter = count ( $handle );
	sort ( $handle );
	$to2 = "";
		for ( $i=0; $i<$counter; $i++ ) {
			list ( $to ) = explode ( ";", $handle[$i] );
			if ( !preg_match ("/^[[:space:]]*$/", $handle[$i]) AND $to != $to2 AND !preg_match ("/^#/", $handle[$i])) {
				echo "<option value=\"$to\">$to</option>\n";
				$to2 = $to;
			}
		}
	?></select></td>
</tr>
<tr>
    <td valign="top" width="200">Fixed Events<br>(Enter Year:Event i.e. 102:Library is Build. Several Events are divided by commas (,). You have to use the exact wording and capitals as in the lists above.)</td>
    <td><textarea name="fixed" cols="30" rows="6" wrap="soft"></textarea></td>
</tr>
<!--<tr>
    <td valign="top">Event-File</td>
	<td><select name="pathP" onChange="location.href=<?php echo $PHP_SELF?>?pathP=this.form.pathP.options[this.form.pathP.options.selectedIndex].value)">
		<option value=""></option>
		<option value="./eventList.txt">Standard</option>
	</select>-->
	<input type="hidden" name=path value="<?php if ($pathP) echo $pathP; else echo "./eventList.txt";?>">
	</td>
</tr>
<tr><td colspan="2">
<table width="600" border="0" bgcolor="#c9c9c9" cellpadding="0">
<tr><td><b>Name Characteristics: </b># of Syllables: <select name="num_syls"><option value="r">Random</option>
<option value="1">1</option>
<option value="2" selected>2</option>
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
	echo  $languages[$i]." &nbsp;<input type=\"checkbox\" name=\"langA[]\" value=\"$languages[$i]\" checked> &nbsp;";
}?>
</script></td><td><input type="hidden" name="num_names" value="2000"></td></tr>
<!--<tr><td>Reduce End To: 
<?php 
for ( $i = 0; $i < count ($lastLanguages); $i++ ) {
	echo $lastLanguages[$i]." &nbsp;<input type=\"checkbox\" name=\"langB[]\" value=\"$lastLanguages[$i]\"> &nbsp;";
}
?></td></tr>-->
</table>
</td></tr>
<tr>
    <td></td>
    <td><input type="submit" name="submit" value="Starten"></td>
</tr>

</table>
</form>


</body>
</html>

</tr>
<tr>
    <td valign="top" width="200">Fixed Nations<br>(Enter the name of a Nation, separate the nations by a comma (,). You can give a date, at which the nation should be destroyed by adding a colon and a number)</td>
    <td><textarea name="nations" cols="30" rows="6" wrap="soft"></textarea></td>
</tr>
<tr>
    <td valign="top">Health of Nation</td>
    <td><select name="health">
		<option value="50">very weak</option>
		<option value="75">weak</option>
		<option value="100" selected>average</option>
		<option value="150">good</option>
		<option value="200">very good</option>
		<option value="500">long lived</option>
	</select></td>
</tr>
<tr>
    <td valign="top">Vitality of Nation</td>
    <td><select name="vitality">
		<option value="50">very weak</option>
		<option value="75">weak</option>
		<option value="100" selected>average</option>
		<option value="150">good</option>
		<option value="200">very good</option>
		<option value="500">long lived</option>
</select></td>
</tr>
<tr>
    <td valign="top">Aggressivity of Nation</td>
    <td><select name="agressivity">
		<option value="50">very weak</option>
		<option value="75">weak</option>
		<option value="100" selected>average</option>
		<option value="150">good</option>
		<option value="200">very good</option>
	?></select></td>
</tr>
<tr>
    <td valign="top">Military Might of Nation</td>
    <td><select name="military">
		<option value="50">very weak</option>
		<option value="75">weak</option>
		<option value="100" selected>average</option>
		<option value="150">good</option>
		<option value="200">very good</option>
	?></select></td>
</tr>
<tr>
    <td valign="top">War Probability</td>
    <td><select name="warProb">
		<option value="-10:War">1/4</option>
		<option value="-5:War">1/2</option>
		<option value="0:War" selected>average</option>
		<option value="10:War">2*</option>
		<option value="20:War">3*</option>
	?></select></td>
</tr>
<tr>
    <td valign="top">prefered Start</td>
    <td><select name="prefered[]" multiple size=15><?php 
	$handle = file ( $pathP );
	$counter = count ( $handle );
	sort ( $handle );
	$to2 = "";
		for ( $i=0; $i<$counter; $i++ ) {
			list ( $to ) = explode ( ";", $handle[$i] );
			if ( !eregi ("^[[:space:]]*$", $handle[$i]) AND $to != $to2 AND !eregi ("^#", $handle[$i])) {
				echo "<option value=\"$to\">$to</option>\n";
				$to2 = $to;
			}
		}
	?></select></td>
</tr>
<tr>
    <td valign="top">Negativ List<br>(These Events will not happen in your history)</td>
    <td><select name="negative[]" multiple size=15><?php 
	$handle = file ( $pathP );
	$counter = count ( $handle );
	sort ( $handle );
	$to2 = "";
		for ( $i=0; $i<$counter; $i++ ) {
			list ( $to ) = explode ( ";", $handle[$i] );
			if ( !eregi ("^[[:space:]]*$", $handle[$i]) AND $to != $to2 AND !eregi ("^#", $handle[$i])) {
				echo "<option value=\"$to\">$to</option>\n";
				$to2 = $to;
			}
		}
	?></select></td>
</tr>
<tr>
    <td valign="top" width="200">Fixed Events<br>(Enter Year:Event i.e. 102:Library is Build. Several Events are divided by commas (,). You have to use the exact wording and capitals as in the lists above.)</td>
    <td><textarea name="fixed" cols="30" rows="6" wrap="soft"></textarea></td>
</tr>
<!--<tr>
    <td valign="top">Event-File</td>
	<td><select name="pathP" onChange="location.href=<?php echo $PHP_SELF?>?pathP=this.form.pathP.options[this.form.pathP.options.selectedIndex].value)">
		<option value=""></option>
		<option value="./eventList.txt">Standard</option>
	</select>-->
	<input type="hidden" name=path value="<?php if ($pathP) echo $pathP; else echo "./eventList.txt";?>">
	</td>
</tr>
<tr><td colspan="2">
<table width="600" border="0" bgcolor="#c9c9c9" cellpadding="0">
<tr><td><b>Name Characteristics: </b># of Syllables: <select name="num_syls"><option value="r">Random</option>
<option value="1">1</option>
<option value="2" selected>2</option>
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
	echo  $languages[$i]." &nbsp;<input type=\"checkbox\" name=\"langA[]\" value=\"$languages[$i]\" checked> &nbsp;";
}?>
</script></td><td><input type="hidden" name="num_names" value="2000"></td></tr>
<!--<tr><td>Reduce End To: 
<?php 
for ( $i = 0; $i < count ($lastLanguages); $i++ ) {
	echo $lastLanguages[$i]." &nbsp;<input type=\"checkbox\" name=\"langB[]\" value=\"$lastLanguages[$i]\"> &nbsp;";
}
?></td></tr>-->
</table>
</td></tr>
<tr>
    <td></td>
    <td><input type="submit" name="submit" value="Starten"></td>
</tr>

</table>
</form>


</body>
</html>
