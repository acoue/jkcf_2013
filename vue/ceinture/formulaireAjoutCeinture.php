<?php ob_start() ?>
<?php 
if (!empty($erreurs_ceinture)) { 
    echo '<div id="erreur">';     
    foreach($erreurs_ceinture as $e) {
        echo $e.'<br/>';
    }     
    echo '</div>';
}

?>
<h2>Ajout d'un utilisateur</h2>
<form action='index.php?action=ajoutCeinture' method='post'>
	<table border="0" align="center">
		<tr>
			<td width="20%">Personne</td>
			<td width='70%'><input type='text' id='personne' name='personne' value='' size='100px' /></td>
		</tr>
		<tr>
			<td>Discipline</td>			
			<td>
				<select id='discipline' name='discipline' size='1' >
<?php foreach ($disciplines as $discipline) { ?>
<option value='<?php echo $discipline['iddiscipline'] ?>'><?php echo $discipline['discipline'] ?></option>
<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Dan</td>
			<td>
				<SELECT name='ceinture' id='ceinture' size='1'>
					<OPTION value='1er Dan'>1er Dan</OPTION>
					<OPTION value='2&egrave;me Dan'>2&egrave;me Dan</OPTION>
					<OPTION value='3&egrave;me Dan'>3&egrave;me Dan</OPTION>
					<OPTION value='4&egrave;me Dan'>4&egrave;me Dan</OPTION>
					<OPTION value='5&egrave;me Dan'>5&egrave;me Dan</OPTION>
					<OPTION value='6&egrave;me Dan'>6&egrave;me Dan</OPTION>
					<OPTION value='7&egrave;me Dan'>7&egrave;me Dan</OPTION>
				</SELECT>
			</td>
		</tr>
		<tr>
			<td>Compl&eacute;ment</td>
			<td>
				<SELECT name='commentaire' id='commentaire' size='1'>
					<OPTION value=''></OPTION>
					<OPTION value='Hanshi'>Hanshi</OPTION>
					<OPTION value='Kyoshi'>Kyoshi</OPTION>
					<OPTION value='Renshi'>Renshi</OPTION>
				</SELECT>
			</td>
		</tr>
		<tr>
			<td colspan='2' align="center"><input type="submit" name="valider"/></td>
		</tr>
	</table>
</form>	
<p align='center' ><input type='button' name='retour' value='Retour' onclick='window.location.replace("index.php?action=gestionCeinture")' /></p>
			
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>