<?php
session_name("cga");
session_start();
session_cache_expire(30);

require_once 'connexions/web.php';
require_once ABS_PATH.'inclou/safe_functions.php';
require_once ABS_PATH.'inclou/site_functions.php';

$error=FALSE; //si es un array ja serà TRUE

$HTML_UROOT = folder_up($HTML_ROOT);//"/".$tmp[$levels>1?$levels-2:0];
$HTTP_UROOT= folder_up($HTTP_ROOT,1,false);

//echo "ROOT= $ROOT <br> _UROOT= $_UROOT <br> _WR= $_WR <br> _UWR= $_UWR <br> ABS_PATH= $ABS_PATH";



$idioma=coalesce($_GET['idioma'],$_SESSION['idioma']); //<---------------- TEMPORAL
$_SESSION['idioma']=$idioma;
//if (!$idioma) $idioma='ca';
$dades=array();


/*definir directoris locals*/


setlocale(LC_ALL,'es_ES.ISO8859-1','spanish','esp','sp','es_ES','es','es_ES@euro');//per mostrar les dates en spanish

//smarty
require ABS_PATH.'/libs/smarty/Smarty.class.php';
$smarty = new Smarty;
$smarty->caching = false;
$smarty->debugging = false;
$smarty->assign(array('diccionari'=>$idioma.'.conf',
		'URL_NAME'=>$URL_NAME[0]));

		
//constants email

define('EMAIL_CONNEX','xxxx');
define('EMAIL_USERNAME','xxxx');
define('EMAIL_PASSWORD','xxxxxx');
define('EMAIL_ORIGEN','xxxxxxx');
define('EMAIL_SENDER','Xxxxx');
?>
