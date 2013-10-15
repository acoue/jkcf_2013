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
<h2>D&eacute;tail de l'article - Modification de l'article</h2>
<?php 
require_once CHEMIN_LIB.'fonction.php';
if (! isset($articles)) { ?>
<form action='index.php?action=modificationArticle' method='post'>
	<input type='hidden' id='idArticle' name='idArticle' value='<?php echo $article['idarticle'] ?>'>
	<table border="0" align="center">
		<tr>
			<td width="20%">Titre</td>
			<td width="70%"><input type='text' id='titre' name='titre' value="<?php echo traitementAccent($article['titre']) ?>"/></td>
		</tr>
		<tr>
			<td>Discipline</td>				
			<td>
				<select id='discipline' name='discipline' size='1' >
<?php foreach ($disciplines as $discipline) { ?>
<option value="<?php echo $discipline['iddiscipline'] ?>" <?php if($article['iddiscipline'] === $discipline['iddiscipline']) echo "selected" ?>><?php echo $discipline['discipline'] ?></option>
<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Photo</td>
			<td><input type='text' id='photo' name='photo' value="<?php echo $article['photo'] ?>"/></td>
		</tr>
		<tr>
			<td>Online</td>
			<td><SELECT name='online' size='1'>
				<?php
				if ($article['online']== 0) {
					echo "<OPTION value='0' selected >OFFLINE</OPTION>";
					echo "<OPTION value='1'>ONLINE</OPTION> ";
				} else {
					echo "<OPTION value='0'>OFFLINE</OPTION>";
					echo "<OPTION value='1' selected >ONLINE</OPTION> ";
				}
					?>
				</SELECT>
			</td>
		</tr>
		<tr>
			<td>Texte</td>
			<td><textarea id='texte' name='texte' style='width:100%' rows='25'><?php echo $article['texte'] ?></textarea></td>
		</tr>
		<tr>
			<td colspan='2' align="center"><input type="submit" name="valider"/></td>
		</tr>
	</table>
</form>	
<p align='center' ><input type='button' name='retour' value='Retour' onclick='window.location.replace("index.php?action=gestionArticle")' /></p>
	
<?php } else { ?>
	<p>==> ERREUR</p>	
<?php }?>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
