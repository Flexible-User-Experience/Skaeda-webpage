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
 * --- NOVA FORMA DE CONFIGURACIÓ ---
 * Es poden fer servir distints paràmetres de configuració segons
 * la màquina on s'executi l'aplicació.
 * Si es troba un fitxer de configuració que davant porta el nom
 * del host on s'executa, es carregarà en comptes dels paràmentres
 * d'aquest fitxer.
 * El fitxer de configuració específic de host és de la forma
 * <hostname>.<nomdelfitxerdeconfig>
 * 
 * Si troba el fitxer, l'inclou per agafar-ne les configuracions.
 * En principi allà no hi ha d'haver més codi.
 * Si no el troba, es configura desde aquest mateix fitxer (al else).
 * 
 * Un cop agafats els paràmetres de configuració es continua amb la
 * inicialització que ja serà comú a tots els entorns. És aquí on
 * es connecta a la DB i demés.
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

	//Si hi ha configuració específica de host, la carreguem
	require_once($config_file);

} else {

	/*------------------------------------------------------------------
	 * Aquí va la configuració per defecte (normalment producció)
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
 *A partir d'aquí el codi d'inicialització comú a totes les configs...
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
