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

	private $_package_id;

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
		$this->_module_name = Skebuilder::getModuleName();
		$this->_package_id = Skebuilder::getPackageId();
		$this->_container = $container;
	}

	public function getModuleName() {
		return strtolower($this->_module_name);
	}

	public function getPackageId() {
		return $this->_package_id;
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

		// var_dump($full_path);
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
	/**
	 * get list of directory succeeds input directory pattern
	 * <pre>
	 * 		For Phpfox: Fullpath context (upload/module/xxx/component/block/admnincp/index.php)
	 * 		getListOfDirectoriesFromDirectory('component/block') --> array('admincp')
	 * </pre>
	 * @param  string $directory_pattern patern to recognize right root directory
	 * @return string                  array of directory
	 */
	public function getListOfDirectoriesFromDirectory($directory_pattern) {
		$full_path = $this->getFullPathOfCurrentContext();
		$path_with_pattern = strstr($full_path, $directory_pattern);
		$remain_path = str_replace($directory_pattern, '', $path_with_pattern);

		$parts = explode(DIRECTORY_SEPARATOR, $remain_path);

		$result = array();
		foreach ($parts as $part) {
			if($part == '' || strstr($part, '.'))
			{
				continue;
			}
			else
			{
				$result[] = $part;
			}
		}
		return $result;
	}

	public function getNameOfCurrentNode() {
		if(count($this->_node_stack) == 0)
		{
			return false;
		}

		$current = $this->_node_stack[0];
		return $current->getName();
	}
}