<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/* us: {$post.is_draft|istrue:'draft':'published'}
* origen : http://www.ninjacipher.com/2007/11/24/smarty-ternary-modifier/
*/

function smarty_modifier_choice()
{
	$args=func_get_args();
	$patro=$args[0];
	for ($i=1;$i<sizeof($args)-1; $i+=2)
	{
		if ($patro==$args[$i] || (string)$args[$i]=='_else_') {return $args[$i+1];}
    }
}


?>
