<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/* us: {$post.is_draft|istrue:'draft':'published'}
* origen : http://www.ninjacipher.com/2007/11/24/smarty-ternary-modifier/
*/

function smarty_modifier_istrue($value,$option1,$option2='')
{
	if ($option1=='_self_') $option1=$value;
    return ($value && $value!='')?$option1:$option2;
}


?>
