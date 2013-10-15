<?php ob_start() ?>
<h2>Liste des résultats</h2>
<table border="0" width="100%">	
	<tr >
		<td bgcolor='white' width='30%'><b>Discipline</b></td>
		<td bgcolor='white'><b>Titre</b></td>
	<tr>
<?php 
require_once CHEMIN_LIB.'fonction.php';
foreach ($resultats as $resultat) { ?>
	<tr >
		<td><?php echo $resultat['discipline'] ?></span></td>
		<td><a class='lienNoirGras' href="<?php echo $lienResultat. $resultat['idresultat'] ?> " target='_self'><?php echo traitementAccent($resultat['titre']) ?></a></td>
	<tr>
<?php } ?>
</table>
<p align='center' ><input type='button' name='ajouter' value='Ajouter' onclick='window.location.replace("index.php?action=ajoutResultatFormulaire")' /></p>

<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
