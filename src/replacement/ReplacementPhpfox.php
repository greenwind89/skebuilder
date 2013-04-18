<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


class ReplacementPhpfox extends ReplacementCore{

	private $_helpers; 
	public function __construct() {
		$this->_helpers = new Helpers();
	}

	/**
	 * this array contain keywords that this class provides to replace, 
	 * any mismatch in the key should be lead to invalid replacement
	 * at least Unit Test will detect it
	 * @var array
	 */
	public $matching_array = array(
		'module_name',
		'package_id',
		'module_name_upper_first',
		'block_class_name',
		'controller_class_name',
		'service_class_name',
		'link_to_controller',
		'item_name',
		'item_name_upper_first',
		'author'
		);


	private $_block_pattern_array = array(
		'component', 'block'
		);

	private $_controller_pattern_array = array(
		'component', 'controller'
		);

	private $_service_pattern_array = array(
		'service'
		);

	public function buildReplacementList() {
		$this->addKeyValueIntoReplacementList('module_name', $this->context->getModuleName());
		$this->addKeyValueIntoReplacementList('item_name', $this->context->getItemName());
		$this->addKeyValueIntoReplacementList('package_id', $this->context->getPackageId());
		$this->addKeyValueIntoReplacementList('module_name_upper_first', ucfirst($this->context->getModuleName()));
		$this->addKeyValueIntoReplacementList('item_name_upper_first', ucfirst($this->context->getItemName()));

		$this->addKeyValueIntoReplacementList('block_class_name', $this->getClassName($this->_block_pattern_array));
		$this->addKeyValueIntoReplacementList('controller_class_name', $this->getClassName($this->_controller_pattern_array));
		$this->addKeyValueIntoReplacementList('service_class_name', $this->getClassName($this->_service_pattern_array));

		$this->addKeyValueIntoReplacementList('link_to_controller', $this->getLinkToController($this->_controller_pattern_array));

		$this->addKeyValueIntoReplacementList('author', $this->context->getAuthorName());

	}

	public function getClassName($pattern_array) {
		// prefix 
		$class_name_array = array();
		$class_name_array[] =ucfirst($this->context->getModuleName());
		foreach ($pattern_array as $part) {
			$class_name_array[] = ucfirst($part);
		}

		//infix
		$directory_list = $this->context->getListOfDirectoriesFromDirectory(implode(DIRECTORY_SEPARATOR, $pattern_array));
		foreach ($directory_list as $dir_name) {
			$class_name_array[] = ucfirst($dir_name);
		}

		// suffix 
		$current_file_name = $this->_helpers->stripFileExtension($this->context->getNameOfCurrentNode());
		$class_name_array[] = ucfirst($current_file_name);

		return implode('_', $class_name_array);
	}

	public function getLinkToController($pattern_array) {
		$link_array = array();

		$directory_list = $this->context->getListOfDirectoriesFromDirectory(implode(DIRECTORY_SEPARATOR, $pattern_array));
		foreach ($directory_list as $dir_name) {
			$link_array[] = $dir_name;
		}

		$current_file_name = $this->_helpers->stripFileExtension($this->context->getNameOfCurrentNode());
		$link_array[] = $current_file_name;

		return implode('.', $link_array);
	}


}