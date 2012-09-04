<?php

/**
 * Get whois information for a domain
 * 
 * @package Domain Tools
 * @author Sitebase (http://www.sitebase.be)
 * @version 1.13.1
 * @license http://codecanyon.net/wiki/support/legal-terms/licensing-terms/
 * @copyright Copyright (c) 2008-2011 Sitebase (http://www.sitebase.be)
 */
class Base_Whois{
	
	/********************* PROPERTY ********************/
	
	/**
	 * whois servers
	 * 
	 * @access private
	 * @var type $_whois
	 */
	private $_whois = array();
	
	/**
	 * Registrationdate string
	 * 
	 * @access private
	 * @var type $_registration
	 */
	private $_registration = array("registration date", "registered", "creation date", "created on", "record created");
	
	/**
	 * whois data cache
	 * 
	 * @access private
	 * @var type $_whoisdata
	 */
	private $_whoisdata = array();

	/********************** INIT **********************/
	
	/**
	 * Constructor
	 */
	public function __construct(){
		
		// Add domain extension servers
		$this->_whois['biz']  = array("whois.biz", 43, "{domein}.biz", "Not found:");
		$this->_whois['be']   = array("whois.dns.be", 43, "{domein}", "FREE");
		$this->_whois['cn']  = array("whois.cnnic.net.cn", 43, "{domein}.cn", "no matching record");
		$this->_whois['com']  = array("whois.nsiregistry.net", 43, "{domein}.com", "No match for");
		$this->_whois['co.uk']  = array("whois.nic.uk", 43, "{domein}.co.uk", "No match for");
		$this->_whois['de']  = array("whois.denic.de", 43, "{domein}.de", "free");
		$this->_whois['edu']   = array("whois.educause.net", 43, "{domein}", "No Match");
		$this->_whois['eu']   = array("whois.eu", 43, "{domein}", "AVAILABLE");
		$this->_whois['fr']   = array("whois.nic.fr", 43, "{domein}.fr", "No entries found");
		$this->_whois['ie']   = array("whois.domainregistry.ie", 43, "{domein}", "Not Registered");
		$this->_whois['in']   = array("whois.registry.in", 43, "{domein}", "NOT FOUND");
		$this->_whois['info'] = array("whois.afilias.info", 43, "{domein}.info", "NOT FOUND");
		$this->_whois['jp']   = array("whois.jprs.jp", 43, "{domein}.jp", "No match");
	 	$this->_whois['mobi'] = array("whois.dotmobiregistry.net", 43, "{domein}", "NOT FOUND");
		$this->_whois['name'] = array("whois.nic.name", 43, "{domein}.name", "No match");
	 	$this->_whois['net']  = array("whois.nsiregistry.net", 43, "{domein}.net", "No match for");
		$this->_whois['nl']   = array("whois.domain-registry.nl", 43, "{domein}.nl", "is free");
		$this->_whois['nu']   = array("whois.nic.nu", 43, "{domein}.nu", "NO MATCH");
	 	$this->_whois['org']  = array("whois.publicinterestregistry.net", 43, "{domein}.org", "NOT FOUND");
	 	$this->_whois['tv']   = array("whois.nic.tv", 43, "{domein}.tv", "No match");
	 	$this->_whois['us']   = array("whois.nic.us", 43, "{domein}.us", "Not found");
	 	$this->_whois['ws']   = array("whois.worldsite.ws", 43, "{domein}.ws", "No match");
		$this->_whois['hu']   = array("whois.nic.hu", 43, "{domein}.hu", "No match");
		$this->_whois['pl']   = array("whois.dns.pl", 43, "{domein}.pl", "No information available");
		$this->_whois['se']   = array("whois.iis.se", 43, "{domein}.se", "not found");
		$this->_whois['ca']   = array("whois.cira.ca", 43, "{domein}.ca", "Domain status:         available");
	}
	
	/********************* PUBLIC **********************/
	
