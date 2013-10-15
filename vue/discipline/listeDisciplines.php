<?php ob_start() ?>
<h2>Liste des Disciplines</h2>
<table id='table-conges' align="center" width='60%'>
	<tr align="left">
		<td width="30%"><b>Id</b></td>
		<td width="70%"><b>Discipline</b></td>  
	</tr>
<?php 
require_once CHEMIN_LIB.'fonction.php';
foreach ($disciplines as $discipline) { ?>
	<tr>
		<td><a class='lienNoirGras' href="<?php echo $lienDiscipline. $discipline['iddiscipline'] ?> " target='_self'><?php echo $discipline['iddiscipline'] ?></a></td>
		<td ><?php echo traitementAccent($discipline['discipline']) ?> </td>
	</tr>
<?php } ?>
</table>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
