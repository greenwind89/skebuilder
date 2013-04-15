<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


class ReplacementPhpfox extends ReplacementCore{

	/**
	 * this array contain keywords that this class provides to replace, 
	 * any mismatch in the key should be lead to invalid replacement
	 * at least Unit Test will detect it
	 * @var array
	 */
	public $matching_array = array(
		'module_name',
		'package_id',
		'module_name_upper_first'
		);
	public function buildReplacementList() {
		$this->addKeyValueIntoReplacementList('module_name', $this->context->getModuleName());
		$this->addKeyValueIntoReplacementList('package_id', $this->context->getPackageId());
		$this->addKeyValueIntoReplacementList('module_name_upper_first', ucfirst($this->context->getModuleName()));
	}
}