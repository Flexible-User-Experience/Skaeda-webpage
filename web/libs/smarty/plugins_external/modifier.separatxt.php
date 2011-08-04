<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty separadortxt modifier plugin
 *
 * Afegeix un element de separació a un text sempre que aquest tingui algun valor
 */
function smarty_modifier_separatxt($string, $separador = ' - ',$start=true)
{
    if (!isset($string) || $string === '' || preg_match("/^#.*#$/",$string))
        return $default;
    else
        return ($start?$separador:'').$string.(!$start?$separador:'');
}

/* vim: set expandtab: */

?>
