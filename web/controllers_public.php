<?php
$error=false;

$menu['controllers']=QueryIntoOption(sprintfx($_query['selector_gen'],array('taula'=>'controllers','nom'=>'nom')));

$infopag=array_merge($infopag,array(
				"idioma"=>$idioma)
				);
				
/***** PROCESSAR CADA PÀGINA***************/
		$autopag=true;	//ULL - intentarà mostrar la pàgina encara que no sigui un case, sempre que existeixi el template (i que estigui definida a mysql.pags)	
		$thispag=$infopag['subseccio'];
		
		switch($thispag)
		{
			case 'inici':
			
				if ($pag_actual=='' && $idioma!=$idioma_cookie)
				{				
					if ($idioma_cookie && isset($idiomes[$idioma_cookie]))
						{$topag=$transpag[$idioma_cookie][$thispag];}
					elseif ($idioma_navegador!=$idioma)
						{$topag=$transpag[$idioma_navegador][$thispag];}
						
					if ($topag) gotoURL($topag);
					}
			break;	
			
			case 'error403':
				break;
		}
