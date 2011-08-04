<?

//{tager tag=$var|choice:'actiu':'strong':'_else_':'' class='actiu'}soc un text{/tager}

function smarty_block_tagger($params, $string, &$smarty, &$repeat)
{
	if ($params['tag']!='' && !$repeat)
	{
		$string='<'.$params['tag'].
		($params['class']?" class='{$params['class']}'":"").
		(($params['href'] && $params['tag']=='a')?" href='{$params['href']}'":"").
		'>'.$string.'</'.$params['tag'].'>';
	}
	echo $string;
}



?>