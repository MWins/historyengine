<title>History Engine</title>
<?php 
include ( "nameFunc.php" );

###########################
#
# Randcom-Object
# a randomizer
#
###########################

class Random {
	
	function get ( $max ) {
		mt_srand((double)microtime()*100000);
		return $this->number = mt_rand(1, $max);
	}
}

##########################
#
# AreaCount-Object
# keeps track of all areas,
# names and the years
#
#########################

class AreaCount {
	var $areas;
	var $year=0;
	var $area = array ("1", "First Kingdom", "Second Kingdom", "Third Kingdom", "Fourth Kingdom", "Fifth Kingdom", "Sixth Kingdom", "Seventh Kingdom", "Eigth Kingdom", "Ninth Kingdom");
	var $nameArray;
	var $deatYears;
	
	var $counter	= 0;
	function AreaCount () {
		$this->counter = count ( $this->area )-1;
	}
	function setCounter ( $name ) {
		$this->counter++;
		$this->areas[$this->counter] = $name;
		if ( $this->counter+1 < count ( $this->area) ) {
			$this->counter = count ( $this->area ) -1;
		}
	}
	
	function afterSetCounter ( $count ) {
		$this->counter = $count; 
	}
	
	function delCounter ( $id ) {
		$this->areas[$id] = 0;
	}
	
	function returnCounter () {
		return $this->counter;
	}
	function returnYear () {
		return $this->year;
	}
	
	function setThings ( $thing, $set ){
		$this->$thing = $set;
	}
	function setYear () {
		$this->year++;
	}
	function getNames ( $array, $nations="" ) {
		if ( $nations != "" ) {
			$nations = eregi_replace ( ",[[:space:]]*$", "", $nations );
			if ( strstr ( $nations, "," ) ) {
				$preNamed1	= explode ( ",", $nations );
			} else {
				$preNamed1[] = $nations;
			}	
			$counter = count ( $preNamed1 );

			if ( strstr ( $nations, ":" ) ) {
				for ( $i=1; $i <= $counter; $i++ ) {
					$z = $i-1;
					list ( $name, $year ) = explode ( ":", $preNamed1[$z] );
					$array[$i]	= trim($name);
					$this->deathYears[trim($year)]	= trim($name);
				}
			} else {
				for ( $i=1; $i <= $counter; $i++ ) {
					$z = $i-1;
					$array[$i] = trim($preNamed1[$z]);
				}			
			}
		}
		
		$this->nameArray = $array; 
		$this->setNames();
	}
	
	
	function setNames () {
		for ( $i=0; $i < count ( $this->area ) ; $i++ ) {
			$this->area[$i] = $this->nameArray[0];
			$mix = array_shift ( $this->nameArray );
		}
	}
	function clean ( $num ) {
		$this->area[$num]= $this->nameArray[0];	
		$mix = array_shift ( $this->nameArray );
	}		
	
	
	function setSingleName () {
		$this->area[] = $this->nameArray[0];
		unset ( $this->nameArray[0]);
	}
	
	
}


#################################
#
# Event-Oject
# Handles the Events
# reads Events from one or more files
# checks, if an Event happens
# returns an array with the listed Events
#
#################################

class Event {
	var $eventA;
	var $counter;
	var $handle;
	var $happenings;
	var $preSetEventA;
	var $chanceMod;
	var $noDead;
	var $walkThroughs;
	var $random;
	var $magic;
	
	function Event () {
		$this->random = new Random;
	}
	
	#######################
	#
	# Methods to set
	# and mofify Events
	#
	#######################	
	
	
	function readEvent ( $path ) {
		$this->handle	= file ( $path );
	}
	
