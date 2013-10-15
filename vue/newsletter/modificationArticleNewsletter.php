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
<h2>Modification de l'article</h2>
<?php 
require_once CHEMIN_LIB.'fonction.php';
if (! isset($ArticlesNewsletter)) { ?>

<form action='index.php?action=modificationArticleNewsletter' method='post'>
	<input type='hidden' id='idArticle' name='idArticle' value='<?php echo $ArticleNewsletter['idnewsletter_article'] ?>'>
	<table border="0" align="center" width='70%'>
		<tr>
			<td width="20%">titre</td>
			<td><input name='titre' id='titre' value='<?php echo $ArticleNewsletter['titre'] ?>' size='200px'/></td>
		</tr>
		<tr>
			<td width="20%">texte</td>
			<td><textarea id='texte' name='texte' style='width:100%' rows='25'><?php echo $ArticleNewsletter['texte'] ?></textarea></td>
		</tr>
		<tr>
			<td width="20%">Cat&eacute;gorie</td>
			<td width="80%"><SELECT name='categorie' size='1'>
				<?php
			if ($ArticleNewsletter['categorie']== 1) {
				echo "<OPTION value='1' selected >Activit&eacute;s pass&eacute;es</OPTION>";
				echo "<OPTION value='2'>Activit&eacute;s futures</OPTION> ";
			} else {
				echo "<OPTION value='1'>Activit&eacute;s passées</OPTION>";
				echo "<OPTION value='2' selected >Activit&eacute;s futures</OPTION> ";
			}
				?>
			</SELECT></td>
		</tr>
		<tr>
			<td width="20%">Online</td>
			<td width="80%"><SELECT name='online' size='1'>
				<?php
			if ($ArticleNewsletter['online']== 0) {
				echo "<OPTION value='0' selected >OFFLINE</OPTION>";
				echo "<OPTION value='1'>ONLINE</OPTION> ";
			} else {
				echo "<OPTION value='0'>OFFLINE</OPTION>";
				echo "<OPTION value='1' selected >ONLINE</OPTION> ";
			}
				?>
			</SELECT></td>
		</tr>
		<tr>
			<td align="center" colspan='2'><input type="submit" name="valider"/></td>
		</tr>
	</table>
</form>	
<?php } else { ?>
	<p>==> ERREUR</p>	
<?php }?>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>