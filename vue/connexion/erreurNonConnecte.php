<?php ob_start() ?>
<h2>Accès interdit !</h2> 
<p>Vous devez être connecté pour accéder à cette page.</p>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>