<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


class Template{
	/**
	 * full path to template file
	 *
	 * @var string
	 **/
	private $_template_path;

	/**
	 * replacement object, which will be used to perform replacement on template content
	 *
	 * @var Replacement
	 **/
	private $_replacement;

	private $_template_name;

	public function __construct ($template_path)
	{
		$this->_template_path = $template_path;
		$path_parts = pathinfo($template_path);
		$this->_template_name = $path_parts['filename'];
	}

	public function getName()
	{
		return $this->_template_name;
	}

	public function getContent()
	{
		if(!file_exists($this->_template_path))
		{
			Skebuilder::addErrorMessage('file ' . $this->_template_path . ' does not exist');
			return false;
		}

		if(!($template_file_string = file_get_contents($this->_template_path)))
		{
			Skebuilder::addErrorMessage('file ' . $this->_template_path . ' can not get content');
			return false;
		}

		return $template_file_string;
	}
}