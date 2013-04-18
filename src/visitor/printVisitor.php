<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


class PrintVisitor implements visitor{
	// public function visit($node){
	// 	echo $node->getFullPath() . "\n";
	// }
	/**
	 * context of this node, object context stores all information about the environment of this current node
	 *
	 * @var context
	 **/
	private $_context;

	public function __construct($context)
	{
		$this->_context = $context;
	}

	public function visit($node){
		
		$this->_context->push($node);
		$this->_context->printCurrentStack();
	}

	public function leave($node){
		$this->_context->pop($node);
	}
}