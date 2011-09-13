<?php

//urls, roots, etc....
require_once('file_system.php');

//corregir magic quotes si no s'ha fet des d'htaccess
if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc() === 1){
  $_POST = array_map( 'stripslashes', $_POST );
  $_GET = array_map( 'stripslashes', $_GET );
  $_COOKIE = array_map( 'stripslashes', $_COOKIE );
}





/*
 * --- NOVA FORMA DE CONFIGURACI� ---
 * Es poden fer servir distints par�metres de configuraci� segons
 * la m�quina on s'executi l'aplicaci�.
 * Si es troba un fitxer de configuraci� que davant porta el nom
 * del host on s'executa, es carregar� en comptes dels par�mentres
 * d'aquest fitxer.
 * El fitxer de configuraci� espec�fic de host �s de la forma
 * <hostname>.<nomdelfitxerdeconfig>
 * 
 * Si troba el fitxer, l'inclou per agafar-ne les configuracions.
 * En principi all� no hi ha d'haver m�s codi.
 * Si no el troba, es configura desde aquest mateix fitxer (al else).
 * 
 * Un cop agafats els par�metres de configuraci� es continua amb la
 * inicialitzaci� que ja ser� com� a tots els entorns. �s aqu� on
 * es connecta a la DB i dem�s.
 */


/*
 * OJO: Per esbrinar el nom de host, uso php_uname (PHP >4.3)
 * en comptes de gethostname (PHP >5.3)
 */
$cf_dirname = dirname(__FILE__) . '/';
$cf_hostname = php_uname('n');
$cf_basename = basename(__FILE__);

$config_file = $cf_dirname . $cf_hostname . '.' . $cf_basename;	//nom complet
if (!file_exists($config_file)) {
	//Curem-nos en salut en els entorns *nix...
	$cf_hostname = strtolower($cf_hostname);
	$config_file = $cf_dirname . $cf_hostname . '.' . $cf_basename;	//nom complet
}

if (file_exists($config_file))
{

	//Si hi ha configuraci� espec�fica de host, la carreguem
	require_once($config_file);

} else {

	/*------------------------------------------------------------------
	 * Aqu� va la configuraci� per defecte (normalment producci�)
	 *------------------------------------------------------------------
	 */
	 
	$conbd_servidor = "localhost";
	$conbd_basededades = "skaedaweb";
	$conbd_usuari = "userskaedaweb";
	$conbd_clau = "4ndr01d3";
	$URL_MARE="http://www.skaeda.com/";
	
	//------------------------------------------------------------------
}


/*
 ***********************************************************************
 *A partir d'aqu� el codi d'inicialitzaci� com� a totes les configs...
 ***********************************************************************
 */

$web = mysql_connect($conbd_servidor, $conbd_usuari, $conbd_clau) or trigger_error(mysql_error(),'No ha estat possible conectar amb la base de dades.'); 
mysql_select_db($conbd_basededades);
mysql_query ("SET NAMES 'utf8'");

/******IDIOMA BASE ************/
$idiomabase='en';
$idioma_cookie=$_COOKIE['idioma'];


/****MAGICS*****/
define('AUTO_ORDER', true);
define('NO_PUBLICAT',2);
