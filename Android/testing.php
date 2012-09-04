<?php

function getFeed($feed_url) {

	$content = file_get_contents($feed_url);
	$x = new SimpleXmlElement($content);
	$version = 5;
	$articleArr = array();
	
	echo "Starting v " . $version;

	$articleArr[] = '<?xml version="1.0" encoding="UTF-8"?>';
	
	foreach($x->channel->item as $entry) {
		$articleArr[] = "\n<article>\n";
		$articleArr[] = "<title>" . $entry->title . "</title>\n";
		$articleArr[] = "<pubDate>" . $entry->pubDate . "</pubDate>\n";
		$articleArr[] = "<link>" . $entry->link . "</link>\n";
		$articleArr[] = "</article>\n";
	}
	$myFile = "testFile.xml";
	$fh = fopen($myFile, 'w+') or die("can't open file");
		foreach($articleArr as $z)
		{
			fwrite($fh,$z);
			echo "$z" . "<br>";
		}
	fclose($fh);
}

//echo 'test';
getFeed("http://feeds.mashable.com/Mashable?format=xml");


?>

