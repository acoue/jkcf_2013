<?php ob_start() ?>
<h2>La validation de l'email pour l'inscription &agrave; la newsletter est effectu&eacute;</h2>
<?php
if (!empty($erreurs_newsletter)) { 
    echo '<div id="info">';     
    foreach($erreurs_newsletter as $e) {
        echo $e.'<br/>';
    }     
    echo '</div>';
}
?>
<p>Merci pour votre inscription, bonne visite.</p>
<p align='center' ><input type='button' name='liste' value='Newsletter' onclick='window.location.replace("index.php?action=afficherNewsletter")' /></p>

<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
