<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


/**
 * folder node may have childs so it is composite 
 */
Class FolderNode implements NodeAbstract{
	/**
	 * this variable contains all children of current folder node 
	 *
	 * @var string
	 **/
	private $children = array();

	/**
	 * name of current nodoe
	 *
	 * @var string
	 **/
	private $name;

	/**
	 * initialize object with name 
	 * @param string $name name of this node
	 */
	public function __construct($name) {
		$this->name = $name;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function add($node) {
		$this->children[$node->getName()] = $node;
	}

	public function remove($node) {
		unset($this->children[$node->getName()]);
	}

	public function getAllChildren() {
		return $this->children;
	}

	public function create($container = './') {
		$new_folder_path = rtrim($container, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $this->name; 
		if(!mkdir($new_folder_path, 0777))
		{
			return false;
		}

		foreach ($this->children as $child) {
			if(!$child->create($new_folder_path))
			{
				return false;
			}
		}

		return true;
	}
}