<?

$cache_dir='cache';
$file_stream = stream_context_create(array(
    'http' => array(
        'timeout' => 15
        )
    )
); 

function data_cache($codi,$temps=1800,$accio='recupera',$dades='')
{
	global $cache_dir;
	$cache_file = $cache_dir . '/'.'cache_'.$codi.md5($codi);
	
	switch ($accio)
	{
		case 'recupera':
			if ($cache_dir != '')
			{
				$timedif = @(time() - filemtime($cache_file));
				if ($timedif < $temps || !$temps) //l'arxiu de cache es suficientment recent o no s'ha de tenir en compte el temps
				{
					return unserialize(join('', file($cache_file)));
				}
				else {return false;}
			}
			return false;
			break;
			
		case 'desa':
			$serialized = serialize($dades);
			if ($f = @fopen($cache_file, 'w')) {
				fwrite ($f, $serialized, strlen($serialized));
				fclose($f);
			}
			break;
	}

}

function get_twitter($user,$cache_limit=600,$count=1)
{
	global $file_stream;
	$rss_data=data_cache('twitter'.$user,$cache_limit);
	
	if (!$rss_data)
	{
		$rss_data=array();
		$rss="http://twitter.com/statuses/user_timeline/$user.rss";
		$content = @file_get_contents($rss,0,$file_stream);
		if ($content)	//s'ha pogut llegir la url
		{
			$sx = simplexml_load_string($content);
			$i=0;
			foreach ($sx->channel->item as $item) 
			{
				$title = $item->title;
				$link = $item->link;
				$description = $item->description;
				$pubDate = $item->pubDate;

				$title=substr($title, strpos($title, ":")+2);
				$title = preg_replace("/(http:\/\/[^\s]+)/", "<a href=\"$1\" rel=\"nofollow\">$1</a>", $title); //afegeixo url si n'hi ha
				$title = preg_replace("/(@[^\s]+)/", "<span class=\"twit_at\">$1</span>", $title); //usuari

				$rss_data[]=array(
					'title'=>(string)$title,
					'link'=>(string)$link,
					'pubDate'=>(string)$pubDate
					);
				$i++;
				if ($i == $count) //ja tenim els que voliem
				{
					break;
				}
			}
		}
		else {$galeria=data_cache('twitter'.$user,false);}
		$rss_data=$rss_data[0];
		data_cache('twitter'.$user,$cache_limit,'desa',$rss_data);

	}
	return $rss_data;
}


			
function get_ipernity($user,$count=10,$cache_limit=1800)
{
	global $file_stream;
	$galeria=data_cache('grasset_ipernity',$cache_limit);
	if (!$galeria)
	{
		$galeria=array();	
		$rss="http://www.ipernity.com/feed/doc?user_id=$user&only=photo";
		$content = @file_get_contents($rss,0,$file_stream);
		if ($content)	//s'ha pogut llegir la url
		{
			$sx = simplexml_load_string($content);
			$i=0;
			foreach ($sx->entry as $picture) 
			{
				$title = (string)$picture->title;  
				$url = (string)$picture->link->attributes()->href;
				$pic = $picture->link[3]->attributes();
				$result = str_ireplace('.100.jpg', '.75x.jpg', $pic['href']);
				$galeria[]=array('imatge'=>$result,'url'=>$url,'title'=>$title);
				$i++;
				if ($i == $count) //ja tenim els que voliem
				{
					break;
				}
			}
		}
		else {$galeria=data_cache('grasset_ipernity',false);}
		data_cache('grasset_ipernity',1800,'desa',$galeria);
	}
	return $galeria;
}


/**funcions tall de texte**/
/**
 * Truncates text.
 *
 * Cuts a string to the length of $length and replaces the last characters
 * with the ending if the text is longer than length.
 *
 * @param string  $text String to truncate.
 * @param integer $length Length of returned string, including ellipsis.
 * @param string  $ending Ending to be appended to the trimmed string.
 * @param boolean $exact If false, $text will not be cut mid-word
 * @param boolean $considerHtml If true, HTML tags would be handled correctly
  * @param boolean $RSS si true, executa filtres específics
 * @return string Trimmed string.
 */
