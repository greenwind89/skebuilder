<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */

require(dirname(__FILE__) . './printVisitor.php');
require(dirname(__FILE__) . './buildVisitor.php');

Interface Visitor {
	public function visit($node);
	
	// it is my modification
	public function leave($node);
}