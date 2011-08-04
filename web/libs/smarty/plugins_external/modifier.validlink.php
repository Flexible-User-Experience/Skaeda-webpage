<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty lower modifier plugin
 *
 * Type:     modifier<br>
 * Name:     lower<br>
 * Purpose:  convert string to lowercase
 * @link http://smarty.php.net/manual/en/language.modifier.lower.php
 *          lower (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @return string
 */
 
 
 function smarty_modifier_validlink($link) {
    // Clean up URL and ensure that it includes http://
	$link=str_replace('&','&amp;',$link);
	$link=str_replace(' ','+',$link);
    if(preg_match("/((https?|ftp)\:\/\/)|((skype|spotify|mailto)\:)/", $link) || strrpos($link,'.')===false) {
        return $link;
    } else {
        $link = preg_replace("|^(http){1}[\\\/:]*|", "", $link);
        $link = preg_replace("|[/]{2,}|","/",$link);
        //$link = preg_replace("|[^a-z0-9./]|","",$link);
        $link = preg_replace("|^/|", "", $link);
        return "http://".$link;
    }
}

?>
