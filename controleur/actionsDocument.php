<?php

function gestionDocument() {
	require CHEMIN_VUE.'document/gestionDocument.php';
}

function ajoutDocumentFormulaire() {
	require CHEMIN_VUE.'document/formulaireAjoutDocument.php';
}

function ajoutDocument() {
	
	if (utilisateurConnected() === '1') {
		$erreurs_document = array();
		$dossier = CHEMIN_DOC;
		$fichier = basename($_FILES['document']['name']);
		$extensions = array('.doc', '.docx', '.pdf','.xls','.xlxs');
		$extension = strrchr($_FILES['document']['name'], '.');
		$type = $_POST['type'];
		if($type === 'blabla' ) $fichier = 'blabla.pdf';
		
		if(in_array($extension, $extensions)) {
			if(move_uploaded_file($_FILES['document']['tmp_name'], $dossier . $fichier)) {
				$erreurs_document[] = "L'ajout du document $titre a été prise en compte.";
				loggerInformation("L'ajout du document $titre a été prise en compte");
				require CHEMIN_VUE.'document/gestionDocument.php';
			} else {
				$erreurs_document[] = "Erreur dans le transfert du document";
				require CHEMIN_VUE.'article/formulaireAjoutDocument.php';
			}			
		} else {
			$erreurs_document[] = "le document n'a pas la bonne extension";
			require CHEMIN_VUE.'document/formulaireAjoutDocument.php';
		}
				
	

	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}

function suppressionDocument($doc) {
	if (utilisateurConnected() === '1') {
		$erreurs_document = array();
		$fichier = CHEMIN_DOC.$doc;
		
		if( file_exists ( $fichier)) {
			if(unlink($fichier)) $erreurs_document[] = "Le fichier $doc a été supprimé avec succès";
			else $erreurs_document[] = "Erreur lors de la suppression du fichier $doc";
		} else $erreurs_document[] = "Le fichier $doc n'existe pas";
	
		require CHEMIN_VUE.'document/gestionDocument.php';
				
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}