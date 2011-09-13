<?php
/**
Revisió 23/2/2011 
 * FUNCTIONS THAT DON'T SEND HEADERS 
**/

function check_email_address($email) 
{
	// First, we check that there's one @ symbol, and that the lengths are right
	if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email) || trim($email=='')) 
	{
		// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
		return false;
	}
	// Split it into sections to make life easier
	$email_array = explode("@", $email);
	$local_array = explode(".", $email_array[0]);
	for ($i = 0; $i < sizeof($local_array); $i++) 
	{
		if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) 
		{
			return false;
		}
	}
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) 
	{ // Check if domain is IP. If not, it should be valid domain name
		$domain_array = explode(".", $email_array[1]);
		if (sizeof($domain_array) < 2) 
		{
			return false; // Not enough parts to domain
		}
		for ($i = 0; $i < sizeof($domain_array); $i++) 
		{
			if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) 
			{
				return false;
			}
		}
	}
	return true;
}

//sprintfx: com l'sprintf, reemplaça expresions dins d'una cadena per valors, pero passats per un array
/*obsolet
function sprintfx($str, $vars, $char = '%')
{
    $tmp = array();
    foreach($vars as $k => $v)
    {
        $tmp[$char . $k . $char] = $v;
    }
//echo str_replace(array_keys($tmp), array_values($tmp), $str);
    return str_replace(array_keys($tmp), array_values($tmp), $str);
}*/


//sprintfx: com l'sprintf, reemplaça expresions dins d'una cadena per valors, pero passats per un array
function sprintfx($str, $vars, $char = '%', $defvalue='')
{

	//si $vars no es un array, probo de convertir-lo en un. Ull, per casos simples
	if (!is_array($vars))
	{
		$vars=params2array($vars,array(',','='));
	}
	$pregsep=($char=='|'?'/':'|');
	preg_match_all("{$pregsep}{$char}([^{$char}\s]+){$char}{$pregsep}", $str, $claus, PREG_PATTERN_ORDER);

    $tmp = array();
	
	foreach ($claus[1] as $clau)
	{
		$tmp[$char . $clau . $char] = isset($vars[$clau])?$vars[$clau]:$defvalue;
	}
    return str_replace(array_keys($tmp), array_values($tmp), $str);

}






