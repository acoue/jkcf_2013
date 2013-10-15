<?php ob_start() ?>

<?php
if (!empty($erreurs_connexion)) { 
    echo '<div id="erreur">';     
    foreach($erreurs_connexion as $e) {
        echo $e.'<br/>';
    }     
    echo '</div>';
}
?>

<h2>Connexion au site</h2>
<form action='index.php?action=connexion' method='post'>
	<table width="100%">
		<tr>
			<td width="40%"><label for='nom_utilisateur'><strong>Nom d'utilisateur</strong></label></td>
			<td width="60%"><input type='text' name='nom_utilisateur' id='nom_utilisateur' /></td>
		</tr>
		<tr>
			<td><label for='mot_de_passe'><strong>Mot de passe</strong></label></td>
			<td><input type='password' name='mot_de_passe' id='mot_de_passe'/></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type='submit' name='connexion' value='Se connecter'' /></td>
		</tr>
</table>

</form>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>