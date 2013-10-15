<?php ob_start() ?>
<?php 
if (!empty($erreurs_lien)) { 
    echo '<div id="erreur">';     
    foreach($erreurs_lien as $e) {
        echo $e.'<br/>';
    }     
    echo '</div>';
}
?>
<h2>D&eacute;tail de la page liens - Modification de la page liens</h2>
<?php 
require_once CHEMIN_LIB.'fonction.php';
?>
<form action='index.php?action=modificationLien' method='post'>
	
	<table border="0" align="center">
		<tr>
			<td><textarea id='texte' name='texte' style='width:100%' rows='25'><?php echo $texteLien ?></textarea></td>
		</tr>
		<tr>
			<td align="center"><input type="submit" name="valider"/></td>
		</tr>
	</table>
</form>	
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
