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
<h2>Modification de la newsletter</h2>
<?php 
require_once CHEMIN_LIB.'fonction.php';
if (! isset($newsletters)) { ?>

<form action='index.php?action=modificationNewsletter' method='post'>
	<input type='hidden' id='idNewsletter' name='idNewsletter' value='<?php echo $newsletter['idnewsletter'] ?>'>
	<table border="0" align="center" width='70%'>
		<tr>
			<td width="20%">titre</td>
			<td><input name='titre' id='titre' value='<?php echo $newsletter[1] ?>' size='100px'/></td>
		</tr>
		<tr>
			<td width="20%">Online</td>
			<td width="80%"><SELECT name='online' size='1'>
				<?php
			if ($newsletter['online']== 0) {
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
