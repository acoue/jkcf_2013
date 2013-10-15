<?php ob_start() ?>

<h2>Confirmation de d&eacute;connexion</h2>
<p>Vous &ecirc;tes maintenant d&eacute;connect&eacute;.<br />
<a href="index.php">Revenir &agrave; l'accueil</a></p>

<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
