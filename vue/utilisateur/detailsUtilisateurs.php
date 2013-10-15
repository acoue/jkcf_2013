<?php ob_start() ?>
<?php 
if (!empty($erreurs_utilisateur)) { 
    echo '<div id="erreur">';     
    foreach($erreurs_password as $e) {
        echo $e.'<br/>';
    }     
    echo '</div>';
}
?>
<h2>D&eacute;tail de l'utilisateurs - Modification d'un utilisateur</h2>
<?php 
require_once CHEMIN_LIB.'fonction.php';
if (! isset($users)) { ?>
<form action='index.php?action=modificationUtilisateur' method='post'>
	<input type='hidden' id='idUser' name='idUser' value='<?php echo $user['iduser'] ?>'>
	<table border="0" align="center">
		<tr>
			<td width="40%">Pr&eacute;nom</td>
			<td width='60%'><input type='text' id='prenom' name='prenom' value='<?php echo traitementAccent($user['prenom']) ?>' size='100px' /></td>
			</tr>
			<tr>
				<td>Nom</td>
				<td><input type='text' id='nom' name='nom' size='100px' value='<?php echo traitementAccent($user['nom']) ?>' /></td>
			</tr>
			<tr>
				<td width="20%">Droit d'acc&egrave;s</td>
				<td width="80%"><SELECT name='droit' size='1'>
				<?php
					if ($user['isAdmin'] == 1 ) echo "<OPTION value='1' selected>Administrateur</OPTION><OPTION value='0' >Utilisateur</OPTION>";
					else echo "<OPTION value='1'>Administrateur</OPTION><OPTION value='0' selected>Utilisateur</OPTION>";
				?>
				</SELECT></td>
			</tr>
			<tr>
				<td>Login</td>
				<td><input type='text' id='login' name='login' size='50px' value='<?php echo $user['login'] ?>' /></td>
			</tr>
			<tr>
				<td>password</td>
				<td><input type='password' id='login' name='password' size='50px' value='<?php echo Securite::decrypteData($user['password']) ?>' /></td>
			</tr>
			<tr>
				<td width="20%">Online</td>
				<td width="80%"><SELECT name='online' size='1'>
					<?php
				if ($user['online']== 0) {
					echo "<OPTION value='0' selected >OFFLINE</OPTION>";
					echo "<OPTION value='1'>ONLINE</OPTION> ";
				} else {
					echo "<OPTION value='0'>OFFLINE</OPTION>";
					echo "<OPTION value='1' selected >ONLINE</OPTION> ";
				}
					?>
				</SELECT></td>
			</tr>
			<tr>
				<td colspan='2' align="center"><input type="submit" name="valider"/></td>
			</tr>
		</table>
	</form>	
	<p align='center' ><input type='button' name='retour' value='Retour' onclick='window.location.replace("index.php?action=gestionUtilisateur")' /></p>
	
<?php } else { ?>
	<p>==> ERREUR</p>	
<?php }?>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
