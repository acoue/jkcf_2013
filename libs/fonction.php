<?php
// additionne des temps
// entr�e :  
// $temps = temps de reference de la forme "00:00:00"
// $hours = nombre d'heures � ajouter
// $minutes = nombre de minutes � ajouter
// $seconds = nombre de secondes � ajouter
// sortie :
// addTime = temps total sous la forme "00:00:00"
function addTime($temps, $hours=0, $minutes=0, $seconds=0) {
	// on split le temps
	$temp_string = explode(":", $temps);
	$totalHours = $temp_string[0] + $hours;
	$totalMinutes = $temp_string[1] + $minutes;
	if ( $totalMinutes / 60 > 1) {
		$totalHours = $totalHours + floor($totalMinutes/60);
		$totalMinutes = $totalMinutes % 60;
	}
	$totalSeconds = $temp_string[2] + $seconds;
	if ( $totalSeconds / 60 > 1) {
		$totalMinutes = $totalHours + floor($totalSeconds/60);
		$totalSeconds = $totalSeconds % 60;
	}
	if( $totalHours < 10 ) {
		$totalHours = "0" . $totalHours;
	}
	if( $totalMinutes < 10 ) {
		$totalMinutes = "0" . $totalMinutes;
	}
	if( $totalSeconds < 10 ) {
		$totalSeconds = "0" . $totalSeconds;
	}
	$myTime = $totalHours . ":" . $totalMinutes . ":" . $totalSeconds;
	return $myTime;
}

function minusTime($tempsSup, $tempsInf) {
	$delai = "00:00";
	$tempSup_string = explode(":", $tempsSup);
	$tempInf_string = explode(":", $tempsInf);
	$diff = mktime($tempSup_string[0], $tempSup_string[1],'00') - mktime($tempInf_string[0], $tempInf_string[1],'00');
	$delai = round($diff / 3600,2);
	return $delai;
}

function transformeDiffHeure($heureDixieme) {
	$delai = "00:00";
	$heureD = 0;
	$minuteD = 0;
	$heure = "";
	$minute = "";
	
	$pos = strpos($heureDixieme, ".");
	$heureD = (substr( $heureDixieme , 0,$pos))*1;
	if($heureD <10) $heure = '0'.$heureD;
	
	$minute = substr( $heureDixieme,$pos+1);
	$minuteD = round(($minute * 60) / 100,0);
	$delai = $heure.":".$minuteD;
	return $delai;
}

function traitementAccent($string) {
	//$string = utf8_decode($string) ;
	$caracteres=array('�','�','�','�','�','�','�','�','�','�','�', '�', '�', '�');
	$entities=array('&eacute;', '&egrave;', '&agrave;', '&euml;', '&ecirc;', '&ucirc;', '&uuml;', '&ugrave;', '&icirc;', '&iuml;', '&ocirc;', '&ouml;','&ccedil;', '&acirc;');
	$string = str_replace($caracteres,$entities,$string);
	return $string ; 
}

function aff_date_court($date) {
    $annee = substr($date, 0, 4);
	$mois = substr($date, 5, 2);

	switch ($mois) {
		case "01" : $mois = "Jan"; break;
		case "02" : $mois = "F�v"; break;
		case "03" : $mois = "Mars"; break;
		case "04" : $mois = "Avril"; break;
		case "05" : $mois = "Mai"; break;
		case "06" : $mois = "Juin"; break;
		case "07" : $mois = "Juil"; break;
		case "08" : $mois = "Ao�t"; break;
		case "09" : $mois = "Sept"; break;
		case "10" : $mois = "Oct"; break;
		case "11" : $mois = "Nov"; break;
		case "12" : $mois = "D�c"; break;
	}

	$jour = substr($date, 8, 2);

	$heure = substr($date, 11, 2);
	$minute = substr($date, 14, 2);
	
	$return = $jour."&nbsp;".$mois."&nbsp;".$annee;
	
	if ($heure != "" && $heure != "00" && $minute != "" && $minute != "00")
		$return .= "&nbsp;&agrave;&nbsp;".$heure.":".$minute;
	return($return);
}

function dateUS ($dateFR) {
	$day = substr($dateFR, 0, 2);
	$month = substr($dateFR, 3, 2);
	$year = substr($dateFR, 6, 4);

	return $year."/".$month."/".$day;
}

// Retourne une date FR quand on lui passe une date US
// 2005/12/24 => 24/12/2005

function dateFR ($dateUS) {
	$day = substr($dateUS, 8, 2);
	$month = substr($dateUS, 5, 2);
	$year = substr($dateUS, 0, 4);

	return $day."/".$month."/".$year;
}

// Retourne une date FR quand on lui passe une date US
// 2005-12-24 => Samedi 24 D�cembre 2005

