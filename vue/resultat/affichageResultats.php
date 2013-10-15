<?php ob_start() ?>
<br />
<h2>R&eacute;sultat du club toutes disciplines confondues</h2>
<?php 
require_once CHEMIN_LIB.'fonction.php';
foreach ($resultats as $resultat) { ?>
<article>
	<table width="100%">
		<tr>
			<td ><h1><span style='color: <?php echo $resultat['couleur'] ?>'>
								<?php echo $resultat['discipline'] ?> - <?php echo traitementAccent($resultat['titre']) ?>
								</span></h1>
			</td>
		<tr>
			<td >	
			<?php  
				echo traitementAccent($resultat['texte']); ?>
			</td>
		</tr>
		<tr>
			<td>
				<p class="reseauxSociaux"><i>Partagez-le avec vos amis en cliquant sur les boutons ci-dessous :</i></p>
				<div style="float:left;">
					<a target="_blank" title="Twitter" href="https://twitter.com/share?url=<?php echo CHEMIN.$lienResultat. $resultat['idresultat'] ?>&text=<?php echo traitementAccent($resultat['titre']) ?>" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=700');return false;"><img src="<?php echo CHEMIN_RESSOC ?>twitter_icon.png" alt="Twitter" /></a>
					<a target="_blank" title="Facebook" href="https://www.facebook.com/sharer.php?u=<?php echo CHEMIN.$lienResultat. $resultat['idresultat'] ?>&t=<?php echo traitementAccent($resultat['titre']) ?>" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700');return false;"><img src="<?php echo CHEMIN_RESSOC ?>facebook_icon.png" alt="Facebook" /></a>
					<a target="_blank" title="Google +" href="https://plus.google.com/share?url=<?php echo CHEMIN.$lienResultat. $resultat['idresultat'] ?>&hl=fr" rel="nofollow" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=450,width=650');return false;"><img src="<?php echo CHEMIN_RESSOC ?>gplus_icon.png" alt="Google Plus" /></a>
					<a target="_blank" title="Envoyer par mail" href="mailto:?subject=<?php echo traitementAccent($lienResultat['titre']) ?>&body=<?php echo CHEMIN.$lienArticle. $resultat['idresultat'] ?>" rel="nofollow"><img src="<?php echo CHEMIN_RESSOC ?>email_icon.png" alt="email" /></a>
				</div>
				<div style="clear:both"></div>		
			</td>
		</tr>
	</table>
</article>
<?php } ?>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
