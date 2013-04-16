<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


class BuildVisitor implements visitor{
	/**
	 * context of this node, object context stores all information about the environment of this current node
	 *
	 * @var context
	 **/
	private $_context;

	public function __construct($containter)
	{
		$this->_context = new Context($containter);
	}

	public function visit($node){
		
		// $this->_context->printCurrentStack();
		$this->_context->setCurrentProcessingNode($node);
		$node->create($this->_context);
		$this->_context->push($node);
		// >> $node->create();
		
	}

	public function leave($node){
		$this->_context->pop($node);
		// $this->_context->printCurrentStack();
	}
}