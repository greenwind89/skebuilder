<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */

require(SKEBUILDER_SRC_DIR . DIRECTORY_SEPARATOR . 'visitor' . DIRECTORY_SEPARATOR . 'printVisitor.php');
require(SKEBUILDER_SRC_DIR . DIRECTORY_SEPARATOR . 'visitor' . DIRECTORY_SEPARATOR . 'buildVisitor.php');

Interface Visitor {
	public function visit($node);
	
	// it is my modification
	public function leave($node);
}