<?php

/**
 * 
 * Method to split a string, add elements to each one of the resulting strings and glue them together
 * @param unknown_type $mainQuery
 * @param unknown_type $glue
 * @param unknown_type $appendQuery
 */

function splitString($mainQuery, $glue, $appendQuery){
	try{
		$query=explode($glue,$mainQuery);
		for($i=0;$i<sizeof($query);$i++){
			$query[$i].=$appendQuery;
		}
		$query=implode(" $glue ", $query);
	} catch(Exception $e){ //if it is a single query
		$query=$mainQuery.$resquery;
	}
	return $query;
}



?>