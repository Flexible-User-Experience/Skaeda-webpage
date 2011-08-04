<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Include the {@link shared.make_timestamp.php} plugin
 */
require_once $smarty->_get_plugin_filepath('shared', 'make_timestamp');
/**
 * Smarty sec2hms modifier plugin
 *
 * Type:     modifier<br>
 * Name:     sec2hms
 * Purpose:  converteix segons en h:m:s
 * Input:<br>
 *         - sec: segons
 *         - showseconds: mostrar els segons
 *         - padHours: mostrar 0 al davant de les hores<10
 */
function smarty_modifier_sec2hms($sec, $showseconds=false,$padHours=false)
{
    $hours = intval(intval($sec) / 3600);
    $minutes = intval(($sec / 60) % 60);
    $seconds = intval($sec % 60); 
	
	
    $hms = ($padHours?str_pad($hours, 2, "0", STR_PAD_LEFT):$hours). ':'.
			str_pad($minutes, 2, "0", STR_PAD_LEFT). 
			($seconds?(':'.str_pad($showseconds, 2, "0", STR_PAD_LEFT)):'');

    return $hms;
}

/* vim: set expandtab: */

?>
