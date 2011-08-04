<?
/*
Smarty traduccions
ús:
{trad text=#constant# var1='3' var2='Angelus'}
{trad text='Em dic %s i tinc %n gallines' s='Carles' n=33} 
*/

function smarty_function_trad($params, &$smarty)
{
	$trad_pars=array();
	foreach($params as $key => $value)
	{
        switch ($key){
			case 'text':
				$string=$value;
				break;
			default:
				$trad_pars["%$key"] = $value;
		}
	}
	print(strtr($string, $trad_pars));
}

?>