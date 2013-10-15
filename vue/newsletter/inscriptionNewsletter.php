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
<h2>Inscription &agrave; la Newsletter du JKCF</h2>
<?php 
require_once CHEMIN_LIB.'fonction.php';
?>
<form action='index.php?action=inscrireNewsletter' method='post'>
	
	<table border="0" align="center">
		<td width="40%">Pr&eacute;nom</td>
			<td width='60%'><input type='text' id='prenom' name='prenom' value='' size='100px' /></td>
			</tr>
			<tr>
				<td>Nom</td>
				<td><input type='text' id='nom' name='nom' size='100px' value='' /></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type='text' id='email' name='email' size='100px' value='' /></td>
			</tr>
			<tr>
				<td colspan='2' align="center"><input type="submit" name="valider"/></td>
			</tr>
	</table>
</form>	
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>