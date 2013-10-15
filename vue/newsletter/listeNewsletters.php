<?php ob_start() ?>
<h2>Liste des Newsletters du JKCF</h2>
<table id='table-conges' align="center" width='60%'>
	<tr align="left">
		<td width="30%"><b>Num&eacute;ro</b></td>
		<td width="70%"><b>Titre</b></td>  
	</tr>
<?php 
require_once CHEMIN_LIB.'fonction.php';
foreach ($newsletters as $newsletter) { ?>
	<tr>
		<td ><?php echo $newsletter['idnewsletter'] ?> </td>
		<td><a class='lienNoirGras' href="<?php echo $lienNewsletter. $newsletter['idnewsletter'] ?> " target='_self'><?php echo $newsletter['titre'] ?></a></td>
	</tr>
<?php } ?>
</table>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
