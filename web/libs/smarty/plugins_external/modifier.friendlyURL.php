<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty friendly url plugin
 *
 * Type:     modifier<br>
 * Name:     friendlyURL<br>
 * Date:     Jun 23, 2008
 * Purpose:  friendly url for SEO
 * Input:    string to make friendly
 * Example:  {$var|friendlyURL}
 * @author   Asvin Balloo
 * @version 1.0
 * @param string
 * @return string
 */
function smarty_modifier_friendlyURL($string){
	$string = preg_replace("`\[.*\]`U","",$string);
	$string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$string);
	$string = preg_replace( '`"`i', "", $string);
	$string = htmlentities($string, ENT_COMPAT, 'utf-8');
	$string = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i","\\1", $string );
	$string = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $string);
	return strtolower(trim($string, '-'));
}

/* vim: set expandtab: */

?>
