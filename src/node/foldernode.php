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


	private $full_path;
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

	public function getFullPath() {
		return $this->full_path;
	}

	public function remove($node) {
		unset($this->children[$node->getName()]);
	}

	public function getAllChildren() {
		return $this->children;
	}

	public function create($context) {
		$container = $context->getFullPathOfCurrentContext();
		$replacement =  Skebuilder::getSkeletonReplacement();
		$real_folder_name = $replacement->replace($this->name, $context);
		$this->name = $real_folder_name;

		$new_folder_path = rtrim($container, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $real_folder_name; 
		if(!mkdir($new_folder_path, 0777))
		{
			return false;
		}
		$this->full_path = $new_folder_path;
		// foreach ($this->children as $child) {
		// 	if(!$child->create($new_folder_path))
		// 	{
		// 		return false;
		// 	}
		// }

		

		return true;
	}

	public function accept($visitor)
	{
		$visitor->visit($this);
		foreach ($this->children as $child) {
			$child->accept($visitor);
		}
		$visitor->leave($this);
	}
}