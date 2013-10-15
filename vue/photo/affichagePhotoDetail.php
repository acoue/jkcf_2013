<?php ob_start() ?>

<article>
<?php 

require_once CHEMIN_LIB.'fonction.php';
if (isset($_GET['rep'])) {
	$repertoire = $_GET['rep'];

	echo "<p align='center'><h2><span style='color: #c03000;'>".$repertoire."</span></h2></p>";
	echo "<table width='100%' cellpadding='1px' cellspacing='1px' align='center'><tr>";
	if (is_dir(CHEMIN_PHOTO.$repertoire)) {
		if ($dh = opendir(CHEMIN_PHOTO.$repertoire)) {
			$key=0;
			while (($file = readdir($dh)) !== false) {
				if($file!='..' && $file!='.') { //N'affiche pas le . et ..
					if ($key % 4 ==0 && $key!=0){
						echo "</tr><tr>";
						$key=0;
					}
					echo '<td align="center"><a href="'.traitementAccent(CHEMIN_PHOTO.$repertoire).'/'.traitementAccent($file).'" data-lightbox="roadtrip">
								<img class="imgJKCF" src="'.traitementAccent(CHEMIN_PHOTO.$repertoire).'/'.$file.'" width="125px" alt="'.traitementAccent($file).'"/></a></td>';
					$key += 1;
				}
			}
			closedir($dh); //Il est vivement conseillé de fermer le repertoire pour toute autre opération sur le systeme de fichier.
		}
	}
	echo "</tr></table>";
} else echo "PB";
?>
<p align='center' ><input type='button' name='retour' value='Retour' onclick='window.location.replace("index.php?action=afficherPhoto")' /></p>
</article>
<?php $contenu = ob_get_clean() ?>
<?php include CHEMIN_VUE.'gabarit.php' ?>
