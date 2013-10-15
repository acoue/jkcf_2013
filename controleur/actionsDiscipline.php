<?php

function afficherPageDiscipline($id) {
    $disciplineTexte = getDisciplinesForPage($id);
	require CHEMIN_VUE.'discipline/affichageDisciplines.php';
}

function afficherListeDisciplines() {
	$disciplines = getDisciplines();
	$lienDiscipline = "index.php?action=detailDiscipline&id=";
	require CHEMIN_VUE.'discipline/listeDisciplines.php';
}

function afficherDiscipline($id) {
	$discipline =  getDiscipline($id);
	require CHEMIN_VUE.'discipline/detailsDisciplines.php';
}

function modificationDiscipline() {
	if (utilisateurConnected() === '1') {
		$erreurs_discipline = array();
		$idDiscipline = $_POST['idDiscipline'];
		$discipline =  $_POST['discipline'];	
		$descriptif =  $_POST['descriptif'];	
		$couleur = $_POST['couleur'];	
		
		if(strlen($descriptif) > 0 ) {
			if(setDiscipline($idDiscipline, $descriptif,$couleur)) {
				$erreurs_discipline[] = "La modification de la discipline $discipline a été prise en compte.";
				loggerInformation("La modification de la discipline ".$discipline." a été prise en compte.");
				require CHEMIN_VUE.'discipline/modificationDisciplineOk.php';
			} else {
				$erreurs_discipline[] = "Erreur dans la mise à jour de la discipline" .$discipline;
				loggerInformation("Erreur dans la mise à jour de la discipline ".$discipline." par ".$_SESSION['prenom']." ".$_SESSION['nom']);
				require CHEMIN_VUE.'discipline/detailsDisciplines.php?id='.$iddiscipline;		
			}				
		} else {
			$erreurs_discipline[] = "Le nom d'utilisateur ne doit pas être vide";
			require CHEMIN_VUE.'discipline/detailsDisciplines.php?id='.$iddiscipline;		
		}
			
			
				
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}