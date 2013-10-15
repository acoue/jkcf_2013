<?php ob_start() ?>
<h2>Confirmation de la modification de la page Contact</h2>
<?php
require_once CHEMIN_LIB.'fonction.php';
if (!empty($erreurs_contact)) { 
    echo '<div id="erreur">';     
    foreach($erreurs_contact as $e) {
        echo traitementAccent($e).'<br/>';
    }     
    echo '</div>';
}
?>
<p align='center' ><input type='button' name='retour' value='Retour' onclick='window.location.replace("index.php?action=gestionContact")' /></p>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