function dateCompleteFR($dateJour) {
	$jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"); 
	$mois = array("","Janvier","F�vrier","Mars","Avril","Mai","Juin","Juillet","Ao�t","Septembre","Octobre","Novembre","D�cembre"); 
	
	$day = substr($dateJour, 8, 2);
	$month = substr($dateJour, 5, 2);
	$year = substr($dateJour, 0, 4);	
	return $jour[date("w",mktime (0, 0, 0, $month, $day,  $year))]." ".$day." ".$mois[$month*1]." ".$year; 	
}

function getMonth($numero) {
	$mois = array("","Janvier","F�vrier","Mars","Avril","Mai","Juin","Juillet","Ao�t","Septembre","Octobre","Novembre","D�cembre"); 
	return $mois[$numero*1];
}

function AffDir($rep) {
	$handle = opendir($rep);
  	while (false !== ($file = readdir($handle))) {
    	if($file != "." && $file != ".." && $file != "Thumbs.db") {
       		$files[] = $rep."/".$file;
    	} 
  	}

	closedir($handle); 
	sort($files);
	return $files;
	
}

function cleanText($intext) {
    return utf8_encode(htmlspecialchars(stripslashes($intext)));
}

 function recursive_readdir ($dir, $myId) {
 	
    $dir = rtrim ($dir, '/'); // on vire un eventuel slash mis par l'utilisateur de la fonction a droite du repertoire
    if (is_dir ($dir)) // si c'est un repertoire
        $dh = opendir ($dir); // on l'ouvre
    else {
        echo $dir, ' n\'est pas un repertoire valide'; // sinon on sort! Appel de fonction non valide
        exit;
    }
    
    // Enregistrement des paths dans un tableau
    $indice = 0;
    while (($file = readdir ($dh)) !== false ) { //boucle pour parcourir le repertoire
        if ($file !== '.' && $file !== '..') { 
            $path =$dir.'/'.$file; 
            
            $tabPath[$indice] = $path;
            $tabFile[$indice] = $file;
            //echo $tabPath[$indice]; echo "</br>";
            $indice ++;
        }
    }   
    
    // Tri du tableau
    rsort($tabPath);
    rsort($tabFile);
    
    // Initialisation de la descritpion
    $descriptionContent = "";
    
    // Parcours du tableau tri� :
    $indice2 = 0;
    for ($indice2; $indice2<$indice; $indice2 ++){
        	
    		if (is_dir ($tabPath[$indice2])) { //si on tombe sur un sous-repertoire	
    			
    			// Incrementation 
    			$myId = $myId + 1;
    			    	    
    			// Dossier contient un "_description.txt" ?
            	//$myPathName = str_replace($tabFile[$indice2], "", $tabPath[$indice2]);  // Old
				$myFileName = $tabPath[$indice2]."/_description.txt";
	       		if(file_exists($myFileName)) {
        			$TabFich = file($myFileName);
        			$descriptionContent = "";
            		for($i = 0; $i < count($TabFich); $i++)
            			$descriptionContent .= $TabFich[$i];
            		// On affiche le contenu du fichier html
            		echo '<p style="padding-left: 50px; font-weight: bold;"></p>'.$descriptionContent.'<a class="lienBleu" href="javascript:changervisibilite(\'rep'.$myId.'\')">(Cliquez ici)</td></tr></table><br /></a>'; 
        			echo '<div id="rep'.$myId.'" style="display:none; padding-left: 80px;" >';
               	 	recursive_readdir ($tabPath[$indice2], $myId."00"); // appel recursif pour lire a l'interieur de ce sous-repertoire
                	echo '</div>';
        		} else {
        			// On affiche le dossier classique
        			echo '<p style="padding-left: 70px; font-weight: bold;"><img src="./image/site/dossier.png" border="0" height="25px"/><a class="lienNoir" href="javascript:changervisibilite(\'rep'.$myId.'\')">'.$tabFile[$indice2].'</a></p>';
            		echo '<div id="rep'.$myId.'" style="display:none; padding-left: 80px;" >';
               	 	recursive_readdir ($tabPath[$indice2], $myId."00"); // appel recursif pour lire a l'interieur de ce sous-repertoire
                	echo '</div>';
        		}  		

            } else {

            	$myId = $myId + 1;
            	$extension = strrchr($tabPath[$indice2],'.');
            	if ($extension == ".pdf"){
            	    $i = 1;
					$nombreDossier = substr_count($tabPath[$indice2],"/");
            		$ext="pdf";
            		if ($nombreDossier == 2) {// Dossier parent est "document" alors marge de 100.
                		echo "<div style='padding-left: 150px;'><a href='".$tabPath[$indice2]."' target='_blanck' class='lienNoir'><img src='./image/site/".$ext.".jpg' border='0' height='15px'/> ".$tabFile[$indice2]."</a></div>";
            		} 
            		else {
                		echo "<div style='padding-left: 70px;'><a href='".$tabPath[$indice2]."' target='_blanck' class='lienNoir'><img src='./image/site/".$ext.".jpg' border='0' height='15px'/> ".$tabFile[$indice2]."</a></div>";
            		}
            	}
            }
    }closedir ($dh);
 }



 function recursive_readdir_simple ($dir) {
    $dir = rtrim ($dir, '/'); // on vire un eventuel slash mis par l'utilisateur de la fonction a droite du repertoire
    if (is_dir ($dir)) // si c'est un repertoire
        $dh = opendir ($dir); // on l'ouvre
    else {
        echo $dir, ' n\'est pas un repertoire valide'; // sinon on sort! Appel de fonction non valide
        exit;
    }
    while (($file = readdir ($dh)) !== false ) { //boucle pour parcourir le repertoire
        if ($file !== '.' && $file !== '..') {
            $path =$dir.'/'.$file;
            if (is_dir ($path)) { //si on tombe sur un sous-repertoire
                //echo '<p>'.$file.'</p>';
				echo '<p>'.$file.'</p>';
                echo '<div style="padding-left: 20px;">';
                recursive_readdir_simple ($path); 
               echo '</div>';
            } else {
                //echo "<li><a href='".$path."' target='_blanck' class='lienNoirLight'>".$file, '</a></li>';
                $extension = strrchr($path,'.'); // verification de l'extension
                if ($extension != ".txt")
					echo "<a href='".$path."' target='_blanck' class='lienNoir'>".$file.'</a>  --------> <a class="lienNoir"  href="index.php?action=suppressionDocument&doc='.$file.'">Supprimer</a><br />';
            }
        }
    }
    
    closedir ($dh);
 }