	function getEvent ( ) {
		$this->counter = count ( $this->handle );

		for ( $i=0; $i<$this->counter; $i++ ) {
			if ( !eregi ("^[[:space:]]*$", $this->handle[$i]) AND !eregi ("^#", $this->handle[$i]) ) {
				list ( $name, $type, $value, $sub, $war ) = explode ( ";", $this->handle[$i] );
				
				if ( $type == "magic" && $value == 1 && $this->magic == 0 ) {
					$this->setEvent ( $name, "none", 1, 0 );
					
				} else {
					$this->setEvent ( $name, $type, $value, $sub );
				}
			}
		}
	}
	
		
	function modifyEvent ( $array, $flag=0 ) {
		$counter = count ( $array );
		if ( $flag != 1 ) {
			if ( $counter > 0 ) {
				for ( $i=0; $i< $counter; $i++ ) {
					$this->eventA[$array[$i]][chance] = $this->eventA[$array[$i]][chance] +80;
				}
			}
		} else {
			if ( $counter > 0 ) {
				for ( $i=0; $i< $counter; $i++ ) {
					$this->eventA[$array[$i]][none] =1;
				}
			}
		}
	}

	function setEvent ( $name, $type, $value, $sub=0 ) {
		if ( $sub == 0 ) {
			$this->eventA[$name][$type] = $value;
		} else {
			$this->eventA[$name]["other"][$type] = $value;
		}

	}
	
	function setMagic ( $magic ) {
		$this->magic = $magic;
	}
	
	# evaluate the setting of events that should occur
	function getPreSetEvent ( $string ) {
		if ( !strstr ( $string, "," ) ) { 
			$firstArray[0] = $string; 
		} else {
			$firstArray = explode ( ",", $string );
		}
		$counter = count ( $firstArray );
		for ( $i=0; $i < $counter; $i++ ) {
			list ( $key, $value ) = explode ( ":", $firstArray[$i] );
			$key = trim ( $key );
			$value = trim ( $value );
			$this->preSetEventA["$key"] = $value;	
		}
	}
	
	# setting those events, that will happen at specified years.
	function preSetEvent ( $year ) {
		if ( !empty($this->preSetEventA[$year]) ) {
			$this->eventA[$this->preSetEventA[$year]][chance] = 100;
			unset ($this->preSetEventA[$year]);
			return true;
		} 
		return false;
	}
	
	# setting modifications to specific events

	#####################
	#
	# Basic Settings changes
	#
	#####################
	
	function setChanceMod ( $number ) {
		list ( $value, $key ) = explode ( ":", $number );
		$this->chanceMod[$key] = $value;
	}
	
	function setNoDead ( $boolean ) {
		$this->noDead = $boolean;
	}
	
	function handleDarkAges ( &$year, $rand2, &$area, &$max, &$iter ) {
		if ( $this->random->get (3) > 2 ) {
			$area->vitality = $area->vitality + $rand2/2;
			$area->health	= $area->health + $rand2/2;
			$area->military = $area->military - $rand2/2;	
		} else {
			$this->happenings[$year->year][] = "Dark Ages begin";
			$year->year = $year->year + $rand2;
			if ( $year->returnYear() >= $max ) { 
				$year->year = $max-1;
			}
			foreach ( $area as $key => $value ) {
				unset ( $area->followThis[$key] );
			}
			$iter = $year->year;
			$area->vitality = $area->vitality + $rand2;
			$area->health	= $area->health + $rand2;
			$area->military = $area->military - $rand2/4;
			$area->agressivity = $area->agressivity - $rand2/4;	
			$this->happenings[$year->year][] = "Dark Ages end";
		}
	}
	
	#######################
	#
	# Output modifications
	#
	#######################
	
	function setLink ( $event, $flag ) {
		$flugA = "flug".$flag;
		$$flugA = "<a href=\"$flag\" target=\"_blank\">$event</a>";
		$flug = $event;
		return $$flugA;
	}

	function orderOutput ( $flag ) {
		$array = array();
#		echo $this->walkThroughs;
		if ( $flag == 0 ) {
		 	return $this->happenings;
		} else {
			foreach ( $this->happenings as $key => $value ) {
			
				$diffKey =  $this->walkThroughs - $key;
				$diffKey = "-".$diffKey;
				$array[$diffKey] = $this->happenings[$key];
			}
		return $array;
		}
	}
	
