<?php
	include("script/lib/DomainTools.php");
	$DomainTools = new Base_DomainTools();
	$result = $_GET['result'];
	$site = $_GET['site']; 
	/* ?result=search&site=site_here */
	if ($result == 'search')
	{
		$code = $DomainTools->Rank($site);
		echo $code['google'] . "<br />";
		echo $code['alexa'] . "<br />";
		echo $code['alexa_delta'] . "<br />";
	}
	/* ?result=keywords&site=site_here */
	else if ($result == 'keywords')
	{
		$code = $DomainTools->Keywords($site);
		echo "<ul>";  
		foreach($code as $keyword) echo "<li>" . $keyword . "</li>";
	}
	/* ?result=whois&site=site_here */
	else if ($result == 'whois')
	{
		$code = $DomainTools->Whois($site);
		echo nl2br($code);
	}
	/* ?result=freedomain&site=site_here */
	else if ($result == 'freedomain')
	{
		$site2 = substr($site, 0, strrpos($site, '.'));
		$extension = substr($site, strrpos($site, '.')+1); 
		$code = $DomainTools->Free($site2, $extension);  
		$string_status = ($code) ? "available" : "not available"; 
		echo $site2 . "." . $extension . " is " . $string_status;  
	}
	/* ?result=indexnumber&site=site_here */
	else if ($result == 'indexnumber')
	{
		$code = $DomainTools->IndexedPages($site);  
		echo $code['google'] . "<br />";  
		echo $code['bing'] . "<br />";  
		echo $code['yahoo'] . "<br />";  
	}
	/* ?result=backlinks&site=site_here */
	else if ($result == 'backlinks')
	{
		echo 'backlinks';
	}
	else echo 'Invalid search parameters.';
?>