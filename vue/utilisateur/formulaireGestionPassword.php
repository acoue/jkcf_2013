<?php ob_start() ?>
<?php 
if (!empty($erreurs_password)) { 
    echo '<div id="erreur">';     
    foreach($erreurs_password as $e) {
        echo $e.'<br/>';
    }     
    echo '</div>';
}
?>

<h2>Gestion de votre mot de passe</h2>
<form action='index.php?action=modificationPassword' method='post'>
	<table border="0" align="center">
		<tr>
			<td width="50%">Entrez votre ancien mot de passe</td>
			<td width="50%"><input type="password" id="ancien" name="ancien" value="" /></td>
		</tr>
		<tr>
			<td width="50%">Entrez votre nouveau mot de passe</td>
			<td width="50%"><input type="password" id="nouveau" name="nouveau" value="" /></td>
		</tr>
		<tr>
			<td width="50%">Retapper votre nouveau mot de passe</td>
			<td width="50%"><input type="password" id="verif" name="verif" value="" /></td>
		</tr>
		<tr>
			<td colspan='2' align="center"><input type="submit" name="valider"/></td>
		</tr>
	</table>
</form>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
