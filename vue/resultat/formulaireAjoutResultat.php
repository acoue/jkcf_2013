<?php ob_start() ?>
<?php 
if (!empty($erreurs_resultat)) { 
    echo '<div id="erreur">';     
    foreach($erreurs_resultat as $e) {
        echo $e.'<br/>';
    }     
    echo '</div>';
}

?>
<h2>Ajout d'un resultat</h2>
<form action='index.php?action=ajoutResultat' method='post'>
	<table border="0" align="center">
		<tr>
			<td width="20%">Titre</td>
			<td width="70%"><input type='text' id='titre' name='titre' value=""/></td>
		</tr>
		<tr>
			<td>Discipline</td>				
			<td>
				<select id='discipline' name='discipline' size='1' >
<?php foreach ($disciplines as $discipline) { ?>
<option value="<?php echo $discipline['iddiscipline'] ?>"><?php echo $discipline['discipline'] ?></option>
<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Texte</td>
			<td><textarea id='texte' name='texte' style='width:100%' rows='25'></textarea></td>
		</tr>
		<tr>
			<td colspan='2' align="center"><input type="submit" name="valider"/></td>
		</tr>
	</table>
</form>	
<p align='center' ><input type='button' name='retour' value='Retour' onclick='window.location.replace("index.php?action=gestionResultat")' /></p>
	
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>