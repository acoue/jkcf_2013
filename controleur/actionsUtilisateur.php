<?php
//-------------------------------------
//--- UTILISATEUR
//-------------------------------------
// Affiche la liste de tous les utilisateurs
function afficherListeUtilisateurs() {
    $users = getUtilisateurs();
    $lienUser = "index.php?action=afficherUtilisateur&id=";
    require CHEMIN_VUE.'utilisateur/listeUtilisateurs.php';
}

// Affiche un utilisateur
function afficherUtilisateur($id) {
    $user = getUtilisateur($id);
    require CHEMIN_VUE.'utilisateur/detailsUtilisateurs.php';
}

function afficherFormulaireAjoutUtilisateur() {
    require CHEMIN_VUE.'utilisateur/formulaireAjoutUtilisateur.php';	
}

function logOutUser() {			
	setEtatUtilisateur($_SESSION['id'],'0');
	LoggerInformation('Deconnexion de '.$_SESSION['prenom']." ".$_SESSION['nom']);
	// Suppression de toutes les variables et destruction de la session
	$_SESSION = array();
	session_destroy();	
	require CHEMIN_VUE.'connexion/deconnexionOk.php';	    
}

function logInUser() {		
	if (utilisateurConnected() === '1') {
		require CHEMIN_VUE.'connexion/erreurDejaConnecte.php';
	} else {	
		$erreurs_connexion = array();
				
		if ( $_POST['nom_utilisateur'] !== '' && $_POST['mot_de_passe'] !== '') {
			$nom_utilisateur = $_POST['nom_utilisateur']; 
			$mot_de_passe = $_POST['mot_de_passe'];		
			$user = connectUtilisateur($nom_utilisateur, $mot_de_passe);						
			if($user != false ) {
				$_SESSION['id'] = $user['iduser'];
				$_SESSION['nom']  = $user['nom'];  
				$_SESSION['prenom']  = $user['prenom'];  
				$_SESSION['isAdmin']  = $user['isAdmin'];
				setEtatUtilisateur($user['iduser'],'1');
				loggerInformation('Connexion de '.$_SESSION['prenom'].' '.$_SESSION['nom']);

				$articles = getArticlesForPage();
    			$lienArticle = "index.php?action=affichageArticle&id=";
				require CHEMIN_VUE.'accueil.php';
			} else {
				$erreurs_connexion[] = "Couple nom d'utilisateur / mot de passe inexistant.";
				require CHEMIN_VUE.'connexion/formulaireConnexion.php';
			}
		} else  {
			$erreurs_connexion[] = "Merci de renseigner le nom d'utilisateur et/ou mot de passe.";
			require CHEMIN_VUE.'connexion/formulaireConnexion.php';
		}
	}
}

