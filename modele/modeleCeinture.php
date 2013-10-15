<?php
function getCeinturesForPage() {
	try {
		$bdd = getBDD();
		$requete = "SELECT discipline, personne, ceinture, commentaire , couleur FROM ceinture A, discipline B WHERE B.iddiscipline = A.iddiscipline order by 1, 3 desc, 2 asc ";
		$stmt = $bdd->prepare($requete);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	} catch (Exception $e) {
		afficherErreur($e->getMessage());
	}
}

function getCeintures() {
	try {
	    $bdd = getBDD();
	    $requete = "SELECT * FROM ceinture A, discipline B WHERE B.iddiscipline = A.iddiscipline order by personne";
	    $stmt = $bdd->prepare($requete);
		$stmt->execute();
		$result = $stmt->fetchAll();		
		return $result;
	} catch (Exception $e) {
    	afficherErreur($e->getMessage());
	}	
}

function getCeinture($id) {    
    try {
	    $bdd = getBDD();
	    $requete = 'select * FROM ceinture A, discipline B WHERE B.iddiscipline = A.iddiscipline and idceinture = :id_ceinture ';
	    $stmt = $bdd->prepare($requete);
	    $stmt->bindValue(':id_ceinture', $id);
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

function addCeinture($personne,$discipline,$ceinture,$commentaire) {	

	
	$bdd = getBDD();
	$requete = "INSERT INTO ceinture(personne,iddiscipline,ceinture,commentaire) " .
			   " VALUES(:personne, :discipline, :ceinture, :commentaire )";
    $stmt = $bdd->prepare($requete); 
    $stmt->bindValue(':personne', $personne);
    $stmt->bindValue(':discipline', $discipline);
	$stmt->bindValue(':ceinture', $ceinture);
	$stmt->bindValue(':commentaire', $commentaire);
    
    if ($stmt->execute()) {
		 return true;
    } else {
	    return false;
    }
}


function setCeinture($id,$personne,$ceinture,$commentaire) {	
	
	$bdd = getBDD();
	$requete = "UPDATE ceinture SET personne = :personne, ceinture = :ceinture, commentaire = :commentaire WHERE idceinture = :id_ceinture ";
    $stmt = $bdd->prepare($requete); 
    $stmt->bindParam(':personne', $personne, PDO::PARAM_STR);
	$stmt->bindParam(':ceinture', $ceinture, PDO::PARAM_STR);
	$stmt->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
	$stmt->bindParam(':id_ceinture', $id, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
		 return true;
    } else {
	    return false;
    }
}