function truncate($text, $length = 400, $ending = '...', $exact = false, $considerHtml = true, $RSS=true) {
	if (is_string($length)) //si length és una cadena vol dir que hi ha marcat un punt de tall
	{
		$length=strpos($text, stristr($text,$length));
		if ($length=='' || $length==0) $length=500;	
		$text=substr($string,0,$length);		
	}
	
	
	if ($RSS) {
		$text = preg_replace('/<div class="blogger-post-footer.*$/is','',$text);
		$text = strip_tags($text,'<a><em><br>');
		$text = nl2br($text);
		$text = preg_replace('/<a[^>]*>\s*<\/a>\s*/', '', $text); //esborra links buits
		$text = preg_replace('/^(<br\s*\/>\s*)+/', '', $text); //elimina brs a l'inici
		$text = preg_replace('/(<br\s*\/>\s*)+/', '<br/><br/>', $text); //substitueix un br per 2
		$text = str_replace('<a','<a rel="nofollow"',$text); //afegeix nofollow als links
		}
	
	if ($considerHtml) {
		// if the plain text is shorter than the maximum length, return the whole text
		if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
			return $text;
		}
		// splits all html-tags to scanable lines
		preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
		$total_length = strlen($ending);
		$open_tags = array();
		$truncate = '';
		foreach ($lines as $line_matchings) {
			// if there is any html-tag in this line, handle it and add it (uncounted) to the output
			if (!empty($line_matchings[1])) {
				// if it's an "empty element" with or without xhtml-conform closing slash (f.e. <br/>)
				if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
					// do nothing
				// if tag is a closing tag (f.e. </b>)
				} else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
					// delete tag from $open_tags list
					$pos = array_search($tag_matchings[1], $open_tags);
					if ($pos !== false) {
						unset($open_tags[$pos]);
					}
				// if tag is an opening tag (f.e. <b>)
				} else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
					// add tag to the beginning of $open_tags list
					array_unshift($open_tags, strtolower($tag_matchings[1]));
				}
				// add html-tag to $truncate'd text
				$truncate .= $line_matchings[1];
			}
			// calculate the length of the plain text part of the line; handle entities as one character
			$content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
			if ($total_length+$content_length> $length) {
				// the number of characters which are left
				$left = $length - $total_length;
				$entities_length = 0;
				// search for html entities
				if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
					// calculate the real length of all entities in the legal range
					foreach ($entities[0] as $entity) {
						if ($entity[1]+1-$entities_length <= $left) {
							$left--;
							$entities_length += strlen($entity[0]);
						} else {
							// no more characters left
							break;
						}
					}
				}
				$truncate .= substr($line_matchings[2], 0, $left+$entities_length);
				// maximum lenght is reached, so get off the loop
				break;
			} else {
				$truncate .= $line_matchings[2];
				$total_length += $content_length;
			}
			// if the maximum length is reached, get off the loop
			if($total_length>= $length) {
				break;
			}
		}
	} else {
		if (strlen($text) <= $length) {
			return $text;
		} else {
			$truncate = substr($text, 0, $length - strlen($ending));
		}
	}
	// if the words shouldn't be cut in the middle...
	if (!$exact) {
		// ...search the last occurance of a space...
		$spacepos = strrpos($truncate, ' ');
		if (isset($spacepos)) {
			// ...and cut the text in this position
			$truncate = substr($truncate, 0, $spacepos);
		}
	}
	// add the defined ending to the text
	$truncate .= $ending;
	if($considerHtml) {
		// close all unclosed html-tags
		foreach ($open_tags as $tag) {
			$truncate .= '</' . $tag . '>';
		}
	}
	return $truncate;
}




