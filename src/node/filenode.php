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

	private $full_path;
	/**
	 * path to template file, relative with the src/template folder
	 * ex: phpfox/phpfox_block_class.php
	 * 
	 * @var string
	 **/
	private $template = null;

	private function writeTemplateToNewCreatedFile($file_handler)
	{

		$template_file_string = $this->template->getContent();
		// it is where the substitutions go a
		if(!fwrite($file_handler, $template_file_string))
		{
			Skebuilder::addErrorMessage('file at node name = ' . $this->name . ' cannot be written');
			return false;
		}

		return true;
	}

	/**
	 * initialize object with name 
	 * @param string $name name of this node
	 */
	public function __construct($name, $template_name = null) {
		$this->name = $name;
		if($template_name)
		{
			$this->template = Skebuilder::getTemplate($template_name);
		}
		
	}

	public function getFullPath() {
		return $this->full_path;
	}
	
	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function create($context) {
		if(trim($this->name) === '')
		{
			return false;
		}

		$container = $context->getFullPathOfCurrentContext();

		$new_file_path = rtrim($container, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $this->name;

		if(!$fp = fopen($new_file_path, 'w'))
		{
			return false;
		}

		if($this->template)
		{
			if(!$this->writeTemplateToNewCreatedFile($fp))
			{
				return false;
			}
		}
		fclose($fp);
		$this->full_path = $new_file_path;
		// chmod($new_file_path, 0777);
		return true;
	}

	public function accept($visitor)
	{
		$visitor->visit($this);
		$visitor->leave($this);
	}

}