<?php ob_start() ?>
<?php 
if (!empty($erreurs_newsletter)) { 
    echo '<div id="erreur">';     
    foreach($erreurs_newsletter as $e) {
        echo $e.'<br/>';
    }     
    echo '</div>';
}
?>
<h2>Ajout d'une newsletter</h2>
<?php 
require_once CHEMIN_LIB.'fonction.php';
?>
<form action='index.php?action=ajoutNewsletter' method='post'>
	<table border="0" align="center" width='70%'>
		<tr>
			<td width="20%">titre</td>
			<td><input name='titre' id='titre' value='' size='100px'/></td>
		</tr>
		<tr>
			<td width="20%">Online</td>
			<td width="80%"><SELECT name='online' size='1'>
				<OPTION value='0' selected >OFFLINE</OPTION>
				<OPTION value='1'>ONLINE</OPTION> 
			</SELECT></td>
		</tr>
		<tr>
			<td align="center" colspan='2'><input type="submit" name="valider"/></td>
		</tr>
	</table>
</form>	
<p align='center' ><input type='button' name='annuler' value='Annuler' onclick='window.location.replace("index.php?action=gestionNewsletter")' /></p>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
