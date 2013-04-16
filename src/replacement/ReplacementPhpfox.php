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
		'block_class_name'
		);
	public function buildReplacementList() {
		$this->addKeyValueIntoReplacementList('module_name', $this->context->getModuleName());
		$this->addKeyValueIntoReplacementList('package_id', $this->context->getPackageId());
		$this->addKeyValueIntoReplacementList('module_name_upper_first', ucfirst($this->context->getModuleName()));
		$this->addKeyValueIntoReplacementList('block_class_name', $this->getBlockClassName());


	}

	public function getBlockClassName() {
		// prefix 
		$class_name_array = array();
		$class_name_array[] =ucfirst($this->context->getModuleName());

		$class_name_array[] = 'Component';
		$class_name_array[] = 'Block';

		//infix
		$directory_list = $this->context->getListOfDirectoriesFromDirectory('component' . DIRECTORY_SEPARATOR . 'block');
		foreach ($directory_list as $dir_name) {
			$class_name_array[] = ucfirst($dir_name);
		}

		// suffix 
		$current_file_name = $this->_helpers->stripFileExtension($this->context->getNameOfCurrentNode());
		$class_name_array[] = ucfirst($current_file_name);

		return implode('_', $class_name_array);
	}
}