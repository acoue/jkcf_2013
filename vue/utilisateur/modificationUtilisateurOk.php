<?php ob_start() ?>
<h2>Confirmation de la modification de l'utilisateur</h2>
<?php
if (!empty($erreurs_utilisateur)) { 
    echo '<div id="erreur">';     
    foreach($erreurs_utilisateur as $e) {
        echo $e.'<br/>';
    }     
    echo '</div>';
}
?>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