function query_rss($rss_url,$limit=1,$refresh=1200)
{
	$rss_data=array();
	include_once "lastRSS.php";
	// Create lastRSS object
	$rss = new lastRSS;
	$rss->cache_dir = 'templates_c';
	$rss->cache_time = $refresh;
	$rss->items_limit = $limit;
	
	if ($rs = $rss->get($rss_url))
	{
		if ($limit<2)
		{
			$rdata=$rs['items'][0];
			if ($rdata['description']) {$rdata['description']=truncate(html_entity_decode($rdata['description']),400);}
		}
		else {$rdata=$rs;}
		return $rdata;
	}
	else {return false;}
}

//envia un mail amb swift
function envia_mail($from,$to,$subject,$body,$attach=false)
{

	/*SWIFT sendmail*/
	require_once ABS_PATH.'libs/swift/swift_required.php';
	require_once ABS_PATH.'libs/class.html2text.php';
	
	$h2t =& new html2text($body);
	$body_txt = $h2t->get_text();
	
	//Check if an attachment was uploaded
	if ($attach===true)
	{
		$file_path = false;
		$file_name = false;
		$file_type = false;
		if (!empty($_FILES[$attach]["tmp_name"]))
		{
			$file_path = $_FILES[$attach]["tmp_name"];
			$file_name = $_FILES[$attach]["name"];
			$file_type = $_FILES[$attach]["type"];
		}
	}

	$transport = Swift_SmtpTransport::newInstance(EMAIL_CONNEX, 587)
		->setUsername(EMAIL_USERNAME)
		->setPassword(EMAIL_PASSWORD);
	$mailer = Swift_Mailer::newInstance($transport);
	$message = Swift_Message::newInstance()
		->setSubject($subject)
		->setFrom($from)
		->setTo($to)
		->setBody($body,'text/html')
		->addPart($body_txt, 'text/plain');


	//If an attachment was sent, attach it
	if ($file_path && $file_name && $file_type)
	{
		$message->attach(new Swift_Message_Attachment(new Swift_File($file_path), $file_name, $file_type));
	}
	else if (is_string($attach))
	{
		$message->attach(Swift_Attachment::fromPath($attach));
	}



	//Send the message
	//$result = $mailer->batchSend($message);
	$result = is_array($to)?$mailer->batchSend($message,$failures):$mailer->send($message); //envia en grup o individualment segons si el to es un array

	//if (is_array($to)) {
	$result=array('errors'=>$failures,'ok'=>$result);
	return $result;
}

//enviar un mail fent servir una plantilla d'smarty
function sendsmartymail($dades,$plantilla_actual='mailpage.html')
{
	
	$smarty_mail = new Smarty;
	$smarty_mail->caching = false;
	$smarty_mail->debugging = false;
	$smarty_mail->assign(array('dades'=>$dades));

	$body=$smarty_mail->fetch($plantilla_actual);
	$titol = $smarty_mail->get_config_vars('MAIL_TITOL');
	

	/******DESACTIVAT DE MOMENT*****/
	$result= envia_mail(array(EMAIL_ORIGEN=>EMAIL_SENDER),$dades['nom']?array($dades['mail']=>$dades['nom']):$dades['mail'],$titol,$body,$dades['attach']);
	return $result;
}


function lectoflickr($tag,$max=3,$cache_limit=900)
{
	if ($tag=='') return false;
	GLOBAL $IDFLICKR;
	$iter=0;
	$codi_cache=netejaURL("flickr{$tag}{$max}");
	$rss_data=data_cache($codi_cache,$cache_limit);
	
	if (!$rss_data)
	{
		$data = file_get_contents("http://api.flickr.com/services/feeds/photos_public.gne?id={$IDFLICKR}&tags={$tag}&lang=es-us&format=rss_200");
		$xml = new SimpleXMLElement($data);
		$tmp=array();
		foreach ($xml->channel->item as $obj)
		{
			preg_match('/src="(.*?)"/s', $obj->description , $results);
			$tmp[]=array('nom'=>''.$obj->title, 'url'=>''.$obj->link, 'foto'=>$results[1]);
			if (++$iter==$max) {break;}
		}
		//if (!empty($tmp)) { data_cache($codi_cache,$cache_limit,'desa',$tmp);}
		data_cache($codi_cache,$cache_limit,'desa',$tmp);
	}
	else $tmp=$rss_data;
	$resposta=array('imgs'=>$tmp,'tag'=>$tag,'flickr_id'=>$IDFLICKR);
	
	return $resposta;
}


