<?php ob_start() ?>
<p>Vous �tes d�j� connect�.</p>
<p><a href="index.php?action=accueil">Retour � l'accueil</p>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>