function validLink($link) {
    // Clean up URL and ensure that it includes http://
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

function check_bool($cadena)
	{
		if (strtolower($cadena=='false')) $cadena=false;
		return (bool)$cadena;
	}
		

function netejaURL($string,$separador="-")
    {
        // Define the maximum number of characters allowed as part of the URL
    $currentMaximumURLLength = 245;
        


	$siaccents = " .·'ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
	$noaccents = "{$separador}_-_AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
    $string = utf8_decode($string);
    $string = strtr($string, utf8_decode($siaccents), $noaccents);
    $string = strtolower($string);

    // Any non valid characters will be treated as _, also remove duplicate _
        
    $string = preg_replace('/[^a-z0-9_]/i', '-', $string);
    $string = preg_replace('/[_]+/i', '_', $string);
    $string = preg_replace('/[-]+/i', '-', $string);
        
    // Cut at a specified length
        
    if (strlen($string) > $currentMaximumURLLength)
    {
        $string = substr($string, 0, $currentMaximumURLLength);
    }
        
    // Remove beggining and ending signs
        
    $string = preg_replace('/[_-]$/i', '', $string);
    $string = preg_replace('/^[_-]/i', '', $string);
        
    return $string;
}


//codifica una cadena o un array per usar en una url
function urlencode64($cadena,$zip=false)
{
	if (is_array($cadena)) {$cadena=serialize($cadena);}
	if ($zip) {$cadena=gzcompress($cadena);}
	$cadena=base64_encode($cadena);
	return strtr($cadena,'+/=','-_~');
}

function urldecode64($cadena,$zip=true)
{
	$cadena=strtr($cadena,'-_~','+/=');
	$cadena=base64_decode($cadena);
	
	if ($zip)	//per defecte provo de descomprimir, si es vol guardar processador, especificar zip=false
	{
		$data =@gzuncompress($cadena);
		if ($data !== false) {$cadena=$data; }
	}
	
	$data = @unserialize($cadena);
	if ($data !== false) {$cadena=$data; }

	return $cadena;
}


function folder_up($ruta,$num=1,$bfinal=true,$normalitza=true)
{
	$esurl=false;
	$ruta=rtrim($normalitza?str_replace('\\','/',$ruta):$ruta,'/');
	
	if(strrpos($ruta, "://"))	//compte, és una url
	{
		$esurl=true;
		$tmp_url=explode("://",$ruta);
		$ruta=$tmp_url[1];
	}

	$pos = strrpos($ruta, "/");
	if ($pos>0 || !$esurl)	//protegim la url
		{$ruta = substr($ruta,0,$pos);}

	return ($esurl?($tmp_url[0]."://"):"").$ruta.($bfinal?"/":"");
}

//comproba si una variable es buida o un multiarray es buit
function tempty($variable)
{

	if ($variable=='' ) return true;
	if (is_array($variable))
	{
		foreach ($variable as $subvar)
		{
			$result=tempty($subvar);
			if (!$result) break;
		}
		return $result;
	}
	else {return false;}
}


function borrafitxer($nom)
{
 @unlink($nom);
}

function chkfitxer($nom,$carpeta,$nomnou='') //COMPROBAR SI JA EXISTEIX EL FITXER I DONAR-LI UN NOM ADIENT
{
// $nom=utf8_decode($nom);
 //$nom = strtolower(netejaURL($nom));//preg_replace('/[\\\\@?^=%&:;\/~\+#\'\"\s]+/', "_", $nom));
 
 $bits = explode('.',$nom);
 $ext = $bits?array_pop($bits):'';
 $i = 0;
 if (!$nomnou)
 {
	$nom_tmp=netejaURL($bits?implode('.', $bits):$nom);
	do 
	{
		$nom = $nom_tmp.($i?'_'.$i:'').($bits?'.'.$ext:'');
		$i++;
	} while (file_exists($carpeta.$nom));
 }
 else {$nom="$nomnou.$ext";}
 return $nom;
 
}

function uploadfitxer($fitxer,$index,$dirdesti,$nomantic,$nomnou="")
{
 $fitxdesti=chkfitxer ($fitxer['name'][$index],$dirdesti,$nomnou);
 $upload=move_uploaded_file($fitxer['tmp_name'][$index], $dirdesti.$fitxdesti);
 if ($nomantic!='' && $nomantic!=$fitxdesti && $upload) borrafitxer($dirdesti.$nomantic);
 return $upload?utf8_encode($fitxdesti):FALSE;
}

function uploadimg($fitxer,$index,$dirdesti,$params,$out_format='jpeg',$nomantic='')
{
	if (!class_exists('phpthumb')) require_once('../libs/phpthumb/phpthumb.class.php');
	$phpThumb = new phpThumb();

	// set data source -- do this first, any settings must be made AFTER this call
	if (is_uploaded_file($fitxer['tmp_name'][$index]))
	{
		$filename = basename($fitxer['name'][$index]);
		$filename = substr($filename, 0,strrpos($filename,'.')); 
		$phpThumb->setSourceFilename($fitxer['tmp_name'][$index]);
		$phpThumb->setParameter('config_output_format', $out_format);
		$proc_filename=chkfitxer($filename.'.'.$phpThumb->config_output_format,$dirdesti);
		$output_filename = $dirdesti.$proc_filename;
	}
	else {return false;}
	
	foreach ($params as $key=>$valor)
	{
		$phpThumb->setParameter($key, $valor);
	}
	
	
	//$phpThumb->setParameter('h', $thumbnail_height);
	$phpThumb->setParameter('config_allow_src_above_docroot', true); 

	if ($phpThumb->GenerateThumbnail())
	{
		if ($phpThumb->RenderToFile($output_filename))
		{
			if ($nomantic!='' && $nomantic!=$fitxdesti) borrafitxer($dirdesti.$nomantic);
			return $proc_filename;
		}
	}

	return false; //per defecte, error
}



function borracarpeta($dirname)
{
	if (is_dir($dirname)) $dir_handle = opendir($dirname);
	if (!$dir_handle) return false;
	while($file = readdir($dir_handle))
	{
		if ($file != "." && $file != "..")
		{
			if (!is_dir($dirname."/".$file)) unlink($dirname."/".$file);
			else borracarpeta($dirname.'/'.$file);
		}
	}
	closedir($dir_handle);
	rmdir($dirname);
	return true;
}

//troba el primer valor no buit d'un array
function coalesce() {
    $args = func_get_args();
    foreach ($args as $arg) {
        if (!empty($arg)) {
            return $arg;
        }
    }
    return $args[0];
}

//converteix una cadena en números valids
function redigit($value,$args=false){
	if (!$args) {return str_replace(",",".",$value);}
	else
	{
		foreach ($args as $arg)
		{
			$value[$arg]=str_replace(",",".",$value[$arg]);
		}
	}
	return $value;
}

//implode multinivell recursiu
function implode_r($glue = ",", $array = null)
{
   $output = array();

   foreach( $array as $item )
       if ( is_array ($item) )
       {
           // This is value is an array, go and do it again!
           $output[] = implode_r ($glue, $item);
       }
       else
           $output[] = $item;

   return implode($glue, $output);
}

//equivalent a la funció indexof de javascript;
function indexof($paller,$agulla,$pos=0)
{
	$pos=strrpos($paller,$agulla,$pos);
	return $pos === false?-1:$pos;
}


function MQ($value){
    $magic_quotes_active = get_magic_quotes_gpc();
    $new_enough_php = function_exists("mysql_real_escape_string");
    // i.e PHP >= v4.3.0
    if($new_enough_php){
    //undo any magic quote effects so mysql_real_escape_string can do the work
    if($magic_quotes_active){
        $value = stripslashes($value);
    }
    $value = mysql_real_escape_string($value);
    }else{ // before PHP v4.3.0
        // if magic quotes aren't already on this add slashes manually
        if(!$magic_quotes_active){
            $value = addslashes($value);
        } //if magic quotes are avtive, then the slashes already exist
    }
    return $value;
} 


//monta part d'una query a partir d'un array quan els noms coincideixen
function ArrayIntoQuery($camps,$dades,$modificador='')
{
	$qstring='';
	$last_item = end($camps); 
	foreach ($camps as $camp)
	{
		$dada_final=$dades[$camp];//anirà be pels idiomes
		if (is_array($dada_final) && $modificador!='') {$dada_final=$dada_final[$modificador];}		
		$qstring.="$camp = '".MQ($dada_final)."'".($camp!=$last_item?", ":" ");
	}
	return $qstring;
}

//ArrayIntoQuery evolucionat - admet parametres
//monta part d'una query a partir d'un array quan els noms coincideixen
function bindQuery($dades,$orders)
{

	$qstring='';
	$orders=params2array($orders,array(',',':'));
	$last_item = count($orders);
	$counter=0;
	foreach ($orders as $camp=>$func)
	{
		$counter++;
		$noq=false;
		if ($func===true)	//cap funció a fer, agafa-ho de l'array
		{
			$dada_final=$dades[$camp];
		}
		else
		{
			switch ($func)
			{
				case 'real':	//convertir cadena a nombre real
					$dada_final=redigit($dades[$camp]);
					$dada_final=(float)$dada_final;
					$noq=true;					
					break;
				case 'dataasql':	//convertir data php a mysql
					$dada_final=dataasql($dades[$camp]);
					break;
				case 'sha1':	//codificar
					$dada_final=$dades[camp]!=''?sha1($dades[camp]):'';
					break;
				case 'ornull':	//si es buit convertir a null
					$dada_final=$dades[$camp];
					if ($dada_final=='')
					{
						$dada_final='NULL';
						$noq=true;
					}
					break;
				default:
					if ($func[0]=='=')	//expresió mysql
					{
						$dada_final=substr($func,1);
						$noq=true;
					}
					else {$dada_final=$func;}	// asignar valor directe
			
			}
		}
		if (!$noq) {$dada_final="'".MQ($dada_final)."'";}
		$qstring.="$camp = $dada_final".($counter!=$last_item?", ":" ");
	}
	return $qstring;
}


//retorna un array per una query
//ull, igonrarà els errors de camps invàlids
function QueryIntoArray($query,$mida="multi",$errorskip="1054")
{
	
	$newarray = array(); 
	$result= mysql_query($query);
	if (!$result && mysql_errno())
	{
		if (mysql_errno()==$errorskip) 
			{return $newarray;}			
		else
			{die(mysql_error());}
	}
	
	switch($mida)
	{
		case 'unic':
			$newarray=mysql_fetch_array($result, MYSQL_ASSOC);
			break;
		case 'single':
			$newarray=mysql_fetch_row($result);
			$newarray=$newarray[0];
			break;
		default:
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {array_push($newarray, $row);}  
			break;
	}

	return $newarray;
	
}
	


function QueryIntoOption($query,$tipus=false) //prepara una query per posar-lo a un option d'smarty. ha de ser nom i id
{
	settype($retval,"array");
	$result=QueryIntoArray($query);
	foreach ($result as $key)
	{
		switch ($tipus)
		{
			case 'simple_nom':
				$retval[]=$key['nom'];
				break;
			case 'simple_id':
				$retval[]=$key['id'];
				break;
			case 'multiarray':
				$retval[$key['id']][]=$key['nom'];
				break;
			default:
				$retval[$key['id']]=isset($key['nom'])?$key['nom']:1;
		}
	}
	return $retval;
}



function get_current_insert_id($table)
{
    $q = "SELECT LAST_INSERT_ID() FROM $table";
    return mysql_num_rows(mysql_query($q)) + 1;
}


//merge_requests: mescla els arrays de post, get i session en un sol array
//sobretot es fa servir dins d'altres funcions
function merge_request($origen)
{
	$origen_final=array();
	for ($i = 0; $i < strlen($origen); $i++)
	{
		switch ($origen[$i])
		{
			case "P":
				$temp=$_POST;
				break;
			case "G":
				$temp=$_GET;
				break;
			case "S":
				$temp=$_SESSION;
				break;			
		}
		$origen_final=array_merge($origen_final,$temp);
	}
	return $origen_final;
}

//clean request ... una mena de safe_extract
//$PV=c_request('id|sd|comorr=>INT,cadena=>string',$_POST)
//strict true substitueix els caracters lletjos per "_"
function c_request($varstipus,$origen,$strict=false)
{
	if (!is_array($origen))	{$origen=merge_request($origen);} 	//en comptes d'un array, passa PG o similar 

	$pattern=array('REAL'=>"/[^0-9\.-]/",'CHAR'=>"/[^A-Za-z0-9_\-\.]/",'STRING'=>"/\"|'/");
	$varstipus=explode(",",$varstipus);
	foreach ($varstipus as $vargrup)
	{
		$vargrup=explode("=>",$vargrup);
		$vars=explode("|",$vargrup[0]);
		$tipus=trim(strtoupper($vargrup[1]));

		foreach ($vars as $var)
		{
			$var=trim($var);
			if (isset($origen[$var]))
			{
				switch($tipus)
				{
					case 'INT':	//nomès numeros enters
						$origen[$var]=(int)$origen[$var];
						break;
						
					case 'MQ':
						$origen[$var]=MQ($origen[$var]);
						break;
						
					case 'REAL': //numeros decimals i negatius
					case 'CHAR': //nomes texte i números
					case 'STRING': //eliminar cometes
						$origen[$var]=preg_replace($pattern[$tipus], $strict?"_":"", $origen[$var]);
						break;
						
				}
		
			}
		}
	}
	return $origen;
}




function safe_extract($vars,$origen="PG")
{
//	$arrayglob=new array();
	$gmq=get_magic_quotes_gpc(); //si no hi ha magicquotes, afegir-les al post
	$origen=strtoupper($origen);
	foreach($vars as $key)
	{
		for ($i = 0; $i < strlen($origen); $i++)
		{
			$temp='';
			//echo $i.' '.$origen[$i];
			switch ($origen[$i])
			{
				case "P":
					//$temp=$gmq?$_POST[$key]:addslashes($_POST[$key]);
					$temp=$_POST[$key];
					break;
				case "G":
					$temp=$_GET[$key];
					break;
				case "S":
					$temp=$_SESSION[$key];
					break;
			}
			if ($temp!='')
			{
				global $$key;
				$$key=$temp;
				$_SESSION[$key]= stripslashes($temp);
				break;
			}
		}
	//arrayglob[$key]=$temp; //ho posa tot dins d'un array - per return?
	if ($temp=='') {unset($_SESSION[$key]);} //la variable no hi es sogons els parametres passats, de manera que la treiem de session per si les mosques
	}
}


//torna una cadena de paràmetres per fer servir en una url
function parametritza($vars,$origen,$start=false)
{
	if (!is_array($origen))	{$origen=merge_request($origen);} 	//en comptes d'un array, passa PG o similar 
	
	$vars=explode(',',$vars);
	$params='';

	foreach ($vars as $var)
	{
		$var=trim($var);
		if ($origen[$var]!='') {$params.=($params!=''?'&amp;':'')."$var=".urlencode($origen[$var]);}
	}
	
	if ($params!='') {$params=($start?'?':'&amp;').$params;}
	return $params;
}

//assegura que una variabla sempre sigui array
function var2array($var,$needle=false)
{
	if (empty($var)) return false;
	if (!is_array($var))
	{
		$var=$needle?explode($needle,$var):array($var);
	}
	return $var;
}


//params2array
//converteix un string de paràmetres tipus $var="format=>img|w=>330|h=>330|zc" a un array
// ["format"]=>  "img", ["w"]=>  "330", ["h"]=>  "330", ["zc"]=>  true
//els parametres que no tinguin valor assignat seran true

function params2array($params,$separador=array('|','=>'))
{
	if (empty($params)) return array();
	
	$params=explode($separador[0],$params);
	
	
	foreach ($params as $num=>$vars)
	{
		$components=explode($separador[1],$vars);
		$result[$components[0]]=isset($components[1])?$components[1]:true;
	}
	return $result;
}


//llista els arxius o directoris d'una carpeta i els retorna en forma d'array ($extensions='.' indica directori)
function llista_carpeta($ruta,$extensions)
{
	$llistat=array();
	$extensions=var2array($extensions,',');
	if ($handle = opendir($ruta))
	{
		while (false !== ($file = readdir($handle)))
		{
			foreach ($extensions as $extensio)
			{
				$tipus=filetype("$ruta/$file");
				if ($extensio=='.' && $tipus==='dir' && $file != "." && $file != ".." || substr($file, strrpos($file, '.')+1) == $extensio && $tipus==='file')
					{$llistat[]=$file;break;}
			}
		}
	}
	return $llistat;
}

function cerca_arxiu($carpeta,$nom,$extensions)
{
	$extensions=var2array($extensions,',');
	foreach ($extensions as $extensio)
	{
		if (file_exists("$carpeta/$nom.$extensio")) return "$nom.$extensio";		
	}
	return false;
}
	
//-------------query run--------------
//rep un array de querys i les executa - principalment es farà servir per esborrar coses
function query_run($queries, $errordie=true)
{
	if (!is_array($queries)) {$queries=array($queries);} //converteix una cadena simple en un array d'un únic element
		$counter=0; // per saber quina query fa l'error
		foreach ($queries as $query)
		{
			$result=mysql_query($query);
			if (!$result)
			{
				if ($errordie) 
					{die(mysql_error($counter));}
				else
					{return mysql_errno();}
			}
			$counter++;
		}
		return false;

}

//-------------query check--------------
//comproba si una query torna alguna cosa o no
function query_check($query)
{
	$result=mysql_query($query);
	//tornarem false si hi ha algun error
	return !mysql_errno()?mysql_num_rows($result):false;
}

	


function form_valida ($vars,$registre)
{
	foreach ($vars as $nom=>$estat)
	{
		if (!is_bool($estat)) {$estat=($_POST[$nom]!='');}
		if (!$estat) $registre[$nom]=TRUE; //atencio, cal fer una verificació adicional quan son diversos idiomes (el primer pot ser false y el segon sobreescriu el primer
	}
	return $registre; //si no hi ha cap error, tornarà el mateix que va rebre (FALSE, p.e.)
}



function nip_valida($cif) {
//Torna: 1 = NIF ok, 2 = CIF ok, 3 = NIE ok, -1 = NIF bad, -2 = CIF bad, -3 = NIE bad, 0 = ??? bad
   $cif = strtoupper($cif);
   for ($i = 0; $i < 9; $i ++)
      $num[$i] = substr($cif, $i, 1);
//si no tiene un formato valido devuelve error
   if (!ereg('((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)', $cif))
      return 0;
//comprobacion de NIFs estandar
   if (ereg('(^[0-9]{8}[A-Z]{1}$)', $cif))
      if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 0, 8) % 23, 1))
         return 1;
      else
         return -1;
