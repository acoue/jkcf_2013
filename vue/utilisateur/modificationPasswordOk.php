<?php ob_start() ?>
<h2>Confirmation de changement de mot de passe</h2>
<?php
if (!empty($erreurs_password)) { 
    echo '<div id="info">';     
    foreach($erreurs_password as $e) {
        echo $e.'<br/>';
    }     
    echo '</div>';
}
?>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
