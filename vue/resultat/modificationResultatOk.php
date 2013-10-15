<?php ob_start() ?>
<h2>Confirmation de la modification du résultat</h2>
<?php
require_once CHEMIN_LIB.'fonction.php';
if (!empty($erreurs_resultat)) { 
    echo '<div id="erreur">';     
    foreach($erreurs_resultat as $e) {
        echo traitementAccent($e).'<br/>';
    }     
    echo '</div>';
}
?>
<p align='center' ><input type='button' name='retour' value='Retour' onclick='window.location.replace("index.php?action=gestionResultat")' /></p>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
