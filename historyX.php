<?php include ( "name_array.php");
function checkLast ($arr) {
	global  $languages, $lastLanguages, $langFirst, $langLast, $langEnd;
	if ( $langLast[$arr] ) {
		return $langLast[$arr];
	} else {
		return $langFirst[$arr];
	}
}

function getLast ( $arr, $arr2 ) {
	global  $languages, $lastLanguages, $langFirst, $langLast, $langEnd;
	$counter = count ( $arr );
	$allArray = array ();
	for ( $i=0; $i< $counter; $i++ ) {
		$allArray = array_merge (checkLast ( $arr[$i] ), $allArray);
	}

	if ( is_array ( $arr2 ) ) {
		$counter = count ( $arr2 );
		for ( $i=0; $i< $counter; $i++ ) {
			$allArray = array_merge ($arr2[$i], $allArray);
		}
	}
	#echo $allArray[1];
	return $allArray;
}

function conCatArray ($array, $last=0 ) {
	global  $languages, $lastLanguages, $langFirst, $langLast, $langEnd;
	$allarray = array ();
	$counter = count ( $array );
	if ( $last == 0 ) {
		for ( $i=0; $i< $counter; $i++ ) {
			$allarray = array_merge ($langFirst[$array[$i]], $allarray );
		}
	} else {
		$allarray = array_merge ($array, $allarray);
	}

	return $allarray;

}

function getRand ( $max ) {
	mt_srand((double)microtime()*100000);
	if ( $max == "r" ) {
		return $number = mt_rand(1, mt_rand(1,10))+1;}
	$number = mt_rand(1, $max);
	return $number;
}

function calculateTheNames() {
	global  $languages, $lastLanguages, $langFirst, $langLast, $langEnd, $HTTP_GET_VARS;
	$returnNames = array();
	$frontSyl 		= conCatArray($HTTP_GET_VARS['langA'], 0);
	$preLastSyl		= getLast ( $HTTP_GET_VARS['langA'], $HTTP_GET_VARS['langB'] );
	$lastSyl		= conCatArray ( $preLastSyl, 1 );
	#echo $lastSyl[0];
	
	for ( $i=0; $i < $HTTP_GET_VARS['num_names']; $i++ ) {
		if ( $HTTP_GET_VARS["num_syls"] > 0 ) {
			$numOfSyls	=	$HTTP_GET_VARS["num_syls"];
		} else {
			$numOfSyls = 2;
		}

		for ($z=0; $z<$numOfSyls; $z++ ) {
			if ( $z == ($numOfSyls-1)) {
				$counter = count ( $lastSyl );
				$sylRand	=	getRand($counter);
				$returnNames[$i]	.=	$lastSyl[$sylRand];
			} else {
				$counter = count ( $frontSyl );
				$sylRand	=	getRand($counter);
				$returnNames[$i]	.=	$frontSyl[$sylRand];
			}
		
		}

	}
	return $returnNames;
}
?>
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
