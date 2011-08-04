<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/* us: {class="$seccio|csstate:'inici'"}
* origen : http://www.ninjacipher.com/2007/11/24/smarty-ternary-modifier/
*/

function smarty_modifier_csson($value,$value2)
{
	return ($value==$value2)?'actiu':'inactiu';
}

?>