function ajoutUtilisateur() {
	if (utilisateurConnected() === '1') {		
		$erreurs_utilisateur = array();
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$droit = $_POST['droit'];
		$login = $_POST['login'];
		$mdp =  $_POST['password'];	
		$online = $_POST['online'];	
		
		if(strlen($login) > 0 ) {			
			if(strlen($mdp) > 0 ) {
				if(strlen($nom) > 0 ) {
					if(addUtilisateur($nom,$prenom,$droit,$login,$mdp,$online)) {
						$erreurs_utilisateur[] = "L'ajout de l'utilisateur $prenom $nom a été prise en compte.";
						loggerInformation("L'ajout de l'utilisateur".$prenom." ".$nom." a été prise en compte.");
						require CHEMIN_VUE.'utilisateur/ajoutUtilisateurOk.php';
					} else {
						$erreurs_utilisateur[] = "Erreur dans l'ajout de l'utilisateur".$prenom." ".$nom;
						loggerInformation("Erreur dans l'ajout de l'utilisateur".$prenom." ".$nom." par ".$_SESSION['prenom']." ".$_SESSION['nom']);
						require CHEMIN_VUE.'utilisateur/formulaireAjoutUtilisateur.php';		
					}				
				} else {
					$erreurs_utilisateur[] = "Le nom d'utilisateur ne doit pas être vide";
					require CHEMIN_VUE.'utilisateur/formulaireAjoutUtilisateur.php';
				}
			
			} else {
				$erreurs_utilisateur[] = "Le mot de passe ne doit pas être vide";
				require CHEMIN_VUE.'utilisateur/formulaireAjoutUtilisateur.php';
			}
		} else {
			$erreurs_utilisateur[] = "Le login ne doit pas être vide";
			require CHEMIN_VUE.'utilisateur/formulaireAjoutUtilisateur.php';
		}		
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}


function modificationUtilisateur() {
	if (utilisateurConnected() === '1') {
		$erreurs_utilisateur = array();
		$idUser = $_POST['idUser'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$droit = $_POST['droit'];
		$login = $_POST['login'];
		$mdp =  $_POST['password'];	
		$online = $_POST['online'];	
		
		if(strlen($login) > 0 ) {			
			if(strlen($mdp) > 0 ) {
				if(strlen($nom) > 0 ) {
					if(setUtilisateur($idUser, $nom,$prenom,$droit,$login,$mdp,$online)) {
						$erreurs_utilisateur[] = "La modification de l'utilisateur $prenom $nom a été prise en compte.";
						loggerInformation("La modification de l'utilisateur".$prenom." ".$nom." a été prise en compte.");
						require CHEMIN_VUE.'utilisateur/modificationUtilisateurOk.php';
					} else {
						$erreurs_utilisateur[] = "Erreur dans la mise à jour de l'utilisateur".$prenom." ".$nom;
						loggerInformation("Erreur dans la mise à jour de l'utilisateur".$prenom." ".$nom." par ".$_SESSION['prenom']." ".$_SESSION['nom']);
						require CHEMIN_VUE.'utilisateur/detailsUtilisateurs.php?id='.$idUser;		
					}				
				} else {
					$erreurs_utilisateur[] = "Le nom d'utilisateur ne doit pas être vide";
					require CHEMIN_VUE.'utilisateur/detailsUtilisateurs.php?id='.$idUser;		
				}
			
			} else {
				$erreurs_utilisateur[] = "Le mot de passe ne doit pas être vide";
				require CHEMIN_VUE.'utilisateur/detailsUtilisateurs.php?id='.$idUser;		
			}
		} else {
			$erreurs_utilisateur[] = "Le login ne doit pas être vide";
			require CHEMIN_VUE.'utilisateur/detailsUtilisateurs.php?id='.$idUser;		
		}		
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}

function modificationPassword() {
	
	if (utilisateurConnected() === '1') {
		$erreurs_password = array();
		$idUser = $_SESSION['id'];
		$ancien = $_POST['ancien'];
		$nouveau = $_POST['nouveau'];
		$verif = $_POST['verif'];
		$mdpEnCours = '';				
		
		if (strlen($nouveau) > 0 ) {
			if ($nouveau == $verif) {				
				//Recuperation de l'ancien mot de passe				
				$mdpEnCours = getPassword($idUser);
				if($mdpEnCours === $ancien) {
					//Mis a jour
					if(setPassword($nouveau,$idUser)) {
						$erreurs_password[] = "Votre changement de mot de passe a été pris en compte.";
						loggerInformation('Mot de passe mis à jour pour '.$_SESSION['prenom'].' '.$_SESSION['nom']);
						require CHEMIN_VUE.'utilisateur/modificationPasswordOk.php';
					} else {
						$erreurs_password[] = "Erreur dans la mise à jour du mot de passe";
						loggerInformation('Erreur dans la mise à jour du mot de passe pour '.$_SESSION['prenom'].' '.$_SESSION['nom']);
						require CHEMIN_VUE.'utilisateur/formulaireGestionPassword.php';		
					}
				} else {
					$erreurs_password[] = "L'ancien mot de passe n'est pas correct, merci de réessayer";
					require CHEMIN_VUE.'utilisateur/formulaireGestionPassword.php';
				}
			}  else {
				$erreurs_password[] = "Le nouveau mot de passe et sa vérification sont différent";
				require CHEMIN_VUE.'utilisateur/formulaireGestionPassword.php';
			}
		} else {
			$erreurs_password[] = "Le nouveau mot de passe ne doit pas être null";
			require CHEMIN_VUE.'utilisateur/formulaireGestionPassword.php';
		}	
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}