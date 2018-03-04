<?php 
 $languages	=	array("Viking", "Asian", "Fantasy", "Elfish", "Dwarfish", "Ork", "Osispun");
 $lastLanguages	=	 array( "Med", "Fra", "Hol", "Sla");
 $langFirst	=	 array();
 $langLast	=	 array();
 $langEnd	=	 array();
$langFirst["Viking"]	=	 array("Ol","Har","Er","Sven","Ael", "Ag", "Al", "An", "Gan", "Ar", "Arn", "As", "At", "Au", "Bar", "Bei", "Bjark", "Bor", "Bryn", "Bud", "Ed", "Eg", "Ei", "Ey", "Li", "Fai", "Finn", "Bo", "Fjol", "Fjo", "Fre", "Fri", "Frid", "Fy", "Gar", "Gauk", "Gau", "Geir", "Gil", "Gju", "Glam", "Gret", "Grim", "Gri", "Grun", "Gud", "Gun", "Had", "Haem", "Haf", "Ha", "Hak", "Half", "Ham", "He", "Hei", "Hel", "Her", "Hil", "Di", "Hjal", "Rolf", "Hjor", "Hlod", "Hloth", "Hod", "Ho", "Ke", "Til", "Holm", "Hos", "Hrae", "Hraf", "Hra", "Hreg", "Hro", "Hrod", "Hro", "Hrol", "Hros", "Hrot", "Hun", "Hung", "Hym", "ling", "Id", "Il", "Lu", "Im", "Si", "I", "In", "Jo", "Jor", "Mun", "Ke", "Knu", "Kol", "Krab", "Kra", "Leif", "Mel", "Ne", "Odd", "Olaf", "Ol", "Or", "Or", "Ot", "Ot", "Rae", "Ra", "Ref", "Ren", "Rod", "Rolf", "Ru", "Sae", "Sin", "Sir", "Sku", "Smid", "Snae", "Sni", "Sno", "Sork", "Sor", "Stark", "Stein", "Stro", "Svaf", "Svi", "Thjo", "Thor", "Thrand", "Thva", "Tryf", "Vid", "Vig", "Vis", "Vol", "Yng");

$langLast["Viking"]	=	 array("rik","ald","we","af","bi", "bjorn", "brodd", "da", "dan", "dar", "di", "din", "ding", "dir", "dir", "drek", "dval", "fin", "fjotli", "gal", "gar", "ge", "geir", "gi", "gjald", "gni", "grim", "gurd", "gvid", "hild", "i", "il", "jolf", "ki", "knel", "kning", "kul", "la", "laug", "leif", "li", "ling", "mad", "mal", "mar", "mi", "ming", "mir", "mod", "mond", "mund", "nar", "nar", "nir", "nolf", "olf", "on", "pir", "prek", "rek", "ri", "rod", "rolf", "rygg", "skel", "staff", "stein", "tar", "thjof", "thor", "ti", "til", "tir", "trek", "tyr", "ulf", "", "d", "ver", "vil", "vir");

$langFirst["Asian"]	=	 array("Lee", "Wung", "Too", "Chen", "Chang", "Hi", "Yen", "Yue", "Woo", "Lei", "Dao", "Lin", "Kan", "Ji", "Tse", "Tung", "Chew", "Wang", "Han", "Tan", "Zahng", "Fa", "Mu", "Ping", "Tian", "Shan", "Tai", "Song", "Huang", "Xiao", "Gu", "Luo", "Jia", "Ka", "Shi");

$langFirst["Fantasy"] =  array("Foch", "Ko", "Ta", "Sim", "Hal", "Hil", "Ro", "Ka", "Ar", "Gil", "El", "Be", "Ran", "Gan", "Gim", "Le", "Bo", "Ro", "We", "Kol", "Mi", "Ran", "Il", "Ru", "Ri", "Cha", "Co", "Aa");

$langLast["Fantasy"] =  array("a", "dalf", "al", "el", "", "us", "os", "as", "es", "i","is", "rond", "na", "nan", "li", "las", "mir", "wen", "gan", "", "dul", "wyn", "ne", "ra", "te", "eus", "pe", "ca", "an", "ron");

$langFirst["Ork"] =  array("Bro", "Lur", "Gna", "Otu", "Ul", "Ur", "Ro", "Shu", "Shlu", "Shla", "Sha", "Kro", "Ko", "Ka", "Kra", "Pru", "Pra", "Gro" );

$langLast["Ork"] =  array("k", "tz", "ak", "z", "kz", "uk", "dz", "zat", "zut");

$langFirst["Osispun"] =  array("Aa", "A", "Am", "As", "Ba", "Be", "Beer", "Bi", "Da", "De", "E", "En", "Es", "Ga", "Gad", "Ge", "Ger", "Gi", "Gil", "Go", "Ha", "He", "Her", "Hier", "His", "Ho", "I", "Is", "Ja", "Je", "Jo", "Ji", "Ju", "Ka", "Ke", "Ki", "Kon", "Ko", "Ku", "La", "Le", "Lo", "Ly", "Mach", "Ma", "Mel", "Mi", "Mo", "Na", "Ne", "Ni", "Nim", "O", "Om", "Pa", "Pe", "Pin", "Po", "Ra", "Re", "Ru", "Sa", "San", "Sha", "She", "Shi", "Se", "Si", "Su", "Ta", "Te", "Ti", "To", "Tu", "Ur" );

$langLast["Osispun"] =  array("a", "a", "ab", "ad", "ak", "ai", "am", "at", "ba", "bal", "be", "bel", "bi", "bib", "bner", "bo", "bra", "bram", "bri", "bul", "chan", "chi", "dä", "dab", "dad", "dai", "dal", "dam", "dan", "dar", "dit", "don", "el", "el", "el", "el", "fa", "fan", "fet", "fod", "fra", "ga", "gai", "gajil", "gal", "gar", "gon", "hab", "ham", "has", "hel", "hi", "hon", "hu", "i", "iel", "im", "ja", "ja", "ja", "ka", "kach", "kuk", "le", "li", "lom", "lon", "lo", "ma", "mar", "mel", "mo", "mu", "na", "ni", "noch", "non", "nuk", "on", "or", "ra", "rach", "ram", "ran", "ri", "ron", "ruch", "sa", "sa", "sar", "sau", "scha", "schag", "schai", "scher", "schom", "se", "si", "ta", "tal", "tan", "tar", "te", "ter", "tis", "tot", "tse", "vid", "za", "ze", "zim" );

$langFirst["Elfish"]	=  array("Ga", "The", "Se", "Gil", "Thes", "Thin", "In", "Geth", "Gin", "Li", "Ri", "Thi", "Se", "Lu", "Thi");
$langLast["Elfish"]	=  array("ra", "nas", "nor", "fin", "el", "en");

$langFirst["Dwarfish"]	=  array("Ka", "Ku", "Ke", "Che", "Chu", "Cho", "Ze", "Zu", "Zo", "Zi", "Ki", "Kö", "Kü", "Gi", "Ge", "Go", "Tho", "Thre", "Thra", "Thri", "Ga", "Gra", "Zro", "Zra"); 
$langLast["Dwarfish"]	=  array("rin", "or", "li", "ur", "od", "ch" );

$langEnd["Med"]		=	 array("us", "os", "es", "a", "as", "ar");

$langEnd["Fra"]		=	 array("ant", "er", "ier", "ise", "ie", "ard", "eon");
$langEnd["Hol"]		=	 array("je", "it", "ud", "ds" );
$langEnd["Sla"]		= 	 array("ow", "ij", "il", "od", "sk", "in", "owa", "ja", "a" );
?>
