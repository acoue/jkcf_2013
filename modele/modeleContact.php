<?php

function getContactsForPage() {
	try {
		$bdd = getBDD();
		$requete = 'select texte from pagestructure where type = "contact" ';
		$stmt = $bdd->prepare($requete);
		$stmt->execute();
		if ($result = $stmt->fetch()) {
			$stmt->closeCursor();   
			return $result['texte'];
		} else  {
			return false;
		}
	} catch (Exception $e) {
		afficherErreur($e->getMessage());
	}
}

function getContact() {    
    try {
	    $bdd = getBDD();
	    $requete = 'select texte from pagestructure where type = "contact" ';
	    $stmt = $bdd->prepare($requete);
		$stmt->execute();
		if ($result = $stmt->fetch()) {     
	        $stmt->closeCursor();	    
			return $result['texte'];
	    } else  {
	    	return false;
		}		
	} catch (Exception $e) {
    	afficherErreur($e->getMessage());
	}	
}


function setContact($texte) {	
	
	$bdd = getBDD();
	$requete = "UPDATE pagestructure SET texte = :texte where type = 'contact' ";
    $stmt = $bdd->prepare($requete); 
    $stmt->bindParam(':texte', $texte, PDO::PARAM_STR);    
    if ($stmt->execute()) {
		 return true;
    } else {
	    return false;
    }
}