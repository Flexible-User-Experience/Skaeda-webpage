<?php
		$_query=array(
		
			'idiomes'=>"SELECT idioma_abr as id, idioma_nom as nom FROM idioma WHERE idioma__estat_id=1 ORDER BY idioma_ordre>0 desc, idioma_ordre asc,idioma_nom" ,
			'selector_gen'=>"SELECT %taula%_id as id, %taula%_%nom% as nom FROM %taula% ORDER BY %taula%_%nom%" ,
			'llistat_count'=>"SELECT *, COUNT(%taula2%_rel_id) as %taula2%_count from %taula% %joins% left join %taula2%_rel on %taula2%_rel__%taula%_id=%taula%_id WHERE 1 %likes% group by %taula%_id ORDER BY %camp% %ordre%",
			'pags_likes'=>" AND (%taula%_codi like '%%text_cerca%%' OR %taula%_at_titol like '%%text_cerca%%')",
			
			);
			
			
//defineixo la estructura de joins de les taules
			
$taules_def=array();


?>