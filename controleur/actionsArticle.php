<?php

function afficherListeArticles() {
    $articles = getArticles();
    $lienArticle = "index.php?action=detailArticle&id=";
    require CHEMIN_VUE.'article/listeArticles.php';
}

function afficherUnArticle($id) {
	$article = getOneArticlesForPage($id);
    $lienArticle = "index.php?action=detailArticle&id=".$id;
	require CHEMIN_VUE.'article/affichageArticle.php';
}

function afficherArticle($id) {
    $article = getArticle($id);
	$disciplines = getDisciplines();
    require CHEMIN_VUE.'article/detailsArticles.php';
}

function afficherFormulaireAjoutArticle() {
	$disciplines = getDisciplines();
    require CHEMIN_VUE.'article/formulaireAjoutArticle.php';	
}

function ajoutArticle() {
	if (utilisateurConnected() === '1') {		
		$erreurs_article = array();
		$discipline = $_POST['discipline'];
		$titre = $_POST['titre'];
		$texte = $_POST['texte'];	
		$online = $_POST['online'];
		$dossier = 'images/article/';
		$fichier = basename($_FILES['photo']['name']);
		$extensions = array('.png', '.jpg', '.jpeg');
		$extension = strrchr($_FILES['photo']['name'], '.');
		
		if(strlen($fichier) == 0) {
			$fichier = 'logo.png';
			$extension = '.png';
		}

		if(strlen($titre) > 0 ) {
			if(strlen($texte) > 0 ) {
				if(addArticle($discipline, $titre,$texte,$fichier,$online)) {					
					if(in_array($extension, $extensions)) {							
						if($fichier != 'logo.png') {
							if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossier . $fichier)) {			
								$erreurs_article[] = "L'ajout de l'article $titre a été prise en compte.";
								loggerInformation("L'ajout de l'article $titre a été prise en compte");
								require CHEMIN_VUE.'article/ajoutArticleOk.php';
							} else {
								$erreurs_article[] = "Erreur dans le transfert du fichier photo";
								require CHEMIN_VUE.'article/formulaireAjoutArticle.php';
							}
						} else {
							$erreurs_article[] = "L'ajout de l'article $titre a été prise en compte.";
							loggerInformation("L'ajout de l'article $titre a été prise en compte");
							require CHEMIN_VUE.'article/ajoutArticleOk.php';
						}
					} else {
						$erreurs_article[] = "le fichier n'est pas une image";
						require CHEMIN_VUE.'article/formulaireAjoutArticle.php';			
					}	
				} else {
					$erreurs_article[] = "Erreur dans l'ajout de l'article $titre";
					loggerInformation("Erreur dans l'ajout de l'article $titre par ".$_SESSION['prenom']." ".$_SESSION['nom']);
					require CHEMIN_VUE.'article/formulaireAjoutArticle.php';
				}
			} else {
				$erreurs_article[] = "Le texte de l'article ne doit pas être vide";
				require CHEMIN_VUE.'article/formulaireAjoutArticle.php';
			}				
		} else {
			$erreurs_article[] = "Le titre de l'article ne doit pas être vide";
			require CHEMIN_VUE.'article/formulaireAjoutArticle.php';	
		}		
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}


function modificationArticle() {
	if (utilisateurConnected() === '1') {
		$erreurs_article = array();
		$id = $_POST['idArticle'];
		$photo = $_POST['photo'];
		$discipline = $_POST['discipline'];
		$titre = $_POST['titre'];
		$texte = $_POST['texte'];
		$online = $_POST['online'];
		if(strlen($titre) > 0 ) {
			if(strlen($texte) > 0 ) {
				if(setArticle($id,$discipline, $titre,$texte,$photo,$online)) {
					$erreurs_article[] = "La modification de l'article $titre a été prise en compte.";
					loggerInformation("La modification de l'article $titre a été prise en compte");
					require CHEMIN_VUE.'article/modificationArticleOk.php';
				} else {
					$erreurs_article[] = "Erreur dans la modification de l'article $titre";
					loggerInformation("Erreur dans la modification de l'article $titree par ".$_SESSION['prenom']." ".$_SESSION['nom']);
					require CHEMIN_VUE.'article/detailsArticles.php?id='.$id;
				}
			} else {
				$erreurs_article[] = "Le texte de l'article ne doit pas être vide";
				require CHEMIN_VUE.'article/detailsArticles.php?id='.$id;
			}
		} else {
			$erreurs_article[] = "Le titre de l'article ne doit pas être vide";
			require CHEMIN_VUE.'article/detailsArticles.php?id='.$id;
		}
				
	} else {
		require CHEMIN_VUE.'connexion/erreurNonConnecte.php';
	}
}