//algoritmo para comprobacion de codigos tipo CIF
   $suma = $num[2] + $num[4] + $num[6];
   for ($i = 1; $i < 8; $i += 2)
      $suma += substr((2 * $num[$i]),0,1) + substr((2 * $num[$i]),1,1);
   $n = 10 - substr($suma, strlen($suma) - 1, 1);
//comprobacion de NIFs especiales (se calculan como CIFs)
   if (ereg('^[KLM]{1}', $cif))
      if ($num[8] == chr(64 + $n))
         return 1;
      else
         return -1;
//comprobacion de CIFs
   if (ereg('^[ABCDEFGHJNPQRSUVW]{1}', $cif))
      if ($num[8] == chr(64 + $n) || $num[8] == substr($n, strlen($n) - 1, 1))
         return 2;
      else
         return -2;
//comprobacion de NIEs
   //T
   if (ereg('^[T]{1}', $cif))
      if ($num[8] == ereg('^[T]{1}[A-Z0-9]{8}$', $cif))
         return 3;
      else
         return -3;
   //XYZ
   if (ereg('^[XYZ]{1}', $cif))
      if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr(str_replace(array('X','Y','Z'), array('0','1','2'), $cif), 0, 8) % 23, 1))
         return 3;
      else
         return -3;
//si todavia no se ha verificado devuelve error
   return 0;
}

