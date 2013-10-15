<?php ob_start() ?>
<h2>Liste des ceintures noires form&eacute;es au club toutes disciplines confondues</h2>
<table border="0" width="100%">	
	<tr >
		<td bgcolor='white'><b></b></td>
		<td bgcolor='white'><b>Discipline</b></td>
		<td bgcolor='white'><b>Licenci&eacute;</b></td>
		<td bgcolor='white'><b>Dan</b></td>
	<tr>
<?php 
require_once CHEMIN_LIB.'fonction.php';
foreach ($ceintures as $ceinture) { ?>
	<tr >
		<td><a class='lienNoirGras' href="<?php echo $lienCeinture. $ceinture['idceinture'] ?> " target='_self'><?php echo $ceinture['idceinture'] ?></a></td>
		<td><span style='color: <?php echo $ceinture['couleur'] ?>'><b><?php echo $ceinture['discipline'] ?></b></span></td>
		<td><?php echo traitementAccent($ceinture['personne']) ?></td>
		<td><?php echo traitementAccent($ceinture['ceinture']).' '.traitementAccent($ceinture['commentaire']) ?></td>
	<tr>
<?php } ?>
</table>
<p align='center' ><input type='button' name='ajouter' value='Ajouter' onclick='window.location.replace("index.php?action=ajoutCeintureFormulaire")' /></p>

<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
