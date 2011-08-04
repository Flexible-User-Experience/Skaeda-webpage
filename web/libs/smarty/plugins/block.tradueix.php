<?

function smarty_block_tradueix($params, $string, &$smarty)
{
	foreach($params as $key => $value)
	{
		$params["%$key"] = $value;
		unset($params[$key]);
	}
	print(t($string, $params));
}

function t($string, $args = array()) {
return strtr($string, $args);
}

//registra amb smarty
//$smarty->register_block("tradueix", "smarty_t", false);
//$smarty->register_block("trans", "smarty_block_tradueix", false); 

?>