function check_id($taula,$id,$prefix="")
{
	return query_check("SELECT * from {$prefix}{$taula} where {$taula}_id=$id");
}

//accions a fer en editar l'edició des de dins d'un controller. Una mica xusco, amb tanta global, pero funciona
function fi_edicio($id,$id_id=false)
{

	global $PV,$nou,$pag_actual,$transpag,$idioma,$infopag;
	$_SESSION['frm__op']=($nou?'add':'edit');
	$_SESSION['frm__id']=$id;
	if ($id_id) {$extra_url='/'.$id_id;}
	$tourl=($PV['frm_guarda']?"{$pag_actual}/$id{$extra_url}":($transpag[$idioma][$infopag['seccio']].$extra_url));

	gotoURL($tourl,'');	
}

//desa arxius del gestiona. Altre cop no seria la millor de les programacions, pero fa net
//retorna PV si tot ha anat be i el nom del camp si hi ha algun error
function desa_arxius($tipus)
{
	global $PV,$FTX_DIRS,$id;

	$retorn=array();	
	
	foreach ($PV['file_old'] as $idx=>$fold)
	{
		
		//$orfe=fitxer_orfe($id,$fold,"proyectos",$idx);
		$tipusact=params2array($tipus[$idx]);
		$directory=ABS_PATH.$FTX_DIRS[$tipusact['format']];

		if (!empty($_FILES['file_upload']['tmp_name'][$idx]) && ($PV['file_accio'][$idx]=='nou' || $PV['file_accio'][$idx]==''))
		{
			switch ($tipusact['format'])
			{
				case 'img':
					$uploaded_arxiu=uploadimg($_FILES['file_upload'],$idx,$directory,array('w'=>coalesce($tipusact['w'],470),'h'=>coalesce($tipusact['h'],360),'q'=>coalesce($tipusact['q'],90),'zc'=>check_bool($tipusact['zc'])),coalesce($tipusact['f'],'jpeg'),$fold,$orfe?$fold:'');
					break;
				
				default:
					$uploaded_arxiu=uploadfitxer($_FILES['file_upload'],$idx,$directory,$orfe?$fold:'');
					break;
			}
				
				
			//$uploaded_arxiu=$tipus[$idx]=='docs'?uploadfitxer($_FILES['file_upload'],$idx,$directory,$orfe?$fold:''):uploadimg($_FILES['file_upload'],$idx,$directory,array('w'=>470,'h'=>360,'q'=>90),'jpeg',$fold,$orfe?$fold:'');
			$ftx_vol=$_FILES['file_upload']['size'][$idx];

			if (!$uploaded_arxiu || $ftx_vol==0)
			{
				return $idx;//$error[$idx]=TRUE;
				break;
			}
			else {borrafitxer($directory.$fold);}
		}
		elseif ($PV['file_accio'][$idx]=='no' && $fold!='') //marcat que no vol arxius i n'hi ha un d'antic
		{
			borrafitxer($directory.$fold);
			$uploaded_arxiu='';
		}
		else {$uploaded_arxiu=$fold;}
		$PV[$idx]=$uploaded_arxiu; //assignar el nom a la variable
		$PV[$idx."bytes"]=$ftx_vol;
	}
	return $PV;
}


function fitxer_orfe($ignora_id, $fitxer_nom, $taula, $camp)
{
	if (!$fitxer_nom) return true;
	echo "SELECT * FROM $taula where {$camp}='".MQ($fitxer_nom)."' AND {$taula}_id!={$ignora_id}";
	return !query_check("SELECT * FROM $taula where {$camp}='".MQ($fitxer_nom)."' AND {$taula}_id!={$ignora_id}");
}



