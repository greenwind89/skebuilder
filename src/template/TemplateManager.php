<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */

require(dirname(__FILE__) . './Template.php');

class TemplateManager{
	/**
	 * Array with key is temlate name, and value is template full path
	 *
	 * @var string
	 **/
	private $template_list;


	private $template_accepted_extensions = array('php', 'html');

	/**
	 * lazy initializing singleton
	 *
	 * @var TemplateManager
	 **/
	private static $instance = NULL;

	public static function getInstance($template_lib_dir)
	{
		if(self::$instance == NULL)
		{
			self::$instance = new TemplateManager($template_lib_dir);
		}

		return self::$instance;
	}

	private function __construct($template_lib_dir)
	{
		$helpers = new Helpers;
		$list_files = $helpers->getFileList($template_lib_dir, $this->template_accepted_extensions);

		foreach ($list_files as $file_path) {
			$path_parts = pathinfo($file_path);
			$this->template_list[$path_parts['filename']] = new Template($file_path);
		}

	}

	public function getTemplate($template_name)
	{
		return isset($this->template_list[$template_name]) ? $this->template_list[$template_name] : false;
	}
}