	function preSetNationDeath ( &$year, &$area ) {
		if ( $year->deathYears[$year->returnYear()] ) {

			$this->happenings[$year->returnYear()][]  = $year->deathYears[$year->returnYear()]. " perished.";
			$counter = count ( $area->area );
			for ( $i=1; $i<$counter; $i++ ) {
				if ( $year->area[$i] == $year->deathYears[$year->returnYear()] ) {
					$z = $i;
				}
			}
			unset ($area->warEnemies[$year->deathYears[$year->returnYear()]] );
			unset ($area->tradePartners[$year->deathYears[$year->returnYear()]]);
			unset ($area->treatyPartners[$year->deathYears[$year->returnYear()]] );
			unset ($year->deathYears[$year->returnYear()]);
			$year->clean($i);
		}
	}
	######################
	#
	# main
	#
	######################
	function walkEvent ( &$area, &$year ) {
		$this->presetNationDeath ( $year, $area );
		foreach ( $this->eventA as $key => $value ) {
			if ( $this->eventA[$key][none] != 1 ) {
				#checking for pre set events and checking for dependencies of events.
				$this->preSetEvent ( $year->returnYear() );
	
				if ( $this->eventA[$key][war] == 1 ) {
					$chance = $this->warPreHandling ($area);
				} else {
					$chance = $this->eventA [$key][chance];
				}
				$check = $this->random->get ( 100 );
				if ( $chance >= $check ) {
					if ( $this->eventA[$key][follows] ) {
						
						if ( $area->followThis[$this->eventA[$key][follows]] < 1 ) {
							continue;
						} else {
							$area->unsetFollowUp ( $this->eventA[$key][follows] );
						}
					}
					if ( $this->eventA[$key][war] == 1 ) {
						$this->happenings[$year->returnYear()][] = $this->warHandling ($area, $year);
					} elseif ( $this->eventA[$key][treaty] ) {
						$this->happenings[$year->returnYear()][] = $this->treatyHandling ($area, $year);
					} else {
						$this->happenings[$year->returnYear()][] = $this->setLink ($key, $this->eventA[$key][hl] );
					}
					$this->eventA [$key][chance] = $this->eventA[$key][modDone];
					// handle the modifications has to be done
					$area->health 		= $area->health + $this->eventA[$key][health];
					$area->agressivity 	= $area->agressivity + $this->eventA[$key][agressivity];
					$area->vitality 	= $area->vitality + $this->eventA[$key][vitality];
					$area->military 	= $area->military + $this->eventA[$key][military];
					
					if ( ( $area->health + $area->vitality ) < ( $area->agressivity + $area->military )/2  AND $area->rebellion != 1 ) {
						$area->rebellion = 1;
						$this->happenings[$year->returnYear()][] = "Rebellion";
						$area->setFollowUp("Rebellion");
						$this->eventA["Rebellion Ends"][chance] = 20;
					}
					if ( $this->eventA[$key][precurser] ) {
						$area->setFollowUp($key);
					}
					# changing other eventTypes
					$counter = count ( $this->eventA[$key][other] );
					#echo $key;
					foreach ( $this->eventA["$key"]["other"] as $lowerKey => $lowerValue ) {
						$this->eventA["$lowerKey"][chance] += $lowerValue;
					}
				}
				$this->eventA [$key][chance] += $this->eventA[$key][mod];
			}
		}
		$year->setYear();
	}
	
