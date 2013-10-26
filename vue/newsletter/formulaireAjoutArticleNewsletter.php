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
<h2>Ajout de l'article</h2>
<form action='index.php?action=ajoutArticleNewsletter' method='post'>
	<input type='hidden' id='id' name='id' value='<?php echo $idNewsletter ?>'>
	<table border="0" align="center" width='70%'>
		<tr>
			<td width="20%">titre</td>
			<td><input name='titre' id='titre' value='' size='200px'/></td>
		</tr>
		<tr>
			<td width="20%">texte</td>
			<td><textarea id='texte' name='texte' style='width:100%' rows='25'></textarea></td>
		</tr>
		<tr>
			<td width="20%">Cat&eacute;gorie</td>
			<td width="80%"><SELECT name='categorie' size='1'>
				<OPTION value='1' selected >Activit&eacute;s pass&eacute;es</OPTION>
				<OPTION value='2'>Activit&eacute;s futures</OPTION> 
			</SELECT></td>
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
<p align='center' ><input type='button' name='retour' value='Retour' onclick='window.location.replace("index.php?action=gestionListeArticleNewsletterFormulaire&id=<?php echo $ArticleNewsletter['idnewsletter'] ?>")' /></p>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>