<?php
$error=false;

$menu['controllers']=QueryIntoOption(sprintfx($_query['selector_gen'],array('taula'=>'controllers','nom'=>'nom')));

$infopag=array_merge($infopag,array(
				"idioma"=>$idioma)
				);
				
/***** PROCESSAR CADA PÀGINA***************/
		$autopag=true;	//ULL - intentarà mostrar la pàgina encara que no sigui un case, sempre que existeixi el template (i que estigui definida a mysql.pags)	
		
		switch($thispag)
		{
			case 'inici':
			
				if($PV['accio']) {
						$tourl=$transpag[$PV['idiomes']][$thispag];
						gotoURL($tourl,'');
					}
			break;	
			
			case 'error403':
				break;
		}
