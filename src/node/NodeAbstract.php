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
	 * create file or folder in current container
	 * @param  string $container path or context of current container of this node
	 * @return true of create successfully
	 */
	public function create($container);

	/**
	 * hook method for a visitor, creat function also can be implement here
	 * @param  visitor object $visitor visitor object to perform our operation 
	 */
	public function accept($visitor);

}