	function stepEvent ( &$area, &$year, $walkThroughs ) {
		$this->walkThroughs = $walkThroughs;
		if ( $this->noDead == 1 ) {
			for ( $i=0; $i < $walkThroughs; $i++ ) {
				$this->walkEvent ( $area, &$year );
				if ( $area->health < 1 OR $area->vitality < 1 ) {
					$checker = $this->random->get ( 400 ) + 100;
					#echo "pre: ".$area->vitality.":".$area->health."<br>";
					$this->handleDarkAges ( $year, $checker, $area, $walkThroughs, $i );
					#echo $area->vitality.":".$area->health."<br>";
				}
			}
		} elseif ( $this->noDead == 2 ) {
			for ( $i=0; $i < $walkThroughs; $i++ ) {
				$this->walkEvent ( $area, &$year );
				if ( $area->health < 1 OR $area->vitality < 1 ) {
					$area->agressivity		= $area->startAgressivity;
					$area->health			= $area->startHealth;
					$area->vitality			= $area->startVitality;
					$area->military			= $area->startMilitary;
					$this->happenings[$year->returnYear()][] = "Crisis";
				}
			}
		} else {
			for ( $i=0; $i < $walkThroughs; $i++ ) {
				$this->walkEvent ( $area, &$year );
				if ( $area->health < 1 OR $area->vitality < 1 ) {
					$this->happenings[$year->returnYear()][] = "The Nation is dead";
					$walkThroughs = 0;
				}
			}
		}
	}
	
	# give beck the information.
	
	function get ($flag=0) {
		return $this->orderOutput ( $flag );
	}
		
	##############################
	#
	# special Event Handling
	#
	##############################
	
	function treatyHandling (&$area, &$year) {
		$checker = $this->random->get ( $year->counter );
		
		if ( isset ( $area->warEnemies[$year->area[$checker]] ) ) {
			$returner =  "Peace-Treaty with ".$year->area[$checker];
			$area->tradePartners[$year->area[$checker]] = 1;
			unset ($area->warEnemies[$year->area[$checker]] );
			return $returner;
		}
		if ( $this->eventA[$key][treaty] == 1 ) {
			$area->treatyPartners[$year->area[$checker]] = 1;
			return "Peace Treaty signed with ". $year->area[$checker];
		} else {
			$area->tradePartners[$year->area[$checker]] = 1;
			return "Trade Treaty signed with ". $year->area[$checker];
		}
	}
	
	function warHandling ( &$area, &$year ) {
		$checker = $this->random->get ( $year->counter );
		if ( $checker == 0 ) {
			$checker = 1;
		}

		if ( $area->tradePartners[$year->area[$checker]] ){
			$returner = "Tradepartnership with ". $year->area[$checker]. " broken";
			unset ( $area->tradePartners[$year->area[$checker]] );
			return $returner;
		} 
		if ( $area->treatyPartners[$year->area[$checker]] ){
			$returner = "Treaty with ". $year->area[$checker]. " broken";
			unset ( $area->treatyPartners[$year->area[$checker]] );
			return $returner;
		} 
		if ( !isset ( $area->warEnemies[$year->area[$checker]] ) ) {
			$area->warEnemies[$year->area[$checker]] = 100;
			$returner = "War with ". $year->area[$checker];
		}
		elseif ( $area->warEnemies[$year->area[$checker]] > 0 ){
			$area->warEndChance = $area->warEndChance-20;
			$returner = "War with ". $year->area[$checker]. " carries on.";

		} elseif ($area->warEnemies[$year->area[$checker]] <= 0 ) {
			$returner =  $year->area[$checker]. " vanquished.";
			unset ($area->warEnemies[$year->area[$checker]] );
			if ( $year->deathYears[$year->returnYear()] ) {
				unset ( $year->deathYears[$year->returnYear()]);
			}
			$year->clean($checker);
			return $returner;
		}		
		# führe Kampf aus
		$combatValue1 = $area->agressivity/10 + $area->military/2 + $area->health/10 -  $area->vitality/10 + $this->random->get(100);
		$combatValue2 = $area->warEnemies[$year->area[$checker]] + $this->random->get(100);
		$combatResult = $combatValue1 - $combatValue2;
		
		if ( $combatResult > 0 ) {
			$area->warEnemies[$year->area[$checker]] = $area->warEnemies[$year->area[$checker]] - $combatResult;  
		} elseif ( $combatResult < 0 ) {
			$area->health = $area->health + ( $combatResult/3);
			$area->vitality = $area->vitality + ( $combatResult/5 );
			$area->military = $area->military + ( $combatResult/8 );
			$area->warEnemies[$year->area[$checker]] = $area->warEnemies[$year->area[$checker]] - 5; 
		} else {
			$area->warEnemies[$year->area[$checker]] = $area->warEnemies[$year->area[$checker]] - 5;  
		}
		return $returner;
	}
	

