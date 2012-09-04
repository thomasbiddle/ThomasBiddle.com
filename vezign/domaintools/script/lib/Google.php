<?php

/**
 * Google information Class
 * 
 * @package Domain Tools
 * @author Sitebase (http://www.sitebase.be)
 * @version 1.13.1
 * @license http://codecanyon.net/wiki/support/legal-terms/licensing-terms/
 * @copyright Copyright (c) 2008-2011 Sitebase (http://www.sitebase.be)
 */
class Base_Google{
	
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
	 * Get number of domain backlinks
	 *
	 * Added second reg expression to match different text when
	 * a website has many backlinks.
	 * 
	 * @access public
	 * @return int
	 */
	public function Backlinks(){
		$source = file_get_contents('http://www.google.be/search?hl=nl&q=link%3A'.urlencode($this->_url).'&btnG=Zoeken&meta=','r');
	    $match_expression = '/(resultStats\>|Ongeveer\ )([0-9,\.]*) resultaten/'; 
		preg_match($match_expression, $source, $matches);
	    if(isset($matches[2])) return str_replace(".", "", $matches[2]); 
	    $match_expression = '/van circa <b>([0-9]*\.[0-9]+|[0-9]+)<\/b> met links/'; 
	    preg_match($match_expression, $source, $matches);
	    if(isset($matches[1])) return $matches[1]; 
	    return 0;
	}
	
	/**
	 * Get number of indexed pages
	 *
	 * @access public
	 * @return int
	 */
	public function Indexed(){
		$source = file_get_contents('http://www.google.com/search?hl=nl&q=site%3A'.urlencode($this->_url).'&btnG=Zoeken&meta=','r');
		$source = str_replace(array('<b>', '</b>'), '', $source);
		$match_expression = '/(ongeveer\ )([0-9,\.]*) (resultaten|van)/i'; 
		preg_match($match_expression, $source, $matches); 
		if(isset($matches[2])){
	    	return str_replace(".", "", $matches[2]); 
		}else{
			return 0;	
		}
	}
	
	/**
	 * Return rank information
	 *
	 * @access public
	 * @return string
	 */
	public function Rank($host='toolbarqueries.google.com',$context=NULL){
		$seed = "Mining PageRank is AGAINST GOOGLE'S TERMS OF SERVICE. Yes, I'm talking to you, scammer.";
		$result = 0x01020345;
		$len = strlen($this->_url);
		for ($i=0; $i<$len; $i++) {
			$result ^= ord($seed{$i%strlen($seed)}) ^ ord($this->_url{$i});
			$result = (($result >> 23) & 0x1ff) | $result << 9;
		}
		$ch=sprintf('8%x', $result);
		$url='http://%s/tbr?client=navclient-auto&ch=%s&features=Rank&q=info:%s';
		$url=sprintf($url,$host,$ch,$this->_url);
		@$pr=file_get_contents($url,false,$context);
		$pagerank = $pr?substr(strrchr($pr, ':'), 1):false;
	   
	   if(!isset($pagerank)) return 0;
	   return $pagerank;
	}
	
	/* 
	 * Generate hash for the given URL
	 */
	private function hashUrl($String)
	{
	    $check1 = $this->strToNum($String, 0x1505, 0x21);
	    $check2 = $this->strToNum($String, 0, 0x1003F);
	
	    $check1 >>= 2; 	
	    $check1 = (($check1 >> 4) & 0x3FFFFC0 ) 	| ($check1 & 0x3F);
	    $check1 = (($check1 >> 4) & 0x3FFC00 ) 		| ($check1 & 0x3FF);
	    $check1 = (($check1 >> 4) & 0x3C000 ) 		| ($check1 & 0x3FFF);	
		
	    $key1 = (((($check1 & 0x3C0) << 4) 		| ($check1 & 0x3C)) <<2 ) 		| ($check2 & 0xF0F );
	    $key2 = (((($check1 & 0xFFFFC000) << 4) | ($check1 & 0x3C00)) << 0xA) 	| ($check2 & 0xF0F0000 );
		
	    return ($key1 | $key2);
	}
	
	/**
	 * String to number
	 *
	 * @param string $Str
	 * @param hex $Check
	 * @param hex $Magic
	 * @return string
	 */
	private function strToNum($string, $check, $magic)
	{
	    $Int32Unit = 4294967296;  // 2^32
	
	    $length = strlen($string);
	    for ($i = 0; $i < $length; $i++) {
	        $check *= $magic; 	
	        if ($check >= $Int32Unit) {
	            $check = ($check - $Int32Unit * (int) ($check / $Int32Unit));
	            $check = ($check < -2147483648) ? ($check + $Int32Unit) : $check;
	        }
	        $check += ord($string{$i}); 
	    }
	    return $check;
	}
	
	/**
	 * Generate hash to check if the string is valid
	 *
	 * @param string $hashnum
	 * @return unknown
	 */
	private function checkHash($hashnum)
	{
	    $checkByte = 0;
	    $clag = 0;
		$flag = "";
	    $hashStr = sprintf('%u', $hashnum);
	    $length = strlen($hashStr);
		
	    for ($i = $length - 1;  $i >= 0;  $i --){
	        $re = $hashStr{$i};
	        if (1 === ($flag % 2)) {              
	            $re += $re;     
	            $re = (int)($re / 10) + ($re % 10);
	        }
	        $checkByte += $re;
	        $flag ++;	
	    }
	
	    $checkByte %= 10;
	    if (0 !== $checkByte){
	        $checkByte = 10 - $checkByte;
	        if (1 === ($flag % 2) ){
	            if (1 === ($checkByte % 2)){
	                $checkByte += 9;
	            }
	            $checkByte >>= 1;
	        }
	    }
	
	    return '7' . $checkByte . $hashStr;
	}
	
	
}
