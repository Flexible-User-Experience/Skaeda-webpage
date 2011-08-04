<?php

function smarty_function_youtube_embed($params, &$smarty)
{
    require_once $smarty->_get_plugin_filepath('shared','escape_special_chars');

	//mida per defecte
    $width = 480;
    $height = 385;

	$url_params='';
	
    foreach($params as $_key => $_val)
	{
        switch($_key) {

			case 'url':
				$url_parsed = parse_url($_val);
				parse_str($url_parsed['query'],$linkparams);
				$url_id=$linkparams['v'];
                break;
				
			case 'width':
			case 'height':
				$$_key = smarty_function_escape_special_chars($_val);
				break;

			case 'color1':
			case 'color2':
				$_val=str_replace('#','0x',$_val);
				
            default:
				
				$url_params.=($url_params!=''?'&amp;':'').$_key.'='.smarty_function_escape_special_chars($_val);
                //$$_key = smarty_function_escape_special_chars($_val);
                break;
        }
    }
	
	$url='http://www.youtube.com/v/'.$url_id.($url_params!=''?'?':'').$url_params;
	$objecte='
	<object width="%1$s" height="%2$s">
	  <param name="movie"
			 value="%3$s"></param>
	  <param name="allowScriptAccess" value="always"></param>
	  <embed src="%3$s"
			 type="application/x-shockwave-flash"
			 allowscriptaccess="always"
			 width="%1$s" height="%2$s"></embed>
	</object>';

    return sprintf($objecte,$width,$height,$url);//_id,$autoplay,$idioma,$fs,str_replace('#','0x',$color1),str_replace('#','0x',$color2)); 
}

/* vim: set expandtab: */

?>
