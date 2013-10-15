<?php ob_start() ?>

<br /><br /><h2><span style="color: #c03000;">Les photos du J.K.C.F.</span></h2>
<?php 
	require_once CHEMIN_LIB.'fonction.php';
    // Ouvre un dossier bien connu, et liste tous les fichiers
    $directory = CHEMIN_PHOTO;
    if (is_dir($directory)) {
      if ($dh = opendir($directory)) {
      	//echo "<table width='100%' cellpadding='1px' cellspacing='1px' align='center' border='1'>";
        while (($file = readdir($dh)) !== false) {
          if($file!='..' && $file!='.') { //N'affiche pas le . et ..
			
          	echo '<br /><p><a href="index.php?action=afficherDetailPhoto&rep='.traitementAccent($file).'">
          	<img class="imgJKCF" src="'.CHEMIN_PHOTO.$file."/".getFirstElementInRep(traitementAccent(CHEMIN_PHOTO.$file)).'" width="125px" alt="'.traitementAccent($file).'"/></a>';
          	
          	echo "&nbsp;&nbsp;&nbsp;<a class='lienNoir' href='index.php?action=afficherDetailPhoto&rep=".traitementAccent($file)."' >".traitementAccent($file)."</a></p><br />";
			
			
          }
        }
        closedir($dh); //Il est vivement conseillé de fermer le repertoire pour toute autre opération sur le systeme de fichier.
        echo "</table>";
      }
    }
?>

<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>