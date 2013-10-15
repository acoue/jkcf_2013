<?php

function afficherPageHoraire() {
    $horaireTexte = getHorairesForPage();
	require CHEMIN_VUE.'horaire/affichageHoraires.php';
}


function gestionHoraire() {
	$texteHoraire = getHoraire();
	require CHEMIN_VUE.'horaire/gestionHoraire.php';
}

function modificationHoraire() {
	if (utilisateurConnected() === '1') {
		$erreurs_horaire = array();
		$texte = $_POST['texte'];

		if(strlen($texte) > 0 ) {
			if(setHoraire($texte)) {
				$erreurs_horaire[] = "La modification de la page horaire a été prise en compte.";
				loggerInformation("La modification de la page horaire a été prise en compte par ".$_SESSION['prenom']." ".$_SESSION['nom']);
				require CHEMIN_VUE.'horaire/modificationHoraireOk.php';
			} else {
				$erreurs_horaire[] = "Erreur dans la modification de la page horaire";
				loggerInformation("Erreur dans la modification de la page horaire par ".$_SESSION['prenom']." ".$_SESSION['nom']);
				require CHEMIN_VUE.'horaire/gestionHoraire.php';
			}
		} else {
			$erreurs_horaire[] = "Le texte ne doit pas être vide";
			require CHEMIN_VUE.'horaire/gestionHoraire.php';
		}
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}