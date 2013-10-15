<?php
require_once CHEMIN_LIB.'fonction.php';

function afficherListeNewsletters() {
	$newsletters = getNewsletters();
	$lienNewsletter = "index.php?action=detailNewsletter&id=";
	require CHEMIN_VUE.'newsletter/listeNewsletters.php';
}

function afficherNewsletterOnline() {
	$newsletter =  getNewsletterOnline();
	require CHEMIN_VUE.'newsletter/detailsNewsletter.php';
}

function afficherNewsletter($id) {
	$newsletter =  getNewsletter($id);
	require CHEMIN_VUE.'newsletter/detailsNewsletter.php';
}

function afficherInscriptionNewsletters() {
	require CHEMIN_VUE.'newsletter/inscriptionNewsletter.php';	
}

function inscrireNewsletter() {
	
	$erreurs_newsletter = array();
	
	if ( $_POST['nom'] !== '' && $_POST['prenom'] !== ''&& $_POST['email'] !== '') {
		$email = $_POST['email'];
		$nom= $_POST['nom'];
		$prenom = $_POST['prenom'];
		
		// Vérifie si la chaine ressemble à un email
		if (preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email)) {
			$cle = generationTexte(20);
			
			if(inscriptionUtilisateurNewsletter($prenom, $nom,$email,$cle)) {
				$destinataire = $email;
				$email_expediteur = "postmaster@jkcf.com";
				$nom_expediteur = "Administrateur JKCF";
				$message_html = "<html><head></head><body><b>Salut à tous</b>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html> ";
				$sujet = "Validation de votre inscription à la newsletter du JKCF";
				
				if(envoiEmail($destinataire,$email_expediteur,$nom_expediteur, $message_html, $sujet)) {
					loggerInformation("Newsletter - Enregistrement de l'utilisateur ".$prenom." ".$nom);
					require CHEMIN_VUE.'newsletter/inscriptionNewsletterOk.php';					
				} else {
					suppressionUtilisateurNewsletter($prenom, $nom,$email);
					$erreurs_newsletter[] = "Newsletter - Erreur dans l'envoie du mail &agrave; ".$email;
					loggerInformation("Newsletter - Erreur dans l'envoie du mail à ".$email);
					require CHEMIN_VUE.'newsletter/inscriptionNewsletter.php';					
				}				
			} else {
				$erreurs_newsletter[] = "Newsletter - Erreur dans l'inscription de ".$prenom." ".$nom;
				loggerInformation("Erreur dans l'inscription de ".$prenom." ".$nom);
				require CHEMIN_VUE.'newsletter/inscriptionNewsletter.php';
			}
			
		} else {
			$erreurs_newsletter[] = "Le format de l'email est incorrect.";
			require CHEMIN_VUE.'newsletter/inscriptionNewsletter.php';
		}
	} else  {
		$erreurs_newsletter[] = "Merci de renseigner le nom et/ou prénom et/ou email.";
		require CHEMIN_VUE.'newsletter/inscriptionNewsletter.php';
	}
}

function validateUserNewsletter($cle) {

	$erreurs_newsletter = array();	
	if(validateInscriptionUtilisateurNewsletter($cle)) {
		loggerInformation("Newsletter - Validation de l'inscription cle : ".$cle);
		require CHEMIN_VUE.'newsletter/inscriptionNewsletterOk.php';		
	} else {
		$erreurs_newsletter[] = "Newsletter - Erreur dans la validation de l'inscription";
		loggerInformation("Erreur dans la validation de l'inscription ");
		require CHEMIN_VUE.'newsletter/inscriptionNewsletter.php';
	}
}

function gestionListeNewsletters() {
	$newsletters = getNewsletters();
	$lienNewsletter = "index.php?action=modificationNewsletterFormulaire&id=";
	require CHEMIN_VUE.'newsletter/gestionNewsletter.php';
}


function modificationNewsletterFormulaire($id) {
    $newsletter = getNewsletter($id);
	require CHEMIN_VUE.'newsletter/modificationNewsletter.php';
}

