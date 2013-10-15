<?php

function afficherPageListeCeintures() {
    $ceintures = getCeinturesForPage();
	require CHEMIN_VUE.'ceinture/affichageCeintures.php';
}

function afficherListeCeintures() {
    $ceintures = getCeintures();
    $lienCeinture = "index.php?action=detailCeinture&id=";
    require CHEMIN_VUE.'ceinture/listeCeintures.php';
}

function afficherCeinture($id) {
    $ceinture = getCeinture($id);
    require CHEMIN_VUE.'ceinture/detailsCeintures.php';
}

function afficherFormulaireAjoutCeinture() {	
	$disciplines = getDisciplines();
    require CHEMIN_VUE.'ceinture/formulaireAjoutCeinture.php';	
}

function ajoutCeinture() {
	if (utilisateurConnected() === '1') {		
		$erreurs_ceinture = array();
		$personne = $_POST['personne'];
		$discipline = $_POST['discipline'];
		$ceinture = $_POST['ceinture'];
		$commentaire = $_POST['commentaire'];		

		loggerInformation("$personne - $discipline - $ceinture - $commentaire");
		if(strlen($login) > 0 ) {
			if(addCeinture($personne,$discipline, $ceinture,$commentaire)) {
				$erreurs_ceinture[] = "L'ajout de la ceinture $personne - $ceinture a été prise en compte.";
				loggerInformation("L'ajout de la ceinture $personne - $ceinture a été prise en compte");
				require CHEMIN_VUE.'ceinture/ajoutCeintureOk.php';
			} else {
				$erreurs_ceinture[] = "Erreur dans l'ajout de la ceinture $personne - $ceinture";
				loggerInformation("Erreur dans l'ajout de la ceinture $personne - $ceinture par ".$_SESSION['prenom']." ".$_SESSION['nom']);
				require CHEMIN_VUE.'ceinture/formulaireAjoutCeinture.php';		
			}				
		} else {
			$erreurs_ceinture[] = "Le nom / pr&eacute de la personne ne doit pas être vide";
			require CHEMIN_VUE.'ceinture/formulaireAjoutCeinture.php';
		}	
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}


function modificationCeinture() {
	if (utilisateurConnected() === '1') {
		$erreurs_ceinture = array();
		$id = $_POST['idCeinture'];
		$personne = $_POST['personne'];
		$ceinture = $_POST['ceinture'];
		$commentaire = $_POST['commentaire'];
		

		if(setCeinture($id,$personne,$ceinture,$commentaire)) {
			$erreurs_ceinture[] = "La modification de la ceinture $personne - $ceinture a été prise en compte.";
			loggerInformation("La modification de la ceinture $personne - $ceinture a été prise en compte");
			require CHEMIN_VUE.'ceinture/modificationCeintureOk.php';
		} else {
			$erreurs_ceinture[] = "Erreur dans la modification de la ceinture $personne - $ceinture";
			loggerInformation("Erreur dans la modification de la ceinture $personne - $ceinture par ".$_SESSION['prenom']." ".$_SESSION['nom']);
			require CHEMIN_VUE.'ceinture/detailsCeintures.php?id='.$id;
		}
				
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}