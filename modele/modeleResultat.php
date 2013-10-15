<?php
function getResultatsForPage() {
	try {
		$bdd = getBDD();
		$requete = "SELECT A.idresultat, A.iddiscipline, A.titre, A.texte, B.iddiscipline, B.discipline, B.descriptif, B.couleur					
					FROM discipline B, resultat A 
					WHERE B.iddiscipline = A.iddiscipline ORDER BY A.idresultat desc";
		$stmt = $bdd->prepare($requete);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	} catch (Exception $e) {
		afficherErreur($e->getMessage());
	}
}

function getResultats() {
	try {
	    $bdd = getBDD();
	    $requete = "SELECT * FROM discipline B, resultat A WHERE B.iddiscipline = A.iddiscipline ORDER BY A.idresultat desc";
	    $stmt = $bdd->prepare($requete);
		$stmt->execute();
		$result = $stmt->fetchAll();		
		return $result;
	} catch (Exception $e) {
    	afficherErreur($e->getMessage());
	}	
}

function getResultat($id) {    
    try {
	    $bdd = getBDD();
	    $requete = 'select idresultat, titre, texte, A.iddiscipline iddiscipline, discipline
	    		 FROM resultat A, discipline B WHERE B.iddiscipline = A.iddiscipline and idresultat = :id_resultat ';
	    $stmt = $bdd->prepare($requete);
	    $stmt->bindValue(':id_resultat', $id);
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

function addResultat($discipline, $titre,$texte,$photo) {	

	
	$bdd = getBDD();
	$date = date("Y-m-d");;
	$userCreation = $_SESSION['prenom']." ".$_SESSION['nom'];
	
	$requete = "INSERT INTO resultat (titre,texte,iddiscipline) " .
			   " VALUES(:titre, :texte, :discipline )";
    $stmt = $bdd->prepare($requete); 
	$stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
	$stmt->bindParam(':texte', $texte, PDO::PARAM_STR);
	$stmt->bindParam(':discipline', $discipline, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
		 return true;
    } else {
	    return false;
    }
}


function setResultat($id,$discipline, $titre,$texte,$photo) {	
	
	$bdd = getBDD();
	$requete = "UPDATE resultat SET titre = :titre, texte = :texte , iddiscipline = :discipline
				WHERE idresultat = :id_resultat ";
    $stmt = $bdd->prepare($requete); 
    $stmt->bindValue(':titre', $titre);
    $stmt->bindValue(':texte', $texte);
	$stmt->bindValue(':discipline', $discipline);
	$stmt->bindValue(':id_resultat', $id);
    
    if ($stmt->execute()) {
		 return true;
    } else {
	    return false;
    }
}