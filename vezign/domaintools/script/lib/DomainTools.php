<?php 

/**
 * Global domaintools Class
 * 
 * @package Domain Tools
 * @author Sitebase (http://www.sitebase.be)
 * @version 1.13.1
 * @license http://codecanyon.net/wiki/support/legal-terms/licensing-terms/
 * @copyright Copyright (c) 2008-2011 Sitebase (http://www.sitebase.be)
 */
// Include required libraries
include("File.php");
include("Whois.php");
include("Google.php");
include("Alexa.php");
include("Bing.php");
include("Yahoo.php");

class Base_DomainTools
{
	
	/**
	 * The domain to get info from
	 *
	 * @var string
	 */
	private $_url;
	
	/**
	 * Constructor
	 */
	public function __construct(){}
	
	/**
	 * Cleanup the domain string
	 *
	 * @access private
	 * @param string $string
	 * @return void
	 */
	private function cleanDomain($string){
		
		// Remove www.
		$string = str_replace("www.", "", $string);
		
		// Remove http://
		$string = str_replace("http://", "", $string);
		
		return $string;
	}
	
	/**
	 * Get rank information for this domain
	 *
	 * @access public
	 * @param string $domain
	 * @return array
	 */
	public function Rank($domain){
		
		// Cleanup domain
		$domain 	= $this->cleanDomain($domain);
		
		// Create data objects
		$Google 	= new Base_Google($domain);
		$Alexa 		= new Base_Alexa($domain);
		
		// Get ranks
		$data['google'] 		= $Google->Rank();
		$data['alexa']			= $Alexa->Rank();
		$data['alexa_delta'] 	= $Alexa->Delta();
		
		// Return data
		return $data;
		
	}
	
	public function Keywords($domain){
	
		// Cleanup domain
		$domain 	= $this->cleanDomain($domain);
	
		// Create data objects
		$Alexa = new Base_Alexa($domain);
		
		// Return data
		return $Alexa->Keywords();
	}
	
	/**
	 * Get whois information for this domain
	 *
	 * @access public
	 * @param string $domain
	 * @return string
	 */
	public function Whois($domain){
		
		// Cleanup domain
		$domain 	= $this->cleanDomain($domain);
		
		// Create data objects
		$Whois 		= new Base_Whois();
		
		// Get whois data
		$data		= $Whois->Get($domain);
		
		// Return data
		return $data;
		
	}
	
	public function GetExtensionList(){
		$Whois = new Base_Whois();
		return $Whois->GetExtensionList();
	}
	
	/**
	 * Check if a domain is free
	 * 
	 * @access public
	 * @param string $domain
	 * @param array/string $extension
	 * @return array|string
	 */
	public function Free($domain, $extension=""){
		
		// Cleanup domain
		$domain 	= $this->cleanDomain($domain);
		
		// Create data objects
		$Whois 		= new Base_Whois();
		
		// Get whois 
		$data		= $Whois->Free($domain, $extension);

		if(count($data) > 1){
		
			// Return data
			return $data;
		
		}else{
		
			// Return data
			if(is_array($extension)) {
				return $data[$extension[0]];
			} else {
				return $data[$extension];
			}
			
		}
		
	}
	
	/**
	 * Get the number of indexed pages
	 *
	 * @access public
	 * @param string $domain
	 * @return array
	 */
	public function IndexedPages($domain){
		
		// Cleanup domain
		$domain 	= $this->cleanDomain($domain);
		
		// Create data objects
		$Google		= new Base_Google($domain);
		$Bing		= new Base_Bing($domain);
		$Yahoo		= new Base_Yahoo($domain);
		
		// Get indexed pages
		$data['google']			= $Google->Indexed();
		$data['bing']			= $Bing->Indexed();
		$data['yahoo']			= $Yahoo->Indexed();
		
		// Return data
		return $data;
		
	}
	
	/**
	 * Get number of backlinks
	 *
	 * @access public
	 * @param string $domain
	 * @return void
	 */
	public function Backlinks($domain){
		
		// Cleanup domain
		$domain 	= $this->cleanDomain($domain);
		
		// Create data objects
		$Google		= new Base_Google($domain);
		$Yahoo		= new Base_Yahoo($domain);
		
		// Get indexed pages
		$data['google']			= $Google->Backlinks();
		$data['yahoo']			= $Yahoo->Backlinks();
		
		// Return data
		return $data;
		
	}
	
	
}