function stripHTMLtags($texte){
	//On retire le code HTML
	$mots = explode("<",$texte);
	$texte = "";
	$nbmots = count($mots);

	for ($m = 0; $m < $nbmots; $m++)
		{
		$mot = $mots[$m];
		$finbalise = strpos($mot,">",0);
		if ($finbalise > 0) { $mot = substr($mot,$finbalise+1); }
		$texte .= "$mot";
		}

	return $texte;
}

//Version avec argument passé par référence
function stripHTMLtags_byref(&$texte){
	//On retire le code HTML
	$mots = explode("<",$texte);
	$texte = "";
	$nbmots = count($mots);

	for ($m = 0; $m < $nbmots; $m++)
		{
		$mot = $mots[$m];
		$finbalise = strpos($mot,">",0);
		if ($finbalise > 0) { $mot = substr($mot,$finbalise+1); }
		$texte .= "$mot";
		}
}

function getFirstElementInRep($path) {
	$retour="";
	if (is_dir($path)) {
		if ($dh = opendir($path)) {
			$key=0;
			while ((($file = readdir($dh)) !== false) && ($key <1)) {
				if($key <= 0 ) {
					if($file!='..' && $file!='.' ) { //N'affiche pas le . et ..
						$retour = $file;
						$key+=1;
					}
				}
			}
			closedir($dh); //Il est vivement conseill� de fermer le repertoire pour toute autre op�ration sur le systeme de fichier.
		}
	}
	return $retour;
}

function generationTexte($car) {
	$string = "";
	$chaine = "abcdefghijklmnpqrstuvwxy";
	srand((double)microtime()*1000000);
	for($i=0; $i<$car; $i++) {
		$string .= $chaine[rand()%strlen($chaine)];
	}
	return $string;
}


function envoiEmail($destinataire,$email_expediteur,$nom_expediteur, $message_html, $sujet) {
// 	$destinataire ='anthony.coue@gmail.com';	
// 	$nom_expediteur	='Anthony COUE';
// 	$email_expediteur ='anthony.coue@efs.sante.fr';
	
	// On filtre les serveurs qui rencontrent des bogues.
	if(!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $destinataire)) {
		$passage_ligne = "\r\n";
	} else {
		$passage_ligne = "\n";	
	}
	
	//=====Cr�ation de la boundary	
	$boundary = "-----=".md5(rand());	
	
	//=====Cr�ation du header de l'e-mail.
	
	$header	= "From: '".$nom_expediteur."' <'".$email_expediteur.">".$passage_ligne;	
	$header .= "Reply-to: '".$nom_expediteur."' <'".$email_expediteur.">".$passage_ligne;	
	$header .= "MIME-Version: 1.0".$passage_ligne;	
	$header .= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

	//=====Cr�ation du message.
	$message = $passage_ligne."--".$boundary.$passage_ligne;
	
	//=====Ajout du message au format HTML
	$message .= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;	
	$message .= "Content-Transfer-Encoding: 8bit".$passage_ligne;	
	$message .= $passage_ligne.$message_html.$passage_ligne;
	
	//==========
	$message .= $passage_ligne."--".$boundary."--".$passage_ligne;	
	$message .= $passage_ligne."--".$boundary."--".$passage_ligne;
	
	//=====Envoi de l'e-mail.	
	if(mail($destinataire,$sujet,$message,$header)) {	
		loggerInformation("Email envoy�");
		return true;
	} else {	
		loggerInformation("Erreur dans l'envoie du mail");
		return false;	
	}
}
?>