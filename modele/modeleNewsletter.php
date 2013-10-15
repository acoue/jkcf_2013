<?php

function getNewsletter($id) {
	try {
		$bdd = getBDD();
		$requete = 'select * from newsletter, newsletter_article where newsletter.idnewsletter = newsletter_article.idnewsletter and newsletter_article.online = 1 and newsletter.idnewsletter = :id_newsletter order by 4 ';
		$stmt = $bdd->prepare($requete);
		$stmt->bindValue(':id_newsletter', $id);
		$stmt->execute();
		$result = $stmt->fetchAll();		
		return $result;
	} catch (Exception $e) {
		afficherErreur($e->getMessage());
	}
}

function getArticlesNewsletter($id) {
	try {
		$bdd = getBDD();
		$requete = 'select * from newsletter_article where idnewsletter = :id_newsletter ';
		$stmt = $bdd->prepare($requete);
		$stmt->bindValue(':id_newsletter', $id);
		$stmt->execute();
		$result = $stmt->fetchAll();		
		return $result;
	} catch (Exception $e) {
		afficherErreur($e->getMessage());
	}
}

function getArticleNewsletter($idarticle) {
	try {
		$bdd = getBDD();
		$requete = 'select * from newsletter_article where idnewsletter_article = :idnewsletter_article';
		$stmt = $bdd->prepare($requete);
		$stmt->bindValue(':idnewsletter_article', $idarticle);
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

function getNewsletterOnline() {    
    try {
	    $bdd = getBDD();
	    $requete = 'select * from newsletter, newsletter_article where newsletter.idnewsletter = newsletter_article.idnewsletter and newsletter.online = 1 and newsletter_article.online = 1 order by 4';
	    $stmt = $bdd->prepare($requete);
		$stmt->execute();
		$result = $stmt->fetchAll();		
		return $result;
	} catch (Exception $e) {
    	afficherErreur($e->getMessage());
	}	
}

function getNewsletters() {    
    try {
	    $bdd = getBDD();
	    $requete = 'select * from newsletter order by 1 desc';
	    $stmt = $bdd->prepare($requete);
		$stmt->execute();
		$result = $stmt->fetchAll();		
		return $result;
	} catch (Exception $e) {
    	afficherErreur($e->getMessage());
	}	
}

function inscriptionUtilisateurNewsletter($prenom, $nom,$email,$cle) {
	try {
		$bdd = getBDD();
		$requete = 'insert into newsletter_email(nom, prenom, email, cle) values (:nom, :prenom,:email, :cle)';
		$stmt = $bdd->prepare($requete);
		$stmt->bindValue(':nom', $nom);
		$stmt->bindValue(':prenom', $prenom);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':cle', $cle);
		if ($stmt->execute()) {
			 return true;
	    } else {
		    return false;
	    }
	} catch (Exception $e) {
		afficherErreur($e->getMessage());
	}
}

function suppressionUtilisateurNewsletter($prenom, $nom,$email) {
	try {
		$bdd = getBDD();
		$requete = 'delete from newsletter_email where nom = :nom and prenom = :prenom and email = :email';
		$stmt = $bdd->prepare($requete);
		$stmt->bindValue(':nom', $nom);
		$stmt->bindValue(':prenom', $prenom);
		$stmt->bindValue(':email', $email);
		if ($stmt->execute()) {
			 return true;
	    } else {
		    return false;
	    }
	} catch (Exception $e) {
		afficherErreur($e->getMessage());
	}
}

function validateInscriptionUtilisateurNewsletter($cle) {
	try {
		$bdd = getBDD();
		$requete = 'update newsletter_email set valide = 1 where cle = :cle';
		$stmt = $bdd->prepare($requete);
		$stmt->bindValue(':cle', $cle);
		if ($stmt->execute()) {
			 return true;
	    } else {
		    return false;
	    }
	} catch (Exception $e) {
		afficherErreur($e->getMessage());
	}
}

function setNewsletter($id, $titre ,$online) {	
	
	$bdd = getBDD();
	$requete = "UPDATE newsletter SET titre = :titre, online = :online WHERE idnewsletter = :id ";
    $stmt = $bdd->prepare($requete); 
	$stmt->bindValue(':titre', $titre);
	$stmt->bindValue(':online', $online);
	$stmt->bindValue(':id', $id);
    
    if ($stmt->execute()) {
		 return true;
    } else {
	    return false;
    }
}

function setArticleNewsletter($id, $titre,$categorie,$texte,$online) {

	$bdd = getBDD();
	$requete = "UPDATE newsletter_article SET titre = :titre, categorie = :categorie, texte = :texte, online = :online WHERE idnewsletter_article = :id ";
	$stmt = $bdd->prepare($requete);
	$stmt->bindValue(':titre', $titre);
	$stmt->bindValue(':categorie', $categorie);
	$stmt->bindValue(':texte', $texte);
	$stmt->bindValue(':online', $online);
	$stmt->bindValue(':id', $id);

	if ($stmt->execute()) {
		return true;
	} else {
		return false;
	}
}