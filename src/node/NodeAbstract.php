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
}