<?php ob_start() ?>
<h2>Acc�s interdit !</h2> 
<p>Vous devez �tre connect� pour acc�der � cette page.</p>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>