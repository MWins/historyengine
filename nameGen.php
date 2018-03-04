<?php 
include ( "nameFunc.php" );
$vars = calculateTheNames();
$counter = count ( $vars ) ;
	for ( $i=0; $i < $counter; $i++ ) {
	
		echo $vars[$i]."<br>";
		}

?>
