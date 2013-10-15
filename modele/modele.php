<?php
require CHEMIN_LIB.'securite.php';
require CHEMIN_LIB.'logging.php';

//-------------------------------------
//--- GLOBALES
//-------------------------------------

// Effectue la connexion a la BDD : instancie et renvoie l'objet PDO associe
function getBDD() {	
	$bdd = new PDO(SQL_DSN,SQL_USERNAME, SQL_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $bdd;
}


// Affiche une erreur
function afficherErreur($msgErreur) {
	$logger = new Logger(CHEMIN_LOG);
    $logger->log('Erreur', 'err_php', "Erreur : ".$msgErreur, Logger::GRAN_MONTH);
    require CHEMIN_VUE.'erreur.php';
}

// Ecrire une information en log
function loggerInformation($msgInfo) {
	$logger = new Logger('./log');
    $logger->log('Information', 'infos', $msgInfo, Logger::GRAN_MONTH);
}

// Vérifie si l'utilisateur est connecté  
function utilisateurConnected() { 
	return getEtatUtilisateur($_SESSION['id']);
}