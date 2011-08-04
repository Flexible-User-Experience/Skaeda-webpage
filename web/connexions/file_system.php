<?php

/*****RUTES*******/
//ruta absoluta;
$abs_path=str_replace('\\', '/', dirname(__FILE__));
define('ABS_PATH', substr($abs_path,0,strrpos($abs_path,'/')+1));

$GV=$_GET;
$PV=$_POST;
$RV=$_REQUEST;

$ruta_script=dirname($_SERVER['PHP_SELF']);

$URL_NAME=explode('?',$_SERVER['REQUEST_URI']);
$_WR = rtrim($ruta_script, '/\\').'/';

$HTTP_HOST = $_SERVER['HTTP_HOST'];
$HTTP_ROOT = 'http'.($_SERVER["HTTPS"]=='on'?'s':'').'://'.$HTTP_HOST.'/'.trim($ruta_script, '/\\');
$ROOT = $HTTP_ROOT;	//backwards comp
$HTTP_ROOT = trim($HTTP_ROOT, '/\\');
$HTML_ROOT = rtrim($ruta_script, '/\\').'/';

$referer = $_SERVER['HTTP_REFERER'];

$FTX_DIRS=array('img'=>'public/img/','docs'=>'public/docs/','doc'=>'public/docs/');


?>
