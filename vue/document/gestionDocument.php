<?php ob_start() ?>
<?php 
if (!empty($erreurs_document)) { 
    echo '<div id="erreur">';     
    foreach($erreurs_document as $e) {
        echo $e.'<br/>';
    }     
    echo '</div>';
}

?><h2>Gestion des documents</h2>
<?php 
recursive_readdir_simple(CHEMIN_DOC);
echo "<br />";
?><p align='center' ><input type='button' name='ajouter' value='Ajouter' onclick='window.location.replace("index.php?action=ajoutDocument")' /></p>
	
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>