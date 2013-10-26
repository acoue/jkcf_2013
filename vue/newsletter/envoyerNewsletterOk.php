<?php ob_start() ?>
<h2>Envoi de la la newsletter effectu&eacute;e</h2>
<?php
if (!empty($erreurs_newsletter)) { 
    echo '<div id="info">';     
    foreach($erreurs_newsletter as $e) {
        echo $e.'<br/>';
    }     
    echo '</div>';
}
?>
<p align='center' ><input type='button' name='retour' value='Retour' onclick='window.location.replace("index.php?action=gestionNewsletter")' /></p>

<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
