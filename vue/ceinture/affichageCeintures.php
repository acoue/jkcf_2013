<?php ob_start() ?>
<article>
<h2><span style="color: #c03000;">Liste des ceintures noires form&eacute;es au club toutes disciplines confondues</span></h2>
<table border="0" width="100%">	
	<tr >
		<td bgcolor='white'><b>Discipline</b></td>
		<td bgcolor='white'><b>Licenci&eacute;</b></td>
		<td bgcolor='white'><b>Dan</b></td>
	<tr>
<?php 
require_once CHEMIN_LIB.'fonction.php';
foreach ($ceintures as $ceinture) { ?>
	<tr >
		<td><span style='color: <?php echo $ceinture[4] ?>'><b><?php echo $ceinture[0] ?></b></span></td>
		<td><?php echo traitementAccent($ceinture[1]) ?></td>
		<td><?php echo traitementAccent($ceinture[2]).' '.traitementAccent($ceinture[3]) ?></td>
	<tr>
<?php } ?>
</table>
</article>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
