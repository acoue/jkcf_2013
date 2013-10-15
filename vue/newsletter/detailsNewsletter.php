<?php ob_start() ?>
<?php  
require_once CHEMIN_LIB.'fonction.php';
?>
<link media="screen" href="style/newsletter.css" type="text/css" rel="stylesheet" />

<p class="titre">Newsletter n&deg;<?php echo $newsletter[0][0] ?> - <?php echo $newsletter[0][1] ?></p>
<div id="contenu">
	<p class="grosTitreParagraphe">Les activit&eacute;s d&eacute;j&agrave; pass&eacute;es</p>
<?php 	
foreach ($newsletter as $news) { 
	if($news[6] == 1) { ?>	
		<p class="titreParagraphe"><?php echo traitementAccent($news[5]) ?></p>
		<p><?php echo traitementAccent($news[7]) ?></p>
<?php }
} ?>	
	<p class="grosTitreParagraphe">Les dates &agrave; retenir</p>
<?php 	
foreach ($newsletter as $news) { 
	if($news[6] == 2) { ?>	
		<p class="titreParagraphe"><?php echo traitementAccent($news[5]) ?></p>
		<p><?php echo traitementAccent($news[7]) ?></p>
<?php }
} ?>
	
</div>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
