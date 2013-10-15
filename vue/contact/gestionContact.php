<?php ob_start() ?>
<?php 
if (!empty($erreurs_contact)) { 
    echo '<div id="erreur">';     
    foreach($erreurs_contact as $e) {
        echo $e.'<br/>';
    }     
    echo '</div>';
}
?>
<h2>D&eacute;tail de la page contact - Modification de la page contact</h2>
<?php 
require_once CHEMIN_LIB.'fonction.php';
?>
<form action='index.php?action=modificationContact' method='post'>
	
	<table border="0" align="center">
		<tr>
			<td><textarea id='texte' name='texte'  rows='25'><?php echo $texteContact ?></textarea></td>
		</tr>
		<tr>
			<td align="center"><input type="submit" name="valider"/></td>
		</tr>
	</table>
</form>	
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