function marca_camp($MAINTBL,$ids,$valor=1,$camp="paperera")
{
	$ids=var2array($ids);
	foreach ($ids as $num=>$id) {$ids[$num]=(int)$id;}	//netejem les dades perque només siguin números (ids)
	
	if ($ids)
	{
		query_run("UPDATE {$MAINTBL} set {$MAINTBL}_{$camp}='{$valor}' WHERE {$MAINTBL}_id IN (".implode(',',$ids).")");
		$executat=true;
	}
	$_SESSION['frm__op']=$executat?'delpaperera':'resperfer';
}

//esborra registre semi-universal
//esborra_registre(nomtaula,array('id'=>array(5,8,13),'files'=>array('nomcamp'=>carpeta,...)))
//primer els rel i despres el registre. El rel és "rel_MAINTBL_$rel"



//array('main'=>'actualitat','sub'=>'categories','del_by'=>'sub','files'=>$files,'ids'=>$ids);
function elimina_registre($params)
{
	$executat=false; $errors=false;
	$files=$params['files'];
	$ids=var2array($params['id']);
	$taula=$params['taula'];
	$camp_id=$params['taula'].($params['id_nom']?("__".$params['id_nom']):"")."_id";
	
	
	
	foreach ((array)$ids as $id)
	{
		$id=(int)$id;
		$dades=queryintoarray("SELECT * FROM {$taula} where {$camp_id}={$id}",'unic');
		$result=query_run("DELETE FROM {$taula} WHERE {$camp_id}={$id}",false);
		
		$executat=true;
		
		if ($result)
			{$errors=true;}	//no s'ha pogut esborrar, no continuem amb aquesta iteració
		elseif (is_array($files))
		{
			foreach ($files as $camp=>$carpeta)
			{
				$campact="{$taula}_{$camp}";
				if ($dades[$campact]!='')	//si hi ha algún arxiu i és orfe, l'esborrem
				{
					$orfe=!query_check("SELECT * FROM {$taula} where {$campact}='{$dades[$campact]}' AND {$taula}_id!=$id");
					if ($orfe) borrafitxer(ABS_PATH.$carpeta.$dades[$campact]);
				}
			}
		}
	}
	$_SESSION['frm__op']=$executat?(!$errors?'del':'delerrors'):'resperfer';
}


function esborra_registre($MAINTBL,$params)	//obsolet a 23/11/2010
{
	$executat=false;
	$files=$params['files'];
	$ids=var2array($params['id']);
	$errors=false;
	$rel=$params['rel'];
	if ($ids)
	{
	foreach ($ids as $id)
	{
		$id=(int)$id;
		$dades=queryintoarray("SELECT * FROM {$MAINTBL} where {$MAINTBL}_id=".$id,'unic');
		$taula=($rel?'rel_':'').$MAINTBL.($rel?"_{$rel}":"");

		$result=query_run("DELETE FROM {$taula} WHERE ".($rel?"{$taula}__":"")."{$MAINTBL}_id=$id",false);
		$executat=true;
		
		if ($result)
			{$errors=true;}	//no s'ha pogut esborrar, no continuem amb aquesta iteració
		elseif (is_array($files))
		{
			foreach ($files as $camp=>$carpeta)
			{
				$campact="{$MAINTBL}_{$camp}";
				if ($dades[$campact]!='')	//si hi ha algún arxiu i és orfe, l'esborrem
				{
					$orfe=!query_check("SELECT * FROM {$MAINTBL} where {$campact}='{$dades[$campact]}' AND {$MAINTBL}_id!=$id");
					if ($orfe) borrafitxer(ABS_PATH.$carpeta.$dades[$campact]);
				}
			}
		}
	}
	}
	$_SESSION['frm__op']=$executat?(!$errors?'del':'delerrors'):'resperfer';
}







