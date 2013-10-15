<?php ob_start() ?>
<p>Vous êtes déjà connecté.</p>
<p><a href="index.php?action=accueil">Retour à l'accueil</p>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>