/* generador de contrasenya*/
function genera_password($num=8,$randnum=0){ // By Kernellover 
    $voc = 'aeiou'; 
    $con = 'bcdfgjklmnpqrstwxyz';
	$nvoc = strlen($voc)-1;
	$ncon = strlen($con)-1;
	$psw =mt_rand(0,1)?$con[mt_rand(0,$ncon)]:''; // defineix si comença per vocal o consonant

	
    for ($n=0; $n<=ceil($num/2); $n++){ 
        $psw .= $voc[mt_rand(0,$nvoc)]; 
        $psw .= $con[mt_rand(0,$ncon)]; 
    }

	$cua=$randnum?mt_rand(1,$randnum):'';
	$psw = str_replace (array('q','quu','yi','iy'),array('qu','que','ya','ya'),$psw);
    $psw = substr($psw,0,$num-strlen($cua)).$cua; 


    return $psw; 
}


//Funcions de DATA
function data_valida($data)
{
    if (preg_match("/^(\d{1,2})[\/-](\d{1,2})[\/-](\d{2,4})$/", $data, $matches))
	{
        return checkdate($matches[2], $matches[1], $matches[3]);
    }
    return false;
}

function dataaunix($data){
	if (data_valida($data))
		{preg_match("/^(\d{1,2})[\/-](\d{1,2})[\/-](\d{2,4})$/", $data, $tmp);}
	else $tmp=false;
	
	return $tmp?mktime (0,0,0,$tmp[2],$tmp[1],$tmp[3]):"";	
}

