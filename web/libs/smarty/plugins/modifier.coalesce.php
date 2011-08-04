<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/* us: {$post.is_draft|istrue:'draft':'published'}
* origen : http://www.ninjacipher.com/2007/11/24/smarty-ternary-modifier/
*/

function smarty_modifier_coalesce($value,$option1)
{
    return ($value!='')?$value:$option1;
}


?>
