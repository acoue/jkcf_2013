<?php

function afficherPageLien() {
    $lienTexte = getLiensForPage();
	require CHEMIN_VUE.'lien/affichageLiens.php';
}

function gestionLien() {
	$texteLien = getLien();
	require CHEMIN_VUE.'lien/gestionLien.php';
}

function modificationLien() {
	if (utilisateurConnected() === '1') {
		$erreurs_lien = array();
		$texte = $_POST['texte'];

		if(strlen($texte) > 0 ) {
			if(setLien($texte)) {
				$erreurs_lien[] = "La modification de la page lien a été prise en compte.";
				loggerInformation("La modification de la page lien a été prise en compte par ".$_SESSION['prenom']." ".$_SESSION['nom']);
				require CHEMIN_VUE.'lien/modificationLienOk.php';
			} else {
				$erreurs_lien[] = "Erreur dans la modification de la page lien";
				loggerInformation("Erreur dans la modification de la page lien par ".$_SESSION['prenom']." ".$_SESSION['nom']);
				require CHEMIN_VUE.'lien/gestionLien.php';
			}
		} else {
			$erreurs_lien[] = "Le texte ne doit pas être vide";
			require CHEMIN_VUE.'lien/gestionLien.php';
		}
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}