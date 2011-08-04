<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     prefilter.reconfigvars.php
 * Type:     prefilter
 * Name:     reconfigvars
 * Purpose:  Permet que les variables de configuració tinguin una sintaxi diferent i les recodifica despres
 * -------------------------------------------------------------
 */
 function smarty_prefilter_reconfigvars($tpl_source, &$smarty)
 {
	$tpl_source=str_replace(array('[***','***]'),array('{#','#}'),$tpl_source);
	return $tpl_source;
 }
?> 