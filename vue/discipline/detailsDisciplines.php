<?php ob_start() ?>
<?php 
if (!empty($erreurs_discipline)) { 
    echo '<div id="erreur">';     
    foreach($erreurs_discipline as $e) {
        echo $e.'<br/>';
    }     
    echo '</div>';
}
?>
<h2>D&eacute;tail de la discipline - Modification de la discipline</h2>
<?php 
require_once CHEMIN_LIB.'fonction.php';
if (! isset($disciplines)) { ?>
<form action='index.php?action=modificationDiscipline' method='post'>
	<input type='hidden' id='idDiscipline' name='idDiscipline' value='<?php echo $discipline['iddiscipline'] ?>'>
	<table border="0" align="center">
		<tr>
			<td width="20%">Discipline</td>
			<td width='70%'><input type='text' id='discipline' name='discipline' value='<?php echo traitementAccent($discipline['discipline']) ?>' size='100px' readonly /></td>
			</tr>
			<tr>
				<td>Couleur</td>
				<td><input type='text' id='couleur' name='couleur' size='100px' value='<?php echo $discipline['couleur'] ?>' /></td>
			</tr>
			<tr>
				<td>Descriptif</td>
				<td><textarea id='descriptif' name='descriptif' style="width:100%" rows="25"><?php echo $discipline['descriptif'] ?></textarea></td>
			</tr>
			<tr>
				<td colspan='2' align="center"><input type="submit" name="valider"/></td>
			</tr>
		</table>
	</form>	
	<p align='center' ><input type='button' name='retour' value='Retour' onclick='window.location.replace("index.php?action=gestionDiscipline")' /></p>
	
<?php } else { ?>
	<p>==> ERREUR</p>	
<?php }?>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
