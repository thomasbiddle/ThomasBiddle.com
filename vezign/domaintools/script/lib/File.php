<?php

/**
 * Helper for reading and writing files
 * 
 * @package Domain Tools
 * @author Sitebase (http://www.sitebase.be)
 * @version 1.13.1
 * @license http://codecanyon.net/wiki/support/legal-terms/licensing-terms/
 * @copyright Copyright (c) 2008-2011 Sitebase (http://www.sitebase.be)
 */
class Base_File {
	
	static public function GetContents($file){
		if ($fp = fopen($file, 'r')) {
			$content = '';
			while ($line = fread($fp, 1024)) {
				$content .= $line;
			}
			return $content;
		} else {
		   echo "ERROR";
		}
	}
	
	static public function PutContents($data, $file){
		if ($fh = fopen($file, 'w')){
			fwrite($fh, $data);
			fclose($fh);
		}else{
			echo "ERROR";
		}
	}
	
}