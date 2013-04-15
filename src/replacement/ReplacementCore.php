<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


class ReplacementCore{

	/**
	 * this list has keys are the phrases which will be replaced, and the values are replacing value
	 * @var array
	 */
	private $replacement_list = array();

	protected $context; 
	public function replace($content, $context) {
		$this->context = $context;

		$this->buildReplacementList();

		$replaced_list = array_keys($this->replacement_list);
		$replace_list = array_values($this->replacement_list);
		$replaced_content = str_replace($replaced_list, $replace_list, $content);

		return $replaced_content;
	}

	public function buildReplacementList() {

	}

	public function getReplacementList() {
		return $this->replacement_list;
	}
	/**
	 * this function will add the symbol into replaced phrase to recognize it in the text
	 */
	public function addKeyValueIntoReplacementList($key, $value)
	{
		$new_key = '[skebuilder:' . $key . ']';
		$this->replacement_list[$new_key] = $value;	
	}

}