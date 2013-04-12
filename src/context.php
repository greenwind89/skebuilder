<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


Class Context {
	/**
	 * stack of node in current context
	 *
	 * @var array
	 **/
	private $_node_stack = array();

	/**
	 * name of current generated module
	 *
	 * @var string
	 **/
	private $_module_name;

	/**
	 * most basic item name of current generated module
	 *
	 * @var string
	 **/
	private $_item_name;

	/**
	 * container of current context
	 * usually, it is a full path to a folder
	 *
	 * @var string
	 **/
	private $container;

	public function __construct($container)
	{
		// @todo: ... add module and item name here
		$this->_container = $container;
	}

	public function getContainer(){

	}
	public function push($node)
	{
		array_push($this->_node_stack, $node);
	}

	public function pop($node)
	{
		array_pop($this->_node_stack);
	}

	public function getFullPathOfCurrentContext()
	{
		$names_array = $this->getArrayOfNodeNamesInContextStack();
		$relative_to_containter_path = implode(DIRECTORY_SEPARATOR, $names_array); 
		$full_path = rtrim($this->_container, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $relative_to_containter_path . DIRECTORY_SEPARATOR; 

		var_dump($full_path);
		return $full_path;
	}

	public function getArrayOfNodeNamesInContextStack()
	{
		$array = array();
		foreach ($this->_node_stack as $node) {
			$array[] = $node->getName();
		}

		return $array;
	}

	public function printCurrentStack()
	{
		foreach ($this->_node_stack as $node) {
			echo $node->getName() . '---';
		}

		echo "\n";
	}
}