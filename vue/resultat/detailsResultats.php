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
<h2>D&eacute;tail du resultat - Modification du resultat</h2>
<?php 
require_once CHEMIN_LIB.'fonction.php';
if (! isset($resultats)) { ?>
<form action='index.php?action=modificationResultat' method='post'>
	<input type='hidden' id='idResultat' name='idResultat' value='<?php echo $resultat['idresultat'] ?>'>
	<table border="0" align="center">
		<tr>
			<td width="20%">Titre</td>
			<td width="70%"><input type='text' id='titre' name='titre' value="<?php echo traitementAccent($resultat['titre']) ?>"/></td>
		</tr>
		<tr>
			<td>Discipline</td>				
			<td>
				<select id='discipline' name='discipline' size='1' >
<?php foreach ($disciplines as $discipline) { ?>
<option value="<?php echo $discipline['iddiscipline'] ?>" <?php if($resultat['iddiscipline'] === $discipline['iddiscipline']) echo "selected" ?>><?php echo $discipline['discipline'] ?></option>
<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Texte</td>
			<td><textarea id='texte' name='texte' style='width:100%' rows='25'><?php echo $resultat['texte'] ?></textarea></td>
		</tr>
		<tr>
			<td colspan='2' align="center"><input type="submit" name="valider"/></td>
		</tr>
	</table>
</form>	
<p align='center' ><input type='button' name='retour' value='Retour' onclick='window.location.replace("index.php?action=gestionResultat")' /></p>
	
<?php } else { ?>
	<p>==> ERREUR</p>	
<?php }?>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
