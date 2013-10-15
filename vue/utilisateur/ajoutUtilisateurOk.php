<?php ob_start() ?>
<h2>Confirmation de l'ajout de l'utilisateur</h2>
<?php
if (!empty($erreurs_utilisateur)) { 
    echo '<div id="info">';     
    foreach($erreurs_utilisateur as $e) {
        echo $e.'<br/>';
    }     
    echo '</div>';
}
?>
<p align='center' ><input type='button' name='retour' value='Retour' onclick='window.location.replace("index.php?action=gestionUtilisateur")' /></p>

<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
