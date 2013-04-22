<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */

require(SKEBUILDER_SRC_DIR . DIRECTORY_SEPARATOR . 'node' . DIRECTORY_SEPARATOR . 'filenode.php');
require(SKEBUILDER_SRC_DIR . DIRECTORY_SEPARATOR . 'node' . DIRECTORY_SEPARATOR . 'foldernode.php');

Interface NodeAbstract {
	/**
	 * create file or folder in current context
	 * @param  string $context context object storing current context
	 * @return true of create successfully
	 */
	public function create($context);

	/**
	 * hook method for a visitor, creat function also can be implement here
	 * @param  visitor object $visitor visitor object to perform our operation 
	 */
	public function accept($visitor);

}