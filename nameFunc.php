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
	$frontSyl 		= conCatArray($HTTP_GET_VARS[langA], 0);
	$preLastSyl		= getLast ( $HTTP_GET_VARS[langA], $HTTP_GET_VARS[langB] );
	$lastSyl		= conCatArray ( $preLastSyl, 1 );
	#echo $lastSyl[0];
	
	for ( $i=0; $i < $HTTP_GET_VARS[num_names]; $i++ ) {
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
