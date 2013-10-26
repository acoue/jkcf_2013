<?php ob_start() ?>
<?php 
if (!empty($erreurs_document)) { 
    echo '<div id="erreur">';     
    foreach($erreurs_document as $e) {
        echo $e.'<br/>';
    }     
    echo '</div>';
}

?>
<h2>Ajout d'un utilisateur</h2>
<form action='index.php?action=ajouterDocument' method='post' enctype="multipart/form-data">
	<table border="0" align="center">
		<tr>
			<td>Document</td>
			<td><input type="file" name="document" id='document' size="70px"></td>
		</tr>

			<tr>
				<td width="20%">Type</td>
				<td width="80%">
					<SELECT name='online' size='1'>
						<OPTION value='blabla'>Blablablara&iuml;</OPTION>
						<OPTION value='article'>Article</OPTION>
					</SELECT>
				</td>
			</tr>
			<tr>
				<td colspan='2' align="center"><input type="submit" name="valider"/></td>
			</tr>
		</table>
	</form>	
	<p align='center' ><input type='button' name='retour' value='Retour' onclick='window.location.replace("index.php?action=gestionDocument")' /></p>
			
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>