function dataasql($dtstr,$invalid=false) {
	if ($invalid!==false && !data_valida($dtstr)) {return $invalid;}
  list($day,$mon,$yr) = split('[/.-]',$dtstr); 
  return $yr."-".$mon."-".$day; 
} 

function sqladata($dtstr) { 
    $retdt = $dtstr!='0000-00-00'?date("d-m-Y",strtotime($dtstr)):'';
    return $retdt; 
}

//convertir segons a h:m:s
function sec2hms ($sec, $padHours = false) 
  {

    $hours = intval(intval($sec) / 3600);
    $minutes = intval(($sec / 60) % 60);
    $seconds = intval($sec % 60); 
	
	
    $hms = ($padHours?str_pad($hours, 2, "0", STR_PAD_LEFT):$hours). ':'.
			str_pad($minutes, 2, "0", STR_PAD_LEFT). ':'.
			str_pad($seconds, 2, "0", STR_PAD_LEFT);

    return $hms;
    
  }
  
//convertir hms a segons
function hms2sec ($hms) {
	list($h, $m, $s) = explode (":", $hms);
	$seconds = 0;
	$seconds += (intval($h) * 3600);
	$seconds += (intval($m) * 60);
	$seconds += (intval($s));
	return $seconds;
}
  

function restahores($horaIni, $horaFi,$format="H:i"){
    return (date("H:i", strtotime("00:00:00") + strtotime($horaFi) - strtotime($horaIni) ));
}



