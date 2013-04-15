<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */

require(dirname(__FILE__) . './ReplacementCore.php');
require(dirname(__FILE__) . './ReplacementDefault.php');

class ReplacementManager{

	/**
	 * Array with key is temlate name, and value is replacement class
	 *
	 * @var string
	 **/
	private $template_replacement_list = array();


	private $default_replacement_class = 'ReplacementDefault';
	/**
	 * lazy initializing singleton
	 *
	 * @var TemplateManager
	 **/
	private static $instance = NULL;

	public static function getInstance($template_replacement_mapping_file)
	{
		if(self::$instance == NULL)
		{
			self::$instance = new ReplacementManager($template_replacement_mapping_file);
		}

		return self::$instance;
	}

	private function __construct($template_replacement_mapping_file)
	{
		$XMLParser = new XMLParser;
		if(file_exists($template_replacement_mapping_file))
		{
			$list = $XMLParser->parse($template_replacement_mapping_file);
			$template_list = $list['templates']['template'];
			foreach ($template_list as $template) {
				$replacement_class = $this->default_replacement_class;
				if(isset($template['replacement']) && isset($template['replacement']['class']))
				{
					$replacement_class = $template['replacement']['class'];
				}
				$this->template_replacement_list[$template['name']] = $this->getReplacementClass($replacement_class);
			}
		}
		else
		{
			Skebuilder::addErrorMessage('file '. $template_replacement_mapping_file . "does not exist " );
		}

	}

	public function getReplacementOfTemplate($template_name)
	{
		return isset($this->template_replacement_list[$template_name]) ? $this->template_replacement_list[$template_name] : Skebuilder::getSkeletonReplacement();
	}

	/**
	 * class name and name of file containing that class must be the same
	 * @param  tring $class_name name of class
	 * @return Object             return the instance of class
	 */
	public function getReplacementClass($class_name)
	{
		if(file_exists(SKEBUILDER_SRC_DIR . 'replacement' . DIRECTORY_SEPARATOR . $class_name . '.php'))
		{
			require_once(SKEBUILDER_SRC_DIR . 'replacement' . DIRECTORY_SEPARATOR . $class_name . '.php');
			return new $class_name();
		}
		else
		{
			Skebuilder::addErrorMessage('class '. $class_name . "does not exist, using default class " . $this->default_replacement_class );
			return new $this->default_replacement_class();
		}
	}

}