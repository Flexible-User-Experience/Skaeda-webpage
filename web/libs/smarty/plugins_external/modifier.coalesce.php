<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/* us: {$post.is_draft|istrue:'draft':'published'}
* origen : http://www.ninjacipher.com/2007/11/24/smarty-ternary-modifier/
*/

function smarty_modifier_coalesce()
{
	$args=func_get_args();
    foreach ($args as $arg) {
        if (!empty($arg) | is_numeric($arg)) {
            return $arg;
        }
    }
    return $args[0];
}


?>
