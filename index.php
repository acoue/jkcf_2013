<?php
require 'global/init.php';
require 'global/config.php';
require CHEMIN_CONTROLEUR.'actions.php';
require CHEMIN_CONTROLEUR.'actionsUtilisateur.php';
require CHEMIN_CONTROLEUR.'actionsCeinture.php';
require CHEMIN_CONTROLEUR.'actionsHoraire.php';
require CHEMIN_CONTROLEUR.'actionsCotisation.php';
require CHEMIN_CONTROLEUR.'actionsLien.php';
require CHEMIN_CONTROLEUR.'actionsDiscipline.php';
require CHEMIN_CONTROLEUR.'actionsArticle.php';
require CHEMIN_CONTROLEUR.'actionsPhoto.php';
require CHEMIN_CONTROLEUR.'actionsContact.php';
require CHEMIN_CONTROLEUR.'actionsResultat.php';
require CHEMIN_CONTROLEUR.'actionsNewsletter.php';

try {
    if (isset($_GET['action'])) {
    	if ($_GET['action'] == 'accueil') afficherAccueil();
    	else if ($_GET['action'] == 'connexion') logInUser();
    	else if ($_GET['action'] == 'deconnexion') logOutUser();
    	else if ($_GET['action'] == 'gestionPassword') afficherFormulaireGestionPassword();	
    	else if ($_GET['action'] == 'modificationPassword') modificationPassword();
    	else if ($_GET['action'] == 'gestionUtilisateur') afficherListeUtilisateurs();
    	else if ($_GET['action'] == 'afficherUtilisateur') {
            if (isset($_GET['id'])) {
                $idUser = intval($_GET['id']);
                if ($idUser != 0)
                    afficherUtilisateur($idUser);
                else throw new Exception("Identifiant non valide");
            } else throw new Exception("Identifiant non defini");
        } else if ($_GET['action'] == 'modificationUtilisateur') modificationUtilisateur();     
        else if ($_GET['action'] == 'ajoutUtilisateurFormulaire') afficherFormulaireAjoutUtilisateur();
        else if ($_GET['action'] == 'ajoutUtilisateur') ajoutUtilisateur();     
        	
        else if ($_GET['action'] == 'afficherListeCeinture') afficherPageListeCeintures();
        else if ($_GET['action'] == 'gestionCeinture') afficherListeCeintures();
        else if ($_GET['action'] == 'detailCeinture') {
        	if (isset($_GET['id'])) {
        		$idCeinture = intval($_GET['id']);
        		if ($idCeinture != 0)
        			afficherCeinture($idCeinture);
        		else throw new Exception("Identifiant non valide");
        	} else throw new Exception("Identifiant non defini");
        }
        else if ($_GET['action'] == 'modificationCeinture') modificationCeinture();
        else if ($_GET['action'] == 'ajoutCeintureFormulaire') afficherFormulaireAjoutCeinture();
        else if ($_GET['action'] == 'ajoutCeinture') ajoutCeinture();

        else if ($_GET['action'] == 'afficherHoraire') afficherPageHoraire();
    	else if ($_GET['action'] == 'gestionHoraire') gestionHoraire();
    	else if ($_GET['action'] == 'modificationHoraire') modificationHoraire();
        
    	else if ($_GET['action'] == 'afficherCotisation') afficherPageCotisation();
    	else if ($_GET['action'] == 'gestionCotisation') gestionCotisation();
    	else if ($_GET['action'] == 'modificationCotisation') modificationCotisation();
    	
    	else if ($_GET['action'] == 'afficherLien') afficherPageLien();
    	else if ($_GET['action'] == 'gestionLien') gestionLien();
    	else if ($_GET['action'] == 'modificationLien') modificationLien();
        
    	else if ($_GET['action'] == 'afficherDiscipline') {
    		if (isset($_GET['id'])) {
    			$idDiscipline = intval($_GET['id']);
    			if ($idDiscipline != 0)
    				afficherPageDiscipline($idDiscipline);
    			else throw new Exception("Identifiant non valide");
    		} else throw new Exception("Identifiant non defini");
    	}
    	else if ($_GET['action'] == 'gestionDiscipline') afficherListeDisciplines();
    	else if ($_GET['action'] == 'detailDiscipline') {
    		if (isset($_GET['id'])) {
    			$idDiscipline = intval($_GET['id']);
    			if ($idDiscipline != 0)
    				afficherDiscipline($idDiscipline);
    			else throw new Exception("Identifiant non valide");
    		} else throw new Exception("Identifiant non defini");
    	}
        else if ($_GET['action'] == 'modificationDiscipline') modificationDiscipline();    
    	
        else if ($_GET['action'] == 'gestionArticle') afficherListeArticles();
        else if ($_GET['action'] == 'detailArticle') {
        	if (isset($_GET['id'])) {
        		$idArticle = intval($_GET['id']);
        		if ($idArticle != 0)
        			afficherArticle($idArticle);
        		else throw new Exception("Identifiant non valide");
        	} else throw new Exception("Identifiant non defini");
        }
        else if ($_GET['action'] == 'modificationArticle') modificationArticle();
        else if ($_GET['action'] == 'ajoutArticleFormulaire') afficherFormulaireAjoutArticle();
        else if ($_GET['action'] == 'ajoutArticle') ajoutArticle();
        else if ($_GET['action'] == 'affichageArticle') {
        	if (isset($_GET['id'])) {
        		$idArticle = intval($_GET['id']);
        		if ($idArticle != 0)
        			afficherUnArticle($idArticle);
        		else throw new Exception("Identifiant non valide");
        	} else throw new Exception("Identifiant non defini");
        }
        
        else if ($_GET['action'] == 'afficherListeResultat') afficherPageListeResultats();
        else if ($_GET['action'] == 'gestionResultat') afficherListeResultats();
        else if ($_GET['action'] == 'detailResultat') {
        	if (isset($_GET['id'])) {
        		$idResultat = intval($_GET['id']);
        		if ($idResultat != 0)
        			afficherResultat($idResultat);
        		else throw new Exception("Identifiant non valide");
        	} else throw new Exception("Identifiant non defini");
        } 
        else if ($_GET['action'] == 'affichageResultat') {
        	if (isset($_GET['id'])) {
        		$idResultat = intval($_GET['id']);
        		if ($idResultat != 0)
        			afficherUnResultat($idResultat);
        		else throw new Exception("Identifiant non valide");
        	} else throw new Exception("Identifiant non defini");
        }
        else if ($_GET['action'] == 'modificationResultat') modificationResultat();
        else if ($_GET['action'] == 'ajoutResultatFormulaire') afficherFormulaireAjoutResultat();
        else if ($_GET['action'] == 'ajoutResultat') ajoutResultat();
        
        else if ($_GET['action'] == 'afficherContact') afficherPageContact();
        else if ($_GET['action'] == 'gestionContact') gestionContact();
        else if ($_GET['action'] == 'modificationContact') modificationContact();
        
        else if ($_GET['action'] == 'afficherPhoto') afficherPagePhoto();
        else if ($_GET['action'] == 'afficherDetailPhoto') {
        	if (isset($_GET['rep'])) {
        		$repertoire = $_GET['rep'];
        		if ($repertoire != "")
        			afficherRepertoirePhoto($repertoire);
        		else throw new Exception("Répertoire non valide");
        	} else throw new Exception("Répertoire non defini");
        }
        else if ($_GET['action'] == 'gestionPhoto') afficherPagePhoto(); // A MODIFIER
        
         else if ($_GET['action'] == 'afficherNewsletter') afficherNewsletterOnline();
        else if ($_GET['action'] == 'afficherListeNewsletter') afficherListeNewsletters();
        else if ($_GET['action'] == 'detailNewsletter') afficherNewsletter($_GET['id']);
        else if ($_GET['action'] == 'inscrireNewsletterFormulaire') afficherInscriptionNewsletters();
        else if ($_GET['action'] == 'inscrireNewsletter') inscrireNewsletter();        
        else if ($_GET['action'] == 'validateUserNewsletter') validateUserNewsletter($_GET['cle']);
        else if ($_GET['action'] == 'gestionNewsletter') gestionListeNewsletters();
        else if ($_GET['action'] == 'modificationNewsletterFormulaire')  modificationNewsletterFormulaire($_GET['id']);
        else if ($_GET['action'] == 'modificationNewsletter')  modificationNewsletter();
        else if ($_GET['action'] == 'gestionListeArticleNewsletterFormulaire')  listeArticleNewsletteFormulaire($_GET['id']);
        else if ($_GET['action'] == 'modificationArticleNewsletterFormulaire')  modificationArticleNewsletterFormulaire($_GET['id']);
        else if ($_GET['action'] == 'modificationArticleNewsletter')  modificationArticleNewsletter();
        
    	else throw new Exception("Action non valide");
    } else {
    	//Deconnexion en BDD 
		setEtatUtilisateur($_SESSION['id'],'0');
    	//Destruction de la session
    	$_SESSION = array();
		session_destroy();
		afficherAccueil(); // action par defaut
    }
} catch (Exception $e) {
	afficherErreur($e->getMessage());
}