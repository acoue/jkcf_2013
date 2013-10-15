<?php

function afficherPageCotisation() {
    $cotisationTexte = getCotisationsForPage();
	require CHEMIN_VUE.'cotisation/affichageCotisations.php';
}

function gestionCotisation() {
	$texteCotisation = getCotisation();
	require CHEMIN_VUE.'cotisation/gestionCotisation.php';
}

function modificationCotisation() {
	if (utilisateurConnected() === '1') {
		$erreurs_cotisation = array();
		$texte = $_POST['texte'];	
		
		if(strlen($texte) > 0 ) {	
			if(setCotisation($texte)) {
				$erreurs_cotisation[] = "La modification de la page cotisation a été prise en compte.";
				loggerInformation("La modification de la page cotisation a été prise en compte par ".$_SESSION['prenom']." ".$_SESSION['nom']);
				require CHEMIN_VUE.'cotisation/modificationCotisationOk.php';
			} else {
				$erreurs_cotisation[] = "Erreur dans la modification de la page cotisation";
				loggerInformation("Erreur dans la modification de la page cotisation par ".$_SESSION['prenom']." ".$_SESSION['nom']);
				require CHEMIN_VUE.'cotisation/gestionCotisation.php';		
			}			
		} else {
			$erreurs_cotisation[] = "Le texte ne doit pas être vide";
			require CHEMIN_VUE.'cotisation/gestionCotisation.php';		
		}		
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}