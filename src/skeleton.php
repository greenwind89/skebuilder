<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


Class Skeleton {
	/**
	 * this variale contains static folder stucture of phpfox
	 * show have html file to make archive include them
	 * dot should be avoid to be used in naming a folder
	 * 
	 * colons will be used only for files, the string next to  colon is the expected template for that file
	 * if the template doesn't exist or there's no colons, created file will be empty
	 * there will be many kind of structure to specific which file template can be used
	 * the flexibility of the structure is important
	 * so this structure seems to be not well-suited 
	 * 
	 * file, template relationship is one-one? 
	 * 
	 * @var string
	 **/
	private $phpfox_skeleton = array(
			'include' => array('component' => array('ajax' => 'index.html',
													 'block' => array(
													 	'index.html',
													 	'category.class.php:phpfox/phpfox_block_class.php'
													 	), 
													 'controller' => 'index.html', 
													 'index.html'),
							 'plugin' => 'index.html', 
							 'service' => 'index.html', 
							 'index.html'),
			'static' => array(
				'css' => 'index.html',
				'image' => 'index.html',
				'jscript' => 'index.html',
				'index.html'
				),

			'template' => array(
				'default' => array(
					'block' => array(
						'index.html', 
						'category.html.php:phpfox/phpfox_block_class.php'
						),
					'controller' => 'index.html',
					'index.html'
					),

				'index.html'
				),

			'yninstall' => array(
				'versions' => 'index.html',
				'index.html'
				),
			'index.html'
		);


	/**
	 * @todo: handle file, predefined template files 
	 * return the stucture of predefined packages
	 * @param string $pakage_type name of package type: Phpfox,  SE, OxWall
	 * @return array of structure
	 */
	public function getSkeleton ($package_type)
	{
		$package_type = strtolower($package_type);
		switch ($package_type) {
			case 'phpfox':
					return $this->phpfox_skeleton;
				break;
			
			default:
					return false;
				break;
		}
	}

	public function setPhpfoxSkeleton($structure)
	{
		$this->phpfox_skeleton = $structure;
	}
}