<?php

// Connecte un utilisateur
function connectUtilisateur($nomUser, $mdp) {
	try {	
		$bdd = getBDD();	
		$requete = "SELECT * FROM user WHERE online = 1 and login  = :nom_utilisateur AND password = :mot_de_passe"; 
		$stmt = $bdd->prepare($requete);		 
		$stmt->bindValue(':nom_utilisateur', $nomUser);
	    $stmt->bindValue(':mot_de_passe', Securite::crypteData($mdp));
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

// Renvoie la liste des utilisateurs
function getUtilisateurs() {
	try {
	    $bdd = getBDD();
	    $requete = "select * from user ";
	    $stmt = $bdd->prepare($requete);
		$stmt->execute();
		$result = $stmt->fetchAll();		
		return $result;
	} catch (Exception $e) {
    	afficherErreur($e->getMessage());
	}	
}

// Renvoie les informations sur un utilisateur
function getUtilisateur($id) {    
    try {
	    $bdd = getBDD();
	    $requete = 'select * from user where online = 1 and iduser = :id_utilisateur ';
	    $stmt = $bdd->prepare($requete);
	    $stmt->bindValue(':id_utilisateur', $id);
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

// Renvoie les informations sur un utilisateur
function getPassword($id) {    
    try {
	    $bdd = getBDD();
	    $requete = 'select password from user where iduser = :id_utilisateur ';
	    $stmt = $bdd->prepare($requete);
	    $stmt->bindValue(':id_utilisateur', $id);
		$stmt->execute();
		if ($result = $stmt->fetch()) {     
	        $stmt->closeCursor();	     	       
			return Securite::decrypteData($result[0]);
	    } else  {
	    	return false;
		}		
	} catch (Exception $e) {
    	afficherErreur($e->getMessage());
	}	
}


//Modifie l'utilisateur
function addUtilisateur($nom,$prenom,$isadmin,$login,$password,$online) {	
	
	$bdd = getBDD();
	$requete = "INSERT INTO user(nom,prenom,isAdmin,login,password,online) " .
			   " VALUES(:nom, :prenom, :isadmin, :login, :mot_de_passe, :online )";
    $stmt = $bdd->prepare($requete); 
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
	$stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
	$stmt->bindParam(':isadmin', intVal($isadmin), PDO::PARAM_INT);
	$stmt->bindParam(':login', $login, PDO::PARAM_STR);
	$stmt->bindParam(':mot_de_passe', Securite::crypteData($password), PDO::PARAM_STR);
	$stmt->bindParam(':online', intVal($online), PDO::PARAM_INT);
    
    if ($stmt->execute()) {
		 return true;
    } else {
	    return false;
    }
}

//Modifie l'utilisateur
function setUtilisateur($id, $nom,$prenom,$isadmin,$login,$password,$online) {	
	
	$bdd = getBDD();
	$requete = "UPDATE user SET nom = :nom, prenom = :prenom, isAdmin = :isadmin," .
			   " login = :login, password = :mot_de_passe, online = :online WHERE iduser = :id_utilisateur ";
    $stmt = $bdd->prepare($requete); 
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
	$stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
	$stmt->bindParam(':isadmin', intVal($isadmin), PDO::PARAM_INT);
	$stmt->bindParam(':login', $login, PDO::PARAM_STR);
	$stmt->bindParam(':mot_de_passe', Securite::crypteData($password), PDO::PARAM_STR);
	$stmt->bindParam(':online', intVal($online), PDO::PARAM_INT);
	$stmt->bindParam(':id_utilisateur', $id, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
		 return true;
    } else {
	    return false;
    }
}

// Modifie le mot de passe 
function setPassword($pass,$id) {
	$bdd = getBDD();
	$requete = "UPDATE user SET password = :mot_de_passe WHERE iduser = :id_utilisateur ";
    $stmt = $bdd->prepare($requete); 
    $stmt->bindValue(':id_utilisateur', $id);
    $stmt->bindValue(':mot_de_passe', Securite::crypteData($pass));
    
    if ($stmt->execute()) {
		 return true;
    } else {
	    return false;
    }
}

//Marque l'utilisateur comme connecté ou déconnecté
function setEtatUtilisateur($id, $etat) {
	try {
		$bdd = getBDD();
		$requete = "UPDATE user SET isConnected = :etat WHERE iduser = :id_utilisateur ";
	    $stmt = $bdd->prepare($requete); 
	    $stmt->bindValue(':id_utilisateur', $id);
	    $stmt->bindValue(':etat', $etat);
	    $stmt->execute();
    } catch (Exception $e) {
    	afficherErreur($e->getMessage());
	}
}

//Donne l'état de connexion de l'utilisateur
function getEtatUtilisateur($id) {
	try {
	    $bdd = getBDD();
	    $requete = "select isConnected from user where iduser = :id_utilisateur ";
	    $stmt = $bdd->prepare($requete);
    	$stmt->bindValue(':id_utilisateur', $id);
		$stmt->execute();
		$result = $stmt->fetch();	
		return $result[0];
	} catch (Exception $e) {
    	afficherErreur($e->getMessage());
	}	
}