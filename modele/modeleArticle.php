<?php
function getArticlesForPage() {
	try {
		$bdd = getBDD();
		$requete = "SELECT A.idarticle, A.iddiscipline, A.titre, A.texte, A.photo, A.date_creation, A.utilisateur_creation, B.iddiscipline, B.discipline, B.descriptif, B.couleur, A.online					
					FROM discipline B, article A 
					WHERE B.iddiscipline = A.iddiscipline and online = 1 ORDER BY A.date_creation desc, A.idarticle desc limit 0, 15";
		$stmt = $bdd->prepare($requete);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	} catch (Exception $e) {
		afficherErreur($e->getMessage());
	}
}

function getOneArticlesForPage($id) {
	try {
		$bdd = getBDD();
		$requete = "SELECT A.idarticle, A.iddiscipline, A.titre, A.texte, A.photo, A.date_creation, A.utilisateur_creation, B.iddiscipline, B.discipline, B.descriptif, B.couleur
					FROM discipline B, article A
					WHERE B.iddiscipline = A.iddiscipline  and idarticle = :id_article and online = 1 ORDER BY A.date_creation desc, A.idarticle desc";
		$stmt = $bdd->prepare($requete);
	    $stmt->bindValue(':id_article', $id);
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

function getArticles() {
	try {
	    $bdd = getBDD();
	    $requete = "SELECT * FROM discipline B, article A WHERE B.iddiscipline = A.iddiscipline ORDER BY A.date_creation desc, A.idarticle desc";
	    $stmt = $bdd->prepare($requete);
		$stmt->execute();
		$result = $stmt->fetchAll();		
		return $result;
	} catch (Exception $e) {
    	afficherErreur($e->getMessage());
	}	
}

function getArticle($id) {    
    try {
	    $bdd = getBDD();
	    $requete = 'select idarticle, titre, texte, A.iddiscipline iddiscipline, date_creation, discipline, utilisateur_creation, photo, A.online
	    		 FROM article A, discipline B WHERE B.iddiscipline = A.iddiscipline and idarticle = :id_article ';
	    $stmt = $bdd->prepare($requete);
	    $stmt->bindValue(':id_article', $id);
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

function addArticle($discipline, $titre,$texte,$photo,$online) {	

	
	$bdd = getBDD();
	$date = date("Y-m-d");;
	$userCreation = $_SESSION['prenom']." ".$_SESSION['nom'];
	
	$requete = "INSERT INTO article (titre,texte,iddiscipline,photo, utilisateur_creation, date_creation, online) " .
			   " VALUES(:titre, :texte, :discipline, :photo, :utilisateur_creation, :date_creation, :online )";
    $stmt = $bdd->prepare($requete); 
	$stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
	$stmt->bindParam(':texte', $texte, PDO::PARAM_STR);
	$stmt->bindParam(':discipline', $discipline, PDO::PARAM_INT);
	$stmt->bindParam(':photo', $photo, PDO::PARAM_STR);
	$stmt->bindParam(':date_creation', $date, PDO::PARAM_STR);
	$stmt->bindParam(':utilisateur_creation', $userCreation, PDO::PARAM_STR);
	$stmt->bindParam(':online',$online,PDO::PARAM_INT);
    
    if ($stmt->execute()) {
		 return true;
    } else {
	    return false;
    }
}


function setArticle($id,$discipline, $titre,$texte,$photo,$online) {	
	
	$bdd = getBDD();
	$requete = "UPDATE article SET titre = :titre, texte = :texte, photo = :photo , iddiscipline = :discipline, online = :online WHERE idarticle = :id_article ";
    $stmt = $bdd->prepare($requete); 
    $stmt->bindValue(':titre', $titre);
    $stmt->bindValue(':texte', $texte);
	$stmt->bindValue(':discipline', $discipline);
	$stmt->bindValue(':photo', $photo);
	$stmt->bindValue(':online', $online);
	$stmt->bindValue(':id_article', $id);
    
    if ($stmt->execute()) {
		 return true;
    } else {
	    return false;
    }
}