<?php
function afficherPageListeResultats() {
	$resultats = getResultatsForPage();
	$lienResultat = "index.php?action=affichageResultat&id=";
	require CHEMIN_VUE.'resultat/affichageResultats.php';
}

function afficherListeResultats() {
    $resultats = getResultats();
    $lienResultat = "index.php?action=detailResultat&id=";
    require CHEMIN_VUE.'resultat/listeResultats.php';
}

function afficherResultat($id) {	
    $resultat = getResultat($id);
	$disciplines = getDisciplines();
    require CHEMIN_VUE.'resultat/detailsResultats.php';
}

function afficherUnResultat($id) {
	$resultat = getResultat($id);
	$lienResultat = "index.php?action=affichageResultat&id=".$id;
	require CHEMIN_VUE.'resultat/affichageUnResultat.php';
}

function afficherFormulaireAjoutResultat() {
	$disciplines = getDisciplines();
    require CHEMIN_VUE.'resultat/formulaireAjoutResultat.php';	
}

function ajoutResultat() {
	if (utilisateurConnected() === '1') {		
		$erreurs_resultat = array();
		$photo = $_POST['photo'];
		$discipline = $_POST['discipline'];
		$titre = $_POST['titre'];
		$texte = $_POST['texte'];	
		
		if(strlen($titre) > 0 ) {
			if(strlen($texte) > 0 ) {
				if(addResultat($discipline, $titre,$texte,$photo)) {
					$erreurs_resultat[] = "L'ajout du resultat $titre a été prise en compte.";
					loggerInformation("L'ajout du resultat $titre a été prise en compte");
					require CHEMIN_VUE.'resultat/ajoutResultatOk.php';
				} else {
					$erreurs_resultat[] = "Erreur dans l'ajout du resultat $titre";
					loggerInformation("Erreur dans l'ajout du resultat $titre par ".$_SESSION['prenom']." ".$_SESSION['nom']);
					require CHEMIN_VUE.'resultat/formulaireAjoutResultat.php';		
				}				
			} else {
				$erreurs_resultat[] = "Le texte du resultat ne doit pas être vide";
				require CHEMIN_VUE.'resultat/formulaireAjoutResultat.php';
			}	
		} else {
			$erreurs_resultat[] = "Le titre du resultat ne doit pas être vide";
			require CHEMIN_VUE.'resultat/formulaireAjoutResultat.php';
		}
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}


function modificationResultat() {
	if (utilisateurConnected() === '1') {
		$erreurs_resultat = array();
		$id = $_POST['idResultat'];
		$photo = $_POST['photo'];
		$discipline = $_POST['discipline'];
		$titre = $_POST['titre'];
		$texte = $_POST['texte'];
		if(strlen($titre) > 0 ) {
			if(strlen($texte) > 0 ) {
				if(setResultat($id,$discipline, $titre,$texte,$photo)) {
					$erreurs_resultat[] = "La modification du resultat $titre a été prise en compte.";
					loggerInformation("La modification du resultat $titre a été prise en compte");
					require CHEMIN_VUE.'resultat/modificationResultatOk.php';
				} else {
					$erreurs_resultat[] = "Erreur dans la modification du resultat $titre";
					loggerInformation("Erreur dans la modification du resultat $titree par ".$_SESSION['prenom']." ".$_SESSION['nom']);
					require CHEMIN_VUE.'resultat/detailsResultats.php?id='.$id;
				}
			} else {
				$erreurs_resultat[] = "Le texte du resultat ne doit pas être vide";
				require CHEMIN_VUE.'resultat/detailsResultats.php?id='.$id;
			}
		} else {
			$erreurs_resultat[] = "Le titre du resultat ne doit pas être vide";
			require CHEMIN_VUE.'resultat/detailsResultats.php?id='.$id;
		}
				
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}