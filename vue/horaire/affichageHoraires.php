<?php ob_start() ?>
<article>
<?php 
require_once CHEMIN_LIB.'fonction.php';
echo traitementAccent($horaireTexte);
?>
</article>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