//processa totes les claus d'un array cercant una cua concreta i crea noves claus sense aquesta cua. p.e.
//$dades=array('dades_es'=>1,'dades_ca'=>2)
//array_removetail($dades,'es')
//tornarà array('dades_es'=>1,'dades_ca'=>2,'dades'=>1)
function array_removetail($dades,$tail,$separador='_')
{
	$key_pars=array();
	$tail = $separador.$tail;
	$tail_len = strlen($tail);
	
	//si m'has passat un array sense arrays
	if (empty($dades)) return array();
	if (!is_array($dades[0])) {$dades=array($dades); $uniarray=true;}

	
	if (empty($dades) || !is_array($dades)) return false;
	//indexo totes les keys que tinguin la cua especificada
	foreach (array_keys($dades[0]) as $k)
	{	
		if (substr($k,-$tail_len) == $tail) {$key_pars[$k]=substr($k,0,-$tail_len);}
	}
	
	if (!empty($key_pars))	//si hi ha alguna cosa que canviar, ho fem
	{
		foreach ($dades as &$dada)
		{
			foreach ($key_pars as $key=>$newkey) {$dada[$newkey]=$dada[$key];}
		}
	}
	
	if ($uniarray) {$dades=$dades[0];}
	return $dades;
}

/*resumeix un array segons l'index distintiu de cada array i les cadenes que se li passin
serveix per presentar una fitxa unica quan una vista retorna varies fileres. pot anar be per idiomes, etc... 
$demo=(id=1,nom=Carles,id_nom=33,lloc=valls),(id=1,nom=Susana,id_nom=44,lloc=valls)
array2form($demo,array(nom),id_nom) --->
$demo=(id=1,nom=(33=>Carles,44=>Susana),lloc=valls)
estudiar utilitat
*/



