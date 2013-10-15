<?php

function getDisciplinesForPage($id) {
	try {
		$bdd = getBDD();
		$requete = 'select descriptif from discipline where iddiscipline = :discipline ';
		$stmt = $bdd->prepare($requete);
    	$stmt->bindParam(':discipline', $id, PDO::PARAM_INT);
		$stmt->execute();
		if ($result = $stmt->fetch()) {
			$stmt->closeCursor();   
			return $result['descriptif'];
		} else  {
			return false;
		}


	} catch (Exception $e) {
		afficherErreur($e->getMessage());
	}
}

function getDiscipline($id) {
	try {
		$bdd = getBDD();
		$requete = 'select * from discipline where iddiscipline = :id_discipline ';
		$stmt = $bdd->prepare($requete);
		$stmt->bindValue(':id_discipline', $id);
		$stmt->execute();
		if ($result = $stmt->fetch()) {
			$stmt->closeCursor();
			return $result;
		} else  {
			return false;
		}


	} catch (Exception $e) {
		afficherErreur($e->getMessage());
	}
}

function getDisciplines() {    
    try {
	    $bdd = getBDD();
	    $requete = 'select * from discipline order by 2';
	    $stmt = $bdd->prepare($requete);
		$stmt->execute();
		$result = $stmt->fetchAll();		
		return $result;
	} catch (Exception $e) {
    	afficherErreur($e->getMessage());
	}	
}


function setDiscipline($id, $descritif ,$couleur) {	
	
	$bdd = getBDD();
	$requete = "UPDATE discipline SET descriptif = :descriptif, couleur = :couleur WHERE iddiscipline = :id_discipline ";
    $stmt = $bdd->prepare($requete); 
	$stmt->bindValue(':descriptif', $descritif);
	$stmt->bindValue(':couleur', $couleur);
	$stmt->bindValue(':id_discipline', $id);
    
    if ($stmt->execute()) {
		 return true;
    } else {
	    return false;
    }
}