	/**
	 * Whois informatie ophalen
	 * 
	 * @author 		Wim Mostmans <wim@etc.be>
	 * @access 		public
	 * @param 		string $domeinnaam
	 * @param		array $whoisrule
	 * @return 		string
	 */
	private function whois($domeinnaam, $whoisrule)
	{
	    list ($server, $poort, $domein, $vrij) = $whoisrule;
	    $domein = str_replace("{domein}", $domeinnaam, $domein);
		
	   //$fp = fsockopen($server, $poort);
	
		if ($server == null) { 
			$fp = null; 
		} else { 
			$i = 0; 
			while (++$i < 3) { 
				try { 
					$fp = fsockopen($server, $poort);
					if ($fp) { break; } 
				} catch (Exception $e) { 
					$fp = null; 
				} 
			} 
		}

	    if($fp)
	    {
	        fputs($fp, $domein."\r\n");
			$data = "";
	        while(!feof($fp))
	        {
	            $data .= fread($fp, 1000);
	        }
	
	        fclose($fp);
	    }
	    else
	    {
	        $data = "error";
	    }

	    // Cache whois data
	    $this->_whoisdata[$domein] = $data;
	    
	    return $data;
	}
	
	/**
	 * Domein informatie ophalen
	 * 
	 * @author 		Wim Mostmans <wim@etc.be>
	 * @access 		public
	 * @param 		string $domeinnaam
	 * @return 		string
	 */
	public function Get($domeinnaam){
		
		// Domain extensie
		$extension = substr($domeinnaam, strpos($domeinnaam, ".")+1);
		return $this->whois(str_replace(".".$extension, "", $domeinnaam), $this->_whois[$extension]);
		
	}
	
	/**
	 * Controlleer of domeinen vrij zijn
	 * 
	 * @author 		Wim Mostmans <wim@etc.be>
	 * @access 		public
	 * @param 		string $domeinnaam
	 * @param		string $extension
	 * @return 		string
	 */
	public function Free($domeinnaam, $extension=""){
		
		$result = array();
		
		// Filter domain extensie
		if(strstr($domeinnaam, ".")){
			$domainpart = substr($domeinnaam, 0, strpos($domeinnaam, "."));
		}else{
			$domainpart = $domeinnaam;
		}
		
		if(empty($extension)){
		
			// Create result list
			foreach ($this->_whois as $ext => $value)
	        {
	            list ($server, $poort, $domein, $vrij) = $value;
	            $data = $this->whois($domainpart, $value);
	
	            if (!strstr($data, $vrij))
	            {
	                $result[$ext] = FALSE;
	            }
	            elseif ($data == "error")
	            {
	                $result[$ext] = FALSE;
	            }
	            else
	            {
	                $result[$ext] = TRUE;
	            }
	        }
	        return $result;
	        
		}else if(is_array($extension)){
			foreach($extension as $ext){
				list ($server, $poort, $domein, $vrij) = $this->_whois[$ext];
	            $data = $this->whois($domainpart, $this->_whois[$ext]);

	            if (!strstr($data, $vrij))
	            {
	                $result[$ext] = FALSE;
	            }
	            elseif ($data == "error")
	            {
	                $result[$ext] = FALSE;
	            }
	            else
	            {
	                $result[$ext] = TRUE;
	            }
			}
			return $result;
		}else{

			list ($server, $poort, $domein, $vrij) = $this->_whois[$extension];
			$data = $this->whois($domainpart, $this->_whois[$extension]);
			
			if (!strstr($data, $vrij))
	        {
	            $result[$extension] = FALSE;
	        }
	        elseif ($data == "error")
	        {
	            $result[$extension] = FALSE;
	        }
	        else
	        {
	            $result[$extension] = TRUE;
	        }
	        
	        return $result;
		
		}
        
	}
	
	public function GetExtensionList(){
		$list = array();
		foreach($this->_whois as $extension => $data){
			$list[] = $extension;
		}
		return $list;
	}
	
	/**
	 * Domain age
	 * 
	 * @author 		Wim Mostmans <wim@etc.be>
	 * @access 		public
	 * @param 		string $domeinnaam
	 * @return 		string
	 */
	public function Age($domeinnaam){
		
		if(isset($this->_whoisdata[$domeinnaam])){
			$whoisdata = $this->_whoisdata[$domeinnaam];
		}else{
			$whoisdata = $this->Get($domeinnaam);
		}
		
		$whoisrule = explode("\n", $whoisdata);
		
		foreach($whoisrule as $rule){
			echo $rule . "<br />";
			foreach($this->_registration as $hit){ 
				if(strstr(strtolower($rule), $hit)){
					$found = $rule;
					break;
				}
			}
		
		}
		
		// Filter string
		$filter = array("Domain Registration Date: ", "Creation Date: ", "Created On:", "Record created on ");
		$cleanfound = str_replace($filter, "", $found);
		echo "<br /><br /><br />" . $cleanfound;
		
	}
	
}

?>