function array2form($array_dades,$camps=false, $camp_index=false)
{
	$array_final=$array_dades[0];
	if ($camps)
	{
		foreach ($camps as $camp)
		{
			$tmp=array();
			foreach ($array_dades as $row) {$tmp[$row[$camp_index]]=$row[$camp];}
			$array_final[$camp]=$tmp;
		}
	}
	return $array_final;
}


// converteix una query amb joins en un array amb multi nivells
//$esquema=>array('idioma'=>array('camp1','camp2'),'camp3')
//1. els camps camp1 i camp2 s'agruparan segons idioma, un per cada idioma diferent (es,ca,...)
//2. el camp3 crearà un array amb tots els camp3 que siguin diferents
function Query2uniArray($query,$esquema)
{
	$array_dades=QueryIntoArray($query);
	$array_final=$array_dades[0];
	
	foreach ($array_dades as $row)
	{
		foreach ($esquema as $array_def=>$sub_arrays)
		{
			if (is_array($sub_arrays)) //si es un array multimple tipus es, ca, etc....			
			{
				$grouper=$row[$array_def]; //es, ca, en......
				foreach ($sub_arrays as $subarray)
				{
					if (!is_array($array_final[$subarray])) $array_final[$subarray]=array();	//si es el primer cop, convertir-lo en array
					//if (!array_key_exists($array_def,$array_final[$subarray]))
					$array_final[$subarray][$grouper]=$row[$subarray];	//assignem el texte al idioma corresponent
				}
			}
			else	//es un array simple resultat d'un join. és a dir, atributs d'un objecte
			{
				if (!is_array($array_final[$sub_arrays])) $array_final[$sub_arrays]=array();	//si es el primer cop, convertir-lo en array
				if (!in_array($row[$sub_arrays],$array_final[$sub_arrays])) $array_final[$sub_arrays][]=$row[$sub_arrays];
			}
		}
	}

	return $array_final;
}

	

//paginador
//genera un array amb els numeros dels links a mostrar i 0 per quan ha de sortir "..."
//paginador_gen(total de pàgines,pàgina actual,minim de pàgines per aplicar el paginador)
function paginador_gen($total,$pag,$break=13,$range=7)
{
	if ($total<2) return false;
	$paginador=array();
	for ($t=1;$t<=$total;$t++)
	{

		if ($t<=$range ||  ($t+$range/2>=$pag && $t-$range/2<=$pag) || $t==$pag || $t>$total-$range || $total<=$break)
			{$paginador[]=$t;$valid=true;}
		else
			{if ($valid) $paginador[]=0;$valid=false;}			
	}
	return $paginador;
	
}

