<?php ob_start() ?>
<h2>Confirmation de la modification de l'article</h2>
<?php
require_once CHEMIN_LIB.'fonction.php';
if (!empty($erreurs_article)) { 
    echo '<div id="erreur">';     
    foreach($erreurs_article as $e) {
        echo traitementAccent($e).'<br/>';
    }     
    echo '</div>';
}
?>
<p align='center' ><input type='button' name='retour' value='Retour' onclick='window.location.replace("index.php?action=gestionArticle")' /></p>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
