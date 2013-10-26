<?php
require_once CHEMIN_LIB.'fonction.php';

function afficherListeNewsletters() {
	$newsletters = getNewsletters();
	$lienNewsletter = "index.php?action=detailNewsletter&id=";
	require CHEMIN_VUE.'newsletter/listeNewsletters.php';
}

function afficherNewsletterOnline() {
	$newsletter = getNewsletterOnline();
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
				
				$to    = $email;
				// adresse MAIL OVH liée à l’hébergement.
				$from  = "postmaster@jkcf.com";
				// *** Laisser tel quel
				$JOUR  = date("Y-m-d");
				$HEURE = date("H:i");
				$Subject = "$JOUR $HEURE - Validation de votre inscription à la newsletter du JKC";
				$mail_Data = "";
				$mail_Data .= "<html> \n";
				$mail_Data .= "<head> \n";
				$mail_Data .= "<title> $Subject </title> \n";
				$mail_Data .= "</head> \n";
				$mail_Data .= "<body> \n";
				$mail_Data .= "Bonjour, <br /><br/>Vous venez de vous inscrire pour recevoir la newsletter du JKCF. <br /> \n";
				$mail_Data .= "Pour finaliser et valider cette dernière merci de cliquer sur le lien suivant : <a href='".CHEMIN."index.php?action=validateUserNewsletter&cle=".$cle."' >Validation de l'adresse e-mail</a><br /> \n";
				$mail_Data .= "A bientôt. <br /><br />  \n";
				$mail_Data .= "Le webmaster du JKCF <br />\n";
				$mail_Data .= "</body> \n";
				$mail_Data .= "</HTML> \n";
				
				$headers  = "MIME-Version: 1.0 \n";
				$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
				$headers .= "From: $from  \n";
				$headers .= "Disposition-Notification-To: $from  \n";
				
				// Message de Priorité haute
				// -------------------------
				$headers .= "X-Priority: 1  \n";
				$headers .= "X-MSMail-Priority: High \n";
				
				$CR_Mail = TRUE;
				$CR_Mail = @mail ($to, $Subject, $mail_Data, $headers);
				if ($CR_Mail === FALSE) {
					suppressionUtilisateurNewsletter($prenom, $nom,$email);
					$erreurs_newsletter[] = "Newsletter - Erreur dans l'envoie du mail &agrave; ".$email;
					loggerInformation("Newsletter - Erreur dans l'envoie du mail à ".$email);
					require CHEMIN_VUE.'newsletter/inscriptionNewsletter.php';		
				} else {
					loggerInformation("Newsletter - Enregistrement de l'utilisateur ".$prenom." ".$nom);
					require CHEMIN_VUE.'newsletter/inscriptionNewsletterOk.php';
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

function desinscrireNewsletter($cle) {

	$erreurs_newsletter = array();	
	if ( $cle !== '') {
		if(desinscriptionUtilisateurNewsletter($cle)) {
			loggerInformation("Newsletter - desinscription de la cle : ".$cle);
			require CHEMIN_VUE.'newsletter/desinscriptionNewsletterOk.php';		
		} else {
			$erreurs_newsletter[] = "Newsletter - Erreur dans la validation de l'inscription";
			loggerInformation("Erreur dans la validation de l'inscription ");
			require CHEMIN_VUE.'newsletter/desinscriptionNewsletterOk.php';
		}
	} else  {
		$erreurs_newsletter[] = "Erreur dans la cle.";
		require CHEMIN_VUE.'newsletter/desinscriptionNewsletterKO.php';
	}
	
	
	
	require CHEMIN_VUE.'newsletter/desinscriptionNewsletterOk.php';
}

function validateUserNewsletter($cle) {

	$erreurs_newsletter = array();	
	if ( $cle !== '') {
		if(validateInscriptionUtilisateurNewsletter($cle)) {
			loggerInformation("Newsletter - Validation de l'inscription cle : ".$cle);
			require CHEMIN_VUE.'newsletter/validationUserNewsletterOk.php';		
		} else {
			$erreurs_newsletter[] = "Newsletter - Erreur dans la validation de l'inscription";
			loggerInformation("Erreur dans la validation de l'inscription ");
			require CHEMIN_VUE.'newsletter/validationUserNewsletterKO.php';
		}
	} else  {
		$erreurs_newsletter[] = "Erreur dans la cle.";
		require CHEMIN_VUE.'newsletter/validationUserNewsletterKO.php';
	}
}

function gestionListeNewsletters() {
	$newsletters = getNewsletters();
	$lienNewsletter = "index.php?action=modificationNewsletterFormulaire&id=";
	require CHEMIN_VUE.'newsletter/gestionNewsletter.php';
}


function modificationNewsletterFormulaire($id) {
    $newsletter = getNewsletterInfos($id);
    print_r($newsletter);
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
    $idNewsletter = $id;
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

function ajoutNewsletterFormulaire() {
	require CHEMIN_VUE.'newsletter/formulaireAjoutNewsletter.php';
}

function ajoutNewsletter() {
	if (utilisateurConnected() === '1') {
		$erreurs_newsletter = array();
		$titre = $_POST['titre'];
		$online = $_POST['online'];
		
		if(strlen($titre) > 0 ) {
			if(addNewsletter($titre,$online)) {
				$erreurs_newsletter[] = "L'ajout de la newsletter $titre a été prise en compte.";
				loggerInformation("L'ajout de la newsletter $titre a été prise en compte");
				require CHEMIN_VUE.'newsletter/gestionNewsletter.php';
			} else {
				$erreurs_newsletter[] = "Erreur dans l'ajout de la newsletter $titre";
				loggerInformation("Erreur dans l'ajout de la newsletter $titre par ".$_SESSION['prenom']." ".$_SESSION['nom']);
				require CHEMIN_VUE.'ceinture/formulaireAjoutNewsletter.php';
			}
		} else {
			$erreurs_newsletter[] = "Le titre ne doit pas être vide";
			require CHEMIN_VUE.'newsletter/formulaireAjoutNewsletter.php';
		}
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}

function ajoutArticleNewsletterFormulaire($id) {
	$idNewsletter=$id;
	require CHEMIN_VUE.'newsletter/formulaireAjoutArticleNewsletter.php';
}

function ajoutArticleNewsletter() {
	if (utilisateurConnected() === '1') {
		$erreurs_newsletter = array();
		$titre =  $_POST['titre'];
		$categorie =  $_POST['categorie'];
		$texte =  $_POST['texte'];
		$online =  $_POST['online'];
		$id =  $_POST['id'];

		if(strlen($titre) > 0 ) {
			if(addArticleNewsletter($titre,$categorie,$texte,$online,$id)) {
				$erreurs_newsletter[] = "L'ajout de l'article de la newsletter $titre a été prise en compte.";
				loggerInformation("L'ajout de l'article ".$id." de la newsletter ".$idNewsletter." a été prise en compte.");
			    $ArticlesNewsletter = getArticlesNewsletter($id);
				$lienArticleNewsletter = "index.php?action=modificationArticleNewsletterFormulaire&id=";
				require CHEMIN_VUE.'newsletter/listeArticleNewsletters.php';
			} else {
				$erreurs_newsletter[] = "Erreur dans l'ajout de l'article de la newsletter " .$titre;
				loggerInformation("Erreur dans l'ajout de l'article de la newsletter ".$idNewsletter." par ".$_SESSION['prenom']." ".$_SESSION['nom']);
				require CHEMIN_VUE.'newsletter/ajoutArticleNewsletterFormulaire.php';
			}
		} else {
			$erreurs_discipline[] = "Le titre ne doit pas être vide";
			require CHEMIN_VUE.'newsletter/modificationArticleNewsletter.php?id='.$idNewsletter;
		}
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}

function envoyerNewsletter($id) {
	if (utilisateurConnected() === '1') {
		$erreurs_newsletter = array();
		//récupération email
		$listeEmail = getListeEmail();
		//conception
		$newsletter =  getNewsletter($id);
		$texte="";
		$texte .= "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'>";
		$texte .= "<head><title>Newsletter JKCF</title></head><body>";
		
		$texte .= "<div style='margin-top: 5px;margin-bottom: 5px;text-align: center;font-size: 10px;color:black;'>Pour vous assurer de recevoir nos informations, nous vous invitons &agrave; ajouter l'adresse postmaster@jkcf.com dans votre carnet d'adresses. Si vous ne visualisez pas ce mail <a href='".CHEMIN."index.php?action=detailNewsletter&id=".$newsletter[0][0]."'>cliquez ici</a></div>";
		$texte .= "<p style='text-align: center;font-size: 30px;color:#4D4B45;'>Newsletter n&deg;".$newsletter[0][0]." - ".$newsletter[0][1]."</p>";
		$texte .= "<div style='width:97%;margin-top: 0px;margin-bottom: 0px;background-color:#FFFFFF;min-height: 100%;height: 100%;text-align: justify;padding: 10px 20px;height: auto !important;'>";
		$texte .= "<p style='background-color:#422B1C;color: #ffffff;padding: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;text-align: center;font-size: 16px;font-weight : bold;font-style : italic;'>Les activit&eacute;s d&eacute;j&agrave; pass&eacute;es</p>";
		
		foreach ($newsletter as $news) {
			if($news[7] == 1) { 
				$texte .= "<p style='color:#308CC9;padding: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;text-align: justify;font-size: 14px;font-weight : bold;font-style : italic;'>".traitementAccent($news[6])."</p>";
				$texte .= "<p>".traitementAccent($news[8])."</p>";
			}
		}
		
		$texte .= "<p style='background-color:#422B1C;color: #ffffff;padding: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;text-align: center;font-size: 16px;font-weight : bold;font-style : italic;'>Les dates &agrave; retenir</p>";
		
		foreach ($newsletter as $news) {
			if($news[7] == 2) {
				$texte .= "<p style='color:#308CC9;padding: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;text-align: justify;font-size: 14px;font-weight : bold;font-style : italic;'>".traitementAccent($news[6])."</p>";
				$texte .= "<p>".traitementAccent($news[8])."</p>";
			}
		}
		
		$texte .= "</div>";
 		$texte .= "<footer>";
 		$texte .= "<div style='margin-top: 0px;margin-bottom: 30px;width: 100%;height:50px;background-color:#422B1C;font-size: 12px;color: #ffffff;text-align: center;padding: 10px 5px 10px 5px;border-radius: 0px 0px 10px 10px;'>Ceci est un courriel d'information du Judo Kendo Club Fontenaisien. Vous recevez cet email car vous vous êtes inscrit et communiquez votre adresse email. Conformément à l'article 27 de la loi Informatique et Liberté du 06/01/1978, vous avez la possibilité de vous d&eacute;sabonner, merci de <a href='##LIEN##'>cliquez ici.</a><br />";
 		$texte .= "<p style='text-align: center;color:#FF9103;font-size: 10px;'>Copyright &copy; Judo Kendo Club Fontenaisien, Tous droits r&eacute;serv&eacute;s</p></div>";		
 		$texte .= "</footer></body></html>";
	

		
		
		// Pied de page perso
		foreach ($listeEmail as $email) {
			$texteFinal = str_replace("##LIEN##", CHEMIN."index.php?action=desinscrireNewsletter&cle=".$email['cle'],$texte);
			//envoi
			loggerInformation("Newsletter ".$id." envoyée à ".$email['email']);
			$erreurs_newsletter[] = "Newsletter ".$id." envoy&eacute;e &agrave; ".$email['email'];
		}
		loggerInformation($texteFinal);
		$texteFinal = "";
		//Flag envoi
		IF(flagSendNewsletter($id)) {
			loggerInformation("FLAG DE LA NEWSLETTER ".$id);
		} ELSE {
			loggerInformation("ERREUR DANS LE FLAG DE LA NEWSLETTER ".$id);
		}
		require CHEMIN_VUE.'newsletter/envoyerNewsletterOk.php';
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}