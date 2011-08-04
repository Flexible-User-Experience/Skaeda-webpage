<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty cat modifier plugin
 *
 * Type:     modifier
 * Name:     cat_ws
 * Date:     Feb 24, 2003
 * Purpose:  concatenar diversos valors obviant aquells que siguin buits
 * Input:    string to catenate
 * Example:  {$var|cat_ws:', ':'un':'dos'}
 * @link http://smarty.php.net/manual/en/language.modifier.cat.php cat
 *          (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @version 1.0
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_cat_ws()
{
	$args=func_get_args();
	$tmp_array=array();
	
	$glue=$args[1];
	array_splice($args,1,1);		
	foreach ($args as $arg)
	{
		if (!empty($arg)) {$tmp_array[]=$arg;}
	}

    return implode($glue,$tmp_array);
}

/* vim: set expandtab: */

?>
