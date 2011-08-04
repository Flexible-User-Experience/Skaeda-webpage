<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {assign} compiler function plugin
 *
 * Type:     compiler function<br>
 * Name:     assign<br>
 * Purpose:  assign a value to a template variable
 * @link http://smarty.php.net/manual/en/language.custom.functions.php#LANGUAGE.FUNCTION.ASSIGN {assign}
 *       (Smarty online manual)
 * @author Monte Ohrt <monte at ohrt dot com> (initial author)
 * @author messju mohr <messju at lammfellpuschen dot de> (conversion to compiler function)
 * @param string containing var-attribute and value-attribute
 * @param Smarty_Compiler
 */

/* Carles edit 16/12/2008:
	també assigna el valor a la variable last_var
*/
 
function smarty_compiler_xassign($tag_attrs, &$compiler)
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


    return "\$this->assign(array({$_params['var']}=>{$_params['value']},'last_var'=>{$_params['value']}));";
}

/* vim: set expandtab: */

?>
