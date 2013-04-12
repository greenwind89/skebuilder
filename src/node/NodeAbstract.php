<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */

require(dirname(__FILE__) . './filenode.php');
require(dirname(__FILE__) . './foldernode.php');

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