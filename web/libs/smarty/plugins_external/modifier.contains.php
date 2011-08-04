<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/* us: {$post.is_draft|istrue:'draft':'published'}
* origen : http://www.ninjacipher.com/2007/11/24/smarty-ternary-modifier/
*/

function smarty_modifier_contains($lookin,$lookfor)
{
	if (!is_array($lookfor)) {$lookfor=array($lookfor);}
	foreach ($lookfor as $terme)
	{
		$pos=is_array($lookin)?array_search($terme,$lookin):strpos($lookin,$terme);
		if ($pos!==false) return true;
	}
	return false;
}


?>
