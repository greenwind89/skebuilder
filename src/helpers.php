<?php
/**
 * 
 * 
 * @copyright		[YOUNET_COPYRIGHT]
 * @author  		minhTA	
 */


Class Helpers {

	private $file_path_list = array();

	public function getFileList($container, $extension_array = array()) 
	{
		$dir = $container;
		if(is_dir($dir)) 
        {
        	if($dh = opendir($dir)) 
        	{
            	while(($file = readdir($dh)) !== false) 
            	{
                	if($file != '.' && $file != '..') 
                	{
                    	if(is_dir($dir . $file)) 
                    	{
                        	$this->getFileList($dir . $file . DIRECTORY_SEPARATOR, $extension_array);
						} 
						else
						{
							$full_path = $dir . $file;
							$path_parts = pathinfo($full_path);
							if(count($extension_array) > 0)
							{
								// if it is not what we want, ignore it
								if(!in_array($path_parts['extension'], $extension_array))
								{
									continue;
								}
							}
							$this->file_path_list[] = $full_path;
                        }
                	}
				}
        	}
        	closedir($dh);
        }

        return $this->file_path_list;
	}

	public function stripFileExtension($filename)
	{
		$new_file_name =  preg_replace("/\\.[^.\\s]{3,5}$/", "", $filename);

		// duple checking for the case: phpfox.class.php
		return preg_replace("/\\.[^.\\s]{3,5}$/", "", $new_file_name);

	}
}