//paginació. Genera les dades infopag i afegeix limit a la query;
function paginador($query,$pag,$rows_per_pag,$ordre,$camp)
{
	GLOBAL $infopag;
	$infopag['paginador']=paginador_build($query,$pag,$rows_per_pag);
	$infopag['paginador']['ordre']=($ordre?"&ordre=$ordre":"").($camp?"&camp=$camp":"");//.($text_cerca?"&text_cerca=$text_cerca":"");
	$query.=" LIMIT ".((($pag?$pag:1)-1)*$rows_per_pag).",$rows_per_pag";	
	return $query;
}


function chk_permisos($seccions)
{
	if ($seccions=='') return true;	//buit... li donem accès al 404
	GLOBAL $pag_rols,$permisos;
	$seccions=var2array($seccions);	//aixi permeto varies seccions; la primera que sigui vàlida, passa
	foreach ($seccions as $seccio)
	{
		$trobat=true;
		if (isset($pag_rols[$seccio]))
		{
			$trobat=false;	//esta dintre del grup de permisos, no deixis passar de moment
			foreach ($pag_rols[$seccio] as $codi)
			{
				if (isset($permisos[$codi])) {$trobat=true;break;}
			}
		}
		if ($trobat) break;
	}
	return $trobat?$seccio:false;
}


//cron check... mira si el programa ja s'esta executant i en cas de ser així aborta. Si no, crea el fitxer de lock i li diu al navegador que la pàgina s'ha acabat
//per poder continuar treballant en segon pla.

function chk_cron($accio)
{
	$lock_arx = ABS_PATH.'/admin/cron/cron.lock';
	
	ignore_user_abort(true);
	set_time_limit(0);

	//acaba amb tot 
	if ($accio=='stop') {@unlink($lock_arx); die();}

	//i si no comença el procès
	$mypid = getmypid();
	$file = @fopen($lock_arx, "x");
	if($file === false)
	{
		$oldpid=file_get_contents($lock_arx);
		if ($mypid==$oldpid)
		{
			echo "Error: Ja hi ha un Cron actiu";
			die();
		}
	}
	else {@fclose($file);}
	
	header("Connection: close\r\n");
	header("Content-Encoding: none\r\n");
	ob_start();
	echo "Inici";
	header('Content-Length: '.ob_get_length());
	ob_end_flush(); 
	flush();
	ob_end_clean();
	session_write_close();

	file_put_contents($lock_arx,$mypid);
}

















///////////////////////////////////TEST/////////////////////////////


