function modificationNewsletter() {
	if (utilisateurConnected() === '1') {
		$erreurs_newsletter = array();
		$idNewsletter = $_POST['idNewsletter'];
		$titre =  $_POST['titre'];	
		$online =  $_POST['online'];
		
		if(strlen($titre) > 0 ) {
			if(setNewsletter($idNewsletter, $titre,$online)) {
				$erreurs_newsletter[] = "La modification de la newsletter $titre a été prise en compte.";
				loggerInformation("La modification de la newsletter ".$idNewsletter." a été prise en compte.");
				require CHEMIN_VUE.'newsletter/modificationNewsletterOk.php';
			} else {
				$erreurs_newsletter[] = "Erreur dans la mise à jour de la newsletter " .$titre;
				loggerInformation("Erreur dans la mise à jour de la newsletter ".$idNewsletter." par ".$_SESSION['prenom']." ".$_SESSION['nom']);
				require CHEMIN_VUE.'newsletter/modificationNewsletterFormulaire.php?id='.$idNewsletter;		
			}				
		} else {
			$erreurs_discipline[] = "Le titre ne doit pas être vide";
			require CHEMIN_VUE.'newsletter/modificationNewsletterFormulaire.php?id='.$idNewsletter;		
		}			
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}

function listeArticleNewsletteFormulaire($id) {
    $ArticlesNewsletter = getArticlesNewsletter($id);
	$lienArticleNewsletter = "index.php?action=modificationArticleNewsletterFormulaire&id=";
	require CHEMIN_VUE.'newsletter/listeArticleNewsletters.php';
}

function modificationArticleNewsletterFormulaire($id) {
	$ArticleNewsletter = getArticleNewsletter($id);
	require CHEMIN_VUE.'newsletter/modificationArticleNewsletter.php';
}

function modificationArticleNewsletter() {
	if (utilisateurConnected() === '1') {
		$erreurs_newsletter = array();
		$id = $_POST['idArticle'];
		$titre =  $_POST['titre'];
		$categorie =  $_POST['categorie'];
		$texte =  $_POST['texte'];
		$online =  $_POST['online'];

		if(strlen($titre) > 0 ) {
			if(setArticleNewsletter($id, $titre,$categorie,$texte,$online)) {
				$erreurs_newsletter[] = "La modification de l'article de la newsletter $titre a été prise en compte.";
				loggerInformation("La modification de l'article ".$id." de la newsletter ".$idNewsletter." a été prise en compte.");
				require CHEMIN_VUE.'newsletter/modificationArticleNewsletterOk.php';
			} else {
				$erreurs_newsletter[] = "Erreur dans la mise à jour de l'article de la newsletter " .$titre;
				loggerInformation("Erreur dans la mise à jour de l'article de la newsletter ".$idNewsletter." par ".$_SESSION['prenom']." ".$_SESSION['nom']);
				require CHEMIN_VUE.'newsletter/modificationArticleNewsletterFormulaire.php?id='.$id;
			}
		} else {
			$erreurs_discipline[] = "Le titre ne doit pas être vide";
			require CHEMIN_VUE.'newsletter/modificationArticleNewsletter.php?id='.$idNewsletter;
		}
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}

// function ajoutNewsletter() {
// 	if (utilisateurConnected() === '1') {
// 		$erreurs_ceinture = array();
// 		$personne = $_POST['personne'];
// 		$discipline = $_POST['discipline'];
// 		$ceinture = $_POST['ceinture'];
// 		$commentaire = $_POST['commentaire'];

// 		loggerInformation("$personne - $discipline - $ceinture - $commentaire");
// 		if(strlen($login) > 0 ) {
// 			if(addCeinture($personne,$discipline, $ceinture,$commentaire)) {
// 				$erreurs_ceinture[] = "L'ajout de la ceinture $personne - $ceinture a été prise en compte.";
// 				loggerInformation("L'ajout de la ceinture $personne - $ceinture a été prise en compte");
// 				require CHEMIN_VUE.'ceinture/ajoutCeintureOk.php';
// 			} else {
// 				$erreurs_ceinture[] = "Erreur dans l'ajout de la ceinture $personne - $ceinture";
// 				loggerInformation("Erreur dans l'ajout de la ceinture $personne - $ceinture par ".$_SESSION['prenom']." ".$_SESSION['nom']);
// 				require CHEMIN_VUE.'ceinture/formulaireAjoutCeinture.php';
// 			}
// 		} else {
// 			$erreurs_ceinture[] = "Le nom / pr&eacute de la personne ne doit pas être vide";
// 			require CHEMIN_VUE.'ceinture/formulaireAjoutCeinture.php';
// 		}
// 	} else {
// 		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
// 	}
// }
