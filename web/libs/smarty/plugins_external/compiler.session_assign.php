<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {session_assign} compiler function plugin

 */

/* Carles edit 16/12/2008:
	assigna el valor a una variable de session
*/
 
function smarty_compiler_session_assign($tag_attrs, &$compiler)
{
    $_params = $compiler->_parse_attrs($tag_attrs);

    if (!isset($_params['var'])) {
        $compiler->_syntax_error("assign: missing 'var' parameter", E_USER_WARNING);
        return;
    }

    if (!isset($_params['value'])) {
        $compiler->_syntax_error("assign: missing 'value' parameter", E_USER_WARNING);
        return;
    }


    return "\$_SESSION[{$_params['var']}]={$_params['value']};";
}

/* vim: set expandtab: */

?>