	function warPreHandling ( &$area ) {
		//echo $area->agressivity/10 + ( $area->military/20 ) + $this->eventA [$key][chance]."<br>";

		return $area->agressivity/20 + ( $area->military/25 ) + $this->eventA [$key][chance] + $this->chanceMod["War"];
	}
	
}


##############################
#
# Area-Object
# Describes an Area with statistics
# 
#############################

class Area  {

	var $vitality=100;
	var $health=100;
	var $agressivity=100;
	var $military=100;
	var $startVitality=100;
	var $startHealth=100;
	var $startAgressivity=100;
	var $startMilitary=100;
	var $startYear;
	var $id;
	var $name;
	var $numberOfAreas;
	var $tradePartners;			# array (hash)
	var $treatyPartners;		# array (hash)
	var $warEnemies;			# array (hash)
	var $rebellion = 0; 		# boolean
	var $warCounter;
	var $warEndChance = 60; 
	var $events;
	var $followThis;
	
	function createArea ( &$year, $name ) {
		$this->id = $year->returnCounter;
		$this->startYear = $year->returnYear();
		$this->name = $name;
	}
	
	function setPrime () {
		$this->startAgressivity = $this->agressivity;
		$this->startHealth 		= $this->health;
		$this->startVitality 	= $this->vitality;
		$this->startMilitary 	= $this->military;

	}

	function setFollowUp ( $string ) {
		if ( $this->followThis[$string] ) {
			$this->followThis[$string]++;
		} else {
			$this->followThis[$string] = 1;
		}
	}
	
	function unsetFollowUp ( $string ) {
		$this->followThis[$string]--;
	}
	
	function setValue ( $key, $value ) {
		$this->$key = $value;
	}
	
	function returnYear ( $year ) {
		return $year;
	}
	function startHistory ( $path, $walks, &$year ) {
		$event = new Event;
		$event->readEvent( $path );
		$event->getEvent();
		$event->stepEvent( $this, $year, $walks );
		return $event->get(); 
	}
	
	function out( $value) {
		echo $this->$value;
	}
}

class Test extends AreaCount {
	var $blah=100;
	function retu( &$year ) {
		$year->setYear();
		$year->blubber = "hallo";

	}

}

$first = new AreaCount;
$first->setYear();
$first->afterSetCounter ( $numbers );
$first->setThings ( "year", $year );
$first->getNames ( calculateTheNames(), $nations );
$area = new Area;
$area->createArea ( $first, $name );
$area->setValue ( "health", $health );
$area->setValue ( "vitality", $vitality );
$area->setValue ( "military", $military );
$area->setValue ( "agressivity", $agressivity );
$area->setPrime ( );
		$event = new Event;
		$event->readEvent( $path );
		$event->setMagic ( $magic );
		$event->getEvent();
		$event->modifyEvent ( $prefered );
		$event->modifyEvent ( $negative, 1 );
		$event->setChanceMod ( $warProb );
		$event->getPreSetEvent ( $fixed );
		$event->setNoDead ( $dead );

		$event->stepEvent( &$area, $first, $dur );
$array = $event->get($order);
echo "<h2>$name</h2>";
echo "<table cellpadding=2 border=1 cellspacing=0>";
echo "<tr><th>Year</th><th>Event</th></tr>";
foreach ( $array as $key => $value ) {
	echo "<tr><td valign=\"top\">$key</td><td>";
	$counter1 = count ($array[$key]);
	for ( $i=0; $i< $counter1; $i++ ) {
		echo $array[$key][$i]."<br>";
	}
	echo "</td></tr>";
}
echo "</table>";
# das Objekt als Referenz übergeben, damit das original geändert wird.

# mehrere Links möglich machen

?>
