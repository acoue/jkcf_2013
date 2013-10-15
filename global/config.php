<?php
// Identifiants pour la base de données. Nécessaires a PDO2.
define('SQL_DSN', 'mysql:dbname=jkcf_2013;host=localhost');
define('SQL_USERNAME', 'root');
define('SQL_PASSWORD', '');
 
// Chemins à utiliser pour accéder aux modeles/vues/controleur/librairies/...
define('CHEMIN_VUE','vue/');
define('CHEMIN_MODELE','modele/');
define('CHEMIN_CONTROLEUR','controleur/');
define('CHEMIN_LIB','libs/');
define('CHEMIN_LOG','log/');
define('CHEMIN_DOC','document/');
define('CHEMIN_PHOTO','photo/');
define('CHEMIN_IMG_DISC','images/discipline/');
define('CHEMIN_IMG_ART','images/article/');
define('CHEMIN_RESSOC','images/ressoc/');
define('CHEMIN','http://localhost/jkcf_2013/');

// Clé pour le cryptage des données et mot de passe
define('CLE_CRYPT', 'Jx4TS4b3b4qJ');

?>