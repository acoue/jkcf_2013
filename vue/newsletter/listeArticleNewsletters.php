<?php ob_start() ?>
<h2>Liste des articles</h2>
<table id='table-conges' align="center" width='60%'>
	<tr align="left">
		<td width="30%"><b>Num&eacute;ro</b></td>
		<td width="70%"><b>Texte</b></td>  
	</tr>
<?php 
require_once CHEMIN_LIB.'fonction.php';
foreach ($ArticlesNewsletter as $ArticleNewsletter) { ?>
	<tr>
		<td ><?php echo $ArticleNewsletter['idnewsletter_article'] ?> </td>
		<td><a class='lienNoirGras' href="<?php echo $lienArticleNewsletter. $ArticleNewsletter['idnewsletter_article'] ?> " target='_self'><?php echo $ArticleNewsletter['titre'] ?></a></td>
	</tr>
<?php } ?>
</table>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
