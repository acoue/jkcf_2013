<?php ob_start() ?>
<h2>Liste des utilisateurs de l'application</h2>
<table id='table-conges' align="center" width='60%'>
	<tr align="left">
		<td width="10%"><b>Id</b></td>
		<td width="35%"><b>Pr&eacute;nom</b></td>
		<td width="35%"><b>Nom</b></td>
		<td width="20%"><b>Login</b></td>  
	</tr>
<?php 
require_once CHEMIN_LIB.'fonction.php';
foreach ($users as $user) { ?>
	<tr>
		<td><a class='lienNoirGras' href="<?php echo $lienUser . $user['iduser'] ?> " target='_self'><?php echo $user['iduser'] ?></a></td>
		<td ><?php echo traitementAccent($user['prenom']) ?> </td>
		<td ><?php echo traitementAccent($user['nom']) ?> </td>
		<td ><?php echo $user['login'] ?> </td>
	</tr>
<?php } ?>
</table>
<p align='center' ><input type='button' name='ajouter' value='Ajouter' onclick='window.location.replace("index.php?action=ajoutUtilisateurFormulaire")' /></p>

<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
