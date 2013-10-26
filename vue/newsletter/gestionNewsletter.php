<?php ob_start() ?>
<h2>Liste des Newsletters du JKCF</h2>
<table id='table-conges' align="center" width='60%'>
	<tr align="left">
		<td width="20%"><b>Num&eacute;ro</b></td>
		<td width="40%"><b>Titre</b></td>  
		<td width="20%"></td> 
		<td width="20%"></td>
	</tr>
<?php 
require_once CHEMIN_LIB.'fonction.php';
foreach ($newsletters as $newsletter) { ?>
	<tr>
		<td ><?php echo $newsletter['idnewsletter'] ?> </td>
		<td><a class='lienNoirGras' href="<?php echo $lienNewsletter. $newsletter['idnewsletter'] ?> " target='_self'><?php echo $newsletter['titre'] ?></a></td>
		<td ><input type='button' name='modifier' value='Modifier les articles' onclick='window.location.replace("index.php?action=gestionListeArticleNewsletterFormulaire&id=<?php echo $newsletter['idnewsletter']?>")' /></td>
		<td><?php if($newsletter['envoi']=="0") { ?>
			<input type='button' name='envoyer' value='Envoyer' onclick='window.location.replace("index.php?action=envoyerNewsletter&id=<?php echo $newsletter['idnewsletter']?>")' />
		<?php } ?>
		</td>
	</tr>
<?php } ?>
</table>
<p align='center' ><input type='button' name='ajouter' value='Ajouter' onclick='window.location.replace("index.php?action=ajoutNewsletterFormulaire")' /></p>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
