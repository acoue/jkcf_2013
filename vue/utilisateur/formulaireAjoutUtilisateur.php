<?php ob_start() ?>
<?php 
if (!empty($erreurs_type)) { 
    echo '<div id="erreur">';     
    foreach($erreurs_type as $e) {
        echo $e.'<br/>';
    }     
    echo '</div>';
}

?>
<h2>Ajout d'un utilisateur</h2>
<form action='index.php?action=ajoutUtilisateur' method='post'>
	<table border="0" align="center">
		<tr>
			<td width="40%">Pr&eacute;nom</td>
			<td width='60%'><input type='text' id='prenom' name='prenom' value='' size='100px' /></td>
			</tr>
			<tr>
				<td>Nom</td>
				<td><input type='text' id='nom' name='nom' size='100px' value='' /></td>
			</tr>
			<tr>
				<td width="20%">Droit d'acc&egrave;s</td>
				<td width="80%">
					<SELECT name='droit' size='1'>
						<OPTION value='1' selected>Administrateur</OPTION>
						<OPTION value='0' >Utilisateur</OPTION>
					</SELECT>
				</td>
			</tr>
			<tr>
				<td>Login</td>
				<td><input type='text' id='login' name='login' size='50px' value='' /></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type='password' id='login' name='password' size='50px' value='' /></td>
			</tr>
			<tr>
				<td width="20%">Online</td>
				<td width="80%">
					<SELECT name='online' size='1'>
						<OPTION value='0'>OFFLINE</OPTION>
						<OPTION value='1'>ONLINE</OPTION>
					</SELECT>
				</td>
			</tr>
			<tr>
				<td colspan='2' align="center"><input type="submit" name="valider"/></td>
			</tr>
		</table>
	</form>	
	<p align='center' ><input type='button' name='retour' value='Retour' onclick='window.location.replace("index.php?action=gestionUtilisateur")' /></p>
			
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>