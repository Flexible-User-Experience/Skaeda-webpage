<?

/*diccionari comprimit, consisteix en
$babelia['identificador_pagina']=>(
	'idioma'=>('es'=>'traduccio','ca'=>'traduccio'),
	'config'=>('parent'=>'...','id'=>'...')
	)
	
amb el foreach es processa i es descomprimeix en els dos arrays que s'utilitzaran, 
$traductor = 'traduccio'=>'identificador_pagina','es'
$transpag = 'es'=>('identificador_pagina'=>'traduccio')
$tfamilia = 'pare_del_identificador_pagina'=>'identificador_pagina'
*/

$transpag=array();
$traductor=array();
$tfamilia=array();
$babelia=array();
$controllers=array(); //controlador => pagina d'inici

$test=QueryIntoArray("SELECT * FROM v_pags WHERE 1".
	(defined('CGA_SECCIO')?(" AND controllers_folder='".CGA_SECCIO."'"):"").
	(isset($FORCE_LANG)?" AND pags_at_idioma='{$FORCE_LANG}'":"")
	);

//processo l'array. Nota: les arrels (/) son convertides a ""
foreach ($test as $test2)
{
	$babelia[$test2['pags_codi']]['idioma'][$test2['pags_at_idioma']]=array('codi'=>str_replace('/','',$test2['pags_at_codi']),'text'=>$test2['pags_at_text'],'titol'=>$test2['pags_at_titol']);
	$babelia[$test2['pags_codi']]['config']=array('parent'=>$test2['pags_parent'],'id'=>$test2['pags_id'],'controller'=>$test2['controllers_nom']);
	if ($test2['pags_start']) {$controllers[$test2['controllers_nom']]=$test2['pags_codi'];}
}

foreach ($babelia as $codi=>$traduccio)
{
	if ($traduccio['config']['parent']!='' && $traduccio['config']['parent']!=$codi) //si l'element te parent, crear l'array de la familia. Prevenir que algú sigui el seu propi parent
	{
		$tfamilia[$traduccio['config']['parent']][]=$codi; 
	}
	foreach ($traduccio['idioma'] as $t_idioma=>$t_text) //creo els pars de traducció
	{
		$transpag[$t_idioma][$codi]=$t_text['codi'];
		if (!$traductor[$t_text['codi']]) //comprovo que no existeixi ja (pels submenus)
		{
			$traductor[$t_text['codi']]=array('id'=>$codi,'idioma'=>$t_idioma);
		}
	}
}
?>