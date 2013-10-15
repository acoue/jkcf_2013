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
<h2>D&eacute;tail de la ceinture - Modification de la ceinture</h2>
<?php 
require_once CHEMIN_LIB.'fonction.php';
if (! isset($ceintures)) { ?>
<form action='index.php?action=modificationCeinture' method='post'>
	<input type='hidden' id='idCeinture' name='idCeinture' value='<?php echo $ceinture['idceinture'] ?>'>
	<table border="0" align="center">
		<tr>
			<td width="20%">Personne</td>
			<td width='70%'><input type='text' id='personne' name='personne' value='<?php echo traitementAccent($ceinture['personne']) ?>' size='100px' readonly /></td>
		</tr>
		<tr>
			<td>Discipline</td>
			<td width='70%'><input type='text' id='discipline' name='discipline' value='<?php echo traitementAccent($ceinture['discipline']) ?>' size='100px' readonly /></td>
		</tr>
		<tr>
			<td>Dan</td>
			<td>
				<SELECT name='ceinture' id='ceinture' size='1'>
					<OPTION value='1er Dan' <?php if(strpos($ceinture['ceinture'], '1') !== false) echo "selected"; ?> >1er Dan</OPTION>
					<OPTION value='2&egrave;me Dan' <?php if(strpos($ceinture['ceinture'], '2') !== false) echo "selected"; ?> >2&egrave;me Dan</OPTION>
					<OPTION value='3&egrave;me Dan' <?php if(strpos($ceinture['ceinture'], '3') !== false) echo "selected"; ?> >3&egrave;me Dan</OPTION>
					<OPTION value='4&egrave;me Dan' <?php if(strpos($ceinture['ceinture'], '4') !== false) echo "selected"; ?> >4&egrave;me Dan</OPTION>
					<OPTION value='5&egrave;me Dan' <?php if(strpos($ceinture['ceinture'], '5') !== false) echo "selected"; ?> >5&egrave;me Dan</OPTION>
					<OPTION value='6&egrave;me Dan' <?php if(strpos($ceinture['ceinture'], '6') !== false) echo "selected"; ?> >6&egrave;me Dan</OPTION>
					<OPTION value='7&egrave;me Dan' <?php if(strpos($ceinture['ceinture'], '7') !== false) echo "selected"; ?> >7&egrave;me Dan</OPTION>
				</SELECT>
			</td>
		</tr>
		<tr>
			<td>Compl&eacute;ment</td>
			<td>
				<SELECT name='commentaire' id='commentaire' size='1'>
					<OPTION value=''></OPTION>
					<OPTION value='Hanshi' <?php if($ceinture['commentaire'] == 'Hanshi') echo "selected"; ?> >Hanshi</OPTION>
					<OPTION value='Kyoshi' <?php if($ceinture['commentaire'] == 'Kyoshi') echo "selected"; ?> >Kyoshi</OPTION>
					<OPTION value='Renshi' <?php if($ceinture['commentaire'] == 'Renshi') echo "selected"; ?> >Renshi</OPTION>
				</SELECT>
			</td>
		</tr>
		<tr>
			<td colspan='2' align="center"><input type="submit" name="valider"/></td>
		</tr>
	</table>
</form>	
<p align='center' ><input type='button' name='retour' value='Retour' onclick='window.location.replace("index.php?action=gestionCeinture")' /></p>
	
<?php } else { ?>
	<p>==> ERREUR</p>	
<?php }?>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
