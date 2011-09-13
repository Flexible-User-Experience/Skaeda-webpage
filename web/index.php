<?php
getenv('HTTP_HOST'); 

define ('CGA_SECCIO','public');	//defineixo en quin directori soc
define ('CGA_DEF_CONTROLLER','public');	//defineixo en quin directori soc


$url=explode("/",$_GET['seccio']?$_GET['seccio']:'');

//ATENCIÓ revisar poma enverinada
if ($url[0]=='thumb')
{
	require_once 'connexions/file_system.php';
	$_GET=array();
	$_GET['src']=$url[1];
	include('libs/phpthumb/thumb.php');
	die();
}



//força llenguatje segons variable get
if (isset($_GET['___lang_show'])) {$FORCE_LANG=$_GET['___lang_show'];}

//OPERACIONS COMUNS PER A TOTES LES VISTES I CONTROLADORS
include 'Int_start.php';
include ABS_PATH.'inclou/translator.php';
include ABS_PATH.'inclou/queries.php';

//determinar la pàgina actual segons l'url i el GET que ens passa htaccess

$url=c_request("0=>CHAR",$url,true);
$pag_actual=$url[0];

//generics infopag
$infopag_ini = array(
				'nom'=>implode($url,'/'),
				'_wr'=>$HTML_ROOT,
				'root'=>$HTTP_ROOT,
				'host'=>$HTTP_HOST,
				'_uwr'=>$HTML_UROOT);

//variables més comuns que ens passen per GET
$GV=c_request("camp|ordre=>CHAR,id|pag=>INT",$GV);
$camp=$GV['camp'];
if (isset($GV['ordre'])) {$ordre=strtolower($GV['ordre'])=='desc'?'desc':'asc';}	//patillero, per evitar errors de gen que posi coses rares
$id=$GV['id'];
$pag=$GV['pag'];
//variables comuns que és passen per POST
//$subseccio_act=$pag_actual!=''?$traductor[$pag_actual]['id']:$controllers[$_SESSION['controller']];	//si no especifica pàgina anar a l'inici del controller
$subseccio_act=$traductor[$pag_actual]['id'];
//if ($subseccio_act=='') {$subseccio_act=$controllers[$_SESSION['controller']];}

$controller_act=coalesce($babelia[$subseccio_act]['config']['controller'],CGA_DEF_CONTROLLER); 
//$_SESSION['controller']=$controller_act;	//posar el controller a la sessió

$idiomes= QueryIntoOption($_query['idiomes']);
$idiomabase=key($idiomes);
$idioma_navegador=get_client_language($idiomes,$idiomabase);

//$idiomabase=key($idiomes); //l'idioma base serà el primer que hi hagi




if (!$controller_act && $subseccio_act=='') {$error404=true;}	//echo "kput";die();

else { //guais, de moment no hi ha error


	$seccio_act=$babelia[$subseccio_act]['config']['parent']!=''?$babelia[$subseccio_act]['config']['parent']:$subseccio_act;	//mirar si te submenus
	if (!$seccio_act) $error404=true;

	if (!$plantilla_actual)	//podem definir plantilla actual dins de controllers, per casos com l'rss
	{
		$plantilla_actual="basepage_".$controller_act.".html";	//la plantilla per defecte de cada controller és basepage_nomcontroller.html
	}
	
	//decidir l'idioma. 1-segons la pagina, 2-segons session
	$idioma=coalesce($traductor[$pag_actual]['idioma'],$_SESSION['idioma'],$idioma_cookie,$idioma_navegador,$idiomabase);

	//recopilo info bàsica de la pàgina
	$infopag=array("idioma"=>$idioma,
				"seccio"=>$seccio_act,
				"subseccio"=>$subseccio_act,
				"id_subseccio"=>$babelia[$subseccio_act]['config']['id']);

	//INICIAR CONTROLADOR DE TOTES LES PÀGINES
	$_SESSION['idioma']=$idioma;
	include 'controllers_'.$controller_act.'.php';
	$_SESSION['idioma']=$idioma;


	//comproba si hi ha submenu (te fills, vaja)
	if ($subseccio_act!=$seccio_act)
	{
		foreach ($tfamilia[$seccio_act] as $tfamilia_pag)
		{
			$arrtmp=$babelia[$tfamilia_pag]['idioma'][$idioma];
			$submenu[]=array(nom=>$arrtmp['text'],opt=>$arrtmp['codi']==$pag_actual,url=>$arrtmp['codi']);
		}
	}

	//marco tots els elements de l'arbre de menu actius	
	$parent=$subseccio_act;
	while ($parent!='')
	{
		$infopag['tree'][$parent]=true;
		$parent=$babelia[$parent]['config']['parent'];
	}

}


if ($error404){ //ha petat alguna cosa, mostra error
	header("HTTP/1.0 404 Not Found");
	$plantilla_actual="basepage_".($controller_act?$controller_act:CGA_DEF_CONTROLLER).".html"; //	aixo portaria a la pàgina de login si no hi ha controller
	$seccio='error404';
	$infopag= array(
				'idioma'=>coalesce($idioma,$idioma_navegador,$idiomabase),
				'subseccio'=>$seccio);
	$smarty->assign(array(
		'seccio'=>$seccio,
		"menu_$seccio"=>'actiu',
		'conts'=>"$seccio.html"
	));
}

//generics infopag
$infopag = array_merge($infopag,$infopag_ini);
				


//assigna variables genèriques a smarty
$smarty->assign(array(
'idiomes'=>$idiomes,
'submenu'=>$submenu,
'menu'=>$menu,
	'colsel'=>array(($camp!=''?$camp:$default_ordre)=>array('ord_act'=>$ordre,'ord_nou'=>($ordre=='asc'?'desc':'asc'))),
	'infopag'=>$infopag,
	'transpag'=>$transpag,
	'id'=>$id,
	'error'=>$error,
	'carpeta'=>$FTX_DIRS
	)
);

$smarty->display($plantilla_actual);
//echo memory_get_peak_usage();

?>