function delete_registre($taula_base,$ids,$id_nom='')
{
	global $taules_def;
	$executat=false; $errors=false;
	$ids=var2array($ids);
	
	//$files=$params['files'];	
	
	//verifico la llista d'ids que ens han passat. Els converteixo a integer, i si el resultat és 0, els descarto. El resultat el converteixo en una string per fer servir a IN
	$str_ids=array();
	foreach ((array)$ids as $idtmp)
	{
		$idtmp=(int)$idtmp;
		if ($idtmp) {$str_ids[]=$idtmp;}
	}
	
	if (!empty($str_ids))
	{
	
		$str_ids=implode(',',$str_ids);
		//nom de l'id que farem servir de guia
		$idon=$taula_base.($id_nom?"__{$id_nom}":'').'_id';
	
		//vejam si te config o es una taula pelada
		$config=$taules_def[$taula_base];
		//echo "<br>%%%% PROCESSANT LA TAULA $taula_base amb id nom $id_nom<hr>";
		if ($config)
		{
			//si te joins, els enviem a esborrar
			foreach ((array)$config['joins'] as $taula_join)
			{
				//echo "%%%% JOIN ESBORRA $taula_join <br>";
				$result=delete_registre($taula_join,$ids,$taula_base);
				if ($result) {$errors=true;}
			}
			//vejam si te fitxers
			if (isset($config['files']))
			{
				$afectats=queryintoarray("SELECT * FROM {$taula_base} WHERE $idon IN ({$str_ids})");
				//echo "%%%%%BUSCANT FITXERS SELECT * FROM {$taula_base} WHERE $idon IN ({$str_ids})";
				foreach ($afectats as $afectat)
				{
					foreach ((array)$config['files'] as $idfitxer=>$carpeta)
					{
						$nomfitxer=$afectat["{$taula_base}_{$idfitxer}"];
						if ($nomfitxer)
						{
							//echo "%%%% BORRAFITXER ".ABS_PATH.$carpeta.$nomfitxer."<br>";
							borrafitxer(ABS_PATH.$carpeta.$nomfitxer);
						}
					}
				}
			}
			//vejam si hi ha pares
			if (isset($config['paternitat']))
			{
				$colnom="{$taula_base}_{$config['paternitat']}_id";
				//echo "%%%% UPDATE {$taula_base} SET {$colnom}='' WHERE {$colnom} IN ({$str_ids})<br>";
				$result=query_run("UPDATE {$taula_base} SET {$colnom}='' WHERE {$colnom} IN ({$str_ids})");	
				if ($result) {$errors=true;}			
			}
		}
	
		//doncs ja casi està, esborrem els registres de la taula principal i adeu molt bones
		//echo "%%%% QUERYRUN DELETE FROM {$taula_base} WHERE $idon IN ({$str_ids})<br>";
		$result=query_run("DELETE FROM {$taula_base} WHERE $idon IN ({$str_ids})");
		$executat=true;
		if ($result) {$errors=true;}	//no s'ha pogut esborrar
	
	}
	if ($id_nom=='') //només farem una notificació per la taula inicial
	{
		$_SESSION['frm__op']=$executat?(!$errors?'del':'delerrors'):'resperfer';
		return $errors;
	}

	
}




function reordena_registres($MAINTBL,$ids,$id_delimiter=false)
{
	if ($id_delimiter)
	{
		$join_row=key($id_delimiter);
		$join_id=$id_delimiter[$join_row];
	}
	
	//reordenació automàtica (per exemple despres d'esborrar un registre
	if ($ids && is_bool($ids))
	{
		$autoorder=true;	//no volem que faci die al finalitzar
		//resetejo la ordenacio mysql;
		query_run("SELECT @itera:=0");
		$query="SELECT @itera:=@itera+1 AS id, {$MAINTBL}_id AS nom  FROM {$MAINTBL} WHERE {$MAINTBL}__{$join_row}_id='{$join_id}' ORDER BY {$MAINTBL}_ordenacio ASC";
		//$query="UPDATE {$MAINTBL} SET {$MAINTBL}_ordenacio= @itera:=@itera+1 ORDER BY {$MAINTBL}_ordenacio ASC";
		//query_run($query);
		//return;
		$ids=QueryIntoOption ($query);
		if (empty($ids)) return;
	}
	
	foreach ($ids as $posicio=>$recordIDValue)
	{
		if ($recordIDValue)
		{
			$query = "UPDATE {$MAINTBL} SET {$MAINTBL}_ordenacio='$posicio' WHERE {$MAINTBL}_id='{$recordIDValue}'".
			($id_delimiter?" AND {$MAINTBL}__{$join_row}_id = '{$join_id}'":"");	//nomes ordena els que tinguin aquest id
			query_run($query);
			//echo $query;
		}

	}
	if (!$autoorder) die();

}


function registres_tree($MAINTBL,$info)
{
	$parent=$info['id'];
	$campnom=$info['camp'];
	$tree=array();
	
	while ($parent)
	{
		$dades=QueryIntoArray("SELECT * FROM {$MAINTBL} WHERE {$MAINTBL}_id={$parent}",'unic');
		
		array_unshift($tree,array($dades["{$MAINTBL}_id"]=>$dades["{$MAINTBL}_{$campnom}"]));
		$parent=$dades["{$MAINTBL}_pare_id"];
	}
	return $tree[0];
}



