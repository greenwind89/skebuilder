<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */

require(SKEBUILDER_SRC_DIR . DIRECTORY_SEPARATOR . 'parser' . DIRECTORY_SEPARATOR . 'XMLParser.php');
require(SKEBUILDER_SRC_DIR . DIRECTORY_SEPARATOR . 'parser' . DIRECTORY_SEPARATOR . 'parserInterface.php');
require(SKEBUILDER_SRC_DIR . DIRECTORY_SEPARATOR . 'parser' . DIRECTORY_SEPARATOR . 'XMLParserDataToSkeletonArrayAdapter.php');


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
