<?php 

/**
 * Bing information Class
 * 
 * @package Domain Tools
 * @author Sitebase (http://www.sitebase.be)
 * @version 1.13.1
 * @license http://codecanyon.net/wiki/support/legal-terms/licensing-terms/
 * @copyright Copyright (c) 2008-2011 Sitebase (http://www.sitebase.be)
 */
class Base_Bing
{

	/**
	 * Domain url
	 *
	 * @var string
	 */
	private $_url;
	
	/**
	 * Constructor
	 *
	 * @param string $url
	 */
	public function __construct($url){
		$this->_url = $url;
	}
	
	/**
	 * Get number of indexed pages
	 *
	 * @access public
	 * @return int
	 */
	public function Indexed(){
		$source = file_get_contents('http://www.bing.com/search?q=site%3A'.urlencode($this->_url).'&setmkt=en-US&setlang=SET_NULL','r');
		$match_expression = '/of ([0-9,\.,\ ,\=,\",\,]*) results/'; 
	    preg_match($match_expression, $source, $matches); 
	    return !isset($matches[1]) ? 0 : str_replace(",", "", $matches[1]);
	}
	
}