/*
fulltext_query: fa una cerca fulltext contra un conjunt de camps. Per millorar la velocitat, es pot crear un  o més indexs a la base de dades amb
ALTER TABLE Productes ADD FULLTEXT(productes_nom_es,productes_titol_es, ....);
en la versio "likes" o fuzzy_query es pot utilitzar ? com a comodí. En les dues, les cometes delimiten una frase 
$estructura=array(
		'productes'=>
			array(
			'titol'=>"productes_nom_es",
			'conts'=>"productes_descripcio_extensa_es",
			'text'=>"productes_nom_es,productes_descripcio_es, productes_descripcio_extensa_es, productes_infoadicional_es, productes_nom_material_es, productes_comp_material_es, productes_origen_material_es, productes_adjunt_titol_es",
			'pag_id'=>'producte'
			),
			...
		)
*/
function fulltext_query($textcerca,$estructura,$identificador='',$mode='')
{
	$query_ft="";
	$query_union="";
	$identificador.=$identificador!=''?'_':'';
	//treiem espais  i comes
	$textcerca = preg_replace('/[,:;_¿¡!+\'\.\%\(\)]/', ' ', $textcerca);
	$textcerca = preg_replace('/\s\s+/', ' ', $textcerca);
	
	//extreiem les frases entre cometes i les posem a $frases
	preg_match_all('/"([^"]*)"/',$textcerca,$frases);
	$frases=$frases[1];
	//treiem les frases de la cadena de cerca i tornem a netejar
	$textcerca = preg_replace('/("[^"]*")/', "",$textcerca);
	$textcerca = trim(preg_replace('/\s\s+/', ' ', $textcerca));
	
	//extreiem les paraules simples
	$textcerca=explode(' ',$textcerca);

	//creo les unions
	foreach ($estructura as $idtaula=>$estruct)
	{
	$query_union.=($query_union!=''?" UNION ":'').
		"(SELECT 
		{$idtaula}_id AS {$identificador}id,
		{$estruct['titol']} AS {$identificador}titol,
		{$estruct['conts']} AS {$identificador}conts,
		CONCAT_WS(' ',{$estruct['text']}) AS {$identificador}rawtext,
		'{$estruct['pag_id']}' AS {$identificador}tipus
		FROM {$idtaula}
		WHERE {$idtaula}_estat=1 AND {$idtaula}_paperera=0
		)";
	}
	
	
	switch ($mode)
	{
		case 'likes':	//en una base de dades innodb no podem fer servir fulltext, això és una alternativa
			$textcerca = preg_replace('/[?\*]/', '_', $textcerca);
			
			//ajuntem frases i paraules en un array
			$textcerca=array_merge($textcerca,$frases);

			foreach ($textcerca as $atom)
			{
				$atom=MQ($atom);
				$query_ft.=$query_ft!=''?' + ':'';
				$query_ft.="IF({$identificador}rawtext LIKE '%{$atom}%',1,0)";
			}
			
			break;
		
		default:
		
			//afegirem * al darrera de cada paraula per que busqui parcials
			foreach ($textcerca as &$paraula) {$paraula.='*';}
				
			//afegirem les cometes i ">" per donar major rellevancia de cerca a les frases
			foreach ($frases as &$frase) {$frase='>"'.$frase.'"';}
			
			//reajuntem els arrays i ho reconvertim en cadena, tot en un
			$textcerca=implode(' ',array_merge($textcerca,$frases));

			$textcerca=MQ($textcerca);		
			$query_ft="MATCH({$identificador}rawtext) AGAINST ('{$textcerca}' IN BOOLEAN MODE)";
			
			break;
	}
	
	$query="SELECT * FROM (SELECT *,(".$query_ft.") AS ft_coincidencies FROM (".$query_union.") AS tbunion ) AS tbglobal WHERE ft_coincidencies>0 ORDER BY ft_coincidencies DESC";
	
	return $query;
	
}

function fuzzy_query($textcerca,$estructura,$identificador='')
{
	return fulltext_query($textcerca,$estructura,$identificador,'likes');
}