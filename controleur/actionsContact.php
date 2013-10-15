<?php

function afficherPageContact() {
    $contactTexte = getContactsForPage();
	require CHEMIN_VUE.'contact/affichageContact.php';
}

function gestionContact() {
	$texteContact = getContact();
	require CHEMIN_VUE.'contact/gestionContact.php';
}

function modificationContact() {
	if (utilisateurConnected() === '1') {
		$erreurs_contact = array();
		$texte = $_POST['texte'];	
		
		if(strlen($texte) > 0 ) {	
			if(setContact($texte)) {
				$erreurs_contact[] = "La modification de la page contact a été prise en compte.";
				loggerInformation("La modification de la page contact a été prise en compte par ".$_SESSION['prenom']." ".$_SESSION['nom']);
				require CHEMIN_VUE.'contact/modificationContactOk.php';
			} else {
				$erreurs_contact[] = "Erreur dans la modification de la page contact";
				loggerInformation("Erreur dans la modification de la page contact par ".$_SESSION['prenom']." ".$_SESSION['nom']);
				require CHEMIN_VUE.'contact/gestionContact.php';		
			}			
		} else {
			$erreurs_contact[] = "Le texte ne doit pas être vide";
			require CHEMIN_VUE.'contact/gestionContact.php';		
		}		
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}