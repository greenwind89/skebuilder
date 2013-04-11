<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


interface parserInterface{
	/**
	 * get skeleton array structure from input xml file
	 * @param  string $file_path full path to xml file
	 * @return array            array structure which is appropriate to generate folder structure
	 * 
	 * >>> add some test case here?
	 */
	public function parseSkeleton($file_path);

}
