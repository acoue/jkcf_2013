<?php

function getHorairesForPage() {    
    try {
	    $bdd = getBDD();
	    $requete = 'select texte from pagestructure where type = "horaire" ';
	    $stmt = $bdd->prepare($requete);
		$stmt->execute();
		if ($result = $stmt->fetch()) {     
	        $stmt->closeCursor();	    
			return $result['texte'];
	    } else  {
	    	return '';
		}
	} catch (Exception $e) {
    	afficherErreur($e->getMessage());
	}	
}


function getHoraire() {
	try {
		$bdd = getBDD();
		$requete = 'select texte from pagestructure where type = "horaire" ';
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


function setHoraire($texte) {

	$bdd = getBDD();
	$requete = "UPDATE pagestructure SET texte = :texte where type = 'horaire' ";
	$stmt = $bdd->prepare($requete);
	$stmt->bindParam(':texte', $texte, PDO::PARAM_STR);
	if ($stmt->execute()) {
		return true;
	} else {
		return false;
	}
}