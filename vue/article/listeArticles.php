<?php ob_start() ?>
<h2>Liste des articles</h2>
<table border="0" width="100%">	
	<tr >
		<td bgcolor='white'><b>Discipline</b></td>
		<td bgcolor='white'><b>Titre</b></td>
		<td bgcolor='white'><b>Date</b></td>
	<tr>
<?php 
require_once CHEMIN_LIB.'fonction.php';
foreach ($articles as $article) { ?>
	<tr >
		<td><?php echo $article['discipline'] ?></span></td>
		<td><a class='lienNoirGras' href="<?php echo $lienArticle. $article['idarticle'] ?> " target='_self'><?php echo traitementAccent($article['titre']) ?></a></td>
		<td><?php echo traitementAccent($article['date_creation'])?></td>
	<tr>
<?php } ?>
</table>
<p align='center' ><input type='button' name='ajouter' value='Ajouter' onclick='window.location.replace("index.php?action=ajoutArticleFormulaire")' /></p>

<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
