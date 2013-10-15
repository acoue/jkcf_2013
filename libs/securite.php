<?php
/**
 * Classe de function pour gérer la sécurité : 
 *  - cryptage de données (BLOWFISH) + MDP (Hash MD5)
 *  - Methode pour éviter l'injection SQL
 *  - Methode pour éviter le XSS 
 * Auteur: Anthony COUE
 * Date : 19/06/2012
**/
class Securite {
	
	/* Constructeur : héritage public obligatoire par héritage de PDO */
    public function __construct( ) {
     
    }
    
	public static function crypteData($donnee) {
	    if(empty($donnee)) return false;
	    else return trim(base64_encode(mcrypt_encrypt(MCRYPT_BLOWFISH, CLE_CRYPT, $donnee, MCRYPT_MODE_CBC)));    
	}
	
	public static function decrypteData($donnee) {	   
	    if(empty($donnee)) return false;
	    else return trim(mcrypt_decrypt(MCRYPT_BLOWFISH, CLE_CRYPT, base64_decode($donnee), MCRYPT_MODE_CBC));
	}

	public static function password_decode($str) {
	   $filter = CLE_CRYPT;
	   $filter = md5($filter);
	   $letter = -1;
	   $newstr = '';
	   $str = base64_decode($str);
	   $strlen = strlen($str);
	
	   for ( $i = 0; $i < $strlen; $i++ ) {
	      $letter++;
	      if ( $letter > 31 ) {
	         $letter = 0;
	      }
	      $neword = ord($str{$i}) - ord($filter{$letter});
	      if ( $neword < 1 ) {
	         $neword += 256;
	      }
	      $newstr .= chr($neword);
	   }
	   return $newstr;
	}
	
	public static function password_encode($str) {
	   $filter = CLE_CRYPT;
	   $filter = md5($filter);
	   $letter = -1;
	   $newpass = '';
	   $newstr = '';
	   $strlen = strlen($str);
	   for ( $i = 0; $i < $strlen; $i++ ) {
	      $letter++;
	      if ( $letter > 31 ) {
	         $letter = 0;
	      }
	      $neword = ord($str{$i}) + ord($filter{$letter});
	      if ( $neword > 255 ) {
	         $neword -= 256;
	      }
	      $newstr .= chr($neword);
	   }
	   return base64_encode($newstr);
	}
	
	
	public static function securiseSQL($string) {
		// On regarde si le type de string est un nombre entier (int)
		if(ctype_digit($string)) {
			$string = intval($string);
		} else { // Pour tous les autres types
			$string = mysql_real_escape_string($string);
			$string = addcslashes($string, '%_');
		}
		return $string;
	}
	
	// Données sortantes
	public static function securiseHtml($string) {
		return htmlentities($string);
	}
}