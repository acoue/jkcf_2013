<?php
require CHEMIN_MODELE.'modele.php';
require CHEMIN_MODELE.'modeleUtilisateur.php';
require CHEMIN_MODELE.'modeleCeinture.php';
require CHEMIN_MODELE.'modeleCotisation.php';
require CHEMIN_MODELE.'modeleHoraire.php';
require CHEMIN_MODELE.'modeleLien.php';
require CHEMIN_MODELE.'modeleDiscipline.php';
require CHEMIN_MODELE.'modeleArticle.php';
require CHEMIN_MODELE.'modeleContact.php';
require CHEMIN_MODELE.'modeleResultat.php';
require CHEMIN_MODELE.'modeleNewsletter.php';

//-------------------------------------
//--- Affichage des formulaire et 
//--- autre page pour action
//-------------------------------------

//Affiche l'accueil
function afficherAccueil() {  
	
	//Liste des articles
    $lienArticle = "index.php?action=affichageArticle&id=";
	$articles = getArticlesForPage();
    require CHEMIN_VUE.'accueil.php';
}

// Affiche le formulaire de changement de mot de passe
function afficherFormulaireGestionPassword() {    
    require CHEMIN_VUE.'utilisateur/formulaireGestionPassword.php';
}

