<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


/**
 * file node has no child, so it is a leaf in Composite pattern
 */
Class FileNode implements NodeAbstract{
	/**
	 * name of current nodoe
	 *
	 * @var string
	 **/
	private $name;

	/**
	 * path to template file, relative with the src/template folder
	 * ex: phpfox/phpfox_block_class.php
	 * 
	 * @var string
	 **/
	private $template_file = null;

	private function writeTemplateToNewCreatedFile($file_handler)
	{
		if(!file_exists($this->template_file))
		{
			Skebuilder::addErrorMessage('file ' . $this->template_file . ' does not exist');
			return false;
		}

		if(!($template_file_string = file_get_contents($this->template_file)))
		{
			Skebuilder::addErrorMessage('file ' . $this->template_file . ' can not get content');
			return false;
		}

		// it is where the substitutions go a
		if(!fwrite($file_handler, $template_file_string))
		{
			Skebuilder::addErrorMessage('file ' . $this->template_file . ' cannot be written');
			return false;
		}

		return true;
	}

	/**
	 * initialize object with name 
	 * @param string $name name of this node
	 */
	public function __construct($name, $template_file = null) {
		$this->name = $name;
		$this->template_file = $template_file;
	}


	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function create($container) {
		if(trim($this->name) === '')
		{
			return false;
		}

		$new_file_path = rtrim($container, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $this->name; 
		if(!$fp = fopen($new_file_path, 'w'))
		{
			return false;
		}

		if($this->template_file)
		{
			if(!$this->writeTemplateToNewCreatedFile($fp))
			{
				return false;
			}
		}
		fclose($fp);
		// chmod($new_file_path, 0777);
		return true;
	}
}