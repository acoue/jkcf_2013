<?php ob_start() ?>
<?php 
if (!empty($erreurs_cotisation)) { 
    echo '<div id="erreur">';     
    foreach($erreurs_cotisation as $e) {
        echo $e.'<br/>';
    }     
    echo '</div>';
}
?>
<h2>D&eacute;tail de la page horaires - Modification de la page horaires</h2>
<?php 
require_once CHEMIN_LIB.'fonction.php';
?>
<form action='index.php?action=modificationHoraire' method='post'>
	
	<table border="0" align="center">
		<tr>
			<td><textarea id='texte' name='texte'  rows='25'><?php echo $texteHoraire ?></textarea></td>
		</tr>
		<tr>
			<td align="center"><input type="submit" name="valider"/></td>
		</tr>
	</table>
</form>	
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
