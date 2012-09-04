<?php

class searchRanking {
	
	var $searchEngine; //Our search engine URL (could be .co.uk, .com, .nl etc)
	var $pages; //How many pages of results we're going to search through
	var $table; //The name of the table to store the data in
	
	var $websiteSearches = array(); //Store our websites we're going to search for.
	var $termSearches = array(); //Store our terms we're going to search for.
	var $results = array(); //Our results will be stored here
	
	/*
		Our construct function. So this can be used with older versions I have used the class name rather than the newer __construct().
		
		Params:
		pages - How many pages to search through. Defaults to 5.
	*/
	
	public function searchRanking($searchEngine = "google.com", $pages = 5) {
		$this->searchEngine = $searchEngine;
		$this->pages = $pages;
	}
	
	/* 
		This function will be used by the user to add all of the websites and their associated search terms they wish to search for.
		
		Params:
		
		website - The website to search for (i.e. google.co.uk).
		term - The term to search for.
	*/
	
	public function addSearch($website, $term) {
		$this->websiteSearches[] = $this->trimWebsite($website);
		$this->termSearches[] = $this->prepareTerm($term);
	}
	
	public function connectToDatabase($host, $username, $password, $name, $table, $install = false) {
		$conn = mysql_connect($host, $username, $password);
		
		if($conn) {
			if(mysql_select_db($name)) {
				$this->table = $table;
				return $conn;
			} else {
				die('No database found with that name');	
			}
		} else {
			die('Invalid database credentials');	
		}
	}
	
	public function closeConnectionToDatabase($conn) {
		mysql_close($conn);
	}
	
	public function getRankings() {
		
		//Setup cURL
		$curl_handle = curl_init();
		
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 1);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($curl_handle, CURLOPT_PROXY, '69.124.158.195:8085');
		//curl_setopt($curl_handle, CURLOPT_HTTPPROXYTUNNEL, 1);
		
		for($i = 0; $i < count($this->websiteSearches); $i++) {
			sleep(5);
			$website = $this->websiteSearches[$i];
			$term = $this->termSearches[$i];
			
			$this->results[$website][$term]['page_found'] = 0;
			$this->results[$website][$term]['position_found'] = 0;	
			
			$url = 'http://www.' . $this->searchEngine . '/search?q=' . $term;
			
			for($x = 1; $x <= $this->pages; $x++) {
				
				sleep(1);
				
				$tempStart = ($x - 1)  * 10;
				
				$tempUrl = $url . '&start=' . $tempStart;
				
				curl_setopt($curl_handle, CURLOPT_URL, $tempUrl);
				
				$serp = curl_exec($curl_handle);
				$serp = $this->prepareSERP($serp);
				
				/* Try and find the website */
				
				$result = explode('<cite>', $serp);
				for($y = 0; $y < count($result); $y++) {
					$pos = strpos($result[$y], '</cite>');
					$result[$y] = substr($result[$y], 0, $pos);
					
					if($y != 0) {
						if(strpos($result[$y], $website) !== false) {
							
							$this->results[$website][$term]['page_found'] = $x;
							$this->results[$website][$term]['position_found'] = $tempStart + $y;
							return $tempStart + $y;
							break 2;
						}
					}
				}
			}
			
		}
		
		curl_close($curl_handle);
	}
	
	public function saveResults() {
		for($i = 0; $i < count($this->websiteSearches); $i++) {
			if(!$this->checkDuplicate($i)) {
				if(!$this->insertRow($i)) {
					echo 'Could not insert row ' . $i;
				} else {
					echo 'Row inserted!' . '<br />';	
				}
			} else {
				if(!$this->updateRow($i)) {
					echo 'Could not update row ' . $i;	
				} else {
					echo 'Row updated!' . '<br />';	
				}
			}
		}
	}
	
	private function insertRow($count) {
		if(mysql_query("INSERT INTO ".$this->table." (website, term, page, position, updated) VALUES ('".$this->websiteSearches[$count]."', '".mysql_real_escape_string($this->termSearches[$count])."', '".$this->results[$this->websiteSearches[$count]][$this->termSearches[$count]]['page_found']."', '".$this->results[$this->websiteSearches[$count]][$this->termSearches[$count]]['position_found']."', '".strtotime('now')."')")) {
			return true;	
		} else {
			return false;
		}
	}
	
	private function updateRow($count) {
		if(mysql_query("UPDATE ".$this->table." SET page = '".$this->results[$this->websiteSearches[$count]][$this->termSearches[$count]]['page_found']."', position = '".$this->results[$this->websiteSearches[$count]][$this->termSearches[$count]]['position_found']."', updated = '".strtotime('now')."' WHERE website = '".$this->websiteSearches[$count]."' AND term = '".mysql_real_escape_string($this->termSearches[$count])."'")) {
			return true;	
		} else {
			return false;	
		}
	}
	
	private function checkDuplicate($count) {
		$dupeCheck = mysql_query("SELECT id FROM ".$this->table." WHERE website = '".$this->websiteSearches[$count]."' AND term = '".$this->termSearches[$count]."'");
		
		if(mysql_num_rows($dupeCheck) >= 1) {
			return true;	
		} else {
			return false;	
		}
	}
	
	public function outputResults() {
		echo '<table width="90%" id="search_ranking_results">';
			echo '<tr>';
				echo '<th>Website</th>';
				echo '<th>Search Term</th>';
				echo '<th>Result</th>';
			echo '</tr>';
			
		$x = 0;
			
		$rankingResult = $this->getResults();
			
		if(!$rankingResult) {
			echo 'Sorry, the ranking results are not available at this time. Please try again later.';	
		} else {
			while($rankingRow = mysql_fetch_array($rankingResult)) {
				echo ($x % 2) ? '<tr class="highlight">' : '<tr>';
					echo '<td>' . $rankingRow['website'] . '</td>';
					echo '<td>' . $this->prepareTermForResult($rankingRow['term']) . '</td>';
					if($rankingRow['page'] >= 1) {
						echo '<td>Position ' . $rankingRow['position'] . ' which is on page ' . $rankingRow['page'] . '</td>';
					} else {
						echo '<td>The website could not be found on the first ' . $this->pages . ' pages</td>';
					}
				echo '</tr>';
				$x++;
				
			}
		}
		echo '</table>';
	}
	
	private function getResults() {
		$result = mysql_query("SELECT * FROM " . $this->table);
		
		if(!$result) {
			return false;
		} else {
			return $result;
		}
	}
	
	private function prepareSERP($serp) {
		$serp = str_replace("<b>", "", $serp);
		$serp = str_replace("</b>", "", $serp);
		$serp = str_replace("\"", "", $serp);
		$serp = str_replace(" ", "", $serp);
		
		$splitSerp = explode('<divid=res>', $serp);
		
		return $splitSerp[1]; //Return the organic listings, removing any AdWords
	}
	
	private function trimWebsite($website) {
		if(strpos($website, "www.") !== false) {
			$website = substr($website, 4, (strlen($website) - 4));	
		}
		
		return $website;
	}
	
	private function prepareTerm($term) {
		$term = str_replace(" ", "+", $term);
		return $term;
	}
	
	private function prepareTermForResult($term) {
		$term = str_replace("+", " ", $term);
		return $term;	
	}
}
?>