<?php

if(!ini_get('safe_mode')) {
	set_time_limit(0);
}

require_once("class_searchranking.php");

$searchEngine = $_GET['e'] ? $_GET['e'] : 'com';
$searchPages = $_GET['p'] ? $_GET['p'] : 10;

$search = new searchRanking('google.' . $searchEngine, $searchPages); //Instantiate our class & set to search through 10 pages of results.

/* Get the rankings for the defined websites / search terms */

if(!empty($_GET['q']) && !empty($_GET['w'])) {
	$search->addSearch($_GET['w'], $_GET['q']);
	$result = $search->getRankings();
	
	echo empty($result) ? 0 : $result;
} else {
	echo 'PARAMETER_MISSING';	
}

?>