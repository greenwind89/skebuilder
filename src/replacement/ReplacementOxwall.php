<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


class ReplacementOxwall extends ReplacementCore{

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
		'bol_class_name',
		'class_class_name',
		'component_class_name',
		'controller_class_name'

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
		$this->addKeyValueIntoReplacementList('bol_class_name', $this->getClassName('bol'));
		$this->addKeyValueIntoReplacementList('class_class_name', $this->getClassName('class'));
		$this->addKeyValueIntoReplacementList('component_class_name', $this->getClassName('component'));
		$this->addKeyValueIntoReplacementList('controller_class_name', $this->getClassName('controller'));


	}

	public function getClassName($type = 'bol') {
		$module_name_upper = strtoupper($this->context->getModuleName());
		$current_file_name = $this->_helpers->stripFileExtension($this->context->getNameOfCurrentNode());

		$str = '';
		$parts = explode('_', $current_file_name);
		foreach ($parts as $part) {
			$str = $str . ucfirst($part);
		}

		$result = '';
		switch ($type) {
			case 'bol':
				$result=  $module_name_upper . '_BOL_' . $str;
				break;
			case 'class':
				$result=  $module_name_upper . '_CLASS_' . $str;
				break;

			case 'component':
				$result=  $module_name_upper . '_CMP_' . $str;
				break;
			
			case 'controller':
				$result=  $module_name_upper . '_CTRL_' . $str;
				break;
			default:
				
				break;
		}
		
		return $result;

	}



}