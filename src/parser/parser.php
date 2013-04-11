<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */

require(dirname(__FILE__) . './XMLParser.php');
require(dirname(__FILE__) . './parserInterface.php');
require(dirname(__FILE__) . './XMLParserDataToSkeletonArrayAdapter.php');


Class parser{

	private $_parser = null;
	public function __construct($parser = 'xml')
	{
		$this->_parser = new XMLParserDataToSkeletonArrayAdapter;
	}

	// conform with parser interface
	public function parseSkeleton($file_path)	
	{
		return $this->_parser->parseSkeleton($file_path);
	}
}