function paginador_build($query,$pag,$rows_per_pag=10,$break=13,$range=7)
{
$num_rows=query_check($query);
$paginador_act=$pag?$pag:1; //si no te num de pàgina, és 1
$num_pags=ceil($num_rows/$rows_per_pag);
		$paginador=array(
			'numspags'=>paginador_gen($num_pags,$paginador_act),
			'pag_act'=>$paginador_act,
			'pag_max'=>$num_pags,
			'pag_prev'=>$paginador_act-1,
			'pag_next'=>$paginador_act+1,
			'pag_seg'=>($paginador_act>=$num_pags)?0:$paginador_act+1,			
			'num_rows'=>$num_rows
			);
		return $paginador;
}

//isAjax: Comprova si la pàgina actual ha estat cridada mitjançant ajax
function isAjax()
{
	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=="xmlhttprequest");
}


//funcions de pàgina, si que envien headers, pero buenu
function gotoURL($pagina, $status='301')
{
	global $HTTP_ROOT,$ROOT;
	
	$port=$_SERVER['SERVER_PORT'];	
	$secure=$_SERVER['HTTPS']?"s":"";
	
	$REAL_ROOT="http{$secure}://".$_SERVER['SERVER_NAME'].($port!=80?":$port":"");	//root decidida segons la funció
	$srvr =$pagina[0]!='/'?coalesce($HTTP_ROOT,$ROOT,$REAL_ROOT):$REAL_ROOT; //si la pàgina no apunta a l'arrel '/' fes servir el root de sessió; en cas contrari el root real
	
	if (strpos($pagina, 'http') !== 0) //no és una url absoluta;
	{
		$pagina=rtrim($srvr,'/\\')."/".ltrim($pagina,'/\\');
	}

	if ($status) {header("Status: $status");} //# 301 Moved Permanently
	header("Location: $pagina");
	die();
}


//obre un arxiu local i l'envia com a arxiu de descàrrega
function arxiu2http($nom_fitxer,$carpeta,$inline=false)
{
	$parsed_url=pathinfo($nom_fitxer);
	$nom_fitxer_c=$carpeta.$nom_fitxer;

	switch ($parsed_url['extension']) {
		case "pdf": $ctype = "application/pdf";
			break;
		case "txt": $ctype = "text/plain";
			break;
		case "exe": $ctype = "application/octet-stream";
			break;
		case "zip": $ctype = "application/zip";
			break;
		case "doc": $ctype = "application/msword";
			break;
		case "xls": $ctype = "application/vnd.ms-excel";
			break;
		case "ppt": $ctype = "application/vnd.ms-powerpoint";
			break;
		case "gif": $ctype = "image/gif";
			break;
		case "png": $ctype = "image/png";
			break;
		case "jpeg":
		case "jpg": $ctype = "image/jpg";
			break;
		default: $ctype = "application/force-download";
	}

	if ($inline) //ha de mostrar la imatge
	{
		header("Content-Type: $ctype");
		switch ($ctype) {
			case "image/png":
				$im=imagecreatefrompng($nom_fitxer_c);
				imagepng($im);
				imagedestroy($im);
			case "image/jpg":
				$im=imagecreatefromjpeg($nom_fitxer_c);
				imagejpeg($im);
				imagedestroy($im);
		}
		exit(0);
	}


	// fix for IE catching or PHP bug issue
	header("Pragma: public");
	header("Expires: 0"); // set expiration time
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	// browser must download file from server instead of cache

	// force download dialog
	//header("Content-Type: application/octet-stream");
	//header("Content-Type: application/download");
	header("Content-Type: $ctype");

	// use the Content-Disposition header to supply a recommended filename and
	// force the browser to display the save dialog.
	header("Content-Disposition: attachment; filename=$nom_fitxer;");

	/*
	The Content-transfer-encoding header should be binary, since the file will be read
	directly from the disk and the raw bytes passed to the downloading computer.
	The Content-length header is useful to set for downloads. The browser will be able to
	show a progress meter as a file downloads. The content-lenght can be determines by
	filesize function returns the size of a file.
	*/
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: ".@filesize($nom_fitxer_c));

	@readfile($nom_fitxer_c);
	exit(0);
}

//obtenir el llenguatge del navegador
function get_client_language($availableLanguages, $default=''){
	
	if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
	{
			
		$langs=explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
		//start going through each one
		foreach ($langs as $value)
		{
			$choice=substr($value,0,2);
			if(isset($availableLanguages[$choice])) {return $choice;}
		}
	} 
	return $default;
}





//variables ghlobals
$PAGACT = basename($_SERVER['PHP_SELF']); //pàgina actual









