<?php

/**
 * Alexa information Class
 *
 * @package Domain Tools
 * @author Sitebase (http://www.sitebase.be)
 * @version 1.13.1
 * @license http://codecanyon.net/wiki/support/legal-terms/licensing-terms/
 * @copyright Copyright (c) 2008-2011 Sitebase (http://www.sitebase.be)
 */
class Base_Alexa{
	
	/**
	 * Domain url
	 *
	 * @var string
	 */
	private $_url;
	
	/**
	 * Cached XML data
	 *
	 * @var SimpleXml
	 */
	private $_xml;
	
	/**
	 * Constructor
	 *
	 * @param string $url
	 */
	public function __construct($url=""){
		$this->_url = $url;
	}
	
	/**
	 * Load and cache the alexa xml data
	 *
	 * @access private
	 * @return SimpleXml
	 */
	private function loadXml(){
		if(empty($this->_xml)){
			$this->_xml = simplexml_load_file("http://data.alexa.com/data/hmyq81hNHng1MD?cli=10&dat=ns&ref=&url=" . urlencode($this->_url));
		}
		return $this->_xml;
	}
	
	/**
	 * Return rank information
	 *
	 * @access public
	 * @return string
	 */
	public function Rank(){
		$Xml = $this->loadXml();
		if(!is_object($Xml) || !isset($Xml->SD[1]) || !is_object($Xml->SD[1])) return 0;
		return trim($Xml->SD[1]->REACH['RANK']);
	}
	
	/**
	 * Get list of most searched keywords
	 *
	 * @access public
	 * @return array
	 */
	public function Keywords(){
		$source = file_get_contents("http://www.alexa.com/siteinfo/" . urlencode($this->_url) . "#keywords");
		$regex = '/<a href=\"\/search\?q\=([^\"]*)&([^\"]*)\">(.*)<\/a>/iU'; 
		preg_match_all($regex, $source, $result);
		$data = array();
		foreach($result[1] as $keyword){
			$string = urldecode($keyword);
			$string = str_replace(array("&p=gkey&r=site_site"), array(""), $string);
			$data[] = $string;
		}
		return $data;
	}
	
	/**
	 * Get related websites
	 *
	 * @access public
	 * @return array
	 */
	public function Related(){
		$Xml = $this->loadXml();
		print_r($Xml);
		$data = array();
		foreach ($Xml->RLS->RL as $related){
			$data[trim($related['HREF'])] = trim($related['TITLE']);
		}
		
		return $data;
	}
	
	/**
	 * Get number of domain backlinks
	 *
	 * @access public
	 * @return int
	 */
	public function Backlinks(){
		$Xml = $this->loadXml();
		return trim($Xml->SD->LINKSIN['NUM']);
	}
	
	/**
	 * Get value of last rank update
	 *
	 * @access public
	 * @return string
	 */
	public function Delta(){
		$Xml = $this->loadXml();
		if(!is_object($Xml) || !isset($Xml->SD[1]) || !is_object($Xml->SD[1])) return 0;
		return trim($Xml->SD[1]->RANK['DELTA']);
	}
	
}