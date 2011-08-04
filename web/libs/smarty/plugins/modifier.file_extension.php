<?php
/*
* Smarty plugin
* -------------------------------------------------------------
* Type:    modifier
* Name:    file_extension
* Version:    0.1
* Date:    23-01-2009
* Author:    Carles J. Grau
* Purpose: extreu la extensió d'un nom de fitxer i la mostra
* Us:    In the template, use
            {$filename|file_extension}    =>    jpg
            or
            {$filename|file_extension:"uppercase"}    =>    JPG
* Params:    
            string    format        the format, the output shall be: uppercase

* Install: Drop into the plugin directory
* -------------------------------------------------------------
*/
function smarty_modifier_file_extension($file,$strcase="")
{
	$bits = explode('.',$file);
	$ext = $bits?array_pop($bits):''; 
	switch ($strcase) {
		case "uppercase":
			$ext=strtoupper($ext);
			break;
	}
	return $ext;
} //~ end function
?>
