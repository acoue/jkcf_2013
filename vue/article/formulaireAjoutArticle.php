<?php ob_start() ?>
<?php 
if (!empty($erreurs_article)) { 
    echo '<div id="erreur">';     
    foreach($erreurs_article as $e) {
        echo $e.'<br/>';
    }     
    echo '</div>';
}

?>
<h2>Ajout d'un article</h2>
<form action='index.php?action=ajoutArticle' method='post' enctype="multipart/form-data">
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
			<td>Photo</td>
			<td><input type="file" name="photo" id='photo' size="70px"></td>
		</tr>
		<tr>
			<td>Online</td>
			<td>
				<SELECT name='online' size='1'>
					<OPTION value='0'>OFFLINE</OPTION>
					<OPTION value='1'>ONLINE</OPTION>
				</SELECT>
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
<p align='center' ><input type='button' name='retour' value='Retour' onclick='window.location.replace("index.php?action=gestionArticle")' /></p>
	
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>